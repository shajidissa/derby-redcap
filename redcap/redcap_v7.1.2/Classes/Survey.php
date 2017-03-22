<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . "/Surveys/survey_functions.php";

/**
 * SURVEY Class
 * Contains methods used with regard to surveys
 */
class Survey
{
	// Time period after which survey short codes will expire
	const SHORT_CODE_EXPIRE = 60; // minutes

	// Character length of survey short codes
	const SHORT_CODE_LENGTH = 5;

	// Character length of survey access codes
	const ACCESS_CODE_LENGTH = 9;

	// Character length of numeral survey access codes
	const ACCESS_CODE_NUMERAL_LENGTH = 10;

	// Character to prepend to numeral survey access codes to denote for REDCap to call them back
	const PREPEND_ACCESS_CODE_NUMERAL = "V";

	// Return array of form_name and survey response status (0=partial,2=complete)
	// for a given project-record-event. $record may be a single record name or array of record names.
	public static function getResponseStatus($project_id, $record=null, $event_id=null)
	{
		$surveyResponses = array();
		$sql = "select r.record, p.event_id, s.form_name, if(r.completion_time is null,0,2) as survey_complete, r.instance
				from redcap_surveys s, redcap_surveys_participants p, redcap_surveys_response r
				where s.survey_id = p.survey_id and p.participant_id = r.participant_id
				and s.project_id = $project_id and r.first_submit_time is not null";
		if ($record != null && is_array($record)) {
			$sql .= " and r.record in (".prep_implode($record).")";
		} elseif ($record != null) {
			$sql .= " and r.record = '".prep($record)."'";
		}
		if (is_numeric($event_id)) 	$sql .= " and p.event_id = $event_id";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$surveyResponses[$row['record']][$row['event_id']][$row['form_name']][$row['instance']] = $row['survey_complete'];
		}
		return $surveyResponses;
	}


	// Survey Notifications: Return array of surveys/users with attributes regarding email notifications for survey responses
	public static function getSurveyNotificationsList()
	{
		// First get list of all project users to fill default values for array
		$endSurveyNotify = array();
		$sql = "select if(u.ui_id is null,0,1) as hasEmail, u.user_email as email1, u.user_firstname, u.user_lastname,
				if (u.email2_verify_code is null, u.user_email2, null) as email2,
				if (u.email3_verify_code is null, u.user_email3, null) as email3,
				lower(r.username) as username from redcap_user_rights r
				left outer join redcap_user_information u on u.username = r.username
				where r.project_id = ".PROJECT_ID." order by lower(r.username)";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			// where 0 is default value for hasEmail
			$endSurveyNotify[$row['username']] = array('surveys'=>array(), 'hasEmail'=>$row['hasEmail'], 'email1'=>$row['email1'],
													   'email2'=>$row['email2'], 'email3'=>$row['email3'],
													   'name'=>label_decode($row['user_firstname'] == '' ? '' : trim("{$row['user_firstname']} {$row['user_lastname']}")) );
		}
		// Get list of users who have and have not been set up for survey notification via email
		$sql = "select lower(u.username) as username, a.survey_id, a.action_response
				from redcap_actions a, redcap_user_information u, redcap_user_rights r
				where a.project_id = ".PROJECT_ID." and r.project_id = a.project_id 
				and r.username = u.username and a.action_trigger = 'ENDOFSURVEY'
				and a.action_response in ('EMAIL_PRIMARY', 'EMAIL_SECONDARY', 'EMAIL_TERTIARY')
				and u.ui_id = a.recipient_id order by u.username";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			$email_acct = ($row['action_response'] == 'EMAIL_TERTIARY' ? 3 : ($row['action_response'] == 'EMAIL_SECONDARY' ? 2 : 1));
			$endSurveyNotify[$row['username']]['surveys'][$row['survey_id']] = $email_acct;
		}
		// Return array
		return $endSurveyNotify;
	}


	// Return boolean regarding if Survey Notifications are enabled
	public static function surveyNotificationsEnabled()
	{
		// Get list of users who have and have not been set up for survey notification via email
		$sql = "select 1 from redcap_actions where project_id = ".PROJECT_ID." and action_trigger = 'ENDOFSURVEY'
				and action_response in ('EMAIL_PRIMARY', 'EMAIL_SECONDARY', 'EMAIL_TERTIARY') limit 1";
		$q = db_query($sql);
		// Return boolean
		return (db_num_rows($q) > 0);
	}


	// Return boolean if Survey Queue is enabled for at least one instrument in this project
	public static function surveyQueueEnabled()
	{
		// Order by event then by form order
		$sql = "select count(1) from redcap_surveys_queue q, redcap_surveys s, redcap_metadata m, redcap_events_metadata e,
				redcap_events_arms a where s.survey_id = q.survey_id and s.project_id = ".PROJECT_ID." and m.project_id = s.project_id
				and s.form_name = m.form_name and q.event_id = e.event_id and e.arm_id = a.arm_id and q.active = 1 and s.survey_enabled = 1";
		$q = db_query($sql);
		return (db_result($q, 0) > 0);
	}


	// Return the complete Survey Queue prescription for this project
	public static function getProjectSurveyQueue($ignoreInactives=true)
	{
		$project_queue = array();
		// Order by event then by form order
		$sql = "select distinct q.* from redcap_surveys_queue q, redcap_surveys s, redcap_metadata m, redcap_events_metadata e,
				redcap_events_arms a where s.survey_id = q.survey_id and s.project_id = ".PROJECT_ID." and m.project_id = s.project_id
				and s.form_name = m.form_name and q.event_id = e.event_id and e.arm_id = a.arm_id and s.survey_enabled = 1";
		if ($ignoreInactives) $sql .= " and q.active = 1";
		$sql .= " order by a.arm_num, e.day_offset, e.descrip, m.field_order";
		$q = db_query($sql);
		if (db_num_rows($q) > 0) {
			while ($row = db_fetch_assoc($q)) {
				$survey_id = $row['survey_id'];
				$event_id = $row['event_id'];
				unset($row['survey_id'], $row['event_id']);
				$project_queue[$survey_id][$event_id] = $row;
			}
		}
		return $project_queue;
	}


	// Return the Survey Queue of completed/incomplete surveys for a given record.
	// If $returnTrueIfOneOrMoreItems is set to TRUE, then return boolean if one or more items exist in this record's queue.
	public static function getSurveyQueueForRecord($record, $returnTrueIfOneOrMoreItems=false)
	{
		global $Proj;
		// Add queue itmes for record to array
		$record_queue = array();
		// First, get the project's survey queue and loop to see how many are applicable for this record
		$project_queue = self::getProjectSurveyQueue();

		// Collect all survey/events where surveys have been completed for this record
		$completedSurveyEvents = array();
		$sql = "select p.event_id, p.survey_id, r.instance from redcap_surveys_participants p, redcap_surveys_response r
				where r.participant_id = p.participant_id and p.survey_id in (".prep_implode(array_keys($Proj->surveys)).")
				and p.event_id in (".prep_implode(array_keys($Proj->eventInfo)).") and r.record = '" . prep($record) . "'
				and r.completion_time is not null";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$completedSurveyEvents[$row['survey_id']][$row['event_id']][$row['instance']] = true;
		}

		// GET DATA for all fields used in Survey Queue conditional logic (for all queue items)
		$fields = array();
		$events = ($Proj->longitudinal) ? array() : array($Proj->firstEventId);
		// Loop through project queue for this record to get conditional logic used
		foreach ($project_queue as $survey_id=>$sattr) {
			foreach ($sattr as $event_id=>$queueItem) {
				if (trim($queueItem['condition_logic']) == '') continue;
				// Loop through fields used in the logic. Also, parse out any unique event names, if applicable
				foreach (array_keys(getBracketedFields($queueItem['condition_logic'], true, true, false)) as $this_field)
				{
					// Check if has dot (i.e. has event name included)
					if (strpos($this_field, ".") !== false) {
						list ($this_event_name, $this_field) = explode(".", $this_field, 2);
						$events[] = $this_event_name;
					}
					// Add field to array
					$fields[] = $this_field;
				}
			}
		}
		// Add form status fields for Repeating Instrument surveys
		foreach ($Proj->getRepeatingFormsEvents() as $this_event_id=>$repeatForms) {
			if (!is_array($repeatForms)) continue;
			$events[] = $Proj->getUniqueEventNames($this_event_id);
			foreach (array_keys($repeatForms) as $thisRepeatForm) {
				$fields[] = $thisRepeatForm . "_complete";
			}
		}
		// Set params for getData
		$events = array_unique($events);
		$fields = array_unique($fields);
		// Retrieve data from data table since $record_data array was not passed as parameter
		$record_data = Records::getData($Proj->project_id, 'array', $record, $fields, $events);
		if (empty($record_data[$record])) $record_data = null;

		// If some events don't exist in $record_data because there are no values in data table for that event,
		// then add empty event with default values to $record_data (or else the parse will throw an exception).
		if (count($events) > count($record_data[$record])) {
			// Get unique event names (with event_id as key)
			$unique_events = $Proj->getUniqueEventNames();
			// Loop through each event
			foreach ($events as $this_event_name) {
				$this_event_id = array_search($this_event_name, $unique_events);
				if (!isset($record_data[$record][$this_event_id])) {
					// Add all fields from $fields with defaults for this event
					foreach ($fields as $this_field) {
						// If a checkbox, set all options as "0" defaults
						if ($Proj->isCheckbox($this_field)) {
							foreach (parseEnum($Proj->metadata[$this_field]['element_enum']) as $this_code=>$this_label) {
								$record_data[$record][$this_event_id][$this_field][$this_code] = "0";
							}
						}
						// If a Form Status field, give "0" default
						elseif ($this_field == $Proj->metadata[$this_field]['form_name']."_complete") {
							$record_data[$record][$this_event_id][$this_field] = "0";
						} else {
							$record_data[$record][$this_event_id][$this_field] = "";
						}
					}
				}
			}
		}

		// Loop through project queue for this record
		foreach ($project_queue as $survey_id=>$sattr) {
			// Get survey's form_name
			$form_name = $Proj->surveys[$survey_id]['form_name'];
			// Loop through events
			foreach ($sattr as $event_id=>$queueItem) {
				// Set instance array depending on how many instances exist for this record
				$instances = array(1);
				if (isset($record_data[$record]['repeat_instances'][$event_id][$form_name])) {
					$instances = array_merge($instances, array_keys($record_data[$record]['repeat_instances'][$event_id][$form_name]));
				}
				// Loop through all instances
				foreach ($instances as $instance) {				
					// Should this item be displayed in the record's queue?
					$displayInQueue = self::checkConditionsOfRecordToDisplayInQueue($record, $queueItem, $completedSurveyEvents, $record_data, $instance, ($instance > 1 ? $form_name : null));
					// If will be displayed in queue, get their survey link hash and then add to array
					if ($displayInQueue) {
						// If set flag to return boolean, then stop here and return TRUE
						if ($returnTrueIfOneOrMoreItems) return true;
						// Determine if participant has completed this survey-event already
						$completedSurvey = (isset($completedSurveyEvents[$survey_id][$event_id][$instance]));
						// Get the survey hash for this survey-event-record
						list ($participant_id, $hash) = self::getFollowupSurveyParticipantIdHash($survey_id, $record, $event_id, false, $instance);
						// Add to array
						$record_queue["$survey_id-$event_id-$instance"] = array(
							'survey_id'=>$survey_id, 'event_id'=>$event_id, 'instance'=>$instance, 'title'=>$Proj->surveys[$survey_id]['title'],
							'participant_id'=>$participant_id, 'hash'=>$hash, 'auto_start'=>$queueItem['auto_start'], 'completed'=>($completedSurvey ? 1 : 0)
						);
					}
				}
			}
		}

		// Loop through all surveys and add to record's queue if a survey has already been completed
		$record_queue_all = array();
		// Loop through all arms
		foreach ($Proj->events as $arm_num=>$attr) {
			// Loop through each event in this arm
			foreach (array_keys($attr['events']) as $event_id) {
				// Loop through forms designated for this event
				foreach ($Proj->eventsForms[$event_id] as $form_name) {
					// If form is enabled as a survey
					if (isset($Proj->forms[$form_name]['survey_id'])) {
						// Get survey_id
						$survey_id = $Proj->forms[$form_name]['survey_id'];
						// Set instance array depending on how many instances exist for this record
						$instances = array(1);
						if (isset($record_data[$record]['repeat_instances'][$event_id][$form_name])) {
							$instances = array_merge($instances, array_keys($record_data[$record]['repeat_instances'][$event_id][$form_name]));
						}
						// Loop through all instances
						foreach ($instances as $instance) {
							// If we have already saved this survey in our record_queue, then just copy the existing attributes
							if (isset($record_queue["$survey_id-$event_id-$instance"])) {
								// Add to array
								$record_queue_all["$survey_id-$event_id-$instance"] = $record_queue["$survey_id-$event_id-$instance"];
							} elseif (isset($completedSurveyEvents[$survey_id][$event_id][$instance])) {
								// Check if survey was completed. Only add survey to queue if completed
								// Get the survey hash for this survey-event-record
								list ($participant_id, $hash) = self::getFollowupSurveyParticipantIdHash($survey_id, $record, $event_id, false, $instance);
								// Prepend to array
								$record_queue_all["$survey_id-$event_id-$instance"] = array(
									'survey_id'=>$survey_id, 'event_id'=>$event_id, 'instance'=>$instance, 'title'=>$Proj->surveys[$survey_id]['title'],
									'participant_id'=>$participant_id, 'hash'=>$hash, 'auto_start'=>'0', 'completed'=>1
								);
							}
						}
					}
				}
			}
		}

		// If set flag to return boolean, then stop here
		if ($returnTrueIfOneOrMoreItems) return (!empty($record_queue_all));

		// Return the survey queue for this record
		return $record_queue_all;
	}


	// Display the Survey Queue of completed/incomplete surveys for a given record in HTML table format
	public static function displaySurveyQueueForRecord($record, $isSurveyAcknowledgement=false, $justCompletedSurvey=false)
	{
		global $Proj, $lang, $isAjax, $survey_queue_custom_text, $isMobileDevice;
		// Get survey queue items for this record
		$survey_queue_items = self::getSurveyQueueForRecord($record);
		// Obtain the survey queue hash for this record
		$survey_queue_hash = self::getRecordSurveyQueueHash($record);
		$survey_queue_link = APP_PATH_SURVEY_FULL . '?sq=' . $survey_queue_hash;
		// If empty, then return and display nothing
		if (empty($survey_queue_items)) return "";
		// Obtain participant's email address, if we have one
		$participant_emails_idents = self::getResponsesEmailsIdentifiers(array($record));
		foreach ($participant_emails_idents as $participant_id=>$pattr) {
			$participant_email = $pattr['email'];
		}
		// AUTO-START: If enabled for the first incomplete survey in queue, then redirect there
		if ($isSurveyAcknowledgement) {
			// Loop through queue to find the first incomplete survey
			foreach ($survey_queue_items as $queueAttr) {
				// If already completed, or if a repeating instance, then skip to next item
				if ($queueAttr['completed'] > 0 || (isset($queueAttr['instance']) && $queueAttr['instance'] > 1)) continue;
				if ($queueAttr['auto_start']) {
					// If just completed the survey, then execute the redcap_survey_complete hook
					if ($justCompletedSurvey) {
						// REDCap Hook injection point: Pass project/record/survey attributes to method
						$group_id = (empty($Proj->groups)) ? null : Records::getRecordGroupId(PROJECT_ID, $record);
						if (!is_numeric($group_id)) $group_id = null;
						Hooks::call('redcap_survey_complete', array(PROJECT_ID, (is_numeric($_POST['__response_id__']) ? $record : null), $_GET['page'], $_GET['event_id'], $group_id, $_GET['s'], $_POST['__response_id__']));
					}
					// Redirect to first incomplete survey in queue
					redirect(APP_PATH_SURVEY_FULL . '?s=' . $queueAttr['hash']);
				}
				// Stop looping if first incomplete survey does not have auto-start enabled
				break;
			}
		}
		// Get a count of the number of surveys in queue that have been completed already. If more than 4, then compact them.
		$numSurveysCompleted = 0;
		foreach ($survey_queue_items as $queueAttr) {
			if ($queueAttr['completed'] > 0) $numSurveysCompleted++;
		}
		// Collect all html as variable
		$html = "";
		$row_data = array();
		// Loop through items to display each as a row
		$isFirstIncompleteSurvey = true;
		$hideCompletedSurveys = ($numSurveysCompleted > 5);
		$num_survey_queue_items = count($survey_queue_items);
		$allSurveysCompleted = ($num_survey_queue_items == $numSurveysCompleted);
		$cumulRowHtml = $thisRowHtml = '';
		$rowCounter = 1;
		$instancesAllForms = array();
		$surveyCompleteIconText = 	RCView::img(array('src'=>'tick.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'font-weight:normal;vertical-align:middle;line-height:22px;font-size:12px;color:green;'), $lang['survey_507']);
		$survey_queue_items = array_values($survey_queue_items); // Re-index the survey queue array so that they key is predictable		
		foreach ($survey_queue_items as $key=>$queueAttr)
		{
			// Get survey's form_name
			$form_name = $Proj->surveys[$queueAttr['survey_id']]['form_name'];
			// If this instrument is a repeating instrument
			$isRepeatingForm = $Proj->isRepeatingForm($queueAttr['event_id'], $form_name);
			// Get list of all instances for this repeating instrument
			$pipedLabel = "";
			if ($isRepeatingForm) {
				// CUSTOM FORM LABEL PIPING: Gather field names of all custom form labels (if any)
				$pipedFormLabels = RepeatInstance::getPipedCustomRepeatingFormLabels($record, $queueAttr['event_id'], $form_name);
				// Get pre-piped custom repeating form label
				$pre_piped_label = $Proj->RepeatingFormsEvents[$queueAttr['event_id']][$form_name];
				// Pipe any custom form labels
				if ($pre_piped_label != "" && isset($pipedFormLabels[$record][$queueAttr['instance']])) {
					$pipedLabel = ": " . $pipedFormLabels[$record][$queueAttr['instance']];
				}
			}
			// Set onclick action for link/button
			$onclick = ($isAjax) ? "window.open(app_path_webroot_full+'surveys/index.php?s={$queueAttr['hash']}','_blank');"
								 : "window.location.href = app_path_webroot_full+'surveys/index.php?s={$queueAttr['hash']}';";
			// Set button text
			$rowClass = $title_append = '';
			if ($queueAttr['completed']) {
				// If completed and more than $maxSurveysCompletedHide are completed, then hide row
				$rowClass = ($hideCompletedSurveys) ? 'hidden' : '';
				// Set image and text
				$button = $surveyCompleteIconText;
				$title_style = 'color:#aaa;';
				// If this survey has Save&Return + Edit Completed Response setting enabled, give link to open response
				if ($Proj->surveys[$queueAttr['survey_id']]['save_and_return']
					&& $Proj->surveys[$queueAttr['survey_id']]['edit_completed_response'])
				{
					$title_append .= RCView::div(array('class'=>"opacity75 nowrap $rowClass", 'onmouseover'=>"$(this).removeClass('opacity75');", 'onmouseout'=>"$(this).addClass('opacity75');", 'style'=>'float:right;margin:0 10px 0 20px;'),
										RCView::button(array('class'=>'btn btn-defaultrc btn-xs', 'style'=>'color:#000;background-color:#f0f0f0;', 'onclick'=>$onclick),
											RCView::span(array('class'=>'glyphicon glyphicon-pencil', 'style'=>'top:2px;margin-right:5px;'), '') . 
											$lang['data_entry_174']
										)
									);
				}
			} else {
				// Set button and text
				$button = RCView::button(array('class'=>'jqbuttonmed', 'style'=>'vertical-align:middle;', 'onclick'=>$onclick), $lang['survey_504']);
				$title_style = '';
			}
			
			// If this instrument is a repeating instrument and is the last
			if ($isRepeatingForm && $Proj->surveys[$queueAttr['survey_id']]['repeat_survey_enabled']) {
				// See if the next queue item is a different event or different instrument
				if ($queueAttr['completed'] > 0 && (!isset($survey_queue_items[$key+1]) || (isset($survey_queue_items[$key+1])
						&& !($queueAttr['event_id'] == $survey_queue_items[$key+1]['event_id'] && $queueAttr['survey_id'] == $survey_queue_items[$key+1]['survey_id']))))
				{
					// Get the custom repeat btn text
					$repeat_survey_btn_text = $Proj->surveys[$queueAttr['survey_id']]['repeat_survey_btn_text'];
					// Get count of existing instances and find next instance number
					list ($instanceTotal, $instanceMax) = RepeatInstance::getRepeatFormInstanceMaxCount($record, $queueAttr['event_id'], $form_name);
					// Get the next instance's survey url
					$repeatSurveyLink = REDCap::getSurveyLink($record, $form_name, $queueAttr['event_id'], $instanceMax + 1);
					// Add button to add a new instance
					$title_append .= RCView::div(array('class'=>"opacity75 nowrap $rowClass", 'onmouseover'=>"$(this).removeClass('opacity75');", 'onmouseout'=>"$(this).addClass('opacity75');", 'style'=>'float:right;margin:0 10px 0 20px;'),
										RCView::button(array('class'=>'btn btn-defaultrc btn-xs', 'style'=>'color:#000;background-color:#f0f0f0;', 'onclick'=>"window.location.href='$repeatSurveyLink';"),
											RCView::span(array('class'=>'glyphicon glyphicon-plus', 'style'=>'top:2px;margin-right:5px;'), '') . 
											(trim($repeat_survey_btn_text) == '' ? $lang['survey_1090'] : $repeat_survey_btn_text)
										)
									);
				}
			}
			
			// Add extra row to allow participant to display all completed surveys
			if (($allSurveysCompleted && $rowCounter == $num_survey_queue_items && $hideCompletedSurveys)
				|| (!$queueAttr['completed'] && $hideCompletedSurveys && $isFirstIncompleteSurvey))
			{
				// Set flag so that this doesn't get used again
				$isFirstIncompleteSurvey = false;
				// Add extra row
				$row_data[] = 	array(
									RCView::div(array('class'=>"wrap", 'style'=>'font-weight:normal;padding:2px 0;'), $surveyCompleteIconText),
									RCView::div(array('class'=>"wrap", 'style'=>'font-weight:normal;line-height:22px;font-size:13px;color:#444;'),
										($allSurveysCompleted
											? RCView::span(array('style'=>'font-size:13px;color:green;font-weight:bold;'), $lang['survey_536'])
											: $numSurveysCompleted . " " . $lang['survey_534']
										) .
										RCView::a(array('href'=>'javascript:;', 'style'=>'margin-left:8px;font-size:11px;font-weight:normal;', 'onclick'=>"
											$(this).parents('tr:first').hide();
											$('table#table-survey_queue .hidden').removeClass('hidden').hide().show('fade');
										"),
											$lang['survey_535']
										)
									)
								);
			}
			// If title is blank, then use the form name instead
			if ($queueAttr['title'] == "") {
				$queueAttr['title'] = $Proj->forms[$form_name]['menu'];
			}
			// Add this row's HTML
			$row_data[] = 	array(
								RCView::div(array('class'=>"wrap $rowClass", 'style'=>'padding:2px 0;'), $button),
								RCView::div(array('class'=>"wrap $rowClass", 'style'=>$title_style.'padding:4px 0;font-size:13px;font-weight:bold;float:left;'),
									RCView::escape($queueAttr['title']) .
									(!$Proj->longitudinal ? '' :
										RCView::span(array('class'=>"wrap $rowClass", 'style'=>'font-weight:normal; padding:0 10px;'),
											"&ndash;"
										) .
										RCView::span(array('class'=>"wrap $rowClass", 'style'=>'font-weight:normal;'),
											$Proj->eventInfo[$queueAttr['event_id']]['name_ext']
										)
									) .
									(!$Proj->isRepeatingForm($queueAttr['event_id'], $form_name) ? '' :
										RCView::span(array('class'=>"wrap $rowClass", 'style'=>'color:#800000;'.$title_style.'font-weight:normal;padding:0 10px 0 3px;'),
											"<span style='color:#999;margin:0 6px;'>&ndash;</span>#{$queueAttr['instance']}{$pipedLabel}"
										)
									)
								) .
								$title_append .
								RCView::div(array('class'=>'clear'), '')
							);
			// Increment counter
			$rowCounter++;
		}
		// Survey queue header text
		$table_title = 	RCView::div(array('style'=>''),
							RCView::div(array('style'=>'float:left;color:#800000;font-size:14px;'),
								RCView::img(array('src'=>'list_red.gif', 'style'=>'vertical-align:middle;position:relative;top:2px;')) .
								RCView::span(array('style'=>'vertical-align:middle;'), $lang['survey_505'])
							) .
							RCView::div(array('style'=>'float:right;margin-right:10px;'),
								RCView::button(array('class'=>'jqbuttonmed', 'style'=>'', 'onclick'=>"simpleDialog(null,null,'survey_queue_link_dialog',600);"),
									RCView::img(array('src'=>'link.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['survey_510'])
								)
							) .
							RCView::div(array('class'=>'wrap', 'style'=>'clear:both;padding-top:2px;font-weight:normal;font-size:12px;'),
								// Display custom survey queue text (invoke piping also) OR the default text
								($survey_queue_custom_text != ''
									?  label_decode(Piping::replaceVariablesInLabel(nl2br(decode_filter_tags($survey_queue_custom_text)), $record, $Proj->firstEventId))
									: $lang['survey_506'] . RCView::br() . $lang['survey_511']
								)
							)
						);
		// Set table headers
		$table_hdrs = array(
			array(120, $lang['dataqueries_23'], "center"),
			array(($isMobileDevice ? 255 : 655), $lang['survey_49'])
		);
		// Build table
		$html .= renderGrid("survey_queue", $table_title, ($isMobileDevice ? 400 : 800), 'auto', $table_hdrs, $row_data, true, false, false);
		// Hidden dialog div for getting link to survey queue
		$html .= RCView::div(array('id'=>'survey_queue_link_dialog', 'class'=>'simpleDialog', 'style'=>'z-index: 9999;', 'title'=>$lang['survey_510']),
					RCView::div(array('style'=>'margin:0 0 20px;'),
						$lang['survey_516']
					) .
					RCView::div(array(),
						RCView::img(array('src'=>'link.png')) .
						RCView::b($lang['survey_513']) .
						RCView::div(array('style'=>'margin:5px 0 10px 25px;'),
							RCView::text(array('readonly'=>'readonly', 'class'=>'staticInput', 'style'=>'width:90%;', 'onclick'=>"this.select();", 'value'=>$survey_queue_link))
						)
					) .
					RCView::div(array('style'=>'margin:20px 0 15px 10px;color:#999;'),
						"&mdash; ".$lang['global_46']. " &mdash;"
					) .
					RCView::div(array('style'=>'margin-bottom:20px;'),
						RCView::img(array('src'=>'email.png', 'style'=>'margin-right:1px;')) .
						RCView::b($lang['survey_514']) .
						RCView::div(array('style'=>'margin:5px 0 10px 25px;'),
							RCView::text(array('id'=>'survey_queue_email_send', 'class'=>'x-form-text x-form-field', 'style'=>'margin-left:8px;width:250px;'.($participant_email == '' ? "color:#777777;" : ''),
								'onblur'=>"if(this.value==''){this.value='".cleanHtml($lang['survey_515'])."';this.style.color='#777777';} if(this.value != '".cleanHtml($lang['survey_515'])."'){redcap_validate(this,'','','soft_typed','email')}",
								'value'=>($participant_email == '' ? $lang['survey_515'] : $participant_email),
								'onfocus'=>"if(this.value=='".cleanHtml($lang['survey_515'])."'){this.value='';this.style.color='#000000';}",
								'onclick'=>"if(this.value=='".cleanHtml($lang['survey_515'])."'){this.value='';this.style.color='#000000';}"
							)) .
							RCView::button(array('class'=>'jqbuttonmed', 'style'=>'', 'onclick'=>"
								var emailfld = document.getElementById('survey_queue_email_send');
								if (emailfld.value == '".cleanHtml($lang['survey_515'])."') {
									simpleDialog('".cleanHtml($lang['survey_515'])."',null,null,null,'document.getElementById(\'survey_queue_email_send\').focus();');
								} else if (redcap_validate(emailfld, '', '', '', 'email')) {
									$.post('$survey_queue_link',{ to: emailfld.value },function(data){
										if (data != '1') {
											alert(woops);
										} else {
											$('#survey_queue_link_dialog').dialog('close');
											simpleDialog('".cleanHtml($lang['survey_225'])." '+emailfld.value+'".cleanHtml($lang['period'])."','".cleanHtml($lang['survey_524'])."');
										}
									});
								}
							"), $lang['survey_180']) .
							($participant_email != '' ? '' :
								RCView::div(array('style'=>'color:#800000;font-size:11px;margin:5px 10px 0;'), '* '.$lang['survey_125'])
							)
						)
					)
				 );
		// If ajax call, then add a Close button to close the dialog
		if ($isAjax) {
			$html .= RCView::div(array('style'=>'text-align:right;background-color:#fff;padding:8px 15px;'),
						RCView::button(array('class'=>'jqbutton', 'onclick'=>"$('#survey_queue_corner_dialog').hide();$('#overlay').hide();"),
							RCView::span(array('style'=>'line-height:22px;margin:5px;color:#555;'), $lang['calendar_popup_01'])
						)
					 );
		}
		// If this is the Acknowledgement section of a survey (and not the Survey Queue page itself),
		// then change the URL to the survey queue link, in case they decide to bookmark the page.
		if ($isSurveyAcknowledgement && !$isAjax) {
			$html .=   "<script type='text/javascript'>
						modifyURL('$survey_queue_link');
						</script>";
		}
		// Return all html
		return RCView::div(array(), $html);
	}


	// Get the Survey Queue hash for this record. If doesn't exist yet, then generate it.
	// Use $hashExistsOveride=true to skip the initial check that the hash exists for this record if you know it does not.
	public static function getRecordSurveyQueueHash($record=null, $hashExistsOveride=false)
	{
		// Validate record name
		if ($record == '') return null;
		// Default value
		$hashExists = false;
		// Check if record already has a hash
		if (!$hashExistsOveride) {
			$sql = "select hash from redcap_surveys_queue_hashes where project_id = ".PROJECT_ID."
					and record = '".prep($record)."' limit 1";
			$q = db_query($sql);
			$hashExists = (db_num_rows($q) > 0);
		}
		// If hash exists, then get it from table
		if ($hashExists) {
			// Hash already exists
			$hash = db_result($q, 0);
		} else {
			// Hash does NOT exist, so generate a unique one
			do {
				// Generate a new random hash
				$hash = generateRandomHash(10);
				// Ensure that the hash doesn't already exist in either redcap_surveys or redcap_surveys_hash (both tables keep a hash value)
				$sql = "select hash from redcap_surveys_queue_hashes where hash = '$hash' limit 1";
				$hashExists = (db_num_rows(db_query($sql)) > 0);
			} while ($hashExists);
			// Add newly generated hash for record
			$sql = "insert into redcap_surveys_queue_hashes (project_id, record, hash)
					values (".PROJECT_ID.", '".prep($record)."', '$hash')";
			if (!db_query($sql) && $hashExistsOveride) {
				// The override failed, so apparently the hash DOES exist, so get it
				$hash = self::getRecordSurveyQueueHash($record);
			}
		}
		// Return the hash
		return $hash;
	}


	// Get the Survey Queue hash for LOTS of records in an array.
	// Return hashes as array values with record name as array key.
	public static function getRecordSurveyQueueHashBulk($records=array())
	{
		// Put hashes in array
		$hashes = array();
		// Get all existing hashes
		$sql = "select record, hash from redcap_surveys_queue_hashes where project_id = ".PROJECT_ID."
				and record in (".prep_implode($records).")";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$hashes[$row['record']] = $row['hash'];
		}
		// For those without a hash, go generate one
		foreach (array_diff($records, array_keys($hashes)) as $this_record) {
			if ($this_record == '') continue;
			$hashes[$this_record] = self::getRecordSurveyQueueHash($this_record);
		}
		// Order by record
		natcaseksort($hashes);
		// Return hashes
		return $hashes;
	}


	// Determine if this survey-event should be displayed in the Survey Queue for this record.
	// Parameter $completedSurveyEvents can be optionally passed, in which it contains the survey_id (first level key)
	// and event_id (second level key) of all completed survey responses for this record.
	public function checkConditionsOfRecordToDisplayInQueue($record, $queueItem, $completedSurveyEvents=null, $record_data=null, 
															$repeat_instance=1, $repeat_instrument=null)
	{		
		// If conditional upon survey completion, check if completed survey
		$conditionsPassedSurveyComplete = ($queueItem['condition_andor'] == 'AND'); // Initial true value if using AND (false if using OR)
		if (is_numeric($queueItem['condition_surveycomplete_survey_id']) && is_numeric($queueItem['condition_surveycomplete_event_id']))
		{
			// Is it a completed response?
			if (is_array($completedSurveyEvents)) {
				$conditionsPassedSurveyComplete = (isset($completedSurveyEvents[$queueItem['condition_surveycomplete_survey_id']][$queueItem['condition_surveycomplete_event_id']]));
			} else {
				$conditionsPassedSurveyComplete = isResponseCompleted($queueItem['condition_surveycomplete_survey_id'], $record, $queueItem['condition_surveycomplete_event_id'], $repeat_instance);
			}
			// If not listed as a completed response, then also check Form Status (if entered as plain record data instead of as response), just in case
			if (!$conditionsPassedSurveyComplete) {
				$conditionsPassedSurveyComplete = SurveyScheduler::isFormStatusCompleted($queueItem['condition_surveycomplete_survey_id'], $queueItem['condition_surveycomplete_event_id'], $record, $repeat_instance);
			}
		}
		// If conditional upon custom logic
		$conditionsPassedLogic = ($queueItem['condition_andor'] == 'AND'); // Initial true value if using AND (false if using OR)
		if ($queueItem['condition_logic'] != ''
			// If using AND and $conditionsPassedSurveyComplete is false, then no need to waste time checking evaluateLogicSingleRecord().
			// If using OR and $conditionsPassedSurveyComplete is true, then no need to waste time checking evaluateLogicSingleRecord().
			&& (($queueItem['condition_andor'] == 'OR' && !$conditionsPassedSurveyComplete)
				|| ($queueItem['condition_andor'] == 'AND' && $conditionsPassedSurveyComplete)))
		{
			// Does the logic evaluate as true?
			$conditionsPassedLogic = LogicTester::evaluateLogicSingleRecord($queueItem['condition_logic'], $record, $record_data, null, $repeat_instance, $repeat_instrument);
		}
		// Check pass/fail values and return boolean if record is ready to have its invitation for this survey/event
		if ($queueItem['condition_andor'] == 'OR') {
			// OR
			return ($conditionsPassedSurveyComplete || $conditionsPassedLogic);
		} else {
			// AND (default)
			return ($conditionsPassedSurveyComplete && $conditionsPassedLogic);
		}
	}

	// Validate and clean the survey queue hash, while also returning the record name to which it belongs
	public static function checkSurveyQueueHash($survey_queue_hash)
	{
		global $lang, $project_language;
		// Language: Call the correct language file for this project (default to English)
		if (empty($lang)) {
			$lang = Language::getLanguage($project_language);
		}
		// Trim hash, just in case
		$survey_queue_hash = trim($survey_queue_hash);
		// Ensure integrity of hash, and if extra characters have been added to hash somehow, chop them off.
		if (strlen($survey_queue_hash) > 10) {
			$survey_queue_hash = substr($survey_queue_hash, 0, 10);
		}
		// Check if hash is valid
		$sql = "select project_id, record from redcap_surveys_queue_hashes
				where hash = '".prep($survey_queue_hash)."' limit 1";
		$q = db_query($sql);
		$hashValid = (db_num_rows($q) > 0);
		// If the hash is valid, then return project_id and record, else stop and give error message
		if ($hashValid) {
			$row = db_fetch_assoc($q);
			return array($row['project_id'], $row['record']);
		} else {
			exitSurvey($lang['survey_508'], true, $lang['survey_509']);
		}
	}


	// Validate and clean the survey hash, while also returning if a legacy hash
	public static function checkSurveyHash()
	{
		global $lang, $project_language;
		// Obtain hash from GET or POST
		$hash = isset($_GET['s']) ? $_GET['s'] : (isset($_POST['s']) ? $_POST['s'] : "");
		// If could not find hash, try as legacy hash
		if (empty($hash)) {
			$hash = isset($_GET['hash']) ? $_GET['hash'] : (isset($_POST['hash']) ? $_POST['hash'] : "");
		}
		// Trim hash, just in case
		$hash = trim($hash);
		// Language: Call the correct language file for this project (default to English)
		if (empty($lang)) {
			$lang = Language::getLanguage($project_language);
		}
		// Ensure integrity of hash, and if extra characters have been added to hash somehow, chop them off.
		$hash_length = strlen($hash);
		if ($hash_length >= 4 && $hash_length <= 10 && preg_match("/([A-Za-z0-9])/", $hash)) {
			$legacy = false;
		} elseif ($hash_length > 10 && strlen($hash) < 32 && preg_match("/([A-Za-z0-9])/", $hash)) {
			$hash = substr($hash, 0, 10);
			$legacy = false;
		} elseif ($hash_length == 32 && preg_match("/([a-z0-9])/", $hash)) {
			$legacy = true;
		} elseif ($hash_length > 32 && preg_match("/([a-z0-9])/", $hash)) {
			$hash = substr($hash, 0, 32);
			$legacy = true;
		} elseif (empty($hash)) {
			exitSurvey("{$lang['survey_11']}
						<a href='javascript:;' style='font-size:16px;color:#800000;' onclick=\"
							window.location.href = app_path_webroot+'Surveys/create_survey.php?pid='+getParameterByName('pid',true)+'&view=showform';
						\">{$lang['survey_12']}</a> {$lang['survey_13']}");
		} else {
			exitSurvey($lang['survey_14']);
		}
		// If legacy hash, then retrieve newer hash to return
		if ($legacy)
		{
			$q = db_query("select hash from redcap_surveys_participants where legacy_hash = '$hash'");
			if (db_num_rows($q) > 0) {
				$hash = db_result($q, 0);
			} else {
				exitSurvey($lang['survey_14']);
			}
		}
		// Return hash
		return $hash;
	}


	// Repeating forms/events: Obtain the instance number of a given participant_id in participants table
	// (assuming this is NOT a public survey). Return default of '1' if no rows returned.
	public static function getInstanceNumFromParticipantId($participant_id)
	{
		// Ensure that hash exists. Retrieve ALL survey-related info and make all table fields into global variables
		$sql = "select r.instance from redcap_surveys_response r, redcap_surveys_participants p 
				where p.participant_id = '".prep($participant_id)."' and p.participant_id = r.participant_id 
				and p.participant_email is not null limit 1";
		$q = db_query($sql);
		return db_num_rows($q) ? db_result($q, 0) : '1';
	}
	

	// Pull survey values from tables and set as global variables
	public static function setSurveyVals($hash)
	{
		global $lang;
		// Ensure that hash exists. Retrieve ALL survey-related info and make all table fields into global variables
		$sql = "select * from redcap_surveys s, redcap_surveys_participants h where h.hash = '".prep($hash)."'
				and s.survey_id = h.survey_id limit 1";
		$q = db_query($sql);
		if (!$q || !db_num_rows($q)) {
			exitSurvey($lang['survey_14']);
		}
		foreach (db_fetch_assoc($q) as $key => $value)
		{
			if ($value === null) {
				$GLOBALS[$key] = $value;
			} else {
				// Replace non-break spaces because they cause issues with html_entity_decode()
				$value = str_replace(array("&amp;nbsp;", "&nbsp;"), array(" ", " "), $value);
				// Don't decode if cannnot detect encoding
				if (function_exists('mb_detect_encoding') && (
					(mb_detect_encoding($value) == 'UTF-8' && mb_detect_encoding(html_entity_decode($value, ENT_QUOTES)) === false)
					|| (mb_detect_encoding($value) == 'ASCII' && mb_detect_encoding(html_entity_decode($value, ENT_QUOTES)) === 'UTF-8')
				)) {
					$GLOBALS[$key] = trim($value);
				} else {
					$GLOBALS[$key] = trim(html_entity_decode($value, ENT_QUOTES));
				}
			}
		}
	}


	// Returns array of emails, identifiers, phone numbers, and delivery preference for a list of records
	public static function getResponsesEmailsIdentifiers($records=array())
	{
		global $Proj, $survey_email_participant_field, $survey_phone_participant_field, $twilio_enabled;

		// If pass in empty array of records, pass back empty array
		if (empty($records)) return array();

		// Get the first event_id of every Arm and place in array
		$firstEventIds = array();
		foreach ($Proj->events as $this_arm_num=>$arm_attr) {
			$arm_events_keys = array_keys($arm_attr['events']);
			$firstEventIds[] = print_r(array_shift($arm_events_keys), true);
		}

		// Create an array to return with participant_id as key and attributes as subarray
		$responseAttributes = array();
		// Pre-fill with all records passed in first
		foreach ($records as $record) {
			if ($record == '') continue;
			$responseAttributes[label_decode($record)] = array('email'=>'', 'identifier'=>'',
															   'phone'=>'', 'delivery_preference'=>'EMAIL');
		}

		## GET EMAILS FROM INITIAL SURVEY'S PARTICIPANT LIST (if there is an initial survey)
		if ($Proj->firstFormSurveyId != null)
		{
			// Create record list to query participant table. Escape the record names for the query.
			$partRecordsSql = array();
			foreach ($records as $record) {
				if ($record == '') continue;
				$partRecordsSql[] = label_decode($record);
			}
			// Now use that record list to get the original email from first survey's participant list
			$sql = "select r.record, p.participant_email, p.participant_identifier, p.participant_phone, p.delivery_preference
					from redcap_surveys_participants p, redcap_surveys_response r, redcap_surveys s
					where s.project_id = ".PROJECT_ID." and p.survey_id = s.survey_id and p.participant_id = r.participant_id
					and r.record in (".prep_implode($partRecordsSql).") and s.form_name = '".$Proj->firstForm."'
					and p.event_id in (".prep_implode($firstEventIds).") and p.participant_email is not null";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q)) {
				$row['record'] = label_decode($row['record']);
				if ($row['participant_email'] != '') {
					$responseAttributes[$row['record']]['email'] = label_decode($row['participant_email']);
				}
				if ($row['participant_identifier'] != '') {
					$responseAttributes[$row['record']]['identifier'] = strip_tags(label_decode($row['participant_identifier']));
				}
				if ($row['participant_phone'] != '') {
					$responseAttributes[$row['record']]['phone'] = $row['participant_phone'];
				}
				if ($row['delivery_preference'] != '') {
					$responseAttributes[$row['record']]['delivery_preference'] = $row['delivery_preference'];
				}
			}
		}
		// If using Twilio and first instrument is not a survey, then re-check (and possibly fix) delivery pref
		// (since it is set for EACH participant_id, which can have different values)
		elseif ($Proj->firstFormSurveyId == null && $twilio_enabled)
		{
			// Create record list to query participant table. Escape the record names for the query.
			$partRecordsSql = array();
			foreach ($records as $record) {
				if ($record == '') continue;
				$partRecordsSql[] = label_decode($record);
			}
			// Obtain delivery pref for records in case they are out of sync and incorrect
			$sql = "select r.record, p.participant_id, p.delivery_preference
					from redcap_surveys_participants p, redcap_surveys_response r, redcap_surveys s
					where s.project_id = ".PROJECT_ID." and p.survey_id = s.survey_id and p.participant_id = r.participant_id
					and r.record in (".prep_implode($partRecordsSql).") and s.form_name != '".$Proj->firstForm."'
					and p.participant_email is not null";
			$q = db_query($sql);
			$blankDelivPref = $changeDelivPref = array();
			while ($row = db_fetch_assoc($q)) {
				$row['record'] = label_decode($row['record']);
				if ($row['delivery_preference'] != '' && $row['delivery_preference'] != 'EMAIL') {
					$responseAttributes[$row['record']]['delivery_preference'] = $row['delivery_preference'];
					$changeDelivPref[$row['record']] = $row['delivery_preference'];
				} elseif ($row['delivery_preference'] == '') {
					$blankDelivPref[$row['record']][] = $row['participant_id'];
				}
			}
			// Loop through participants where we need to retroactively fix their delivery pref
			foreach ($blankDelivPref as $this_record=>$participant_ids) {
				if (isset($changeDelivPref[$this_record])) {
					// Change their preference in the participants table
					$sql = "update redcap_surveys_participants set delivery_preference = '".prep($changeDelivPref[$this_record])."'
							where participant_id in (".prep_implode($participant_ids).")";
					$q = db_query($sql);
				}
			}

		}

		## GET ANY REMAINING MISSING EMAILS FROM SPECIAL EMAIL FIELD IN REDCAP_PROJECTS TABLE
		if ($survey_email_participant_field != '')
		{
			// Create record list of responses w/o emails to query data table. Escape the record names for the query.
			$partRecordsSql = array();
			foreach ($responseAttributes as $record=>$attr) {
				$partRecordsSql[] = label_decode($record);
			}
			// Now use that record list to get the email value from the data table
			$sql = "select record, value from redcap_data where project_id = ".PROJECT_ID."
					and field_name = '".prep($survey_email_participant_field)."'
					and record in (".prep_implode($partRecordsSql).")";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q)) {
				// Skip if blank
				if ($row['value'] == '') continue;
				// Trim and decode, just in case
				$email = trim(label_decode($row['value']));
				// Don't use it unless it's a valid email address
				if (isEmail($email)) {
					$responseAttributes[label_decode($row['record'])]['email'] = $email;
				}
			}
		}

		## GET ANY REMAINING MISSING PHONE NUMBERS FROM SPECIAL PHONE FIELD IN REDCAP_PROJECTS TABLE
		if ($survey_phone_participant_field != '')
		{
			// Create record list of responses w/o emails to query data table. Escape the record names for the query.
			$partRecordsSql = array();
			foreach ($responseAttributes as $record=>$attr) {
				if ($attr['phone'] != '') continue;
				$partRecordsSql[] = label_decode($record);
			}
			// Now use that record list to get the phone value from the data table
			$sql = "select record, value from redcap_data where project_id = ".PROJECT_ID."
					and field_name = '".prep($survey_phone_participant_field)."'
					and record in (".prep_implode($partRecordsSql).") and value != ''";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q)) {
				$phone = preg_replace("/[^0-9]/", "", label_decode($row['value']));
				// Don't use it unless it's a valid phone number
				if ($phone != '') {
					$responseAttributes[label_decode($row['record'])]['phone'] = $phone;
				}
			}
		}

		// Return array
		return $responseAttributes;
	}


	// Display the Survey Queue setup table in HTML table format
	public static function displaySurveyQueueSetupTable()
	{
		global $lang, $longitudinal, $Proj, $survey_queue_custom_text;

		// Get this project's currently saved queue
		$projectSurveyQueue = self::getProjectSurveyQueue(false);

		// Create list of all surveys/event instances as array to use for looping below and also to feed a drop-down
		$surveyEvents = array();
		$surveyDD = array(''=>'--- '.$lang['survey_404'].' ---');
		// Loop through all events (even for classic)
		foreach ($Proj->eventsForms as $this_event_id=>$forms)
		{
			// Go through each form and see if it's a survey
			foreach ($forms as $form)
			{
				// Get survey_id
				$this_survey_id = isset($Proj->forms[$form]['survey_id']) ? $Proj->forms[$form]['survey_id'] : null;
				// Only display surveys, so ignore if does not have survey_id
				if (!is_numeric($this_survey_id)) continue;
				// Add form, event_id, and survey_id to drop-down array
				$title = $Proj->surveys[$this_survey_id]['title'];
				$event = $Proj->eventInfo[$this_event_id]['name_ext'];
				// Don't add this current survey-event option to drop-down (would create infinite loop)
				if (!(isset($survey_id) && $survey_id == $this_survey_id && $this_event_id == $event_id)) {
					// If has no survey title, then substitute it with form label
					if (trim($title) == '') $title = $Proj->forms[$form]['menu'];
					// Add survey to array
					$surveyDD["$this_survey_id-$this_event_id"] = "\"$title\"" . ($longitudinal ? " - $event" : "");
				}
				// Add values to array
				$surveyEvents[] = array('event_id'=>$this_event_id, 'event_name'=>$event, 'form'=>$form,
										'survey_id'=>$this_survey_id, 'survey_title'=>$title);
			}
		}
		// Loop through surveys-events
		$hdrs = RCView::tr(array(),
					RCView::td(array('class'=>'header', 'style'=>'width:75px;text-align:center;font-size:11px;'), $lang['survey_430']) .
					RCView::td(array('class'=>'header'), $lang['survey_49']) .
					RCView::td(array('class'=>'header', 'style'=>'width:400px;'), $lang['survey_526']) .
					RCView::td(array('class'=>'header', 'style'=>'width:34px;text-align:center;font-size:11px;line-height:13px;'), $lang['survey_529'])
				);
		$rows = '';
		foreach ($Proj->eventsForms as $event_id=>$these_forms) {
			// Loop through forms
			$alreadyDisplayedEventHdr = false;
			foreach ($these_forms as $form_name) {
				// If form is not enabled as a survey, then skip it
				if (!isset($Proj->forms[$form_name]['survey_id'])) continue;
				// Get survey_id
				$survey_id = $Proj->forms[$form_name]['survey_id'];
				// Skip the first instrument survey since it is naturally not included in the queue till after it is completed
				if ($survey_id == $Proj->firstFormSurveyId) continue;
				// If longitudinal, display Event Name as header
				if ($longitudinal && !$alreadyDisplayedEventHdr) {
					$rows .= RCView::tr(array(),
								RCView::td(array('class'=>'header blue', 'colspan'=>'4', 'style'=>'padding:3px 6px;font-weight:bold;'),
									$Proj->eventInfo[$event_id]['name_ext']
								)
							);
					$alreadyDisplayedEventHdr = true;
				}
				// Set form+event+arm label
				$form_event_label = $Proj->forms[$form_name]['menu'] . (!$longitudinal ? '' : " (" . $Proj->eventInfo[$event_id]['name_ext'] . ")");
				// Get any saved attributes for this survey/event
				if (isset($projectSurveyQueue[$survey_id][$event_id])) {
					$queue_item = $projectSurveyQueue[$survey_id][$event_id];
					$conditionSurveyActivatedChecked = ($queue_item['active']) ? 'checked' : '';
					$conditionSurveyActivatedDisabled = '';
					$conditionSurveyCompChecked = (is_numeric($queue_item['condition_surveycomplete_survey_id']) && is_numeric($queue_item['condition_surveycomplete_event_id'])) ? 'checked' : '';
					$conditionSurveyCompSelected = (is_numeric($queue_item['condition_surveycomplete_survey_id']) && is_numeric($queue_item['condition_surveycomplete_event_id'])) ? $queue_item['condition_surveycomplete_survey_id'].'-'.$queue_item['condition_surveycomplete_event_id'] : '';
					$conditionAndOr = ($queue_item['condition_andor'] == 'OR') ? 'OR' : 'AND';
					$conditionLogicChecked = (trim($queue_item['condition_logic']) == '') ? '' : 'checked';
					$conditionLogic = $queue_item['condition_logic'];
					$conditionAutoStartChecked = ($queue_item['auto_start']) ? 'checked' : '';
					$queue_item_class = $queue_item_class_firstcell = 'darkgreen';
					$queue_item_active_flag = 'active';
					$queue_item_active_flag_value = '1';
					$queue_item_icon_enabled_style = '';
					$queue_item_icon_disabled_style = 'display:none;';
				} else {
					$conditionSurveyActivatedChecked = $conditionSurveyCompChecked = $conditionSurveyCompSelected = '';
					$conditionAndOr = $conditionLogicChecked = $conditionLogic = $conditionAutoStartChecked = '';
					$queue_item_class_firstcell = $queue_item_active_flag = $queue_item_active_flag_value = '';
					$queue_item_class = 'opacity35';
					$queue_item_icon_enabled_style = 'display:none;';
					$queue_item_icon_disabled_style = '';
					$conditionSurveyActivatedDisabled = 'disabled';
				}
				// Set survey title for this row
				$title = $Proj->surveys[$survey_id]['title'];
				// If has no survey title, then substitute it with form label
				if (trim($title) == '') $title = $Proj->forms[$form_name]['menu'];
				// Render row
				$rows .= RCView::tr(array('id'=>"sqtr-$survey_id-$event_id", $queue_item_active_flag=>$queue_item_active_flag_value),
							RCView::td(array('class'=>"data $queue_item_class_firstcell", 'valign'=>'top', 'style'=>'text-align:center;padding:6px;padding-top:10px;'),
								// "Enabled" text/icon
								RCView::div(array('id'=>"div_sq_icon_enabled-$survey_id-$event_id", 'style'=>$queue_item_icon_enabled_style),
									RCView::img(array('src'=>'checkbox_checked.png')) .
									RCView::div(array('style'=>'color:green;'), $lang['survey_544']) .
									RCView::div(array('style'=>'padding:20px 0 0;'),
										RCView::button(array('class'=>'jqbuttonsm', 'style'=>'font-size:9px;font-family:tahoma;',
											'onclick'=>"surveyQueueSetupActivate(0, $survey_id, $event_id);return false;"),
											$lang['survey_546']
										)
									)
								) .
								// "Not enabled" text/icon
								RCView::div(array('id'=>"div_sq_icon_disabled-$survey_id-$event_id", 'style'=>$queue_item_icon_disabled_style),
									RCView::img(array('src'=>'checkbox_cross.png')) .
									RCView::div(array('style'=>'color:#F47F6C;'), $lang['survey_543']) .
									RCView::div(array('style'=>'padding:20px 0 0;'),
										RCView::button(array('class'=>'jqbuttonsm', 'style'=>'font-size:9px;font-family:tahoma;',
											'onclick'=>"surveyQueueSetupActivate(1, $survey_id, $event_id);return false;"),
											$lang['survey_547']
										)
									)
								) .
								// Hidden checkbox to denote activation
								RCView::checkbox(array('name'=>"sqactive-$survey_id-$event_id", 'id'=>"sqactive-$survey_id-$event_id", 'class'=>'hidden', $conditionSurveyActivatedChecked=>$conditionSurveyActivatedChecked))
							) .
							RCView::td(array('class'=>"data $queue_item_class_firstcell", 'style'=>'padding:6px;', 'valign'=>'top'),
								RCView::div(array('style'=>'padding:3px 8px 8px 2px;font-size:13px;'),
									// Survey title
									RCView::span(array('style'=>'font-size:13px;'),
										'"'.RCView::b(RCView::escape($title)).'"'
									) .
									// Event name (if longitudinal)
									(!$longitudinal ? '' :
										RCView::span(array(),
											" &nbsp;-&nbsp; ".RCView::escape($Proj->eventInfo[$event_id]['name_ext'])
										)
									)
								)
							) .
							RCView::td(array('class'=>"data $queue_item_class", 'style'=>'padding:6px 6px 3px;font-size:12px;'),
								// When survey is completed
								RCView::div(array('style'=>'text-indent:-1.9em;margin-left:1.9em;padding:1px 0;'),
									RCView::checkbox(array('name'=>"sqcondoption-surveycomplete-$survey_id-$event_id",'id'=>"sqcondoption-surveycomplete-$survey_id-$event_id",$conditionSurveyCompChecked=>$conditionSurveyCompChecked, $conditionSurveyActivatedDisabled=>$conditionSurveyActivatedDisabled)) .
									$lang['survey_419'] .
									RCView::br() .
									// Drop-down of surveys/events
									RCView::select(array('name'=>"sqcondoption-surveycompleteids-$survey_id-$event_id",'id'=>"sqcondoption-surveycompleteids-$survey_id-$event_id",'class'=>'x-form-text x-form-field','style'=>'font-size:11px;width:100%;max-width:360px;', $conditionSurveyActivatedDisabled=>$conditionSurveyActivatedDisabled,
										'onchange'=>"$('#sqcondoption-surveycomplete-$survey_id-$event_id').prop('checked', (this.value.length > 0) );  if (this.value.length > 0) hasDependentSurveyEvent(this);"), $surveyDD, $conditionSurveyCompSelected, 200)
								) .
								// AND/OR drop-down list for conditions
								RCView::div(array('style'=>'padding:2px 0 1px;'),
									RCView::select(array('name'=>"sqcondoption-andor-$survey_id-$event_id",'id'=>"sqcondoption-andor-$survey_id-$event_id",'style'=>'font-size:11px;', $conditionSurveyActivatedDisabled=>$conditionSurveyActivatedDisabled), array('AND'=>$lang['global_87'],'OR'=>$lang['global_46']), $conditionAndOr)
								) .
								// When logic becomes true
								RCView::div(array('style'=>'text-indent:-1.9em;margin-left:1.9em;'),
									RCView::checkbox(array('name'=>"sqcondoption-logic-$survey_id-$event_id",'id'=>"sqcondoption-logic-$survey_id-$event_id",$conditionLogicChecked=>$conditionLogicChecked, $conditionSurveyActivatedDisabled=>$conditionSurveyActivatedDisabled)) .
									$lang['survey_420'] .
									RCView::a(array('href'=>'javascript:;','class'=>'opacity65','style'=>'margin-left:50px;text-decoration:underline;font-size:10px;','onclick'=>"helpPopup('ss69')"), $lang['survey_527']) .
									RCView::br() .
									RCView::textarea(array('name'=>"sqcondlogic-$survey_id-$event_id",'id'=>"sqcondlogic-$survey_id-$event_id",'class'=>'x-form-field', 'style'=>'line-height:12px;font-size:11px;width:100%;max-width:350px;height:32px;','onkeydown' => 'logicSuggestSearchTip(this, event);', 'onblur'=>"var val = this; setTimeout(function() { logicHideSearchTip(val); this.value=trim(val.value); if(val.value.length > 0) { $('#sqcondoption-logic-$survey_id-$event_id').prop('checked',true); } if(!checkLogicErrors(val.value,1,true)){validate_auto_invite_logic($(val));} }, 0);"), $conditionLogic) .
                                                                        logicAdd("sqcondlogic-$survey_id-$event_id") .
									RCView::br() .
									RCView::span(array('style'=>'font-family:tahoma;font-size:10px;color:#888;'),
										($longitudinal ? "(e.g., [enrollment_arm_1][age] > 30 and [enrollment_arm_1][gender] = \"1\")" : "(e.g., [age] > 30 and [gender] = \"1\")") .
									RCView::br() .
									RCView::table(array('style'=>'padding: 0px; border: 0; font-size: 12px; margin-left: 25px; margin-right: 15px; width: 310px'),
										RCView::tr(array('style'=>'padding: 0px; border: 0;'),
											RCView::td(array('style' => 'color: green; font-weight: bold; padding: 0px; text-align: left; vertical-align: middle; border: 0; height: 20px;', 'id' => "sqcondlogic-$survey_id-$event_id"."_Ok"), "&nbsp;")
										) .
										RCView::tr(array('style'=>'padding: 0px; border: 0;'),
											RCView::td(array('style'=>'border: 0; padding: 0px; text-align: left;'),
												"<span class='logicTesterRecordDropdownLabel'>{$lang['design_705']}</span> ".
												RCView::select(array('id'=>'logicTesterRecordDropdown','onchange'=>'var circle="'.APP_PATH_IMAGES.'progress_circle.gif"; if (this.value !== "") $("#sqcondlogic-'.$survey_id.'-'.$event_id.'_res").html("<img src="+circle+">"); else $("#sqcondlogic-'.$survey_id.'-'.$event_id.'_res").html(""); logicCheck($("#sqcondlogic-'.$survey_id.'-'.$event_id.'"), "branching", '.($longitudinal ? 'true' : 'false').', "", this.value, "'.cleanHtml2($lang['design_706']).'", "'.cleanHtml2($lang['design_707']).'", "'.cleanHtml2($lang['design_713']).'", ["'.cleanHtml2($lang['design_714']).'", "'.cleanHtml2($lang['design_715']).'", "'.cleanHtml2($lang['design_708']).'"], "sqcondlogic-'.$survey_id.'-'.$event_id.'");'), Records::getRecordsAsArray($Proj->project_id))
											)
										) .
										RCView::tr(array('style'=>'padding: 0px; border: 0;'),
											RCView::td(array('style'=>'border: 0; padding: 0px; text-align: left;'), 
												RCView::span(array('id' => "sqcondlogic-".$survey_id."-".$event_id."_res", 'style' => 'color: green; font-weight: bold;'), "")
											)
										)
									)

									)
								)
							) .
							RCView::td(array('class'=>"data $queue_item_class", 'valign'=>'top', 'style'=>'text-align:center;padding:6px;padding-top:10px;'),
								// Auto start?
								RCView::checkbox(array('name'=>"ssautostart-$survey_id-$event_id", 'id'=>"ssautostart-$survey_id-$event_id", $conditionAutoStartChecked=>$conditionAutoStartChecked, $conditionSurveyActivatedDisabled=>$conditionSurveyActivatedDisabled))
							)
						);
			}
		}

		// HTML
		$html = '';

		// Instructions
		$html .= RCView::div(array('style'=>'margin:0 0 5px;'.($Proj->firstFormSurveyId != null ? '' : 'margin-bottom:20px;')),
					$lang['survey_531'] . " " .
					RCView::a(array('href'=>'javascript:;', 'style'=>'text-decoration:underline;', 'onclick'=>"$(this).hide();$('#survey_queue_form_hidden_instr').show();fitDialog($('#surveyQueueSetupDialog'));"),
						$lang['global_58']) .
					RCView::span(array('id'=>'survey_queue_form_hidden_instr', 'style'=>'display:none;'),
						$lang['survey_542'])
				);

		// If custom text already exists, then display it's textarea box
		$survey_queue_custom_text_style = ($survey_queue_custom_text == '') ? 'display:none;' : '';
		$survey_queue_custom_text_add_style = ($survey_queue_custom_text == '') ? '' : 'display:none;';

		// If the first instrument is a survey, explain to user why it's not displayed here
		if ($Proj->firstFormSurveyId != null) {
			$html .= RCView::div(array('style'=>'margin:0 0 20px;font-size:11px;color:#777;'),
						$lang['survey_530']
					);
		}

		// Add table/form html if there is something to display
		if (strlen($rows) > 0)
		{
			// Add table/form html
			$html .= "<form id='survey_queue_form'>" .
						// Header
						RCView::div(array('id'=>'div_survey_queue_custom_text_link', 'style'=>'padding:0 0 20px 4px;'.$survey_queue_custom_text_add_style),
							RCView::img(array('src'=>'add.png')) .
							RCView::a(array('href'=>'javascript:;', 'style'=>'text-decoration:underline;color:green;', 'onclick'=>"$('#div_survey_queue_custom_text_link').hide();$('#div_survey_queue_custom_text').show('fade');"),
								$lang['survey_541']
							)
						) .
						// Custom text (optional)
						RCView::div(array('id'=>'div_survey_queue_custom_text', 'class'=>'data', 'style'=>'padding:8px 8px 4px;margin:0 0 15px;'.$survey_queue_custom_text_style),
							RCView::div(array('style'=>'margin:0 0 5px;font-weight:bold;'),
								$lang['survey_537'] . ' &#8211; ' .
								RCView::span(array('style'=>'font-weight:normal;'),
									$lang['survey_538'] . " " .
									RCView::a(array('href'=>'javascript:;', 'style'=>'text-decoration:underline;',
										'onclick'=>"simpleDialog('".cleanHtml("\"{$lang['survey_506']} {$lang['survey_511']}\"")."','".cleanHtml("{$lang['survey_538']} {$lang['survey_539']} {$lang['survey_540']}")."',null,600);"), $lang['survey_539']) . " " .
									$lang['survey_540'] .
									RCView::a(array('href'=>'javascript:;', 'style'=>'margin-left:40px;font-family:tahoma;font-size:11px;color:#888;', 'onclick'=>"$('#div_survey_queue_custom_text_link').show('fade');$('#div_survey_queue_custom_text').hide();$('#survey_queue_custom_text').val('');"),
										'['.$lang['ws_144'].']'
									)
								)
							) .
							RCView::div(array(),
								RCView::textarea(array('name'=>"survey_queue_custom_text",'id'=>"survey_queue_custom_text",'class'=>'x-form-field', 'style'=>'line-height:13px;font-size:12px;width:98%;height:38px;'),
									$survey_queue_custom_text
								) .
								RCView::div(array('style'=>'float:right;margin:0 10px 0 20px;'),
									RCView::img(array('src'=>'pipe_small.gif')) .
									RCView::a(array('href'=>'javascript:;', 'style'=>'font-size:11px;color:#3E72A8;text-decoration:underline;', 'onclick'=>"pipingExplanation();"),
										$lang['design_456']
									)
								) .
								RCView::div(array('style'=>'float:right;color:#777;font-size:11px;'),
									$lang['survey_554'] .
									' &lt;b&gt; bold, &lt;u&gt; underline, &lt;i&gt; italics, &lt;a href="..."&gt; link, etc.'
								) .
								RCView::div(array('class'=>'clear'), '')
							)
						) .
						// Table of surveys
						"<table cellspacing=0 class='form_border' style='width:100%;table-layout:fixed;'>{$hdrs}{$rows}</table>" .
					"</form>";
		} else {
			// No rows to display, so give notice that they can't use the Survey Queue yet
			$html .= 	RCView::div(array('class'=>'yellow', 'style'=>'max-width:100%;margin:20px 0;'),
							RCView::img(array('src'=>'exclamation_orange.png')) .
							RCView::b($lang['global_03'].$lang['colon'])." ".$lang['survey_552']
						);
		}

		// Return all html to display
		return $html;
	}


	// Obtain the survey hash for array of participant_id's
	public static function getParticipantHashes($participant_id=array())
	{
		// Collect hashes in array with particpant_id as key
		$hashes = array();
		// Retrieve hashes
		$sql = "select participant_id, hash from redcap_surveys_participants
				where participant_id in (".prep_implode($participant_id, false).")";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$hashes[$row['participant_id']] = $row['hash'];
		}
		// Return hashes
		return $hashes;
	}

	// Create a new survey participant for followup survey (email will be '' and not null)
	// Return participant_id (set $forceInsert=true to bypass the Select query if we already know it doesn't exist yet)
	public static function getFollowupSurveyParticipantIdHash($survey_id, $record, $event_id=null, $forceInsert=false, $instance=null)
	{
		global $twilio_enabled, $twilio_default_delivery_preference;
		// Make sure record isn't blank
		if ($record == '') return false;
		// Check event_id
		if (!is_numeric($event_id)) return false;
		// Set $instance
		$instance = is_numeric($instance) ? (int)$instance : 1;
		// Set flag to perform the insert query
		if ($forceInsert) {
			$doInsert = true;
		}
		// Check if participant_id for this event-record-survey exists yet
		else {
			$sql = "select p.participant_id, p.hash from redcap_surveys_participants p, redcap_surveys_response r
					where p.survey_id = $survey_id and p.participant_id = r.participant_id
					and p.event_id = $event_id and p.participant_email is not null
					and r.record = '".prep($record)."' and r.instance = $instance limit 1";
			$q = db_query($sql);
			// If participant_id exists, then return it
			if (db_num_rows($q) > 0) {
				$participant_id = db_result($q, 0, 'participant_id');
				$hash = db_result($q, 0, 'hash');
			} else {
				$doInsert = true;
			}
		}
		// Create placeholder in participants and response tables
		if (isset($doInsert) && $doInsert) {
			// Generate random hash
			$hash = self::getUniqueHash();
			// If participant has a non-NULL delivery preference already, then find it to use in teh Insert query below
			$sql = "select p.delivery_preference from redcap_surveys_participants p, redcap_surveys_response r
					where p.participant_id = r.participant_id and p.participant_email is not null
					and r.record = '".prep($record)."' and r.instance = $instance 
					and p.survey_id in (select s2.survey_id from redcap_surveys s left join redcap_surveys s2
					on s.project_id = s2.project_id where s.survey_id = $survey_id) order by p.delivery_preference desc";
			$q = db_query($sql);
			if (db_num_rows($q) > 0) {
				// Get first non-null preference
				$delivery_preference = db_result($q, 0);
			} elseif (isset($twilio_enabled) && $twilio_enabled == '1' && $twilio_default_delivery_preference != '') {
				// No rows exist for this record yet in this project, so add the default deliver pref if using Twilio
				$delivery_preference = $twilio_default_delivery_preference;
			} else {
				// Default null
				$delivery_preference = '';
			}
			// Since participant_id does NOT exist yet, create it.
			$sql = "insert into redcap_surveys_participants (survey_id, event_id, participant_email, participant_identifier, hash, delivery_preference)
					values ($survey_id, $event_id, '', null, '$hash', ".checkNull($delivery_preference).")";
			if (!db_query($sql)) return false;
			$participant_id = db_insert_id();
			// Now place empty record in surveys_responses table to complete this process (sets first_submit_time as NULL - very crucial for followup)
			$sql = "insert into redcap_surveys_response (participant_id, record, instance) values ($participant_id, '".prep($record)."', $instance)";
			if (!db_query($sql)) {
				// If query failed (likely to the fact that it already exists, which it shouldn't), then undo
				db_query("delete from redcap_surveys_participants where participant_id = $participant_id");
				// If $forceInsert flag was to true, then try with it set to false (in case there was a mistaken determining that this placeholder existed already)
				if (!$forceInsert) {
					return false;
				} else {
					// Run recursively with $forceInsert=false
					return self::getFollowupSurveyParticipantIdHash($survey_id, $record, $event_id, false, $instance);
				}
			}
			## CHECK FOR RACE CONDITION
			// Now make sure that we didn't somehow end up with duplicate rows in participants table (due to race conditions)
			$sql = "select p.participant_id from redcap_surveys_participants p, redcap_surveys_response r
					where p.participant_id = r.participant_id and p.survey_id = $survey_id and p.participant_email is not null
					and p.event_id = $event_id and r.record = '".prep($record)."' and r.instance = $instance order by p.participant_id";
			$q = db_query($sql);
			if (db_num_rows($q) > 1) {
				// Delete all rows except one
				$del_parts = array();
				while ($row = db_fetch_assoc($q)) {
					$del_parts[] = $row['participant_id'];
				}
				// Remove the first one (because we don't want to delete the original participant_id)
				$participant_id = array_shift($del_parts);
				$sql = "delete from redcap_surveys_participants where participant_id in (" . prep_implode($del_parts) . ")";
				db_query($sql);
				// Get new hash for this new participant_id
				$sql = "select hash from redcap_surveys_participants where participant_id = $participant_id";
				$q = db_query($sql);
				$hash = db_result($q, 0);
			}
		}
		// Return nothing if could not store hash
		return array($participant_id, $hash);
	}

	// Creates unique return_code (that is, unique within that survey) and returns that value
	public static function getUniqueReturnCode($survey_id=null, $response_id=null)
	{
		// Make sure we have a survey_id value
		if (!is_numeric($survey_id)) return false;
		// If response_id is provided, then fetch existing return code. If doesn't have a return code, then generate one.
		if (is_numeric($response_id))
		{
			// Query to get existing return code
			$sql = "select r.return_code from redcap_surveys_participants p, redcap_surveys_response r
					where p.survey_id = $survey_id and r.response_id = $response_id
					and p.participant_id = r.participant_id limit 1";
			$q = db_query($sql);
			$existingCode = (db_num_rows($q) > 0) ? db_result($q, 0) : "";
			if ($existingCode != "") {
				return strtoupper($existingCode);
			}
		}
		// Generate a new unique return code for this survey (keep looping till we get a non-existing unique value)
		do {
			// Generate a new random hash
			$code = strtolower(generateRandomHash(8, false, true));
			// Ensure that the hash doesn't already exist
			$sql = "select r.return_code from redcap_surveys_participants p, redcap_surveys_response r
					where p.survey_id = $survey_id and r.return_code = '$code'
					and p.participant_id = r.participant_id limit 1";
			$q = db_query($sql);
			$codeExists = (db_num_rows($q) > 0);
		}
		while ($codeExists);
		// If the response_id provided does not have an existing code, then save the new one we just generated
		if (is_numeric($response_id) && $existingCode == "")
		{
			$sql = "update redcap_surveys_response set return_code = '$code' where response_id = $response_id";
			$q = db_query($sql);
		}
		// Code is unique, so return it
		return strtoupper($code);
	}


	// Obtain survey return code for record-instrument[-event]
	public static function getSurveyReturnCode($record='', $instrument='', $event_id='', $instance=1)
	{
		global $longitudinal, $Proj;
		// Return NULL if no record name or not instrument name
		if ($record == '' || $instrument == '') return null;
		// If a longitudinal project and no event_id is provided, return null
		if ($longitudinal && !is_numeric($event_id)) return null;
		// If a non-longitudinal project, then set event_id automatically
		if (!$longitudinal) $event_id = $Proj->firstEventId;
		// If instrument is not a survey, return null
		if (!isset($Proj->forms[$instrument]['survey_id'])) return null;
		// Get survey_id
		$survey_id = $Proj->forms[$instrument]['survey_id'];
		// If "Save & Return Later" is not enabled, then return null
		if (!$Proj->surveys[$survey_id]['save_and_return'] && !self::surveyLoginEnabled()) return null;
		// If instance is provided for a non-repeating form or event, then revert to 1
		if (!is_numeric($instance)) $instance = 1;
		if (!$Proj->isRepeatingForm($event_id, $instrument) && !($Proj->longitudinal && $Proj->isRepeatingEvent($event_id))) {
			$instance = 1;
		}
		// Check if return code exists already
		$sql = "select r.response_id, r.return_code from redcap_surveys_participants p, redcap_surveys_response r
				where p.survey_id = $survey_id and p.participant_id = r.participant_id
				and record = '".prep($record)."' and p.event_id = $event_id and r.instance = '".prep($instance)."'
				order by p.participant_email desc limit 1";
		$q = db_query($sql);
		if (db_num_rows($q) > 0) {
			// Get return code that already exists in table
			$return_code = db_result($q, 0, 'return_code');
			$response_id = db_result($q, 0, 'response_id');
			// If code is blank, then try to generate a return code
			if ($return_code == '') {
				$return_code = self::getUniqueReturnCode($survey_id, $response_id);
			}
		} else {
			// Make sure the record exists first, else return null
			if (!Records::recordExists($record)) return null;
			// Create new row in response table
			self::getFollowupSurveyParticipantIdHash($survey_id, $record, $event_id, false, $instance);
			// Row now exists in response table, but it has no return code, so recursively re-run this method to generate it.
			return self::getSurveyReturnCode($record, $instrument, $event_id, $instance);
		}
		// Return the code
		return ($return_code == '' ? null : strtoupper($return_code));
	}


	// Obtain the survey hash for specified event_id (return public survey hash if participant_id is not provided)
	public static function getSurveyHash($survey_id, $event_id = null, $participant_id=null)
	{
		global $Proj;

		// Check event_id (use first event_id in project if not provided)
		if (!is_numeric($event_id)) $event_id = $Proj->firstEventId;

		// Retrieve hash ("participant_email=null" means it's a public survey)
		$sql = "select hash from redcap_surveys_participants where survey_id = $survey_id and event_id = $event_id ";
		if (!is_numeric($participant_id)) {
			// Public survey
			$sql .= "and participant_email is null ";
		} else {
			// Specific participant
			$sql .= "and participant_id = $participant_id ";
		}
		$sql .= "order by participant_id limit 1";
		$q = db_query($sql);

		// Hash exists
		if (db_num_rows($q) > 0) {
			$hash = db_result($q, 0);
		}
		// Create hash
		else {
			$hash = self::setHash($survey_id, null, $event_id, null, (!is_numeric($participant_id)));
		}

		return $hash;
	}


	// Create a new survey hash [for current arm]
	public static function setHash($survey_id, $participant_email=null, $event_id=null, $identifier=null,
								   $isPublicSurvey=false, $phone="", $delivery_preference="")
	{
		// Check event_id
		if (!is_numeric($event_id)) return false;

		// Set string for email (null = public survey
		$sql_participant_email = ($participant_email === null) ? "null" : "'" . prep($participant_email) . "'";

		// Create unique hash
		$hash = self::getUniqueHash(10, $isPublicSurvey);
		$sql = "insert into redcap_surveys_participants (survey_id, event_id, participant_email, participant_phone, participant_identifier, hash, delivery_preference)
				values ($survey_id, $event_id, $sql_participant_email, " . checkNull($phone) . ", " . checkNull($identifier) . ", '$hash', " . checkNull($delivery_preference) . ")";
		$q = db_query($sql);

		// Return nothing if could not store hash
		return ($q ? $hash : "");
	}


	// Creates unique hash after checking current hashes in tables, and returns that value
	static function getUniqueHash($hash_length=10, $isPublicSurvey=false)
	{
		do {
			// Generate a new random hash
			$hash = generateRandomHash($hash_length, false, $isPublicSurvey);
			// Ensure that the hash doesn't already exist in either redcap_surveys or redcap_surveys_hash (both tables keep a hash value)
			$sql = "select hash from redcap_surveys_participants where hash = '$hash' limit 1";
			$hashExists = (db_num_rows(db_query($sql)) > 0);
		} while ($hashExists);
		// Hash is unique, so return it
		return $hash;
	}


	// Return boolean for if Survey Login is enabled
	public static function surveyLoginEnabled()
	{
		global $survey_auth_enabled;
		return ($survey_auth_enabled == '1');
	}


	// Survey Login: Display survey login form for respondent to log in
	public static function getSurveyLoginForm($record=null, $surveyLoginFailed=false, $surveyTitle=null)
	{
		global $survey_auth_field1, $survey_auth_event_id1, $survey_auth_field2, $survey_auth_event_id2,
			   $survey_auth_field3, $survey_auth_event_id3, $survey_auth_min_fields, $longitudinal,
			   $survey_auth_custom_message, $Proj, $lang;
		// Put html in $html
		$html = $rows = "";
		// Set array of fields/events
		$surveyLoginFieldsEvents = self::getSurveyLoginFieldsEvents();
		// Count auth fields
		$auth_field_count = count($surveyLoginFieldsEvents);

		// If record already exists, then retrieve its data to see if we need to display all fields in login form.
		if ($record != '' && $auth_field_count >= $survey_auth_min_fields ) {
			$data_fields = $data_events = array();
			foreach ($surveyLoginFieldsEvents as $fieldEvent) {
				$data_fields[] = $fieldEvent['field'];
				$data_events[] = $fieldEvent['event_id'];
			}
			// Get data for record
			$survey_login_data = Records::getData('array', $record, $data_fields, $data_events);
			// Loop through fields again and REMOVE any where the value is empty for this record
			foreach ($surveyLoginFieldsEvents as $key=>$fieldEvent) {
				if (isset($survey_login_data[$record][$fieldEvent['event_id']][$fieldEvent['field']])
					&& $survey_login_data[$record][$fieldEvent['event_id']][$fieldEvent['field']] == '' ) {
					// Remove the field
					unset($surveyLoginFieldsEvents[$key]);
					$auth_field_count--;
				}
			}
		}

		// Count auth fields again (in case some were removed)
		$auth_field_count = count($surveyLoginFieldsEvents);


		// Loop through array of login fields
		if ($auth_field_count >= $survey_auth_min_fields) {
			foreach ($surveyLoginFieldsEvents as $fieldEvent)
			{
				// Get field and event_id
				$survey_auth_field_variable = $fieldEvent['field'];
				$survey_auth_event_id_variable = $fieldEvent['event_id'];
				// Set some attributes
				$dformat = $width = $onblur = "";
				$val_type = $Proj->metadata[$survey_auth_field_variable]['element_validation_type'];
				if ($val_type != '') {
					$onblur = "redcap_validate(this,'','','soft_typed','$val_type',1);";
					// Adjust size for date/time fields
					if ($val_type == 'time' || substr($val_type, 0, 4) == 'date' || substr($val_type, 0, 5) == 'date_') {
						$dformat = RCView::span(array('class'=>'df'), MetaData::getDateFormatDisplay($val_type));
						$width = "width:".MetaData::getDateFieldWidth($val_type).";";
					}
				}
				$field_note = "";
				if ($Proj->metadata[$survey_auth_field_variable]['element_note'] != "") {
					$field_note = RCView::div(array('class'=>'note', 'style'=>'width:100%;'), $Proj->metadata[$survey_auth_field_variable]['element_note']);
                                }
				// Add row
				$rows .= RCView::tr(array(),
							RCView::td(array('valign'=>'top', 'class'=>'labelrc', 'style'=>'font-size:14px;'),
								filter_tags($Proj->metadata[$survey_auth_field_variable]['element_label'])
							) .
							RCView::td(array('valign'=>'top', 'class'=>'data', 'style'=>'width:320px;'),
								RCView::input(array('type'=>'password', 'name'=>$survey_auth_field_variable, 'class'=>"x-form-text x-form-field $val_type",
									'onblur'=>$onblur, 'size'=>'30', 'style'=>$width), '') .
								$dformat .
								$field_note .
								RCView::div(array('style'=>'margin-top:2px;font-size:11px;color:#666;font-weight:normal;'),
									RCView::checkbox(array('onclick'=>"passwordMask($('#survey_login_dialog input[name=\"$survey_auth_field_variable\"]'),$(this).prop('checked'));")) .
									$lang['survey_1066']
								)
							)
						);
		        }
		}
		// Instructions
		$numOutOfNum = ($survey_auth_min_fields < $auth_field_count)
			? "{$lang['survey_575']} $survey_auth_min_fields {$lang['survey_576']} $auth_field_count {$lang['survey_577']}"
			: ($auth_field_count > 1 ? $lang['survey_578'] : $lang['survey_587']);
		$html .= RCView::div(array('id'=>'survey-login-instructions'),
					RCView::p(array('style'=>'font-size:14px;margin:5px 0 15px;color:#800000;'),
						$lang['survey_310'] . " \"" . RCView::b(RCView::escape($surveyTitle)) . "\""
					) .
					RCView::p(array('style'=>'font-size:14px;margin:5px 0 15px;'),
						$lang['survey_574'] . " " .
						RCView::b($numOutOfNum) . " " . $lang['survey_594']
					)
				);
		// If previous login attempt failed, then display error message
		if ($surveyLoginFailed === true) {
			// Display default error message
			$html .= RCView::div(array('class'=>'red survey-login-error-msg', 'style'=>'margin:0 0 20px;'),
						RCView::img(array('src'=>'exclamation.png')) .
						RCView::b($lang['global_01'] . $lang['colon']) . " " .
						($survey_auth_min_fields == '1' ? $lang['survey_580'] : $lang['survey_579']) .
						// Display custom message (if set)
						(trim($survey_auth_custom_message) == '' ? '' :
							RCView::div(array('style'=>'margin:10px 0 0;'),
								nl2br(filter_tags(br2nl(trim($survey_auth_custom_message))))
							)
						)
					);
		}
		// If there are no fields to display (most likely because the participant has no data for the required fields),
		// then display an error message explaining this.
		if ($rows == '') {
			// Display default error message
			$html .= RCView::div(array('class'=>'red survey-login-error-msg', 'style'=>'margin:0 0 20px;'),
						RCView::img(array('src'=>'exclamation.png')) .
						RCView::b($lang['global_01'] . $lang['colon']) . " " .
						$lang['survey_589'] .
						// Display custom message (if set)
						(trim($survey_auth_custom_message) == '' ? '' :
							RCView::div(array('style'=>'margin:10px 0 0;'),
								nl2br(filter_tags(br2nl(trim($survey_auth_custom_message))))
							)
						)
					);
		}
		// Add form and table
		$html .= RCView::form(array('id'=>'survey_auth_form', 'action'=>$_SERVER['REQUEST_URI'], 'enctype'=>'multipart/form-data', 'target'=>'_self', 'method'=>'post'),
					RCView::table(array('cellspacing'=>0, 'class'=>'form_border'), $rows) .
					// Hidden input to denote this specific action
					RCView::hidden(array('name'=>'survey-auth-submit'), '1')
				);
		// Return html
		return RCView::div(array('id'=>'survey_login_dialog', 'class'=>'simpleDialog', 'style'=>'margin-bottom:10px;'), $html);
	}


	// Get list of Text variables in project that can be used for Survey Login fields that can
	// be used as options in a drop-down.
	public static function getTextFieldsForDropDown($excludeRecordIdField=false)
	{
		global $Proj, $lang;
		// Build an array of drop-down options listing all REDCap fields
		$rc_fields = array(''=>'-- '.$lang['random_02'].' --');
		foreach ($Proj->metadata as $this_field=>$attr1) {
			// Text fields only
			if ($attr1['element_type'] != 'text') continue;
			// Exclude record ID field?
			if ($excludeRecordIdField && $this_field == $Proj->table_pk) continue;
			// Add to fields/forms array. Get form of field.
			$this_form_label = $Proj->forms[$attr1['form_name']]['menu'];
			// Truncate label if long
			if (strlen($attr1['element_label']) > 65) {
				$attr1['element_label'] = trim(substr($attr1['element_label'], 0, 47)) . "... " . trim(substr($attr1['element_label'], -15));
			}
			$rc_fields[$this_form_label][$this_field] = "$this_field \"{$attr1['element_label']}\"";
		}
		// Return all options
		return $rc_fields;
	}


	// Return array of field name and event_id of the survey auth fields (up to 3)
	public static function getSurveyLoginFieldsEvents()
	{
		global $survey_auth_field1, $survey_auth_event_id1, $survey_auth_field2, $survey_auth_event_id2,
			   $survey_auth_field3, $survey_auth_event_id3, $Proj;
		// Set array of fields
		$survey_auth_fields = array(1, 2, 3);
		$loginFieldsEvents = array();
		// Loop through array of login fields
		foreach ($survey_auth_fields as $num)
		{
			// Get global variable for this login field
			$survey_auth_field = 'survey_auth_field'.$num;
			$survey_auth_event_id = 'survey_auth_event_id'.$num;
			$survey_auth_field_variable = $$survey_auth_field;
			$survey_auth_event_id_variable = $$survey_auth_event_id;
			if ($survey_auth_field_variable != '' && isset($Proj->metadata[$survey_auth_field_variable])) {
				// Make sure event_id is valid, else default to first event_id
				if (!isset($Proj->eventInfo[$survey_auth_event_id_variable])) $survey_auth_event_id_variable = $Proj->firstEventId;
				// Add to array
				$loginFieldsEvents[] = array('field'=>$survey_auth_field_variable, 'event_id'=>$survey_auth_event_id_variable);
			}
		}
		// Return array
		return $loginFieldsEvents;
	}


	// Return boolean if the "check survey login failed attempts" is enabled
	public static function surveyLoginFailedAttemptsEnabled()
	{
		global $survey_auth_fail_limit, $survey_auth_fail_window;
		return (is_numeric($survey_auth_fail_limit) && $survey_auth_fail_limit > 0 && is_numeric($survey_auth_fail_window) && $survey_auth_fail_window > 0);
	}


	// Return the auto-logout time (in minutes) for Survey Login (based on $autologout_timer for REDCap sessions). Default = 30 if not set.
	public static function getSurveyLoginAutoLogoutTimer()
	{
		global $autologout_timer;
		return ($autologout_timer == "0" || !is_numeric($autologout_timer)) ? 30 : $autologout_timer;
	}


	// Generate or retrieve a Survey Access Codes for multiple participants and return array with
	// participant_id's as key and access code as value.
	public static function getAccessCodes($participant_ids=array())
	{
		if (!is_array($participant_ids)) return false;
		// Query to see if Survey Access Code has already been generated
		$partIdsAccessCodes = array();
		$sql = "select participant_id, access_code from redcap_surveys_participants
				where participant_id in (".prep_implode($participant_ids).")";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			// If access code is null, then generate it
			if ($row['access_code'] == '') {
				$partIdsAccessCodes[$row['participant_id']] = self::getAccessCode($row['participant_id'], false, true);
			} else {
				$partIdsAccessCodes[$row['participant_id']] = $row['access_code'];
			}
		}
		// Return array
		return $partIdsAccessCodes;
	}


	// Generate a new Survey Access Code (or retrieve existing one) OR generate new Short Code
	public static function getAccessCode($participant_id, $shortCode=false, $forceGenerate=false, $return_numeral=false)
	{
		if (!is_numeric($participant_id)) return false;
		if (!$shortCode) {
			## SURVEY ACCESS CODE
			// Determine access code's column name in db table
			$code_colname = ($return_numeral) ? "access_code_numeral" : "access_code";
			// Query to see if Survey Access Code has already been generated
			if (!$forceGenerate) {
				$sql = "select $code_colname from redcap_surveys_participants where participant_id = $participant_id
						and $code_colname is not null limit 1";
				$q = db_query($sql);
			}
			if (!$forceGenerate && db_num_rows($q)) {
				// Get existing code
				$code = db_result($q, 0);
			} else {
				// Generate random non-existing code
				do {
					// Generate a new random code
					if ($return_numeral) {
						$code = sprintf("%010d", mt_rand(0, 9999999999));
					} else {
						$code = generateRandomHash(9, false, true);
					}
					// Ensure that the code doesn't already exist in the table
					$sql = "select $code_colname from redcap_surveys_participants where $code_colname = '".prep($code)."' limit 1";
					$codeExists = (db_num_rows(db_query($sql)) > 0);
				} while ($codeExists);
				// Add code to table
				$sql = "update redcap_surveys_participants set $code_colname = '".prep($code)."' where participant_id = $participant_id";
				if (!db_query($sql)) return false;
			}
		} else {
			## SHORT CODE
			// Generate random non-existing code
			do {
				// Generate a new random code
				$code = generateRandomHash(2, false, true, true) . sprintf("%03d", mt_rand(0, 999));
				// Ensure that the code doesn't already exist in the table
				$sql = "select code from redcap_surveys_short_codes where code = '".prep($code)."' limit 1";
				$codeExists = (db_num_rows(db_query($sql)) > 0);
			} while ($codeExists);
			// Add code to table
			$sql = "insert into redcap_surveys_short_codes (ts, code, participant_id) values
					('".NOW."', '".prep($code)."', $participant_id)";
			if (!db_query($sql)) return false;
		}
		// Code is unique, so return it
		return $code;
	}


	// Validate the Survey Code and redirect to the survey
	public static function validateAccessCodeForm($code)
	{
		global $redcap_version;
		// Get length of code
		$code_length = strlen($code);
		// Is a short code?
		$isShortCode = ($code_length == self::SHORT_CODE_LENGTH && preg_match("/^[A-Za-z0-9]+$/", $code));
		// Is an access code?
		$isAccessCode = ($code_length == self::ACCESS_CODE_LENGTH && preg_match("/^[A-Za-z0-9]+$/", $code));
		// Is a numeral access code?
		$isNumeralAccessCode = ($code_length == self::ACCESS_CODE_NUMERAL_LENGTH && is_numeric($code));
		// Is a numeral access code beginning with "V", which denotes that Twilio should call them?
		$lengthPrependAccessCodeNumeral = strlen(self::PREPEND_ACCESS_CODE_NUMERAL);
		$isNumeralAccessCodeReceiveCall = (!$isShortCode && !$isAccessCode && !$isNumeralAccessCode
			&& $code_length == (self::ACCESS_CODE_NUMERAL_LENGTH + $lengthPrependAccessCodeNumeral)
			&& strtolower(substr($code, 0, $lengthPrependAccessCodeNumeral)) == strtolower(self::PREPEND_ACCESS_CODE_NUMERAL)
			&& is_numeric(substr($code, $lengthPrependAccessCodeNumeral)));
		if ($isNumeralAccessCodeReceiveCall) {
			$code = substr($code, $lengthPrependAccessCodeNumeral);
			$isNumeralAccessCode = true;
		}
		// If not a valid code based on length or content alone, then stop
		if (!$isShortCode && !$isAccessCode && !$isNumeralAccessCode && !$isNumeralAccessCodeReceiveCall) return false;
		// Determine if Short Code or normal Access Code
		if ($isShortCode) {
			## SHORT CODE
			// Get timestamp older than X minutes
			$xMinAgo = date("Y-m-d H:i:s", mktime(date("H"),date("i")-Survey::SHORT_CODE_EXPIRE,date("s"),date("m"),date("d"),date("Y")));
			$sql = "select p.hash from redcap_surveys_participants p, redcap_surveys_short_codes c
					where p.participant_id = c.participant_id and c.code = '".prep($code)."' and c.ts > '$xMinAgo' limit 1";
			$q = db_query($sql);
			if (db_num_rows($q) == 0) return false;
			$hash = db_result($q, 0);
			// Now remove the code since it only gets used once
			$sql = "delete from redcap_surveys_short_codes where code = '".prep($code)."' limit 1";
			db_query($sql);
		} elseif (!$isShortCode) {
			## SURVEY ACCESS CODE
			$sql = "select hash from redcap_surveys_participants where "
				 . ($isNumeralAccessCode ? "access_code_numeral = '".prep($code)."'" : "access_code = '".prep($code)."'");
			$q = db_query($sql);
			if (db_num_rows($q) == 0) return false;
			$hash = db_result($q, 0, 'hash');
			// If user submitted code in order to receive phone call, then initiate survey by calling them
			if ($isNumeralAccessCodeReceiveCall && isset($_POST['From'])) {
				// Redirect to the correct page to make the call to the respondent
				redirect(APP_PATH_WEBROOT_FULL . "redcap_v{$redcap_version}/" .
						"Surveys/twilio_initiate_call_sms.php?s=$hash&action=init&delivery_type=VOICE_INITIATE&phone=".$_POST['From']);
			}
		}
		// Return hash
		return $hash;
	}


	// Return array of available delivery methods for surveys (e.g. email, sms_invite, voice_initiate, sms_initiate).
	// To be used as drop-down list options.
	public static function getDeliveryMethods($addParticipantPrefOption=false, $addDropdownGroups=false, $appendPreferenceTextToOption=null, $addEmailOption=true)
	{
		global $lang, $twilio_enabled, $twilio_option_voice_initiate, $twilio_option_sms_initiate,
			   $twilio_option_sms_invite_make_call, $twilio_option_sms_invite_receive_call, $twilio_option_sms_invite_web;
		// Add array of delivery methods (email by default)
		$delivery_methods = array();
		// Email option
		if ($addEmailOption) {
			$delivery_methods[$lang['survey_804']]['EMAIL'] = $lang['survey_688'] .
										 ($appendPreferenceTextToOption == 'EMAIL' ? " " . $lang['survey_782'] : '');
		}
		// If using Twilio, add the SMS/Voice choices
		if ($twilio_enabled) {
			if ($twilio_option_sms_invite_web) {
				$delivery_methods[$lang['survey_804']]['SMS_INVITE_WEB'] = $lang['survey_955'] .
													($appendPreferenceTextToOption == 'SMS_INVITE_WEB' ? " " . $lang['survey_782'] : '');
			}
			if ($twilio_option_sms_initiate) {
				$delivery_methods[$lang['survey_803']]['SMS_INITIATE'] = $lang['survey_767'] .
													($appendPreferenceTextToOption == 'SMS_INITIATE' ? " " . $lang['survey_782'] : '');
			}
			if ($twilio_option_voice_initiate) {
				$delivery_methods[$lang['survey_802']]['VOICE_INITIATE'] = $lang['survey_884'] .
													  ($appendPreferenceTextToOption == 'VOICE_INITIATE' ? " " . $lang['survey_782'] : '');
			}
			if ($twilio_option_sms_invite_make_call) {
				$delivery_methods[$lang['survey_802']]['SMS_INVITE_MAKE_CALL'] = $lang['survey_690'] .
												  ($appendPreferenceTextToOption == 'SMS_INVITE_MAKE_CALL' ? " " . $lang['survey_782'] : '');
			}
			if ($twilio_option_sms_invite_receive_call) {
				$delivery_methods[$lang['survey_802']]['SMS_INVITE_RECEIVE_CALL'] = $lang['survey_801'] .
												  ($appendPreferenceTextToOption == 'SMS_INVITE_RECEIVE_CALL' ? " " . $lang['survey_782'] : '');
			}
		}
		// Add participant's preference as option?
		if ($addParticipantPrefOption) {
			$delivery_methods[$lang['survey_805']]['PARTICIPANT_PREF'] = $lang['survey_768'];
		}
		// If we're not adding the optgroups, then remove them
		if (!$addDropdownGroups) {
			$delivery_methods2 = array();
			foreach ($delivery_methods as $key=>$attr) {
				if (is_array($attr)) {
					foreach ($attr as $key2=>$attr2) {
						$delivery_methods2[$key2] = $attr2;
					}
				} else {
					$delivery_methods2[$key] = $attr;
				}
			}
			$delivery_methods = $delivery_methods2;
		}
		// Return array
		return $delivery_methods;
	}


	// Display the Survey Code form for entering the code
	public static function displayAccessCodeForm($displayErrorMsg=false)
	{
		global $lang;
		return 	RCView::form(array('id'=>'survey_code_form', 'style'=>'font-weight:bold;margin:0 0 10px;font-size:16px;', 'action'=>$_SERVER['REQUEST_URI'], 'enctype'=>'multipart/form-data', 'target'=>'_self', 'method'=>'post'),
					RCView::div(array('style'=>'margin:-32px 0 5px;text-align:right;'),
						RCView::a(array('href'=>'https://projectredcap.org/', 'target'=>'_blank'),
							RCView::img(array('src'=>'redcap-logo-small.png'))
						)
					) .
					RCView::div(array(),
						$lang['survey_619'] .
						RCView::text(array('name'=>'code', 'maxlength'=>'20', 'class'=>'x-form-text x-form-field', 'style'=>'margin:0 4px 0 10px;font-size:16px;width:120px;padding:4px 6px;')) .
						RCView::button(array('class'=>'jqbutton', 'onclick'=>"
							var ob = $('input[name=\"code\"]');
							ob.val( trim(ob.val()) );
							if (ob.val() == '') {
								simpleDialog('".cleanHtml($lang['survey_634'])."');
								return false;
							}
							$('#survey_code_form').submit();
						"), $lang['survey_200'])
					) .
					// Error msg
					(!$displayErrorMsg ? '' :
						RCView::div(array('class'=>'red', 'style'=>'font-size:14px;margin-top:20px;padding:10px 15px 12px;'),
							RCView::img(array('src'=>'exclamation.png')) .
							RCView::b($lang['global_01'].$lang['colon']) . " " . $lang['survey_622']
						)
					) .
					RCView::div(array('style'=>'font-size:14px;font-weight:normal;color:#777;margin-top:30px;margin-bottom:50px;'),
						$lang['survey_642']
					)
				) .
				"<style type='text/css'>
				#footer { display:none; }
				</style>
				<script type='text/javascript'>
				$(function(){
					$('input[name=\"code\"]').focus();
				});
				</script>";
	}


	// OBTAIN SHORT URL VIA BIT.LY API
	public static function getShortUrl($original_url)
	{
		// URL shortening service
		$service = "j.mp";
		// Set parameters for URL shortener service
		$serviceurl = "http://api.bit.ly/v3/shorten?domain=$service&format=txt&login=projectredcap&apiKey=R_6952a44cd93f2c200047bb81cf3dbb71&longUrl=";
		$urlbase	= "http://$service/";
		// Retrieve shortened URL from URL shortener service
		$shorturl = trim(http_get($serviceurl . urlencode($original_url)));
		// Ensure that we received a link in the expected format
		if (!empty($shorturl) && substr($shorturl, 0, strlen($urlbase)) == $urlbase) {
			// Output
			return $shorturl;
		}
		// On error, return false
		return false;
	}

	// OBTAIN CUSTOM SHORT URL
	public static function getCustomShortUrl($url, $customUrl)
	{
    //This function returns an array giving the results of the shortening
    //If successful $result["shortURL"] will give us new shortened URL
    //If unsuccessful $result["errorMessage"] will give an explanation of why
    //and $result["errorCode"] will give a code indicating the type of error

    $url = urlencode($url);
    $basepath = "http://is.gd/create.php?format=simple";
    $result = array();
    $result["errorCode"] = -1;
    $result["shortURL"] = null;
    $result["errorMessage"] = null;

    $opts = array("http" => array("ignore_errors" => true));
    $context = stream_context_create($opts);

    if($customUrl){
			$path = $basepath."&shorturl=$customUrl&url=$url";
		}else{
			$path = $basepath."&url=$url";
		}
		// print $path;

    $response = @file_get_contents($path,false,$context);

		// echo 'response: '. $response ."\n";
    if(!isset($http_response_header))
    {
        $result["errorMessage"] = "Local error: Failed to fetch API page";
        return($result);
    }

    //Getting the HTTP status code from the response headers
    if (!preg_match("{[0-9]{3}}",$http_response_header[0],$httpStatus))
    {
        $result["errorMessage"] = "Local error: Failed to extract HTTP status from result request";
        return($result);
    }

		// print $httpStatus[0];
		$response1 = str_split($response, 12);
		// print $response1[0];

    $errorCode = -1;
		// echo 'error: '. $httpStatus[0] ."\n";
    switch($response1[0])
    {
        case 'Error: Short'://too long
            $errorCode = 1;
            break;
				case 'Error: The s'://already exists
            $errorCode = 2;
            break;
        case 400:
            $errorCode = 1;
            break;
        case 406:
            $errorCode = 2;
            break;
        case 502:
            $errorCode = 3;
            break;
        case 503:
            $errorCode = 4;
            break;
				default:
					$errorCode = 0;
    }

    if($errorCode==-1)
    {
        $result["errorMessage"] = "Local error: Unexpected response code received from server";
        return($result);
    }

    $result["errorCode"] = $errorCode;
    if($errorCode==0){
			$result["shortURL"] = $response;
			$result["errorMessage"] = "success!";
		}else{
			$result["shortURL"] = "no url";
			$result["errorMessage"] = $response;
		}

		// echo 'error code: '. $errorCode ."\n";
    return $result;

	}


	// OBTAIN HTML ICON FOR A GIVEN SMS/VOICE DELIVERY PREFERENCE IN THE PARTICIPANT LIST
	public static function getDeliveryPrefIcon($delivery_pref)
	{
		global $lang;
		// Deliever preference
		if ($delivery_pref == 'VOICE_INITIATE') {
			$deliv_pref_icon = RCView::img(array('src'=>'phone.gif', 'title'=>$lang['survey_884']));
		} else if ($delivery_pref == 'SMS_INITIATE') {
			$deliv_pref_icon = RCView::img(array('src'=>'balloons_box.png', 'title'=>$lang['survey_767']));
		} else if ($delivery_pref == 'SMS_INVITE_MAKE_CALL') {
			$deliv_pref_icon = RCView::img(array('src'=>'balloon_phone.gif', 'title'=>$lang['survey_690']));
		} else if ($delivery_pref == 'SMS_INVITE_RECEIVE_CALL') {
			$deliv_pref_icon = RCView::img(array('src'=>'balloon_phone_receive.gif', 'title'=>$lang['survey_801']));
		} else if ($delivery_pref == 'SMS_INVITE_WEB') {
			$deliv_pref_icon = RCView::img(array('src'=>'balloon_link.gif', 'title'=>$lang['survey_955']));
		} else {
			$deliv_pref_icon = RCView::img(array('src'=>'email.png', 'title'=>$lang['global_33']));
		}
		return $deliv_pref_icon;
	}


	// DETERMINE THE NEXT SURVEY URL IN THE SAME EVENT AND RETURN URL OR NULL
	public static function getAutoContinueSurveyUrl($record, $current_form_name, $event_id)
	{
		global $Proj;
		// Get all forms from this event
		$forms_array = $Proj->eventsForms[$event_id];

		// Get all forms after the current one
		$forms_array = array_slice($forms_array, array_search($current_form_name, $forms_array) + 1);

		// Create array of valid surveys remaining
		$next_surveys = array();
		foreach ($forms_array as $k => $form) {
			$this_survey_id = isset($Proj->forms[$form]['survey_id']) ? $Proj->forms[$form]['survey_id'] : 0;
			if ($this_survey_id) {
				$this_survey = $Proj->surveys[$this_survey_id];
				// Check it is enabled
				if ($this_survey['survey_enabled'] == 1) {
					// Check it isn't expired
					if (!($this_survey['survey_expiration'] != '' && $this_survey['survey_expiration'] <= NOW)) {
						$next_surveys[] = $this_survey_id;
					}
				}
			}
		}

		// Is there another valid survey in this event
		if (empty($next_surveys)) {
			$next_survey_url = NULL;
		} else {
			$next_survey_id = current($next_surveys);
			// Use survey_functions to generate a hash for this survey
			list($next_participant_id, $next_hash) = self::getFollowupSurveyParticipantIdHash($next_survey_id, $record, $event_id);
			$next_survey_url = APP_PATH_SURVEY_FULL . "?s=$next_hash";
		}
		return $next_survey_url;
	}


	// OBTAIN ARRAY OF ALL LANGUAGES AVAILABLE FOR GOOGLE TEXT-TO-SPEECH API
	public static function getTextToSpeechLanguages()
	{
		return array(
			"af"=>"Afrikaans",
			"sq"=>"Albanian",
			"ar"=>"Arabic",
			"hy"=>"Armenian",
			"ca"=>"Catalan",
			"zh-CN"=>"Mandarin (simplified)",
			"zh-TW"=>"Mandarin (traditional)",
			"hr"=>"Croatian",
			"cs"=>"Czech",
			"da"=>"Danish",
			"nl"=>"Dutch",
			"en"=>"English",
			"eo"=>"Esperanto",
			"fi"=>"Finnish",
			"fr"=>"French",
			"de"=>"German",
			"el"=>"Greek",
			"ht"=>"Haitian Creole",
			"hi"=>"Hindi",
			"hu"=>"Hungarian",
			"is"=>"Icelandic",
			"id"=>"Indonesian",
			"it"=>"Italian",
			"ja"=>"Japanese",
			"ko"=>"Korean",
			"la"=>"Latin",
			"lv"=>"Latvian",
			"mk"=>"Macedonian",
			"no"=>"Norwegian",
			"pl"=>"Polish",
			"pt"=>"Portuguese",
			"ro"=>"Romanian",
			"ru"=>"Russian",
			"sr"=>"Serbian",
			"sk"=>"Slovak",
			"es"=>"Spanish",
			"sw"=>"Swahili",
			"sv"=>"Swedish",
			"ta"=>"Tamil",
			"th"=>"Thai",
			"tr"=>"Turkish",
			"vi"=>"Vietnamese",
			"cy"=>"Welsh"
		);
	}


	// Text Size: See appropriage text size by outputting CSS file
	public static function setTextSize($text_size, $HtmlPageObject)
	{
		global $isMobileDevice;
		// Init var
		if ($text_size == '') $text_size = 0;
		// For mobile devices, increase the font one step for better viewability
		if ($isMobileDevice) $text_size++;
		// Set CSS file
		if ($text_size == '1') {
			$HtmlPageObject->addStylesheet("survey_text_large.css", 'screen,print');
		} elseif ($text_size > 1) {
			$HtmlPageObject->addStylesheet("survey_text_very_large.css", 'screen,print');
		}
		// Return HTML object
		return $HtmlPageObject;
	}


	// Get list of index numbers from getFonts() where the font is non-Latin
	public static function getNonLatinFontIndex()
	{
		return array(12, 13, 14, 15);
	}


	// Get list of survey themes
	public static function getFonts($font=null)
	{
		// Array of all available survey fonts
		$fonts = array();
		// Latin fonts
		$fonts[16] = "'Open Sans',Helvetica,Arial,sans-serif";
		$fonts[0] = "'Arial Black',Gadget,sans-serif";
		$fonts[1] = "'Comic Sans MS',cursive,sans-serif";
		$fonts[2] = "'Courier New',Courier,monospace";
		$fonts[3] = "Georgia,serif";
		$fonts[4] = "'Lucida Console',Monaco,monospace";
		$fonts[5] = "'Lucida Sans Unicode','Lucida Grande',sans-serif";
		$fonts[6] = "'Palatino Linotype','Book Antiqua',Palatino,serif";
		$fonts[7] = "Tahoma,Geneva,sans-serif";
		$fonts[8] = "'Times New Roman',Times,serif";
		$fonts[9] = "'Trebuchet MS',Helvetica,sans-serif";
		$fonts[10] = "Verdana,Geneva,sans-serif";
		$fonts[11] = "'Gill Sans',Geneva,sans-serif";
		// Non-Latin fonts
		$fonts[12] = "Meiryo,sans-serif";
		$fonts[13] = "'Meiryo UI',sans-serif";
		$fonts[14] = "'Hiragino Kaku Gothic Pro',sans-serif";
		$fonts[15] = "'MS PGothic',Osaka,Arial,sans-serif";
		// Set default font if returning single font and invalid parameter is passed
		if ($font !== null && !isset($fonts[$font])) $font = 0;
		// Return single font
		if ($font !== null) return $fonts[$font];
		// Return array
		return $fonts;
	}


	// Survey Theme: Provide $theme as /redcap/themes/ subdirectory, and output CSS and JS files inside that directory
	public static function applyFont($font_num, $HtmlPageObject)
	{
		if (!is_numeric($font_num)) {
			// Default font
			$font = 'Arial';
		} else {
			// Validate font
			$font = self::getFonts($font_num);
		}
		// Add CSS to HtmlObject
		$HtmlPageObject->addInlineStyle("body * { font-family: $font !important; }");
		// Return HtmlPage object
		return $HtmlPageObject;
	}


	// Get list of user-saved survey themes
	public static function getUserThemes($selected_theme=null)
	{
		// Put themes into array
		$themes_array = array();
		// Get themes for this user
		if ($selected_theme === null) {
			$sql = "select t.* from redcap_surveys_themes t, redcap_user_information i
					where i.ui_id = t.ui_id and i.username = '".prep(USERID)."' order by t.theme_name";
		} else {
			$sql = "select t.* from redcap_surveys_themes t where t.theme_id = '".prep($selected_theme)."' order by t.theme_name";
		}
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$theme_id = $row['theme_id'];
			unset($row['ui_id'], $row['theme_id']);
			// Prepend color values with hash
			foreach ($row as $attr_name=>$attr_val) {
				if ($attr_name != 'theme_name' && $attr_val != '') {
					$row[$attr_name] = "#$attr_val";
				}
			}
			$themes_array[$theme_id] = $row;
		}
		// Return array of user's themes
		return $themes_array;
	}


	// Return boolean regarding if current user has one or more saved custom survey themes
	public static function userHasCustomThemes($theme_id=null)
	{
		$sql = "select 1 from redcap_surveys_themes t, redcap_user_information i
				where i.ui_id = t.ui_id and i.username = '".prep(USERID)."' ";
		if (is_numeric($theme_id)) {
			$sql .= "and t.theme_id = $theme_id";
		} else {
			$sql .= "limit 1";
		}
		$q = db_query($sql);
		return (db_num_rows($q) > 0);
	}


	// Get utilization of a user's saved survey theme
	// Return array of user's themes with theme_id as key where value = count of # surveys using the theme
	public static function getUserThemeUtilization($username)
	{
		$sql = "select t.theme_id, count(1) as thiscount
				from redcap_surveys_themes t, redcap_user_information i, redcap_surveys s, redcap_projects p
				where i.ui_id = t.ui_id and s.theme = t.theme_id and i.username = '".prep($username)."'
				and s.project_id = p.project_id and p.date_deleted is null
				and s.form_name = (select m.form_name from redcap_metadata m where m.project_id = p.project_id and s.form_name = m.form_name limit 1)
				group by t.theme_id";
		$q = db_query($sql);
		$themeCounts = array();
		while ($row = db_fetch_assoc($q)) {
			$themeCounts[$row['theme_id']] = $row['thiscount'];
		}
		return $themeCounts;
	}


	// Get list of survey themes
	public static function getThemes($theme=null, $return_attributes=true, $return_user_themes=false)
	{
		// Put themes into array
		$themes_array = $user_themes = array();
		$preset_themes = self::getPresetThemes();
		// Obtain all themes saved by user
		if ($return_user_themes) {
			$user_themes = self::getUserThemes($theme);
			$preset_themes = $preset_themes+$user_themes;
		}
		// Obtain all themes (and attributes, if applicable)
		foreach ($preset_themes as $this_theme=>$theme_attr) {
			// Add theme to array
			if ($return_attributes) {
				$themes_array[$this_theme] = $theme_attr;
			} else {
				$themes_array[$this_theme] = $theme_attr['theme_name'];
			}
			// If $theme parameter was provided, then just return this theme attributes
			if ($theme !== null && $this_theme."" === $theme."") return $themes_array[$this_theme];
		}
		// Return array
		asort($themes_array);
		return $themes_array;
	}


	// Survey Theme: Provide $theme as /redcap/themes/ subdirectory, and output CSS and JS files inside that directory
	public static function applyTheme($theme, $HtmlPageObject, $custom_attr=array())
	{
		// Get the current theme
		$theme_attr = self::getThemes($theme, true, true);
		if ($theme_attr === null && empty($custom_attr)) return $HtmlPageObject;
		// Add any customizations on top of theme and prepend color values with hash
		if ($theme == '' && !empty($custom_attr)) {
			$theme_attr = array();
			foreach ($custom_attr as $attr_name=>$attr_val) {
				if ($attr_val != '') $theme_attr[$attr_name] = "#$attr_val";
			}
		}
		// Convert theme attr into CSS
		$css = self::getThemeCSS($theme_attr);
		// Add CSS to HtmlObject
		$HtmlPageObject->addInlineStyle($css);
		// Return HtmlPage object
		return $HtmlPageObject;
	}



	// Convert survey theme attributes into CSS
	public static function getThemeCSS($theme_attr)
	{
		$css = "";
		if (isset($theme_attr['theme_bg_page'])) {
			$css .= "body { background-image: none; background-color: {$theme_attr['theme_bg_page']}; }\n";
			// Determine a white or black footer based upon body bg color
			$footer_color = (is_numeric(substr($theme_attr['theme_bg_page'], 1, 1))) ? "#FFFFFF" : "#000000";
			$css .= "#footer, #footer a { color: $footer_color !important; }\n";
		}
		if (isset($theme_attr['theme_text_buttons'])) {
			$css .= "button {color: {$theme_attr['theme_text_buttons']} !important; }\n";
		}
		if (isset($theme_attr['theme_text_question'])) {
			$css .= "#questiontable td { color: {$theme_attr['theme_text_question']}; }\n";
			$css .= ".matrix_first_col_hdr { color: {$theme_attr['theme_text_question']} !important; }\n";
			// Enhanced choices radios/checkboxes
			$css .= "div.enhancedchoice label { color: {$theme_attr['theme_text_question']} !important; border-color: {$theme_attr['theme_text_question']} !important; }\n";
			$css .= "div.enhancedchoice label.selectedradio, div.enhancedchoice label.selectedchkbox, div.enhancedchoice label.hover:hover { background-color: {$theme_attr['theme_text_question']}; }\n";
		}
		if (isset($theme_attr['theme_bg_question'])) {
			$css .= "#questiontable td { background-image: none; background-color: {$theme_attr['theme_bg_question']}; }\n";
			// Enhanced choices radios/checkboxes
			$css .= "div.enhancedchoice label { background-color: {$theme_attr['theme_bg_question']}; }\n";
			$css .= "div.enhancedchoice label.selectedradio, div.enhancedchoice label.selectedchkbox, div.enhancedchoice label.hover:hover { color: {$theme_attr['theme_bg_question']} !important; border-color: {$theme_attr['theme_bg_question']} !important; }\n";
		}
		if (isset($theme_attr['theme_text_sectionheader'])) {
			$css .= ".header { color: {$theme_attr['theme_text_sectionheader']} !important; }\n";
		}
		if (isset($theme_attr['theme_bg_sectionheader'])) {
			$css .= ".header { background-image: none; border: none; background-color: {$theme_attr['theme_bg_sectionheader']} !important; }\n";
		}
		if (isset($theme_attr['theme_text_title'])) {
			$css .= "#surveypagenum, #surveytitle, #surveyinstructions, #surveyinstructions p, #surveyinstructions span, #surveyinstructions div, #surveyacknowledgment, #surveyacknowledgment p, #surveyacknowledgment span, #surveyacknowledgment div { color: {$theme_attr['theme_text_title']}; } \n";
			$css .= "#return_corner a, #survey_queue_corner a { color: {$theme_attr['theme_text_title']} !important; } \n";
		}
		if (isset($theme_attr['theme_bg_title'])) {
			$css .= "#pagecontent, #container, #surveytitle, #surveyinstructions, #surveyinstructions p, #surveyinstructions span, #surveyinstructions div, #surveyacknowledgment, #surveyacknowledgment p, #surveyacknowledgment span, #surveyacknowledgment div { background-image: none; background-color: {$theme_attr['theme_bg_title']}; } \n";
			// Determine a white or black footer based upon body bg color
			$changeFont_color = (is_numeric(substr($theme_attr['theme_bg_title'], 1, 1))) ? "#FFFFFF" : "#000000";
			$css .= "#changeFont { color: $changeFont_color !important; }\n";
		}
		if (isset($theme_attr['misc_css'])) {
			$css .= $theme_attr['misc_css'] . "\n";
		}
		return $css;
	}


	// Get Preset Survey Theme attributes
	public static function getPresetThemes($theme=null)
	{
		// Add preset themes to array
		$themes = array();
		$sql = "select * from redcap_surveys_themes where ui_id is null";
		if ($theme !== null) $sql .= " and theme_id = '".prep($theme)."'";
		$sql .= " order by theme_name";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$theme_id = $row['theme_id'];
			unset($row['ui_id'], $row['theme_id']);
			// Prepend color values with hash
			foreach ($row as $attr_name=>$attr_val) {
				if ($attr_name != 'theme_name' && $attr_val != '') {
					$row[$attr_name] = "#$attr_val";
				}
			}
			$themes[$theme_id] = $row;
		}
		// If $theme parameter is passed but is invalid, then return NULL
		if ($theme !== null && !isset($themes[$theme])) return null;
		// If $theme parameter is passed, return only its attributes
		if ($theme !== null && isset($themes[$theme])) return $themes[$theme];
		// Return themes array
		return $themes;
	}


	// Render drop-down list of Survey Themes
	public static function renderSurveyThemeDropdown($selected_theme='', $disabled=false)
	{
		global $lang;
		// Default theme's attributes
		$theme_attr_json_default = json_encode(array(
			'theme_text_buttons'=>'#000000', 'theme_bg_page'=>'#1A1A1A',
			'theme_text_title'=>'#000000', 'theme_bg_title'=>'#FFFFFF',
			'theme_text_sectionheader'=>'#000000', 'theme_bg_sectionheader'=>'#BCCFE8',
			'theme_text_question'=>'#000000', 'theme_bg_question'=>'#F3F3F3'
		));
		// Get survey theme attributes and set them as JSON
		$themes_attr_json = array();
		$survey_themes = self::getThemes(null, true, true);
		$user_themes = self::getUserThemes();
		$hasUserThemes = (!empty($user_themes));
		foreach ($survey_themes as $this_theme=>$attr) {
			unset($attr['theme_name']);
			$themes_attr_json[$this_theme] = json_encode($attr);
		}
		// If the currently saved theme is a user's theme but does NOT belong to the CURRENT user, then add to end of drop-down list
		if ($selected_theme != '' && !isset($survey_themes[$selected_theme])) {
			$other_user_theme = self::getThemes($selected_theme, true, true);
			$hasOtherUserThemes = true;
		}
		// Build drop-down options for survey theme choice
		$this_selected = ($selected_theme == '') ? " selected" : "";
		$survey_themes_opts = $survey_themes_user_opts = $survey_themes_other_user_opts = "";
		if ($hasUserThemes) {
			$survey_themes_user_opts = "<optgroup label='".cleanHtml($lang['survey_1039'])."'>";
		}
		if ($hasUserThemes || $hasOtherUserThemes) {
			$survey_themes_opts = "<optgroup label='".cleanHtml($lang['survey_1038'])."'>";
		}
		if ($hasOtherUserThemes) $survey_themes_other_user_opts = "<optgroup label='".cleanHtml($lang['survey_1040'])."'>";
		$survey_themes_opts .= "<option value='' attr='".$theme_attr_json_default."'$this_selected>{$lang['survey_1017']}</option>";
		foreach ($survey_themes as $this_theme=>$attr) {
			$this_theme_name = $attr['theme_name'];
			$this_selected = ($this_theme == $selected_theme) ? " selected" : "";
			if (isset($user_themes[$this_theme])) {
				$survey_themes_user_opts .= "<option value='$this_theme' attr='".$themes_attr_json[$this_theme]."'$this_selected>".RCView::escape($this_theme_name)."</option>";
			} else {
				$survey_themes_opts .= "<option value='$this_theme' attr='".$themes_attr_json[$this_theme]."'$this_selected>".RCView::escape($this_theme_name)."</option>";
			}
		}
		// If theme was created by another user (other than current user), then add at end of drop-down list
		if (!empty($other_user_theme)) {
			$this_theme_name = $other_user_theme['theme_name'];
			unset($other_user_theme['theme_name']);
			$theme_attr_json_other_user = json_encode($other_user_theme);
			$survey_themes_other_user_opts .= "<option value='$selected_theme' attr='".$theme_attr_json_other_user."' selected>".RCView::escape($this_theme_name)."</option>";
		}
		$survey_themes_opts .= $survey_themes_user_opts . $survey_themes_other_user_opts;
		// Return HTML for drop-down
		return "<select id='theme' name='theme' class='x-form-text x-form-field' style='' "
			 . "onchange='updateThemeIframe()'".($disabled ? ' disabled' : '').">$survey_themes_opts</select>";
	}
}
