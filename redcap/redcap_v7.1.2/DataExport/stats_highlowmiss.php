<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

include_once dirname(dirname(__FILE__)) . '/Config/init_project.php';
include_once APP_PATH_DOCROOT . 'DataExport/stats_functions.php';

# Validate form and field names
$field = $_POST['field'];
if (!isset($Proj->metadata[$field])) {
	header("HTTP/1.0 503 Internal Server Error");
	return;
}

# Whether or not to reverse the $data
$reverse = false;

// If we have a whitelist of records/events due to report filtering, unserialize it
$includeRecordsEvents = (isset($_POST['includeRecordsEvents'])) ? unserialize(decrypt($_POST['includeRecordsEvents'])) : array();
// If $includeRecordsEvents is passed and not empty, then it will be the record/event whitelist
$checkIncludeRecordsEvents = (!empty($includeRecordsEvents));
// Get any repeating forms/events
$RepeatingFormsEvents = $Proj->getRepeatingFormsEvents();

# Limit records pulled only to those in user's Data Access Group
$group_sql  = "";
if ($user_rights['group_id'] != "") {
	$group_sql  = "and record in (" . pre_query("select record from redcap_data where project_id = $project_id and field_name = '__GROUPID__' and value = '{$user_rights['group_id']}'") . ")";
}

# Calculate lowest values
if ($_POST['svc'] == 'low') {
	$sql = "select record, value, event_id from redcap_data where project_id = $project_id and field_name = '$field'
			and value != '' $group_sql order by (value+0) asc limit 5";

# Calculate highest Values
} elseif ($_POST['svc'] == 'high') {
	$sql = "select record, value, event_id from redcap_data where project_id = $project_id and field_name = '$field'
			and value != '' $group_sql order by (value+0) desc limit 5";
	// Set flag to reverse data points for output
	$reverse = true;

# Calculate missing values
} elseif ($_POST['svc'] == 'miss') {
	$sql = "select distinct record, event_id, if(instance is null,1,instance) as instance 
			from redcap_data where project_id = $project_id 
			and field_name = '$table_pk' and concat(if(instance is null,1,instance),',',event_id,',',record) 
			not in (" . pre_query("select concat(if(instance is null,1,instance),',',event_id,',',record) 
			from (select distinct event_id, record, instance
			from redcap_data where value != '' and project_id = $project_id and field_name = '$field')
			as x") . ") $group_sql order by event_id";
}

// Execute query to retrieve response
$data = array();
$res = db_query($sql);
if ($res) {
	// Special conditions apply for missing values in a longitudinal project.
	// Make sure the event_id here is in the events_forms table (i.e. that the form is even used by that event).
	if ($_POST['svc'] == 'miss')
	{
		// Loop through data
		while ($ret = db_fetch_assoc($res)) {
			// If we have a record/event whitelist, then check the record/event
			if ($checkIncludeRecordsEvents) {
				if ($ret['instance'] == '') $ret['instance'] = '1';
				// If a repeating form or event
				if ($ret['instance'] > 1 && isset($RepeatingFormsEvents[$ret['event_id']])) {
					if ($Proj->isRepeatingEvent($ret['event_id'])) {
						// Repeating event (no repeating instrument = blank)
						$repeat_instrument = "";
					} else {
						// Repeating form
						$repeat_instrument = $Proj->metadata[$field]['form_name'];
					}
					if (!isset($includeRecordsEvents[$ret['record']][$ret['event_id']][$ret['instance']."-".$repeat_instrument])) {
						//print "\n".$ret['record'].", ".$ret['event_id'].", ".$ret['instance']."-".$repeat_instrument;
						continue;
					}
				}
				// Non-repeating
				elseif (!isset($includeRecordsEvents[$ret['record']][$ret['event_id']])) {
					//print "\n".$ret['record'].", ".$ret['event_id'];
					continue;
				}
			}
			// Is event_id valid for this field's form?
			if (!$longitudinal || ($longitudinal && in_array($Proj->metadata[$field]['form_name'], $Proj->eventsForms[$ret['event_id']]))) {
				// Only add to output if field's form is used for this event
				$data[] = removeDDEending($ret['record']) . ":" . $ret['event_id'] . ":" . $ret['instance'];
			}
		}
	}
	// Sort the data by record name
	natcasesort($data);
	// Reverse order of data points, if set
	if ($reverse)
	{
		$data = array_reverse($data);
	}
}

// Output response
header('Content-type: text/plain');
print count($data) . '|' . implode('|', $data);
