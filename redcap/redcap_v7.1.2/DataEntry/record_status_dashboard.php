<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';
require_once APP_PATH_DOCROOT . "ProjectGeneral/form_renderer_functions.php";

// Add DAG to session if passed in query string for users NOT in a DAG
if (isset($_GET['dag']) && $user_rights['group_id'] == "")
{
	$_SESSION['dag_' . PROJECT_ID] = (int)$_GET['dag'];
}

// Return first arm that a given record exists in
function getFirstArmRecord($this_record, $recordsPerArm) {
	// Loop through arms till we find it. If not found, default to arm 1.
	foreach ($recordsPerArm as $arm=>$records) {
		if (isset($records[$this_record])) return $arm;
	}
	return '1';
}

// Get dashboard settings
$rd_id = isset($_GET['rd_id']) ? (int)$_GET['rd_id'] : null;
$dashboard = DataEntry::getRecordDashboardSettings($rd_id);

// Set dashboard title and instructions
$instructions = ($dashboard['rd_id'] == '') ? $lang['data_entry_176'] : filter_tags($dashboard['description']);
$title = ($dashboard['rd_id'] == '') ? '' : RCView::div(array('style'=>'font-size:16px;font-weight:bold;'), RCView::escape(strip_tags($dashboard['title'])));

// Set vertical/horizontal orientation values for table headers
$th_span1 = $th_span2 = '';
$th_width = 'width:35px;';
if ($dashboard['orientation'] == 'V') {
	$th_span1 = '<span class="vertical-text"><span class="vertical-text-inner">';
	$th_span2 = '</span></span>';
	$th_width = '';
}

// Has repeating instances?
$hasRepeatingFormsEvents = $Proj->hasRepeatingFormsEvents();

// Get list of all records
$recordNames = array_values(Records::getRecordList(PROJECT_ID, ($user_rights['group_id'] != '' ? $user_rights['group_id'] : (isset($_SESSION['dag_' . PROJECT_ID]) ? $_SESSION['dag_' . PROJECT_ID] : null)), true));
$numRecords = count($recordNames);

// Remove records from $formStatusValues array based upon page number
$num_per_page = ($numRecords <= 100) ? $numRecords : 100;
if (isset($_GET['num_per_page'])) {
	if (is_numeric($_GET['num_per_page'])) {
		$num_per_page = (int)$_GET['num_per_page'];
	} else {
		$num_per_page = $numRecords;
	}
}
$limit_begin  = 0;
if (isset($_GET['pagenum']) && is_numeric($_GET['pagenum']) && $_GET['pagenum'] > 1) {
	$limit_begin = ((int)$_GET['pagenum'] - 1) * $num_per_page;
} elseif (!isset($_GET['pagenum'])) {
	$_GET['pagenum'] = 1;
}

// Do not slice array if showall flag is in query string
if ($_GET['pagenum'] != 'ALL' && $numRecords > $num_per_page) {
	$recordNamesThisPage = array_slice($recordNames, $limit_begin, $num_per_page, true);
} else {
	$recordNamesThisPage = $recordNames;
}

// Get form status of just this page's records
$formStatusValues = Records::getFormStatus(PROJECT_ID, $recordNamesThisPage);
$numRecordsThisPage = count($formStatusValues);

// If this is a longitudinal project with multiple arms, then fill array denoting which arm that a record belongs to
$recordsPerArm = ($multiple_arms) ? Records::getRecordListPerArm($recordNamesThisPage) : array();

// Obtain custom record label & secondary unique field labels for ALL records.
if ($multiple_arms) {
	$extra_record_labels = array();
	foreach ($recordsPerArm as $this_arm=>$these_records) {
		$extra_record_labels_temp = Records::getCustomRecordLabelsSecondaryFieldAllRecords(array_keys($these_records), false, $this_arm);
		// Loop through the results and add each record's label (we loop because we may have one label per arm, and so this will concatenate them all together)
		foreach ($extra_record_labels_temp as $this_record=>$this_label) {
			if (!isset($extra_record_labels[$this_record])) {
				$extra_record_labels[$this_record] = $this_label;
			} else {
				$extra_record_labels[$this_record] .= " " . $this_label;
			}
		}
	}
	unset($extra_record_labels_temp);
} else {
	$extra_record_labels = Records::getCustomRecordLabelsSecondaryFieldAllRecords();// Obtain custom record label & secondary unique field labels for ALL records.
}

## LOCKING & E-SIGNATURES
$displayLocking = $displayEsignature = false;
// Check if need to display this info at all
$sql = "select display, display_esignature from redcap_locking_labels
		where project_id = $project_id and form_name in (".prep_implode(array_keys($Proj->forms)).")";
$q = db_query($sql);
if (db_num_rows($q) == 0) {
	$displayLocking = true;
} else {
	$lockFormCount = count($Proj->forms);
	$esignFormCount = 0;
	while ($row = db_fetch_assoc($q)) {
		if ($row['display'] == '0') $lockFormCount--;
		if ($row['display_esignature'] == '1') $esignFormCount++;
	}
	if ($esignFormCount > 0) {
		$displayLocking = $displayEsignature = true;
	} elseif ($lockFormCount > 0) {
		$displayLocking = true;
	}
}
// Get all locked records and put into an array
$locked_records = array();
if ($displayLocking) {
	$sql = "select record, event_id, form_name, instance from redcap_locking_data
			where project_id = $project_id and record in (".prep_implode(array_keys($formStatusValues)).")";
	$q = db_query($sql);
	if($q !== false)
	{
		while ($row = db_fetch_assoc($q)) {
			$locked_records[$row['record']][$row['event_id']][$row['form_name']][$row['instance']] = true;
		}
	}
}
// Get all e-signed records and put into an array
$esigned_records = array();
if ($displayEsignature) {
	$sql = "select record, event_id, form_name, instance from redcap_esignatures
			where project_id = $project_id and record in (".prep_implode(array_keys($formStatusValues)).")";
	$q = db_query($sql);
	while ($row = db_fetch_assoc($q)) {
		$esigned_records[$row['record']][$row['event_id']][$row['form_name']][$row['instance']] = true;
	}
}

// Build drop-down list of page numbers
$num_pages = ceil($numRecords/$num_per_page);
//$pageNumDropdownOptions = array('ALL'=>'-- '.$lang['docs_44'].' --');
$pageNumDropdownOptions = array();
for ($i = 1; $i <= $num_pages; $i++) {
	$end_num   = $i * $num_per_page;
	$begin_num = $end_num - $num_per_page + 1;
	$value_num = $end_num - $num_per_page;
	if ($end_num > $numRecords) $end_num = $numRecords;
	$pageNumDropdownOptions[$i] = "{$lang['survey_132']} $i {$lang['survey_133']} $num_pages{$lang['colon']} \"".removeDDEending($recordNames[$begin_num-1])."\" {$lang['data_entry_216']} \"".removeDDEending($recordNames[$end_num-1])."\"";
}
if ($num_pages == 0) {
	$pageNumDropdownOptions[0] = "0";
}

$dagsDropdown = '';
$dags = $Proj->getGroups();
if ($user_rights['group_id'] == '' && !empty($dags))
{
	$dagOptions = array('ALL'=>'-- ' . $lang['docs_44'] . ' --');
	$dag = isset($_SESSION['dag_' . PROJECT_ID]) ? (int)$_SESSION['dag_' . PROJECT_ID] : 0;

	foreach( $dags as $k => $v )
	{
		$dagOptions[$k] = $v;
	}

	$dagsDropdown = RCView::div(array('style'=>"margin-bottom:7px;"), $lang['data_entry_261'] . '&nbsp;&nbsp;' .
						RCView::select(array('class'=>'x-form-text x-form-field', 'style'=>'',
							'onchange'=>"showProgress(1);window.location.href=window.location.href+'&dag='+this.value;"),
							$dagOptions, $dag));
}


		
// Build drop-down list of records per page options, including any legacy values
$recordsPerPageOptions = array('ALL' => $lang['docs_44'] . " (".User::number_format_user($numRecords).")");
$defaultRecordsPerPage = array(10,25,50,100,250,500,1000);
if (is_numeric($num_per_page) && !in_array($num_per_page)) {
	array_push($defaultRecordsPerPage,$num_per_page);
	sort($defaultRecordsPerPage);
}
foreach ($defaultRecordsPerPage as $opt) {
	$recordsPerPageOptions[$opt] = $opt;
}

// Custom dashboards list
$dashboards = DataEntry::getRecordDashboardsList();
$dashboardsDropdown = RCView::div(array('class'=>'clearfix', 'style'=>"margin-bottom:7px;"), 
						RCView::div(array('style'=>'float:left;'),
							$lang['data_entry_334'] . '&nbsp;&nbsp;' .
							RCView::select(array('class'=>'x-form-text x-form-field', 
							'onchange'=>"showProgress(1);window.location.href=window.location.href+'&rd_id='+this.value;"),
							$dashboards, $rd_id)
						) .
						RCView::button(array('class'=>'btn btn-primary btn-xs', 'style'=>'float:right;font-size:13px;', 'onclick'=>"$('#configbox').toggle('fade');"), 
							RCView::img(array('src'=>'table__pencil.png', 'style'=>'position:relative;top:-1px;')) .
							$lang['data_entry_335']
						)
					  );
if (!isDev()) $dashboardsDropdown = "";

// Settings section
$dashboardOptionsBox = RCView::div(array('class'=>'chklist clearfix','style'=>'padding:8px 15px 7px;margin:5px 0 20px;max-width:750px;'),
						$dashboardsDropdown .
						$dagsDropdown .
						RCView::div(array('style'=>'float:left;'),
							$lang['data_entry_177'] .
							RCView::select(array('class'=>'x-form-text x-form-field','style'=>'margin-left:8px;margin-right:4px;',
								'onchange'=>"showProgress(1);window.location.href=window.location.href+'&pagenum='+this.value;"),
								$pageNumDropdownOptions, $_GET['pagenum'], 500) .
							$lang['survey_133'].
							RCView::span(array('style'=>'font-weight:bold;margin:0 4px;font-size:13px;'),
								User::number_format_user($numRecords)
							) .
							$lang['data_entry_173']
						) .
						// Num records per page
						RCView::div(array('style'=>'float:right;'),
							RCView::select(
								array('class'=>'x-form-text x-form-field',
									'style'=>'margin-right:4px;',
									'onchange'=>"showProgress(1);window.location.href=window.location.href+'&num_per_page='+this.value;"
								), $recordsPerPageOptions, ($num_per_page == $numRecords ? 'ALL' : $num_per_page)
							) . " " . $lang['data_entry_332']
						)
					);
if (isDev()) $dashboardOptionsBox .= DataEntry::createRecordDashboardBox();

// Determine if records also exist as a survey response for some instruments
$surveyResponses = array();
if ($surveys_enabled) {
	$surveyResponses = Survey::getResponseStatus($project_id, array_keys($formStatusValues));
}

// Determine if Real-Time Web Service is enabled, mapping is set up, and that this user has rights to adjudicate
$showRTWS = ($DDP->isEnabledInSystem() && $DDP->isEnabledInProject() && $DDP->userHasAdjudicationRights());

// If RTWS is enabled, obtain the cached item counts for the records being displayed on the page
if ($showRTWS)
{
	// Collect records with cached data into array with record as key and last fetch timestamp as value
	$records_with_cached_data = array();
	$sql = "select r.record, r.item_count from redcap_ddp_records r
			where r.project_id = $project_id and r.record in (" . prep_implode(array_keys($formStatusValues)) . ")";
	$q = db_query($sql);
	if($q !== false)
	{
		while ($row = db_fetch_assoc($q)) {
			if ($row['item_count'] === null) $row['item_count'] = ''; // Avoid null values because isset() won't work with it as an array value
			$records_with_cached_data[$row['record']] = $row['item_count'];
		}
	}
}


/*
DON'T ADD THIS FEATURE YET! Issues with floating clone table and also with drop-down list of records for paging (i.e this is complicated)

// If using Order Records By feature, then order records by that field's value instead of by record name
if (!$longitudinal && $order_id_by != '')
{
	// Get all values for the Order Records By field
	$order_id_by_records = Records::getData('array', array_keys($formStatusValues), $order_id_by);
	// Isolate values only into separate array
	$order_id_by_values = $recordList = array();
	foreach ($formStatusValues as $this_record=>$this_event_data) {
		// Add record names to array to deal with multisort reindexing numeric keys (!)
		$recordList[] = $this_record;
		// Loop through each event
		foreach ($this_event_data as $this_event_id=>$these_fields_data) {
			// If record has value, then add it, otherwise add blank value as placeholder
			if (isset($order_id_by_records[$this_record][$this_event_id][$order_id_by])) {
				$order_id_by_values[$this_record] = $order_id_by_records[$this_record][$this_event_id][$order_id_by];
			} else {
				$order_id_by_values[$this_record] = "";
			}
		}
	}
	// Now sort $formStatusValues by values in $order_id_by_values
	array_multisort($order_id_by_values, SORT_STRING, $recordList, SORT_STRING, $formStatusValues);
	// Fix the array indexes (since they got lost) and also move all blank values to very end of array (since they get ordered as first)
	$formStatusValues2 = $formStatusValuesEmptyOrderIdBy = array();
	foreach ($recordList as $key=>$this_record) {
		// Get all event data for this record
		$record_data = $formStatusValues[$key];
		// Remove record data from original array (since we are moving it)
		unset($formStatusValues[$key]);
		// If Order Records By value is blank, add to $formStatusValuesEmptyOrderIdBy
		if ($order_id_by_values[$key] == "") {
			$formStatusValuesEmptyOrderIdBy[$this_record] = $record_data;
		} else {
			// Add to new array
			$formStatusValues2[$this_record] = $record_data;
		}
	}
	// Merge arrays
	foreach ($formStatusValuesEmptyOrderIdBy as $this_record=>$record_data) {
		$formStatusValues2[$this_record] = $record_data;
		unset($formStatusValuesEmptyOrderIdBy[$this_record]);
	}
	// Remove all unnecessary arrays to clear up memory
	$formStatusValues = $formStatusValues2;
	unset($order_id_by_records, $order_id_by_values, $formStatusValuesEmptyOrderIdBy, $formStatusValues2);
}
 */


// Obtain a list of all instruments used for all events (used to iterate over header rows and status rows)
$formsEvents = $formsEventsColspan = array();
// Loop through each event and output each where this form is designated
if ($dashboard['group_by'] == 'event') {
	foreach ($Proj->eventsForms as $this_event_id=>$these_forms) {
		// Loop through forms
		foreach ($these_forms as $form_name) {
			// If user does not have form-level access to this form, then do not display it
			if (!isset($user_rights['forms'][$form_name]) || $user_rights['forms'][$form_name] < 1) continue;
			// Add to array
			$formsEvents[] = array('form_name'=>$form_name, 'event_id'=>$this_event_id);
			// Set colspan for event/form, depending on group_by
			if (isset($formsEventsColspan[$this_event_id])) {
				$formsEventsColspan[$this_event_id]++;
			} else {
				$formsEventsColspan[$this_event_id] = 1;
			}
		}
	}
} else {
	foreach (array_keys($Proj->forms) as $form_name) {
		// If user does not have form-level access to this form, then do not display it
		if (!isset($user_rights['forms'][$form_name]) || $user_rights['forms'][$form_name] < 1) continue;
		// Loop through events
		foreach ($Proj->eventsForms as $this_event_id=>$these_forms) {
			// Skip if form not designated for this event
			if (!in_array($form_name, $these_forms)) continue;
			// Add to array
			$formsEvents[] = array('form_name'=>$form_name, 'event_id'=>$this_event_id);
			// Set colspan for event/form, depending on group_by
			if (isset($formsEventsColspan[$form_name])) {
				$formsEventsColspan[$form_name]++;
			} else {
				$formsEventsColspan[$form_name] = 1;
			}
		}
		
	}
}


// HEADERS: Add all row HTML into $rows. Add header to table first.
$hdrs = RCView::th(array('class'=>'header', 'rowspan'=>($longitudinal ? '2' : '1'), 'style'=>'text-align:center;color:#800000;padding:5px 10px;vertical-align:bottom;'), 
			$th_span1 . $table_pk_label . $th_span2
		);
// If RTWS is enabled, then display column for it
if ($showRTWS) {
	$hdrs .= RCView::th(array('id'=>'rtws_rsd_hdr', 'rowspan'=>($longitudinal ? '2' : '1'), 'class'=>'wrap darkgreen', 'style'=>'line-height:10px;width:100px;font-size:11px;text-align:center;padding:5px;white-space:normal;vertical-align:bottom;'),
				RCView::div(array('style'=>'font-weight:bold;font-size:12px;margin-bottom:7px;'),
					RCView::img(array('src'=>'databases_arrow.png')) .
					$lang['ws_30']
				) .
				$lang['ws_06'] . RCView::SP . $DDP->getSourceSystemName()
			);
}
if ($longitudinal) {
	$prev_event_id = $prev_form_name = null;
	foreach ($formsEvents as $attr) {
		if ($dashboard['group_by'] == 'event') {
			// Skip if already did this event
			if ($prev_event_id == $attr['event_id']) continue;
			// Group by event
			$hdrs .= RCView::th(array('class'=>'header', 'colspan'=>$formsEventsColspan[$attr['event_id']], 'style'=>'color:#800000;font-size:11px;text-align:center;padding:5px;white-space:normal;vertical-align:bottom;'),
						RCView::escape($Proj->eventInfo[$attr['event_id']]['name_ext'])
					);
			$prev_event_id = $attr['event_id'];
		} else {
			// Skip if already did this event
			if ($prev_form_name == $attr['form_name']) continue;
			// Group by form
			$hdrs .= RCView::th(array('class'=>'header', 'colspan'=>$formsEventsColspan[$attr['form_name']], 'style'=>'font-size:11px;text-align:center;padding:5px;white-space:normal;vertical-align:bottom;'),
						RCView::escape($Proj->forms[$attr['form_name']]['menu'])
					);
			$prev_form_name = $attr['form_name'];
		}
	}
	$rows = RCView::tr('', $hdrs);
	$hdrs = "";
}
foreach ($formsEvents as $attr) {
	if ($dashboard['group_by'] == 'event') {
		// Group by event
		$hdrs .= RCView::th(array('class'=>'header', 'style'=>$th_width.'font-size:11px;text-align:center;padding:3px;white-space:normal;vertical-align:bottom;'),
					RCView::div(array('style'=>($longitudinal ? 'font-weight:normal;' : '')), 
						$th_span1 . RCView::escape($Proj->forms[$attr['form_name']]['menu']) . $th_span2
					)
				);
	} else {
		// Group by form
		$hdrs .= RCView::th(array('class'=>'header', 'style'=>$th_width.'color:#800000;font-size:11px;text-align:center;padding:3px;white-space:normal;vertical-align:bottom;'),
					RCView::div(array('style'=>($longitudinal ? 'font-weight:normal;' : '')), 
						$th_span1 . RCView::escape($Proj->eventInfo[$attr['event_id']]['name_ext']) . $th_span2
					)
				);		
	}
}
$rows .= RCView::tr('', $hdrs);
$rows = RCView::thead('', $rows);


// IF NO RECORDS EXIST, then display a single row noting that
if (empty($formStatusValues))
{
	$rows .= RCView::tr('',
				RCView::td(array('class'=>'data','colspan'=>count($formsEvents)+($showRTWS ? 1 : 0)+1,'style'=>'font-size:12px;padding:10px;color:#555;'),
					$lang['data_entry_179']
				)
			);
}

// ADD ROWS: Get form status values for all records/events/forms and loop through them
foreach ($formStatusValues as $this_record=>$rec_attr)
{
	// For each record (i.e. row), loop through all forms/events
	$this_row = RCView::td(array('class'=>'data','style'=>'font-size:12px;padding:0 10px;'),
					// For longitudinal, create record name as link to event grid page
					// (isDev() || $longitudinal
						// ? RCView::a(array('href'=>APP_PATH_WEBROOT . "DataEntry/record_home.php?pid=$project_id&arm=".getFirstArmRecord($this_record, $recordsPerArm)."&id=".removeDDEending($this_record), 'style'=>'text-decoration:underline;font-size:13px;'), removeDDEending($this_record))
						// : removeDDEending($this_record)
					// ) .
					RCView::a(array('href'=>APP_PATH_WEBROOT . "DataEntry/record_home.php?pid=$project_id&arm=".getFirstArmRecord($this_record, $recordsPerArm)."&id=".removeDDEending($this_record), 'style'=>'text-decoration:underline;font-size:13px;'), removeDDEending($this_record)) .
					// Display custom record label or secondary unique field (if applicable)
					(isset($extra_record_labels[$this_record]) ? '&nbsp;&nbsp;' . $extra_record_labels[$this_record] : '')
				);
	// If RTWS is enabled, then display column for it
	if ($showRTWS) {
		// If record already has cached data, then obtain count of unadjudicated items for this record
		if (isset($records_with_cached_data[$this_record])) {
			// Get number of items to adjudicate and the html to display inside the dialog
			if ($records_with_cached_data[$this_record] != "") {
				$itemsToAdjudicate = $records_with_cached_data[$this_record];
			} else {
				list ($itemsToAdjudicate, $newItemsTableHtml)
					= $DDP->fetchAndOutputData($this_record, null, array(), $realtime_webservice_offset_days, $realtime_webservice_offset_plusminus,
												false, true, false, false);
			}
		} else {
			// No cached data for this record
			$itemsToAdjudicate = 0;
		}
		// Set display values
		if ($itemsToAdjudicate == 0) {
			$rtws_row_class = "darkgreen";
			$rtws_item_count_style = "color:#999;font-size:10px;";
			$num_items_text = $lang['dataqueries_259'];
		} else {
			$rtws_row_class = "data statusdashred";
			$rtws_item_count_style = "color:red;font-size:15px;font-weight:bold;";
			$num_items_text = $itemsToAdjudicate;
		}
		// Display row
		$this_row .= RCView::td(array('class'=>$rtws_row_class, 'id'=>'rtws_new_items-'.$this_record, 'style'=>'font-size:12px;padding:0 5px;text-align:center;'),
						'<div style="float:left;width:50px;text-align:center;'.$rtws_item_count_style.'">'.$num_items_text.'</div>
						<div style="float:right;"><a href="javascript:;" onclick="triggerRTWSmappedField(\''.cleanHtml2($this_record).'\',true);" style="font-size:10px;text-decoration:underline;">'.$lang['dataqueries_92'].'</a></div>
						<div style="clear:both:height:0;"></div>'
					);
	}
	// Loop through each column
	$lockimgStatic  = trim(RCView::img(array('class'=>'lock', 'src'=>'lock_small.png')));
	$esignimgStatic = trim(RCView::img(array('class'=>'esign', 'src'=>'tick_shield_small.png')));
	$lockimgMultipleStatic  = trim(RCView::img(array('class'=>'lock', 'src'=>'locks_small.png')));
	$esignimgMultipleStatic = trim(RCView::img(array('class'=>'esign', 'src'=>'tick_shields_small.png')));
	foreach ($formsEvents as $attr)
	{
		// If a longitudinal project with multiple arms, do NOT display the icon if record does NOT belong to this arm
		if ($multiple_arms && !isset($recordsPerArm[$Proj->eventInfo[$attr['event_id']]['arm_num']][$this_record])) {
			$td = '';
		} else {
			// Determine status
			$this_status_array = $rec_attr[$attr['event_id']][$attr['form_name']];
			$status_concat = trim(implode('', $this_status_array));
			$status_count = strlen($status_concat);
			$form_has_mixed_statuses = false;
			$form_has_multiple_instances = ($status_count > 1);
			if ($form_has_multiple_instances) {
				// Determine if all statuses are same or mixed status values
				$all0s = (str_replace('0', '', $status_concat) == '');
				$all1s = (str_replace('1', '', $status_concat) == '');
				$all2s = (str_replace('2', '', $status_concat) == '');
				$form_has_mixed_statuses = !($all0s || $all1s || $all2s);
				// Set array of values to single value
				if ($all0s) {
					$this_status_array = '0';
				} elseif ($all1s) {
					$this_status_array = '1';
				} elseif ($all2s) {
					$this_status_array = '2';
				}
			} else {
				$this_status_array = $this_status_array[1];
			}
			// Mixed status icon
			if ($form_has_mixed_statuses) {
				$img = 'circle_blue_stack.png';
			} else {
				// If it's a survey response, display different icons
				if (isset($surveyResponses[$this_record][$attr['event_id']][$attr['form_name']][1])) {
					//Determine color of button based on response status
					switch ($surveyResponses[$this_record][$attr['event_id']][$attr['form_name']][1]) {
						case '2':
							$img = ($form_has_multiple_instances) ? 'circle_green_tick_stack.png' : 'circle_green_tick.png';
							break;
						default:
							$img = ($form_has_multiple_instances) ? 'circle_orange_tick_stack.png' : 'circle_orange_tick.png';
					}
				} else {
					// Set image HTML
					if ($this_status_array == '2') {
						$img = ($form_has_multiple_instances) ? 'circle_green_stack.png' : 'circle_green.png';
					} elseif ($this_status_array == '1') {
						$img = ($form_has_multiple_instances) ? 'circle_yellow_stack.png' : 'circle_yellow.png';
					} elseif ($this_status_array == '0') {
						$img = ($form_has_multiple_instances) ? 'circle_red_stack.png' : 'circle_red.png';
					} else {
						$img = 'circle_gray.png';
					}
				}
			}
			// If locked and/or e-signed, add icon
			$lockimg = $esignimg = "";
			if ($hasRepeatingFormsEvents) {
				$locked_instances = $locked_records[$this_record][$attr['event_id']][$attr['form_name']];
				$esigned_instances = $esigned_records[$this_record][$attr['event_id']][$attr['form_name']];
				if (isset($locked_instances)) {
					$lockimg = (count($locked_instances) > 1) ? $lockimgMultipleStatic : $lockimgStatic;
				}
				if (isset($esigned_instances)) {
					$esignimg = (count($esigned_instances) > 1) ? $esignimgMultipleStatic : $esignimgStatic;
				}
			} else {
				if (isset($locked_records[$this_record][$attr['event_id']][$attr['form_name']]))  $lockimg = $lockimgStatic;
				if (isset($esigned_records[$this_record][$attr['event_id']][$attr['form_name']])) $esignimg = $esignimgStatic;
			}
			$lockingEsignImg = $lockimg . $esignimg; 
			// Set icon style
			$statusIconStyle = ($form_has_multiple_instances) ? 'width:22px;' : 'width:16px;margin-right:6px;';
			// If this is a repeating form, then add a + button to add new instance
			$addRptBtn = '';
			if ($Proj->isRepeatingForm($attr['event_id'], $attr['form_name'])) {
				// Get next instance number
				$next_instance = max(array_keys($rec_attr[$attr['event_id']][$attr['form_name']])) + 1;
				// Display button
				$this_url = APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&id=".urlencode(removeDDEending($this_record))."&event_id={$attr['event_id']}&page={$attr['form_name']}";
				$addRptBtn = "<button title='".cleanHtml($lang['grid_43'])."' onclick=\"window.location.href='$this_url&instance=$next_instance';\" class='btn btn-defaultrc btnAddRptEv ".($this_status_array == '' ? "invis" : "opacity50")."'>+</button>";
				// Locking/esign icon
				if ($lockingEsignImg != '') $lockingEsignImg = trim(RCView::span(array('class'=>'lockEsignIcons nowrap'), $lockingEsignImg));
			}
			// If has multiple statuses (blue), add click event to open table to see all instances
			if ($form_has_multiple_instances) {
				$href = "javascript:;";
				$onclick = "onclick=\"loadInstancesTable(this,'".cleanHtml($this_record)."', {$attr['event_id']}, '{$attr['form_name']}');\"";
			} else {
				$href = APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&id=".removeDDEending($this_record)."&page={$attr['form_name']}&event_id={$attr['event_id']}";
				$onclick = "";
			}
			// Add cell
			$td = "<a href='$href' $onclick style='text-decoration:none;'><img src='".APP_PATH_IMAGES."$img' class='fstatus' style='$statusIconStyle' $iconOnlick></a>" .
				  $addRptBtn . $lockingEsignImg;
		}			
		// Add column to row
		$this_row .= RCView::td(array('class'=>'data nowrap', 'style'=>'text-align:center;height:20px;'), $td);
	}
	$rows .= RCView::tr('', $this_row);
}


// Get all repeating events
$repeatingFormsEvents = $Proj->getRepeatingFormsEvents();
$hasRepeatingForms = $Proj->hasRepeatingForms();
$hasRepeatingEvents = $Proj->hasRepeatingEvents();
$hasRepeatingFormsOrEvents = ($hasRepeatingForms || $hasRepeatingEvents);



// Page header
include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

// JavaScript for setting floating table headers
?>
<script type="text/javascript">
// Replace all record "fetch" buttons with spinning progress icon
var recordProgressIcon = '<img src="'+app_path_images+'progress_circle.gif" class="imgfix2">';
$(function(){
	// Enable fixed table headers for event grid
	enableFixedTableHdrs('record_status_table');
	// Enable repeating forms buttons
	$('table td .btnAddRptEv').on({
		mouseenter: function(){
			$(this).removeClass('opacity50').removeClass('btn-defaultrc').addClass('btn-success');
		},
		mouseleave: function () {
			$(this).removeClass('btn-success').addClass('btn-defaultrc').addClass('opacity50');
		}
	});
});
function changeLinkStatus(ob) {
	$(ob).parents('div:first').find('a').removeClass('statuslink_selected').addClass('statuslink_unselected');
	$(ob).removeClass('statuslink_unselected').addClass('statuslink_selected');
}
</script>
<style type="text/css">
a.statuslink_selected { color:#777; }
a.statuslink_unselected { text-decoration:underline; }
.lock, .esign { display:none;margin:1px 1px 2px 1px; }
.lockEsignIcons { margin-left:4px;display:none; }
#record_status_table { margin-bottom: 50px; border-right:1px solid #aaaaaa;border-bottom:1px solid #aaaaaa; }
table.dataTable thead tr th, table.dataTable tbody tr td { border-bottom: 0; border-right:0; }
#configbox textarea {
	max-height: 300px;
}
#configbox .td1 {
	font-weight:bold;
	width:20%;
}
#configbox .td2 {
	width:80%;
}
</style>
<?php

// Page title
renderPageTitle("<img src='".APP_PATH_IMAGES."application_view_icons.png'> {$lang['global_91']} {$lang['bottom_61']}");
// Instructions and Legend for colored status icons
print	RCView::table(array('class'=>'hidden-xs', 'style'=>'max-width:850px;table-layout:fixed;'),
			RCView::tr('',
				RCView::td(array('class'=>'col-xs-8', 'style'=>'padding:10px 10px 10px 0;', 'valign'=>'bottom'),
					// Title and instructions
					$title . $instructions					
				) .
				RCView::td(array('valign'=>'bottom','style'=>($hasRepeatingFormsOrEvents && $surveys_enabled ? 'width:400px;' : 'width:320px;')),
					// Legend
					RCView::div(array('class'=>'chklist','style'=>'background-color:#eee;border:1px solid #ccc;'),
						RCView::table(array('id'=>'status-icon-legend'),
							RCView::tr('',
								RCView::td(array('colspan'=>'2', 'style'=>'font-weight:bold;'),
									$lang['data_entry_178']
								)
							) .
							RCView::tr('',
								RCView::td(array('class'=>'nowrap', 'style'=>'padding-right:5px;'),
									RCView::img(array('src'=>'circle_red.png')) . $lang['global_92']
								) .
								RCView::td(array('class'=>'nowrap', 'style'=>''),
									RCView::img(array('src'=>'circle_gray.png')) . $lang['global_92'] . " " . $lang['data_entry_205'] .
									RCView::a(array('href'=>'javascript:;', 'class'=>'help', 'title'=>$lang['global_58'], 'onclick'=>"simpleDialog('".cleanHtml($lang['data_entry_232'])."','".cleanHtml($lang['global_92'] . " " . $lang['data_entry_205'])."');"), '?')
								)
							) .
							RCView::tr('',
								RCView::td(array('class'=>'nowrap', 'style'=>'padding-right:5px;'),
									RCView::img(array('src'=>'circle_yellow.png')) . $lang['global_93']
								) .
								RCView::td(array('class'=>'nowrap', 'style'=>''),
									($surveys_enabled 
										? RCView::img(array('src'=>'circle_orange_tick.png')) . $lang['global_95']
										: (!$hasRepeatingFormsOrEvents ? "" :
											(RCView::img(array('src'=>'circle_green_stack.png')) . RCView::img(array('src'=>'circle_yellow_stack.png', 'style'=>'position:relative;left:-6px;')) . 
											RCView::img(array('src'=>'circle_red_stack.png', 'style'=>'position:relative;left:-12px;')) . 
											RCView::span(array('style'=>'position:relative;left:-12px;'), $lang['data_entry_282'])))
									)
								)
							) .
							RCView::tr('',
								RCView::td(array('class'=>'nowrap', 'style'=>'padding-right:5px;'),
									RCView::img(array('src'=>'circle_green.png')) . $lang['survey_28']
								) .
								RCView::td(array('class'=>'nowrap', 'style'=>''),
									($surveys_enabled 
										? RCView::img(array('src'=>'circle_green_tick.png')) . $lang['global_94']
										: (!$hasRepeatingFormsOrEvents ? "" : RCView::img(array('src'=>'circle_blue_stack.png')) . $lang['data_entry_281'])
									)
								)
							) .
							( !($hasRepeatingFormsOrEvents && $surveys_enabled) ? "" :
								RCView::tr('',
									RCView::td(array('class'=>'nowrap', 'style'=>'padding-right:5px;'),
										RCView::img(array('src'=>'circle_blue_stack.png')) . $lang['data_entry_281']
									) .
									RCView::td(array('class'=>'nowrap', 'style'=>''),
										RCView::img(array('src'=>'circle_green_stack.png')) . RCView::img(array('src'=>'circle_yellow_stack.png', 'style'=>'position:relative;left:-6px;')) . 
										RCView::img(array('src'=>'circle_red_stack.png', 'style'=>'position:relative;left:-12px;')) . 
										RCView::span(array('style'=>'position:relative;left:-12px;'), $lang['data_entry_282'])
									)
								)
							)
						)
					)
				)
			)
		);
// Table of records
print	$dashboardOptionsBox .
		// Options to view locking and/or esignature status
		(!($displayLocking || $displayEsignature) ? '' :
			RCView::div(array('style'=>'margin-bottom:10px;color:#888;'),
				RCView::span(array('style'=>'font-weight:bold;margin-right:10px;color:#000;'), $lang['data_entry_225']) .
				// Instrument status only
				RCView::a(array('href'=>'javascript:;', 'class'=>'statuslink_selected', 'onclick'=>"changeLinkStatus(this);$('.esign, .lock, .lockEsignIcons').hide();$('.fstatus, .btnAddRptEv').show();"),
					 $lang['data_entry_226']) .
				// Lock only
				(!$displayLocking ? '' :
					RCView::SP . " | " . RCView::SP .
					RCView::a(array('href'=>'javascript:;', 'class'=>'statuslink_unselected', 'onclick'=>"changeLinkStatus(this);$('.fstatus, .btnAddRptEv, .esign').hide();$('.lock, .lockEsignIcons').show();"),
						 $lang['data_entry_227'])
					) .
				// Esign only
				(!$displayEsignature ? '' :
					RCView::SP . " | " . RCView::SP .
					RCView::a(array('href'=>'javascript:;', 'class'=>'statuslink_unselected', 'onclick'=>"changeLinkStatus(this);$('.fstatus, .btnAddRptEv, .lock').hide();$('.esign, .lockEsignIcons').show();"),
						 $lang['data_entry_228'])
				) .
				// Esign + Locking
				(!($displayLocking && $displayEsignature) ? '' :
					RCView::SP . " | " . RCView::SP .
					RCView::a(array('href'=>'javascript:;', 'class'=>'statuslink_unselected', 'onclick'=>"changeLinkStatus(this);$('.fstatus, .btnAddRptEv').hide();$('.lock, .esign, .lockEsignIcons').show();"),
						 $lang['data_entry_230'])
				) .
				// All types
				RCView::SP . " | " . RCView::SP .
				RCView::a(array('href'=>'javascript:;', 'class'=>'statuslink_unselected', 'onclick'=>"changeLinkStatus(this);$('.btnAddRptEv').hide();$('.fstatus, .lock, .esign, .lockEsignIcons').show();"),
					 $lang['data_entry_229'])
			)
		) .
		"<table id='record_status_table' class='form_border'>$rows</table>" .
		// If more than 30 records exist on page, then re-display the dashboard options box at bottom of page
		($numRecordsThisPage > 30 ? $dashboardOptionsBox : "");

// If RTWS is enabled, then display column for it
if ($showRTWS) {
	$DDP->renderJsAdjudicationPopup('');
}

// Page footer
include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';