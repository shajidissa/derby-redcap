<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

include_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

$response			= 1; //default successful response
$action	  	   		= $_GET['action'];
$id 				= $_GET['id'];
$do_all_timepoints 	= $longitudinal ? $_GET['grid'] : 0;
$event_id	   		= $_GET['event_id'];
$arm = !is_numeric($_GET['arm']) ? 0 : $_GET['arm'];

// Set up logging details for this event
$log = "Record: $id\nForm: [all forms]";
if ($longitudinal) {
	$log .= "\nEvent: ";
	if ($arm > 0) {
		// all forms for all events for one arm
		$log .= "[all events" . ($multiple_arms ? (" on {$lang['global_08']} $arm: " . $Proj->events[$arm]['name']) : "") . "]";
	} else {
		// all forms for one event
		$q = db_query("select e.descrip, a.arm_num, a.arm_name from redcap_events_metadata e, redcap_events_arms a where e.arm_id = a.arm_id and e.event_id = " . $_GET['event_id']);
		$log .= html_entity_decode(db_result($q, 0, "descrip"), ENT_QUOTES);
		// Show arm name if multiple arms exist
		if ($multiple_arms) {
			$log .= " - {$lang['global_08']} " . db_result($q, 0, "arm_num") . ": " . html_entity_decode(db_result($q, 0, "arm_name"), ENT_QUOTES);
		}
	}
}

//If we are coming from menu, there will only be one event_id, but if coming from Longitudinal grid, we need to include ALL event_ids
$all_event_ids = ($event_id == "" || !is_numeric($event_id)) ? array_keys($Proj->events[$arm]['events']) : array($event_id);

// Are there any repeating events/forms?
$repeatingFormsEvents = $Proj->getRepeatingFormsEvents();

// Loop through form-level rights and exclude any forms to which they have no access
$notLockable = array();
foreach ($user_rights['forms'] as $this_form=>$this_level) {
	if ($this_level == '0') {
		$notLockable[$this_form] = "";
	}
}
// LOCK ALL FORMS
if ($action == "lock")
{
	// Determine which forms/events have already been locked for this record, and collect in array
	$sql = "select event_id, form_name, instance from redcap_locking_data where project_id = $project_id
			and event_id in (" . implode(", ", $all_event_ids) . ") and record = '" . prep($id). "'";
	$q = db_query($sql);
	$alreadyLocked = array();
	while ($row = db_fetch_assoc($q))
	{
		if ($row['instance'] == '') $row['instance'] = '1';
		$alreadyLocked[$row['event_id']][$row['form_name']][$row['instance']] = "";
	}
	// Determine which forms are designated as NOT lockable
	$sql = "select form_name from redcap_locking_labels where project_id = $project_id and display = 0";
	$q = db_query($sql);
	while ($row = db_fetch_assoc($q))
	{
		$notLockable[$row['form_name']] = "";
	}
	// Create array to capture all the instance numbers for each event for this record
	$eventInstances = array();
	// Loop through all forms/events and insert into table if not already in table
	$allFormsEvents = array();
	foreach ($Proj->eventsForms as $this_event_id=>$forms) {
		if (!in_array($this_event_id, $all_event_ids)) continue;
		foreach ($forms as $this_form) {
			// Seed with initial instance=1 value
			$allFormsEvents[$this_event_id][$this_form][1] = true;
			$eventInstances[$this_event_id][1] = true;
			// Has repeating events/forms 
			if (!empty($repeatingFormsEvents)) {
				// Add all instances where data is saved in the data table
				$sql = "select distinct d.event_id, m.form_name, d.instance 
						from redcap_metadata m, redcap_data d where m.project_id = $project_id and d.event_id = $this_event_id 
						and d.record = '" . prep($id). "' and m.field_name != '$table_pk' 
						and d.field_name = m.field_name and d.project_id = m.project_id";
				if (!$longitudinal) $sql .= " and m.form_name = '$this_form'";
				$q = db_query($sql);
				while ($row = db_fetch_assoc($q)) {
					if ($row['instance'] == '') $row['instance'] = 1;
					$allFormsEvents[$row['event_id']][$row['form_name']][$row['instance']] = true;
					$eventInstances[$this_event_id][$row['instance']] = true;
				}
			}
		}
	}
	// Now add any event instances for forms with no data saved yet (longitudinal only)
	if ($longitudinal) {
		foreach ($eventInstances as $this_event_id=>$instances) {
			foreach (array_keys($instances) as $this_instance) {
				if (!in_array($this_event_id, $all_event_ids)) continue;
				foreach ($Proj->eventsForms[$this_event_id] as $this_form) {
					$allFormsEvents[$this_event_id][$this_form][$this_instance] = true;
				}
			}
		}
	}
	// Insert into table
	foreach ($allFormsEvents as $this_event_id=>$forms) {
		foreach ($forms as $this_form=>$instances) {
			foreach (array_keys($instances) as $instance) {
				if (!isset($alreadyLocked[$this_event_id][$this_form][$instance]) && !isset($notLockable[$this_form]))
				{
					if ($instance == '') $instance = "1"; // "1" should be saved as NULL in db table
					$sql = "insert into redcap_locking_data (project_id, record, event_id, form_name, instance, username, timestamp)
							values ($project_id, '" . prep($id) . "', $this_event_id, '$this_form', 
							".checkNull($instance).", '" . prep($userid) . "', '".NOW."')";
					if (!db_query($sql)) $response = 0;
				}
			}
		}
	}
	// Log the event
	if ($response)
	{
		Logging::logEvent($sql,"redcap_locking_data","LOCK_RECORD",$id,$log,"Lock record");
	}
}
// UNLOCK ALL FORMS
elseif ($action == "unlock")
{
	// Set sub-sql if user has no access to some forms
	if (!empty($notLockable)) {
		$sql_not_lockable = "and form_name not in (" . prep_implode(array_keys($notLockable)) . ")";
	}
	// Delete all instances of locked fields in table
	$sql = "delete from redcap_locking_data where project_id = $project_id and event_id in (" . prep_implode($all_event_ids) . ")
			and record = '" . prep($id). "' $sql_not_lockable";
	// Execute query, set response, and log the event
	if (db_query($sql))
	{
		// Logging
		Logging::logEvent($sql,"redcap_locking_data","LOCK_RECORD",$id,$log,"Unlock record");
		// ESIGNATURES: Now check for any e-signatures that must now be negated, remove them, and log all
		$sql = "select 1 from redcap_esignatures where project_id = $project_id
				and event_id in (" . prep_implode($all_event_ids) . ") and record = '" . prep($id). "' limit 1";
		$esignatures_exist = db_num_rows(db_query($sql));
		if ($esignatures_exist)
		{
			$sql = "delete from redcap_esignatures where project_id = $project_id and event_id in (" . prep_implode($all_event_ids) . ")
					and record = '" . prep($id). "' $sql_not_lockable";
			if (db_query($sql))
			{
				// Logging
				Logging::logEvent($sql,"redcap_esignatures","ESIGNATURE",$id,$log,"Negate e-signature");
			}
		}
	}
	else
	{
		$response = 0;
	}
}
// Should not be here
else
{
	$response = 0;
}
// Send response
print $response;