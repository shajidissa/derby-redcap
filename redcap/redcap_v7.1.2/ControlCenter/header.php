<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Config for non-project pages
require_once dirname(dirname(__FILE__)) . "/Config/init_global.php";
//If user is not a super user, go back to Home page
if (!SUPER_USER && !ACCOUNT_MANAGER) redirect(APP_PATH_WEBROOT);

// Check for any extra whitespace from config files that would mess up lots of things
$prehtml = ob_get_contents();


// Initialize page display object
$objHtmlPage = new HtmlPage();
$objHtmlPage->addStylesheet("jquery-ui.min.css", 'screen,print');
$objHtmlPage->addStylesheet("style.css", 'screen,print');
$objHtmlPage->addStylesheet("home.css", 'screen,print');
$objHtmlPage->addExternalJS(APP_PATH_JS . "base.js");
$objHtmlPage->addExternalJS(APP_PATH_JS . "yui_charts.js");
$objHtmlPage->addExternalJS(APP_PATH_JS . "underscore-min.js");
$objHtmlPage->addExternalJS(APP_PATH_JS . "backbone-min.js");
$objHtmlPage->addExternalJS(APP_PATH_JS . "RedCapUtil.js");
$objHtmlPage->addExternalJS(APP_PATH_JS . "ControlCenter.js");
$objHtmlPage->PrintHeader();

// STATS: Check if need to report institutional stats to REDCap consortium
checkReportStats();

include APP_PATH_VIEWS . 'HomeTabs.php';


?>

<style type='text/css'>
.cc_label {
	padding: 10px; font-weight: bold; vertical-align: top; line-height: 16px; width: 40%;
}
.cc_data {
	padding: 10px; width: 60%; vertical-align: top;
}
.labelrc, .data {
	background:#F0F0F0 url('<?php echo APP_PATH_IMAGES ?>label-bg.gif') repeat-x scroll 0 0;
	border:1px solid #CCCCCC;
	font-size:12px;
	font-weight:bold;
	
	padding:5px 10px;
}
.labelrc a:link, .labelrc a:visited, .labelrc a:active, .labelrc a:hover { font-size:12px; font-family: "Open Sans",Helvetica,Arial,sans-serif; }
.notesbox {
	width: 100%;
}
.form_border { width: 100%;	}
#sub-nav { font-size:60%;margin-top:8px !important; }
#pagecontainer { max-width: 1000px;  }
h3 { font-weight:bold; }
</style>

<!-- top navbar -->
<div class="rcproject-navbar navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" style="padding:10px 10px 0px 10px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>"><img alt="REDCap" style="width:100px;height:30px;" src="<?php echo APP_PATH_IMAGES ?>redcap-logo-small.png"></a>
			<a class="navbar-brand" style="font-size:13px;padding-left:0;" href="<?php print APP_PATH_WEBROOT ?>ControlCenter/index.php"><kbd><?php echo $lang['global_07'] ?></kbd></a>
			<button type="button" class="navbar-toggle" onclick="toggleProjectMenuMobile($('#control_center_menu'))">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>
</div>

<div class="row">

	<?php	
	// Get count of pending To-Do List items
	$todoListItemsPending = ToDoList::getTotalNumberRequestsByStatus('pending') + ToDoList::getTotalNumberRequestsByStatus('low-priority');
	$todoListItemsPendingBadge = ($todoListItemsPending > 0) ? " <span class='badge'>$todoListItemsPending</span>" : "";
	?>

	<div id="control_center_menu" class="hidden-xs col-sm-4 col-md-3" role="navigation">
		
		
		<!-- ACCOUNT MANAGER TOOLS -->
		<?php if (ACCOUNT_MANAGER) { ?>
		<b style="position:relative;"><?php echo $lang['control_center_4581'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>users3.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/view_users.php"><?php echo $lang['control_center_109'] ?></a><br/>
				<?php if (in_array($auth_meth_global, array('none', 'table', 'ldap_table'))) { ?><img src="<?php echo APP_PATH_IMAGES ?>user_add3.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/create_user.php"><?php echo $lang['control_center_4570'] ?></a><br/><?php } ?>
				<img src="<?php echo APP_PATH_IMAGES ?>user_list.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/user_white_list.php"><?php echo $lang['control_center_162'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>email_go.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/email_users.php"><?php echo $lang['email_users_02'] ?></a><br/>
			</span>
		<?php } else { ?>
		
		<!-- ADMINISTRATOR TOOLS -->
		
		<div class="hideIE8 hidden-sm hidden-md hidden-lg col-xs-12" style="padding:0 5px;">
			<span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp; <a href="<?php echo APP_PATH_WEBROOT_PARENT ?>"><?php echo $lang['control_center_4531'] ?></a>
			<br><img src="<?php echo APP_PATH_IMAGES ?>folders_stack.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT_PARENT ?>index.php?action=myprojects"><?php echo $lang['home_22'] ?></a>
		</div>
		<div class="hideIE8 hidden-sm hidden-md hidden-lg col-xs-12" style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>

		<!-- Control Center Home -->
		<b style="position:relative;"><?php echo $lang['control_center_129'] ?></b><br/>
		<span style="position: relative; float: left; left: 4px;">
			<img src="<?php echo APP_PATH_IMAGES ?>information_frame.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/index.php"><?php echo $lang['control_center_117'] ?></a><br/>
		</span><br>
		<span style="position: relative; float: left; left: 4px;">
			<img src="<?php echo APP_PATH_IMAGES ?>checklist_flat.png">&nbsp;
			<a href="<?php echo APP_PATH_WEBROOT ?>ToDoList/index.php"><?php echo $lang['control_center_446'] . $todoListItemsPendingBadge ?></a>			
		</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		<!-- Dashboard -->
		<b style="position:relative;"><?php echo $lang['control_center_03'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>table.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/system_stats.php"><?php echo $lang['dashboard_48'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>report_user.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/todays_activity.php"><?php echo $lang['control_center_206'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>chart_bar.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/graphs.php"><?php echo $lang['control_center_4395'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>map_marker_blue.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/google_map_users.php"><?php echo $lang['control_center_386'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		<!-- Projects -->
		<b style="position:relative;"><?php echo $lang['control_center_134'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>folders_stack.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/view_projects.php"><?php echo $lang['control_center_110'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>folder_pencil.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/edit_project.php"><?php echo $lang['control_center_4396'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		
		
		<!-- Users -->
		<b style="position:relative;"><?php echo $lang['control_center_132'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>users3.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/view_users.php"><?php echo $lang['control_center_109'] ?></a><br/>
				<?php if (in_array($auth_meth_global, array('none', 'table', 'ldap_table'))) { ?><img src="<?php echo APP_PATH_IMAGES ?>user_add3.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/create_user.php"><?php echo $lang['control_center_4570'] ?></a><br/><?php } ?>
				<img src="<?php echo APP_PATH_IMAGES ?>user_list.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/user_white_list.php"><?php echo $lang['control_center_162'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>email_go.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/email_users.php"><?php echo $lang['email_users_02'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>coins.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/user_api_tokens.php"><?php echo $lang['control_center_245'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>super_user.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/superusers.php"><?php echo $lang['control_center_4572'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		
		<!-- Misc modules -->
		<b style="position:relative;"><?php echo $lang['control_center_4399'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>application_link.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/external_links_global.php"><?php echo $lang['extres_55'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>newspaper_arrow.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/pub_matching_settings.php"><?php echo $lang['control_center_4370'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>databases_arrow.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/ddp_settings.php"><?php echo $lang['ws_63'] ?></a><br/>
				&nbsp;<span class="glyphicon glyphicon-search" style="vertical-align:middle;"></span>&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>index.php?route=ControlCenterController:findCalcErrors"><?php echo $lang['control_center_4582'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		
		<!-- Technical / Developer Tools -->
		<b style="position:relative;"><?php echo $lang['control_center_442'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>database_table.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/mysql_dashboard.php"><?php echo $lang['control_center_4457'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>computer.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT_PARENT ?>api/help/index.php"><?php echo $lang['control_center_445'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>plug.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>Plugins/index.php"><?php echo $lang['control_center_4435'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px 3px;border-bottom:1px solid #ddd;"></div>
		<!-- System Configuration -->
		<b style="position:relative;"><?php echo $lang['control_center_131'] ?></b><br/>
			<span style="position: relative; float: left; left: 4px;">
				<img src="<?php echo APP_PATH_IMAGES ?>view-task.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/check.php"><?php echo $lang['control_center_443'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>table_gear.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/general_settings.php"><?php echo $lang['control_center_125'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>lock.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/security_settings.php"><?php echo $lang['control_center_113'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>group_gear.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/user_settings.php"><?php echo $lang['control_center_315'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>upload.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/file_upload_settings.php"><?php echo $lang['system_config_214'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>brick.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/modules_settings.php"><?php echo $lang['control_center_114'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>validated.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/validation_type_setup.php"><?php echo $lang['control_center_150'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>home_pencil.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/homepage_settings.php"><?php echo $lang['control_center_4397'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>star.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/project_templates.php"><?php echo $lang['create_project_79'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>folder_plus.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/project_settings.php"><?php echo $lang['control_center_136'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>bottom_arrow.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/footer_settings.php"><?php echo $lang['control_center_4398'] ?></a><br/>
				<img src="<?php echo APP_PATH_IMAGES ?>clock_frame.png">&nbsp; <a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/cron_jobs.php"><?php echo $lang['control_center_287'] ?></a><br/>
			</span>
		<div style="clear: both;padding-bottom:6px;margin:0 -6px;border-bottom:0;"></div>
		
		<?php } ?>
	</div>

	<div id="control_center_window" style="padding-left:20px;" class="col-xs-12 col-sm-8 col-md-9">
