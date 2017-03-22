<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';
require_once APP_PATH_DOCROOT . "Surveys/survey_functions.php";

include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';
// TABS
include APP_PATH_DOCROOT . "ProjectSetup/tabs.php";

// Display action messages when 'msg' in URL
if (isset($_GET['msg']) && !empty($_GET['msg']))
{
	// Defaults
	$msgAlign = "center";
	$msgClass = "green";
	$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_09']}";
	$msgIcon  = "tick.png";
	$timeVisible = 7; //seconds
	$showMsgDiv = true;
	// Determine which message to display
	switch ($_GET['msg'])
	{
		// Created project
		case "newproject":
			$msgText  = "<b>{$lang['new_project_popup_02']}</b><br>{$lang['new_project_popup_03']}";
			$msgAlign = "left";
			$timeVisible = 10;
			break;
		// Copied project
		case "copiedproject":
			$msgText  = "<b>{$lang['new_project_popup_16']}</b><br>{$lang['new_project_popup_17']}";
			$msgAlign = "left";
			$timeVisible = 10;
			break;
		// Modified project info
		case "projectmodified":
			break;
		// Moved to production
		case "movetoprod":
			$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_15']}";
			break;
		// Moved back to development
		case "movetodev":
			$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_72']}";
			break;
		// Sent request to move to production
		case "request_movetoprod":
			$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_16']}";
			break;
		// Set secondary id
		case "secondaryidset":
			$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_17']}";
			break;
		// REset secondary id
		case "secondaryidreset":
			$msgText  = "<b>{$lang['setup_08']}</b> {$lang['setup_18']}";
			break;
		// Enable Twilio services
		case "twilio_enabled":
			$showMsgDiv = false;
			break;
		// Error (general)
		case "error":
			$msgText  = "<b>{$lang['global_64']}</b>";
			$msgClass = "red";
			$msgIcon   = "exclamation.png";
			break;
	}
	// Display message
	if ($showMsgDiv) {
		displayMsg($msgText, "actionMsg", $msgAlign, $msgClass, $msgIcon, $timeVisible, true);
	}

	## CUSTOM POP-UP MESSAGES
	// Enabled Twilio services, so auto-open the Twilio setup dialog
	if ($_GET['msg'] == 'twilio_enabled') {
		?>
		<script type="text/javascript">
		$(function(){
			setTimeout(function(){
				$('#setupChklist-twilio').effect('highlight',{},3000);
				$('#twilioSetupOpenDialogSpan').attr('title', '<?php print cleanHtml($lang['survey_916']) ?>').tooltip2({ tipClass: 'tooltip4left', position: 'center right' });
				setTimeout(function(){
					$('#twilioSetupOpenDialogSpan').trigger('mouseover');
					$('#setupChklist-twilio').mouseover(function(){
						$('#twilioSetupOpenDialogSpan').trigger('mouseout');
					});
				},800);
			},500);
		});
		</script>
		<?php
	}
	// If DRW was just enabled, then give pop-up dialog with detailed instructions
	elseif ($_GET['msg'] == 'data_resolution_enabled')
	{
		// Data resolution workflow instructions dialog pop-up
		print 	RCView::div(array('id'=>'drw_instruction_popup', 'class'=>'simpleDialog',
					'title'=>$lang['dataqueries_137'] . $lang['colon'] . " " . $lang['global_24']),
					// Msg that DRW was just enabled
					RCView::div(array('class'=>'green', 'style'=>'font-size:13px;'),
						RCView::img(array('src'=>'tick.png')) .
						RCView::b($lang['dataqueries_260']) . RCView::br() .$lang['dataqueries_261']
					) .
					DataQuality::renderDRWinstructions()
				);
		?>
		<script type="text/javascript">
		$(function(){
			setTimeout(function(){
				$('#drw_instruction_popup').dialog({ bgiframe: true, modal: true, width: 700,
					open: function(){ fitDialog(this); $(window).scrollTop(0); },
					buttons: [{
						text: '<?php echo $lang['calendar_popup_01'] ?>',
						click: function() { $(this).dialog("close"); }
					}]
				});
			},200);
		});
		</script>
		<?php
	}
}









/**
 * CHECKLIST
 */

$checkList = array();
// Set disabled status for any buttons/checkboxes whose pages relate to the Design/Setup user rights
$disableBtn = ($user_rights['design'] ? "" : "disabled");
// Set disabled status for any buttons/checkboxes that should NOT be changed while in production
$disableProdBtn = (($status < 1 || $super_user) ? "" : "disabled");
// Counter
$stepnum = 1;
// Set project creation timestamp as integer for use in log_event queries (to help reduce query time)
$creation_time_sql = ($creation_time == "") ? "" : "ts > ".str_replace(array('-',' ',':'), array('','',''), $creation_time)." and";
// Get all checklist items that have already been manually checked off by user. Store in array.
$checkedOff = array();
$q = db_query("select name from redcap_project_checklist where project_id = $project_id");
while ($row = db_fetch_assoc($q))
{
	$checkedOff[$row['name']] = true;
}
// Small CSS indentation fix for IE11 and below
$smProjectSetupBtnStyle = ($isIE && vIE() <= 11) ? "" : "text-indent:-75px;margin-left:75px;";



// MAIN PROJECT SETTINGS
$optionRepeatformsChecked = ($repeatforms) ? "checked" : "";
$optionSurveysChecked = ($surveys_enabled) ? "checked" : "";
$modifyProjectStatus = (isset($checkedOff['modify_project']) || $status > 0) ? 2 : 0;
$video_link =  	RCView::img(array('src'=>'video_small.png')) .
				RCView::a(array('href'=>'javascript:;','onclick'=>"popupvid('redcap_survey_basics02.flv')",'style'=>'font-weight:normal;font-size:12px;text-decoration:underline;'), $lang['training_res_63']);
$checkList[$stepnum++] = array("header" => $lang['setup_105'], "status" => $modifyProjectStatus, "name" => "modify_project",
	"text" =>   // If in production, give note regarding why options above are disabled
				RCView::div(array('style'=>'color:#777;font-size:11px;padding-bottom:3px;'.(($status > 0 && !$super_user) ? '' : 'display:none;')), $lang['setup_106']) .
				// Use surveys?
				(!$enable_projecttype_singlesurveyforms ? '' :
				RCView::div(array('style'=>$smProjectSetupBtnStyle.'color:#800000;padding:2px 0;font-size:13px;color:'.($surveys_enabled ? 'green' : '#800000').';'),
					RCView::button(array('id'=>'setupEnableSurveysBtn','class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>(($surveys_enabled && count($Proj->surveys) > 0) ? "confirmUndoEnableSurveys()" : "saveProjectSetting($(this),'surveys_enabled','1','0',1);"),$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$optionSurveysChecked=>$optionSurveysChecked),
						($surveys_enabled ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>($surveys_enabled ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					$lang['setup_96'] .
					// Question pop-up
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'useSurveysDialog');"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243']) .
					// Video link
					RCView::div(array('class'=>'hidden-xs hidden-sm', 'style'=>'float:right;text-indent:0;margin-right:2px;'), $video_link) .
					RCView::div(array('class'=>'hidden-xs hidden-md hidden-lg', 'style'=>'margin-left:68px;margin-top:2px;'), $video_link)
				)) .
				// Use longitudinal?
				RCView::div(array('style'=>$smProjectSetupBtnStyle.'color:#800000;padding:2px 0;font-size:13px;color:'.($repeatforms ? 'green' : '#800000').';'),
					RCView::button(array('id'=>'setupLongiBtn','class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>($longitudinal ? "confirmUndoLongitudinal()" : "saveProjectSetting($(this),'repeatforms','1','0',1);"),$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$optionRepeatformsChecked=>$optionRepeatformsChecked),
						($repeatforms ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>($repeatforms ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					$lang['setup_162'] .
					// Question pop-up
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'longiDialog',600);"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
				) .
				// Make Additional Customizations button
				RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs13','style'=>'margin-top:13px;',$disableBtn=>$disableBtn,'onclick'=>'displayEditProjPopup();'), $lang['setup_100'])
);


## Design your data collection instruments
$buildFieldsStatus = isset($checkedOff['design']) ? 2 : ($status > 0 ? 1 : 0);
// Set button
if ($user_rights['design'])
{
	$designBtn =   "{$lang['setup_44']}
					<a href='".APP_PATH_WEBROOT."PDF/index.php?pid=$project_id'
						style='text-decoration:underline;color:#800000;'>{$lang['design_266']}</a>
					{$lang['global_46']}
					<a href='javascript:;' onclick='downloadDD(0,{$Proj->formsFromLibrary()});'
						style='text-decoration:underline;'>{$lang['design_119']} {$lang['global_09']}</a> ";
	if ($status > 0) {
		$designBtn .=  "{$lang['global_46']}
						<a href='javascript:;' onclick='downloadDD(1,{$Proj->formsFromLibrary()});'
							style='text-decoration:underline;'>{$lang['design_121']} {$lang['global_09']} {$lang['design_122']}</a>";
	}
}
$designBtn .=  "<div class='chklistbtn' style='padding-top:10px;'>
					<span class='nowrap' style='line-height:24px;'>{$lang['setup_45']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"window.location.href=app_path_webroot+'Design/online_designer.php?pid=$project_id';\"><img src='".APP_PATH_IMAGES."blog_pencil.png' style='vertical-align:middle;position:relative;top:-1px;'> <span style='vertical-align:middle;'>{$lang['design_25']}</span></button></span>
					<span class='nowrap' style='line-height:24px;'>&nbsp;{$lang['global_47']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' style='white-space:nowrap;' onclick=\"window.location.href=app_path_webroot+'Design/data_dictionary_upload.php?pid=$project_id';\"><img src='".APP_PATH_IMAGES."xls.gif' style='vertical-align:middle;position:relative;top:-1px;'> <span style='vertical-align:middle;'>{$lang['global_09']}</span></button></span>
					".
					// Shared Library button
					(!$shared_library_enabled ? '' :
						renderBrowseLibraryForm()."
						<div style='padding:10px 0 0;color:#444;'>
							{$lang['edit_project_141']}
							<button class='btn btn-defaultrc btn-xs fs11' style='color:#800000;margin-left:3px;' onclick=\"$('form#browse_rsl').submit();\">{$lang['design_37']}</button>
						</div>"
					).
					// Link to Check For Identifiers page
					"<div class='hidden-xs' style='font-size:12px;padding-top:".($shared_library_enabled ? '5' : '10')."px;color:#444;'>
						{$lang['edit_project_55']}
						<a style='text-decoration:underline;font-size:12px;' href='".APP_PATH_WEBROOT."index.php?pid=$project_id&route=IdentifierCheckController:index'>{$lang['identifier_check_01']}</a> {$lang['edit_project_56']}
					</div>
				</div>";
// Survey + Forms
if ($surveys_enabled) {
	$checkList[$stepnum++] = array("header" => $lang['setup_90'], "name"=>"design", "status" => $buildFieldsStatus,
		"text" =>  "{$lang['setup_29']} " . $lang['setup_91'] . " $designBtn"
	);
}
// Forms only
else {
	$checkList[$stepnum++] = array("header" => $lang['setup_30'], "name"=>"design", "status" => $buildFieldsStatus,
		"text" =>  "{$lang['setup_31']}
					$designBtn"
	);
}


## Define My Events: For potentially longitudinal projects (may not have multiple events yet)
if ($repeatforms)
{
	$defineEvents_stepnum = $stepnum;
	$defineEventsStatusName = "define_events";
	if (isset($checkedOff[$defineEventsStatusName]) && $checkedOff[$defineEventsStatusName]) {
		$defineEventsStatus = 2;
	} else {
		$defineEventsStatus = (($status > 0 && !$enable_edit_prod_events) ? 2 : 1);
	}
	// Set button as disabled if in prod and not a super user
	$checkList[$stepnum++] = array("header" => $lang['setup_33'], "name" => $defineEventsStatusName, "status" => $defineEventsStatus,
		"text" =>  "{$lang['setup_34']}
					<div class='chklistbtn'>
						{$lang['setup_45']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"window.location.href=app_path_webroot+'Design/define_events.php?pid=$project_id';\">{$lang['global_16']}</button>
						&nbsp;{$lang['global_47']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"window.location.href=app_path_webroot+'Design/designate_forms.php?pid=$project_id';\">{$lang['global_28']}</button>
					</div>"
	);
}



// MISCELLANEOUS MODULES (auto-numbering, randomization, scheduling, etc.)
$moduleAutoNumChecked = ($auto_inc_set) ? "checked" : "";
$moduleAutoNumDisabled = ($Proj->firstFormSurveyId == null && !$double_data_entry) ? "" : "disabled";
$moduleAutoNumClass = ($Proj->firstFormSurveyId == null && !$double_data_entry) ? "" : "opacity25";
$moduleRandChecked = ($randomization) ? "checked" : "";
$moduleTwilioChecked = ($twilio_enabled) ? "checked" : "";
$moduleTwilioDisabled = (SUPER_USER || !$twilio_enabled_by_super_users_only) ? "" : "disabled";
$moduleSchedChecked = ($repeatforms && $scheduling) ? "checked" : "";
$moduleSchedDisabled = ($repeatforms) ? "" : "disabled";
$moduleStatus = (isset($checkedOff['modules']) && $checkedOff['modules']) ? 2 : ($status > 0 ? 1 : "");
$moduleEmailFieldDisabled = "disabled";
if ($surveys_enabled && ($super_user || $status == 0 || ($status > 0 && $survey_email_participant_field == ''))) {
	$moduleEmailFieldDisabled = "";
}
$moduleEmailFieldChecked = ($survey_email_participant_field != '') ? "checked" : "";
$moduleDdpChecked = ($DDP->isEnabledInSystem() && $DDP->isEnabledInProject()) ? "checked" : "";
$moduleDdpDisabled = ($DDP->isEnabledInSystem() && !SUPER_USER) ? "disabled" : "";
$displaySuperUserOnlySettings = (SUPER_USER && ($DDP->isEnabledInSystem() || $twilio_enabled_global));
$moduleRepeatingInstanceChecked = ($Proj->hasRepeatingFormsEvents()) ? "checked" : "";
$checkList[$stepnum++] = array("header" => $lang['setup_95'], "status" => $moduleStatus, "name" => "modules",
	"text" =>   // If in production, give note regarding why options above are disabled
				RCView::div(array('style'=>'color:#777;font-size:11px;padding-bottom:3px;'.(($status > 0 && !$super_user) ? '' : 'display:none;')), $lang['setup_106']) .
				// REPEATING FORMS AND EVENTS
				RCView::div(array('id'=>'enableRepeatingFormsEventsOption','style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($Proj->hasRepeatingFormsEvents() ? 'green' : '#800000').';'),
					RCView::button(array('id'=>'enableRepeatingFormsEventsBtn','class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"dialogRepeatingInstance();",
						$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$moduleRepeatingInstanceChecked=>$moduleRepeatingInstanceChecked),
						($Proj->hasRepeatingFormsEvents() ? $lang['design_169'] . RCView::SP : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>($Proj->hasRepeatingFormsEvents() ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					($longitudinal ? $lang['setup_146'] : $lang['setup_145']) .
					// Tell Me More link
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"$.get(app_path_webroot+'ProjectSetup/repeating_instruments_events_info.php',{ },function(data){ $('#dialogRepeatingInstanceExplain').html(data).dialog({ width: 800, bgiframe: true, modal: true, open: function(){fitDialog(this)}, buttons: { Close: function() { $(this).dialog('close'); } } }); });"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
				) .	
				// AUTO-NUMBERING FOR RECORDS
				RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($auto_inc_set ? 'green' : '#800000').';'),
					RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"saveProjectSetting($(this),'auto_inc_set','1','0',1,'setupChklist-modules');",$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$moduleAutoNumChecked=>$moduleAutoNumChecked, $moduleAutoNumDisabled=>$moduleAutoNumDisabled),
						($auto_inc_set ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>($auto_inc_set ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					$lang['setup_94'] .
					// Tell Me More link
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'autoNumDialog');"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
				) .			
				// SCHEDULING MODULE
				RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.(($repeatforms && $scheduling) ? 'green' : '#800000').';'),
					RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"saveProjectSetting($(this),'scheduling','1','0',1,'setupChklist-modules');",$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$moduleSchedChecked=>$moduleSchedChecked, $moduleSchedDisabled=>$moduleSchedDisabled),
						(($repeatforms && $scheduling) ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>(($repeatforms && $scheduling) ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					$lang['define_events_19'] . RCView::SP . $lang['setup_97'] .
					// Tell Me More link
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'schedDialog');"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
				) .
				// Randomization module
				(!$randomization_global ? '' :
					RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($randomization ? 'green' : '#800000').';'),
						RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"saveProjectSetting($(this),'randomization','1','0',1,'setupChklist-modules');",$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$moduleRandChecked=>$moduleRandChecked),
							($randomization ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
						) .
						RCView::img(array('src'=>($randomization ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
						$lang['setup_98'] .
						// Tell Me More link
						RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'randDialog');"), $lang['questionmark']) .
						// Invisible "saved" msg
						RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
					)
				) .
				// Additional email field for survey invitations
				RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($survey_email_participant_field != '' ? 'green' : '#800000').';'),
					RCView::button(array('id'=>'enableSurveyPartEmailFieldBtn','class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"dialogSurveyEmailField(".($survey_email_participant_field != '' ? '0' : '1').");",$disableBtn=>$disableBtn,$moduleEmailFieldDisabled=>$moduleEmailFieldDisabled,$moduleEmailFieldChecked=>$moduleEmailFieldChecked),
						($survey_email_participant_field != '' ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
					) .
					RCView::img(array('src'=>($survey_email_participant_field != '' ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
					$lang['setup_113'] .
					// Tell Me More link
					RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"simpleDialog(null,null,'surveyEmailFieldDialog',600);"), $lang['questionmark']) .
					// Invisible "saved" msg
					RCView::span(array('class'=>'savedMsg'), $lang['design_243']) .
					// If email field is already designated, then list it here as informational info
					($survey_email_participant_field == '' ? '' :
						RCView::div(array('style'=>'padding-left:82px;color:#666;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;max-width:500px;'),
							$lang['setup_121'] . " <b>$survey_email_participant_field</b>&nbsp; (\"<i>{$Proj->metadata[$survey_email_participant_field]['element_label']}</i>\")"
						)
					)
				) .
				//
				(!$displaySuperUserOnlySettings ? '' :
				// Make Additional Customizations button
					RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs13','style'=>'margin-top:10px;',$disableBtn=>$disableBtn,'onclick'=>'displayCustomizeProjPopup();'), $lang['setup_104']) .
					RCView::div(array('style'=>'margin:12px 0 4px;color:#555;font-size:11px;'),
						$lang['edit_project_156']
					)
				) .
				// DYNAMIC DATA PULL (DDP) - only display for super users OR if a normal user in which the global setting to display this is set to 1
				(!($DDP->isEnabledInSystem() && (SUPER_USER || (!SUPER_USER && $realtime_webservice_display_info_project_setup))) ? '' :
					RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($DDP->isEnabledInProject() ? 'green' : '#800000').';'),
						RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs11','style'=>'',
							'onclick'=>(SUPER_USER ? "saveProjectSetting($(this),'realtime_webservice_enabled','1','0',1,'setupChklist-modules');" : "ddpExplainDialog();"),
							$moduleDdpChecked=>$moduleDdpChecked,$moduleDdpDisabled=>$moduleDdpDisabled),
							($DDP->isEnabledInProject() ? $lang['control_center_153'] : $lang['survey_152'] . RCView::SP)
						) .
						RCView::img(array('src'=>($DDP->isEnabledInProject() ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
						$lang['ws_51'] . " " . $DDP->getSourceSystemName() .
						// Tell Me More link
						RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"ddpExplainDialog();"), $lang['questionmark']) .
						// Invisible "saved" msg
						RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
					)
				) .
				// Twilio SMS/voice services (show only to super users unless it's enabled to advertise it in all projects)
				(!($twilio_enabled_global && (SUPER_USER || (!SUPER_USER && $twilio_display_info_project_setup) || !$twilio_enabled_by_super_users_only)) ? '' :
					RCView::div(array('style'=>$smProjectSetupBtnStyle.'margin-bottom:2px;color:'.($twilio_enabled ? 'green' : '#800000').';'),
						RCView::button(array('id'=>'enableTwilioBtn','class'=>'btn btn-defaultrc btn-xs fs11','style'=>'','onclick'=>"dialogTwilioEnable();",
							$disableBtn=>$disableBtn,$disableProdBtn=>$disableProdBtn,$moduleTwilioDisabled=>$moduleTwilioDisabled,$moduleTwilioChecked=>$moduleTwilioChecked),
							($twilio_enabled ? $lang['design_169'] . RCView::SP : $lang['survey_152'] . RCView::SP)
						) .
						RCView::img(array('src'=>($twilio_enabled ? 'accept.png' : 'delete.png'),'style'=>'margin-left:8px;')) .
						$lang['survey_913'] .
						// Tell Me More link
						RCView::a(array('href'=>'javascript:;','class'=>'help','title'=>$lang['global_58'],'onclick'=>"$.get(app_path_webroot+'Surveys/twilio_info.php',{ },function(data){ $('#dialogTwilioExplain').html(data).dialog({ width: 700, bgiframe: true, modal: true, open: function(){fitDialog(this)}, buttons: { Close: function() { $(this).dialog('close'); } } }); });"), $lang['questionmark']) .
						// Invisible "saved" msg
						RCView::span(array('class'=>'savedMsg'), $lang['design_243'])
					)
				) .
				// Make Additional Customizations button
				($displaySuperUserOnlySettings ? RCView::div(array('class'=>'space', 'style'=>'margin:5px 0;'), '') :
					RCView::button(array('class'=>'btn btn-defaultrc btn-xs fs13','style'=>'margin-top:10px;',$disableBtn=>$disableBtn,'onclick'=>'displayCustomizeProjPopup();'), $lang['setup_104'])
				)
);

## Twilio SMS/voice services
if ($twilio_enabled_global && $twilio_enabled)
{
	$twilioServices_stepnum = $stepnum;
	// Check table to determine progress of twilio setup
	$twilioStatus = ($checkedOff['twilio']) ? 2 : 0;
	// Set button as disabled if in prod and not a super user
	$checkList[$stepnum++] = array("header" => "<img src='".APP_PATH_IMAGES."twilio.gif' style='vertical-align:middle;position:relative;top:-1px;'> <span id='twilioSetupOpenDialogSpan'>{$lang['survey_711']}</span>",
		"name" => "twilio",
		"status" => $twilioStatus,
		"text" =>  "{$lang['survey_1005']}
					<div class='chklistbtn'>
						{$lang['setup_45']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"dialogTwilioSetup();\"><img src='".APP_PATH_IMAGES."gear.png' style='vertical-align:middle;position:relative;top:-1px;'> <span style='vertical-align:middle;margin-right:8px;'>{$lang['survey_924']}</span></button>
						&nbsp;{$lang['global_47']}&nbsp;
						<button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"dialogTwilioAnalyzeSurveys();\"><img src='".APP_PATH_IMAGES."security-high.png' style='vertical-align:middle;position:relative;top:-1px;'> <span style='vertical-align:middle;'>{$lang['survey_869']}</span></button>
					</div>"
	);
}

## DDP
if (is_object($DDP) && $DDP->isEnabledInSystem() && $DDP->isEnabledInProject())
{
	// Check table to determine progress of ddp setup
	$rtwsStatus = ((isset($checkedOff['webservice']) && $checkedOff['webservice']) || $status > 0) ? 2 : ($DDP->isMappingSetUp() ? 1 : 0);
	// Disable button if don't have mapping rights
	$disableDdpMappingBtn = ($DDP->userHasMappingRights()) ? '' : "disabled";
	// Set button as disabled if in prod and not a super user
	$checkList[$stepnum++] = array("header" => $lang['ws_26'] . " " . $DDP->getSourceSystemName(),
		"name" => "webservice",
		"status" => $rtwsStatus,
		"text" =>  "{$lang['ws_13']} <a href='javascript:;' onclick='ddpExplainDialog();' style='text-decoration:underline;'>{$lang['global_58']}</a>
					<div class='chklistbtn'>
						{$lang['setup_45']}&nbsp; <button $disableDdpMappingBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"window.location.href=app_path_webroot+'DynamicDataPull/setup.php?pid=$project_id';\">{$lang['ws_29']}</button>
					</div>"
	);
}


## Randomization
if ($randomization)
{
	// Check table to determine progress of randomization setup
	$randomizeStatus = (isset($checkedOff['randomization']) && $checkedOff['randomization'] || $status > 0) ? 2 : 0;
	if ($randomizeStatus < 2)
	{
		$sql = "select distinct r.rid, a.project_status from redcap_randomization r
				left outer join redcap_randomization_allocation a on r.rid = a.rid
				where r.project_id = $project_id";
		$q = db_query($sql);
		$randomizeStatus = db_num_rows($q);
	}
	$disableBtnRandomization = ($user_rights['random_setup'] || $user_rights['random_dashboard']) ? "" : "disabled";
	// Set button as disabled if in prod and not a super user
	$rpage = ($user_rights['random_setup']) ? "index.php" : "dashboard.php";
	$checkList[$stepnum++] = array("header" => $lang['setup_81'],
		"name" => "randomization",
		"status" => $randomizeStatus,
		"text" =>  "{$lang['setup_82']}
					<div class='chklistbtn'>
						{$lang['setup_45']}&nbsp; <button $disableBtnRandomization class='btn btn-defaultrc btn-xs fs13' onclick=\"window.location.href=app_path_webroot+'Randomization/$rpage?pid=$project_id';\">{$lang['setup_83']}</button>
					</div>"
	);
}


## Project Bookmarks
$ExtRes_stepnum = $stepnum;
if (isset($checkedOff['external_resources']) && $checkedOff['external_resources']) {
	$ExtResStatus = 2;
} else {
	$sql = "select 1 from redcap_external_links where project_id = $project_id limit 1";
	$q = db_query($sql);
	$ExtResStatus = db_num_rows($q) ? 1 : "";
}
$checkList[$stepnum++] = array("header" => "{$lang['setup_78']} {$lang['global_06']}", "status" => $ExtResStatus, "name" => "external_resources",
	"text" =>  "{$lang['setup_80']}
				<div class='chklistbtn'>
					{$lang['setup_45']}&nbsp;
					<button class='btn btn-defaultrc btn-xs fs13' $disableBtn onclick=\"window.location.href=app_path_webroot+'ExternalLinks/index.php?pid=$project_id';\">{$lang['setup_79']}</button>
				</div>"
);

## User Rights and DAGs
$dagText = $lang['setup_38'];
$dagBtn  = "&nbsp;{$lang['global_47']}&nbsp; <button class='btn btn-defaultrc btn-xs fs13' ".($user_rights['data_access_groups'] ? "" : "disabled")." onclick=\"window.location.href=app_path_webroot+'DataAccessGroups/index.php?pid=$project_id';\">{$lang['global_22']}</button>";
$userRights_stepnum = $stepnum;
$checkList[$stepnum++] = array("header" => $lang['setup_39'], "status" => (isset($checkedOff['user_rights']) && $checkedOff['user_rights'] ? 2 : ""), "name" => "user_rights",
	"text" =>  "{$lang['setup_40']} $dagText
				<div class='chklistbtn'>
					{$lang['setup_45']}&nbsp;
					<button class='btn btn-defaultrc btn-xs fs13' ".($user_rights['user_rights'] ? "" : "disabled")." onclick=\"window.location.href=app_path_webroot+'UserRights/index.php?pid=$project_id';\">{$lang['app_05']}</button>
					$dagBtn
				</div>"
);

## Test your project
$checkList[$stepnum++] = array("header" => $lang['setup_123'], "status" => ((isset($checkedOff['test_project']) && $checkedOff['test_project']) ? 2 : 0),
	"name" => "test_project", "text" =>  $lang['setup_124']
);

## Move to production
// Check log_event table to see if they've sent a request before (if project requests have been enabled)
$todo_type = 'move to prod';
$db = new RedCapDB();
$userInfo = $db->getUserInfoByUsername($userid);
$ui_id = $userInfo->ui_id;
$request_count = ToDoList::checkIfRequestExist($project_id, $ui_id, $todo_type);
$moveToProdStatus = ($status > 0) ? 2 : ($superusers_only_move_to_prod && $request_count > 0 ? 1 : 0);
if($request_count > 0){
	$checkList[$stepnum++] = array("header" => $lang['setup_41'], "status" => $moveToProdStatus,
		"text" =>  "{$lang['setup_153']}
					<div class='chklistbtn' style='display:" . ($status > 0 ? "none" : "block") . ";'>
						{$lang['setup_45']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' style='color:rgba(0, 0, 0, 0.63);'>{$lang['setup_43']}</button>
						<b style='color:#C00000;margin-left:10px;'>{$lang['setup_144']} <button class='btn btn-defaultrc btn-xs fs13' onclick=\"cancelRequest(pid,'move to prod',".$ui_id.")\" class='cancel-req-btn'>{$lang['global_128']}</button></b>
					</div>"
	);
}else{
	$checkList[$stepnum++] = array("header" => $lang['setup_41'], "status" => $moveToProdStatus,
	"text" =>  "{$lang['setup_153']}
	<div class='chklistbtn' style='display:" . ($status > 0 ? "none" : "block") . ";'>
	{$lang['setup_45']}&nbsp; <button $disableBtn class='btn btn-defaultrc btn-xs fs13' onclick=\"btnMoveToProd()\">{$lang['setup_43']}</button>
	</div>"
);
}







## Show the PROJECT STATUS (and link to survey how-to video, if applicable)
// Project status label
$statusLabel = '<b style="color:#000;float:none;border:0;">'.$lang['edit_project_58'].'</b>&nbsp; ';
// Set icon/text for project status
if ($status == '1') {
	$iconstatus = '<span style="color:#00A000;font-weight:normal;">'.$statusLabel.'<span class="glyphicon glyphicon-check" aria-hidden="true"></span> '.$lang['global_30'].'</span>';
} elseif ($status == '2') {
	$iconstatus = '<span style="color:#800000;font-weight:normal;">'.$statusLabel.'<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> '.$lang['global_31'].'</span>';
} elseif ($status == '3') {
	$iconstatus = '<span style="color:#800000;font-weight:normal;">'.$statusLabel.'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> '.$lang['global_26'].'</span>';
} else {
	$iconstatus = '<span style="color:#666;font-weight:normal;">'.$statusLabel.'<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> '.$lang['global_29'].'</span>';
}
// Determine how many steps have been completed thus far
// Only show Steps Completed text when in development
// $stepsCompletedText = "";
// if ($status < 1) {
	$stepsTotal = count($checkList);
	$stepsCompleted = 0;
	$doneStatuses = array('2', '4', '5'); // Status that denote that a step is "done"
	foreach ($checkList as $attr) {
		if (in_array($attr['status'], $doneStatuses)) $stepsCompleted++;
	}
	$stepsCompletedText = "<div style='color:#800000;margin-right:10px;'>
								{$lang['edit_project_120']} <b id='stepsCompleted'>$stepsCompleted</b> {$lang['survey_133']}
								<b id='stepsTotal'>$stepsTotal</b>
							</div>";
// }
// Output to page above checklist
print  "<div style='clear:both;padding-bottom:5px;max-width:700px;'>
			<table cellspacing=0 width=100%>
				<tr>
					<td valign='top'>
						$iconstatus
					</td>
					<td valign='top' style='text-align:right;'>
						$stepsCompletedText
					</td>
				</tr>
			</table>
		</div>
		<div style='max-width:800px;'>";

## RENDER THE CHECKLIST
ProjectSetup::renderSetupCheckList($checkList, $checkedOff);

print "</div>";


## HIDDEN DIALOG DIVS
// Repeating instance explanation - hidden dialog
print RCView::simpleDialog('', ($longitudinal ? $lang['setup_146'] : $lang['setup_145']), 'dialogRepeatingInstanceExplain');
// Twilio explanation - hidden dialog
print RCView::simpleDialog('', "Twilio", 'dialogTwilioExplain');
// Longitudinal enable - hidden dialog
print RCView::simpleDialog($lang['create_project_113'].RCView::div(array('style'=>'margin-top:15px;'), "<b>{$lang['create_project_114']}</b>{$lang['create_project_115']} <b>{$lang['create_project_116']}</b>"), $lang['setup_162'], 'longiDialog');
// Longitudinal pre-disable confirmation - hidden dialog
print RCView::simpleDialog($lang['setup_110'], $lang['setup_109'], 'longiConfirmDialog');
// Surveys enable - hidden dialog
print RCView::simpleDialog($lang['create_project_71'], $lang['setup_96'], 'useSurveysDialog');
// Surveys pre-disable confirmation - hidden dialog
print RCView::simpleDialog($lang['setup_112'], $lang['setup_111'], 'useSurveysConfirmDialog');
// Auto-numbering enable - hidden dialog
print RCView::simpleDialog($lang['edit_project_44'] .
	(($Proj->firstFormSurveyId != null && $auto_inc_set) ? RCView::div(array('style'=>'color:red;margin-top:10px;'), RCView::b($lang['global_03'].$lang['colon'])." ".$lang['setup_107']) : ''),
	$lang['edit_project_43'], 'autoNumDialog');
// Scheduling enable - hidden dialog
print RCView::simpleDialog($lang['create_project_54'] .
	(!$repeatforms ? RCView::div(array('style'=>'color:red;margin-top:10px;'), RCView::b($lang['global_03'].$lang['colon'])." ".$lang['setup_108']) : ''),
	$lang['define_events_19'], 'schedDialog');
// Randomization enable - hidden dialog
print RCView::simpleDialog($lang['random_01']."<br><br>".$lang['create_project_63'], $lang['setup_98'], 'randDialog');
// Survey email field enable - hidden dialog
print RCView::simpleDialog($lang['setup_114']."<br><br>".$lang['setup_122']."<br><br>".RCView::b($lang['global_02'].$lang['colon']) . " " . $lang['setup_115'], $lang['setup_113'], 'surveyEmailFieldDialog');
// Data Entry Trigger explanation - hidden dialog
print RCView::simpleDialog($lang['edit_project_160']."<br><br>".$lang['edit_project_128'] .
	RCView::div(array('style'=>'padding:12px 0 2px;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('project_id')." - ".$lang['edit_project_129']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('username')." - ".$lang['edit_project_157']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('instrument')." - ".$lang['edit_project_130']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('record')." - ".$lang['edit_project_131'].$lang['period']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('redcap_event_name')." - ".$lang['edit_project_132']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('redcap_data_access_group')." - ".$lang['edit_project_133']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('[instrument]_complete')." - ".$lang['edit_project_134']).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('redcap_url')." - ".$lang['edit_project_144']."<br>i.e., ".APP_PATH_WEBROOT_FULL).
	RCView::div(array('style'=>'padding:2px 0;text-indent:-2em;margin-left:2em;'), "&bull; ".RCView::b('project_url')." - ".$lang['edit_project_145']."<br>i.e., ".APP_PATH_WEBROOT_FULL."redcap_v{$redcap_version}/index.php?pid=XXXX").
	RCView::div(array('style'=>'padding:20px 0 5px;color:#C00000;'), $lang['global_02'].$lang['colon'].' '.$lang['edit_project_135'])
	,$lang['edit_project_122'],'dataEntryTriggerDialog');







## MOVE TO PRODUCTION LOGIC
// Get randomization setup status (set to 0 by default for super users approving move-to-prod request, so they don't get prompt)
$randomizationStatus = ($randomization && !(isset($_GET['type']) && $_GET['type'] == "move_to_prod" && $super_user) && Randomization::setupStatus()) ? '1' : '0';
$randProdAllocTableExists = ($randomizationStatus == '1' && Randomization::allocTableExists(1)) ? '1' : '0';
// Set up status-specific language and actions
$status_dialog_title = $lang['edit_project_09'];
$status_dialog_btn = $lang['setup_141'];
$type = isset($_GET['type']) ? $_GET['type'] : '';
$user_email = isset($_GET['user_email']) ? $_GET['user_email'] : '';
$status_dialog_btn_action = "doChangeStatus(0,'{$type}','{$user_email}',$randomizationStatus,$randProdAllocTableExists);";
$iconstatus = '<img src="'.APP_PATH_IMAGES.'page_white_edit.png"> <span style="color:#666;">'.$lang['global_29'].'</span>';
$status_dialog_text  = "{$lang['edit_project_178']}
						<div style='margin:15px 0;'>
							<img src='" . APP_PATH_IMAGES . "star.png'> {$lang['edit_project_55']}
							<a style='text-decoration:underline;' href='".APP_PATH_WEBROOT."index.php?pid=$project_id&route=IdentifierCheckController:index'>{$lang['identifier_check_01']}</a>
							{$lang['edit_project_56']}
						</div>
						<fieldset class='yellow' data-test='".$super_user."'>
							<legend style='font-weight:bold;color:#A00000;font-size: 13px;padding: 0 5px;'>{$lang['edit_project_176']}</legend>
							<div style='padding:0 5px 5px 15px;color:#A00000;'>
								<div style='text-indent:-18px;margin-left:18px;'>
									<input type='radio' name='data' id='keep_data' "
										. ((isset($_GET['type']) && $_GET['type'] == "move_to_prod" && $super_user && $_GET['delete_data'] == "0") ? "checked" : "") . ">
									<span onclick=\"$('#keep_data').prop('checked',true);\">{$lang['edit_project_174']}</span>
								</div>
								<div style='text-indent:-18px;margin-left:18px;margin-top:5px;'>
									<input type='radio' name='data' id='delete_data' "
										. ((isset($_GET['type']) && $_GET['type'] == "move_to_prod" && $super_user && $_GET['delete_data'] == "1") ? "checked" : "") . ">
									<span onclick=\"$('#delete_data').prop('checked',true);\">{$lang['edit_project_170']}</span>
								</div>
							</div>
						</fieldset>
						<div style='margin-top:20px;'>{$lang['edit_project_180']}</div>";

// If only Super Users can move to production, then give different text for normal users
if (!$super_user && $superusers_only_move_to_prod == '1')//from here!!!
{
	$status_dialog_text .= "<br>
							<p style='color:#800000;'>
								<img src='" . APP_PATH_IMAGES . "exclamation.png'>
								<b>{$lang['global_02']}:</b><br>
								{$lang['edit_project_17']} ($user_email) {$lang['edit_project_18']}
							</p>";
	$status_dialog_btn = $lang['setup_142'];
	$status_dialog_title = $lang['edit_project_19'];
	// Javascript to send email to REDCap admin for approval to move to production
	$status_dialog_btn_action = "var delete_data = 0;
								if ($randomizationStatus == 1 && $randProdAllocTableExists == 0) {
									simpleDialog('".cleanHtml($lang['setup_136'])."');
									return false;
								}
								var alertMessage =  '<div class=\"select-radio-button-msg\" style=\"color: #C00000; font-size: 16px; margin-top: 10px;\">Please select one of the options above before moving to production.</div>';
								if ($('#delete_data:checked').val() !== undefined) {
									if ($('#delete_data:checked').val() == 'on') {
										delete_data = 1;
										$('.select-radio-button-msg').remove();
										// Make user confirm that they want to delete data
										if (!confirm('".cleanHtml($lang['setup_137'])."\\n\\n".cleanHtml($lang['setup_147'])."')) {
											return false;
										}
									} else if ($randomizationStatus == 1) {
										// If not deleting all data BUT using randomization module, remind that the randomization field's values will be erased
										if (!confirm('".cleanHtml($lang['setup_139'])."\\n\\n".cleanHtml($lang['setup_140'])."')) {
											return false;
										}
									}
								}else if($('#keep_data:checked').val() !== undefined){
									if ($('#keep_data:checked').val() == 'on') {
									  delete_data = 0;
									  $('.select-radio-button-msg').remove();
									}
								}else{//if both undefined display message
									$('.select-radio-button-msg').remove();
									$('#status_dialog .yellow').append(alertMessage);
									return false;
								}
								$.get(app_path_webroot+'ProjectGeneral/notifications.php', { pid: pid, type: 'move_to_prod', delete_data: delete_data },
									function(data) {
										$('#status_dialog').dialog('close');
										if (data == '1') {
											window.location.href = app_path_webroot+page+'?pid='+pid+'&msg=request_movetoprod';
										} else {
											alert('".cleanHtml("{$lang['global_01']}{$lang['colon']} {$lang['edit_project_20']}")."');
										}
									}
								);";
}

// Prepare a "certification" pop-up message when user clicks Move To Prod button if text has been set
if ($status == 0 && trim($certify_text_prod) != "" && (!$super_user || ($super_user && !isset($_GET['user_email']))))
{
	print "<div id='certify_prod' title='".cleanHtml($lang['global_03'])."' style='display:none;text-align:left;'>".filter_tags(nl2br(label_decode($certify_text_prod)))."</div>";
	// Javascript function for when clicking the 'move to production' button
	print  "<script type='text/javascript'>
			function btnMoveToProd() {
				$('#certify_prod').dialog({ bgiframe: true, modal: true, width: 500, buttons: {
					'".cleanHtml($lang['setup_135'])."': function() {
						$(this).dialog('close');
						$('#status_dialog').dialog({ bgiframe: true, modal: true, width: 650, buttons: {
							'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); },
							'".cleanHtml($status_dialog_btn)."': function() { $status_dialog_btn_action }
						} });
					},
					'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); }
				} });
			}
			</script>";
} else {
	// Javascript function for when clicking the 'move to production' button
	print  "<script type='text/javascript'>
			function btnMoveToProd() {
				$('#status_dialog').dialog({ bgiframe: true, modal: true, width: 650, buttons: {
					'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); },
					'".cleanHtml($status_dialog_btn)."': function() { $status_dialog_btn_action }
				} });
			}
			</script>";
}
// If Super User has been sent email to approve request to move db to production (and project has not been deleted),
// then display pop-up to super user to move to production.
if ($super_user && $status == 0 && isset($_GET['type']) && $_GET['type'] == "move_to_prod" && $date_deleted == '')
{
	?>
	<script type='text/javascript'>
	$(function(){
		btnMoveToProd();
	});
	</script>
	<?php
}
// Invisible div for status change
print  "<div id='status_dialog' title='".cleanHtml($status_dialog_title)."' style='display:none;'><p style=''>$status_dialog_text</p></div>";





/**
 * MODIFY PROJECT SETTINGS FORM AS POP-UP
 */
?>
<div id="edit_project" style="display:none;" title="<?php print cleanHtml2($lang['config_functions_30']) ?>">
	<div class="round chklist" style="padding:10px 20px;">
		<form id="editprojectform" action="<?php echo APP_PATH_WEBROOT ?>ProjectGeneral/edit_project_settings.php?pid=<?php echo $project_id ?>" method="post">
		<table style="width:100%;font-size:12px;" cellpadding=0 cellspacing=0>
		<?php
		// Include the page with the form
		include APP_PATH_DOCROOT . 'ProjectGeneral/create_project_form.php';
		?>
		</table>
		</form>
	</div>
</div>
<?php










/**
 * CUSTOMIZE PROJECT SETTINGS FORM AS POP-UP
 */
?>
<div id="customize_project" style="display:none;" title="<?php print cleanHtml2($lang['setup_134']) ?>">
	<div id="customize_project_sub">
	<p>
		<?php echo $lang['setup_52'] ?>
	</p>
	<div class="round chklist" style="padding:10px 20px;">
		<form id="customizeprojectform" action="<?php echo APP_PATH_WEBROOT ?>ProjectGeneral/edit_project_settings.php?pid=<?php echo $project_id ?>&action=customize" method="post">
		<table style="width:100%;font-size:12px;" cellspacing=0>

		<!-- Custom Record Label -->
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="custom_record_label_chkbx" <?php if (!empty($custom_record_label)) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>tag_orange.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_66'] ?></u></b><br>
				<?php
				echo $lang['edit_project_67'];
				if ($longitudinal) {
					echo " " . $lang['edit_project_86'];
				}
				?>
				<div id="custom_record_label_div" style="text-indent:0em;padding:10px 0 0;">
					<?php echo $lang['edit_project_68'] ?>&nbsp;
					<input type="text" class="x-form-text x-form-field" style="width:300px;" id="custom_record_label" name="custom_record_label" value="<?php echo str_replace('"', '&quot;', $custom_record_label) ?>"><br>
					<span style="color:#800000;font-family:tahoma;font-size:10px;">
						<?php echo $lang['edit_project_69'] ?>
					</span>
				</div>
			</td>
		</tr>
		<!-- Secondary unique field -->
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="secondary_pk_chkbx" name="secondary_pk_chkbx" <?php if ($secondary_pk != '') print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>tags.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_61'] ?></u></b><br>
				<?php echo $lang['setup_92'] ?>
				<?php if ($longitudinal) { echo $lang['edit_project_86']; } ?>
				<div id="secondary_pk_div" style="text-indent: 0em; padding: 10px 0px 0px;">
					<?php echo renderSecondIdDropDown("secondary_pk", "secondary_pk") ?>
				</div>
			</td>
		</tr>
		<!-- Order the records by another field -->
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="order_id_by_chkbx" <?php if (!empty($order_id_by) && !$longitudinal) print "checked"; if ($longitudinal) print "disabled"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>edit_list_order.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_72'] ?></u></b><br>
				<?php
				echo $lang['edit_project_73'];
				if ($longitudinal) {
					echo " <b style='color:#800000;'>" . $lang['edit_project_143'] . "</b>";
				}
				?>
				<div id="order_id_by_div" style="text-indent:0em;padding:10px 0 0;">
					<select name="order_id_by" id="order_id_by" class="x-form-text x-form-field" style="" <?php if ($longitudinal) print "disabled"; ?>>
						<option value=''><?php echo $lang['edit_project_71'] ?></option>
					<?php
					// Get field/label list and put in array
					$order_by_id_fields = array();
					foreach ($Proj->metadata as $this_field=>$attr) {
						if ($attr['element_type'] == 'descriptive') continue;
						$order_by_id_fields[$this_field] = $attr['element_label'];
					}
					// Loop through all fields
					foreach ($order_by_id_fields as $this_field=>$this_label)
					{
						// Ignore first field (superfluous)
						if ($this_field == $table_pk) continue;
						$this_label = "$this_field - " . strip_tags(label_decode($this_label));
						// Ensure label is not too long
						if (strlen($this_label) > 67) $this_label = substr($this_label, 0, 50) . "..." . substr($this_label, -15);
						// Add option
						echo "<option value='$this_field' " . (!$longitudinal && $this_field == $order_id_by ? "selected" : "") . ">$this_label</option>";
					}
					?>
					</select>
				</div>
			</td>
		</tr>

		<!-- Data Resolution -->
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="data_resolution_enabled_chkbx" name="data_resolution_enabled_chkbx" <?php if ($data_resolution_enabled) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>balloons.png">
				<b style="font-family:verdana;"><u><?php echo $lang['dataqueries_133'] ?></u></b><br>
				<?php echo $lang['dataqueries_134'] ?>
				<a href="javascript:;" style="text-decoration:underline;" onclick="$('#datares_explain_hidden').show();$(this).hide();"><?php echo $lang['edit_project_127'] ?></a>
				<div id="datares_explain_hidden" style="display:none;text-indent:0em;margin-top:8px;">
					<?php echo $lang['dataqueries_144'] ?>
					<?php echo $lang['dataqueries_273'] ?>
					<img src="<?php echo APP_PATH_IMAGES ?>video_small.png" style="vertical-align:middle;">
					<a href="javascript:;" onclick="popupvid('data_resolution_workflow01.swf','<?php echo cleanHtml($lang['dataqueries_137']) ?>');" style="text-decoration:underline;"><?php echo $lang['global_80'] . " " . $lang['dataqueries_137'] ?></a>
				</div>
				<div id="data_resolution_enabled_div" style="text-indent:0em;padding:10px 0 0;">
					<?php echo $lang['dataqueries_142'] ?>&nbsp;
					<select name="data_resolution_enabled" id="data_resolution_enabled" class="x-form-text x-form-field" style="" onchange="
						if (this.value == '1') {
							$('#field_comment_edit_delete_chkbx').prop('disabled', false);
							$('#div-enable-field_comment_edit_delete').removeClass('opacity50');
						} else {
							$('#field_comment_edit_delete_chkbx').prop('disabled', true).prop('checked', false);
							$('#div-enable-field_comment_edit_delete').addClass('opacity50');
						}
					">
						<option value='0' <?php if ($data_resolution_enabled == '0') print "selected"; ?>><?php echo $lang['dataqueries_259'] ?></option>
						<option value='1' <?php if ($data_resolution_enabled == '1') print "selected"; ?>><?php echo $lang['dataqueries_141'] ?></option>
						<option value='2' <?php if ($data_resolution_enabled == '2') print "selected"; ?>><?php echo $lang['dataqueries_137'] ?></option>
					</select>
					<div id="div-enable-field_comment_edit_delete" style="color:#555;margin-top:5px;" <?php if ($data_resolution_enabled != '1') print 'class="opacity50"'; ?>>
						<input type="checkbox" id="field_comment_edit_delete_chkbx" name="field_comment_edit_delete_chkbx" <?php if ($field_comment_edit_delete) print "checked"; if ($data_resolution_enabled != '1') print 'disabled'; ?>>
						<?php echo $lang['dataqueries_288'] ?>
					</div>
				</div>
			</td>
		</tr>

		<!-- Data History Widget -->
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="history_widget_enabled" name="history_widget_enabled" <?php if ($history_widget_enabled) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>history_active.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_53'] ?></u></b><br>
				<?php echo $lang['edit_project_54'] ?>
			</td>
		</tr>

		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="display_today_now_button" name="display_today_now_button" <?php if ($display_today_now_button) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>ui_button.png">
				<b style="font-family:verdana;"><u><?php echo $lang['system_config_143'] ?></u></b><br>
				<?php echo $lang['system_config_144'] ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="require_change_reason" name="require_change_reason" <?php if ($require_change_reason) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>document_edit.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_41'] ?></u></b><br>
				<?php echo $lang['edit_project_42'] ?>
			</td>
		</tr>

		<!-- Data Entry Trigger (if enabled in the Control Center -->
		<?php if ($data_entry_trigger_enabled) { ?>
		<tr>
			<td colspan="2" valign="top" style="margin-left:1.5em;text-indent:-2.2em;padding:10px 40px;">
				<input type="checkbox" id="data_entry_trigger_url_chkbx" <?php if (!empty($data_entry_trigger_url)) print "checked"; ?>>
				&nbsp;
				<img src="<?php echo APP_PATH_IMAGES ?>pointer.png">
				<b style="font-family:verdana;"><u><?php echo $lang['edit_project_122'] ?></u></b><br>
				<?php echo $lang['edit_project_160'] ?>
				<a href="javascript:;" onclick="simpleDialog(null,null,'dataEntryTriggerDialog',650);" class="nowrap" style="text-decoration:underline;"><?php echo $lang['edit_project_127'] ?></a>
				<div id="data_entry_trigger_url_div" style="text-indent:0em;padding:10px 0 0;">
					<?php echo $lang['edit_project_124'] ?>&nbsp;
					<input type="text" class="x-form-text x-form-field" style="width:350px;" id="data_entry_trigger_url" name="data_entry_trigger_url" value="<?php echo cleanHtml2(label_decode($data_entry_trigger_url)) ?>" onblur="
						this.value=trim(this.value);
						if (this.value.length == 0) return;
						// Disallow localhost
						var localhost_array = new Array('localhost', 'http://localhost', 'https://localhost', 'localhost/', 'http://localhost/', 'https://localhost/');
						if (in_array(this.value, localhost_array)) {
							simpleDialog('<?php echo cleanHtml($lang['edit_project_126']) ?>','<?php echo cleanHtml($lang['global_01']) ?>',null,null,'$(\'#data_entry_trigger_url\').focus();');
							return;
						}
						// Validate URL as full or relative URL
						if (!isUrl(this.value) && this.value.substr(0,1) != '/') {
							if (this.value.substr(0,4).toLowerCase() != 'http' && isUrl('http://'+this.value)) {
								// Prepend 'http' to beginning
								this.value = 'http://'+this.value;
							} else {
								// Error msg
								simpleDialog('<?php echo cleanHtml($lang['edit_project_126']) ?>','<?php echo cleanHtml($lang['global_01']) ?>',null,null,'$(\'#data_entry_trigger_url\').focus();');
							}
						}
					">
					<button class="btn btn-defaultrc btn-xs fs13" style="" onclick="
						var det_url = $('#data_entry_trigger_url').val();
						if (det_url == '') {
							$('#data_entry_trigger_url').focus();
							return false;
						}
						var pre_url = (det_url.substr(0,1) == '/') ? '<?php echo cleanHtml((SSL ? "https://" : "http://") . SERVER_NAME) ?>' : '';
						testUrl(pre_url+det_url,'post','$(\'#data_entry_trigger_url\').val(\'\');');
						return false;
					"><?php echo $lang['edit_project_138'] ?></button><br>
					<span style="color:#800000;font-family:tahoma;font-size:10px;">
						<?php echo $lang['edit_project_125'] ?> https://www.mywebsite.com/redcap_trigger_receive/
					</span><br>
					<span style="color:#800000;font-family:tahoma;font-size:10px;">
						<?php echo $lang['edit_project_125'] ?> /det/index.php
					</span>
				</div>
			</td>
		</tr>
		<?php } ?>

		</table>
		</form>
	</div>
	</div>
</div>




<script type='text/javascript'>
// Display the pop-up for project customization
function displayCustomizeProjPopup() {
	$('#customize_project').dialog({ bgiframe: true, modal: true, width: 750,
		open: function(){
			fitDialog(this);
		},
		buttons: {
			Cancel: function() { $(this).dialog('close'); },
			Save: function() {
				$('#customizeprojectform').submit();
				$(this).dialog('close');
			}
		}
	});
}
// Display the pop-up for modifying project settings
function displayEditProjPopup() {
	$('#edit_project').dialog({ bgiframe: true, modal: true, width: 700,
		open: function(){
			fitDialog(this);
			if ($('#projecttype1').prop('checked') || $('#projecttype2').prop('checked') ) {
				$('#step2').fadeTo(0, 1);
				$('#additional_options').fadeTo(0, 1);
			} else {
				$('#step2').hide();
				$('#additional_options').hide();
			}
			if ($('#repeatforms_chk2').prop('checked')) {
				$('#step3').fadeTo(0, 1);
			}
		},
		buttons: {
			Cancel: function() { $(this).dialog('close'); },
			Save: function() {
				if (setFieldsCreateFormChk()) {
					$('#editprojectform').submit();
					$(this).dialog('close');
				}
			}
		}
	});
}
// Enable/disable a survey
function surveyOnline(survey_id) {
	$.post(app_path_webroot+'Surveys/survey_online.php?pid='+pid+'&survey_id='+survey_id, { }, function(data){
		var json_data = jQuery.parseJSON(data);
		if (json_data.length < 1) {
			alert(woops);
			return false;
		}
		if (json_data.payload == '') {
			alert(woops);
			return false;
		} else {
			// Change HTML on Project Setup page
			$('#survey_active').html(json_data.payload);
			$('#survey_title_div').effect('highlight',2500);
			initWidgets();
			// If popup_content is specified, the show popup
			if (json_data.popup_content != '') {
				simpleDialog(json_data.popup_content,json_data.popup_title);
			}
		}
	});
}

$(function(){

	// Set up actions for Secondary ID field to be unique
	$('#customize_project #secondary_pk, .chklist #secondary_pk').change(function(){
		var ob = $(this);
		if (ob.val() != '') {
			$.get(app_path_webroot+'DataEntry/check_unique_ajax.php', { pid: pid, field_name: ob.val() }, function(data){
				if (data.length == 0) {
					alert(woops);
				} else if (data != '0') {
					simpleDialog('<?php echo cleanHtml($lang['edit_project_64']) ?>','"'+ob.val()+'" <?php echo cleanHtml($lang['edit_project_63']) ?>');
					ob.val('');
				}
			});
		}
	});
	// Set up actions for 'Customize project settings' form
	$('#data_resolution_enabled_chkbx').click(function(){
		if ($(this).prop('checked')) {
			$('#data_resolution_enabled_div').fadeTo('slow', 1);
			$('#data_resolution_enabled').prop('disabled',false);
		} else {
			$('#data_resolution_enabled_div').fadeTo('fast', 0.3);
			$('#data_resolution_enabled').val('').prop('disabled',true);
		}
	});
	$('#data_entry_trigger_url_chkbx').click(function(){
		if ($(this).prop('checked')) {
			$('#data_entry_trigger_url_div').fadeTo('slow', 1);
			$('#data_entry_trigger_url').prop('disabled',false);
		} else {
			$('#data_entry_trigger_url_div').fadeTo('fast', 0.3);
			$('#data_entry_trigger_url').val('').prop('disabled',true);
		}
	});
	$('#custom_record_label_chkbx').click(function(){
		if ($(this).prop('checked')) {
			$('#custom_record_label_div').fadeTo('slow', 1);
			$('#custom_record_label').prop('disabled',false);
		} else {
			$('#custom_record_label_div').fadeTo('fast', 0.3);
			$('#custom_record_label').prop('disabled',true);
			$('#custom_record_label').val('');
		}
	});
	$('#order_id_by_chkbx').click(function(){
		if ($(this).prop('checked')) {
			$('#order_id_by_div').fadeTo('slow', 1);
			$('#order_id_by').prop('disabled',false);
		} else {
			$('#order_id_by_div').fadeTo('fast', 0.3);
			$('#order_id_by').prop('disabled',true);
			$('#order_id_by').val('');
		}
	});
	$('#secondary_pk_chkbx').click(function(){
		if ($(this).prop('checked')) {
			$('#secondary_pk_div').fadeTo('slow', 1);
			$('#customize_project #secondary_pk').prop('disabled',false);
		} else {
			$('#secondary_pk_div').fadeTo('fast', 0.3);
			$('#customize_project #secondary_pk').prop('disabled',true);
			$('#customize_project #secondary_pk').val('');
		}
	});
	// When load page, disabled drop-down if has no value
	if ($('#customize_project #secondary_pk').val().length < 1) {
		$('#secondary_pk_div').fadeTo(0, 0.3);
		$('#customize_project #secondary_pk').prop('disabled',true);
	}
	$('#purpose').change(function(){
		setTimeout(function(){
			fitDialog($('#edit_project'));
			$('#edit_project').dialog('option', 'position', 'center');
		},700);
	});


	// Use javascript to pre-fill 'modify project settings' form with existing info
	setTimeout(function()
	{
		$('#app_title').val('<?php echo cleanHtml(filter_tags(html_entity_decode($app_title, ENT_QUOTES))) ?>');
		$('#purpose').val('<?php echo $purpose ?>');
		if ($('#purpose').val() == '1') {
			$('#purpose_other_span').css({'visibility':'visible'});
			$('#purpose_other_text').val('<?php echo cleanHtml(filter_tags(html_entity_decode($purpose_other, ENT_QUOTES))) ?>');
			$('#purpose_other_text').css('display','');
		} else if ($('#purpose').val() == '2') {
			$('#purpose_other_span').css({'visibility':'visible'});
			$('#project_pi_irb_div').css('display','');
			$('#project_pi_firstname').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_firstname, ENT_QUOTES))) ?>');
			$('#project_pi_mi').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_mi, ENT_QUOTES))) ?>');
			$('#project_pi_lastname').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_lastname, ENT_QUOTES))) ?>');
			$('#project_pi_email').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_email, ENT_QUOTES))) ?>');
			$('#project_pi_alias').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_alias, ENT_QUOTES))) ?>');
			$('#project_pi_username').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_pi_username, ENT_QUOTES))) ?>');
			$('#project_irb_number').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_irb_number, ENT_QUOTES))) ?>');
			$('#project_grant_number').val('<?php echo cleanHtml(filter_tags(html_entity_decode($project_grant_number, ENT_QUOTES))) ?>');
			$('#purpose_other_research').css('display','');
			var purposeOther = '<?php echo $purpose_other ?>';
			if (purposeOther != '') {
				var purposeArray = purposeOther.split(',');
				for (i = 0; i < purposeArray.length; i++) {
					document.getElementById('purpose_other['+purposeArray[i]+']').checked = true;
				}
			}
		}
		$('#repeatforms_chk_div').css({'display':'block'});
		$('#datacollect_chk').prop('checked',true);
		$('#projecttype<?php echo ($surveys_enabled ? '2' : '1') ?>').prop('checked',true);
		$('#repeatforms_chk<?php echo ($repeatforms ? '2' : '1') ?>').prop('checked',true);
	<?php if ($scheduling) { ?>
		$('#scheduling_chk').prop('checked',true);
	<?php } ?>
	<?php if ($randomization) { ?>
		$('#randomization_chk').prop('checked',true);
	<?php } ?>
	<?php if (empty($custom_record_label)) { ?>
		$('#custom_record_label_div').fadeTo(0, 0.3);
		$('#custom_record_label').val('').prop('disabled',true);
	<?php } ?>
	<?php if ($data_resolution_enabled == '0') { ?>
		$('#data_resolution_enabled_div').fadeTo(0, 0.3);
		$('#data_resolution_enabled').val('').prop('disabled',true);
	<?php } ?>
	<?php if (empty($data_entry_trigger_url)) { ?>
		$('#data_entry_trigger_url_div').fadeTo(0, 0.3);
		$('#data_entry_trigger_url').val('').prop('disabled',true);
	<?php } ?>
	<?php if (empty($order_id_by)) { ?>
		$('#order_id_by_div').fadeTo(0, 0.3);
		$('#order_id_by').val('').prop('disabled',true);
	<?php } ?>

	// Run function to set up the steps accordingly
	setFieldsCreateForm(false);

	<?php if ($status > 0 && !$super_user) { ?>
		// Do not allow normal users to edit project settings if in Production
		$('#projecttype0').prop('disabled',true);
		$('#projecttype1').prop('disabled',true);
		$('#projecttype2').prop('disabled',true);
		$('#datacollect_chk').prop('disabled',true);
		$('#scheduling_chk').prop('disabled',true);
		$('#repeatforms_chk1').prop('disabled',true);
		$('#repeatforms_chk2').prop('disabled',true);
		$('#randomization_chk').prop('disabled',true);
		$('#primary_use_disable').show();
		// Add additional hidden fields to the form for disabled checkboxes to preserve current values
		$('#editprojectform').append('<input type="hidden" name="scheduling" value="<?php echo $scheduling ?>">');
	<?php } ?>

	},(isIE6 ? 1000 : 1));
});
</script>

<?php




include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
