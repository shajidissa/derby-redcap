<?php
global $format, $returnFormat, $post;



# get all the records to be exported
$result = getItems();

# structure the output data accordingly
switch($format)
{
	case 'json':
		$content = json_encode($result);
		break;
	case 'xml':
		$content = xml($result);
		break;
	case 'csv':
		$content = csv($result);
		break;
}

/************************** log the event **************************/



# Logging
Logging::logEvent("", "project_info", "MANAGE", PROJECT_ID, "project_id = " . PROJECT_ID, "Export project information (API$playground)");

# Send the response to the requestor
RestUtility::sendResponse(200, $content, $format);

function xml($dataset)
{
	$content = '<?xml version="1.0" encoding="UTF-8" ?>';
	$content .= "\n<items>\n";
	foreach ($dataset as $item => $value) {
		if ($value != "")
			$content .= "<$item><![CDATA[" . $value . "]]></$item>";
		else
			$content .= "<$item></$item>";
	}
	$content .= "\n</items>\n";
	return $content;
}

function csv($dataset)
{
	// Open connection to create file in memory and write to it
	$fp = fopen('php://memory', "x+");
	// Add headers
	fputcsv($fp, array_keys($dataset));
	// Add values
	fputcsv($fp, $dataset);
	// Open file for reading and output to user
	fseek($fp, 0);
	return stream_get_contents($fp);
}

function getItems()
{
	global $lang;
	// Get project object of attributes
	$Proj = new Project();
	// If project was deleted but still exists on back-end, then return error
	if ($Proj->project['date_deleted'] != '') {
		RestUtility::sendResponse(503, $lang['api_11']);
	}
	// Set array of fields we want to return, along with their user-facing names
	$project_fields = Project::getAttributesApiExportProjectInfo();
	//print_array($Proj->project);
	// Add values for all the project fields
	$project_values = array();
	foreach ($project_fields as $key=>$hdr) {
		// Add to array
		if (!isset($Proj->project[$key])) {
			// Leave blank if not in array above
			$val = '';
		} elseif (is_bool($Proj->project[$key])) {
			// Convert boolean to 0 and 1
			$val = ($Proj->project[$key] === false) ? 0 : 1;
		} else {
			// Normal value
			$val = label_decode($Proj->project[$key]);
		}
		$project_values[$hdr] = $val;
	}
	// Add longitudinal
	$project_values['is_longitudinal'] = $Proj->longitudinal ? 1 : 0;
	// Return array
	return $project_values;
}
