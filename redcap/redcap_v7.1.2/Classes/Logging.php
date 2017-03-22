<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

/**
 * Logging Class
 * Contains methods used with regard to logging
 */
class Logging
{
	// Set up array of pages to ignore for logging page views and counting page hits
	public static $noCountPages = array("DataEntry/auto_complete.php", "DataEntry/search.php", "ControlCenter/report_site_stats.php", "Calendar/calendar_popup_ajax.php",
									   "Reports/report_builder_ajax.php", "ControlCenter/check.php", "DataEntry/image_view.php", "ProjectGeneral/project_stats_ajax.php",
									   "SharedLibrary/image_loader.php", "DataExport/plot_chart.php", "Surveys/theme_view.php"
	);
	
	// Logs an action. Returns log_event_id from db table.
	public static function logEvent($sql, $table, $event, $record, $display, $descrip="", $change_reason="",
									$userid_override="", $project_id_override="", $useNOW=true, $event_id_override=null, $instance=null)
	{
		global $user_firstactivity, $rc_connection;

		// Log the event in the redcap_log_event table
		$ts 	 	= ($useNOW ? str_replace(array("-",":"," "), array("","",""), NOW) : date('YmdHis'));
		$page 	 	= (defined("PAGE") ? PAGE : (defined("PLUGIN") ? "PLUGIN" : ""));
		$userid		= ($userid_override != "" ? $userid_override : (in_array(PAGE, Authentication::$noAuthPages) ? "[non-user]" : (defined("USERID") ? USERID : "")));
		$ip 	 	= (isset($userid) && $userid == "[survey respondent]") ? "" : System::clientIpAddress(); // Don't log IP for survey respondents
		$event	 	= strtoupper($event);
		$event_id	= (is_numeric($event_id_override) ? $event_id_override : (isset($_GET['event_id']) && is_numeric($_GET['event_id']) ? $_GET['event_id'] : "NULL"));
		$project_id = (is_numeric($project_id_override) ? $project_id_override : (defined("PROJECT_ID") && is_numeric(PROJECT_ID) ? PROJECT_ID : 0));
		$instance   = is_numeric($instance) ? (int)$instance : 1;
		
		// Set instance (only if $instance>1)
		if ($instance > 1) {
			$display = "[instance = $instance]".($display == '' ? '' : ",\n").$display;
		}

		// Query
		$sql = "INSERT INTO redcap_log_event
				(project_id, ts, user, ip, page, event, object_type, sql_log, pk, event_id, data_values, description, change_reason)
				VALUES ($project_id, $ts, '".prep($userid)."', ".checkNull($ip).", '$page', '$event', '$table', ".checkNull($sql).",
				".checkNull($record).", $event_id, ".checkNull($display).", ".checkNull($descrip).", ".checkNull($change_reason).")";
		$q = db_query($sql, $rc_connection);
		$log_event_id = ($q ? db_insert_id() : false);

		// FIRST/LAST ACTIVITY TIMESTAMP: Set timestamp of last activity (and first, if applicable)
		if (defined("USERID") && strpos(USERID, "[") === false)
		{
			// SET FIRST ACTIVITY TIMESTAMP
			// If this is the user's first activity to be logged in the log_event table, then log the time in the user_information table
			if ($user_firstactivity == "") {
				$sql = "update redcap_user_information set user_firstactivity = '".NOW."'
						where username = '".prep(USERID)."' and user_firstactivity is null and user_suspended_time is null";
				db_query($sql, $rc_connection);
			}
			// SET LAST ACTIVITY TIMESTAMP FOR USER
			// (but NOT if they are suspended - could be confusing if last activity occurs AFTER suspension)
			$sql = "update redcap_user_information set user_lastactivity = '".NOW."'
					where username = '".prep(USERID)."' and user_suspended_time is null";
			db_query($sql, $rc_connection);
		}
		
		// SET LAST ACTIVITY TIMESTAMP FOR PROJECT
		if (defined("PROJECT_ID"))
		{
			$sql = "update redcap_projects set last_logged_event = '".NOW."' where project_id = " . PROJECT_ID;
			db_query($sql, $rc_connection);
		}
		
		// RESET RECORD COUNT CACHE: If a record was created or deleted, then remove the count of records in the cache table
		if ($project_id > 0 && ($event == 'INSERT' || $event == 'DELETE'))
		{
			Records::resetRecordCountCache($project_id);
		}

		// Return log_event_id PK if true or false if failed
		return $log_event_id;
	}
	
	// Add the total execution time of this PHP script to the current script's row in log_open_requests when this script finishes
	public static function updateLogViewRequestTime()
	{
		if (!defined("LOG_VIEW_REQUEST_ID") || !defined("SCRIPT_START_TIME")) return;
		// Calculate total execution time (rounded to milliseconds)
		$total_time = round((microtime(true) - SCRIPT_START_TIME), 3);
		// Update table
		$sql = "update redcap_log_view_requests set script_execution_time = '$total_time' where lvr_id = " . LOG_VIEW_REQUEST_ID;
		db_query($sql);
	}

	// Log page and user info for page being viewed (but only for specified pages)
	public static function logPageView($event="PAGE_VIEW", $userid, $twoFactorLoginMethod=null, $twoFactorForceLoginSuccess=false) 
	{
		global $query_array, $custom_report_sql, $Proj, $isAjax, $two_factor_auth_enabled;

		// If using TWO FACTOR AUTH, then don't log "LOGIN_SUCCESS" until we do the second factor
		if ($two_factor_auth_enabled && $event == "LOGIN_SUCCESS" && $twoFactorLoginMethod == null && !$twoFactorForceLoginSuccess) {
			return;
		}

		// Set userid as blank if USERID is not defined
		if (!defined("USERID") && $userid == "USERID") $userid = "";

		// If current page view is to be logged (i.e. if not set as noCountPages and is not a survey passthru page)
		// If this is the REDCap cron job, then skip this
		if (!defined('CRON') && !in_array(PAGE, self::$noCountPages)
			&& !(PAGE == 'surveys/index.php' && (isset($_GET['__passthru']) || isset($_GET[Authentication::TWILIO_2FA_SUCCESS_FLAG]))))
		{
			// Obtain browser info
			$browser = new Browser();
			$browser_name = strtolower($browser->getBrowser());
			$browser_version = $browser->getVersion();
			// Do not include more than one decimal point in version
			if (substr_count($browser_version, ".") > 1) {
				$browser_version_array = explode(".", $browser_version);
				$browser_version = $browser_version_array[0] . "." . $browser_version_array[1];
			}

			// Obtain other needed values
			$ip 	 	= System::clientIpAddress();
			$page 	  	= (defined("PAGE") ? PAGE : "");
			$event	  	= strtoupper($event);
			$project_id = defined("PROJECT_ID") ? PROJECT_ID : "";
			$full_url	= curPageURL();
			$session_id = (!session_id() ? "" : substr(session_id(), 0, 32));

			// Defaults
			$event_id 	= "";
			$record		= "";
			$form_name 	= "";
			$miscellaneous = "";

			// Check if user's IP has been banned
			checkBannedIp($ip);
			// Save IP address as hashed value in cache table to prevent automated attacks
			storeHashedIp($ip);

			// Special logging for certain pages
			if ($event == "PAGE_VIEW") {
				switch (PAGE)
				{
					// Data Quality rule execution
					case "DataQuality/execute_ajax.php":
						$miscellaneous = "// rule_ids = '{$_POST['rule_ids']}'";
						break;
					// External Links clickthru page
					case "ExternalLinks/clickthru_logging_ajax.php":
						$miscellaneous = "// url = " . $_POST['url'];
						break;
					// Survey page
					case "surveys/index.php":
						// Set username and erase ip to maintain anonymity survey respondents
						$ip = "";
						if (isset($_GET['s']))
						{
							$userid = "[survey respondent]";
							// Set all survey attributes as global variables
							Survey::setSurveyVals($_GET['s']);
							$event_id = $GLOBALS['event_id'];
							$form_name = $GLOBALS['form_name'];
							// Capture the response_id if we have it
							if (isset($_POST['__response_hash__']) && !empty($_POST['__response_hash__'])) {
								$response_id = decryptResponseHash($_POST['__response_hash__'], $GLOBALS['participant_id']);
								// Get record name
								$sql = "select r.record from redcap_surveys_participants p, redcap_surveys_response r
										where r.participant_id = p.participant_id and r.response_id = $response_id";
								$q = db_query($sql);
								$record = db_result($q, 0);
								$miscellaneous = "// response_id = $response_id";
							} elseif (isset($GLOBALS['participant_email']) && $GLOBALS['participant_email'] !== null) {
								// Get record name for existing record (non-public survey)
								$sql = "select r.record, r.response_id from redcap_surveys_participants p, redcap_surveys_response r
										where r.participant_id = p.participant_id and p.hash = '".prep($_GET['s'])."'
										and p.participant_id = {$GLOBALS['participant_id']}";
								$q = db_query($sql);
								$record = db_result($q, 0, 'record');
								$response_id = db_result($q, 0, 'response_id');
								$miscellaneous = "// response_id = $response_id";
							}
							// If a Post request and is NOT a normal survey page submission, then log the Post parameters passed
							if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['submit-action'])) {
								if ($miscellaneous != "") $miscellaneous .= "\n";
								$miscellaneous .= "// POST = " . print_r($_POST, true);
							}
						}
						break;
					// API
					case "API/index.php":
					case "api/index.php":
						// If downloading file, log it
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							// Set values needed for logging
							if (isset($_POST['token']) && !empty($_POST['token']))
							{
								$q = db_query("select project_id, username from redcap_user_rights where api_token = '" . prep($_POST['token']) . "'");
								$userid = db_result($q, 0, "username");
								$project_id = db_result($q, 0, "project_id");
							}
							$post = $_POST;
							// Remove data from $_POST for logging (if this is an API import)
							if (isset($post['data'])) $post['data'] = '[not displayed]';
							$miscellaneous = "// API Request: ";
							foreach ($post as $key=>$value) {
								$miscellaneous .= "$key = '" . ((is_array($value)) ? implode("', '", $value) : $value) . "'; ";
							}
							$miscellaneous = substr($miscellaneous, 0, -2);
						}
						break;
					// Data history
					case "DataEntry/data_history_popup.php":
						if (isset($_POST['event_id']))
						{
							$form_name = $Proj->metadata[$_POST['field_name']]['form_name'];
							$event_id = $_POST['event_id'];
							$record = $_POST['record'];
							$miscellaneous = "field_name = '" . $_POST['field_name'] . "'";
						}
						break;
					// Send it download
					case "SendItController:download":
						// If downloading file, log it
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$miscellaneous = "// Download file (Send-It)";
						}
						break;
					// Send it upload
					case "SendItController:upload":
						// Get project_id
						$fileLocation = (isset($_GET['loc']) ? $_GET['loc'] : 1);
						if ($fileLocation != 1) {
							if ($fileLocation == 2) //file repository
								$query = "SELECT project_id FROM redcap_docs WHERE docs_id = '" . prep($_GET['id']) . "'";
							else if ($fileLocation == 3) //data entry form
								$query = "SELECT project_id FROM redcap_edocs_metadata WHERE doc_id = '" . prep($_GET['id']) . "'";
							$project_id = db_result(db_query($query), 0);
						}
						// If uploading file, log it
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$miscellaneous = "// Upload file (Send-It)";
						}
						break;
					// Data entry page
					case "DataEntry/index.php":
						if (isset($_GET['page'])) {
							$form_name = $_GET['page'];
							$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : getSingleEvent(PROJECT_ID);
							if (isset($_GET['id'])) $record = $_GET['id'];
						}
						break;
					// Page used for reseting user's session
					case "ProjectGeneral/keep_alive.php":
						if (isset($_GET['page'])) {
							$form_name = $_GET['page'];
							$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : getSingleEvent(PROJECT_ID);
							if (isset($_GET['id'])) $record = $_GET['id'];
						}
						break;
					// PDF form export
					case "PDF/index.php":
						if (isset($_GET['page'])) $form_name = $_GET['page'];
						$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : getSingleEvent(PROJECT_ID);
						if (isset($_GET['id'])) $record = $_GET['id'];
						break;
					// Longitudinal grid
					case "DataEntry/record_home.php":
						if (isset($_GET['id'])) $record = $_GET['id'];
						break;
					// Calendar
					case "Calendar/index.php":
						// Obtain mm, dd, yyyy being viewed
						if (!isset($_GET['year'])) {
							$_GET['year'] = date("Y");
						}
						if (!isset($_GET['month'])) {
							$_GET['month'] = date("n")+1;
						}
						$month = $_GET['month'] - 1;
						$year  = $_GET['year'];
						if (isset($_GET['day']) && $_GET['day'] != "") {
							$day = $_GET['day'];
						} else {
							$day = $_GET['day'] = 1;
						}
						$days_in_month = date("t", mktime(0,0,0,$month,1,$year));
						// Set values
						$view = (!isset($_GET['view']) || $_GET['view'] == "") ? "month" : $_GET['view'];
						$miscellaneous = "view: $view\ndates viewed: ";
						switch ($view) {
							case "day":
								$miscellaneous .= "$month/$day/$year";
								break;
							case "week":
								$miscellaneous .= "week of $month/$day/$year";
								break;
							default:
								$miscellaneous .= "$month/1/$year - $month/$days_in_month/$year";
						}
						break;
					// Edoc download
					case "DataEntry/file_download.php":
						$record    = $_GET['record'];
						$event_id  = $_GET['event_id'];
						$form_name = $_GET['page'];
						break;
					// Calendar pop-up
					case "Calendar/calendar_popup.php":
						// Check if has record or event
						if (isset($_GET['cal_id'])) {
							$q = db_query("select record, event_id from redcap_events_calendar where cal_id = '".prep($_GET['cal_id'])."'");
							$record   = db_result($q, 0, "record");
							$event_id = db_result($q, 0, "event_id");
						}
						break;
					// Scheduling module
					case "Calendar/scheduling.php":
						if (isset($_GET['record'])) {
							$record = $_GET['record'];
						}
						break;
					// Graphical Data View page
					case "Graphical/index.php":
						if (isset($_GET['page'])) {
							$form_name = $_GET['page'];
						}
						break;
					// Graphical Data View highest/lowest/missing value
					case "DataExport/stats_highlowmiss.php":
						$form_name 	= $_GET['form'];
						$miscellaneous = "field_name: '{$_GET['field']}'\n"
									   . "action: '{$_GET['svc']}'\n"
									   . "group_id: " . (($_GET['group_id'] == "undefined") ? "" : $_GET['group_id']);
						break;
					// Viewing a report
					case "DataExport/report_ajax.php":
						// Report Builder reports
						if (isset($_POST['report_id'])) {
							$report = DataExport::getReports($_POST['report_id']);
							$miscellaneous = "// Report attributes for \"" . $report['title'] . "\" (report_id = {$_POST['report_id']}):\n";
							$miscellaneous .= json_encode($report);
						}
						break;
					// Data comparison tool
					case "DataComparisonController:index":
						if (isset($_POST['record1'])) {
							list ($record1, $event_id1) = explode("[__EVTID__]", $_POST['record1']);
							if (isset($_POST['record2'])) {
								list ($record2, $event_id2) = explode("[__EVTID__]", $_POST['record2']);
								$record = "$record1 (event_id: $event_id1)\n$record2 (event_id: $event_id2)";
							} else {
								$record = "$record1 (event_id: $event_id1)";
							}
						}
						break;
					// File repository and data export docs
					case "FileRepository/file_download.php":
						if (isset($_GET['id'])) {
							$miscellaneous = "// Download file from redcap_docs (docs_id = {$_GET['id']})";
						}
						break;
					// Logging page
					case "Logging/index.php":
						if (isset($_GET['record']) && $_GET['record'] != '') {
							$record = $_GET['record'];
						}
						if (isset($_GET['usr']) && $_GET['usr'] != '') {
							$miscellaneous = "// Filter by user name ('{$_GET['usr']}')";
						}
						break;
				}
			}

			// TWO FACTOR AUTH: Set login method (e.g., SMS) for miscellaneous
			if ($two_factor_auth_enabled && $event == "LOGIN_SUCCESS" && $twoFactorLoginMethod != null) {
				$miscellaneous = $twoFactorLoginMethod;
			}

			// Do logging
			$sql = "insert into redcap_log_view (ts, user, event, ip, browser_name, browser_version, full_url, page, project_id, event_id,
					record, form_name, miscellaneous, session_id) values ('".NOW."', " . checkNull($userid) . ", '".prep($event)."', " . checkNull($ip) . ",
					'" . prep($browser_name) . "', '" . prep($browser_version) . "',
					'" . prep($full_url) . "', '".prep($page)."', " . checkNull($project_id) . ", " . checkNull($event_id) . ", " . checkNull($record) . ",
					" . checkNull($form_name) . ", " . checkNull($miscellaneous) . ", " . checkNull($session_id) . ")";
			db_query($sql);
			if (!defined("LOG_VIEW_ID")) define("LOG_VIEW_ID", db_insert_id());
		}

		// Add to log_open_requests table (for page views only)
		if ($event == "PAGE_VIEW") {
			$sql = "insert into redcap_log_view_requests (log_view_id, mysql_process_id, php_process_id, is_ajax)
					values (" . checkNull(defined("LOG_VIEW_ID") ? LOG_VIEW_ID : '') . ", " . checkNull(db_thread_id()) . ", " .
					checkNull(getmypid()) . ", " . ($isAjax ? '1' : '0') . ")";
			db_query($sql);
			if (!defined("LOG_VIEW_REQUEST_ID")) define("LOG_VIEW_REQUEST_ID", db_insert_id());
		}
	}

	// Count page hits (but not for specified pages, or for AJAX requests, or for survey passthru pages)
	public static function logPageHit()
	{
		global $isAjax;
		if (!in_array(PAGE, self::$noCountPages) && !$isAjax && !(PAGE == 'surveys/index.php' && isset($_GET['__passthru'])))
		{
			//Add one to daily count
			$ph = db_query("update redcap_page_hits set page_hits = page_hits + 1 where date = CURRENT_DATE and page_name = '" . PAGE . "'");
			//Do insert if previous query fails (in the event of being the first person to hit that page that day)
			if (!$ph || db_affected_rows() != 1) {
				db_query("insert into redcap_page_hits (date, page_name) values (CURRENT_DATE, '" . PAGE . "')");
			}
		}
	}
	
}