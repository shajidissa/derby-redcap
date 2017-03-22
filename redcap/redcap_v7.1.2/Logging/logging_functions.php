<?php

function renderLogRow($row, $html_output=true)
{
	global 	$lang, $longitudinal, $user_rights, $double_data_entry, $multiple_arms,
			$require_change_reason, $event_ids, $Proj, $dq_rules, $table_pk;

	if ($row['legacy'])
	{
		// For v2.1.0 and previous
		switch ($row['event'])
		{
			case 'UPDATE':

				$pos_set = strpos($row['sql_log'],' SET ') + 4;
				$pos_where = strpos($row['sql_log'],' WHERE ') - $pos_set;
				$sql_log = trim(substr($row['sql_log'],$pos_set,$pos_where));
				$sql_log = str_replace(",","{DELIM}",$sql_log);

				$pos_id1 = strrpos($row['sql_log']," = '") + 4;
				if (strpos($row['sql_log'],"LIMIT 1") == true) {
					$id = substr($row['sql_log'],$pos_id1,-10);
				} else {
					$id = substr($row['sql_log'],$pos_id1,-1);
				}
				$sql_log_array = explode("{DELIM}",$sql_log);
				$sql_log = '';
				foreach ($sql_log_array as $value) {
					if (substr(trim($value),-4) == 'null') $value = substr($value,0,-4)."''";
					$sql_log .= stripslashes($value) . ",<br>";
				}
				$sql_log = substr($sql_log,0,-5);
				if (strpos($row['sql_log']," redcap_auth ") == true) {
					$event = "<font color=#000066>{$lang['reporting_24']}</font>"; //User updated
				} elseif (strpos($row['sql_log'],"INSERT INTO redcap_edocs_metadata ") == true) {
					$event = "<font color=green>{$lang['reporting_39']}</font><br><font color=#000066>{$lang['reporting_25']}</font>"; //Document uploaded
					$id = substr($id,0,strpos($id,"'"));
					$sql_log = substr($sql_log,0,strpos($sql_log,"="));
				} elseif (strpos($row['sql_log'],"UPDATE redcap_edocs_metadata ") == true) {
					$event = "<font color=red>{$lang['reporting_40']}</font><br><font color=#000066>{$lang['reporting_25']}</font>"; //Document uploaded
					$id = substr($id,0,strpos($id,"'"));
					$sql_log = substr($sql_log,0,strpos($sql_log,"="));
				} else {
					$event = "<font color=#000066>{$lang['reporting_25']}</font>"; //Record updated
				}
				break;

			case 'INSERT':

				$pos1a = strpos($row['sql_log'],' (') + 2;
				$pos1b = strpos($row['sql_log'],') ') - $pos1a;
				$sql_log = trim(substr($row['sql_log'],$pos1a,$pos1b));
				$pos2a = strpos($row['sql_log'],'VALUES (') + 8;
				$sql_log2 = trim(substr($row['sql_log'],$pos2a,-1));
				$sql_log2 = str_replace(",","{DELIM}",$sql_log2);

				$pos_id1 = strpos($row['sql_log'],") VALUES ('") + 11;
				$id_a = substr($row['sql_log'],$pos_id1,-1);
				$pos_id2 = strpos($id_a,"'");
				$id = substr($row['sql_log'],$pos_id1,$pos_id2);

				$sql_log_array = explode(",",$sql_log);
				$sql_log_array2 = explode("{DELIM}",$sql_log2);
				$sql_log = '';
				for ($k = 0; $k < count($sql_log_array); $k++) {
					if (trim($sql_log_array2[$k]) == 'null') $sql_log_array2[$k] = "''";
					$sql_log .= stripslashes($sql_log_array[$k]) . " = " . stripslashes($sql_log_array2[$k]) . ",<br>";
				}
				$sql_log = substr($sql_log,0,-5);
				if (strpos($row['sql_log']," redcap_auth ") == true) {
					$event = "<font color=#800000>{$lang['reporting_26']}</font>";
				} elseif (strpos($row['sql_log'],"INSERT INTO redcap_edocs_metadata ") == true) {
					$event = "<font color=green>{$lang['reporting_39']}</font><br><font color=#800000>{$lang['reporting_27']}</font>"; //Document uploaded
					$sql_log1 = explode("=",$sql_log);
					if (count($sql_log1) == 2) {
						$sql_log = substr($sql_log,0,strrpos($sql_log,";")-1);
					} else {
						$sql_log = substr($sql_log,0,strrpos($sql_log,"="));
					}
				} else {
					$event = "<font color=#800000>{$lang['reporting_27']}</font>";
				}
				break;

			case 'DATA_EXPORT':

				$pos1 = strpos($row['sql_log'],"SELECT ") + 7;
				$pos2 = strpos($row['sql_log']," FROM ") - $pos1;
				$sql_log = substr($row['sql_log'],$pos1,$pos2);
				$sql_log_array = explode(",",$sql_log);
				$sql_log = '';
				foreach ($sql_log_array as $value) {
					list ($table, $this_field) = explode(".",$value);
					if (strpos($this_field,")") === false) $sql_log .= "$this_field, ";
				}
				$sql_log = substr($sql_log,0,-2);
				$event = "<font color=green>{$lang['reporting_28']}</font>";
				$id = "";
				break;

			case 'DELETE':

				$pos1 = strpos($row['sql_log'],"'") + 1;
				$pos2 = strrpos($row['sql_log'],"'") - $pos1;
				$id = substr($row['sql_log'],$pos1,$pos2);
				$event = "<font color=red>{$lang['reporting_30']}</font>";
				$sql_log = "$table_pk = '$id'";
				break;

			case 'OTHER':

				$sql_log = "";
				$event = "<font color=gray>{$lang['reporting_31']}</font>";
				$id = "";
				break;

		}

	}








	// For v2.2.0 and up
	else
	{
		switch ($row['event']) {

			case 'UPDATE':
				//$sql_log = str_replace("\n","<br>",$row['data_values']);
				$sql_log = $row['data_values'];
				$id = $row['pk'];
				//Determine if deleted user or project record
				if ($row['object_type'] == "redcap_data")
				{
					if ($row['user'] == "[survey respondent]") {
						$event = "<font color=#000066>{$lang['reporting_47']}";
					} else {
						$event  = "<font color=#000066>{$lang['reporting_25']}";
						if ($row['page'] == "DynamicDataPull/save.php") $event .= " (DDP)";
						// Keep DTS page reference for legacy reasons
						elseif ($row['page'] == "DTS/index.php") $event .= " (DTS)";
					}
					if (strpos($row['description'], " (import)") !== false || $row['page'] == "DataImport/index.php" || $row['page'] == "DataImportController:index") {
						$event .= " (import)";
					}
					elseif (strpos($row['description'], " (API)") !== false) {
						$event .= " (API)";
					}
					elseif ($row['description'] == "Erase survey responses and start survey over") {
						$sql_log = "{$lang['survey_1079']}\n$sql_log";
					}
					if (strpos($row['description'], " (Auto calculation)") !== false) {
						$event .= "<br>(Auto calculation)";
					}
					$event .= "</font>";
					// DQ: If fixed values via the Data Quality module, then note that
					if ($row['page'] == "DataQuality/execute_ajax.php") {
						$event  = "<font color=#000066>{$lang['reporting_25']}<br>(Data Quality)</font>";
					}
					// DAGs: If assigning to or removing from DAG
					elseif (strpos($row['description'], "Remove record from Data Access Group") !== false || strpos($row['description'], "Assign record to Data Access Group") !== false)
					{
						$event  = "<font color=#000066>{$lang['reporting_25']}";
						if ($row['page'] == "DataImport/index.php" || $row['page'] == "DataImportController:index") {
							$event .= " (import)";
						} elseif (strpos($row['description'], " (API)") !== false) {
							$event .= " (API)";
						}
						$event .= "</font>";
						$sql_log = str_replace(" (API)", "", $row['description'])."\n(" . $row['data_values'] . ")";
					}
				}
				elseif ($row['object_type'] == "redcap_user_rights")
				{
					if ($row['description'] == 'Edit user expiration') {
						// Renamed role
						$event = "<font color=#800000>{$lang['rights_204']}</font>";
					} elseif ($row['description'] == 'Rename role') {
						// Renamed role
						$event = "<font color=#800000>{$lang['rights_200']}</font>";
						$id = '';
					} elseif ($row['description'] == 'Edit role') {
						// Edited role
						$event = "<font color=#800000>{$lang['rights_196']}</font>";
						$id = '';
					} elseif ($row['description'] == 'Remove user from role') {
						// Removed user from role
						$event = "<font color=#800000>{$lang['rights_177']}</font>";
					} else {
						// Edit user
						$event = "<font color=#000066>{$lang['reporting_24']}</font>";
					}
				}
				break;

			case 'INSERT':

				//$sql_log = str_replace("\n","<br>",$row['data_values']);
				$sql_log = $row['data_values'];
				$id = $row['pk'];
				//Determine if deleted user or project record
				if ($row['object_type'] == "redcap_data") {
					if ($row['user'] == "[survey respondent]") {
						$event = "<font color=#800000>{$lang['reporting_46']}";
					} else {
						$event = "<font color=#800000>{$lang['reporting_27']}";
						if ($row['page'] == "DynamicDataPull/save.php") $event .= " (DDP)";
					}
					if (strpos($row['description'], " (import)") !== false || $row['page'] == "DataImport/index.php" || $row['page'] == "DataImportController:index") {
						$event .= " (import)";
					}
					elseif (strpos($row['description'], '(API)') !== false) {
						$event .= " (API)";
					}
					$event .= "</font>";
				} elseif ($row['object_type'] == "redcap_user_rights") {
					if ($row['description'] == 'Add role' || $row['description'] == 'Copy role') {
						// Created role
						$event = "<font color=#000066>{$lang['rights_195']}</font>";
						$id = '';
					} elseif ($row['description'] == 'Assign user to role') {
						// Assigned to user role
						$event = "<font color=#000066>{$lang['rights_167']}</font>";
					} else {
						// Added user
						$event = "<font color=#800000>{$lang['reporting_26']}</font>";
					}
					//print_array($row);
				}
				break;

			case 'DATA_EXPORT':

				// Display fields and other relevant export settings
				$sql_log = $row['data_values'];
				if (substr($sql_log, 0, 1) == '{') {
					// If string is JSON encoded (i.e. v6.0.0+), then parse JSON to display all export settings
					$sql_log_array = array();
					foreach (json_decode($sql_log, true) as $key=>$val) {
						if (is_array($val)) {
							$sql_log_array[] = "$key: \"".implode(", ", $val)."\"";
						} else {
							$sql_log_array[] = "$key: $val";
						}
					}
					$sql_log = implode(",\n", $sql_log_array);
				}
				// Set other values
				$event = "<font color=green>{$lang['reporting_28']}";
				if (strpos($row['description'], '(API)') !== false) {
					$event .= " (API)";
				} elseif (strpos($row['description'], '(API Playground)') !== false) {
					$event .= "<br>(API Playground)";
				}
				$event .= "</font>";
				$id = "";
				break;

			case 'DOC_UPLOAD':
				if (strpos($row['page'], 'Design/') === 0) {
					$sql_log = $row['description'];
					$event = "<font color=#000066>{$lang['reporting_33']}</font>";
				} else {
					$sql_log = $row['data_values'];
					$event = "<font color=green>{$lang['reporting_39']}";
					if (strpos($row['description'], '(API)') !== false) {
						$event .= " (API)";
					} elseif (strpos($row['description'], '(API Playground)') !== false) {
						$event .= "<br>(API Playground)";
					}
					$event .= "</font><br><font color=#000066>{$lang['reporting_25']}</font>";
					$id = $row['pk'];
				}
				break;

			case 'DOC_DELETE':

				$sql_log = $row['data_values'];
				$event = "<font color=red>{$lang['reporting_40']}</font><br><font color=#000066>{$lang['reporting_25']}</font>";
				$id = $row['pk'];
				break;

			case 'DELETE':

				$sql_log = $row['data_values'];
				$id = $row['pk'];
				//Determine if deleted user or project record
				if ($row['object_type'] == "redcap_data") {
					$event = "<font color=red>{$lang['reporting_30']}";
					if (strpos($row['description'], '(API)') !== false) {
						$event .= " (API)";
					}else if (strpos($row['description'], '(API Playground)') !== false) {
						$event .= " (API Playground)";
					}
					$event .= "</font>";
				} elseif ($row['object_type'] == "redcap_user_rights") {
					if ($row['description'] == 'Delete role') {
						// Deleted role
						$event = "<font color=red>{$lang['rights_197']}</font>";
						$id = '';
					} else {
						// Deleted user
						$event = "<font color=red>{$lang['reporting_29']}</font>";
					}
				}
				break;

			case 'OTHER':
				$id = ($row['pk'] == "") ? "" : $lang['global_49'] . " " . $row['pk'];
				$event = "<font color=#800000>{$row['description']}</font>";
				$sql_log = $row['data_values'];
				break;

			case 'MANAGE':
				$sql_log = $row['description'];
				$event = "<font color=#000066>{$lang['reporting_33']}</font>";
				$id = "";
				// Parse activity differently for arms, events, calendar events, and scheduling
				if (in_array($sql_log, array("Create calendar event","Delete calendar event","Edit calendar event","Create event","Edit event",
											 "Delete event","Create arm","Delete arm","Edit arm name/number"))) {
					$sql_log .= "\n(" . $row['data_values'] . ")";
				}
				// Render record name for edoc downloads
				if ($sql_log == "Download uploaded document") {
					$event = "<font color=#000066>$sql_log</font>";
					// Deal with legacy logging, in which the record was not known and data_values contained "doc_id = #"
					if ($row['pk'] != "") {
						$sql_log = $row['data_values'];
						$id = $row['pk'];
						$event .= "<br>{$lang['global_49']}";
					} else {
						$sql_log = "";
					}
				}
				// Mobile App file upload to mobile app archive from app
				elseif ($sql_log == "Upload document to mobile app archive") {
					$event = "<font color=green>{$lang['reporting_39']}<br>{$lang['mobile_app_21']}</font>";
				}
				// Assign user to DAG or remove from DAG
				elseif ($sql_log == "Assign user to data access group" || $sql_log == "Remove user from data access group") {
					$sql_log .= "\n".$row['data_values'];
				}
				// Render randomization of records so that it displays the record name
				elseif ($sql_log == "Randomize record") {
					$id = $row['pk'];
					$event = "<font color=#000066>{$lang['random_117']}</font>";
				}
				// Render the email recipient's email if "Send email"
				elseif ($sql_log == "Send email" && $row['pk'] != '') {
					$sql_log .= "\n({$lang['reporting_48']}{$lang['colon']} {$row['pk']})";
				}
				// For super user action of viewing another user's API token, add username after description for clarification
				elseif ($sql_log == "View API token of another user") {
					$sql_log .=  "\n(".$row['data_values'].")";
				}
				// For sending public survey invites via Twilio services
				elseif (strpos($sql_log, "Send public survey invitation to participants") === 0) {
					$sql_log .=  "\n".$row['data_values'];
				}
				// Field Comment Log or Data Resolution Workflow
				elseif ($sql_log == "Edit field comment" || $sql_log == "Delete field comment" || $sql_log == "Add field comment" || $sql_log == "De-verified data value" || $sql_log == "Verified data value" || strpos($sql_log, "data query") !== false) {
					// Parse JSON values
					$jsonLog = json_decode($row['data_values'],true);
					// Record
					$sql_log .= "\n({$lang['dataqueries_93']} {$row['pk']}";
					// Event name (if longitudinal)
					if ($longitudinal && is_numeric($row['event_id'])) {
						$sql_log .= ", {$lang['bottom_23']} " . strip_tags(label_decode($event_ids[$row['event_id']]));
					}
					// Field name (unless is a multi-field custom DQ rule)
					if ($jsonLog['field'] != '') {
						$sql_log .= ", {$lang['reporting_49']} ".$jsonLog['field'];
					}
					// DQ rule (if applicable)
					if ($jsonLog['rule_id'] != '') {
						$sql_log .= ", {$lang['dataqueries_169']} ".(is_numeric($jsonLog['rule_id']) ? "#" : "")
								 .  $dq_rules[$jsonLog['rule_id']]['order'];
					}
					// Field Comment text
					if ($jsonLog['comment'] != '') {
						$sql_log .= ", {$lang['dataqueries_195']}{$lang['colon']} \"".$jsonLog['comment']."\"";
					}
					$sql_log .= ")";
				}
				break;

			case 'LOCK_RECORD':
				$sql_log = $lang['reporting_44'] . $row['description'] . "\n" . $row['data_values'];
				$event = "<font color=#A86700>{$lang['reporting_41']}</font>";
				$id = $row['pk'];
				break;

			case 'ESIGNATURE':
				$sql_log = $lang['reporting_44'] . $row['description'] . "\n" . $row['data_values'];
				$event = "<font color=#008000>{$lang['global_34']}</font>";
				$id = $row['pk'];
				break;

			case 'PAGE_VIEW':
				$sql_log = $lang['reporting_45']."\n" . $row['full_url'];
				// if ($row['record'] != "") $sql_log .= ",<br>record: " . $row['record'];
				// if ($row['event_id'] != "") $sql_log .= ",<br>event_id: " . $row['event_id'];
				$event = "<font color=#000066>{$lang['reporting_43']}</font>";
				$id = "";
				$row['data_values'] = "";
				break;

		}

	}

	// Append Event Name (if longitudinal)
	$dataEvents = array("OTHER","UPDATE","INSERT","DELETE","DOC_UPLOAD","DOC_DELETE","LOCK_RECORD","ESIGNATURE");
	if ($longitudinal && $row['legacy'] == '0'
		 && (($row['object_type'] == "redcap_data" || $row['object_type'] == "") && in_array($row['event'], $dataEvents))
		)
	{
		// If missing, set to first event_id
		if ($row['event_id'] == "") {
			$row['event_id'] = $Proj->firstEventId;
		}
		// If event_id is not valid, then don't display event name
		if (isset($event_ids[$row['event_id']])) {
			$id .= " <span style='color:#777;'>(" . strip_tags(label_decode($event_ids[$row['event_id']])) . ")</span>";
		}
	}

	unset($sql_log_array);
	unset($sql_log_array2);

	// Set description
	$description = "$event<br>$id";

	// If outputting to non-html format (e.g., csv file), then remove html
	if (!$html_output)
	{
		$row['ts']   = DateTimeRC::format_ts_from_int_to_ymd($row['ts']);
		$description = strip_tags(str_replace("<br>", " ", $description));
		$sql_log 	 = filter_tags(str_replace(array("<br>","\n"), array(" "," "), label_decode($sql_log)));
	}
	// html output (i.e. Logging page)
	else
	{
		$row['ts'] = DateTimeRC::format_ts_from_ymd(DateTimeRC::format_ts_from_int_to_ymd($row['ts']));
	}

	// Set values for this row
	$new_row = array($row['ts'], $row['user'], $description, $sql_log);

	// If project-level flag is set, then add "reason changed" to row data
	if ($require_change_reason)
	{
		$new_row[] = $html_output ? nl2br(filter_tags($row['change_reason'])) : str_replace("\n", " ", html_entity_decode($row['change_reason'], ENT_QUOTES));
	}

	// Return values for this row
	return $new_row;
}



function setEventFilterSql($logtype)
{
	switch ($logtype)
	{
		case 'page_view':
			$filter_logtype =  "AND event = 'PAGE_VIEW'";
			break;
		case 'lock_record':
			$filter_logtype =  "AND event in ('LOCK_RECORD', 'ESIGNATURE')";
			break;
		case 'manage':
			$filter_logtype =  "AND event = 'MANAGE'";
			break;
		case 'export':
			$filter_logtype =  "AND event = 'DATA_EXPORT'";
			break;
		case 'record':
			$filter_logtype =  "AND (
								(
									(
										legacy = '1'
										AND
										(
											left(sql_log,".strlen("INSERT INTO redcap_data").") = 'INSERT INTO redcap_data'
											OR
											left(sql_log,".strlen("UPDATE redcap_data").") = 'UPDATE redcap_data'
											OR
											left(sql_log,".strlen("DELETE FROM redcap_data").") = 'DELETE FROM redcap_data'
										)
									)
									OR
									(legacy = '0' AND object_type = 'redcap_data')
								)
								AND
									(event != 'DATA_EXPORT')
								)";
			break;
		case 'record_add':
			$filter_logtype =  "AND (
									(legacy = '1' AND left(sql_log,".strlen("INSERT INTO redcap_data").") = 'INSERT INTO redcap_data')
									OR
									(legacy = '0' AND object_type = 'redcap_data' and event = 'INSERT')
								)";
			break;
		case 'record_edit':
			$filter_logtype =  "AND (
									(legacy = '1' AND left(sql_log,".strlen("UPDATE redcap_data").") = 'UPDATE redcap_data')
									OR
									(legacy = '0' AND object_type = 'redcap_data' and event in ('UPDATE','DOC_DELETE','DOC_UPLOAD'))
									OR
									(legacy = '0' AND page = 'PLUGIN' and event in ('OTHER'))
								)";
			break;
		case 'user':
			$filter_logtype =  "AND object_type = 'redcap_user_rights'";
			break;
		default:
			$filter_logtype = '';
	}

	return $filter_logtype;

}
