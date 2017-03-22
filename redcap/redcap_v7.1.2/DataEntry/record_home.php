<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/
require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';
//Required files
require_once APP_PATH_DOCROOT . 'ProjectGeneral/form_renderer_functions.php';
require_once APP_PATH_DOCROOT . 'ProjectGeneral/math_functions.php';
require_once APP_PATH_DOCROOT  . 'Surveys/survey_functions.php';
// Auto-number logic (pre-submission of new record)
if ($auto_inc_set) {
	// If the auto-number record selected has already been created by another user, fetch the next one to prevent overlapping data
	if (isset($_GET['id']) && isset($_GET['auto'])) {
		$q = db_query("select 1 from redcap_data where project_id = $project_id and record = '".prep($_GET['id'])."' limit 1");
		if (db_num_rows($q) > 0) {
			// Record already exists, so redirect to new page with this new record value
			redirect(PAGE_FULL . "?pid=$project_id&page={$_GET['page']}&id=" . getAutoId());
		}
	}
}
//Get arm number from URL var 'arm'
$arm = getArm();
// Reload page if id is a blank value
if (isset($_GET['id']) && trim($_GET['id']) == "")
{
	redirect(PAGE_FULL . "?pid=" . PROJECT_ID . "&page=" . $_GET['page'] . "&arm=" . $arm);
	exit;
}
// Clean id
if (isset($_GET['id'])) {
	$_GET['id'] = strip_tags(label_decode($_GET['id']));
}
include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';
// Header
if (isset($_GET['id'])) {
	renderPageTitle("<img src='".APP_PATH_IMAGES."application_view_tile.png'> ".$lang['grid_42']);
} else {
	// Hook: redcap_add_edit_records_page
	Hooks::call('redcap_add_edit_records_page', array(PROJECT_ID, null, null));
	renderPageTitle("<img src='".APP_PATH_IMAGES."blog_pencil.gif'> " . ($user_rights['record_create'] ? $lang['bottom_62'] : $lang['bottom_72']));
}
//Custom page header note
if (trim($custom_data_entry_note) != '') {
	print "<br><div class='green' style='font-size:11px;'>" . str_replace("\n", "<br>", $custom_data_entry_note) . "</div>";
}
// Get all repeating events
$repeatingFormsEvents = $Proj->getRepeatingFormsEvents();
$hasRepeatingForms = $Proj->hasRepeatingForms();
$hasRepeatingEvents = $Proj->hasRepeatingEvents();
$hasRepeatingFormsOrEvents = ($hasRepeatingForms || $hasRepeatingEvents);
//Alter how records are saved if project is Double Data Entry (i.e. add --# to end of Study ID)
if ($double_data_entry && $user_rights['double_data'] != 0) {
	$entry_num = "--" . $user_rights['double_data'];
} else {
	$entry_num = "";
}
## GRID
if (isset($_GET['id']))
{
	## If study id has been entered or selected, display grid.
	//Adapt for Double Data Entry module
	if ($entry_num == "") {
		//Not Double Data Entry or this is Reviewer of Double Data Entry project
		$id = $_GET['id'];
	} else {
		//This is #1 or #2 Double Data Entry person
		$id = $_GET['id'] . $entry_num;
	}
	$sql = "select d.record from redcap_events_metadata m, redcap_events_arms a, redcap_data d where a.project_id = $project_id
			and a.project_id = d.project_id and m.event_id = d.event_id and a.arm_num = $arm and a.arm_id = m.arm_id
			and d.record = '".prep($id)."' limit 1";
	$q = db_query($sql);
	$row_num = db_num_rows($q);
	$existing_record = ($row_num > 0);
	
	// If NOT an existing record AND project has only ONE FORM, then redirect to the first viable form
	if (!$existing_record && !$longitudinal && count($Proj->forms) == 1 && $user_rights['forms'][$Proj->firstForm] > 0) 
	{
		redirect(APP_PATH_WEBROOT . "DataEntry/index.php?pid=" . PROJECT_ID . "&page=" . $Proj->firstForm . "&id=" . $_GET['id']
				. ($auto_inc_set ? "&auto=1" : ""));
	} 
	elseif (!$existing_record && $longitudinal) 
	{
		$viableEventsThisArm = array_intersect_key($Proj->eventsForms, $Proj->events[$arm]['events']);
		if (count($viableEventsThisArm) == 1) {
			$thisArmFirstEventId = array_shift(array_keys($viableEventsThisArm));
			$formsThisArmFirstEventId = array_shift($viableEventsThisArm);
			if (count($formsThisArmFirstEventId) == 1) {
				$firstFormThisArm = array_shift($formsThisArmFirstEventId);
				redirect(APP_PATH_WEBROOT . "DataEntry/index.php?pid=" . PROJECT_ID . "&page=$firstFormThisArm&id=" . $_GET['id']
						. "&event_id=$thisArmFirstEventId" . ($auto_inc_set ? "&auto=1" : ""));
			}
		}
	}
	
	## LOCK RECORDS & E-SIGNATURES
	// For lock/unlock records feature, show locks by any forms that are locked (if a record is pulled up on data entry page)
	$locked_forms = $locked_forms_grid = $esigned_forms_grid = array();
	$qsql = "select event_id, form_name, instance, timestamp from redcap_locking_data 
			where project_id = $project_id and record = '" . prep($id). "'";
	if ($longitudinal && isset($Proj->events[$arm])) {
		$qsql .= " and event_id in (".prep_implode(array_keys($Proj->events[$arm]['events'])).")";
	} else {
		$qsql .= " and event_id = " . $Proj->firstEventId;
	}
	$q = db_query($qsql);
	while ($row = db_fetch_array($q)) {
		$this_lock_ts = " <img class='gridLockIcon' src='".APP_PATH_IMAGES."lock_small.png' title='".cleanHtml($lang['bottom_59'])." ".DateTimeRC::format_ts_from_ymd($row['timestamp'])."'>";
		$locked_forms[$row['event_id'].",".$row['form_name'].",".$row['instance']] = $this_lock_ts;
		if ($hasRepeatingForms && $Proj->isRepeatingForm($row['event_id'], $row['form_name']) && isset($locked_forms_grid[$row['event_id'].",".$row['form_name']])) {
			$locked_forms_grid[$row['event_id'].",".$row['form_name']] = " <img class='gridLockIcon' src='".APP_PATH_IMAGES."locks_small.png' title='".cleanHtml($lang['data_entry_283'])."'>";
		}
		if (!isset($locked_forms_grid[$row['event_id'].",".$row['form_name']])) {
			$locked_forms_grid[$row['event_id'].",".$row['form_name']] = $this_lock_ts;
		}
	}
	// E-signatures
	$qsql = "select event_id, form_name, instance, timestamp from redcap_esignatures 
			where project_id = $project_id and record = '" . prep($id). "'";
	if ($longitudinal && isset($Proj->events[$arm])) {
		$qsql .= " and event_id in (".prep_implode(array_keys($Proj->events[$arm]['events'])).")";
	} else {
		$qsql .= " and event_id = " . $Proj->firstEventId;
	}
	$q = db_query($qsql);
	while ($row = db_fetch_array($q)) {
		$this_esign_ts = " <img class='gridEsignIcon' src='".APP_PATH_IMAGES."tick_shield_small.png' title='".cleanHtml($lang['data_entry_224'])." ".DateTimeRC::format_ts_from_ymd($row['timestamp'])."'>";
		if (isset($locked_forms[$row['event_id'].",".$row['form_name'].",".$row['instance']])) {
			$locked_forms[$row['event_id'].",".$row['form_name'].",".$row['instance']] .= $this_esign_ts;
		} else {
			$locked_forms[$row['event_id'].",".$row['form_name'].",".$row['instance']] = $this_esign_ts;
		}
		if ($hasRepeatingForms && $Proj->isRepeatingForm($row['event_id'], $row['form_name']) && isset($esigned_forms_grid[$row['event_id'].",".$row['form_name']])) {
			$esigned_forms_grid[$row['event_id'].",".$row['form_name']] = " <img class='gridEsignIcon' src='".APP_PATH_IMAGES."tick_shields_small.png' title='".cleanHtml($lang['data_entry_284'])."'>";
		}
		if (!isset($esigned_forms_grid[$row['event_id'].",".$row['form_name']])) {
			$esigned_forms_grid[$row['event_id'].",".$row['form_name']] = $this_esign_ts;
		}
	}
	//Check if record exists in another group, if user is in a DAG
	if ($user_rights['group_id'] != "" && $existing_record)
	{
		$q = db_query("select 1 from redcap_data where project_id = $project_id and record = '".prep($id)."' and
						  field_name = '__GROUPID__' and value = '{$user_rights['group_id']}' limit 1");
		if (db_num_rows($q) < 1) {
			//Record is not in user's DAG
			print  "<div class='red'>
						<img src='".APP_PATH_IMAGES."exclamation.png'>
						<b>{$lang['global_49']} ".$_GET['id']." {$lang['grid_13']}</b><br><br>
						{$lang['grid_14']}<br><br>
						<a href='".APP_PATH_WEBROOT."DataEntry/record_home.php?pid=$project_id' style='text-decoration:underline'><< {$lang['grid_15']}</a>
						<br><br>
					</div>";
			include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
			exit;
		}
	}
	## If new study id, give some brief instructions above normal instructions.
	if (!$existing_record) {
		print  "<p style='max-width:800px;margin-top:15px;color:#008000;'>
					<img src='".APP_PATH_IMAGES."add.png'>
					<span style='vertical-align:middle;'>
						<b>{$lang['global_49']} \"{$_GET['id']}\" {$lang['grid_16']} ".RCView::escape($table_pk_label)."{$lang['period']}</b> {$lang['grid_47']}
					</span>
				</p>";
	}
	// PIPING for Custom Event Label
	$event_label_piping_data = array();
	$custom_event_labels_all = "";
	if ($existing_record) {
		// Gather all custom event label fields
		$custom_event_labels_all = "";
		foreach ($Proj->eventInfo as $attr) {
			$custom_event_labels_all .= " " . $attr['custom_event_label'];
		}
		$custom_event_labels_all = trim($custom_event_labels_all);
		$custom_event_label_fields = array_keys(getBracketedFields($custom_event_labels_all, true, false, true));
		$event_label_piping_data = Records::getData('array', $id, $custom_event_label_fields);
	}
	
	// Get array of DAGs
	$dags = $Proj->getGroups();
	
	## RECORD ACTIONS (locking, delete record, etc.)
	if ($existing_record)
	{
		// Get the record's DAG assignment, if applicable
		$recordDag = empty($dags) ? false : Records::getRecordGroupId($project_id, addDDEending($_GET['id']));
		// Customize prompt message for deleting record button
		$delAlertMsg = $lang['data_entry_188'];
		if ($longitudinal) {
			$delAlertMsg .= " <b>".$lang['data_entry_51'];
			if ($multiple_arms) {
				$delAlertMsg .= " ".$lang['data_entry_52'];
			}
			$delAlertMsg .= $lang['period']."</b>";
		} else {
			$delAlertMsg .= " <b>".$lang['data_entry_189']."</b>";
		}
		$delAlertMsg .= RCView::div(array('style'=>'margin-top:15px;color:#C00000;font-weight:bold;'), $lang['data_entry_190']);
		// Action drop-down
		$actions =  RCView::div(array('style'=>'margin:12px 0 8px;'),
						RCView::button(array('id'=>'recordActionDropdownTrigger', 'onclick'=>"showBtnDropdownList(this,event,'recordActionDropdownDiv');", 'class'=>'jqbuttonmed'),
							RCView::span(array('class'=>'glyphicon glyphicon-edit', 'style'=>'color:#000066;top:3px;'), '') .
							RCView::span(array('style'=>'vertical-align:middle;color:#000066;margin-right:6px;margin-left:3px;'), $lang['grid_51']) .
							RCView::img(array('src'=>'arrow_state_grey_expanded.png', 'style'=>'margin-left:2px;vertical-align:middle;position:relative;top:-1px;'))
						) .
						// PDF button/drop-down options (initially hidden)
						RCView::div(array('id'=>'recordActionDropdownDiv', 'style'=>'display:none;position:absolute;z-index:1000;'),
							RCView::ul(array('id'=>'recordActionDropdown'),
								// ZIP file containing all file upload fields
								(($user_rights['data_export_tool'] == '0' || !Files::hasUploadedFiles()) ? '' :
									RCView::li(array(),
										RCView::a(array('target'=>'_blank', 'href'=>APP_PATH_WEBROOT."DataExport/file_export_zip.php?pid=$project_id&id=".RCView::escape($_GET['id'])),
											RCView::img(array('src'=>'folder_zipper.png')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#7c4c00;'), 
												$lang['data_entry_315']
											)
										)
									)
								) .
								// Download PDF of all instruments
								($user_rights['data_export_tool'] == '0' ? '' :
									RCView::li(array(),
										RCView::a(array('target'=>'_blank', 'href'=>APP_PATH_WEBROOT."PDF/index.php?pid=$project_id&id=".RCView::escape($_GET['id'])),
											RCView::img(array('src'=>'pdf.gif')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#A00000;'), 
												($longitudinal ? $lang['data_entry_314'] : $lang['data_entry_313'])
											)
										)
									)
								) .
								// Lock record
								(!($user_rights['lock_record_multiform'] && $user_rights['lock_record'] > 0) ? '' :
									RCView::li(array(),
										RCView::a(array('href'=>'javascript:;', 'onclick'=>"lockUnlockForms('$id','".RCView::escape($_GET['id'])."','','".$arm."','1','lock');"),
											RCView::img(array('src'=>'lock.png')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#A86700;'), $lang['grid_28'])
										)
									)
								) .
								// Unock record
								(!($user_rights['lock_record_multiform'] && $user_rights['lock_record'] > 0) ? '' :
									RCView::li(array(),
										RCView::a(array('href'=>'javascript:;', 'onclick'=>"lockUnlockForms('$id','".RCView::escape($_GET['id'])."','','".$arm."','1','unlock');"),
											RCView::img(array('src'=>'lock_open.png')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#555;'), $lang['grid_29'])
										)
									)
								) .
								// Assign to a DAG (only show if DAGs exist and user is NOT in a DAG)
								($user_rights['group_id'] != '' || empty($dags) ? '' :
									RCView::li(array(),
										RCView::a(array('href'=>'javascript:;', 'onclick'=>"assignDag('$recordDag');"),
											RCView::img(array('src'=>'group.png')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#006000;'), 
												$lang['data_entry_323'] .
												(!$recordDag ? '' : " ".$lang['data_entry_324'])
											)
										)
									)
								) .
								// Rename record
								(!$user_rights['record_rename'] ? '' :
									RCView::li(array(),
										RCView::a(array('href'=>'javascript:;', 'onclick'=>"renameRecord();"),
											RCView::img(array('src'=>'form-text-box.gif')) .
											RCView::span(array('style'=>'vertical-align:middle;'), 
												$lang['data_entry_316']
											)
										)
									)
								) .
								// Delete record
								(!$user_rights['record_delete'] ? '' :
									RCView::li(array(),
										RCView::a(array('href'=>'javascript:;', 'onclick'=>"simpleDialog('".str_replace('"', '&quot;', cleanHtml("<div style='margin:10px 0;font-size:13px;'>$delAlertMsg</div>"))."','".str_replace('"', '&quot;', cleanHtml("{$lang['data_entry_49']} \"".RCView::escape($_GET['id'])."\"{$lang['questionmark']}"))."',null,null,null,'".cleanHtml($lang['global_53'])."',function(){ deleteRecord(getParameterByName('id'),getParameterByName('arm')); },'".cleanHtml($lang['data_entry_49'])."');"),
											RCView::img(array('src'=>'cross.png')) .
											RCView::span(array('style'=>'vertical-align:middle;color:#C00000;'), 
												$lang['data_entry_208']." ".($longitudinal ? $lang['data_entry_245'] : $lang['data_entry_244'])
											)
										)
									)
								)
							)
						)
					);
	}
	
	// Record name dialog
	if ($user_rights['record_rename'] && $existing_record) 
	{
		print 	RCView::div(array('id'=>'rename-record-dialog', 'title'=>$lang['data_entry_316']." \"".RCView::escape($_GET['id'])."\"", 'class'=>'simpleDialog', 'style'=>'font-size:14px;'),
					$lang['data_entry_316'] . " \"<b>".RCView::escape($_GET['id'])."</b>\" " . $lang['data_entry_317'] . 
					RCView::div(array('style'=>'margin:10px 0 2px;'),
						RCView::text(array('id'=>'new-record-name', 'class'=>'x-form-text x-form-field', 'style'=>'max-width:100px;font-size:14px;', 'value'=>$_GET['id']))
					) .
					(!$multiple_arms ? '' :
						RCView::div(array('style'=>'font-size:12px;color:#666;margin:15px 0 0px;'), $lang['data_entry_321'])
					)
				);
	}
	
	// Assign record to DAG dialog
	if ($user_rights['group_id'] == '' && $existing_record && !empty($dags)) 
	{
		print 	RCView::div(array('id'=>'assign-dag-record-dialog', 'title'=>$lang['form_renderer_10'], 'class'=>'simpleDialog', 'style'=>'font-size:14px;'),
					$lang['data_entry_325'] . " \"<b>".RCView::escape($_GET['id'])."</b>\" " . $lang['data_entry_326'] . 
					RCView::div(array('style'=>'margin:10px 0 2px;'),
						RCView::select(array('id'=>'new-dag-record', 'class'=>'x-form-text x-form-field', 'style'=>'max-width:90%;font-size:14px;'), array(''=>$lang['data_access_groups_ajax_23'])+$dags, $recordDag)
					)
				);
	}
	
	## General instructions for grid.
	print	RCView::table(array('style'=>'width:800px;table-layout:fixed;'),
			RCView::tr('',
				RCView::td(array('style'=>'padding:0 30px 0 0;','valign'=>'top'),
					// Instructions
					RCView::div(array('class'=>'hidden-xs', 'style'=>'padding-top:10px'),
						$lang['grid_41'] .
						(!($longitudinal && $user_rights['design']) ? "" : "
							{$lang['grid_21']}
							<a href='".APP_PATH_WEBROOT."Design/define_events.php?pid=$project_id'
								style='text-decoration:underline;'>{$lang['global_16']}</a>
							{$lang['global_14']}{$lang['period']}"
						)
					) .
					// Actions for locking
					$actions
				) .
				RCView::td(array('class'=>'hidden-xs', 'valign'=>'top','style'=>($hasRepeatingFormsOrEvents && $surveys_enabled ? 'width:400px;' : 'width:320px;')),
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
	// Check if record exists for other arms, and if so, notify the user (only for informational purposes)
	if (recordExistOtherArms($id, $arm))
	{
		// Record exists in other arms, so give message
		print  "<p class='red' style=''>
					<b>{$lang['global_03']}</b>{$lang['colon']} {$lang['grid_36']} ".RCView::escape($table_pk_label)."
					\"<b>".removeDDEending($id)."</b>\" {$lang['grid_37']}
				</p>";
	}
	// Set up context messages to users for actions performed in longitudinal projects (Save button redirects back here for longitudinals)
	if (isset($_GET['msg']))
	{
		if ($_GET['msg'] == 'edit') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_08']}</div>";
		} elseif ($_GET['msg'] == 'add') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_09']}</div>";
		} elseif ($_GET['msg'] == 'cancel') {
			print "<div class='red' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."exclamation.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_11']}</div>";
		} elseif ($_GET['msg'] == '__rename_failed__') {
			print "<div class='red' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."exclamation.png'> " . RCView::escape($table_pk_label) . " <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_08']}<br/><b>{$lang['data_entry_13']} " . RCView::escape($table_pk_label) . " {$lang['data_entry_15']}</b></div>";
		} elseif ($_GET['msg'] == 'deleteevent') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_301']}</div>";
		} elseif ($_GET['msg'] == 'deleterecord') {
			print "<div class='red' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."exclamation.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_10']}</div>";
		} elseif ($_GET['msg'] == 'rename') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_320']}</div>";
		} elseif ($_GET['msg'] == 'assigndag') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_327']}</div>";
		} elseif ($_GET['msg'] == 'unassigndag') {
			print "<div class='darkgreen' style='margin:10px 0;max-width:580px;'><img src='".APP_PATH_IMAGES."tick.png'> ".RCView::escape($table_pk_label)." <b>".RCView::escape($_GET['id'])."</b> {$lang['data_entry_328']}</div>";
		}
	}
	/***************************************************************
	** EVENT-FORM GRID
	***************************************************************/
	## Query to get all Form Status values for all forms across all time-points. Put all into array for later retrieval.
	// Prefill $grid_form_status array with blank defaults
	$grid_form_status = array();
	foreach ($Proj->eventsForms as $this_event_id=>$these_forms) {
		foreach ($these_forms as $this_form) {
			$grid_form_status[$this_event_id][$this_form][1] = '';
		}
	}
	// Get form statuses
	$qsql = "select distinct d.event_id, m.form_name, if(d2.value is null, '0', d2.value) as value, d2.instance
			from (redcap_data d, redcap_metadata m) left join redcap_data d2
			on d2.project_id = m.project_id and d2.record = d.record and d2.event_id = d.event_id
			and d2.field_name = concat(m.form_name, '_complete')
			where d.project_id = $project_id and d.project_id = m.project_id and d.record = '".prep($id)."' and m.element_type != 'calc'
			and d.field_name = m.field_name and m.form_name in (".prep_implode(array_keys($Proj->forms)).") and m.field_name != '{$Proj->table_pk}'";
	if ($longitudinal && isset($Proj->events[$arm])) {
		$qsql .= " and d.event_id in (".prep_implode(array_keys($Proj->events[$arm]['events'])).")";
	} else {
		$qsql .= " and d.event_id = " . $Proj->firstEventId;
	}
	$q = db_query($qsql);
	$recordHasRepeatedEvents = false;
	while ($row = db_fetch_array($q)) {
		if ($row['instance'] == '') {
			$row['instance'] = '1';
		} elseif (isset($repeatingFormsEvents[$row['event_id']]) && !is_array($repeatingFormsEvents[$row['event_id']])) {
			$recordHasRepeatedEvents = true;
		}
		//Put time-point and form name as array keys with form status as value
		$grid_form_status[$row['event_id']][$row['form_name']][$row['instance']] = $row['value'];
	}
	// Create an array to count the max instances per event
	$instance_count = array();
	// If has repeated events, then loop through all events/forms and sort them by instance
	if ($recordHasRepeatedEvents) {
		// Loop through events
		foreach ($grid_form_status as $this_event_id=>$these_forms) {
			foreach ($these_forms as $this_form=>$these_instances) {
				$count_instances = count($these_instances);
				if ($count_instances > 1) {
					ksort($these_instances);
					$grid_form_status[$this_event_id][$this_form] = $these_instances;
				}
				// Add form instance
				foreach ($these_instances as $this_instance=>$this_form_status) {
					if (!isset($instance_count[$this_event_id][$this_instance])) {
						$instance_count[$this_event_id][$this_instance] = '';
					}
				}
			}
			// Loop through other remaining forms and seed with blank value
			foreach (array_diff(array_keys($Proj->forms), array_keys($these_forms)) as $this_form) {
				$grid_form_status[$this_event_id][$this_form] = array();
			}
		}
		// Now loop back through and seed all forms so that each event_id has same number of form instances per event
		foreach ($grid_form_status as $this_event_id=>$these_forms) {
			ksort($instance_count[$this_event_id]);
			foreach ($these_forms as $this_form=>$these_instances) {
				// Seed all defaults for this form
				$grid_form_status[$this_event_id][$this_form] = $instance_count[$this_event_id];
				// Add form instance
				foreach ($these_instances as $this_instance=>$this_form_status) {
					$grid_form_status[$this_event_id][$this_form][$this_instance] = $this_form_status;
				}
			}
		}
	}	
	// Determine if any events have no data
	if (!empty($repeatingFormsEvents)) {	
		$eventsNoData = array();
		foreach ($grid_form_status as $this_event_id=>$these_forms) {
			$allInstanceString = "";
			foreach ($these_forms as $this_form=>$these_instances) {
				foreach ($these_instances as $this_instance=>$this_form_status) {
					$allInstanceString .= $this_form_status;
				}
			}
			// If string is blank, then all form statuses are null/empty
			if ($allInstanceString == "") {
				$eventsNoData[$this_event_id] = true;
			}
		}
	}
	// Determine if this record also exists as a survey response for some instruments
	$surveyResponses = array();
	if ($surveys_enabled) {
		$surveyResponses = Survey::getResponseStatus($project_id, $id);
	}
	// Get Custom Record Label and Secondary Unique Field values (if applicable)
	if ($existing_record) {
		$this_custom_record_label_secondary_pk = "<span style='color:#800000;margin-left:6px;'>".
				Records::getCustomRecordLabelsSecondaryFieldAllRecords(addDDEending($_GET['id']), false, $arm, true, '')."</span>";
	} else {
		$this_custom_record_label_secondary_pk = "";
	}
	// JavaScript
	callJsFile('RecordHomePage.js');
	// If has multiple arms, then display this arm's name AND display DAG name
	$dagArmDisplay = "";
	$dagDisplay = ($user_right['group_id'] == '' && !empty($dags) && isset($dags[$recordDag])) ? RCView::escape($dags[$recordDag]) : '';
	$armDisplay = (!$multiple_arms ? "" : "{$lang['global_08']} {$arm}{$lang['colon']} ".RCView::escape(strip_tags($Proj->events[$arm]['name'])));
	if ($dagDisplay != "" || $armDisplay != "") {
		$dagArmDisplay = "<div style='font-size:13px;color:#999;'>";
		if ($armDisplay != "") $dagArmDisplay .= "<span class='nowrap' style='color:#916314;margin:0 2px;'>$armDisplay</span>";
		if ($dagDisplay != "" && $armDisplay != "") $dagArmDisplay .= " &mdash; ";
		if ($dagDisplay != "") $dagArmDisplay .= "<span class='nowrap' style='color:#008000;margin:0 2px;'>$dagDisplay</span>";
		$dagArmDisplay .= "</div>";
	}
	// DISPLAY RECORD ID above grid
	print  "<div id='record_display_name'>
				" . (!$existing_record ? RCView::b($lang['grid_30']) : "") . "
				".RCView::escape($table_pk_label).RCView::SP.RCView::b(RCView::escape($_GET['id']))."
				$this_custom_record_label_secondary_pk $dagArmDisplay
			</div>";
	// GRID
	$grid_disp_change = "";
	print  "<table id='event_grid_table' class='form_border event_grid_table'>";
	// Display "events" and/or arm name
	print  "<thead><tr>
			<th class='header text-center' style='padding:5px 0;'>
				".DataEntry::renderCollapseTableIcon($project_id, 'event_grid_table')."
				<div style='margin:0 25px;'>{$lang['global_35']}</div>
			</th>";
	// Get collapsed state of the event grid and set TR class for each row
	$eventGridCollapseClass = UIState::isTableCollapsed($project_id, 'event_grid_table') ? 'hide' : '';
	// Collect hidden event columns into an array
	$eventGridEventsCollapsed = array();
	//Render table headers
	foreach ($Proj->events[$arm]['events'] as $this_event_id=>$this_event) 
	{
		// Find collapsed state of column
		$eventGridColumnCollapseClass = '';
		if (UIState::isEventColumnCollapsed($project_id, $this_event_id)) {
			$eventGridColumnCollapseClass = 'hide';
			$eventGridEventsCollapsed[] = $this_event_id;
		}
		// Determine instance info
		$i = 0;
		if (!isset($instance_count[$this_event_id])) {
			$instance_count[$this_event_id][1] = '';
		}
		$is_repeating_event = (isset($repeatingFormsEvents[$this_event_id]) && !is_array($repeatingFormsEvents[$this_event_id]));
		$this_event_instances = array_keys($instance_count[$this_event_id]);
		$max_event_instance = max($this_event_instances);
		$has_multiple_instances = !empty($this_event_instances);
		foreach ($this_event_instances as $this_instance) 
		{
			// If classic project, then set "event name" to be "status"
			if (!$longitudinal) $this_event['descrip'] = $lang['calendar_popup_08'];
			// Don't display title for repeated events
			$evTitle = ($i > 0) ? "" : "<div class='evTitle'>".RCView::escape(strip_tags($this_event['descrip']))."</div>";
			// Show instance number, if has repeated events
			$instanceNumDisplay = (($is_repeating_event && $max_event_instance > 1) ? "" : "display:none;");
			// Add button to add new instance, if applicable
			$addInstanceBtn = "";
			if ($existing_record && $is_repeating_event && $this_instance == $max_event_instance) {
				$repeatEventBtnDisabled = isset($eventsNoData[$this_event_id]) ? "disabled" : "";
				if (count($this_event_instances) > 2) $addInstanceBtn .= DataEntry::renderCollapseEventColumnIcon(PROJECT_ID, $this_event_id);
				$addInstanceBtn .= "<div class='divBtnAddRptEv'><button $repeatEventBtnDisabled onclick=\"gridAddRepeatingEvent(this);\" event_id='$this_event_id' instance='$this_instance' class='btn btn-xs btn-defaultrc btnAddRptEv opacity50 nowrap'>+&nbsp;{$lang['data_entry_247']}</button></div>";
			}
			// Event label piping
			$custom_event_label = "";
			if ($custom_event_labels_all != "") {
				$custom_event_label = Piping::replaceVariablesInLabel($Proj->eventInfo[$this_event_id]['custom_event_label'], $id, $this_event_id, $this_instance, $event_label_piping_data, false, null, false);
				$custom_event_label = str_replace("-", "&#8209;", $custom_event_label); // Replace hyphens with non-breaking hyphens for better display
				$custom_event_label = RCView::div(array('class'=>'custom_event_label'), filter_tags($custom_event_label));
			}
			// Set class for repeating events (add class for all instances EXCEPT first and last)
			$repeatEventColClass = ($is_repeating_event && $this_instance > 1 && $this_instance < $max_event_instance) ? "eventCol-$this_event_id $eventGridColumnCollapseClass" : "";
			// Output header
			print  "<th class='header evGridHdr $repeatEventColClass $fade'>
						{$addInstanceBtn}{$evTitle}{$custom_event_label}
						<div class='evGridHdrInstance evGridHdrInstance-$this_event_id nowrap' style='$instanceNumDisplay'>
							(#<span class='instanceNum'>$this_instance</span>)
						</div>
					</th>";
			$i++;
			// If this is not a repeating event (=repeat entire event), then only do one loop
			if (!$is_repeating_event) break;
		}
	}
	print "</tr></thead>";
	// Create array of all events and forms for this arm
	$form_events = array();
	foreach (array_keys($Proj->events[$arm]['events']) as $this_event_id) {
		$form_events[$this_event_id] = (isset($Proj->eventsForms[$this_event_id])) ? $Proj->eventsForms[$this_event_id] : array();
	}
	// Create array of all forms used in this arm (because some may not be used, so we should not display them)
	$forms_this_arm = array();
	foreach ($form_events as $these_forms) {
		$forms_this_arm = array_merge($forms_this_arm, $these_forms);
	}
	$forms_this_arm = array_unique($forms_this_arm);
	
	//Render table rows
	$prev_form = "";
	$row_num = 0;
	$deleteRow = array();
	$grayIconsByEvent = array();
	foreach ($Proj->forms as $form_name=>$attr)
	{
		// If form is not used in this arm, then skip it
		if (!in_array($form_name, $forms_this_arm)) continue;
		// Set vars
		$row['form_name'] = $form_name;
		$row['form_menu_description'] = $attr['menu'];
		// Make sure user has access to this form. If not, then do not display this form's row.
		if ($user_rights['forms'][$row['form_name']] == '0') continue;
		//Deterine if we are starting new row
		if ($prev_form != $row['form_name'])
		{
			$row_num++;
			if ($prev_form != "") print "</tr>";
			print "<tr class='$eventGridCollapseClass'><td class='labelrc'>".RCView::escape($row['form_menu_description']);
			// If instrument is enabled as a survey, then display "(survey)" next to it
			if (isset($Proj->forms[$row['form_name']]['survey_id'])) {
				print RCView::span(array('class'=>'surveyLabel'), $lang['grid_39']);
			}
			print "</td>";
		}
		// Render cells
		foreach ($form_events as $this_event_id=>$eattr)
		{
			$row['event_id'] = $this_event_id;
			// Find collapsed state of column
			$eventGridColumnCollapseClass = in_array($this_event_id, $eventGridEventsCollapsed) ? 'hide' : '';
			// Add first event instance, if missing
			if (!isset($grid_form_status[$row['event_id']][$row['form_name']])) {
				$grid_form_status[$row['event_id']][$row['form_name']][1] = '';
			}
			// Determine if the entire event is set to repeat
			$is_repeating_event = (isset($repeatingFormsEvents[$this_event_id]) && !is_array($repeatingFormsEvents[$this_event_id]));
			$event_has_repeating_forms = (isset($repeatingFormsEvents[$this_event_id]) && is_array($repeatingFormsEvents[$this_event_id]));
			// Determine if this form for this record has multiple instances saved
			$is_repeating_form = isset($repeatingFormsEvents[$this_event_id][$row['form_name']]);
			$status_concat = trim(implode('', $grid_form_status[$row['event_id']][$row['form_name']]));
			$status_count = strlen($status_concat);
			$form_has_mixed_statuses = $form_has_multiple_instances = ($is_repeating_form && $status_count > 1);
			if ($form_has_multiple_instances) {
				// Determine if all statuses are same or mixed status values
				$form_has_mixed_statuses = !(str_replace('0', '', $status_concat) == '' || str_replace('1', '', $status_concat) == '' || str_replace('2', '', $status_concat) == '');
			}
			if (!isset($grayIconsByEvent[$row['event_id']])) {
				$grayIconsByEvent[$row['event_id']] = array('form_count'=>0, 'gray_count'=>0);
			}
			// Loop through all instances
			foreach ($grid_form_status[$row['event_id']][$row['form_name']] as $this_instance=>$this_form_status) 
			{
				// Add to $deleteRow for the last row
				if ($row_num == 1) {
					$deleteRow[] = array('event_id'=>$row['event_id'], 'form_name'=>$row['form_name'], 
										 'instance'=>$this_instance, 'max_event_instance'=>$max_event_instance);
				}
				// Change bg color slightly for repeated events
				$repeatEv = ($is_repeating_event && $this_instance > 1) ? "dataEvRpt" : "";
				// Set class for repeating events (add class for all instances EXCEPT first and last)
				$repeatEventColClass = ($is_repeating_event && $this_instance > 1 && $this_instance < max(array_keys($instance_count[$this_event_id])))
					? "eventCol-$this_event_id $eventGridColumnCollapseClass" : "";
				// Render table cell
				print "<td class='data nowrap $repeatEventColClass $repeatEv' style='".($longitudinal ? "" : "padding:3px 10px 4px;")."text-align:center;'>";
				if (in_array($row['form_name'], $eattr))
				{
					// Increment total form count per event and also count of gray icons
					$grayIconsByEvent[$row['event_id']]['form_count']++;
					// Many different statuses (for repeating only)
					if ($form_has_mixed_statuses) {
						$this_color = 'circle_blue_stack.png';
					} else {
						// If it's a survey response, display different icons
						if (isset($surveyResponses[$id][$row['event_id']][$row['form_name']][$this_instance])) {
							//Determine color of button based on response status
							switch ($surveyResponses[$id][$row['event_id']][$row['form_name']][$this_instance]) {
								case '2':
									$this_color = ($form_has_multiple_instances) ? 'circle_green_tick_stack.png' : 'circle_green_tick.png';
									break;
								default:
									$this_color = ($form_has_multiple_instances) ? 'circle_orange_tick_stack.png' : 'circle_orange_tick.png';
							}
						} else {
							// Form status
							if ($form_has_multiple_instances) {
								switch ($this_form_status) {
									case '2': 	$this_color = 'circle_green_stack.png';  break;
									case '1': 	$this_color = 'circle_yellow_stack.png'; break;
									default:	$this_color = 'circle_red_stack.png';
								}
							} else {
								switch ($this_form_status) {
									case '2': 	$this_color = 'circle_green.png';  break;
									case '1': 	$this_color = 'circle_yellow.png'; break;
									case '0': 	$this_color = 'circle_red.png';    break;
									default: 	
										$this_color = 'circle_gray.png';
										$grayIconsByEvent[$row['event_id']]['gray_count']++;
								}
							}
						}
					}
					//Determine record id (will be different for each time-point). Configure if Double Data Entry
					if ($entry_num == "") {
						$displayid = $id;
					} else {
						//User is Double Data Entry person
						$displayid = $_GET['id'];
					}
					//Set button HTML, but don't make clickable if color is gray
					$statusIconStyle = ($form_has_multiple_instances) ? 'width:22px;' : 'width:16px;';
					if ($event_has_repeating_forms && !$form_has_multiple_instances) $statusIconStyle .= 'margin-right:6px;';
					$this_url = APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&id=".urlencode($displayid)."&event_id={$row['event_id']}&page={$row['form_name']}"
							  . ($this_instance > 1 ? "&instance=$this_instance" : "").((isset($_GET['auto']) && $auto_inc_set) ? "&auto=1" : "");
					$this_button = "<img src='".APP_PATH_IMAGES."$this_color' style='height:16px;$statusIconStyle'>";
					// Set link for icon
					$thisPlusBtnUrl = $this_url;
					if ($form_has_multiple_instances) {
						$this_url = 'javascript:;';
						$onclick = "onclick=\"loadInstancesTable(this,'".cleanHtml(addDDEending($_GET['id']))."', {$row['event_id']}, '{$row['form_name']}');\"";
					} else {						
						$onclick = "";
					}
					print "<a href='$this_url' $onclick>$this_button</a>";
					// If this is a repeating form, then add a + button to add new instance
					$lockingSpacerRepeatForms = '';
					if ($existing_record && $event_has_repeating_forms) {
						// Spacer for locking icons
						$lockingSpacerRepeatForms = "<img src='".APP_PATH_IMAGES."spacer.gif' style='height:16px;width:".(isset($esigned_forms_grid[$row['event_id'].",".$row['form_name']]) ? "12px" : "28px").";'>";
						// Get next instance number
						$next_instance = max(array_keys($grid_form_status[$row['event_id']][$row['form_name']])) + 1;
						// Display button
						print "<button title='".cleanHtml($lang['grid_43'])."' onclick=\"window.location.href='$thisPlusBtnUrl&instance=$next_instance';\" class='btn btn-defaultrc btnAddRptEv ".($is_repeating_form && $this_color != "circle_gray.png" ? "opacity50" : "invis")."'>+</button>";
					}
					//Display lock icon for any forms that are locked for this record
					if ($this_color != "circle_gray.png" && (isset($locked_forms_grid[$row['event_id'].",".$row['form_name']])
						|| isset($esigned_forms_grid[$row['event_id'].",".$row['form_name']]))) 
					{
						print 	RCView::div(array('class'=>'gridLockEsign nowrap'), 
									(!isset($locked_forms_grid[$row['event_id'].",".$row['form_name']]) ? '' :
										$locked_forms_grid[$row['event_id'].",".$row['form_name']]
									) .
									(!isset($esigned_forms_grid[$row['event_id'].",".$row['form_name']]) ? '' :
										$esigned_forms_grid[$row['event_id'].",".$row['form_name']]
									) .
									$lockingSpacerRepeatForms
								);
					}
				}
				print "</td>";
				// If entire event does not repeat, then only do one loop
				if (!$is_repeating_event) break;
			}
		}
		//Set for next loop
		$prev_form = $row['form_name'];
	}
	print  "</tr>";
	
	// DELETE EVENT: If user has record delete rights, then add new row to delete events
	if ($longitudinal && $existing_record && $user_rights['record_delete'])
	{
		print "<tr class='$eventGridCollapseClass'><td class='labelrc' style='color:#aaa;font-size:10px;'>{$lang['grid_52']}</td>";
		foreach ($deleteRow as $attr)
		{
			$tdLink = "";
			$isRepeatingEvent = $Proj->isRepeatingEvent($attr['event_id']) ? 1 : 0;
			if ($grayIconsByEvent[$attr['event_id']]['form_count'] > $grayIconsByEvent[$attr['event_id']]['gray_count']) {
				// Display cross icon if event has some data saved
				$deleteEventText = $isRepeatingEvent ? $lang['data_entry_298'] : $lang['data_entry_297'];
				// Set cell content
				$tdLink = "<a href='javascript:;' onclick=\"deleteEventInstance({$attr['event_id']},{$attr['instance']},$isRepeatingEvent);\" style='color:#A00000;'><span class='glyphicon glyphicon-remove opacity35' style='padding:2px 5px;' title='".cleanHtml($deleteEventText)."'></span></a>";
			}
			// Find collapsed state of column
			$eventGridColumnCollapseClass = in_array($attr['event_id'], $eventGridEventsCollapsed) ? 'hide' : '';
			// Set class for repeating events (add class for all instances EXCEPT first and last)
			$repeatEventColClass = ($isRepeatingEvent && $attr['instance'] > 1 && $attr['instance'] < $attr['max_event_instance']) ? "eventCol-{$attr['event_id']} $eventGridColumnCollapseClass" : "";
			// Render the cell
			print  "<td class='data $repeatEventColClass' style='text-align:center;'>$tdLink</td>";
		}
		print  "</tr>";
	}
	
	print  "</table>";
	
	// If project has repeating forms, then display tables of their data
	print RepeatInstance::renderRepeatingFormsDataTables(addDDEending($_GET['id']), $grid_form_status, $locked_forms);
}
################################################################################
## PAGE WITH RECORD ID DROP-DOWN
else
{
	// Get total record count
	$num_records = Records::getRecordCount();
	// Get extra record count in user's data access group, if they are in one
	if ($user_rights['group_id'] != "")
	{
		$sql  = "select count(distinct(record)) from redcap_data where project_id = " . PROJECT_ID . " and field_name = '$table_pk'"
			  . " and record != '' and record in (" . pre_query("select record from redcap_data where project_id = " . PROJECT_ID
			  . " and field_name = '__GROUPID__' and value = '{$user_rights['group_id']}'") . ")";
		$num_records_group = db_result(db_query($sql),0);
	}
	// If more records than a set number exist, do not render the drop-downs due to slow rendering.
	$search_text_label = $lang['grid_35'] . " " .RCView::escape($table_pk_label);
	if ($num_records > DataEntry::$maxNumRecordsHideDropdowns)
	{
		// If using auto-numbering, then bring back text box so users can auto-suggest to find existing records	.
		// The negative effect of this is that it also allows users to [accidentally] bypass the auto-numbering feature.
		if ($auto_inc_set) {
			$search_text_label = $lang['data_entry_121'] . " ".RCView::escape($table_pk_label);
		}
		// Give extra note about why drop-down is not being displayed
		$search_text_label .= RCView::div(array('style'=>'padding:10px 0 0;font-size:10px;font-weight:normal;color:#555;'),
								$lang['global_03'] . $lang['colon'] . " " . $lang['data_entry_172'] . " " .
								User::number_format_user(DataEntry::$maxNumRecordsHideDropdowns, 0) . " " .
								$lang['data_entry_173'] . $lang['period']
							);
	}
	/**
	 * ARM SELECTION DROP-DOWN (if more than one arm exists)
	 */
	//Loop through each ARM and display as a drop-down choice
	$arm_dropdown_choices = "";
	if ($multiple_arms) {
		foreach ($Proj->events as $this_arm_num=>$arm_attr) {
			//Render option
			$arm_dropdown_choices .= "<option";
			//If this tab is the current arm, make it selected
			if ($this_arm_num == $arm) {
				$arm_dropdown_choices .= " selected ";
			}
			$arm_dropdown_choices .= " value='$this_arm_num'>{$lang['global_08']} {$this_arm_num}{$lang['colon']} {$arm_attr['name']}</option>";
		}
	}
	// Page instructions and record selection table with drop-downs
	?>
	<p style="margin-bottom:20px;">
		<?php echo $lang['grid_38'] ?>
		<?php echo ($auto_inc_set) ? $lang['data_entry_96'] : $lang['data_entry_97']; ?>
	</p>
	<style type="text/css">
	.data { padding: 7px; max-width: 400px; }
	</style>
	<table class="form_border" style="width:100%;max-width:700px;">
		<!-- Header displaying record count -->
		<tr>
			<td class="header" colspan="2" style="font-weight:normal;padding:10px 5px;color:#800000;font-size:12px;">
				<?php echo $lang['graphical_view_22'] ?> <b><?php echo User::number_format_user($num_records) ?></b>
					<?php if (isset($num_records_group)) { ?>
						&nbsp;/&nbsp; <?php echo $lang['data_entry_104'] ?> <b><?php echo User::number_format_user($num_records_group) ?></b>
					<?php } ?>
			</td>
		</tr>
	<?php
	/***************************************************************
	** DROP-DOWNS
	***************************************************************/
	if ($num_records <= DataEntry::$maxNumRecordsHideDropdowns)
	{
		print  "<tr>
					<td class='labelrc'>{$lang['grid_31']} ".RCView::escape($table_pk_label)."</td>
					<td class='data'>";
		// Obtain custom record label & secondary unique field labels for ALL records.
		$extra_record_labels = Records::getCustomRecordLabelsSecondaryFieldAllRecords(array(), true, $arm);
		if($extra_record_labels)
		{
			foreach ($extra_record_labels as $this_record=>$this_label) {
				$dropdownid_disptext[removeDDEending($this_record)] .= " $this_label";
			}
		}
		unset($extra_record_labels);
		/**
		 * ARM SELECTION DROP-DOWN (if more than one arm exists)
		 */
		//Loop through each ARM and display as a drop-down choice
		if ($multiple_arms && $arm_dropdown_choices != "")
		{
			print  "<select id='arm_name' class='x-form-text x-form-field' style='margin-right:20px;' onchange=\"
						if ($('#record').val().length > 0) {
							window.location.href = app_path_webroot+'DataEntry/record_home.php?pid=$project_id&id='+$('#record').val()+'&arm='+$('#arm_name').val()+addGoogTrans();
						} else {
							showProgress(1);
							setTimeout(function(){
								window.location.href = app_path_webroot+'DataEntry/record_home.php?pid=$project_id&arm='+$('#arm_name').val()+addGoogTrans();
							},500);
						}
					\">
					$arm_dropdown_choices
					</select>";
		}
		/**
		 * RECORD SELECTION DROP-DOWN
		 */
		print  "<select id='record' class='x-form-text x-form-field' style='max-width:350px;' onchange=\"
					window.location.href = app_path_webroot+page+'?pid='+pid+'&arm=$arm&id=' + this.value + addGoogTrans();
				\">";
		print  "	<option value=''>{$lang['data_entry_91']}</option>";
		// Limit records pulled only to those in user's Data Access Group
		if ($user_rights['group_id'] == "") {
			$group_sql  = "";
		} else {
			$group_sql  = "and record in (" . pre_query("select record from redcap_data where field_name = '__GROUPID__' and
				value = '{$user_rights['group_id']}' and project_id = $project_id") . ")";
		}
		//If a Double Data Entry project, only look for entry-person-specific records by using SQL LIKE
		if ($double_data_entry && $user_rights['double_data'] != 0) {
			//If a designated entry person
			$qsql = "select distinct substring(record,1,locate('--',record)-1) as record FROM redcap_data
					 where project_id = $project_id and record in (" . pre_query("select distinct record from redcap_data where
					 project_id = $project_id and record like '%--{$user_rights['double_data']}'"). ") $group_sql";
		} else {
			//If NOT a designated entry person OR not double data entry project
			$qsql = "select distinct record FROM redcap_data where project_id = $project_id and field_name = '$table_pk'
					and event_id in (".prep_implode($Proj->getEventsByArmNum($arm)).") $group_sql";
		}
		$study_id_array = array();
		$QQuery = db_query($qsql);
		while ($row = db_fetch_array($QQuery))
		{
			$study_id_array[] = $row['record'];
		}
		natcasesort($study_id_array);
		foreach ($study_id_array as $this_record)
		{
			// Check for custom labels
			$secondary_pk_text  = isset($secondary_pk_disptext[$this_record]) ? $secondary_pk_disptext[$this_record] : "";
			$custom_record_text = isset($dropdownid_disptext[$this_record])   ? $dropdownid_disptext[$this_record]   : "";
			//Render drop-down options
			print "<option value='{$this_record}'>{$this_record}{$secondary_pk_text}{$dropdownid_disptext[$this_record]}</option>";
		}
		print  "</select>";
		print  "</td></tr>";
	}
	//User defines the Record ID
	if ((!$auto_inc_set && $user_rights['record_create']) || ($auto_inc_set && $num_records > DataEntry::$maxNumRecordsHideDropdowns))
	{
		// Check if record ID field should have validation
		$text_val_string = "";
		if ($Proj->metadata[$table_pk]['element_type'] == 'text' && $Proj->metadata[$table_pk]['element_validation_type'] != '')
		{
			// Apply validation function to field
			$text_val_string = "if(redcap_validate(this,'{$Proj->metadata[$table_pk]['element_validation_min']}','{$Proj->metadata[$table_pk]['element_validation_max']}','hard','".convertLegacyValidationType($Proj->metadata[$table_pk]['element_validation_type'])."',1)) ";
		}
		//Text box for next records
		?>
		<tr>
			<td class="labelrc">
				<?php echo $search_text_label ?>
			</td>
			<td class="data" style="width:400px;">
				<input id="inputString" type="text" class="x-form-text x-form-field" style="position:relative;">
			</td>
		</tr>
		<?php
	}
	// Auto-number button(s) - if option is enabled
	if ($auto_inc_set && $user_rights['record_create'] > 0)// && $num_records <= DataEntry::$maxNumRecordsHideDropdowns)
	{
		$autoIdBtnText = $lang['data_entry_46'];
		if ($multiple_arms) {
			$autoIdBtnText .= $lang['data_entry_99'];
		}
		?>
		<tr>
			<td class="labelrc">&nbsp;</td>
			<td class="data">
				<!-- New record button -->
				<button onclick="window.location.href=app_path_webroot+page+'?pid='+pid+'&id=<?php echo getAutoId() ?>&auto=1&arm='+($('#arm_name_newid').length ? $('#arm_name_newid').val() : '<?php echo $arm ?>');return false;"><?php echo $autoIdBtnText ?></button>
			</td>
		</tr>
		<?php
	}
	if ($Proj->metadata[$table_pk]['element_type'] != 'text') {
		// Error if first field is NOT a text field
		?>
		<tr>
			<td colspan="2" class="red"><?php echo RCView::b($lang['global_48'] .$lang['colon']) ." " .$lang['data_entry_180'] . " <b>$table_pk</b> (\"".RCView::escape($table_pk_label)."\")".$lang['period'] ?></td>
		</tr>
		<?php
	}
	print "</table>";
	// Display search utility
	renderSearchUtility();
	?>
	<br><br>
	<script type="text/javascript">
	// Enable validation and redirecting if hit Tab or Enter
	$(function(){
		$('#inputString').keypress(function(e) {
			if (e.which == 13) {
				 $('#inputString').trigger('blur');
				return false;
			}
		});
		$('#inputString').blur(function() {
			var refocus = false;
			var idval = trim($('#inputString').val());
			if (idval.length < 1) {
				return;
			}
			if (idval.length > 100) {
				refocus = true;
				alert('<?php echo remBr($lang['data_entry_186']) ?>');
			}
			if (refocus) {
				setTimeout(function(){document.getElementById('inputString').focus();},10);
			} else {
				$('#inputString').val(idval);
				<?php echo isset($text_val_string) ? $text_val_string : ''; ?>
				setTimeout(function(){
					idval = $('#inputString').val();
					idval = idval.replace(/&quot;/g,''); // HTML char code of double quote
					// Don't allow pound signs in record names
					if (/#/g.test(idval)) {
						$('#inputString').val('');
						alert("Pound signs (#) are not allowed in record names! Please enter another record name.");
						$('#inputString').focus();
						return false;
					}
					// Don't allow apostrophes in record names
					if (/'/g.test(idval)) {
						$('#inputString').val('');
						alert("Apostrophes (') are not allowed in record names! Please enter another record name.");
						$('#inputString').focus();
						return false;
					}
					// Don't allow ampersands in record names
					if (/&/g.test(idval)) {
						$('#inputString').val('');
						alert("Ampersands (&) are not allowed in record names! Please enter another record name.");
						$('#inputString').focus();
						return false;
					}
					// Don't allow plus signs in record names
					if (/\+/g.test(idval)) {
						$('#inputString').val('');
						alert("Plus signs (+) are not allowed in record names! Please enter another record name.");
						$('#inputString').focus();
						return false;
					}
					// Redirect, but NOT if the validation pop-up is being displayed (for range check errors)
					if (!$('.simpleDialog.ui-dialog-content:visible').length)
						window.location.href = app_path_webroot+page+'?pid='+pid+'&arm=<?php echo (($arm_dropdown_choices != "") ? "'+ $('#arm_name_newid').val() +'" : $arm) ?>&id=' + idval + addGoogTrans();
				},200);
			}
		});
	});
	</script>
	<?php
	//Using double data entry and auto-numbering for records at the same time can mess up how REDCap saves each record.
	//Give warning to turn one of these features off if they are both turned on.
	if ($double_data_entry && $auto_inc_set) {
		print "<div class='red' style='margin-top:20px;'><b>{$lang['global_48']}</b><br>{$lang['data_entry_56']}</div>";
	}
	// If multiple Arms exist, use javascript to pop in the drop-down listing the Arm names to choose from for new records
	if ($arm_dropdown_choices != "" && ((!$auto_inc_set && $user_rights['record_create'])
		|| ($auto_inc_set && $num_records > DataEntry::$maxNumRecordsHideDropdowns)))
	{
		print  "<script type='text/javascript'>
				$(function(){
					$('#inputString').before('".cleanHtml("<select id='arm_name_newid' onchange=\"if (!$('select#arm_name').length){ window.location.href=window.location.href+'&arm='+this.value; return; } editAutoComp(autoCompObj,this.value);\" class='x-form-text x-form-field' style='margin-right:20px;'>$arm_dropdown_choices</select>")."');
				});
				</script>";
	}
	//If project is a prototype, display notice for users telling them that no real data should be entered yet.
	if ($status < 1) {
		print  "<br>
				<div class='yellow' style='width:90%;max-width:600px;'>
					<img src='".APP_PATH_IMAGES."exclamation_orange.png'>
					<b style='font-size:14px;'>{$lang['global_03']}:</b><br>
					{$lang['data_entry_28']}
				</div>";
	}
}
// Render JavaScript for record selecting auto-complete/auto-suggest
?>
<script type="text/javascript">
var autoCompObj;
$(function(){
	// Autocomplete for entering recrod names
	if ($('#inputString').length) {
		autoCompObj = 	$('#inputString').autocomplete({
							source: app_path_webroot+'DataEntry/auto_complete.php?pid='+pid+'&arm='+($('#arm_name_newid').length ? $('#arm_name_newid').val() : '<?php echo $arm ?>'),
							minLength: 1,
							delay: 0,
							select: function( event, ui ) {
								$(this).val(ui.item.value).trigger('blur');
								return false;
							}
						})
						.data('ui-autocomplete')._renderItem = function( ul, item ) {
							return $("<li></li>")
								.data("item", item)
								.append("<a>"+item.label+"</a>")
								.appendTo(ul);
						};
	}
	// Initialize button drop-down(s) for top of form
	if ($('#recordActionDropdown').length) {
		$('#recordActionDropdown').menu();
		$('#recordActionDropdownDiv ul li a').click(function(){
			$('#recordActionDropdownDiv').hide();
		});
		if ($('#recordActionDropdown li').length < 1) $('#recordActionDropdownTrigger').hide();
	}
	// Delete event button opacity
	$('#event_grid_table .glyphicon.opacity35').mouseenter(function() {
		$(this).removeClass('opacity35');
	}).mouseleave(function() {
		$(this).addClass('opacity35');
	});
});
function editAutoComp(autoCompObj,val) {
	var autoCompObj = 	$('#inputString').autocomplete({
							source: app_path_webroot+'DataEntry/auto_complete.php?pid='+pid+'&arm='+val,
							minLength: 1,
							delay: 0,
							select: function( event, ui ) {
								$(this).val(ui.item.value).trigger('blur');
								return false;
							}
						})
						.data('ui-autocomplete')._renderItem = function( ul, item ) {
							return $("<li></li>")
								.data("item", item)
								.append("<a>"+item.label+"</a>")
								.appendTo(ul);
						};
}

// Delete record
function deleteRecord(record, arm) {
	showProgress(1);
	$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:deleteRecord',{ record: record, arm: arm },function(data){
		if (data != '1') { alert(woops); return; }
		showProgress(0,0);
		simpleDialog('<div style="color:#C00000;font-size:14px;font-weight:bold;">'+table_pk_label+' "'+getParameterByName('id')+'" <?php print cleanHtml($lang['rights_07'].$lang['period']) ?></div>','<?php print cleanHtml($lang['data_entry_312']) ?>',null,null,function(){
			window.location.href = app_path_webroot+'DataEntry/record_home.php?pid='+pid;
		},'<?php print cleanHtml($lang['calendar_popup_01']) ?>');
	});
}

// Confirm prompt for Delete Event Instanct
function deleteEventInstance(event_id, instance, isRepeatingEvent) {
	simpleDialog((isRepeatingEvent ? '<?php print cleanHtml($lang['data_entry_299']) ?>' : '<?php print cleanHtml($lang['data_entry_240']) ?>'), 
		(isRepeatingEvent ? '<?php print cleanHtml("{$lang['data_entry_300']} \"{$_GET['id']}\"{$lang['questionmark']}") ?>' : '<?php print cleanHtml("{$lang['data_entry_238']} \"{$_GET['id']}\"{$lang['questionmark']}") ?>'), 
		null, 650, null, '<?php print cleanHtml($lang['global_53']) ?>', function(){
			doDeleteEventInstance(event_id, instance);
		}, (isRepeatingEvent ? '<?php print cleanHtml($lang['data_entry_298']) ?>' : '<?php print cleanHtml($lang['data_entry_297']) ?>'));
}

// Delete event instance
function doDeleteEventInstance(event_id, instance) {
	$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:deleteEventInstance&event_id='+event_id+'&instance='+instance,{ record: getParameterByName('id') },function(data){
		if (data != '1') { simpleDialog(data); return; }
		// Reload page
		showProgress(1);
		window.location.href = window.location.href+'&msg=deleteevent';
	});
}

// Rename record
function renameRecord() {
	simpleDialog(null,null,'rename-record-dialog',450,null,'<?php print cleanHtml($lang['global_53']) ?>',function(){		
		showProgress(1);
		var arm = getParameterByName('arm');
		if (arm != '') arm = '&arm='+arm;
		var new_record = $('#rename-record-dialog #new-record-name').val();
		$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:renameRecord'+arm,{ record: getParameterByName('id'), new_record: new_record },function(data){
			if (data == '') { alert(woops); return; }
			if (data == '1') {
				window.location.href = app_path_webroot+'DataEntry/record_home.php?pid='+pid+'&id='+new_record+arm+'&msg=rename';
			} else {
				showProgress(0,0);
				simpleDialog(data,null,null,500,function(){renameRecord()});
			}
		});
	},'<?php print cleanHtml($lang['data_entry_316']) ?>');
}

// Assign record to DAG
function assignDag(currentDag) {
	simpleDialog(null,null,'assign-dag-record-dialog',500,null,'<?php print cleanHtml($lang['global_53']) ?>',function(){
		var group_id = $('#assign-dag-record-dialog #new-dag-record').val();
		if (group_id == currentDag) {
			simpleDialog('<div style="color:#A00000;"><?php print cleanHtml($lang['data_entry_329']) ?></div>',null,null,500,"assignDag('"+currentDag+"')");
			return;
		}		
		showProgress(1);
		$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:assignRecordToDag',{ record: getParameterByName('id'), group_id: group_id },function(data){
			if (data == '') { alert(woops); return; }
			if (data == '1') {
				window.location.href = window.location.href+'&msg='+(group_id=='' ? 'unassigndag' : 'assigndag');
			} else {
			showProgress(0,0);
				simpleDialog(data,null,null,500,function(){renameRecord()});
			}
		});
	},'<?php print cleanHtml($lang['data_entry_323']) ?>');
}
</script>
<?php
include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';