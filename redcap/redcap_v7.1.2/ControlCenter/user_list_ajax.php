<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Config for non-project pages
require dirname(dirname(__FILE__)) . "/Config/init_global.php";

//If user is not a super user, go back to Home page
if (!SUPER_USER && !ACCOUNT_MANAGER) redirect(APP_PATH_WEBROOT);

// determine if we are narrowing our search by latest activity within a given time frame.
// this is delineated by the d $_REQUEST variable
$queryAddendum = '';
if (isset($_GET['d']) && !(isset($_GET['showSearchOnly']) && $_GET['showSearchOnly'] == '1'))
{
	// do a sanity check on the variables to make sure everything is kosher and no URL hacking is going on
	if (is_numeric($_GET['d'])) {
		// Active in...
	   $queryAddendum = " and user_lastactivity is not null and user_lastactivity != '' and user_lastactivity >= '".date('Y-m-d H:i:s',time()-(86400*$_GET['d']))."'";
	} elseif (strpos($_GET['d'], "NA-") !== false) {
		// Not active in...
		list ($nothing, $notactive_days) = explode("-", $_GET['d'], 2);
		if (!is_numeric($notactive_days)) {
			$queryAddendum = '';
		} else {
			$queryAddendum = " and (user_lastactivity < '".date('Y-m-d H:i:s',time()-(86400*$notactive_days))."' or user_lastactivity is null or user_lastactivity = '')";
		}
	} elseif ($_GET['d'] == 'T' || $_GET['d'] == 'NT') {
		// Table-based users only OR LDAP users only
		$subQueryAddendum = "select username from redcap_auth";
		if ($_GET['d'] == 'T') {
			$queryAddendum = " and username in (" . pre_query($subQueryAddendum) . ")";
		} else {
			$queryAddendum = " and username not in (" . pre_query($subQueryAddendum) . ")";
		}
	} elseif ($_GET['d'] == 'I') {
		// Suspended
		$queryAddendum = " and user_suspended_time IS NOT NULL";
	} elseif ($_GET['d'] == 'NI') {
		// Non-suspended
		$queryAddendum = " and user_suspended_time IS NULL";
	} elseif ($_GET['d'] == 'E') {
		// Has expiration set
		$queryAddendum = " and user_expiration IS NOT NULL";
	} elseif ($_GET['d'] == 'NE') {
		// Does not have expiration set
		$queryAddendum = " and user_expiration IS NULL";
	} elseif ($_GET['d'] == 'CL' || $_GET['d'] == 'NCL') {
		// Currently logged in or not
		$logoutWindow = date("Y-m-d H:i:s", mktime(date("H"),date("i")-$autologout_timer,date("s"),date("m"),date("d"),date("Y")));
		$subQueryAddendum = "select distinct v.user from redcap_sessions s, redcap_log_view v
				where v.user != '[survey respondent]' and v.session_id = s.session_id and v.ts >= '$logoutWindow'";
		if ($_GET['d'] == 'CL') {
			$queryAddendum = " and username in (" . pre_query($subQueryAddendum) . ")";
		} else {
			$queryAddendum = " and username not in (" . pre_query($subQueryAddendum) . ")";
		}
	} elseif (strpos($_GET['d'], "NL-") !== false) {
		// Not logged in within...
		list ($nothing, $notloggedin_days) = explode("-", $_GET['d'], 2);
		if (!is_numeric($notloggedin_days)) {
			$queryAddendum = '';
		} else {
			$queryAddendum = " and (user_lastlogin is null or user_lastlogin < '".date('Y-m-d H:i:s',time()-(86400*$notloggedin_days))."')";
		}
	} elseif (strpos($_GET['d'], "L-") !== false) {
		// Logged in within...
		list ($nothing, $loggedin_days) = explode("-", $_GET['d'], 2);
		if (!is_numeric($loggedin_days)) {
			$queryAddendum = '';
		} else {
			$queryAddendum = " and user_lastlogin is not null and user_lastlogin > '".date('Y-m-d H:i:s',time()-(86400*$loggedin_days))."'";
		}
	} else {
		$queryAddendum = '';
	}
}

// Set SQL for search term
if (!isset($_GET['search_term'])) $_GET['search_term'] = '';
if (!isset($_GET['search_attr'])) $_GET['search_attr'] = '';
$querySearch = '';
$allowableSearchAttr = array('username', 'user_firstname', 'user_lastname', 'user_email', 'user_inst_id', 'user_sponsor', 'user_comments');
if ($_GET['search_term'] != '')
{
	$_GET['search_term'] = rawurldecode(urldecode($_GET['search_term']));
	if (!in_array($_GET['search_attr'], $allowableSearchAttr)) $_GET['search_term'] = '';
	// Search ALL valid attributes
	if ($_GET['search_attr'] == '') {
		$querySearch = " and (username like '%" . prep($_GET['search_term']) . "%'
						  or  user_firstname like '%" . prep($_GET['search_term']) . "%'
						  or  user_lastname like '%" . prep($_GET['search_term']) . "%'
						  or  user_email like '%" . prep($_GET['search_term']) . "%'
						  or  user_inst_id like '%" . prep($_GET['search_term']) . "%'
						  or  user_sponsor like '%" . prep($_GET['search_term']) . "%'
						  or  user_comments like '%" . prep($_GET['search_term']) . "%'
						)";
	}
	// Search single attribute
	else {
		$querySearch = " and " . prep($_GET['search_attr']) . " like '%" . prep($_GET['search_term']) . "%'";
	}
}


// Add search box for searching table
if ($isAjax) {
	?>
	<div style="float:left;margin:5px 0 15px;">
		<div style="font-weight:bold;margin:4px 0;"><?php echo $lang['data_entry_225'] ?><span id="userListCatSpan" style="font-size:14px;margin-left:4px;color:#C00000;"></span></div>
		<b><?php echo $lang['control_center_60'] ?></b> &nbsp;
		<input type="text" id="user_list_search" size="20" class="x-form-text x-form-field" style="" value="<?php if (isset($_GET['search_term'])) print htmlspecialchars($_GET['search_term'], ENT_QUOTES) ?>">
		<span style="margin:0 4px;"><?php echo $lang['global_107'] ?></span>
		<select id="user_list_search_attr" class="x-form-text x-form-field" style="margin-right:5px;">
			<option value="" <?php if ($_GET['search_attr'] == "") print "selected"; ?>><?php echo $lang['control_center_4496'] ?></option>
			<option value="username" <?php if ($_GET['search_attr'] == "username") print "selected"; ?>><?php echo $lang['global_11'] ?></option>
			<option value="user_firstname" <?php if ($_GET['search_attr'] == "user_firstname") print "selected"; ?>><?php echo $lang['global_41'] ?></option>
			<option value="user_lastname" <?php if ($_GET['search_attr'] == "user_lastname") print "selected"; ?>><?php echo $lang['global_42'] ?></option>
			<option value="user_email" <?php if ($_GET['search_attr'] == "user_email") print "selected"; ?>><?php echo $lang['control_center_56'] ?></option>
			<option value="user_sponsor" <?php if ($_GET['search_attr'] == "user_sponsor") print "selected"; ?>><?php echo $lang['user_72'] ?></option>
			<option value="user_inst_id" <?php if ($_GET['search_attr'] == "user_inst_id") print "selected"; ?>><?php echo $lang['control_center_236'] ?></option>
			<option value="user_comments" <?php if ($_GET['search_attr'] == "user_comments") print "selected"; ?>><?php echo $lang['dataqueries_146'] ?></option>
		</select>
		<button class="jqbuttonmed" onclick="openUserHistoryList(0);"><?php echo $lang['control_center_439'] ?></button>
	</div>
	<div style="float:right;margin:25px 0 15px;">
		<button class="jqbuttonmed" style="" onclick="downloadUserHistoryList();"><img src="<?php print APP_PATH_IMAGES ?>xls.gif" style="vertical-align:middle;"> <span style="vertical-align:middle;color:green;"><?php echo $lang['random_19'] ?></span></button>
	</div>
	<?php
}

if (!$isAjax || !(isset($_GET['showSearchOnly']) && $_GET['showSearchOnly'] == '1'))
{
	$userList = array();
	// Retrieve list of users
	$dbQuery = "select * from redcap_user_information where username != '' $queryAddendum $querySearch order by username";
	$q = db_query($dbQuery);
	$numUsers = db_num_rows($q);
	$tickImg = "<img src='" . APP_PATH_IMAGES . "tick.png'>";
	while ($row = db_fetch_assoc($q))
	{
		$row['username'] = strtolower(trim($row['username']));
		if ($isAjax) {
			// Webpage display
			$userList[] = array("<a onclick=\"view_user('{$row['username']}'); modifyURL(app_path_webroot+'ControlCenter/view_users.php?username={$row['username']}');\" href='javascript:;' style='font-size:11px;color:#800000;'>{$row['username']}</a>",
								$row['user_firstname'],
								$row['user_lastname'],
								"<a href='mailto:{$row['user_email']}' style='font-size:11px;'>{$row['user_email']}</a>",
								($row['super_user'] ? $tickImg : ""),
								($row['user_sponsor'] == '' ? '' : "<a onclick=\"view_user('{$row['user_sponsor']}'); modifyURL(app_path_webroot+'ControlCenter/view_users.php?username={$row['user_sponsor']}');\" href='javascript:;' style='font-size:11px;color:#800000;'>{$row['user_sponsor']}</a>"),
								($row['user_inst_id'] == '' ? '' : RCView::div(array('class'=>'wrap', 'style'=>'line-height:11px;'), $row['user_inst_id'])),
								($row['user_comments'] == '' ? '' : RCView::div(array('class'=>'wrap', 'style'=>'line-height:11px;'), $row['user_comments'])),
								RCView::span(array('class'=>'hidden'), $row['user_firstactivity']) . DateTimeRC::format_ts_from_ymd($row['user_firstactivity']) ,
								RCView::span(array('class'=>'hidden'), $row['user_lastactivity']) . DateTimeRC::format_ts_from_ymd($row['user_lastactivity']) ,
								RCView::span(array('class'=>'hidden'), $row['user_lastlogin']) . DateTimeRC::format_ts_from_ymd($row['user_lastlogin']) ,
								RCView::span(array('class'=>'hidden'), $row['user_suspended_time']) . ($row['user_suspended_time'] == '' ? "<span style='color:#aaa;'>{$lang['control_center_149']}</span>" : DateTimeRC::format_ts_from_ymd($row['user_suspended_time'])) ,
								RCView::span(array('class'=>'hidden'), $row['user_expiration']) . ($row['user_expiration'] == '' ? "<span style='color:#aaa;'>{$lang['control_center_149']}</span>" : DateTimeRC::format_ts_from_ymd($row['user_expiration']))
						  );
		} else {
			// CSV file export
			$userList[] = array($row['username'],
								$row['user_firstname'],
								$row['user_lastname'],
								$row['user_email'],
								($row['super_user'] ? $lang['design_100'] : ""),
								($row['user_sponsor'] == '' ? '' : $row['user_sponsor']),
								($row['user_inst_id'] == '' ? '' : $row['user_inst_id']),
								($row['user_comments'] == '' ? '' : $row['user_comments']),
								$row['user_firstactivity'],
								$row['user_lastactivity'],
								$row['user_lastlogin'],
								($row['user_suspended_time'] == '' ? $lang['control_center_149'] : $row['user_suspended_time']) ,
								($row['user_expiration'] == '' ? $lang['control_center_149'] : $row['user_expiration'])
						  );
		}
	}
	if ($isAjax) {
		// If no users are being shown, then render a row to say that no users are displayed
		if (empty($userList))
		{
			$userList[] = array("<span style='color:red;'>{$lang['control_center_191']}</span>","","","","","","","","");
		}
		// Headers
		$col_widths_headers = array(
								array(150, "<b>{$lang['global_11']} &nbsp;&nbsp;<span style='color:#800000;'>(".User::number_format_user($numUsers)." {$lang['control_center_192']})</span></b>"),
								array(90, "<b>{$lang['global_41']}</b>"),
								array(90, "<b>{$lang['global_42']}</b>"),
								array(152, "<b>{$lang['control_center_56']}</b>"),
								array(40,  RCView::span(array('class'=>'wrap', 'style'=>'word-wrap: break-word;'), "<b>{$lang['control_center_57']}</b>"), "center"),
								array(96,  "<b>{$lang['user_72']}</b>"),
								array(96,  "<b>{$lang['control_center_236']}</b>"),
								array(125,  "<b>{$lang['dataqueries_146']}</b>"),
								array(96,  "<b>{$lang['control_center_59']}</b>", "center"),
								array(96,  "<b>{$lang['control_center_148']}</b>", "center"),
								array(96,  "<b>{$lang['control_center_429']}</b>", "center"),
								array(96, RCView::span(array('class'=>'wrap'), "<b>{$lang['control_center_138']}</b>"), "center"),
								array(96, RCView::span(array('class'=>'wrap'), "<b>{$lang['rights_54']}</b>"), "center")
							);
		// Render the user list as table
		renderGrid("userListTableInner", "", 1471, "auto", $col_widths_headers, $userList);
	} else {
		// CSV download
		$filename = "UserList_".date("Y-m-d_Hi").".csv";
		// Open connection to create file in memory and write to it
		$fp = fopen('php://memory', "x+");
		// Headers
		fputcsv($fp, array($lang['global_11'],
						$lang['global_41'],
						$lang['global_42'],
						$lang['control_center_56'],
						$lang['control_center_57'],
						$lang['user_72'],
						$lang['control_center_236'],
						$lang['dataqueries_146'],
						$lang['control_center_59'],
						$lang['control_center_148'],
						$lang['control_center_429'],
						$lang['control_center_138'],
						$lang['rights_54'],
				  ));
		// Loop and write each line to CSV
		foreach ($userList as $line) {
			fputcsv($fp, $line);
		}
		// Open file for reading and output to user
		fseek($fp, 0);
		// Output to file
		header('Pragma: anytextexeptno-cache', true);
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$filename.csv");
		print addBOMtoUTF8(stream_get_contents($fp));
	}
}
