<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Retrieve matching records to populate auto-complete box.
// Make sure field is valid and that user has data entry rights to the form this field is on.
if ($isAjax && isset($_GET['term']))
{
	// If field is passed, make sure it's valid for this project
	if (isset($_GET['field']) && $_GET['field'] != '' && (!isset($Proj->metadata[$_GET['field']])
		|| $user_rights['forms'][$Proj->metadata[$_GET['field']]['form_name']] == '0'))
	{
		exit('[]');
	}
	
	// Decode the search string
	$queryString = label_decode(urldecode($_GET['term']));
	$queryStringLength = strlen($queryString);

	// Retrieve record list (exclude non-DAG records if user is in a DAG)
	$group_sql = "";
	if ($user_rights['group_id'] != "") {
		$group_sql = "and record in (" . pre_query("select record from redcap_data where project_id = $project_id and field_name = '__GROUPID__'
					  and value = '" . $user_rights['group_id'] . "'") . ")";
	}

	// Modify SQL if using double data entry as DDE person
	$sql_dde_record_append = '';
	if ($double_data_entry && $user_rights['double_data'] != "0") {
		$sql_record_field = "substring(record,1,locate('--',record)-1) as record";
		$sql_dde_record_append = "and record like '%--{$user_rights['double_data']}'";
	} else {
		$sql_record_field = "record";
		$entry_num = "";
	}

	// Set the LIKE clause for the query
	$sql_value_like = "value like '%".prep($queryString)."%'";

	// Check if we should also search for the escaped value of the string
	$queryStringEscaped = htmlspecialchars($queryString, ENT_QUOTES);
	if ($queryString != $queryStringEscaped) {
		$sql_value_like .= " or value like '%".prep($queryStringEscaped)."%'";
	}

	// If query field is the table_pk and project is longitudinal, then only return a single entry for first event on each arm
	$sql_table_pk = "";
	if ($longitudinal && isset($_GET['field']) && $_GET['field'] == $table_pk) {
		// Get first event of each arm
		$firstEventInArms = array();
		foreach ($Proj->events as $this_arm=>$attr) {
			$firstEventInArms[] = array_shift(array_keys($attr['events']));
		}
		$sql_table_pk = "and event_id in (" . implode(",", $firstEventInArms) . ")";
	} elseif ($longitudinal) {
		$sql_table_pk = "and event_id in (" . implode(",", array_keys($Proj->eventInfo)) . ")";
	} elseif (!$longitudinal) {
		$sql_table_pk = "and event_id = " . $Proj->firstEventId;
	}
	
	// Search on specific field
	if (isset($_GET['field']) && $_GET['field'] != '') {
		$sql_field = "and field_name = '".prep($_GET['field'])."'";
	} else {
		// Build array of fields that user has read-only or edit access to
		$fields = "";
		$exclude_fieldtypes = array("file", "descriptive", "checkbox", "dropdown", "select", "radio", "yesno", "truefalse");
		foreach ($Proj->metadata as $field=>$row)
		{
			// Do not include certain field types
			if (in_array($row['element_type'], $exclude_fieldtypes)) continue;
			// Do not include fields from forms the user does not have access to
			if ($user_rights['forms'][$row['form_name']] == '0') continue;
			// Build list option
			$fields[] = $field;
		}
		$sql_field = "and field_name in (".prep_implode($fields).")";
	}

	// Query the project data
	$sql = "select distinct event_id, field_name, value, instance, $sql_record_field
			from redcap_data where project_id = $project_id $sql_field
			$group_sql and ($sql_value_like) $sql_dde_record_append $sql_table_pk
			order by abs(value), value, abs(record), record limit 0,15";
	//Execute query
	$q = db_query($sql);
	$rowcount = db_num_rows($q);
	$recs = array();
	$recinfo = array();
	if ($q && $rowcount > 0)
	{
		// Retrieve all matches
		while ($result = db_fetch_assoc($q))
		{
			// Set string to collect any custom labels to return
			$record_custom_labels = "";
			// Append secondary id, if set
			if ($secondary_pk != '')
			{
				$secondary_pk_val = $Proj->getSecondaryIdVal($result['record']);
				if ($secondary_pk_val != '') {
					$record_custom_labels .= " (" . $Proj->metadata[$secondary_pk]['element_label'] . " <b>$secondary_pk_val</b>)";
				}
			}
			// Append custom_record_label, if set
			if ($custom_record_label != '')
			{
				$record_custom_labels .= " " . filter_tags(getCustomRecordLabels($custom_record_label, $Proj->getFirstEventIdArm(getArm()),
					$result['record'].($double_data_entry && $user_rights['double_data'] != 0 ? '--'.$user_rights['double_data'] : '')));
			}
			// Set variables
			$form = $Proj->metadata[$result['field_name']]['form_name'];
			$record = $result['record'];
			$result_raw = decode_filter_tags($result['value']);
			$result_len = strlen($result_raw);

            // Truncate long results (centering around match)
            $prefix = "";
            $suffix = "";
            if ($result_len > 30) {

			    // Find where in the string the match occurs
                $match_pos = stripos($result_raw, $queryString);

                // Find out how many characters are left over on the right side of the match
                $remainder_right = $result_len - ( $match_pos + strlen($queryString) );

                // Calculate the equal padding around the match
                $padding_side = floor( (28 - strlen($queryString)) / 2);

                // If right-side padding falls over the length of the string, let's move that to the left
                if ($padding_side > $remainder_right) {
                    $padding_side = $padding_side + ($padding_side - $remainder_right);
                } else {
                    $suffix = "&hellip;";
                }

                // Start at 0 or further up if the match occurs late in the result string
                $start_pos = max (0, $match_pos - $padding_side);
                if ($start_pos > 0) $prefix = "&hellip;";

                // Build the result and add ellipses to start or end depending on context...
                $value = substr($result['value'], $start_pos, 28);
			} else {
			    $value = $result_raw;
            }

			// Set what will be seen by user in auto complete list
			$record_display = $table_pk_label . " <b>$record</b>" . "<i>$record_custom_labels</i>";

            // Append the event info if longitudinal
            if ($longitudinal) {
				$record_display .= " {$lang['global_108']} <span>" . decode_filter_tags($Proj->eventInfo[$result['event_id']]['name_ext']) . "</span>";
			}

            // Add boldness to search term
            $pos = stripos($value, $queryString);
            if ($pos === false) {
                // Do not try to highlight results
                $label = htmlentities($value);
            } else {
                // Highlight search match
                $label = htmlentities(substr($value, 0, $pos))
                    . "<b style='color:#319AFF;'>"
                    . htmlentities(substr($value, $pos, $queryStringLength))
                    . "</b>"
                    . htmlentities(substr($value, $pos+$queryStringLength));
            }

			// Set label
            $label = "&quot;" . $prefix . $label . $suffix . "&quot; " . $lang['global_107'].' ' . $record_display;

			// Instance
			if ($result['instance'] == '') $result['instance'] = '1';
			// Set the record, event_id, and form (delimited with a pipe)
			$recinfo[] = array('value'=>"{$result['instance']}|$form|{$result['event_id']}|$record", 'label'=>$label);
		}
	}

	//Render JSON
	print json_encode($recinfo);
}
elseif ($isAjax) 
{
	print '[]';
}
else
{
	// User should not be here! Redirect to index page.
	redirect(APP_PATH_WEBROOT . "index.php?pid=$project_id");
}