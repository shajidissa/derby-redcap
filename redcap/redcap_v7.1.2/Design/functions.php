<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


// Convert CSV file into an array
function excel_to_array($excelfilepath)
{
	global $lang, $project_language, $surveys_enabled, $project_encoding;

	// Set up array to switch out Excel column letters
	$cols = MetaData::getCsvColNames();

	// Extract data from CSV file and rearrange it in a temp array
	$newdata_temp = array();
	$i = 1;

	// Set commas as default delimiter (if can't find comma, it will revert to tab delimited)
	$delimiter 	  = ",";
	$removeQuotes = false;

	if (($handle = fopen($excelfilepath, "rb")) !== false)
	{
		// Loop through each row
		while (($row = fgetcsv($handle, 0, $delimiter)) !== false)
		{
			// Skip row 1
			if ($i == 1)
			{
				## CHECK DELIMITER
				// Determine if comma- or tab-delimited (if can't find comma, it will revert to tab delimited)
				$firstLine = implode(",", $row);
				// If we find X number of tab characters, then we can safely assume the file is tab delimited
				$numTabs = 6;
				if (substr_count($firstLine, "\t") > $numTabs)
				{
					// Set new delimiter
					$delimiter = "\t";
					// Fix the $row array with new delimiter
					$row = explode($delimiter, $firstLine);
					// Check if quotes need to be replaced (added via CSV convention) by checking for quotes in the first line
					// If quotes exist in the first line, then remove surrounding quotes and convert double double quotes with just a double quote
					$removeQuotes = (substr_count($firstLine, '"') > 0);
				}
				// Increment counter
				$i++;
				// Check if legacy column Field Units exists. If so, tell user to remove it (by returning false).
				// It is no longer supported but old values defined prior to 4.0 will be preserved.
				if (strpos(strtolower($row[2]), "units") !== false)
				{
					return false;
				}
				continue;
			}
			// Loop through each column in this row
			for ($j = 0; $j < count($row); $j++)
			{
				// If tab delimited, compensate sightly
				if ($delimiter == "\t")
				{
					// Replace characters
					$row[$j] = str_replace("\0", "", $row[$j]);
					// If first column, remove new line character from beginning
					if ($j == 0) {
						$row[$j] = str_replace("\n", "", ($row[$j]));
					}
					// If the string is UTF-8, force convert it to UTF-8 anyway, which will fix some of the characters
					if (function_exists('mb_detect_encoding') && mb_detect_encoding($row[$j]) == "UTF-8")
					{
						$row[$j] = utf8_encode($row[$j]);
					}
					// Check if any double quotes need to be removed due to CSV convention
					if ($removeQuotes)
					{
						// Remove surrounding quotes, if exist
						if (substr($row[$j], 0, 1) == '"' && substr($row[$j], -1) == '"') {
							$row[$j] = substr($row[$j], 1, -1);
						}
						// Remove any double double quotes
						$row[$j] = str_replace("\"\"", "\"", $row[$j]);
					}
				}
				// Add to array
				$newdata_temp[$cols[$j+1]][$i] = $row[$j];
				// Use only for Japanese SJIS encoding
				if ($project_encoding == 'japanese_sjis')
				{
					$newdata_temp[$cols[$j+1]][$i] = mb_convert_encoding($newdata_temp[$cols[$j+1]][$i], 'UTF-8',  'sjis');
				}
			}
			$i++;
		}
		fclose($handle);
	} else {
		// ERROR: File is missing
		$fileMissingText = (!SUPER_USER) ? $lang['period'] : " (".APP_PATH_TEMP."){$lang['period']}<br><br>{$lang['file_download_13']}";
		print 	RCView::div(array('class'=>'red'),
					RCView::b($lang['global_01'].$lang['colon'])." {$lang['file_download_08']} <b>\"".basename($excelfilepath)."\"</b>
					{$lang['file_download_12']}{$fileMissingText}"
				);
		exit;
	}

	// If file was tab delimited, then check if it left an empty row on the end (typically happens)
	if ($delimiter == "\t" && $newdata_temp['A'][$i-1] == "")
	{
		// Remove the last row from each column
		foreach (array_keys($newdata_temp) as $this_col)
		{
			unset($newdata_temp[$this_col][$i-1]);
		}
	}

	// Return array with data dictionary values
	return $newdata_temp;

}






/**
 * RENDER DATA DICTIONARY ERRORS
 */
function renderErrors($errors_array) {
	global $lang;

	print 	"<div class='red' style='margin-top:10px;'>
				<img src='".APP_PATH_IMAGES."exclamation.png'>
				<b>{$lang['database_mods_59']}</b><br><br>
				<p style='border-bottom:1px solid #aaa;font-weight:bold;font-size:16px;color:#800000;'>{$lang['database_mods_60']}</p>
				<p>" . implode("</p><p style='padding-top:5px;border-top:1px solid #aaa;'>", $errors_array) . "</p>
			</div>";
}


/**
 * RENDER DATA DICTIONARY WARNINGS
 */
function renderWarnings($warnings_array) {
	global $lang;

	//Display warnings
	if (count($warnings_array) > 0) {
		print "<div class='yellow' style='margin-top:15px;'>";
		print "<p style='border-bottom:1px solid #aaa;font-weight:bold;font-size:16px;color:#800000;'>{$lang['database_mods_61']}</p>";
		print "<p>" . implode("</p><p style='padding-top:5px;border-top:1px solid #aaa;'>", $warnings_array) . "</p>";
		print "</div>";
	}
}


/**
 * RENDER TABLE TO DISPLAY METADATA CHANGES
 */
function getMetadataDiff($num_records=0)
{
	global $lang, $table_pk, $enable_field_attachment_video_url;

	$html = "";

	// Build arrays with all old values, drafted values, and changes
	$metadata_new = array();
	$metadata_old = array();
	$metadata_changes = array();
	$fieldsCriticalIssues = array(); // Capture fields with critical issues

	// Metadata columns that need html decoding
	$metadataDecode = array("element_preceding_header", "element_label", "element_enum", "element_note", "branching_logic", "question_num");

	// Get existing field values
	$sql = "select field_name, element_preceding_header, element_type, element_label, element_enum,
			element_note, element_validation_type, element_validation_min, element_validation_max, field_phi,
			branching_logic, field_req, edoc_id, custom_alignment, stop_actions, question_num, grid_name, grid_rank
			".($enable_field_attachment_video_url ? ", video_url, video_display_inline " : "").", misc
			from redcap_metadata where project_id = " . PROJECT_ID . " order by field_order";
	$q = db_query($sql);
	while ($row = db_fetch_assoc($q))
	{
		// Do html decoding for certain fields
		foreach ($metadataDecode as $col)
		{
			$row[$col] = label_decode($row[$col]);
		}
		// Add to array
		$metadata_old[$row['field_name']] = $row;
	}

	// Get new field values and store changes in array
	$sql = "select field_name, element_preceding_header, element_type, element_label, element_enum,
			element_note, element_validation_type, element_validation_min, element_validation_max, field_phi,
			branching_logic, field_req, edoc_id, custom_alignment, stop_actions, question_num, grid_name, grid_rank
			".($enable_field_attachment_video_url ? ", video_url, video_display_inline " : "").", misc
			from redcap_metadata_temp where project_id = " . PROJECT_ID . " order by field_order";
	$q = db_query($sql);
	while ($row = db_fetch_assoc($q))
	{
		// Do html decoding for certain fields
		foreach ($metadataDecode as $col)
		{
			$row[$col] = label_decode($row[$col]);
		}
		$metadata_new[$row['field_name']] = $row;
		// Check to see if values are different from existing field. If they are, don't include in new array.
		if (!isset($metadata_old[$row['field_name']]) || $row !== $metadata_old[$row['field_name']]) {
			$metadata_changes[$row['field_name']] = $row;
		}
	}	

	// Count number of changes
	$num_metadata_changes = count($metadata_changes);

	// Query to find fields with data
	$sql = "select distinct field_name, value from redcap_data where project_id = ".PROJECT_ID."
			and field_name in (".prep_implode(array_keys($metadata_changes)).")";
	$q = db_query($sql);
	while ($row = db_fetch_assoc($q))
	{
		// If value is blank, then skip this
		if ($row['value'] == '') continue;
		// Add field to array as key
		$fieldsWithData[$row['field_name']] = true;
	}

	//CSS to hide some elements
	if ($num_metadata_changes == 0) {
		$html .= "<style type='text/css'>
				#tableChanges, #metadataCompareKey, #tableChangesPretext { display: none !important; }
				</style>";
	}

	$html .= "<div id='tableChangesPretext' style='font-weight:bold;padding:30px 4px 8px;'>
				{$lang['database_mods_62']}
				<span id='ShowMoreAll' style='visibility:hidden;color:#777;font-weight:normal;'>
					<a href='javascript:;' onclick='metaDiffShowAll()' style='text-decoration:underline;margin:0 2px 0 50px;'>{$lang['database_mods_177']}</a>
					{$lang['database_mods_178']}
				</span>
			</div>";

	// Now loop through changes and new fields and render table
	$html .= "<table id='tableChanges' class='metachanges' border='1' cellspacing='0' cellpadding='10' style='width:100%;border:1px solid gray;font-family:Verdana,Arial;font-size:10px;'>
				<tr style='background-color:#a0a0a0;font-weight:bold;'>
					<td>{$lang['global_44']}</td>
					<td>{$lang['database_mods_65']}</td>
					<td>{$lang['database_mods_66']}</td>
					<td>{$lang['global_40']}</td>
					<td>{$lang['database_mods_68']}</td>
					<td>{$lang['database_mods_69']}</td>
					<td>{$lang['database_mods_70']}</td>
					<td>{$lang['database_mods_71']}</td>
					<td>{$lang['database_mods_72']}</td>
					<td>{$lang['database_mods_73']}</td>
					<td>{$lang['database_mods_74']}</td>
					<td>{$lang['database_mods_75']}</td>
					<td>{$lang['database_mods_105']}</td>
					<td>{$lang['design_212']}</td>
					<td>{$lang['database_mods_108']}</td>
					<td>{$lang['design_221']}</td>
					<td>{$lang['database_mods_132']}</td>
					<td>{$lang['design_504']}</td>
					".($enable_field_attachment_video_url ? "<td>{$lang['design_575']}</td><td>{$lang['design_579']}</td>" : "")."
					<td>{$lang['design_527']}</td>
				</tr>";
	// Collect names of fields being modified
	$fieldsModified = array();
	// Render each table row
	foreach ($metadata_changes as $field_name=>$attr)
	{
		// If a new field, set bgcolor to green, otherwise set as null
		$bgcolor_row = !isset($metadata_old[$field_name]) ? "style='background-color:#7BED7B;'" : "";
		// Begin row
		$html .= "<tr $bgcolor_row>";
		// Loop through each cell in row
		foreach ($attr as $key=>$value) {
			// Set default bgcolor for cell as null
			$bgcolor = "";
			// Tranform any raw legacy values to user-readable values
			$value = transformMetaVals($value, $key);
			// Analyze changes for existing field
			if ($bgcolor_row == "") {
				// Retrieve existing value
				$old_value = $metadata_old[$field_name][$key];
				// Tranform any raw legacy values to user-readable values
				$old_value = transformMetaVals($old_value, $key);
				// If new and existing values are different...
				if ($old_value != $value) {
					// Set bgcolor as yellow to denote changes
					$bgcolor = "style='background-color:#ffff80;'";
					// Append existing value in gray text
					$value = nl2br(RCView::escape(br2nl($value))) . "<div class='diffold'>".nl2br(RCView::escape(br2nl($old_value)))."</div>";
					// Check if field has data
					$fieldHasData = (isset($fieldsWithData[$field_name]));
					// Add any other info that may be helpful to prevent against data loss and other issues.
					// Allow $fieldHasData to be modified for MC fields that have options deleted where the option has NO data.
					list ($metadataChangeComment, $fieldHasData, $dataJson) = metadataChangeComment($metadata_old[$field_name], $metadata_new[$field_name], $key, $fieldHasData);
					// If the field has a critical issue AND has data, add to array
					if ($metadataChangeComment != "" && $fieldHasData) {
						$fieldsCriticalIssues[] = $field_name;
					}
					// Truncate text if long
					$value = "<div id='$field_name-$key' recs='".json_encode($dataJson)."'>" . showMoreLink($field_name, $key, $value) . "</div>";
					// Add metadata change comment (if exists)
					$value .= $metadataChangeComment;
					// Place field_name in array
					$fieldsModified[$field_name] = true;
				}
			} else {
				// New field
				$value = nl2br(RCView::escape(br2nl($value)));
				// Truncate text if long
				$value = showMoreLink($field_name, $key, $value);
			}
			// Add to row
			$html .= "<td $bgcolor>$value</td>";
		}
		// Finish row
		$html .= "</tr>";
	}
	// Finish table
	$html .= "</table>";
	$html .= "<br>";

	// Give message if there are no differences and hide table and other things that don't need to be shown
	if ($num_metadata_changes == 0) {
		// Message to user
		$html .= "<div class='yellow' style='font-weight:bold;font-size:14px;'>
					<img src='" . APP_PATH_IMAGES . "exclamation_orange.png'>
					{$lang['database_mods_76']}
				</div>";
		//CSS to hide some elements
		$html .= "<style type='text/css'>
				#tableChanges, #metadataCompareKey, #tableChangesPretext { display: none !important; }
				</style>";
	}

	$html .= "<br>";

	// If have fields with critical issues, then check data to see if they have data. If no data, remove as critical issue.
	$numCriticalIssues = count($fieldsCriticalIssues);

	// If the Record ID field was changed, set $record_id_field_changed as TRUE
	$record_id_field_changed = (array_shift(array_keys($metadata_new)) != array_shift(array_keys($metadata_old)));
	// If project has data, then consider this a critical issue
	if ($record_id_field_changed && $num_records > 0) {
		$numCriticalIssues++;
	}

	// Return number of changes and HTML of modifications table
	return array($num_metadata_changes, count($fieldsModified), $record_id_field_changed, $numCriticalIssues, $html);
}


// Create "show more" link if text in cell is too long
function showMoreLink($field_name, $key, $value) 
{
	global $lang;
	$max_text_length = 90;
	// Truncate text if long
	if (strlen($value) > $max_text_length && strlen(strip_tags($value)) > $max_text_length) {
		// Temporarily remove div tag so that we don't slice it in two
		$orig_value = $value;
		$value = strip_tags(br2nl(str_replace("<div class='diffold'>", "||", $value)));
		// Find space where to break it
		$valueBreakPos = strpos($value, " ", $max_text_length);
		if ($valueBreakPos !== false) {
			// Re-add div
			$replValue = str_replace("||", "<div class='diffold'>", substr($value, 0, $valueBreakPos)) . " ...</div>";
			// Split into truncated div and hidden div
			$value = RCView::div(array('id'=>"$field_name-$key-trunc"), nl2br(str_replace("\n\n", "\n", $replValue)))
				   . RCView::a(array('href'=>"javascript:;", 'class'=>'meta-diff-show-more', 'onclick'=>"metaDiffShowMore(this,'$field_name-$key');"), $lang['create_project_94'])
				   . RCView::div(array('id'=>"$field_name-$key-whole", 'style'=>'display:none;'), $orig_value);
		}
	}
	return $value;
}


/**
 * CHANGE RAW METADATA VALUES INTO USER-READABLE VALUES
 */
function transformMetaVals($value, $meta_field) {
	global $lang;
	// Choose action based upon which metadata field we're on
	switch ($meta_field) {
		// Select Choices / Calculations
		case 'element_enum':
			// For fields with Choices, replace \n with line break for viewing
			$value = preg_replace("/(\s*)(\\\\n)(\s*)/", "<br>", $value);
			break;
		case 'edoc_id':
			if (is_numeric($value)) {
				$value = "doc_id=".$value;
			}
			break;
	}
	// Translater array with old/new values to translate for all metadata field types
	$translator = array('element_type'				=> array('textarea'=>'notes', 'select'=>'dropdown'),
						'element_validation_type' 	=> array('int'=>'integer', 'float'=>'number'),
						'field_phi'					=> array('1'=>'Y'),
						'field_req'					=> array('1'=>'Y', '0'=>''),
						'grid_rank'					=> array('1'=>'Y', '0'=>''),
						'video_display_inline'		=> array('1'=>$lang['design_580'], '0'=>$lang['design_581'])
						);
	// Do any direct replacing of value, if required
	if (isset($translator[$meta_field][$value])) {
		$value = $translator[$meta_field][$value];
	}
	// Return transformed values
	return $value;
}


/**
 * COMPARE ELEMENT_ENUM CHOICES TO DETECT NEW OR CHANGED CHOICES
 */
function compareChoices($draft_choices, $current_choices)
{
	// Set regex to replace non-alphnumeric characters in label when comparing the two
	$regex = "/[^a-z0-9 ]/";
	// Convert choices to array format
	$draft_choices   = parseEnum($draft_choices);
	$current_choices = parseEnum($current_choices);
	// Set initial count of labels changed
	$labels_changed = array();
	// Get count of MC choices that were removed
	$codes_removed  = array_keys(array_diff_key($current_choices, $draft_choices));
	// Loop through each choice shared by both fields and check if label has changed
	foreach (array_keys(array_intersect_key($current_choices, $draft_choices)) as $code)
	{
		// Clean each label to minimize false positives (e.g., if only change case of letters or add apostrophe)
		$draft_choices[$code] = preg_replace($regex, "", strtolower(trim(strip_tags(label_decode($draft_choices[$code])))));
		$current_choices[$code] = preg_replace($regex, "", strtolower(trim(strip_tags(label_decode($current_choices[$code])))));
		// If option text was changed, count it
		if ($draft_choices[$code] != $current_choices[$code]) {
			$labels_changed[] = $code;
		}
	}
	// Return counts
	return array($codes_removed, $labels_changed);
}


/**
 * RENDER METADATA CHANGE COMMENT IN RED TEXT
 */
function renderChangeComment($text) {
	return "<div class='ChangeComment'>$text</div>";
}

/**
 * RENDER METADATA CHANGE COMMENT IN GREEN TEXT
 */
function renderChangeCommentOkay($text) {
	return "<div class='ChangeCommentOkay'>$text</div>";
}


/**
 * ADD HELPFUL COMMENTS FOR CHANGES IN A TABLE CELL
 */
function metadataChangeComment($old_field, $new_field, $meta_field, $fieldHasData=true)
{
	global $lang, $Proj;

	// Set array of allowable field type changes (original type => only allowable types to change to)
	$allowedFieldTypeChanges = array(
		"text" => array("textarea"),
		"textarea" => array("text"),
		"calc" => array("text", "textarea"),
		"radio" => array("text", "textarea", "select", "checkbox"),
		"select" => array("text", "textarea", "radio", "checkbox"),
		"yesno" => array("text", "textarea", "truefalse"),
		"truefalse" => array("text", "textarea", "yesno"),
		"slider" => array("text", "textarea")
	);

	// Default string value
	$msg = $dataJson = "";
	// Choose action based upon which metadata field we're on
	switch ($meta_field) {
		// Field Type
		case 'element_type':
			$oldType = $old_field[$meta_field];
			$newType = $new_field[$meta_field];
			// If field type is changing AND it is changing to an incompatible type, then give error msg.
			// Exclude "descriptive" fields because they have no data, so they're harmless to change into another field type.
			if ($oldType != "descriptive" && $oldType != $newType
				&& (!isset($allowedFieldTypeChanges[$oldType]) || (isset($allowedFieldTypeChanges[$oldType]) && !in_array($newType, $allowedFieldTypeChanges[$oldType]))))
			{
				if ($fieldHasData) {
					$msg .= renderChangeComment($lang['database_mods_77']);
				} else {
					$msg .= renderChangeCommentOkay($lang['database_mods_133']);
				}
			}
			break;
		// Select Choices / Calculations
		case 'element_enum':
			// For fields with Choices, compare choice values and codings
			if (in_array($new_field['element_type'], array("advcheckbox", "radio", "select", "checkbox", "dropdown")))
			{
				list($codes_removed, $labels_changed) = compareChoices($new_field['element_enum'], $old_field['element_enum']);
				$num_codes_removed = count($codes_removed);
				$num_labels_changed = count($labels_changed);
				$compareBtnClass = 'btn-success';
				if ($num_codes_removed + $num_labels_changed > 0)
				{
					// Set defaults
					$fieldHasDataForRemovedOptions = $fieldHasDataForChangedOptions = false;
					// Highlight any data loss if option was RELABELED
					if ($num_labels_changed > 0) {
						// If field has data, query the data table to see if it has data for the options being deleted
						if ($fieldHasData) {
							$sql = "select value, count(*) as thiscount from redcap_data 
									where project_id = ".PROJECT_ID." and field_name = '{$new_field['field_name']}'
									and event_id in (".prep_implode(array_keys($Proj->eventInfo)).")
									and value in (".prep_implode($labels_changed).") and value != '' group by value";
							$q = db_query($sql);
							$fieldHasDataForChangedOptions = (db_num_rows($q) > 0);
							while ($row = db_fetch_assoc($q)) {
								$dataJson[$row['value']] = $row['thiscount'];
							}
						}
						if ($fieldHasDataForChangedOptions) {
							$msg .= renderChangeComment($lang['database_mods_79']);
							$compareBtnClass = 'btn-danger';
						} else {
							$msg .= renderChangeCommentOkay($lang['database_mods_153']);
						}
					}
					// Highlight any data loss if option was DELETED
					if ($num_codes_removed > 0)
					{
						// If field has data, query the data table to see if it has data for the options being deleted
						if ($fieldHasData) {
							$sql = "select value, count(*) as thiscount from redcap_data 
									where project_id = ".PROJECT_ID." and field_name = '{$new_field['field_name']}'
									and event_id in (".prep_implode(array_keys($Proj->eventInfo)).")
									and value in (".prep_implode($codes_removed).") and value != '' group by value";
							$q = db_query($sql);
							$fieldHasDataForRemovedOptions = (db_num_rows($q) > 0);
							while ($row = db_fetch_assoc($q)) {
								$dataJson[$row['value']] = $row['thiscount'];
							}
						}
						if ($fieldHasDataForRemovedOptions) {
							$msg .= renderChangeComment($lang['database_mods_78']);
							$compareBtnClass = 'btn-danger';
						} else {
							$msg .= renderChangeCommentOkay($lang['database_mods_133']);
						}
					}
					// Add "compare" button
					$msg .= RCView::button(array('class'=>"choiceDiffBtn btn btn-xs $compareBtnClass", 'style'=>'margin-top:2px;', 'onclick'=>"choicesCompareBtnClick('{$new_field['field_name']}');"), $lang['data_comp_tool_02']);
					// If no options with data were removed or had their label changed, then we can flag this field as not
					// having data (effectively), and thus it will NOT be considered a critical issue.
					if ($fieldHasData && !$fieldHasDataForChangedOptions && !$fieldHasDataForRemovedOptions) {
						$fieldHasData = false;
					}
				}
			}
			break;
	}
	// Return msg, if any, and $fieldHasData (would be modified if MC field's option was deleted but has no data for that option)
	return array($msg, $fieldHasData, $dataJson);
}


/**
 * GET FIELDS/FORMS TO BE ADDED AND DELETED
 */
function renderFieldsAddDel()
{
	global $lang, $Proj, $longitudinal;

	$html = "";

	$html .= "<div style='font-size:12px;'>";

	// Array for collecting new/deleted field names
	$newFields = array();
	$delFields = array();

	//List all new fields to be added
	$newFields = array_diff(array_keys($Proj->metadata_temp), array_keys($Proj->metadata));
	$sql = "select field_name, count(*) as thiscount from redcap_data 
			where project_id = ".PROJECT_ID." and event_id in (".prep_implode(array_keys($Proj->eventInfo)).")
			and field_name in (".prep_implode($newFields).") and value != '' group by field_name";
	$q = db_query($sql);
	$newFieldsRecordCount = array();
	while ($row = db_fetch_assoc($q)) {
		$newFieldsRecordCount[$row['field_name']] = $row['thiscount'];
	}
	$html .= "	<div style='color:green;padding:5px;'>
					<b><u>{$lang['database_mods_80']}</u></b>";
	foreach ($newFields as $field) {
		$html .= "	<div style='max-width:500px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&bull; " .
					$field . " &nbsp;<span style='font-size:11px;font-family:tahoma;'>\"" .
					RCView::escape($Proj->metadata_temp[$field]['element_label']) . "</span>\"";
		if (isset($newFieldsRecordCount[$field])) {
			$html .= " (<b>{$newFieldsRecordCount[$field]}</b> ".($longitudinal ? $lang['database_mods_176'] : $lang['database_mods_175']).")";
		}
		$html .= "</div>";
	}
	if (empty($newFields)) {
		$html .= "	<i>{$lang['database_mods_81']}</i>";
	}
	$html .= "	</div>";

	//List all new forms to be added
	$newForms = array_diff(array_keys($Proj->forms_temp), array_keys($Proj->forms));
	$html .= "	<div style='color:green;padding:5px;'>
					<b><u>{$lang['database_mods_98']}</u></b>";
	foreach ($newForms as $form) {
		$html .= "	<div style='max-width:500px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&bull; " .
					$form . " &nbsp;<span style='font-size:11px;font-family:tahoma;'>\"" .
					RCView::escape($Proj->forms_temp[$form]['menu']) . "</span>\"</div>";
	}
	if (empty($newForms)) {
		$html .= "	<i>{$lang['database_mods_81']}</i>";
	}
	$html .= "	</div>";

	//List all fields to be deleted
	$delFields = array_diff(array_keys($Proj->metadata), array_keys($Proj->metadata_temp));
	$sql = "select field_name, count(*) as thiscount from redcap_data 
			where project_id = ".PROJECT_ID." and event_id in (".prep_implode(array_keys($Proj->eventInfo)).")
			and field_name in (".prep_implode($delFields).") and value != '' group by field_name";
	$q = db_query($sql);
	$delFieldsRecordCount = array();
	while ($row = db_fetch_assoc($q)) {
		$delFieldsRecordCount[$row['field_name']] = $row['thiscount'];
	}
	$html .= "	<div style='color:#F00000;padding:5px;'>
					<b><u>{$lang['database_mods_82']}</u></b>";
	foreach ($delFields as $field) {
		$html .= "	<div style='max-width:500px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&bull; " .
					$field . " &nbsp;<span style='font-size:11px;font-family:tahoma;'>\"" .
					RCView::escape($Proj->metadata[$field]['element_label']) . "</span>\"";
		if (isset($delFieldsRecordCount[$field])) {
			$html .= " (<b>{$delFieldsRecordCount[$field]}</b> ".($longitudinal ? $lang['database_mods_174'] : $lang['database_mods_173']).")";
		}
		$html .= "</div>";
	}
	if (empty($delFields)) {
		$html .= "	<i>{$lang['database_mods_81']}</i>";
	}
	$html .= "	</div>";

	//List all forms to be deleted (in case renamed/deleted form in DD)
	$delForms = array_diff(array_keys($Proj->forms), array_keys($Proj->forms_temp));
	$html .= "	<div style='color:#F00000;padding:5px;'>
					<b><u>{$lang['database_mods_97']}</u></b>";
	foreach ($delForms as $form) {
		$html .= "	<div style='max-width:500px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;'>&nbsp;&nbsp;&nbsp;&nbsp;&bull; " .
					$form . " &nbsp;<span style='font-size:11px;font-family:tahoma;'>\"" .
					RCView::escape($Proj->forms[$form]['menu']) . "</span>\"</div>";
	}
	if (empty($delForms)) {
		$html .= "	<i>{$lang['database_mods_81']}</i>";
	}
	$html .= "	</div>";

	$html .= "</div>";

	return array($newFields, $delFields, $html);

}


/**
 * DISPLAY KEY FOR METADATA CHANGES
 */
function renderMetadataCompareKey() {
	global $lang;
	?>
	<div id="metadataCompareKey" style="padding-left:25px;">
		<table cellspacing="0" cellpadding="0" border="1">
			<tr><td style="padding: 5px; text-align: left; background-color: black; color: white; font-weight: bold;">
				<?php echo $lang['database_mods_83'] ?>
			</td></tr>
			<tr><td style="padding: 5px; text-align: left;">
				<?php echo $lang['database_mods_84'] ?>
			</td></tr>
			<tr><td style="padding: 5px; text-align: left; background-color: #FFFF80;">
				<?php echo $lang['database_mods_85'] ?>
				<font color="#909090"><?php echo $lang['database_mods_86'] ?></font>)
			</td></tr>
			<tr><td style="padding: 5px; text-align: left; background-color: #7BED7B;">
				<?php echo $lang['database_mods_87'] ?>
			</td></tr>
		</table>
	</div>
	<?php
}

/**
 * Display number of fields added/deleted during Draft Mode
 */
function renderCountFieldsAddDel() {
	global $lang;

	// Number of fields added
	$sql = "select count(1) from redcap_metadata_temp where project_id = " . PROJECT_ID . " and field_name
			not in (" . pre_query("select field_name from redcap_metadata where project_id = " . PROJECT_ID) . ")";
	$fields_added = db_result(db_query($sql), 0);
	// Number of fields deleted
	$sql = "select count(1) from redcap_metadata where project_id = " . PROJECT_ID . " and field_name
			not in (" . pre_query("select field_name from redcap_metadata_temp where project_id = " . PROJECT_ID) . ")";
	$field_deleted = db_result(db_query($sql), 0);
	// Field count of new metadata
	$sql = "select count(1) from redcap_metadata_temp where project_id = " . PROJECT_ID;
	$count_new = db_result(db_query($sql), 0);
	// Field count of existing metadata
	$sql = "select count(1) from redcap_metadata where project_id = " . PROJECT_ID;
	$count_existing = db_result(db_query($sql), 0);
	// Render text
	return "<p>
				{$lang['database_mods_88']} <b>$fields_added</b>
				&nbsp;/&nbsp;
				{$lang['database_mods_89']} <b>$count_new</b><br>
				{$lang['database_mods_90']} <b>$field_deleted</b>
				&nbsp;/&nbsp;
				{$lang['database_mods_91']} <b>$count_existing</b>
			</p>";
}

/**
 * Display number of fields added/deleted during Draft Mode
 */
function renderCountFieldsAddDel2()
{
	global $Proj;

	// Count project records
	$num_records = Records::getRecordCount();
	// Number of fields added
	$fields_added = count(array_diff(array_keys($Proj->metadata_temp), array_keys($Proj->metadata)));
	// Fields deleted
	$field_name_deleted = array_diff(array_keys($Proj->metadata), array_keys($Proj->metadata_temp));
	// Number of fields deleted
	$field_deleted = count($field_name_deleted);
	// Field count of new metadata
	$count_new = count($Proj->metadata_temp);
	// Field count of existing metadata
	$count_existing = count($Proj->metadata);
	// Query to find fields deleted that have data
	$field_with_data_deleted = 0;
	if (!empty($field_name_deleted)) {
		$sql = "select count(distinct(field_name)) from redcap_data where project_id = ".PROJECT_ID."
				and field_name in (".prep_implode($field_name_deleted).") and value != ''";
		$q = db_query($sql);
		$field_with_data_deleted = db_result($q, 0);
	}

	// Return values inside array
	return array($num_records, $fields_added, $field_deleted, $field_with_data_deleted, $count_new, $count_existing);
}

## Validate and clean all fields used in branching logic string. Return array of variables that are not real fields.
function validateBranchingCalc($string, $forceMetadataTable=false)
{
	global $status;

	// Use correct metadata table depending on status
	if ($forceMetadataTable) {
		$metadata_table = "redcap_metadata";
	} else {
		$metadata_table = ($status > 0) ? "redcap_metadata_temp" : "redcap_metadata";
	}

	## Clean branching logic syntax
	// Removes trailing spaces and line breaks
	$br_orig = array("\r\n", "\r", "\n");
	$br_repl = array(" ", " ", " ");
	if ($string != "")
	{
		$string = trim(str_replace($br_orig, $br_repl, $string));
		// Remove any illegal characters inside the variable name brackets
		$string = preg_replace_callback("/(\[)([^\[]*)(\])/", "branchingCleanerCallback", html_entity_decode($string, ENT_QUOTES));
	}

	## Validate all fields used in branching logic
	// Create array with fields from submitted branching logic
	$branching_fields = array_keys(getBracketedFields(cleanBranchingOrCalc($string), true, true, true));

	// Create array with braching logic fields that actually exist in metadata
	$sql = "select field_name from $metadata_table where project_id = " . PROJECT_ID . " and field_name
			in ('" . (implode("','", $branching_fields)) . "')";
	$q = db_query($sql);
	$branching_fields_exist = array();
	while ($row = db_fetch_assoc($q)) {
		$branching_fields_exist[] = $row['field_name'];
	}

	// Compare real fields and submitted fields
	$error_fields = array_diff($branching_fields, $branching_fields_exist);
	return $error_fields;
}


// Retrieve name of first form (check metadata or metadata_temp depending on if in development)
function getFirstForm()
{
	global $status;
	$metadata_table = ($status > 0) ? "redcap_metadata_temp" : "redcap_metadata";
	$sql = "select form_name from $metadata_table where project_id = " . PROJECT_ID . " order by field_order limit 1";
	return db_result(db_query($sql), 0);
}

// CHECK IF FIRST EVENT CHANGED. IF SO, GIVING WARNING ABOUT THE PUBLIC SURVEY LINK CHANGING
function checkFirstEventChange($arm)
{
	global $Proj, $lang;
	if (!is_numeric($arm)) return false;
	// Get first event after making the edit (to compare with previous first event)
	$sql = "select e.event_id from redcap_events_metadata e, redcap_events_arms a
			where a.project_id = ".PROJECT_ID." and a.arm_num = $arm and a.arm_id = e.arm_id
			order by e.day_offset, e.descrip limit 1";
	$q = db_query($sql);
	$newFirstEventId = db_result($q, 0);
	$oldFirstEventId = $Proj->getFirstEventIdArm($arm);
	// Check if first event has changed position AND if a public survey exists (i.e. a survey for the first form)
	$firstEventChanged = (!empty($Proj->events[$arm]['events']) && $newFirstEventId != $oldFirstEventId && isset($Proj->forms[$Proj->firstForm]['survey_id']));
	if ($firstEventChanged)
	{
		// Give warning
		?>
		<div class="red" style="margin:10px 0;">
			<b><?php echo $lang['survey_226'] ?></b><br/>
			<?php echo $lang['survey_415'] ?> <b><?php echo $Proj->eventInfo[$oldFirstEventId]['name'] ?></b>
			<?php echo $lang['survey_228'] ?> <b><?php echo $Proj->eventInfo[$newFirstEventId]['name'] ?></b><?php echo $lang['period'] ?>
		</div>
		<?php
	}
}


function alertRecentImportStatus()
{
	global $lang;

	if (!isset($_SESSION['imported'])) return;

	$alert = null;
	$imported = isset($_SESSION['imported']) ? $_SESSION['imported'] : null;
	$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
	$csv_content = isset($_SESSION['csv_content']) ? $_SESSION['csv_content'] : null;
	$count = isset($_SESSION['count']) ? $_SESSION['count'] : 0;
	$preview = isset($_SESSION['preview']) ? $_SESSION['preview'] : "";

	unset($_SESSION['imported'], $_SESSION['count'], $_SESSION['errors'], $_SESSION['csv_content'], $_SESSION['preview']);

	if (!empty($errors))
	{
		// Error popup
		$alert = $lang['design_640'] . "<br><br> &bull; " . implode("<br> &bull; ", $errors);
		$title = $lang['global_01'];
	}
	elseif($csv_content)
	{
		// Preview popup
		switch($imported)
		{
			case 'instr_event_map':
				?><script type="text/javascript">$(function(){ $('#mapping_preview').html('<?php print cleanHtml($preview) ?>');simpleDialog(null,null,'importEventsInstrDialog2',650,null,'<?php print cleanHtml($lang['calendar_popup_01']) ?>',"$('#importEventsInstrForm2').submit();",'<?php print cleanHtml($lang['design_530']) ?>'); fitDialog($('#importEventsInstrDialog2')); $('.ui-dialog-buttonpane button:eq(1)',$('#importEventsInstrDialog2').parent()).css('font-weight','bold'); });</script><?php
				break;
			case 'arms':
				?><script type="text/javascript">$(function(){ $('#arm_preview').html('<?php print cleanHtml($preview) ?>'); simpleDialog(null,null,'importArmsDialog2',500,null,'<?php print cleanHtml($lang['calendar_popup_01']) ?>',"$('#importArmsForm2').submit();",'<?php print cleanHtml($lang['design_530']) ?>'); fitDialog($('#importArmsDialog2')); $('.ui-dialog-buttonpane button:eq(1)',$('#importArmsDialog2').parent()).css('font-weight','bold'); });</script><?php
				break;
			case 'events':
				?><script type="text/javascript">$(function(){ $('#event_preview').html('<?php print cleanHtml($preview) ?>');simpleDialog(null,null,'importEventsDialog2',650,null,'<?php print cleanHtml($lang['calendar_popup_01']) ?>',"$('#importEventsForm2').submit();",'<?php print cleanHtml($lang['design_530']) ?>'); fitDialog($('#importEventsDialog2')); $('.ui-dialog-buttonpane button:eq(1)',$('#importEventsDialog2').parent()).css('font-weight','bold'); });</script><?php
				break;
		}
		return;
	}
	elseif($imported)
	{
		// Confirmation popup of success
		$title = $lang['global_79'];
		switch($imported)
		{
			case 'instr_event_map':
				$alert = "$count $lang[api_94]";
				break;
			case 'arms':
				$alert = "$count $lang[api_95]";
				break;
			case 'events':
				$alert = "$count $lang[api_96]";
				break;
		}
	}

	if($alert)
	{
		?><script type="text/javascript">$(function(){simpleDialog('<?php echo cleanHtml($alert) ?>','<?php echo cleanHtml($title) ?>');});</script><?php
	}
}