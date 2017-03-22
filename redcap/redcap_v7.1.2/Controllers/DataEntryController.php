<?php

class DataEntryController extends Controller
{
	// Save collapse state of data entry form list (classic only) on left-hand menu when NOT in record context
	public function saveShowInstrumentsToggle()
	{
		// Check collapse value
		if (!isset($_POST['collapse']) || !isset($_POST['targetid']) || !in_array($_POST['collapse'], array('0', '1'))) exit('0');		
		// Add value to UI State (project_id is key and menu ID is subkey)
		if ($_POST['collapse'] == '0') {
			// Add it as collapsed
			UIState::saveUIStateValue(PROJECT_ID, $_POST['object'], $_POST['targetid'], 1);
		} else {
			// Remove it from UI state
			UIState::removeUIStateValue(PROJECT_ID, $_POST['object'], $_POST['targetid']);
		}
	}
	
	// Assign a record to a DAG
	public function assignRecordToDag()
	{
		global $Proj, $lang, $table_pk_label, $user_rights;
		// Get params
		$dags = $Proj->getGroups();
		if (empty($_POST['record']) || !isset($_POST['group_id']) || empty($dags) || $user_rights['group_id'] != '') exit;
		if ($_POST['group_id'] != '' && !isset($dags[$_POST['group_id']])) exit;
		$record = addDDEending(rawurldecode(urldecode($_POST['record'])));
		// Assign to DAG
		Records::assignRecordToDag($record, $_POST['group_id']);
		// Return successful response
		print "1";
	}	
	
	// Rename a record
	public function renameRecord()
	{
		include_once APP_PATH_DOCROOT . 'ProjectGeneral/form_renderer_functions.php';
		global $Proj, $lang, $table_pk_label;
		// Get params
		if (empty($_POST['record']) || empty($_POST['new_record'])) exit;
		$record = addDDEending(rawurldecode(urldecode($_POST['record'])));
		$new_record = addDDEending(rawurldecode(urldecode($_POST['new_record'])));
		// Set event_id here so that logging works out correctly
		$arm = getArm();
		$_GET['event_id'] = $Proj->multiple_arms ? $Proj->getFirstEventIdArm($arm) : $Proj->firstEventId;
		// Does record exist?
		if (Records::recordExists($new_record, ($Proj->multiple_arms ? $arm : null))) {
			// Return message that record already exists
			$msg = "<div style='color:#A00000;font-size:14px;font-weight:bold;'><img src='".APP_PATH_IMAGES."exclamation.png'> " . strip_tags(label_decode($table_pk_label)) . " \"" . removeDDEending($record) . "\" {$lang['data_entry_318']} \"" . removeDDEending($new_record) . "\" {$lang['data_entry_319']}</div>";
			exit($msg);	
		}
		// Rename record and log this event
		changeRecordId($record, $new_record);
		// Return successful response
		print "1";
	}	
	
	// Delete an entire record
	public function deleteRecord()
	{
		include_once APP_PATH_DOCROOT . 'ProjectGeneral/form_renderer_functions.php';
		global $Proj, $table_pk, $multiple_arms, $randomization, $status;
		// Set event_id here so that logging works out correctly
		$_GET['event_id'] = ($multiple_arms && is_numeric($_POST['arm'])) ? $Proj->getFirstEventIdArm($_POST['arm']) : $Proj->firstEventId;
		// Delete record and log this event
		$_POST['record'] = rawurldecode(urldecode($_POST['record']));
		Records::deleteRecord(addDDEending($_POST['record']), $table_pk, $multiple_arms, $randomization, $status, false, $Proj->getArmIdFromArmNum($_POST['arm']));
		// Return successful response
		print "1";
	}	
	
	// Delete this event instance and log this event
	public function deleteEventInstance()
	{
		global $Proj, $surveys_enabled, $lang, $randomization;
		
		$record = addDDEending(rawurldecode(urldecode($_POST['record'])));
		
		// RANDOMIZATION
		$delEventRandMsg = '';
		// Has the record been randomized?
		$wasRecordRandomized = ($randomization && Randomization::setupStatus() && Randomization::wasRecordRandomized($record));
		if ($wasRecordRandomized) {
			// Get randomization attributes
			$randAttr = Randomization::getRandomizationAttributes();
			// Form contains randomizatin field
			$eventContainsRandFields = ($randAttr['targetEvent'] == $_GET['event_id']);
			// Loop through strata fields
			foreach ($randAttr['strata'] as $strata_field=>$strata_event) {
				if ($strata_event == $_GET['event_id']) {
					$eventContainsRandFields = true;
				}
			}
			if ($eventContainsRandFields) {
				$delEventRandMsg = RCView::div(array('class'=>'p'), $lang['data_entry_267']);
			}
		}		
		// LOCKING
		// Determine if at least one form on this event is locked
		$Locking = new Locking();
		$Locking->findLocked($Proj, $record, array(), $_GET['event_id']);
		$eventHasLockedForm = !empty($Locking->locked);
		$delEventLockingMsg = !$eventHasLockedForm ? "" : RCView::div(array('class'=>'p'), $lang['data_entry_268']);		
		// Is event locked or randomized in part? If so, stop and return msg.
		if ($delEventRandMsg . $delEventLockingMsg != '') {
			exit($delEventRandMsg . $delEventLockingMsg);
		}
		
		// Get list of all fields with data for this record on this event
		$sql = "select distinct field_name from redcap_data where project_id = ".PROJECT_ID."
				and event_id = {$_GET['event_id']} and record = '".prep($record)."'" .
				($Proj->hasRepeatingFormsEvents() ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "");
		$q = db_query($sql);
		$eraseFields = $eraseFieldsLogging = array();
		while ($row = db_fetch_assoc($q)) {
			// Add to field list
			$eraseFields[] = $row['field_name'];
			// Add default data values to logging field list
			if ($Proj->isCheckbox($row['field_name'])) {
				foreach (array_keys(parseEnum($Proj->metadata[$row['field_name']]['element_enum'])) as $this_code) {
					$eraseFieldsLogging[] = "{$row['field_name']}($this_code) = unchecked";
				}
			} elseif ($row['field_name'] != $Proj->table_pk) {
				$eraseFieldsLogging[] = "{$row['field_name']} = ''";
			}
		}
		// Determine if other events of data exist for this record. If not, then don't delete the record ID value.
		$sql = "select 1 from redcap_data where project_id = ".PROJECT_ID."
				and event_id in (".prep_implode(array_keys($Proj->eventInfo)).")
				and event_id != {$_GET['event_id']} and record = '".prep($record)."'" .
				($Proj->hasRepeatingFormsEvents() ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "") .
				" limit 1";
		$q = db_query($sql);
		$sub_sql = (db_num_rows($q) > 0) ? "" : "and field_name != '{$Proj->table_pk}'";
		// Delete all responses from data table for this form (do not delete actual record name - will keep same record name)
		$sql = "delete from redcap_data where project_id = ".PROJECT_ID." $sub_sql
				and event_id = {$_GET['event_id']} and record = '".prep($record)."'" .
				($Proj->hasRepeatingFormsEvents() ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "");
		db_query($sql);
		// If this form is a survey, then set all survey response timestamps to NULL
		$sql2 = "";
		if ($surveys_enabled) {
			$this_event_survey_ids = array();
			foreach ($Proj->eventsForms[$_GET['event_id']] as $this_form) {
				if (isset($Proj->forms[$this_form]['survey_id'])) {
					$this_event_survey_ids[] = $Proj->forms[$this_form]['survey_id'];
				}
			}
			if (!empty($this_event_survey_ids)) {
				$sql2 = "update redcap_surveys_participants p, redcap_surveys_response r
						set r.first_submit_time = null, r.completion_time = null
						where r.participant_id = p.participant_id and p.survey_id in (" . prep_implode($this_event_survey_ids) . ")
						and r.record = '".prep($record)."' and p.event_id = {$_GET['event_id']} and r.instance = {$_GET['instance']}";
				db_query($sql2);
			}
		}
		// Log the data change
		$logDescrip = $Proj->isRepeatingEvent($_GET['event_id']) ? "Delete all record data for single event instance" : "Delete all record data for single event";
		$log_event_id = Logging::logEvent($sql."; $sql2", "redcap_data", "UPDATE", $record, implode(",\n",$eraseFieldsLogging), $logDescrip,
										  "", "", "", true, null, $_GET['instance']);
				
		// Return successful response
		print "1";
	}
	
	// Render the HTML for a record/form/event's instances for a Repeating Form
	public function renderInstancesTable()
	{
		print RepeatInstance::renderRepeatingFormsDataTables($_POST['record'], array(), array(), $_POST['form'], $_POST['event_id']);
	}
}