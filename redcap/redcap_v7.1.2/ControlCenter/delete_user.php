<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require dirname(dirname(__FILE__)) . "/Config/init_global.php";

if ((SUPER_USER || ACCOUNT_MANAGER) && isset($_POST['username'])) {

	// Remove user from user info table
	$q1 = db_query("delete from redcap_user_information where username = '".prep($_POST['username'])."'");
	$q1_rows = db_affected_rows();
	// Remove user from user rights table
	$q2 = db_query("delete from redcap_user_rights where username = '".prep($_POST['username'])."'");
	// Remove user from auth table (in case if using Table-based authentication)
	$q3 = db_query("delete from redcap_auth where username = '".prep($_POST['username'])."'");
	// Remove user from table
	$q4 = db_query("delete from redcap_user_whitelist where username = '".prep($_POST['username'])."'");
	// Remove user from table
	$q5 = db_query("delete from redcap_auth_history where username = '".prep($_POST['username'])."'");
	// Remove user from table
	$q6 = db_query("delete from redcap_external_links_users where username = '".prep($_POST['username'])."'");

	// If all queries ran as expected, give positive response
	if ($q1_rows == 1 && $q1 && $q2 && $q3 && $q4 && $q5 && $q6) {
		// Logging
		Logging::logEvent("","redcap_user_information\nredcap_user_rights\nredcap_auth\nredcap_auth_history\nredcap_external_links_users","MANAGE",$_POST['username'],"username = '".prep($_POST['username'])."'","Delete user from REDCap");
		// Give positive response
		exit("1");
	}
}

exit("0");
