<?php
// Prevent view from being called directly
require_once dirname(dirname(__FILE__)) . '/Config/init_functions.php';
System::init();

// Need to call survey functions file to utilize a function
require_once APP_PATH_DOCROOT . "Surveys/survey_functions.php";

// Begin HTML
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title><?php echo strip_tags(remBr(br2nl($app_title))) ?> | REDCap</title>
	<meta name="googlebot" content="noindex, noarchive, nofollow, nosnippet">
	<meta name="robots" content="noindex, noarchive, nofollow">
	<meta name="slurp" content="noindex, noarchive, nofollow, noodp, noydir">
	<meta name="msnbot" content="noindex, noarchive, nofollow, noodp">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo APP_PATH_IMAGES ?>favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon-precomposed" href="<?php echo APP_PATH_IMAGES ?>apple-touch-icon.png">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_PATH_CSS ?>jquery-ui.min.css" media="screen,print">
	<link rel="stylesheet" type="text/css" href="<?php echo APP_PATH_CSS ?>style.css" media="screen,print">
	<?php if (PAGE == 'DataEntry/index.php') { ?><link rel="stylesheet" type="text/css" href="<?php echo APP_PATH_CSS ?>survey_text_very_large.css" media="screen and (max-width: 767px)"><?php } ?>
	<script type="text/javascript" src="<?php echo APP_PATH_JS ?>base.js"></script>
</head>
<body>
<?php
		
// REDCap Hook injection point: Pass PROJECT_ID constant (if defined).
Hooks::call('redcap_every_page_top', array(defined('PROJECT_ID') ? PROJECT_ID : null));

// iOS CSS Hack for rendering drop-down menus with a background image
if ($isIOS)
{
	print  '<style type="text/css">select { padding-right:14px !important;background-image:url("'.APP_PATH_IMAGES.'arrow_state_grey_expanded.png") !important; background-position:right !important; background-repeat:no-repeat !important; }</style>';
}

// Render Javascript variables needed on all pages for various JS functions
renderJsVars();

// STATS: Check if need to report institutional stats to REDCap consortium
checkReportStats();

// Do CSRF token check (using PHP with jQuery)
System::createCsrfToken();

// Initialize auto-logout popup timer and logout reset timer listener
initAutoLogout();

// Render divs holding javascript form-validation text (when error occurs), so they get translated on the page
renderValidationTextDivs();

// Render hidden divs used by showProgress() javascript function
renderShowProgressDivs();

// Display notice that password will expire soon (if utilizing $password_reset_duration for Table-based authentication)
Authentication::displayPasswordExpireWarningPopup();

// Check if need to display pop-up dialog to SET UP SECURITY QUESTION for table-based users
Authentication::checkSetUpSecurityQuestion();


// PROJECT DELETED: If project has been scheduled for deletion, then display dialog that project can't be accessed (except by super users)
if ($date_deleted != "")
{
	// Display "project was deleted" dialog
	$deleteProjDialog = "{$lang['bottom_65']} <b>".
						DateTimeRC::format_ts_from_ymd(date('Y-m-d H:i:s', strtotime($date_deleted)+3600*24*Project::DELETE_PROJECT_DAY_LAG)).
						"</b>{$lang['bottom_66']}";
	if ($super_user) {
		$deleteProjDialog .= "<br><br><b>{$lang['edit_project_77']}</b> {$lang['bottom_68']}";
	}
	// Note that the popup cannot be closed
	$deleteProjDialog .= RCView::div(array('style'=>'color:#777;margin:15px 0 20px;'), $lang['edit_project_155']);
	// "Return to My Projects" button
	$deleteProjDialog .= RCView::button(array('href'=>'javascript:;', 'onclick'=>"window.location.href='".APP_PATH_WEBROOT_PARENT."index.php?action=myprojects';", 'class'=>'jqbuttonmed'), $lang['bottom_69']);
	// If a super user, show "Restore" button
	if ($super_user) {
		$deleteProjDialog .= RCView::SP . RCView::button(array('href'=>'javascript:;', 'onclick'=>"undelete_project($project_id)", 'class'=>'jqbuttonmed'), $lang['control_center_375']);
	}
	// Notice div that project was deleted
	print RCView::simpleDialog(RCView::div(array('style'=>'color:#C00000;'), $deleteProjDialog),$lang['global_03'].$lang['colon']." ".$lang['bottom_67'],"deleted_note");
	// Hidden "undelete project" div
	print RCView::simpleDialog("", $lang['control_center_378'], 'undelete_project_dialog');
	?>
	<script type="text/javascript">
	$(function(){
		$('#deleted_note').dialog({ bgiframe: true, modal: true, width: 500, close: function(){ setTimeout('openDelProjDialog()',10); } });
	});
	</script>
	<?php
}


// Project status label
$statusLabel = '<div>'.$lang['edit_project_58'].'&nbsp; ';
// Set icon/text for project status
if ($status == '1') {
	$statusLabel .= '<b style="color:green;">'.$lang['global_30'].'</b></div>';
} elseif ($status == '2') {
	$statusLabel .= '<b style="color:#800000;">'.$lang['global_31'].'</b></div>';
} elseif ($status == '3') {
	$statusLabel .= '<b style="color:#800000;">'.$lang['global_26'].'</b></div>';
} else {
	$statusLabel .= '<b style="color:#555;">'.$lang['global_29'].'</b></div>';
}


/**
 * LOGO & LOGOUT
 */
$logoHtml = "<div id='menu-div'>
				<div class='menubox' style='padding:0px 10px 0px 7px;'>
					<div id='project-menu-logo'>
						<a href='".APP_PATH_WEBROOT_PARENT."index.php?action=myprojects" . (($auth_meth == "none" && $auth_meth != $auth_meth_global && $auth_meth_global != "shibboleth") ? "&logout=1" : "") . "'
							><img src='".APP_PATH_IMAGES."redcap-logo.png' title='REDCap' style='height:45px;'></a>
					</div>
					<div style='font-size:11px;color:#888;margin:3px -10px 7px -2px;'>
						<img src='".APP_PATH_IMAGES."lock_small_disable.gif' style='top:5px;'>
						{$lang['bottom_01']} <span style='font-weight:bold;color:#555;'>$userid</span>
						".($auth_meth == "none"
							? ""
							: 	((strlen($userid) < 14 && $auth_meth != "none")
									? " &nbsp;|&nbsp; <span>"
									: "<br><span style='padding:1px 0 0;'><img src='".APP_PATH_IMAGES."cross_small_circle_gray.png' style='top:5px;'> "
								) .
								"<a href='".PAGE_FULL."?".$_SERVER['QUERY_STRING']."&logout=1' style='font-size:10px;font-family:tahoma;'>{$lang['bottom_02']}</a></span>"
						  )."
					</div>
					<div class='hang'>
						<span class='glyphicon glyphicon-list-alt' style='text-indent:0;' aria-hidden='true'></span>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT_PARENT."index.php?action=myprojects" . (($auth_meth == "none" && $auth_meth != $auth_meth_global && $auth_meth_global != "shibboleth") ? "&logout=1" : "") . "'>{$lang['bottom_03']}</a>
						" .
						(!SUPER_USER ? "" :
							RCView::span(array('style'=>'color:#777;margin:0 7px 0 5px;'), $lang['global_47']) .
							"<span class='glyphicon glyphicon-cog' style='text-indent:0;' aria-hidden='true'></span> <a href='".APP_PATH_WEBROOT."ControlCenter/index.php'>{$lang['global_07']}</a>"
						) .
						"
					</div>
					<div class='hang'>
						<span class='glyphicon glyphicon-home' style='text-indent:0;' aria-hidden='true'></span>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."index.php?pid=$project_id'>{$lang['bottom_44']}</a>
					</div>
					<div class='hang'>
						<img src='".APP_PATH_IMAGES."checklist_flat.png'>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."ProjectSetup/index.php?pid=$project_id'>{$lang['app_17']}</a>
					</div>
					<div style='font-size:11px;color:#666;padding:3px 0 3px 23px;'>
						$statusLabel
					</div>
				</div>
			</div>";


// ONLY for DATA ENTRY FORMS, get record information
list ($fetched, $hidden_edit, $entry_num) = getRecordAttributes();


// Build data entry form list
if ($status < 2 && !empty($user_rights))
{
	$dataEntry = "<div class='menubox' style='padding-right:0px;'>";
	// Set text for Invite Participants link
	$invitePart = "";
	if ($surveys_enabled && $user_rights['participants']) {
		$invitePart = "<div class='hang' style='position:relative;left:-8px;'><img src='".APP_PATH_IMAGES."survey_participants.gif'>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."Surveys/invite_participants.php?pid=$project_id'>".$lang['app_22']."</a></div>";
		if ($status < 1) {
			$invitePart .=  "<div class='menuboxsub'>- ".$lang['invite_participants_01']."</div>";
		}
	}
	// Set panel title text
	$menu_id = 'projMenuDataCollection';
	$dataEntryCollapsed = UIState::getMenuCollapseState($project_id, $menu_id);
	$imgCollapsed = $dataEntryCollapsed ? "toggle-expand.png" : "toggle-collapse.png";
	$dataEntryTitle =  "<div style='float:left'>{$lang['bottom_47']}</div>
						<div class='opacity65 projMenuToggle' id='$menu_id'>"
						. RCView::a(array('href'=>'javascript:;'),
							RCView::img(array('src'=>$imgCollapsed, 'class'=>($isIE ? 'opacity65' : '')))
						  ) . "
					   </div>";
	if ($status < 1 && $user_rights['design']) {
		$dataEntryTitle .= "<div class='opacity65' id='menuLnkEditInstr' style='float:right;margin-right:5px;'>"
							. RCView::span(array('class'=>'glyphicon glyphicon-pencil', 'style'=>'color:#000066;font-weight:normal;font-size:10px;top:2px;margin-right:3px;'), '')
							. RCView::a(array('href'=>APP_PATH_WEBROOT."Design/online_designer.php?pid=$project_id",'style'=>'color:#000066;font-size:11px;font-weight:normal;text-decoration:underline;'), $lang['bottom_70'])
						. "</div>";
	}

	## DATA COLLECTION SECTION
	// Invite Participants
	$dataEntry .= $invitePart;

	// Scheduling
	if ($repeatforms && $scheduling) {
		$dataEntry .= "<div class='hang' style='position:relative;'><img src='".APP_PATH_IMAGES."calendar_plus.png'>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."Calendar/scheduling.php?pid=$project_id'>".$lang['global_25']."</a></div>";
		if ($status < 1) {
			$dataEntry .=  "<div class='menuboxsub'>- ".$lang['bottom_19']."</div>";
		}
	}

	## DATA STATUS GRID
	$dataEntry .= "<div class='hang' style='position:relative;'><img src='".APP_PATH_IMAGES."application_view_icons.png'>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."DataEntry/record_status_dashboard.php?pid=$project_id'>{$lang['global_91']}</a></div>";
	if ($status < 1) {
		$dataEntry .=  "<div class='menuboxsub' style='position:relative;'>- ".$lang['bottom_60']."</div>";
	}

	## Display link for manage page if using multiple time-points (Longitudinal Module)
	$addEditRecordPage = "";
	// If user is on grid page or data entry page and record is selected, make grid icon a link back to grid page
	$gridlink = "<img src='".APP_PATH_IMAGES."blog_pencil.gif'>";
	$addEditRecordPage = "DataEntry/record_home.php?pid=$project_id";
	/* 
	if ($longitudinal) {
		$addEditRecordPage = "DataEntry/record_home.php?pid=$project_id";
	} else {
		// Point to first form that user has access to
		foreach (array_keys($Proj->forms) as $this_form) {
			if ($user_rights['forms'][$this_form] == '0') continue;
			$addEditRecordPage = "DataEntry/index.php?pid=$project_id&page=$this_form";
			break;
		}
	}
	 */
	if ($addEditRecordPage != "") {
		$dataEntry .=  "<div class='hang' style='position:relative;'>
						$gridlink&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."$addEditRecordPage' style='color:#800000'>".
							(($user_rights['record_create'] && ($user_rights['forms'][$Proj->firstForm] == '1' || $user_rights['forms'][$Proj->firstForm] == '3')) ? $lang['bottom_62'] : $lang['bottom_72'])."</a>
						</div>";
		if ($status < 1) {
			$dataEntry .=  "<div class='menuboxsub' style='position:relative;'>- ".
							(($user_rights['record_create'] && ($user_rights['forms'][$Proj->firstForm] == '1' || $user_rights['forms'][$Proj->firstForm] == '3')) ? $lang['bottom_64'] : $lang['bottom_73'])."</div>";
		}
	}

	// If showing Scheduling OR Invite Participant links OR viewing a record in longitudinal...
	if ((isset($_GET['id']) && PAGE == "DataEntry/record_home.php")
		|| (isset($fetched) && PAGE == "DataEntry/index.php"))
	{
		// Show record name on left-hand menu (if a record is pulled up)
		$record_label = "";
		if ((isset($_GET['id']) && PAGE == "DataEntry/record_home.php")
			|| (isset($fetched) && PAGE == "DataEntry/index.php" && isset($_GET['event_id']) && is_numeric($_GET['event_id'])))
		{
			if (PAGE == "DataEntry/record_home.php") {
				$fetched = $_GET['id'];
			}
			$record_display = RCView::b(RCView::escape(isset($_GET['id']) ? $_GET['id'] : ''));
			// Get Custom Record Label and Secondary Unique Field values (if applicable)
			$this_custom_record_label_secondary_pk = Records::getCustomRecordLabelsSecondaryFieldAllRecords(addDDEending($fetched), false, getArm(), true);
			if ($this_custom_record_label_secondary_pk != '') {
				$record_display2 = "&nbsp; $this_custom_record_label_secondary_pk";
			} else {
				$record_display2 = "";
			}
			// DISPLAY RECORD NAME: Set full string for record name with prepended label (e.g., Study ID 202)
			//if ($longitudinal || isDev()) {
				// Longitudinal project: Display record name as link and "select other record" link
				$record_label = RCView::div(array('style'=>'padding:0 0 4px;color:#800000;font-size:12px;'),
									RCView::div(array('style'=>'float:left;'),
										RCView::img(array('src'=>'application_view_tile.png')) .
										RCView::a(array('style'=>'text-decoration:underline;','href'=>APP_PATH_WEBROOT."DataEntry/record_home.php?pid=$project_id&id=$fetched&arm=".getArm()),
											strip_tags(label_decode($table_pk_label)) . " " . $record_display
										) . 
										$record_display2
									) .
									RCView::div(array('style'=>'float:right;'),
										RCView::a(array('id'=>'menuLnkChooseOtherRec','class'=>'opacity65','href'=>APP_PATH_WEBROOT."DataEntry/record_home.php?pid=$project_id"),
											$lang['bottom_63']
										)
									) .
									RCView::div(array('class'=>'clear'), '')
								);
			/* 
			} else {
				// Classic project: Display record name and "select other record" link
				$record_label = RCView::div(array('style'=>'padding:0 0 4px;color:#800000;font-size:12px;'),
									RCView::div(array('style'=>'float:left;'),
										strip_tags(label_decode($table_pk_label)) . " " . $record_display . 
										$record_display2
									) .
									RCView::div(array('style'=>'float:right;'),
										RCView::a(array('id'=>'menuLnkChooseOtherRec','class'=>'opacity65','style'=>'color:#000066;vertical-align:middle;text-decoration:underline;font-size:10px;','href'=>APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&page={$_GET['page']}"),
											$lang['bottom_63']
										)
									) .
									RCView::div(array('class'=>'clear'), '')
								);
			}
			 */
		}

		// Get event description for this event
		$event_label = "";
		if ($longitudinal && isset($_GET['event_id']) && is_numeric($_GET['event_id']))
		{
			// Get all repeating events
			$repeatingFormsEvents = $Proj->getRepeatingFormsEvents();
			// Add instance number if a repeating instance		
			$is_repeating_event = (isset($repeatingFormsEvents[$_GET['event_id']]) && !is_array($repeatingFormsEvents[$_GET['event_id']]));
			$instanceNum = ($is_repeating_event && $_GET['instance'] > 1) ? "<span style='color:#800000;margin-left:3px;'>({$lang['data_entry_278']}{$_GET['instance']})</span>" : "";
			// Display enent name
			$event_label = "<div style='padding:1px 0 5px;'>
								{$lang['bottom_23']}&nbsp;
								<span style='color:#800000;font-weight:bold;'>".RCView::escape(strip_tags($Proj->eventInfo[$_GET['event_id']]['name_ext']))."</span>
								$instanceNum
							</div>";
		}

		if ($addEditRecordPage != "") {
			$dataEntry .=  "<div class='menuboxsub' style='margin:8px 0 0;border-top:1px dashed #aaa;text-indent:0;padding-top:5px;font-size:10px;'>
								$record_label
								$event_label
								" . (PAGE == "DataEntry/index.php" ? $lang['global_36'] . $lang['colon'] : "") . "
							</div>";
		}
	}
	
	// CLASSIC Only: Allow users to view the instruments without being in record context (legacy feature - now hidden by default)
	if (!$longitudinal && !(isset($fetched) && (PAGE == "DataEntry/index.php" || PAGE == "DataEntry/record_home.php"))) 
	{
		$showFormsList = (UIState::getUIStateValue(PROJECT_ID, 'sidebar', 'show-instruments-toggle') == '1');
		$hideFormsClass = $showFormsList ? '' : 'hide';
		$showFormsClass = $showFormsList ? 'hide' : '';
		$dataEntry .=  "<div style='margin-top:3px;'>
						<a class='show-instruments-toggle $hideFormsClass' onclick=\"showInstrumentsToggle(this,1);\" href='javascript:;'>{$lang['global_136']} <span class='dropup'><span class='caret'></span></span></a>
						<a class='show-instruments-toggle $showFormsClass' onclick=\"showInstrumentsToggle(this,0);\" href='javascript:;'>{$lang['global_135']} <span class='caret'></span></a>
						</div>";		
	}

	## Render the form list for this project
	list ($form_count, $formString, $lockedFormCount) = Form::renderFormMenuList($fetched,$hidden_edit);
	$dataEntry .= $formString;

	## LOCK / UNLOCK RECORDS
	//If user has ability to lock a record, give option to lock it for all forms (if record is pulled up on data entry page)
	if ($user_rights['lock_record_multiform'] && $user_rights['lock_record'] > 0 && PAGE == "DataEntry/index.php" && isset($fetched))
	{
		//Adjust if double data entry for display in pop-up
		if ($double_data_entry && $user_rights['double_data'] != '0') {
			$fetched2 = $fetched . '--' . $user_rights['double_data'];
		//Normal
		} else {
			$fetched2 = $fetched;
		}
		//Determine when to show which link
		if ($lockedFormCount == $form_count) {
			$show_unlocked_link = true;
			$show_locked_link = false;
		} elseif ($lockedFormCount == 0) {
			$show_unlocked_link = false;
			$show_locked_link = true;
		} else {
			$show_locked_link = true;
			$show_unlocked_link = true;
		}
		//Show link "Lock all forms"
		if ($show_locked_link && $hidden_edit) {
			$dataEntry .=  "<div style='text-align:left;padding: 6px 0px 2px 0px;'>
								<img src='".APP_PATH_IMAGES."lock.png'>
								<a style='color:#A86700;font-size:12px' href='javascript:;' onclick=\"
									lockUnlockForms('".cleanHtml($fetched2)."','".cleanHtml($fetched)."','{$_GET['event_id']}','0','0','lock');
									return false;
								\">{$lang['bottom_40']}</a>
							</div>";
		}
		//Show link "Unlock all forms"
		if ($show_unlocked_link && $hidden_edit) {
			$dataEntry .=  "<div style='text-align:left;padding: 6px 0px 2px 0px;'>
								<img src='".APP_PATH_IMAGES."lock_open.png'>
								<a style='color:#666;font-size:12px' href='javascript:;' onclick=\"
									lockUnlockForms('".cleanHtml($fetched2)."','".cleanHtml($fetched)."','{$_GET['event_id']}','0','0','unlock');
									return false;
								\">{$lang['bottom_41']}</a>
							</div>";
		}

	}

	$dataEntry .= "</div>";
}


/**
 * APPLICATIONS MENU
 * Show function links based on rights level (Don't allow designated Double Data Entry people to see pages displaying other user's data.)
 */
$menu_id = 'projMenuApplications';
$appsMenuCollapsed = UIState::getMenuCollapseState($project_id, $menu_id);
$imgCollapsed = $appsMenuCollapsed ? "toggle-expand.png" : "toggle-collapse.png";
$appsMenuTitle =   "<div style='float:left'>{$lang['bottom_25']}</div>
					<div class='opacity65 projMenuToggle' id='$menu_id'>"
					. RCView::a(array('href'=>'javascript:;'),
						RCView::img(array('src'=>$imgCollapsed, 'class'=>($isIE ? 'opacity65' : '')))
					  ) . "
				   </div>";
$appsMenu = "<div class='menubox' style='padding-right:0;'>";
//Calendar
if ($status < 2 && $user_rights['calendar']) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."date.png'>&nbsp;&nbsp;<a href='".APP_PATH_WEBROOT."Calendar/index.php?pid=$project_id'>{$lang['app_08']}</a></div>";
}
// Data Exports, Reports, & Stats
if (isset($user_rights['data_export_tool']) && ($user_rights['reports'] || $user_rights['data_export_tool'] > 0 || $user_rights['graphical'])) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."layout_down_arrow.gif' style='margin-top:2px;'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "DataExport/index.php?pid=$project_id\">{$lang['app_23']}</a></div>";
}
//Data Import Tool
if ($status < 2 && $user_rights['data_import_tool']) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."table_row_insert.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "index.php?pid=$project_id&route=DataImportController:index\">{$lang['app_01']}</a></div>";
}
//Data Comparison Tool
if ($status < 2 && $user_rights['data_comparison_tool']) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."page_copy.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "index.php?pid=$project_id&route=DataComparisonController:index\">{$lang['app_02']}</a></div>";
}
//Data Logging
if ($user_rights['data_logging']) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."report.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "Logging/index.php?pid=$project_id\">".$lang['app_07']."</a></div>";
}
// Field Comment Log
if ($data_resolution_enabled == '1') {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."balloons.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "DataQuality/field_comment_log.php?pid=$project_id\">{$lang['dataqueries_141']}</a></div>";
}
//File Repository
if ($user_rights['file_repository']) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."page_white_stack.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "FileRepository/index.php?pid=$project_id\">{$lang['app_04']}</a></div>";
}
//User Rights
if ($user_rights['user_rights'] || $user_rights['data_access_groups']) {
	$appsMenu .= "<div class='hang'>";
	if ($user_rights['user_rights']) {
		$appsMenu .= "<img src='".APP_PATH_IMAGES."user.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "UserRights/index.php?pid=$project_id\">{$lang['app_05']}</a>";
	}
	if ($user_rights['user_rights'] && $user_rights['data_access_groups']) {
		$appsMenu .= RCView::span(array('style'=>'color:#777;margin:0 6px 0 5px;'), $lang['global_43']);
	}
	if ($user_rights['data_access_groups']) {
		$appsMenu .= "<img src='".APP_PATH_IMAGES."group.png' style='margin-right:2px;'>
					<a href=\"" . APP_PATH_WEBROOT . "DataAccessGroups/index.php?pid=$project_id\">{$lang['global_114']}</a>";
	}
	$appsMenu .= "</div>";
}
//Lock Record advanced setup
if ($user_rights['lock_record_customize'] > 0) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."lock_plus.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "Locking/locking_customization.php?pid=$project_id\">{$lang['app_11']}</a></div>";
}
//E-signature and Locking Management
if ($status < 2 && $user_rights['lock_record'] > 0) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."tick_shield_lock.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "Locking/esign_locking_management.php?pid=$project_id\">{$lang['app_12']}</a></div>";
}
// Randomization
if ($randomization && $status < 2 && ($user_rights['random_setup'] || $user_rights['random_dashboard'])) {
	$rpage = ($user_rights['random_setup']) ? "index.php" : "dashboard.php";
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."arrow_switch.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "Randomization/$rpage?pid=$project_id\">{$lang['app_21']}</a></div>";
}
// Data Quality
if ($status < 2 && ($user_rights['data_quality_design'] || $user_rights['data_quality_execute'] || ($data_resolution_enabled == '2' && $user_rights['data_quality_resolution'] > 0))) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."checklist.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "DataQuality/index.php?pid=$project_id\">{$lang['app_20']}</a>";
	if ($data_resolution_enabled == '2' && $user_rights['data_quality_resolution'] > 0) {
		// Resolve Issues
		$appsMenu .= RCView::span(array('style'=>'color:#777;margin:0 4px;'), $lang['global_43']) .
					"<img src='".APP_PATH_IMAGES."balloons.png'>
					<a href=\"" . APP_PATH_WEBROOT . "DataQuality/resolve.php?pid=$project_id\">{$lang['dataqueries_148']}</a>";
	}
	$appsMenu .= "</div>";
}
// API
if ($status < 2 && $api_enabled && ($user_rights['api_export'] || $user_rights['api_import'])) {
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."computer.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "API/project_api.php?pid=$project_id\">{$lang['setup_77']}</a>".
					RCView::span(array('style'=>'color:#777;margin:0 6px 0 5px;'), $lang['global_43']) .
					"<img src='".APP_PATH_IMAGES."computer.png'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "API/playground.php?pid=$project_id\">{$lang['setup_143']}</a></div>";
}
// Mobile app
if ($status < 2 && $mobile_app_enabled && $api_enabled && $user_rights['mobile_app'])
{
	$appsMenu .= "<div class='hang'><img src='".APP_PATH_IMAGES."redcap_app_icon.gif'>&nbsp;&nbsp;<a href=\"" . APP_PATH_WEBROOT . "MobileApp/index.php?pid=$project_id\">{$lang['global_118']}</a></div>";
}
$appsMenu .= "</div>";




/*
 ** REPORTS
 */
//Check to see if custom reports are specified for this project. If so, print the appropriate links.
//Build menu item for each separate report
$menu_id = 'projMenuReports';
$reportsListCollapsed = UIState::getMenuCollapseState($project_id, $menu_id);
$imgCollapsed = $reportsListCollapsed ? "toggle-expand.png" : "toggle-collapse.png";
$reportsListTitle = "<div style='float:left'>{$lang['app_06']}</div>
					<div class='opacity65 projMenuToggle' id='$menu_id'>"
					. RCView::a(array('href'=>'javascript:;'),
						RCView::img(array('src'=>$imgCollapsed, 'class'=>($isIE ? 'opacity65' : '')))
					  ) . "
				   </div>";
if ($user_rights['reports']) {
	$reportsListTitle .= "<div class='opacity65' id='menuLnkEditReports' style='float:right;margin-right:5px;'>"
						. RCView::span(array('class'=>'glyphicon glyphicon-pencil', 'style'=>'color:#000066;font-weight:normal;font-size:10px;top:2px;margin-right:3px;'), '')
						. RCView::a(array('href'=>APP_PATH_WEBROOT."DataExport/index.php?pid=$project_id",'style'=>'font-family:"Open Sans",arial;font-size:11px;text-decoration:underline;color:#000066;font-weight:normal;'), $lang['bottom_71'])
					. "</div>";
}
// Reports built in Reports & Exports module
$reportsList = DataExport::outputReportPanel();


/**
 * HELP MENU
 */
$menu_id = 'projMenuHelp';
$helpMenuCollapsed = UIState::getMenuCollapseState($project_id, $menu_id);
$imgCollapsed = $helpMenuCollapsed ? "toggle-expand.png" : "toggle-collapse.png";
$helpMenuTitle =   "<div style='float:left;color:#3E72A8;'>
						{$lang['bottom_42']}
					</div>
					<div class='opacity65 projMenuToggle' id='$menu_id'>"
					. RCView::a(array('href'=>'javascript:;'),
						RCView::img(array('src'=>$imgCollapsed, 'class'=>($isIE ? 'opacity65' : '')))
					  ) . "
				   </div>";
$helpMenu = "<div class='menubox' style='font-size:11px;color:#444;'>

				<!-- Help & FAQ -->
				<div class='hang'>
					<span class='glyphicon glyphicon-question-sign' style='text-indent:0;font-size:13px;' aria-hidden='true'></span>&nbsp; 
					<a style='color:#444;' href='" . APP_PATH_WEBROOT_PARENT . "index.php?action=help'>".$lang['bottom_27']."</a>
				</div>

				<!-- Video Tutorials -->
				<div class='hang'>
					<span class='glyphicon glyphicon-film' style='text-indent:0;font-size:13px;' aria-hidden='true'></span>&nbsp; 
					<a style='color:#444;' href='javascript:;' onclick=\"
						$('#menuvids').toggle('blind',{},500,
							function(){
								var objDiv = document.getElementById('west');
								objDiv.scrollTop = objDiv.scrollHeight;
							}
						);
					\">".$lang['bottom_28']."</a>
				</div>

				<div id='menuvids' style='display:none;line-height:1.2em;padding:2px 0 0 16px;'>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('redcap_overview_brief02.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_58']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('redcap_overview03.mp4')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_57']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('project_types01.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['training_res_71']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('redcap_survey_basics02.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_51']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('data_entry_overview_01.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_56']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('form_editor_upload_dd02.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_31']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('redcap_db_applications_menu02.flv')\" style='font-size:11px;' href='javascript:;'>".$lang['bottom_32']."</a>
					</div>
					<div class='menuvid'>
						&bull; <a onclick=\"popupvid('app_overview_01.mp4')\" style='font-size:11px;' href='javascript:;'>".$lang['global_118']."</a>
					</div>
				</div>

				<!-- Suggest a New Feature -->
				<div class='hang'>
					<span class='glyphicon glyphicon-share' style='text-indent:0;font-size:13px;' aria-hidden='true'></span>&nbsp; 
					<a style='color:#444;' target='_blank' href='https://redcap.vanderbilt.edu/enduser_survey_redirect.php?redcap_version=$redcap_version&server_name=".SERVER_NAME."'>".$lang['bottom_52']."</a>
				</div>

				<div style='padding-top:15px;'>
					<a href='mailto:$project_contact_email?subject=".rawurlencode($lang['bottom_77'])."&body=".rawurlencode($lang['global_11'].$lang['colon']." ".USERID."\n".$lang['control_center_107']." \"".strip_tags($app_title)."\"\n".$lang['bottom_81']." ".APP_PATH_WEBROOT_FULL."redcap_v{$redcap_version}/index.php?pid=$project_id\n\n".$lang['bottom_78']."\n\n".$lang['bottom_79']."\n\n".$lang['bottom_80']."\n$user_firstname $user_lastname\n")."' class='btn-contact-admin btn btn-primary btn-xs' style='color:#fff;'><span class='glyphicon glyphicon-envelope'></span> {$lang['bottom_76']}</a>
				</div>

			</div>";

/**
 * EXTERNAL PAGE LINKAGE
 */
if (defined("USERID") && isset($ExtRes)) {
	$externalLinkage = $ExtRes->renderHtmlPanel();
}


// Build the HTML panels for the left-hand menu
// Make sure that 'pid' in URL is defined (otherwise, we shouldn't be including this file)
if (isset($_GET['pid']) && is_numeric($_GET['pid']))
{
	$westHtml = renderPanel('', $logoHtml)
			  . renderPanel((isset($dataEntryTitle) ? $dataEntryTitle : ''), (isset($dataEntry) ? $dataEntry : ''), '', $dataEntryCollapsed)
			  . renderPanel($appsMenuTitle, $appsMenu, 'app_panel', $appsMenuCollapsed);
	if ($externalLinkage != "") {
		$westHtml .= $externalLinkage;
	}
	if ($reportsList != "") {
		$westHtml .= renderPanel($reportsListTitle, $reportsList, 'report_panel', $reportsListCollapsed);
	}
	$westHtml .= renderPanel($helpMenuTitle, $helpMenu, 'help_panel', $helpMenuCollapsed);
}
else
{
	// Since no 'pid' is in URL, then give warning that header/footer will not display properly
	$westHtml = renderPanel("&nbsp;", "<div style='padding:20px 15px;'><img src='".APP_PATH_IMAGES."exclamation.png'> <b style='color:#800000;'>{$lang['bottom_54']}</b><br>{$lang['bottom_55']}</div>");
}


/**
 * PAGE CONTENT
 */
?>
<!-- top navbar for mobile -->
<div class="rcproject-navbar navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" style="max-width:78%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo filter_tags($app_title) ?></span>
			<button type="button" class="navbar-toggle" onclick="toggleProjectMenuMobile($('#west'))">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>
</div>
<!-- main window -->
<div class="container-fluid mainwindow">
	<div class="row row-offcanvas row-offcanvas-left">
		<div id="west" class="hidden-xs col-sm-4 col-md-3" role="navigation">
			<?php echo $westHtml ?>
		</div>
		<div id="center" class="col-xs-12 col-sm-8 col-md-9">
			<div id="subheader">
				<?php if ($display_project_logo_institution) { ?>
					<?php if (trim($headerlogo) != "")
						echo "<img src='$headerlogo' title='".cleanHtml($institution)."' alt='".cleanHtml($institution)."' style='margin:-5px 0 5px 20px;max-width:700px; expression(this.width > 700 ? 700 : true);'>";
					?>
					<div id="subheaderDiv1" class="bot-left">
						<?php echo $institution . (($site_org_type == "") ? "" : "<br><span style='font-size:12px;'>$site_org_type</span>") ?>
					</div>
				<?php } ?>
				<div id="subheaderDiv2" class="bot-left"><?php echo filter_tags($app_title) ?></div>
			</div>