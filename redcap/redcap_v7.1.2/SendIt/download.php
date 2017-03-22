<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Disable authentication
define("NOAUTH", true);
// Call config file
require_once dirname(dirname(__FILE__)) . '/Config/init_global.php';
// Redirect to SendIt download route
redirect(APP_PATH_WEBROOT . "index.php?route=SendItController:download&".$_SERVER['QUERY_STRING']);