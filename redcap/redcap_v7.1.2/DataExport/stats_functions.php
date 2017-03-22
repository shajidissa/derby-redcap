<?php

// Obtain descriptive stats for this form as an array
function getDescriptiveStats($fields, $totalrecs, $form="", $includeRecordsEvents=array(), $hasFilterWithNoRecords=false)
{
	global $Proj, $user_rights, $table_pk, $longitudinal;
	// Set array to discern what are categorical fields
	$mc_field_types = array("radio", "select", "dropdown", "yesno", "truefalse", "checkbox");

	// Determine if this is being displayed for a survey
	$isSurveyPage = (isset($_GET['s']) && defined("NOAUTH") && PAGE == 'surveys/index.php');

	// If $includeRecordsEvents is passed and not empty, then it will be the record/event whitelist
	$checkIncludeRecordsEvents = (!empty($includeRecordsEvents));
	
	// Get any repeating forms/events
	$RepeatingFormsEvents = $Proj->getRepeatingFormsEvents();

	// Surveys only: Determine if check diversity feature is enabled
	if ($isSurveyPage)
	{
		// Get the survey_id
		$survey_id = $Proj->forms[$form]['survey_id'];
		// Check if feature is enabled
		$check_diversity_view_results = $Proj->surveys[$survey_id]['check_diversity_view_results'];
		// Get the respondents data to determine if some STATS TABLES should be hidden due to lack of diversity
		if ($check_diversity_view_results && isset($_POST['__response_id__']))
		{
			// Get this response's record and event_id (event_id will be the first event in the arm)
			$sql = "select r.record, e.event_id, r.instance from redcap_surveys_response r, redcap_surveys_participants p, redcap_events_metadata e
					where p.participant_id = r.participant_id and r.response_id = {$_POST['__response_id__']} and r.completion_time is not null
					and p.event_id = e.event_id order by e.day_offset, e.descrip limit 1";
			$q = db_query($sql);
			if (db_num_rows($q) > 0)
			{
				// Get record and event_id
				$record = db_result($q, 0, 'record');
				$event_id = db_result($q, 0, 'event_id');
				$instance = db_result($q, 0, 'instance');
				$instance_sql = ($instance == '1') ? "and instance is null" : "and instance = '$instance'";
				// Now get the response data
				$sql = "select field_name, value from redcap_data where project_id = " . PROJECT_ID . "
						and record = '" . prep($record) . "' and event_id = $event_id and value != '' $instance_sql";
				$q = db_query($sql);
				$respondent_data = array();
				while ($row = db_fetch_assoc($q))
				{
					// Put data in array
					if ($Proj->metadata[$row['field_name']]['element_type'] == 'checkbox') {
						$respondent_data[$row['field_name']][] = $row['value'];
					} else {
						$respondent_data[$row['field_name']] = $row['value'];
					}
				}
			}
		}
	}
	
	// Get data types of all field validations
	$validationDataTypes = array();
	foreach (getValTypes() as $valType=>$valAttr)
	{
		$validationDataTypes[$valType] = $valAttr['data_type'];
	}

	// Loop through all fields on this form
	$fieldStats = array();
	foreach ($fields as $key=>$field_name)
	{
		// Ignore record ID field since it doesn't make sense to include it on this page
		if ($field_name == $table_pk) {
			unset($fields[$key]);
			continue;
		}
		// Get field attributes
		$field_attr = $Proj->metadata[$field_name];
		// Ignore descriptive fields
		if ($field_attr['element_type'] == 'descriptive') continue;
		// Add field to array
		$fieldStats[$field_name] = array('count'=>0, 'getstats'=>0,
										 'missing'=>($hasFilterWithNoRecords ? 0 : $totalrecs[$Proj->metadata[$field_name]['form_name']]));
		// Only return all data for numerical-type fields
		if ($field_attr['element_validation_type'] == 'float' || $field_attr['element_validation_type'] == 'int'
			|| $field_attr['element_type'] == 'calc' || $field_attr['element_type'] == 'slider'
			|| (isset($validationDataTypes[$field_attr['element_validation_type']])) && $validationDataTypes[$field_attr['element_validation_type']] == 'number')
		{
			$fieldStats[$field_name]['getstats'] = 1;
		}
	}

	## Get all form data
	$data = array();
	// If we're using a DAG filter but those DAGs in the filter have no records, then skip this
	if (!$hasFilterWithNoRecords) {
		// Limit records pulled only to those in user's Data Access Group
		$group_sql = "";
		if ($user_rights['group_id'] != "") {
			$group_sql  = "and record in (" . pre_query("select record from redcap_data where field_name = '__GROUPID__' and value = '{$user_rights['group_id']}' and project_id = ".PROJECT_ID).")";
		}
		// Query to pull all existing data for this form and place into $data array
		$sql = "select distinct record, event_id, field_name, value, instance from redcap_data where project_id = ".PROJECT_ID."
				and record != '' and field_name in ('" . implode("', '", array_keys($fieldStats)) . "') $group_sql";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			// Ignore blank values
			if ($row['value'] == '') continue;
			// If we have a record/event whitelist, then check the record/event
			if ($checkIncludeRecordsEvents) {
				if ($row['instance'] == '') $row['instance'] = '1';
				// If a repeating form or event
				if ($row['instance'] > 1 && isset($RepeatingFormsEvents[$row['event_id']])) {
					if ($Proj->isRepeatingEvent($row['event_id'])) {
						// Repeating event (no repeating instrument = blank)
						$repeat_instrument = "";
					} else {
						// Repeating form
						$repeat_instrument = $Proj->metadata[$row['field_name']]['form_name'];
					}
					if (!isset($includeRecordsEvents[$row['record']][$row['event_id']][$row['instance']."-".$repeat_instrument])) {
						continue;
					}
				}
				// Non-repeating
				elseif (!isset($includeRecordsEvents[$row['record']][$row['event_id']])) {
					continue;
				}
			}
			// If longitudinal, then make sure field belongs to a form that is designated for an event
			if ($longitudinal && !in_array($Proj->metadata[$row['field_name']]['form_name'], $Proj->eventsForms[$row['event_id']])) continue;
			// Put data in array
			$field_type = $Proj->metadata[$row['field_name']]['element_type'];
			if ($field_type == 'checkbox') {
				$data[$row['field_name']][$row['instance'].'|'.$row['event_id'].'|'.$row['record']][] = $row['value'];
			} else {
				if (!in_array($field_type, $mc_field_types)) {
					// Non-multiple choice: Replace data with "x" (to save memory instead of carrying all that data around in an array)
					if (!is_numeric($row['value'])) $row['value'] = "x";
				}
				$data[$row['field_name']][$row['instance'].'|'.$row['event_id'].'|'.$row['record']] = $row['value'];
			}
		}
		if(isset($res))
		{
			db_free_result($res);
		}
	}

	// If we have a record/event whitelist, then count number of record/event pairs in the array (to use to calculate Missing)
	if ($checkIncludeRecordsEvents) {
		$includeRecordsEventsNum = 0;
		foreach ($includeRecordsEvents as &$these_events) {
			foreach ($these_events as $these_instances) {
				$includeRecordsEventsNum += count($these_instances);
			}
		}
		// Loop through all fields with no data and make sure the "missing" count is set correctly.
		// Fields that DO have data will have their "missing" count set in the next block of foreach($data...).
		$includeRecordsEventsNumBaseCount = 0;
		$fields_no_data = array_diff(array_keys($fieldStats), array_keys($data));
		if (!empty($fields_no_data)) {
			// Get record/event count to use for any non-repeating forms
			$sql = "select distinct record, event_id from redcap_data where project_id = ".PROJECT_ID." 
					and field_name = '$table_pk' and record in (".prep_implode(array_keys($includeRecordsEvents)).")
					and instance is null";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q)) {
				if (!isset($includeRecordsEvents[$row['record']][$row['event_id']][1])) {
					continue;
				}
				$includeRecordsEventsNumBaseCount++;
			}
		}
		foreach ($fields_no_data as $field_name) {
			$fieldStats[$field_name]['missing'] = $includeRecordsEventsNumBaseCount;
		}
	}

	// Now that we have all data, loop through it and determine missing value count and stats
	foreach ($data as $field_name=>$records)
	{
		// Ignore record ID field
		if ($field_name == $table_pk) continue;
		// Get field type
		$field_type = $Proj->metadata[$field_name]['element_type'];
		// Is the field multiple choice?
		$isMCfield = in_array($field_type, $mc_field_types);
		// Set choices array for mc fields
		$choices = ($isMCfield) ? parseEnum($Proj->metadata[$field_name]['element_enum']) : array();
		// Set total count and missing value count (do these before checking that all are numerical)
		$num_records = count($records);
		$fieldStats[$field_name]['missing'] = ($checkIncludeRecordsEvents ? $includeRecordsEventsNum : $totalrecs[$Proj->metadata[$field_name]['form_name']]) - $num_records;
		$fieldStats[$field_name]['count']   = $num_records;
		// Remove any non-valide choices/values (exclude free-form text)
		if ($fieldStats[$field_name]['getstats'] || $isMCfield)
		{
			// Loop through all records for this field
			foreach ($records as $key=>$val)
			{
				if (is_array($val)) {
					// Checkbox
					foreach ($val as $key2=>$val2) {
						if ($isMCfield && !isset($choices[$val2])) {
							unset($records[$key][$key2]);
						}
					}
				} else {
					// Non-checkbox
					if ($isMCfield && !isset($choices[$val])) {
						unset($records[$key]);
					}
				}
			}
		}
		// Now reindex the array
		sort($records);
		// If free-form text, the skip the rest of this loop
		if (!$fieldStats[$field_name]['getstats'] && !$isMCfield) {
			continue;
		}
		// Unique
		if ($Proj->isCheckbox($field_name)) {
			// For checkboxes, all values are sub-arrays, so add them to $unique_choices first and then count
			$unique_choices = array();
			// Get list of valid choice options
			$field_valid_choices = parseEnum($Proj->metadata[$field_name]['element_enum']);
			foreach ($records as $these_choices) {
				foreach ($these_choices as $this_choice) {
					// make sure this is a valid choice still
					if (isset($field_valid_choices[$this_choice])) {
						$unique_choices[$this_choice] = true;
					}
				}
			}
			$fieldStats[$field_name]['unique'] = count($unique_choices);
			unset($unique_choices);
		} else {
			// Non-checkboxes
			$fieldStats[$field_name]['unique'] = count(array_unique($records));
		}
		// Numerical fields
		if ($fieldStats[$field_name]['getstats'])
		{
			// Sum
			$fieldStats[$field_name]['sum'] = User::number_format_user(round(array_sum($records), 2), 2);
			// Min
			$fieldStats[$field_name]['min'] = User::number_format_user(round(min($records), 2), 2);
			// Max
			$fieldStats[$field_name]['max'] = User::number_format_user(round(max($records), 2), 2);
			// Mean
			$fieldStats[$field_name]['mean'] = User::number_format_user(round(array_sum($records) / count($records), 2), 2);
			// StDev
			$fieldStats[$field_name]['stdev'] = User::number_format_user(round(stdev($records), 2), 2);
			// Q1 (.25 percentile)
			$fieldStats[$field_name]['perc25'] = User::number_format_user(round(percentile($records, 25), 2), 2);
			// Median (.50 percentile)
			$fieldStats[$field_name]['median'] = User::number_format_user(round(median($records), 2), 2);
			// Q3 (.75 percentile)
			$fieldStats[$field_name]['perc75'] = User::number_format_user(round(percentile($records, 75), 2), 2);
			// Lowest values
			for ($i = 0; $i < 5; $i++) {
				if (isset($records[$i])) {
					$fieldStats[$field_name]['low'][$i] = $records[$i];
				}
			}
			// Lowest values
			for ($i = $fieldStats[$field_name]['count']-5; $i < $fieldStats[$field_name]['count']; $i++) {
				if (isset($records[$i])) {
					$fieldStats[$field_name]['high'][$i] = $records[$i];
				}
			}
			// .05 percentile
			$fieldStats[$field_name]['perc05'] = User::number_format_user(round(percentile($records, 5), 2), 2);
			// .10 percentile
			$fieldStats[$field_name]['perc10'] = User::number_format_user(round(percentile($records, 10), 2), 2);
			// .90 percentile
			$fieldStats[$field_name]['perc90'] = User::number_format_user(round(percentile($records, 90), 2), 2);
			// .95 percentile
			$fieldStats[$field_name]['perc95'] = User::number_format_user(round(percentile($records, 95), 2), 2);
		}
		// Categorical fields: Get counts/frequency
		elseif ($isMCfield)
		{
			// Initialize the enum data array with 0s
			$enum_counts = array();
			foreach (array_keys($choices) as $this_code)
			{
				$enum_counts[$this_code] = 0;
			}
			// Now loop through all data and count each category
			foreach ($records as $this_value)
			{
				// Make sure it's a real category before incrementing the count
				if (is_array($this_value)) {
					// Checkbox
					foreach ($this_value as $this_value2) {
						if (isset($enum_counts[$this_value2])) {
							$enum_counts[$this_value2]++;
						}
					}
				} else {
					// Non-checkbox
					if (isset($enum_counts[$this_value])) {
						$enum_counts[$this_value]++;
					}
				}
			}
			// Display each categories count and frequency (%)
			$enum_freq = array();
			$enum_total_count = $fieldStats[$field_name]['count'];
			foreach ($enum_counts as $this_code=>$this_count)
			{
				$enum_freq[] = "<span style='color:#C00000;'>{$choices[$this_code]}</span>
								($this_count, " . User::number_format_user(round($this_count/$enum_total_count*100, 1), 1) . "%)";
			}
			// Set the string for the count/frequency
			$fieldStats[$field_name]['freq'] = $enum_freq;

			// SURVEYS ONLY: If this is a survey field with the "check diversity" feature enabled, then check for diversity
			if (!isset($fieldStats[$field_name]['hide']) && isset($check_diversity_view_results) && $check_diversity_view_results)
			{
				// Make sure that there is diversity in the choices selected (i.e. that a single choice doesn't have ALL the responses)
				foreach ($enum_counts as $this_choice=>$this_count)
				{
					// If a single choice has all responses in it, then we are lacking diversity, so don't show chart
					if ($this_count == $enum_total_count)
					{
						$fieldStats[$field_name]['hide'] = true;
					}
					// Now, if an individual response exists for this field, then make sure that a single choice doesn't
					// have ALL responses with the EXCEPTION of the participant's response.
					if (isset($respondent_data[$field_name]) && $this_count == ($enum_total_count - 1))
					{
						if (($field_type == 'checkbox' && !in_array($this_choice, $respondent_data[$field_name]))
						||  ($field_type != 'checkbox' && $respondent_data[$field_name] != $this_choice))
						{
							$fieldStats[$field_name]['hide'] = true;
						}
					}
				}
			}
		}

		// Remove from array to clear up memory
		unset($data[$field_name]);
	}

	// Return the array
	return $fieldStats;
}

// Individual Plots (Google Chart Tools)
function chartData($fields, $group_id="", $includeRecordsEvents=array(), $hasFilterWithNoRecords=false)
{
	global $Proj;
	
	// Get any repeating forms/events
	$RepeatingFormsEvents = $Proj->getRepeatingFormsEvents();

	// Determine if this is being displayed for a survey
	$isSurveyPage = (isset($_GET['s']) && defined("NOAUTH") && isset($_POST['isSurveyPage']) && $_POST['isSurveyPage']);

	// Get first field in the list that was sent (this is the current field we're displaying)
	if(strstr($fields, ','))
	{
		list ($field, $fields) = explode(",", $fields, 2);
	}
	// no comma, must be the last field
	else
	{
		$field = $fields;
		$fields = '';
	}

	// Obtain field attributes
	if (!isset($Proj->metadata[$field])) return '[]';
	$field_type = $Proj->metadata[$field]['element_type'];

	// First get the form that has this field
	$form = $Proj->metadata[$field]['form_name'];

	// If $includeRecordsEvents is passed and not empty, then it will be the record/event whitelist
	$checkIncludeRecordsEvents = (!empty($includeRecordsEvents));

	// SURVEYS ONLY: See if the "lacking diversity" feature is enabled, and set flag to prevent bar chart from displaying data
	if ($isSurveyPage)
	{
		// Get the survey_id
		$survey_id = $Proj->forms[$form]['survey_id'];
		// Check if feature is enabled
		$check_diversity_view_results = $Proj->surveys[$survey_id]['check_diversity_view_results'];
	}

	// Determine plot type
	$plotType = ($field_type != "text" && $field_type != "calc" && $field_type != "slider") ? "BarChart" : "BoxPlot";

	// Load defaults for the bar charts
	if ($plotType == "BarChart")
	{
		// Initialize the enum data array with 0s
		$choices = parseEnum($Proj->metadata[$field]['element_enum']);
		$data = array();
		foreach (array_keys($choices) as $this_code)
		{
			$data[$this_code] = 0;
		}
	}

	// Limit records pulled only to those in user's Data Access Group
	if ($group_id == "") {
		$group_sql = "";
	} else {
		$group_sql = "and record in (" . pre_query2("select record from redcap_data where project_id = " . PROJECT_ID . " and field_name = '__GROUPID__' and value = '$group_id'") . ")";
	}

	// Query to pull all existing data (pull differently if a "checkbox" field)
	$sql = "select distinct record, event_id, value, instance from redcap_data where project_id = " . PROJECT_ID . "
			and field_name = '$field' $group_sql";
	// If there is a filter being used in which no records are being returned, then force the query to return 0 rows.
	if ($hasFilterWithNoRecords) $sql .= " and 1 = 2";
	// Execute the query
	$res = db_query($sql);
	if (!$res) return '[]';

	## If need to return a single record's data, then retrieve it to send back in JSON data
	// If this is a survey participant viewing their data
	$this_record_data = array();
	$raw_data_single = '';
	if (isset($_GET['s']) && isset($_GET['__results']) && isset($_POST['results_code_hash']))
	{
		// Check results code hash
		if (checkResultsCodeHash($_GET['__results'], $_POST['results_code_hash']))
		{
			// Obtain name of record and event_id
			$sql = "select r.record, e.event_id
					from redcap_surveys_participants p, redcap_surveys_response r, redcap_events_metadata e
					where r.participant_id = p.participant_id and p.hash = '" . prep($_GET['s']) . "'
					and r.results_code = '" . prep($_GET['__results']) . "'
					and e.event_id = p.event_id order by e.day_offset, e.descrip limit 1";
			$q = db_query($sql);
			if (db_num_rows($q) > 0)
			{
				$record   = db_result($q, 0, 'record');
				$event_id = db_result($q, 0, 'event_id');
			}
		}
	}
	// Get the record and event_id from Post
	elseif (isset($_GET['record']) && isset($_GET['event_id']) && is_numeric($_GET['event_id']))
	{
		$record = $_GET['record'];
		$event_id = $_GET['event_id'];
	}
	// If record/event_id have been set, get the record's data
	if (isset($record) && isset($event_id))
	{
		// Obtain data for this field for this record-event
		$sql = "select value from redcap_data where project_id = " . PROJECT_ID . " and
				record = '" . prep($record) . "' and event_id = $event_id
				and field_name = '$field' and value != '' order by instance limit 1";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			if ($plotType == "BarChart") {
				$this_label = $choices[$row['value']];
				$this_record_data[$this_label] = true;
				$respondent_choice = $row['value'];
			} elseif ($plotType == "BoxPlot" && is_numeric($row['value'])) {
				$raw_data_single = $row['value'];
			}
		}
	}

	// Default
	$show_chart = true;

	// If this is a text field with non-numerical validation, then definitely don't show a chart
	if ($Proj->metadata[$field]['element_type'] == 'text' && $Proj->metadata[$field]['element_validation_type'] != '') {
		// Create array of validation types with "number" data type
		$valtypes = getValTypes();
		$numbervaltypes = array('int', 'float');
		foreach ($valtypes as $valtype=>$attr) {
			if ($attr['data_type'] == 'number' || $attr['data_type'] == 'integer') {
				$numbervaltypes[] = $valtype;
			}
		}
		// Has non-numerical validation?
		if (!in_array($Proj->metadata[$field]['element_validation_type'], $numbervaltypes)) {
			$show_chart = false;
		}
	}

	// Create the raw data array in JSON format
	$raw_data = array();

	// Bar Chart
	if ($plotType == "BarChart")
	{
		// Loop through all stored data
		while ($ret = db_fetch_assoc($res))
		{
			if ($ret['value'] == '') continue;
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
						continue;
					}
				}
				// Non-repeating
				elseif (!isset($includeRecordsEvents[$ret['record']][$ret['event_id']])) {
					continue;
				}
			}			
			if (isset($choices[$ret['value']]))
			{
				$data[$ret['value']]++;
			}
		}
		db_free_result($res);
		// Get total count of all valuess
		$total_counts = array_sum($data);
		// SURVEYS ONLY: If this is a survey field with the "check diversity" feature enabled, then check for diversity
		if (isset($check_diversity_view_results) && $check_diversity_view_results)
		{
			// Make sure that there is diversity in the choices selected (i.e. that a single choice doesn't have ALL the responses)
			foreach ($data as $this_choice=>$this_count)
			{
				// If a single choice has all responses in it, then we are lacking diversity, so don't show chart
				if ($show_chart && $this_count == $total_counts)
				{
					$show_chart = false;
				}
				// Now, if an individual response is being overlaid onto the plots, then make sure that a single choice doesn't
				// have ALL responses with the EXCEPTION of the participant's response.
				if ($show_chart && isset($respondent_choice) && $respondent_choice != $this_choice && $this_count == ($total_counts - 1))
				{
					$show_chart = false;
				}
			}
			// If we should not show the chart's data, then set all data to 0's
			if (!$show_chart)
			{
				foreach ($data as $this_choice=>$this_count)
				{
					$data[$this_choice] = 0;
				}
			}
		}
		// If there is no data, then don't show chart
		if ($show_chart && $total_counts == 0)
		{
			$show_chart = false;
		}
		// Minimum value is always 0 for bar charts
		$val_min = 0;
		// If showing chart, then format the data to send
		if ($show_chart)
		{
			// Loop and add data to array
			foreach (array_combine($choices, $data) as $this_label=>$this_value)
			{
				// Get maximum value
				if (!isset($val_max) || (isset($val_max) && $this_value > $val_max))
				{
					$val_max = $this_value;
				}
				// If we're adding a single respondent's data, then add as third element and subtract one from aggregate (to prevent counting it twice)
				if ($show_chart && isset($this_record_data[$this_label])) {
					$respondent_value = 1;
					// For Pie Charts, do not subtract the respondent's data from the total because Pie Charts can't stack like Bar Charts can
					if ($_POST['charttype'] != 'PieChart') {
						$this_value--;
					}
				} else {
					$respondent_value = 0;
				}
				// Clean the label and escape any double quotes
				$this_label = str_replace(array("\r\n", "\n", "\t"), array(" ", " ", " "), strip_tags(label_decode($this_label)));
				// If the respondent selected this choice (or is the choice of the selected record), then put asterisks around it, etc.
				if ($respondent_value) {
					$this_label  = "*" . $this_label . "* ";
					$this_label .= ($isSurveyPage ? $lang['graphical_view_75'] : $lang['graphical_view_76'] . " $record" . $lang['data_entry_163']);
				}
				// Add to array
				$raw_data[] = "[".json_encode($this_label).",$this_value,$respondent_value]";
			}
		}
	}
	// Box plot
	else
	{
		// Add values to array to calculate median
		$median_array = array();
		// Loop through all stored data
		while ($ret = db_fetch_assoc($res))
		{
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
						continue;
					}
				}
				// Non-repeating
				elseif (!isset($includeRecordsEvents[$ret['record']][$ret['event_id']])) {
					continue;
				}
			}
			if (is_numeric($ret['value']))
			{
				// Multiply by 1 just in case it somehow has a leading zero
				$this_value = $ret['value']*1;
				// Get minimum value
				if (!isset($val_min) || (isset($val_min) && $this_value < $val_min))
				{
					$val_min = $this_value;
				}
				// Get maximum value
				if (!isset($val_max) || (isset($val_max) && $this_value > $val_max))
				{
					$val_max = $this_value;
				}
				// Add to median array
				$median_array[] = $this_value;
				// Add to raw data array - set first value of pair as random number between 0 and 1
				// (Do not return a value if we're going to display the data point as separate - prevents duplication)
				if (!($raw_data_single == $this_value && isset($record) && isset($event_id) && $record == $ret['record'] && $event_id == $ret['event_id']))
				{
					if ($ret['instance'] == '') $ret['instance'] = 1;
					$raw_data[] = "[$this_value,".(rand(10, 90)/100).",\"".removeDDEending($ret['record'])."\",{$ret['event_id']},{$ret['instance']}]";
				}
			}
		}
		// Calculate median
		if (!empty($median_array))
		{
			$val_median = median($median_array);
		}
		// For sliders, manually set min/max as 0/100
		if ($field_type == 'slider')
		{
			$val_min = 0;
			$val_max = 100;
		}
	}

	// Set min/max if not already defined
	if (!isset($val_min)) 	 $val_min = 0;
	if (!isset($val_max)) 	 $val_max = 0;
	if (!isset($val_median)) $val_median = '""';

	// Send back JSON
	return  '{"field":"' . $field . '","form":"' . $form . '","plottype":"' . $plotType . '","min":' . $val_min . ',"max":' . $val_max . ',"median":' . $val_median . ','
		  . '"nextfields":"' . $fields . '","data":[' . implode(',', $raw_data) . '],"respondentData":"' . $raw_data_single . '",'
		  . '"showChart":' . ($show_chart ? 1 : 0) . '}';

}



/**
 * Run single-field query and return comma delimited set of values (to be used inside other query for better performance than using subqueries)
 */
function pre_query2($sql) {
	if (trim($sql) == "" || $sql == null) return "''";
	$q = db_query($sql);
	$val = "";
	if (db_num_rows($q) > 0) {
		while ($row = db_fetch_array($q)) {
			$val .= "'" . $row[0] . "', ";
		}
		$val = substr($val, 0, -2);
	}
	return ($val == "") ? "''" : $val;
}



// Calculate Total Records in Project (numbers may differ from form to form for longitudinal projects)
function getRecordCountByForm()
{
	global $Proj, $table_pk, $user_rights, $longitudinal;

	//Limit records pulled only to those in user's Data Access Group
	$group_sql  = "";
	if ($user_rights['group_id'] != "") {
		$group_sql = "and d.record in (" . pre_query("select record from redcap_data where field_name = '__GROUPID__' and value = '{$user_rights['group_id']}' and project_id = ".PROJECT_ID) . ")";
	}
	if ($longitudinal) {
		$sql = "select x.form_name, count(*) as record_count from 
				(select distinct e.event_id, d.record, m.form_name, d.instance 
				from redcap_events_forms f, redcap_events_metadata e, redcap_data d, redcap_metadata m 
				where d.project_id = ".PROJECT_ID." and d.project_id = m.project_id and f.event_id = e.event_id and d.field_name = m.field_name and m.form_name = f.form_name 
				and d.event_id = e.event_id and d.value != '' and d.field_name != '$table_pk' $group_sql) x group by x.form_name";
	} else {
		$sql = "select x.form_name, count(*) as record_count from (select distinct d.record, d.event_id, m.form_name, d.instance 
				from redcap_data d, redcap_metadata m 
				where d.project_id = ".PROJECT_ID." and d.project_id = m.project_id and d.field_name = m.field_name 
				and d.value != '' and d.field_name != '$table_pk' $group_sql) x group by x.form_name";
	}
	$q = db_query($sql);
	$forms_count = array();
	while ($row = db_fetch_assoc($q)) {
		$forms_count[$row['form_name']] = $row['record_count'];
	}
	// Make sure we add placeholder to forms without data
	foreach (array_keys(array_diff_key($Proj->forms, $forms_count)) as $this_form) {
		$forms_count[$this_form] = 0;
	}
	// Return array of forms with records count for each
	return $forms_count;
}


// Obtain the fields to chart
function getFieldsToChart($project_id, $form="", $field_list=array())
{
	global $table_pk;

	if (!is_numeric($project_id)) return false;

	// If $field_list was provided, then ignore $form
	if (empty($field_list) && $form != "") {
		$sqlsub = "and form_name = '".prep($form)."'";
		$use_field_list = false;
	} else {
		$sqlsub = "and field_name in (".prep_implode($field_list).")";
		$use_field_list = true;
	}

	// Query to get fields
	$fields = array();
	$sql = "select field_name from redcap_metadata where project_id = $project_id $sqlsub
			and field_name != '$table_pk' and element_type != 'file' and element_type != 'sql'
			and element_type != 'descriptive' order by field_order";
	$qrs = db_query($sql);
	while ($rs = db_fetch_assoc($qrs))
	{
		$fields[$rs['field_name']] = true;
	}

	// If was provided with explicit list of fields in array, then preserve their order
	if ($use_field_list) {
		foreach ($field_list as $key=>$this_field) {
			if (!isset($fields[$this_field])) {
				// Remove field from array
				unset($field_list[$key]);
			}
		}
		$fields = array_values($field_list);
	} else {
		$fields = array_keys($fields);
	}

	// Return array
	return $fields;
}

// Render charts
function renderCharts($project_id, $totalrecs, $fields, $form="", $includeRecordsEvents=array(), $hasFilterWithNoRecords=false)
{
	global $Proj, $lang, $user_rights, $enable_plotting, $table_pk, $table_pk_label, $view_results, $longitudinal, $double_data_entry;

	// Determine if this is the survey page
	$isSurveyPage = (PAGE == 'surveys/index.php');

	// Determine if we should display the Google Chart Tools plots
	$displayGCTplots = ((!$isSurveyPage && $enable_plotting == '2') || ($isSurveyPage && ($view_results == '1' || $view_results == '3')));

	// Determine if we should display the Stats tables
	$displayStatsTables = ((!$isSurveyPage && $enable_plotting == '2') || ($isSurveyPage && ($view_results == '2' || $view_results == '3')));

	// Set array to discern what are categorical fields
	$mc_field_types = array("radio", "select", "dropdown", "yesno", "truefalse", "checkbox");

	// Get results code hash, if applicable
	$results_code_hash = ($isSurveyPage && isset($_POST['results_code_hash'])) ? $_POST['results_code_hash'] : '';

	// Create array of validation types to reference later
	$valtypes = getValTypes();

	// Call the Google Chart Tools javascript
	if ($displayGCTplots)
	{
		print "<script type='text/javascript' src='" . APP_PATH_JS . "charts.js'></script>";
		// Create array for storing the names of all fields with plots displayed on the page
		$fieldsDisplayed = array();
	}

	// Ensure that the user has form-level access to each field's form. If they don't, then remove the field.
	if ($form == '' && !empty($fields)) {
		// Loop through fields
		foreach ($fields as $key=>$this_field) {
			$this_form = $Proj->metadata[$this_field]['form_name'];
			if ($user_rights['forms'][$Proj->metadata[$this_field]['form_name']] == '0') {
				unset($fields[$key]);
			}
		}
	}

	// Obtain the descriptive stats (i.e. new expanded stats)
	if ($displayStatsTables)
	{
		$descripStats = getDescriptiveStats($fields, $totalrecs, $form, $includeRecordsEvents, $hasFilterWithNoRecords);
	}

	// Add includeRecordsEvents as a JS variable that we can use in AJAX requests on this page if the data is limited
	// using filters in the report. This allows us to be more efficient than to rebuilt $includeRecordsEvents with each AJAX request.
	print "<script type='text/javascript'>var hasFilterWithNoRecords = ".($hasFilterWithNoRecords ? 1 : 0)."; "
		. "var includeRecordsEvents = '".cleanHtml(encrypt(serialize($includeRecordsEvents)))."';</script>";

	## Build array with number of non-missing records for each field on this form
	//Limit records pulled only to those in user's Data Access Group
	if ($user_rights['group_id'] == "") {
		$group_sql  = "";
	} else {
		$group_sql  = "and d.record in (" . pre_query("select record from redcap_data where project_id = $project_id and field_name = '__GROUPID__' and value = '{$user_rights['group_id']}'"). ")";
	}

	// Query to calculate the found values for checkboxes (must deal with them differently)
	$chkbox_found = array();
	// First check if any checkboxes exist on this form (if not, skip a query for performance)
	$formHasCheckboxes = false;
	foreach ($fields as $this_field) {
		if (!$Proj->isCheckbox($this_field)) continue;
		$formHasCheckboxes = true;
		break;
	}
	if ($formHasCheckboxes)
	{
		$sql = "select x.field_name, count(1) as count from (select d.field_name, concat(d.event_id,'-',d.record,'-',d.field_name) as new1
				from redcap_data d, redcap_metadata m where m.project_id = $project_id and m.project_id = d.project_id and
				d.field_name = m.field_name and m.element_type = 'checkbox' $group_sql group by new1) as x group by x.field_name";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$chkbox_found[$row['field_name']] = $row['count'];
		}
	}

	?>
	<!-- Invisible div "template" to insert into a plot's div if plot shouldn't be displayed -->
	<div id="no_show_plot_div" style="display:none;">
		<p style="color:#777;font-size:11px;">
			<?php echo ($isSurveyPage ? $lang['survey_202'] : $lang['survey_206']) ?>
		</p>
	</div>
	<?php


	// Options to show/hide plots and stats tables (GCT only)
	if ((!$isSurveyPage && $enable_plotting == '2') || ($isSurveyPage && $view_results == '3'))
	{
		// Create drop-down options of all forms
		$formDropdownOptions = array(''=>$lang['graphical_view_44']);
		foreach ($Proj->forms as $this_form=>$attr) {
			// Don't show if user has None rights to this form
			if (isset($user_rights['forms'][$this_form]) && $user_rights['forms'][$this_form] > 0) {
				$formDropdownOptions[$this_form] = $attr['menu'];
			}
		}
		// DDE: If user is DDE person 1 or 2, then limit to ONLY their records
		$dde_filter = "";
		if ($double_data_entry && is_array($user_rights) && $user_rights['double_data'] != 0) {
			$dde_filter = "ends_with([{$Proj->table_pk}], \"--{$user_rights['double_data']}\")";
		}
		// Create drop-down options for the records in this report
		$allRecordsEvents = Records::getData('array', array_keys($includeRecordsEvents), $table_pk, array(), $user_rights['group_id'], false, false, false, $dde_filter);
		$allRecordsEventsOptions = array(''=>$lang['data_entry_91']);
		foreach ($allRecordsEvents as $this_record=>$eattr) {
			foreach (array_keys($eattr) as $this_event_id) {
				$allRecordsEventsOptions[$this_event_id.'[__EVTID__]'.$this_record] = removeDDEending($this_record) . ($longitudinal ? " - ".$Proj->eventInfo[$this_event_id]['name_ext'] : '');
			}
		}
		// Get number of forms in this project
		$numForms = count($Proj->forms);
		// For ALL report, if project has just one form, then set it manually rather than forcing user to select it
		if ($_GET['report_id'] == 'ALL' && $numForms == 1) {
			$_GET['page'] = $Proj->firstForm;
		}
		// Set disabled attribute for record drop-down
		$recordDropdownDisabled = ($_GET['report_id'] == 'ALL' && $numForms > 1 && (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == ''))) ? 'disabled' : '';
		// Display table of display options
		print 	RCView::div(array('id'=>"showPlotsStatsOptions", 'style'=>"margin:15px 0 25px;max-width:720px;"),
					RCView::table(array('class'=>'form_border', 'style'=>"width:100%;"),
						// Header
						($isSurveyPage ? '' :
							RCView::tr(array(),
								RCView::td(array('class'=>'header', 'colspan'=>'2'),
									$lang['graphical_view_61']
								)
							)
						) .
						// Display list of forms ONLY for report_id=ALL
						(!($_GET['report_id'] == 'ALL' && $numForms > 1) ? '' :
							RCView::tr(array(),
								RCView::td(array('class'=>'labelrc', 'style'=>"padding:10px 8px;"),
									$lang['graphical_view_43']
								) .
								RCView::td(array('class'=>'labelrc', 'style'=>"padding:10px 8px;"),
									RCView::select(array('class'=>'x-form-text x-form-field', 'style'=>'', 'onchange'=>"
										showProgress(1);
										window.location.href = app_path_webroot + page + '?pid='+pid+'&report_id=ALL&stats_charts=1&page='+this.value;
									"), $formDropdownOptions, $_GET['page'])
								)
							)
						) .
						// Display list of records (but not on surveys)
						($isSurveyPage ? '' :
							RCView::tr(array(),
								RCView::td(array('class'=>'labelrc', 'style'=>"padding:10px 8px;font-weight:normal;"),
									$lang['graphical_view_60']
								) .
								RCView::td(array('class'=>'labelrc', 'style'=>"padding:10px 8px;"),
										RCView::select(array($recordDropdownDisabled=>$recordDropdownDisabled, 'class'=>'x-form-text x-form-field', 'style'=>'', 'onchange'=>"
											showProgress(1);
											var recevturl = '';
											if (this.value.length > 0) {
												var recevt = this.value.split('[__EVTID__]');
												recevturl = '&record='+recevt[1]+'&event_id='+recevt[0];
											}
											window.location.href = app_path_webroot + page + '?pid='+pid+'&report_id='+getParameterByName('report_id') + '&stats_charts=1'
												+ (getParameterByName('page') == '' ? '' : '&page='+getParameterByName('page'))
												+ (getParameterByName('instruments') == '' ? '' : '&instruments='+getParameterByName('instruments'))
												+ recevturl;
										"), $allRecordsEventsOptions, (isset($_GET['event_id']) ? $_GET['event_id'] : '') . '[__EVTID__]' . (isset($_GET['record']) ? $_GET['record'] : ''))
								)
							)
						) .
						// Viewing options: Show plots and/or stats
						RCView::tr(array(),
							RCView::td(array('class'=>'labelrc', 'colspan'=>'2', 'style'=>"padding:10px 8px;"),
								$lang['graphical_view_65'] .
								RCView::button(array('class'=>'jqbuttonmed', 'disabled'=>'disabled', 'style'=>'color:#800000;margin-left:10px;font-weight:normal;', 'onclick'=>"showPlotsStats(3,this);"), $lang['graphical_view_66']) .
								RCView::button(array('class'=>'jqbuttonmed', 'style'=>'color:#008000;margin-left:10px;font-weight:normal;', 'onclick'=>"showPlotsStats(1,this);"), $lang['graphical_view_67']) .
								RCView::button(array('class'=>'jqbuttonmed', 'style'=>'color:#000080;margin-left:10px;font-weight:normal;', 'onclick'=>"showPlotsStats(2,this);"), $lang['graphical_view_68'])
							)
						)
					)
				);
		// If displaying NOTHING because form hasn't yet been selected on report_id=ALL, then display message.
		if ($_GET['report_id'] == 'ALL' && (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == ''))) {
			print 	RCView::div(array('style'=>"max-width:700px;margin:15px 0 25px;color:#C00000;"),
						$lang['report_builder_104']
					);
		}
	}

	// Loop through all fields on this form
	$s = 0;
	foreach ($fields as $field_name)
	{
		// Skip record_id field
		if ($field_name == $table_pk) continue;
		// Set field attributes
		$field_attr = array(); //reset from previous loop
		$field_id = $Proj->metadata[$field_name]['field_order'];
		$field_form = $Proj->metadata[$field_name]['form_name'];
		$element_label = strip_tags(label_decode($Proj->metadata[$field_name]['element_label']));
		$validation_type = $Proj->metadata[$field_name]['element_validation_type'];
		$element_type = $Proj->metadata[$field_name]['element_type'];
		$element_enum = $Proj->metadata[$field_name]['element_enum'];
		// Set plot variables
		$missing_id = "dc_missing_$field_id";
		$spin_missing_id = "dc_spin_missing_$field_id";
		$high_id =  "dc_high_$field_id";
		$spin_high_id = "dc_spin_high_$field_id";
		$low_id = "dc_low_$field_id";
		$spin_low_id = "dc_spin_low_$field_id";
		$refresh_plot_id = "dc_refresh_$field_id";
		$spinner_plot_id = "dc_spin_refresh_$field_id";
		$img_plot_id = "dc_img_refresh_$field_id";


		// SURVEYS ONLY: Ignore the Form Status field
		if ($isSurveyPage && $field_name == $form."_complete") continue;

		// Check if this field is plottable (i.e. not free-form text)
		$isPlottable = (in_array($element_type, $mc_field_types) || $validation_type == 'float' || $validation_type == 'int'
		|| (isset($validation_type) && $valtypes[$validation_type]['data_type'] == 'number') || $element_type == 'calc' || $element_type == 'slider');

		// Determine if we should display the plot
		$will_plot = (!(($element_type == 'text' || $element_type == 'textarea') && $validation_type == ''));

		// Graphical page: Show it for GCT (because we'll show stats table).
		// Survey page: If field is not plottable, only show the field if we're showing the stats table.
		if (!$will_plot && (!$displayGCTplots || ($isSurveyPage && $displayGCTplots && !$displayStatsTables && !$isPlottable)))
		{
			continue;
		}

		//Don't show plot if a multiple choice values are non-numerical (e.g., A | B | C)
		// if (in_array($element_type, $mc_field_types) && trim($element_enum) != "")
		// {
			// if (!is_numeric(substr(trim($element_enum), 0, 1))) {
				// $will_plot = false;
			// }
		// }

		//Determine type of plot to display
		$plot_type = 'BarChartDesc';
		if ($will_plot && $element_type != 'checkbox' && $element_type != 'truefalse' && $element_type != 'yesno' && $element_type != 'select' && $element_type != 'radio' && $element_type != 'advcheckbox') {
			$plot_type = 'BoxPlotDesc';
		}

		// Set "Refresh" link's action
		$pie_chart = "";
		if ($displayGCTplots && !isset($field_attr['hide'])) {
			$refreshPlot = "showSpinner('$field_name');renderCharts('$field_name',$('#chart-select-$field_name').val(),'$results_code_hash');";
			// Give option for bar charts to be viewed as pie charts (exclude checkboxes from being viewed as pie charts
			// because the percentages add up to higher than 100% due to multiple responses per record - Google Charts just won't work with this)
			if ($will_plot && $plot_type == 'BarChartDesc' && $element_type != 'checkbox')
			{
				if (!$isSurveyPage) $pie_chart .= " | ";
				$pie_chart .=  "<select id='chart-select-$field_name' style='font-size:11px;' onchange=\"showSpinner('$field_name');renderCharts('$field_name',this.value,'$results_code_hash');return false;\">
									<option value='BarChart' selected>{$lang['graphical_view_49']}</option>
									<option value='PieChart'>{$lang['graphical_view_50']}</option>
								</select>";
			}
		}

		?>
		<!-- Line separator -->
		<div class="spacer"></div>

		<!-- Field label and links -->
		<p class="dc_para">
			<!-- Field label -->
			<b class="dc_header notranslate"><?php print $element_label ?></b>
			<?php
			// Refresh link
			if ($will_plot && $displayGCTplots && !isset($field_attr['hide'])) {
				?>
				<a href="javascript:;" class="dc_a hide_in_print" style="margin:0 3px 0 10px;" id="<?php echo "refresh-link-".$field_name ?>" onclick="<?php echo $refreshPlot ?>return false;"><?php echo $lang['graphical_view_35'] ?></a>
				<?php
			}
			// Display option to view as Pie Chart (for GCT Bar Charts only)
			echo RCView::span(array('class'=>'hide_in_print'), $pie_chart);
			?>
		</p>

		<?php

		// Display the plot div
		if ($will_plot || $displayGCTplots || $displayStatsTables)
		{
			// Google Chart Tools (via ajax)
			if ($displayGCTplots || $displayStatsTables)
			{
				## DESCRIPTIVE STATS TABLE FOR THIS FIELD
				if ($displayStatsTables)
				{
					// Set this field's statistical values
					$field_attr = $descripStats[$field_name];

					// MISSING value: If we're viewing the project Graphical page and using GCT, show Missing value as link to retrieve missing values
					// Set missing percent value
					$field_attr['missing_perc'] = round($field_attr['missing']/($field_attr['count']+$field_attr['missing'])*100,1);
					if ($field_attr['missing_perc'] < 0 || is_nan($field_attr['missing_perc'])) $field_attr['missing_perc'] = 0;
					// Now set the label for missing and missing percent
					$missing_label = $field_attr['missing'] . " (" . User::number_format_user($field_attr['missing_perc'], 1) . "%)";
					// Display the missing label
					if ($isSurveyPage || $field_attr['missing'] == 0) {
						$field_attr['missing'] = $missing_label;
					} else {
						$field_attr['missing'] = "<a title=\"".cleanHtml2($lang['graphical_view_71'])."\" href='javascript:;' class='dc_a' onclick=\"ToggleDataCleanerDiv(table_pk_label,'".cleanHtml("<b>{$lang['graphical_view_36']}:</b>")." ','$missing_id','$spin_missing_id','$field_name','miss','$field_form','{$user_rights['group_id']}');\">$missing_label</a> ";
					}
					// Determine if we can show the table
					if (!isset($field_attr['hide']))
					{
						?>
						<div style="padding:10px 0;" class="descrip_stats_table" id="stats-<?php echo $field_name ?>">
							<?php if ($field_attr['getstats']) { ?>
								<!-- Numerical stats table -->
								<table class="expStatsReport">
									<tr style='font-weight:bold;font-size:12px;'>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_69'] ?><br>(N)</td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_24'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_51'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_25'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_26'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_27'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_29'] ?></td>
										<td rowspan="2" style="background-color:#eee;"><?php echo $lang['graphical_view_74'] ?></td>
										<td colspan="7" style="background-color:#ddd;"><?php echo $lang['graphical_view_53'] ?></td>
									</tr>
									<tr style='font-weight:bold;font-size:12px;'>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.05', 2) ?></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.10', 2) ?></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.25', 2) ?></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.50', 2) ?><div style="font-weight:normal;"><?php echo $lang['graphical_view_28'] ?></div></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.75', 2) ?></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.90', 2) ?></td>
										<td style="background-color:#eee;"><?php echo User::number_format_user('0.95', 2) ?></td>
									</tr>
									<tr>
										<td><?php echo User::number_format_user($field_attr['count']) ?></td>
										<td><?php echo $field_attr['missing'] ?></td>
										<td><?php echo $field_attr['unique'] ?></td>
										<td><?php echo $field_attr['min'] ?></td>
										<td><?php echo $field_attr['max'] ?></td>
										<td><?php echo $field_attr['mean'] ?></td>
										<td><?php echo $field_attr['stdev'] ?></td>
										<td><?php echo $field_attr['sum'] ?></td>
										<td><?php echo $field_attr['perc05'] ?></td>
										<td><?php echo $field_attr['perc10'] ?></td>
										<td><?php echo $field_attr['perc25'] ?></td>
										<td><?php echo $field_attr['median'] ?></td>
										<td><?php echo $field_attr['perc75'] ?></td>
										<td><?php echo $field_attr['perc90'] ?></td>
										<td><?php echo $field_attr['perc95'] ?></td>
									</tr>
								</table>
								<br>
								<!-- Invisible section for MISSING values to be loaded -->
								<img class="dc_img_spinner" id="<?php echo $spin_missing_id ?>" src="<?php echo APP_PATH_IMAGES ?>progress_circle.gif">
								<div style="max-width:700px;display:none;" id="<?php echo $missing_id?>"></div>
								<?php if (!empty($field_attr['low'])) { ?>
									<!-- Lowest values -->
									<div style="padding:5px 0;">
										<?php echo "<b>{$lang['graphical_view_37']}:</b> " . implode(", ", $field_attr['low']); ?>
									</div>
								<?php } ?>
								<?php if (!empty($field_attr['high'])) { ?>
									<!-- Highest values -->
									<div>
										<?php echo "<b>{$lang['graphical_view_38']}:</b> " . implode(", ", $field_attr['high']); ?>
									</div>
								<?php } ?>
							<?php } else { ?>
								<!-- Categorical/text field stats table -->
								<table class="expStatsReport">
									<tr style='font-weight:bold;font-size:12px;'>
										<td style="background-color:#eee;"><?php echo $lang['graphical_view_69'] ?><br>(N)</td>
										<td style="background-color:#eee;"><?php echo $lang['graphical_view_24'] ?></td>
										<?php if (isset($field_attr['unique'])) { ?>
											<td style="background-color:#eee;"><?php echo $lang['graphical_view_51'] ?></td>
										<?php } ?>
									</tr>
									<tr>
										<td><?php echo User::number_format_user($field_attr['count']) ?></td>
										<td><?php echo $field_attr['missing'] ?></td>
										<?php if (isset($field_attr['unique'])) { ?>
											<td><?php echo $field_attr['unique'] ?></td>
										<?php } ?>
									</tr>
								</table>
								<br>
								<!-- Invisible section for MISSING values to be loaded -->
								<img class="dc_img_spinner" id="<?php echo $spin_missing_id ?>" src="<?php echo APP_PATH_IMAGES ?>progress_circle.gif">
								<div style="max-width:700px;display:none;" id="<?php print $missing_id?>"></div>
								<?php if (isset($field_attr['freq'])) { ?>
									<!-- Categorical counts/frequencies -->
									<div style="padding:5px 0;max-width:700px;">
										<?php echo "<b>{$lang['graphical_view_52']}</b> " . implode(", ", $field_attr['freq']); ?>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<?php
					}
				}

				## PLOT THIS FIELD
				if ($will_plot && $displayGCTplots && !isset($field_attr['hide']))
				{
					// Add field name to array for making the ajax call
					$fieldsDisplayed[] = $field_name;
					// Plot it
					print "<div id='plot-$field_name' class='gct_plot'><img style='vertical-align: middle;' src='" . APP_PATH_IMAGES. "progress.gif' title='Loading...' alt='Loading...'></div>";
					// Download button
					print  "<div id='plot-download-btn-$field_name' class='plot-download-div'>
								<button class='jqbuttonmed' onclick=\"downloadImgViaDataUrl('plot-$field_name','$field_name');\">
									<img src='" . APP_PATH_IMAGES . "arrow_down_sm.png'>
									<span>{$lang['graphical_view_77']}</span>
								</button>
							</div>";
				}
			}
		}
		// HIDE FIELD: For questions with no data, give notice as to why no plot is being displayed.
		// Do not display this notice if has no unique stat value (i.e. it is a free-form text field)
		if (isset($field_attr['hide']) || (!$will_plot && $displayGCTplots && $isPlottable))
		{
			print "<div class='gct_plot' style='color:#777;font-size:11px;margin:20px 0;'>";
			print ($isSurveyPage ? $lang['survey_202'] : $lang['survey_206']);
			print "</div>";
		}
		// Increment the counter by amount of microseconds to pace requests to R/Apache server
		$s += (isset($plot_pace) ? $plot_pace : 1) * 1000;
	}

	// Build javascript that loads the plots
	if ($displayGCTplots)
	{
		?>
		<!-- Javascript -->
		<script type="text/javascript">
		// Comma-delimited list of all field plots on page
		var fields = '<?php echo implode(',', $fieldsDisplayed) ?>';
		// Determine if we're on the survey page
		var isSurveyPage = <?php echo ($isSurveyPage ? 'true' : 'false') ?>;
		// Begin the daisy-chained AJAX requests to load each plot one at a time
		$(function(){
			renderCharts(fields,'','<?php echo $results_code_hash ?>');
		});
		</script>
		<?php
	}

}


// Make sure that the results code hash belongs to __results in the survey URL
function checkResultsCodeHash($__results, $results_code_hash)
{
	// Return boolean if the submitted hash matches the expected hash (set both as upper case just in case of case different)
	return (strtoupper(getResultsCodeHash($__results)) == strtoupper($results_code_hash));
}

// Generate the results code hash that belongs to __results in the survey URL
function getResultsCodeHash($__results=null)
{
	global $__SALT__;
	if (empty($__results)) return false;
	// Use the project-level $__SALT__ variable to salt the md5 hash
	// Use the 10th thru 16th character of the md5 as the true results_code_hash
	return substr(md5($__SALT__ . $__results), 10, 6);
}


function validate_appname($app){
	$exist = db_result(db_query("select count(1) from redcap_projects where project_name = '$app'"), 0);
	return $exist;
}

# Presumes the current mysql connections
function validate_formname($app,$form){
	if (!validate_appname($app)) {
		return false;
	}
	$q = db_query("select 1 from redcap_metadata where form_name = '$form' and project_id = " . PROJECT_ID . " limit 1");
	return db_num_rows($q);
}

function validate_fieldname($app,$form,$field) {
	if (!validate_formname($app,$form)) {
		return false;
	}
	$q = db_query("select 1 from redcap_metadata where field_name = '$field' and form_name = '$form' and project_id = " . PROJECT_ID . " limit 1");
	return db_num_rows($q);
}
