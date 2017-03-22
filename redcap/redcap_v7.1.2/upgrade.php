<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

/********************************************************************************************
This file is used for upgrading to newer versions of REDCap.
It may be used for cumulative upgrading so that incremental updates can be done all at once.
The page will guide you through the upgrade process.
********************************************************************************************/


// File with necessary functions
require_once dirname(__FILE__) . '/Config/init_functions.php';
// Change initial server value to account for a lot of processing and memory
System::increaseMaxExecTime(3600);
// Get the install version number and set the web path
if (isset($upgrade_to_version)) {
	define("APP_PATH_WEBROOT", "redcap_v" . $upgrade_to_version . "/");
} else {
	if (basename(dirname(__FILE__)) == "codebase") {
		// If this is a developer with 'codebase' folder instead of version folder, then use JavaScript to get version from query string instead
		if (isset($_GET['version'])) {
			$upgrade_to_version = $_GET['version'];
		} else {
			// Redirect via JavaScript
			?>
			<script type="text/javascript">
			var urlChunks = window.location.href.split('/').reverse();
			window.location.href = window.location.href+'?version='+urlChunks[1].substring(8);
			</script>
			<?php
			exit;
		}
	} else {
		// Get version from above directory
		$upgrade_to_version = substr(basename(dirname(__FILE__)), 8);
	}
	define("APP_PATH_WEBROOT", "");
}
// Set version to standard variable
$redcap_version = $upgrade_to_version;
define("REDCAP_VERSION",		$redcap_version);
// Declare current page with full path
define("PAGE_FULL", 			$_SERVER['PHP_SELF']);
// Declare current page
define("PAGE", 					basename(PAGE_FULL));
// Docroot will be used by php includes
define("APP_PATH_DOCROOT", 		dirname(__FILE__) . "/");
// Webtools folder path
define("APP_PATH_WEBTOOLS",		dirname(APP_PATH_DOCROOT) . "/webtools2/");
// Classes
define("APP_PATH_CLASSES",  	APP_PATH_DOCROOT . "Classes/");
// Controllers
define("APP_PATH_CONTROLLERS", 	APP_PATH_DOCROOT . "Controllers/");
// Image repository
define("APP_PATH_IMAGES",		APP_PATH_WEBROOT . "Resources/images/");
// CSS
define("APP_PATH_CSS",			APP_PATH_WEBROOT . "Resources/css/");
// External Javascript
define("APP_PATH_JS",			APP_PATH_WEBROOT . "Resources/js/");
// Make initial connection to MySQL project
db_connect();

// Get current version number from redcap_config
$current_version = db_result(db_query("select value from redcap_config where field_name = 'redcap_version' limit 1"), 0);

// DOWNLOAD FILE: If downloading the upgrade script file, then output the file contents here
if (isset($_GET['download_file'])) {
	ob_start();
	header("Content-type: application/octet-stream");
	header('Content-Disposition: attachment; filename=redcap_upgrade_'.getDecVersion($redcap_version).'.sql');
	print "-- --- SQL to upgrade REDCap to version $redcap_version from $current_version --- --\n";
	print "USE `$db`;\n";
	getUpgradeSql();
	print "\n\n-- Set date of upgrade --\n";
	print "UPDATE redcap_config SET value = '" . date("Y-m-d") . "' WHERE field_name = 'redcap_last_install_date' LIMIT 1;\n";
	print "-- Set new version number --\n";
	print "UPDATE redcap_config SET value = '$redcap_version' WHERE field_name = 'redcap_version' LIMIT 1;\n";
	// Replace all line breaks with \r\n for compatibility
	$delim = "||--RCDELIM--||";
	$html = str_replace(array("\r\n", "\r", "\n", $delim), array($delim, $delim, $delim, "\r\n"), ob_get_clean());
	exit($html);
}

// Get timestamp
$timestamp = date("_Y_m_d_H_i_s");

// Add global $html variable that can be utilized by PHP upgrade files for outputting text, javascript, etc. to page
$html = "";

// Initialize page display object
$objHtmlPage = new HtmlPage();
$objHtmlPage->addExternalJS(APP_PATH_JS . "base.js");
$objHtmlPage->addStylesheet("jquery-ui.min.css", 'screen,print');
$objHtmlPage->addStylesheet("style.css", 'screen,print');
$objHtmlPage->addStylesheet("home.css", 'screen,print');
$objHtmlPage->PrintHeader();

// Page header with logo
print  "<table width=100% cellpadding=0 cellspacing=0>
			<tr>
				<td valign='top' style='padding:20px 0;font-size:20px;font-weight:bold;color:#800000;'>
					REDCap $redcap_version Upgrade Module
				</td>
				<td valign='top' style='text-align:right;padding-top:5px;'>
					<img src='" . APP_PATH_IMAGES . "redcap-logo.png'>
				</td>
			</tr>
		</table>";

// System must be on version 3.0.0 in order to upgrade to this one
if (str_replace(".", "", getLeadZeroVersion($current_version)) < 30000) {
	exit("<p><br><b>Unable to upgrade!</b><br>
		  You are currently on version $current_version.
		  You must be on REDCap version 3.0.0 or higher in order to upgrade to $redcap_version.<br>
		  Upgrade to 3.0.0 first, then you may upgrade to $redcap_version.<br><br></p>");
}

// If the system has already been upgraded to this version, then stop here and give link back to REDCap.
if ($current_version == $redcap_version) {
	exit("<p><br><b>Already upgraded!</b><br>
		  It appears that you have already upgraded to version $current_version. There is nothing to do here.
		  <a href='" . APP_PATH_WEBROOT . "index.php' style='text-decoration:underline;font-weight:bold;'>Return to REDCap</a>
		  <br><br></p>");
}

// Determine if this is a fast upgrade, which does not require REDCap going Offline
$isFastUpgrade = isFastUpgrade();

// Do repeated ajax calls every 5 seconds until upgrade is finished via MySQL so that we can remind
// them to then go to the Configuration Check page.
?>
<script type="text/javascript">
function checkVersionAjax(version) {
	$.get(app_path_webroot+'ControlCenter/check_upgrade.php',{ version: version},function(data){
		if (data=='1') {
			$('#goToConfigTest').dialog({ bgiframe: true, modal: true, width: 500, zIndex: 4999, close: function(){ goToConfigTest() }, buttons: {
				'Go to Configuration Check page': function() {
					goToConfigTest();
				}
			} });
		} else {
			setTimeout("checkVersionAjax('"+version+"')",5000);
		}
	});
}
function goToConfigTest() {
	window.location.href = app_path_webroot+'ControlCenter/check.php?upgradeinstall=1';
}
$(function(){
	setTimeout("checkVersionAjax('<?php echo $upgrade_to_version ?>')",5000);
});
</script>
<style type="text/css">
#pagecontent { margin-top: 0; }
</style>

<!-- Hidden div to tell user to go to Config Test after the upgrade -->
<p id="goToConfigTest" style="display:none;" title="<img src='<?php echo APP_PATH_IMAGES ?>tick.png'> <span style='color:green;'>Upgrade Complete!</span>">
	It appears that your upgrade to REDCap <?php echo $upgrade_to_version ?> was successful! As the final step
	of the upgrade process, please navigate to the Configuration Check page to make sure there is nothing
	else that needs to be done.
</p>
<?php

// Check for OpenSSL before allowing upgrade
openssl_loaded(true);

// Get time of auto logout from redcap_config
$autologout_timer = db_result(db_query("select value from redcap_config where field_name = 'autologout_timer' limit 1"), 0);
if ($autologout_timer == "" || $autologout_timer == "0") $autologout_timer = "30";

// Instructions
if ($isFastUpgrade) {
	print  "<p style='margin:25px 0 0;padding-top:12px;border-top:1px solid #aaa;'>
				<b>1.) PREPARATION:</b><br>
				REDCap has determined that this will be a quick upgrade, so taking the system offline
				is not necessary. REDCap has special safeguards to ensure that no data is lost during this upgrade process
				for users that are already logged in or for respondents currently taking a survey. Please continue to Step 2.
			</p>";
	print  "<p class='darkgreen'>
				<img src='".APP_PATH_IMAGES."tick.png'>
				It has been determined that <b>REDCap does *NOT* need to be taken offline</b> when performing this upgrade.
			</p>";
} else {
	print  "<p style='margin:25px 0 0;padding-top:12px;border-top:1px solid #aaa;'>
				<b>1.) PREPARATION:</b><br>
				Approximately $autologout_timer minutes before upgrading, go into the Control Center's
				<a href='".APP_PATH_WEBROOT."ControlCenter/general_settings.php' target='_blank' style='text-decoration:underline;'>General Configuration page</a>
				and set the System Status as \"System Offline\", which will take all REDCap projects offline and allow users
				to save any data before exiting. (When you are done upgrading, REDCap will remind you to bring the system back online.)
			</p>";
	if ($system_offline) {
		print  "<p class='darkgreen'>
					<img src='".APP_PATH_IMAGES."tick.png'>
					Your REDCap system is currently offline. It is recommended that the system be offline for $autologout_timer minutes
					before continuing to Step 2.
				</p>";
	} else {
		print  "<p class='yellow'>
					<img src='".APP_PATH_IMAGES."exclamation_orange.png'>
					It is recommended that you first take your REDCap system offline.
				</p>";
	}
}

// LANGUAGE CHECK: Check if using any non-English languages. Make sure language files exist and remind them to update their language files.
$usesOtherLanguages = false; // Default
// Account for the project_language field changing from INT to VARCHAR in v3.2.0 (0 = English)
$langValNumeric = (getDecVersion($current_version) < 30200);
$englishValue   = ($langValNumeric) ? '0' : 'English';
// Check if using non-English in any projects or as project default
$languagesUsed = array();
$qconfig = db_query("select value from redcap_config where field_name = 'project_language' and value != '$englishValue'");
$configNonEnglish = db_num_rows($qconfig);
$qprojects = db_query("select distinct project_language from redcap_projects where project_language != '$englishValue'");
$projectsNonEnglish = db_num_rows($qprojects);
if (($configNonEnglish + $projectsNonEnglish) > 0)
{
	// Create list of languages used
	while ($row = db_fetch_assoc($qconfig)) 	 $languagesUsed[] = $row['value'];
	while ($row = db_fetch_assoc($qprojects)) $languagesUsed[] = $row['project_language'];
	$languagesUsed = array_unique($languagesUsed);
	// If currently on version before 3.2.0, transform numeric values into varchar equivalents
	if ($langValNumeric)
	{
		foreach ($languagesUsed as $key=>$val)
		{
			$languagesUsed[$key] = ($val == '1') ? 'Spanish' : 'Japanese';
		}
	}
	// Make sure language files exist for languages used
	$languageFiles = Language::getLanguageList();
	unset($languageFiles['English']);
	// Only show section if other languages are actually being utilized
	if (!empty($languagesUsed))
	{
		// Language file directory
		$langDir = dirname(APP_PATH_DOCROOT) . DS . "languages" . DS;
		print  "<b>Language check:</b><br>
				It appears that you are using one or more non-English languages in your installation of REDCap.
				The translation of REDCap's English text into other languages is now supported solely through the REDCap Consortium
				community. For more information on this, please see the
				<a href='https://community.projectredcap.org/articles/676/redcap-language-center.html' target='_blank' style='text-decoration:underline;'>REDCap wiki Language Center</a>.
				<br><br>
				REDCap stores the language files in
				the following location on your server: <b>$langDir</b>. A diagnostic of your language files is given below, showing if the file
				can be located, and if it needs to be updated because of any new language variables added in REDCap version $redcap_version.
				<b>If any files are out of date, you can update them using the
				<a href='".APP_PATH_WEBROOT."LanguageUpdater/' target='_blank' style='text-decoration:underline;'>Language File Creator/Updater</a>
				page</b>, OR you may check the wiki Language Center for any updated versions of these languages.
				<b>NOTE:</b> It will not harm REDCap if a language file is out of date; it will merely show English text in place of
				the missing translated text. If you wish, you may translate any new language variables in your language files
				before performing this upgrade by following the instructions on the Language File Creator/Updater page and then returning
				to this page afterward.<br>";
		// Check if directory exists
		if (!is_dir($langDir))
		{
			print  "<img src='".APP_PATH_IMAGES."cross.png'>
					<span style='color:#red;'><b>ERROR!</b> Could not find the \"languages\" folder at the expected path: $langDir</span><br>";
		}
		// Get array of English language
		$English = Language::callLanguageFile('English');
		// Loop through all and check if each INI file exists
		foreach (array_unique(array_merge(array_keys($languageFiles), $languagesUsed)) as $this_lang)
		{
			if (isset($languageFiles[$this_lang]))
			{
				// Found the file, so now check to see if it's up to date
				$untranslated_strings = count(array_diff_key($English, Language::callLanguageFile($this_lang)));
				if ($untranslated_strings < 1) {
					print  "<img src='".APP_PATH_IMAGES."tick.png'>
							<span style='color:green;'><b>$this_lang.ini</b> is up to date.</span><br>";
				} else {
					print  "<img src='".APP_PATH_IMAGES."exclamation.png'>
							<span style='color:#800000;'><b>$this_lang.ini</b> is out of date.
							Recommendation: $untranslated_strings new language variables
							need to be added to this file and then translated.</span><br>";
				}
			}
			else
			{
				// Could not find the language file
				print  "<img src='".APP_PATH_IMAGES."cross.png'>
						<span style='color:#red;'><b>ERROR!</b>
						Could not find the following language file: <b>" . $langDir . $this_lang. ".ini</b>.
						Without this file, any projects set with \"$this_lang\" as the language will instead render in English.</span><br>";
			}
		}
	}
}


print  "<p style='margin:20px 0 20px;padding-top:12px;border-top:1px solid #aaa;'>
			<b>2.) PERFORMING THE UPGRADE:</b><br>
			Now you must <b style='color:#800000;'>follow either Option A or Option B below</b> in which you will execute the SQL upgrade script on your
			MySQL database server \"<b>$hostname</b>\". Once you have executed the upgrade script, move on to Step 3 below.
			Please note that depending on your server's processing speed and also what REDCap version you are upgrading to and from, the upgrade script could take
			several seconds, several minutes, or several hours to fully execute. Most small upgrades often take just a few seconds.
			NOTE: If you anticipate that the upgrade script will take a long time to run, such as if you are skipping over many versions at once,
			then it is best to use Option B because it can avoid
			timeouts that sometimes occur when executing lots of queries in certain MySQL clients, especially web-based clients (e.g., phpMyAdmin).
		</p>";


// Text box for holding the SQL
print  "<div id='sqlloading' style='margin-bottom:140px;width:98%;height:215px;font-size:14px;font-weight:bold;text-align:center;border:1px solid #ccc;background-color:#eee;padding-top:20px;'>
			<div style='padding-bottom:8px;'>Generating the SQL upgrade script...</div>
			<img src='".APP_PATH_IMAGES."progress_bar.gif'>
		</div>";
print "<div id='sqlscript' style='display:none;width:98%;'>";
print "<table cellspacing='0' style='width:100%;'><tr>";
print "<td valign='top' style='width:50%;'>";
// Textarea with SQL script
print "<div style='margin-left:7px;margin-bottom:5px;color:#800000;'><b style='font-size:13px;'>OPTION A:</b> Copy the text from the box below and execute it in MySQL</div>";
print "<textarea style='margin:0 0 0 8px;padding: 3px 5px; background: none repeat scroll 0 0 #F6F6F6;border-color: #A4A4A4 #B9B9B9 #B9B9B9; border-radius: 3px;border-right: 1px solid #B9B9B9; border-style: solid; border-width: 1px;box-shadow: 0 1px 0 #FFFFFF, 0 1px 1px rgba(0, 0, 0, 0.17) inset;color:#444;font-size:11px;width:90%;height:210px;' readonly='readonly' onclick='this.select();'>";
print "-- --- SQL to upgrade REDCap to version $redcap_version from $current_version --- --\n";
print "USE `$db`;\n";
getUpgradeSql();
print "\n\n-- Set date of upgrade --\n";
print "UPDATE redcap_config SET value = '" . date("Y-m-d") . "' WHERE field_name = 'redcap_last_install_date' LIMIT 1;\n";
print "REPLACE INTO redcap_history_version (`date`, redcap_version) values ('" . date("Y-m-d") . "', '$redcap_version');\n";
print "-- Set new version number --\n";
print "UPDATE redcap_config SET value = '$redcap_version' WHERE field_name = 'redcap_version' LIMIT 1;\n";
print "</textarea>";
print "</td><td valign='top' style='width:50%;'>";
// Option to download SQL script as file
print "<div style='margin-left:7px;margin-bottom:5px;color:#800000;'><b style='font-size:13px;'>OPTION B:</b> Download the SQL upgrade script as a file</div>";
print "<div style='margin:8px 0 8px 20px;'><button class='jqbuttonmed' onclick=\"window.location.href = '".cleanHtml($_SERVER['REQUEST_URI']).(strpos($_SERVER['REQUEST_URI'], "?") === false ? "?" : "&")."download_file=1';\"><img src='".APP_PATH_IMAGES."go-down.png' style='vertical-align:middle;'> <span style='vertical-align:middle;'>Download upgrade script</span></button></div>";
print "<div class='hang' style='margin-bottom:7px;'>
		&nbsp; 1) Download the SQL upgrade script file by clicking the button above, and place the file somewhere on your MySQL database server
		(via FTP or however you access the database server's file system). Make sure the filename remains as \"redcap_upgrade_".getDecVersion($redcap_version).".sql\".
		</div>";
print "<div class='hang' style='margin-bottom:7px;'>&nbsp; 2) Open a terminal window (command line interface) to your MySQL database server,
		and on that server navigate to the directory where you placed the upgrade script file (using \"cd\" or other similar command).</div>";
print "<div class='hang'>&nbsp; 3) Via command line, execute the line below (replacing USERNAME with the username of the MySQL user you are connecting with).</div>";
print "<div style='margin:6px 0 0 12px;'>";
print "<textarea style='margin:0 0 0 8px;padding: 3px 5px; background: none repeat scroll 0 0 #F6F6F6;border-color: #A4A4A4 #B9B9B9 #B9B9B9; border-radius: 3px;border-right: 1px solid #B9B9B9; border-style: solid; border-width: 1px;box-shadow: 0 1px 0 #FFFFFF, 0 1px 1px rgba(0, 0, 0, 0.17) inset;color:#444;font-size:12px;width:96%;height:46px;' readonly='readonly' onclick='this.select();'>";
print "mysql -u USERNAME -p -h $hostname $db < redcap_upgrade_".getDecVersion($redcap_version).".sql";
print "</textarea></div>";
print "</tr></table>";
// Link to test page
print  "<div class='p' style='margin:25px 0 15px;padding-top:12px;border-top:1px solid #aaa;'>
			<b>3.) AFTER THE UPGRADE - TEST YOUR CONFIGURATION:</b><br>
			Once you have successfully executed the SQL upgrade script above, you must now navigate to the Configuration Test page
			to ensure that all necessary REDCap components are correctly in place.
			<div style='margin:15px 0 10px 5px;'>
				Go to &nbsp;
				<button class='jqbuttonmed' onclick=\"window.location.href = '".APP_PATH_WEBROOT . "ControlCenter/check.php?upgradeinstall=1';\"><img src='".APP_PATH_IMAGES."view-task.png' style='vertical-align:middle;'> <span style='vertical-align:middle;'>Configuration Test page</span></button>
			</div>
		</div>";
// Any custom HTML added from PHP upgrade files
print $html;
// close div
print "</div>";
?>
<script type="text/javascript">
setTimeout(function(){
	document.getElementById('sqlscript').style.display  = 'block';
	document.getElementById('sqlloading').style.display = 'none';
},1000);
</script>
<?php
// Page footer
$objHtmlPage->PrintFooter();




/**
 * FUNCTIONS
 */
// Add leading zeroes inside version number (keep dots)
function getLeadZeroVersion($dotVersion) {
	list ($one, $two, $three) = explode(".", $dotVersion);
	return $one . "." . sprintf("%02d", $two) . "." . sprintf("%02d", $three);
}
// Remove leading zeroes inside version number (keep dots)
function removeLeadZeroVersion($leadZeroVersion) {
	list ($one, $two, $three) = explode(".", $leadZeroVersion);
	return $one . "." . ($two + 0) . "." . ($three + 0);
}
// Add leading zeroes inside version number (remove dots)
function getDecVersion($dotVersion) {
	list ($one, $two, $three) = explode(".", $dotVersion);
	return $one . sprintf("%02d", $two) . sprintf("%02d", $three);
}
// For each version, run any PHP scripts in /Resources/files first, then run raw SQL files in that folder
function getUpgradeSql() {
	global $current_version, $redcap_version, $db, $timestamp;
	$current_version_dec = getDecVersion($current_version);
	$redcap_version_dec  = getDecVersion($redcap_version);
	// Get listing of all files in directory
	$dh = opendir(APP_PATH_DOCROOT."Resources/sql/");
	$files = array();
	while (false !== ($filename = readdir($dh))) { $files[] = $filename; }
	closedir($dh);
	sort($files);
	// Parse through the files and select the ones we need
	$upgrade_sql = array();
	foreach ($files as $this_file) {
		if (substr($this_file, 0, 8) == "upgrade_" && (substr($this_file, -4) == ".sql" || substr($this_file, -4) == ".php")) {
			$this_file_version = getDecVersion(substr($this_file, 8, -4));
			if ($this_file_version > $current_version_dec && $this_file_version <= $redcap_version_dec) {
				$upgrade_sql[] = $this_file;
			}
		}
	}
	sort($upgrade_sql);
	// Include all the SQL and PHP files to do cumulative upgrade
	foreach ($upgrade_sql as $this_file) {
		print "\n-- SQL for Version " . removeLeadZeroVersion(substr($this_file, 8, -4)) . " --\n";
		include APP_PATH_DOCROOT . "Resources/sql/" . $this_file;
	}
}
// Check the upgrade_fast_versions.txt file to see if all versions that we're upgrading through are considered "fast".
// If so, then let admin know that the server does not need to be taken offline during the upgrade.
function isFastUpgrade() {
	global $current_version, $redcap_version, $db, $timestamp;
	$current_version_dec = getDecVersion($current_version);
	$redcap_version_dec  = getDecVersion($redcap_version);
	// Get the list of fast versions
	$fast_versions_file = file_get_contents(APP_PATH_DOCROOT."Resources/sql/upgrade_fast_versions.txt");
	$fast_versions = array();
	foreach (explode("\n", trim(str_replace("\r", "", $fast_versions_file))) as $key=>$this_version) {
		if (trim($this_version) == '') continue;
		$fast_versions[] = getDecVersion($this_version);
	}
	sort($fast_versions);
	// Get listing of all upgrade files in directory
	$dh = opendir(APP_PATH_DOCROOT."Resources/sql/");
	$files = array();
	while (false !== ($filename = readdir($dh))) { $files[] = $filename; }
	closedir($dh);
	sort($files);
	// Parse through the files and select the ones we need
	$upgrade_sql = array();
	foreach ($files as $this_file) {
		if (substr($this_file, 0, 8) == "upgrade_" && (substr($this_file, -4) == ".sql" || substr($this_file, -4) == ".php")) {
			$this_file_version = getDecVersion(substr($this_file, 8, -4));
			if ($this_file_version > $current_version_dec && $this_file_version <= $redcap_version_dec) {
				$upgrade_sql[] = $this_file_version;
			}
		}
	}
	sort($upgrade_sql);
	// Loop through all upgrade files. If ANY version if missing from $fast_versions, then return FALSE.
	foreach ($upgrade_sql as $this_version) {
		if (!in_array($this_version, $fast_versions)) return false;
	}
	// If ALL versions we're upgrading through (which have a corresponding upgrade PHP/SQL file)
	// are in upgrade_fast_versions.txt, then this IS a fast upgrade, so return TRUE.
	return true;
}
