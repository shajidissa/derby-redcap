<?php

require_once dirname(dirname(__FILE__)) . "/Config/init_project.php";
require_once APP_PATH_DOCROOT . 'Design/functions.php';

$logic = $_POST['logic'];

// Obtain array of error fields that are not real fields
$error_fields = validateBranchingCalc($logic);

// If receiving record-event_id, then split it up to prepend variables in the logic with unique events names (to apply it to a specific event)
if ($longitudinal && isset($_POST['hasrecordevent']) && $_POST['hasrecordevent'] == '1') {
	// Split record-event_id
	$posLastDash = strrpos($_POST['record'], '-');
	$record = substr($_POST['record'], 0, $posLastDash);
	$event_id = substr($_POST['record'], $posLastDash+1);
	if (trim($logic) != '') {
		$logic = LogicTester::logicPrependEventName($logic, $Proj->getUniqueEventNames($event_id));
	}
} else {
	$record = $_POST['record'];
}

if (empty($error_fields))
{
	// Format calculation to PHP format
	$logic = Calculate::formatCalcToPHP($logic, $Proj);
	// Get resulting calculation
	$val = LogicTester::evaluateLogicSingleRecord($logic, $record, null, null, 1, null, true);
	if (is_nan($val) || $val === "")
		echo "[".$lang['design_708']."]";
	else
		echo $val;
}
else
{
	echo "[".$lang['design_708']."]";
}