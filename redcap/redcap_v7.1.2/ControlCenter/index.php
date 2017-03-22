<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

include 'header.php';
if (!SUPER_USER) redirect(APP_PATH_WEBROOT);

/**
 * MESSAGE TO DISPLAY AFTER SUBMITTING STATS MANUALLY
 * Give user message after returning from sending stats to consortium
 */
if (isset($_GET['sentstats']))
{
	//Stats could not be reported
	if ($_GET['sentstats'] == "fail") {
		$sentstats_alert = "ERROR: Your basic site statistics could not be reported to the consortium! If this is your FIRST TIME "
						 . "REPORTING YOUR STATS, then your stats were likely sent, so please wait 24 hours first to see if "
						 . "it was successful, as there is often a lag for first-time stats sending."
						 . "\\n\\nIf this problem persists, try using the alternative reporting method (see link on this page). If your stats still do not show "
						 . "up on the consortium website after several days, please contact Rob Taylor (rob.taylor@vanderbilt.edu).";
		print  "<script type='text/javascript'>$(function(){alert(\"".cleanHtml2($sentstats_alert)."\");});</script>";
	}
	//Stats were reported, so display alert msg with what was sent
	else {
		if (isset($_GET['saved'])) {
			// Redirect once saved in order to display the fact that stats were reported when we give the confirmation
			$sentstats_alert = "THANK YOU FOR YOUR PARTICIPATION!\\n\\nThe REDCap statistics for your institution "
								 . (isset($_GET['alternative']) ? "will be reported to the REDCap Consortium site within 24 hours." : "were successfully reported to the REDCap Consortium.");
			print  "<script type='text/javascript'>$(function(){alert(\"".cleanHtml2($sentstats_alert)."\");});</script>";
		} else {
			// Update date in table that stats were sent
			db_query("update redcap_config set value = '" . date("Y-m-d") . "' where field_name = 'auto_report_stats_last_sent'");
			// Now that we've saved today's date, redirect back to same page to give confirmation
			redirect($_SERVER['REQUEST_URI']."&saved=1");
		}
	}
}

// Instatiate stats object for reporting stats manually
$Stats = new Stats();
$stats_url = '';
if (!$auto_report_stats) {
	$stats_url = $Stats->getUrlReportingStats(false);
}
?>









<!-- NOTIFICATIONS AREA -->
<h4 style="margin-top: 0;"><?php echo RCView::img(array('src'=>'information_frame.png')) . $lang['control_center_116'] ?></h4>
<p>
	<?php echo $lang['control_center_118'] ?>
</p>
<?php

/**
 * CHECK REDCAP VERSION
 * If new version folder in already on web server, give link to upgrade
 */
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	?>
	<div id="version_check" class="green" style="display:none;margin:0 0 20px;padding:10px;"></div>
	<script type="text/javascript">$(function(){ version_check(); });</script>
	<?php
}


/**
 * VALIDATE MYSQL TABLE STRUCTURES AND FIX
 */
$tableCheck = new SQLTableCheck();
// Use the SQL from install.sql compared with current table structure to create SQL to fix the tables
$sql_fixes = $tableCheck->build_table_fixes();
// DEVELOPMENT ONLY: If install.sql is not up to date, then give option to replace it with current table structure
if (isDev() && $tableCheck->build_install_file_from_tables() != str_replace("\r\n", "\n", file_get_contents(APP_PATH_DOCROOT . "Resources/sql/install.sql"))) {
	print 	RCView::div(array('class'=>'yellow', 'style'=>'margin-bottom:15px;'),
				RCView::img(array('src'=>'exclamation_orange.png')) .
				"<b>INSTALL.SQL IS OUT OF DATE!</b><br>
				The current table structure does not match the structure from install.sql.
				Click the button below to replace install.sql with the current table structure." .
				RCView::div(array('style'=>'margin:10px 0 3px;'),
					RCView::button(array('class'=>'jqbuttonmed', 'style'=>'', 'onclick'=>"if (confirm('REPLACE INSTALL.SQL?')) {
						$.get('install_table_fix.php',{ },function(data){
							if (data != '1') {
								alert(woops);
							} else {
								alert('Install.php was successfully updated!');
								window.location.reload();
							}
						});
					}"),
						"Replace install.sql"
					)
				)
			);
}
if ($sql_fixes != '') {
	// NORMAL INSTALL: TABLES ARE MISSING OR PIECES OF TABLES ARE MISSING
	// If there are fixes to be made, then display text box with SQL fixes
	print 	RCView::div(array('class'=>'red', 'style'=>'margin-bottom:15px;'),
				RCView::img(array('src'=>'exclamation.png')) .
				"<b>{$lang['control_center_4431']}</b><br>{$lang['control_center_4432']} `<b>$db</b>`
				{$lang['control_center_4433']}" .
				RCView::div(array('id'=>'sql_fix_div', 'style'=>'margin:10px 0 3px;'),
					RCView::textarea(array('class'=>'x-form-field notesbox', 'style'=>'height:60px;font-size:11px;width:97%;height:100px;', 'readonly'=>'readonly', 'onclick'=>'this.select();'),
						"-- SQL TO REPAIR REDCAP TABLES\nUSE `$db`;\nSET FOREIGN_KEY_CHECKS = 0;\n$sql_fixes\nSET FOREIGN_KEY_CHECKS = 1;"
					)
				)
			);
}

/**
 * CHECK IF USING "NONE" AUTHENTICATION & IF NOT, MAKE SURE SITE_ADMIN IS NOT A SUPER USER
 * Give user instructions on how to change their auth method
 */
if ($auth_meth_global == "none")
{
	?>
	<div class="red" style="padding-bottom:15px;">
		<img src="<?php echo APP_PATH_IMAGES ?>exclamation.png">
		<b><?php echo $lang['control_center_174'] ?></b><br>
		<?php echo $lang['control_center_175'] ?><br><br>
		<a style="" href="https://community.projectredcap.org/articles/691/authentication-how-to-change-and-set-up-authentica.html" target="_blank"><?php echo $lang['control_center_176'] ?></a>
	</div>
	<?php
}
// Make sure site_admin is not a super user
else
{
	$sql = "select 1 from redcap_user_information where username = 'site_admin' and super_user = 1";
	$q = db_query($sql);
	if (db_num_rows($q))
	{
		?>
		<div class="red" style="padding-bottom:15px;">
			<img src="<?php echo APP_PATH_IMAGES ?>exclamation.png">
			<b>"site_admin" <?php echo $lang['control_center_178'] ?></b><br>
			<?php echo $lang['control_center_179'] ?> "site_admin" <?php echo $lang['control_center_180'] ?>
		</div>
		<?php
	}
}


/**
 * CHECK IF USING SSL WHEN THE REDCAP BASE URL DOES NOT BEGIN WITH "HTTPS"
 */
if (substr($redcap_base_url, 0, 5) == "http:") {
	?>
	<div id="ssl_base_url_check" class="red" style="display:none;padding-bottom:15px;">
		<img src="<?php echo APP_PATH_IMAGES ?>exclamation.png">
		<b><?php echo $lang['control_center_4436'] ?></b><br>
		<?php echo $lang['control_center_4437'] ?>
	</div>
	<script type="text/javascript">
	if (window.location.protocol == "https:") {
		document.getElementById('ssl_base_url_check').style.display = 'block';
	}
	</script>
	<?php
}

/**
 * CHECK IF CRON JOBS ARE RUNNING
 */
if (!Cron::checkIfCronsActive()) {
	// Display error message
	print Cron::cronsNotRunningErrorMsg();
}

/**
 * CHECK IF REDCAP_BASE_URL IS SET PROPERLY
 */
if ($redcap_base_url == '' || ($redcap_base_url_display_error_on_mismatch && $redcap_base_url != APP_PATH_WEBROOT_FULL))
{
	print 	RCView::div(array('class'=>'red','style'=>'margin-top:5px;'),
				RCView::img(array('src'=>'exclamation.png')) .
				RCView::b($lang['global_48'].$lang['colon']) . RCView::br() .
				$lang['control_center_361'] . "\"" . RCView::b($redcap_base_url) . "\"" . $lang['control_center_362'] . RCView::SP .
				"\"" . RCView::b(APP_PATH_WEBROOT_FULL). "\"" . $lang['period'] . " " .
				$lang['control_center_371'] . RCView::br() . RCView::br() .
				"'".$lang['pub_105']."' ".$lang['control_center_363'] . RCView::br() . RCView::br() .
				// Option 1
				($redcap_base_url == '' ? RCView::b($lang['control_center_369']) : RCView::b($lang['control_center_367'])) . RCView::br() .
				$lang['setup_45'] . " " . RCView::a(array('href'=>APP_PATH_WEBROOT."ControlCenter/general_settings.php"), $lang['control_center_125']) . " " .
				$lang['control_center_364'] . " " .RCView::b(APP_PATH_WEBROOT_FULL).
				// Option 2
				($redcap_base_url == '' ? '' :
					RCView::br() . RCView::br() . RCView::b($lang['control_center_368']) . RCView::br() .
					$lang['control_center_365'] . " " . RCView::b($redcap_base_url) . $lang['period'] . " " .
					$lang['control_center_370'] . RCView::br() .
					RCView::button(array('onclick'=>"if (confirm('".cleanHtml($lang['control_center_372'])."')) { setConfigVal('redcap_base_url_display_error_on_mismatch','0',true); }"), $lang['control_center_366'])
				)
			);
}


// Set up display text
$auto_report_stats_last_sent_text = (empty($auto_report_stats_last_sent) || $auto_report_stats_last_sent == "2000-01-01") ? $lang['dashboard_54'] : DateTimeRC::format_ts_from_ymd($auto_report_stats_last_sent);
$stats_method = ($auto_report_stats ? $lang['dashboard_55'] : $lang['dashboard_56']);
// Set up style for STATS reminder, if user has not reported stats in over a week
list($yyyy, $mm, $dd) = explode("-", $auto_report_stats_last_sent);
$days_diff = floor((mktime(0,0,0,date("m"),date("d"),date("Y")) - mktime(0,0,0,$mm,$dd,$yyyy) + 1) / 86400);
if ($days_diff >= 30) {
	$stats_last_style = "color:red;font-weight:bold;";
	$stats_last_img = "delete.png";
} elseif ($days_diff >= 7) {
	$stats_last_style = "color:#BC8900;font-weight:bold;";
	$stats_last_img = "exclamation_frame.png";
} else {
	$stats_last_style = "color:green;";
	$stats_last_img = "tick.png";
}
?>


















<!-- Reporting Your Stats section -->
<h4 style="margin-top:40px;"><?php echo $lang['control_center_119'] ?></h4>
<p>
	<?php echo $lang['control_center_385'] ?>
</p>

<div style="margin:10px 0;border:1px solid #ccc;background-color:#fafafa;padding:6px 15px;">
	<!-- Text saying if stats are up to date -->
	<div id="stats_last_submitted" style="<?php echo $stats_last_style ?>">
		<img src="<?php echo APP_PATH_IMAGES . $stats_last_img ?>" style="position:relative;top:3px;">
		<?php echo $lang['dashboard_52'] ?> <?php echo $auto_report_stats_last_sent_text ?>
	</div>
	<!-- Text saying if sending stats auto or manual -->
	<div style="padding:8px 0;">
		<?php echo $lang['dashboard_57'] ?>
		<a href="<?php echo APP_PATH_WEBROOT ?>ControlCenter/general_settings.php#auto_report_stats-tr" style="font-weight:bold;"><?php echo $stats_method ?></a>
		&nbsp;&nbsp;
		<a href="javascript:;" style="padding-left:5px;text-decoration:underline;" onclick="simpleDialog('<?php echo cleanHtml($lang['dashboard_94']." ".$lang['dashboard_101']) ?>','<?php echo cleanHtml($lang['dashboard_77']) ?>');"><?php echo $lang['dashboard_77'] ?></a>
	</div>
	<!-- Manual stats report button -->
	<div id="report_btn" style="padding:10px 0;">
		<input type="button" value="<?php echo $lang['dashboard_53'] ?>" onclick="reportStatsAjax('<?php print cleanHtml($stats_url) ?>',true);">
	</div>
	<!-- Link for alternative manual stats reporting -->
	<div style="padding:5px 0;">
		<div id="report_auto_msg" style="display:none;color:#aaa;">
			<?php echo $lang['dashboard_58'] ?><br>
			<?php echo $lang['dashboard_59'] ?>
		</div>
		<a id="report_btn_alt_link" href="javascript:;" style="color:#999;text-align:right;text-decoration:underline;" onclick="
			$('#report_btn').hide();
			$('#report_btn_alt_link').hide();
			$('#report_btn_alt').show();
			$('#report_btn_alt').effect('highlight',{},2500);
		"><?php echo $lang['control_center_121'] ?></a>
		<div id="report_btn_alt" style="display:none;border:1px dashed #ccc;background-color:#fafafa;padding:7px 7px 10px;margin:10px 0;">
			<?php echo $lang['control_center_122'] ?><br><br>
			<form action="<?php echo APP_PATH_WEBROOT ?>ControlCenter/report_site_stats.php" method="post" name="report_form">
			<input name="report_alternate" type="hidden" value="1">
			<input name="sentstats" type="hidden" value="1">
			<input type="button" value="<?php echo cleanHtml2($lang['dashboard_102']) ?>" onclick="
				if ('<?php echo $auto_report_stats_last_sent ?>' == '<?php echo date("Y-m-d") ?>') {
					alert('<?php echo cleanHtml($lang['dashboard_103']) ?>');
				} else {
					document.report_form.submit();
				}
			">
			</form>
		</div>
	</div>
</div>

<?php
// Disable manual reporting button if already reporting automatically
if ($auto_report_stats)
{
	?>
	<script type="text/javascript">
	$(function(){
		$('#report_btn').fadeTo(0,0.5);
		$('#report_btn :input').prop("disabled",true);
		$('#report_btn_alt_link').hide();
		$('#report_auto_msg').show();
	});
	</script>
	<?php
}

include 'footer.php';