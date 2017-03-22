<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


/**
 * FORM Class
 * Contains methods used with regard to forms or general data entry
 */
class Form
{
	/**
	 * BRANCHING LOGIC & CALC FIELDS: CROSS-EVENT FUNCTIONALITY
	 */
	public static function addHiddenFieldsOtherEvents()
	{
		global $Proj, $fetched;
		// Get list of unique event names
		$events = $Proj->getUniqueEventNames();
		// Collect the fields used for each event (so we'll know which data to retrieve)
		$eventFields = array();
		// If field is not on this form, then add it as a hidden field at bottom near Save buttons
		$sql = "select * from (
					select concat(if(branching_logic is null,'',branching_logic), ' ', if(element_enum is null,'',element_enum)) as bl_calc
					from redcap_metadata where project_id = ".PROJECT_ID." and (branching_logic is not null or element_type = 'calc')
				) x where (bl_calc like '%[" . implode("]%' or bl_calc like '%[", $events) . "]%')";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			// Replace unique event name+field_name in brackets with javascript equivalent
			foreach (array_keys(getBracketedFields($row['bl_calc'], true, true)) as $this_field)
			{
				// Skip if doesn't contain a period (i.e. does not have an event name specified)
				if (strpos($this_field, ".") === false) continue;
				// Obtain event name and ensure it is legitimate
				list ($this_event, $this_field) = explode(".", $this_field, 2);
				if (in_array($this_event, $events))
				{
					// Get event_id of unique this event
					$this_event_id = array_search($this_event, $events);
					// Don't add to array if already in array
					if (!in_array($this_field, $eventFields[$this_event_id])) {
						$eventFields[$this_event_id][] = $this_field;
					}
				}
			}
		}
		// Initialize HTML string
		$html = "";
		// Loop through each event where fields are used
		foreach ($eventFields as $this_event_id=>$these_fields)
		{
			// Don't create extra form if it's the same event_id (redundant)
			if ($this_event_id == $_GET['event_id']) continue;
			// First, query each event for its data for this record
			$these_fields_data = array();
			$sql = "select field_name, value from redcap_data where project_id = " . PROJECT_ID . " and event_id = $this_event_id
					and record = '" . prep($fetched) . "' and field_name in ('" . implode("', '", $these_fields) . "')";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q))
			{
				// Save data in array
				if ($Proj->metadata[$row['field_name']]['element_type'] != "checkbox") {
					$these_fields_data[$row['field_name']] = $row['value'];
				} else {
					$these_fields_data[$row['field_name']][] = $row['value'];
				}
			}
			// Get unique event name
			$this_unique_name = $events[$this_event_id];
			// Create HTML form
			$html .= "\n<form autocomplete=\"off\" name=\"form__$this_unique_name\" enctype=\"multipart/form-data\">";
			// Loop through all fields in array
			foreach ($these_fields as $this_field)
			{
				// Non-checkbox field
				if ($Proj->metadata[$this_field]['element_type'] != "checkbox")
				{
					$value = $these_fields_data[$this_field];
					// If this is really a date[time][_seconds] field that is hidden, then make sure we reformat the date for display on the page
					if ($Proj->metadata[$this_field]['element_type'] == 'text')
					{
						if (substr($Proj->metadata[$this_field]['element_validation_type'], -4) == '_mdy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2mdy($this_date) . " " . $this_time);
						} elseif (substr($Proj->metadata[$this_field]['element_validation_type'], -4) == '_dmy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2dmy($this_date) . " " . $this_time);
						}
					}
					$html .= "\n  <input type=\"hidden\" name=\"$this_field\" value=\"$value\">";
				}
				// Checkbox field
				else
				{
					foreach (parseEnum($Proj->metadata[$this_field]['element_enum']) as $this_code=>$this_label)
					{
						if (in_array($this_code, $these_fields_data[$this_field])) {
							$default_value = $this_code;
						} else {
							$default_value = ''; //Default value is 'null' if no present value exists
						}
						$html .= "\n  <input type=\"hidden\" value=\"$default_value\" name=\"__chk__{$this_field}_RC_{$this_code}\">";
					}
				}
			}
			// End form
			$html .= "\n</form>\n";
		}
		if ($html != "") $html = "\n\n<!-- Hidden forms containing data from other events -->$html\n";
		// Return the other events' fields in an HTML form for each event
		return $html;
	}

	// Delete a form from all database tables EXCEPT metadata tables and user_rights table and surveys table
	public static function deleteFormFromTables($form)
	{
		$sql = "delete from redcap_events_forms where form_name = '".prep($form)."'
				and event_id in (" . pre_query("select m.event_id from redcap_events_arms a, redcap_events_metadata m where a.arm_id = m.arm_id and a.project_id = " . PROJECT_ID . "") . ")";
		db_query($sql);
		$sql = "delete from redcap_library_map where project_id = " . PROJECT_ID . " and form_name = '".prep($form)."'";
		db_query($sql);
		$sql = "delete from redcap_locking_labels where project_id = " . PROJECT_ID . " and form_name = '".prep($form)."'";
		db_query($sql);
		$sql = "delete from redcap_locking_data where project_id = " . PROJECT_ID . " and form_name = '".prep($form)."'";
		db_query($sql);
		$sql = "delete from redcap_esignatures where project_id = " . PROJECT_ID . " and form_name = '".prep($form)."'";
		db_query($sql);
	}
	
	//Function for rendering the data entry form list on the right-hand menu
	public static function renderFormMenuList($fetched, $hidden_edit)
	{
		global $surveys_enabled, $Proj, $user_rights, $longitudinal, $userid, $lang, $table_pk_label, $double_data_entry;

		// Collect string of html
		$html = "";
		//Get project_id for this project (may be parent/child project)
		$project_id = PROJECT_ID;
		// Determine the current event_id (may change if using Parent/Child linking)
		$event_id   = (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) ? $_GET['event_id'] : getSingleEvent($project_id);
		
		$entry_num = ($double_data_entry && $user_rights['double_data'] != '0') ? "--".$user_rights['double_data'] : "";
		
		$isCalPopup = (PAGE == "Calendar/calendar_popup.php");
		
		$auto_num_flag = "";
		if (isset($_GET['auto'])) {
			// If creating a new record via auto-numbering, make sure that the "auto" parameter gets perpetuated in the query string, just in case
			$auto_num_flag = "&auto=1";
		}

		//For lock/unlock records and e-signatures, show locks by any forms that are locked (if a record is pulled up on data entry page)
		$locked_forms = array();
		if ((PAGE == "DataEntry/index.php" || $isCalPopup) && isset($fetched))
		{
			$entry_num = isset($entry_num) ? $entry_num : "";
			// Lock records
			$sql = "select form_name, timestamp from redcap_locking_data where project_id = $project_id and event_id = $event_id
					and record = '" . prep($fetched.$entry_num). "' and instance = '".prep($_GET['instance'])."'";
			$q = db_query($sql);
			while ($row = db_fetch_array($q))
			{
				$locked_forms[$row['form_name']] = " <img id='formlock-{$row['form_name']}' src='".APP_PATH_IMAGES."lock_small.png' title='".cleanHtml($lang['bottom_59'])." " . DateTimeRC::format_ts_from_ymd($row['timestamp']) . "'>";
			}
			// E-signatures
			$sql = "select form_name, timestamp from redcap_esignatures where project_id = $project_id and event_id = $event_id
					and record = '" . prep($fetched.$entry_num). "' and instance = '".prep($_GET['instance'])."'";
			$q = db_query($sql);
			while ($row = db_fetch_array($q))
			{
				$this_esignts = " <img id='formesign-{$row['form_name']}' src='".APP_PATH_IMAGES."tick_shield_small.png' title='" . cleanHtml($lang['data_entry_224'] . " " . DateTimeRC::format_ts_from_ymd($row['timestamp'])) . "'>";
				if (isset($locked_forms[$row['form_name']])) {
					$locked_forms[$row['form_name']] .= $this_esignts;
				} else {
					$locked_forms[$row['form_name']] = $this_esignts;
				}
			}
		}

		//Build array with form_name, form_menu_description, and the form status value for this record
		$form_names = $form_info = array();
		foreach ($Proj->forms as $form=>$attr) {
			$form_names[] = $form;
			$form_info[$form]['form_menu_description'] = $attr['menu'];
			$form_info[$form]['form_status'] = '';
		}

		$fetchedlink = $instance_url = '';

		// Data entry page only
		$surveyResponses = array();
		if ((PAGE == "DataEntry/index.php" || $isCalPopup) && isset($fetched))
		{
			// REPEATING FORMS/EVENTS: Check for "instance" number if the form is set to repeat
			$isRepeatingFormOrEvent = $Proj->isRepeatingFormOrEvent($_GET['event_id'], $_GET['page']);
			$isRepeatingEvent = ($isRepeatingFormOrEvent && isset($Proj->RepeatingFormsEvents[$_GET['event_id']]) && !is_array($Proj->RepeatingFormsEvents[$_GET['event_id']]));
			
			// Adapt for Double Data Entry module
			if ($entry_num != "") {
				//This is #1 or #2 Double Data Entry person
				$fetched .= $entry_num;
			}
			// Insert form status values for each form if user is on data entry page
			$sql = "select distinct m.form_name, if(d2.value is null, '0', d2.value) as value, d2.instance
					from (redcap_data d, redcap_metadata m) left join redcap_data d2
					on d2.project_id = m.project_id and d2.record = d.record and d2.event_id = d.event_id
					and d2.field_name = concat(m.form_name, '_complete')
					where d.project_id = $project_id and d.project_id = m.project_id
					and d.record = '".prep($fetched)."' and d.event_id = $event_id and m.element_type != 'calc' and m.field_name != '{$Proj->table_pk}'
					and d.field_name = m.field_name and m.form_name in (".prep_implode($form_names).")";
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q))
			{
				if ($row['instance'] == '') $row['instance'] = '1';
				$form_info[$row['form_name']]['form_status'][$row['instance']] = $row['value'];
			}
			// Adapt for Double Data Entry module
			if ($entry_num != "") {
				//This is #1 or #2 Double Data Entry person
				$fetchedlink = RCView::escape(substr($fetched, 0, -3));
			} else {
				//Normal
				$fetchedlink = RCView::escape($fetched);
			}

			// Determine if record also exists as a survey response for some instruments
			if ($surveys_enabled)
			{
				$surveyResponses = Survey::getResponseStatus($project_id, $fetched, $event_id);
			}
		}
		
		//Loop through each form and display text and colored button
		foreach ($form_info as $form_name=>$info)
		{
			$menu_text = filter_tags($info['form_menu_description']);
			$menu_form_complete_field = $form_name . "_complete";
			$menu_page = APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&page=$form_name&id=$fetchedlink&event_id=$event_id{$auto_num_flag}";

			// Default
			$hold_color_link = "";
			$form_link_classes = "";
			$iconTitle = "{$lang['bottom_48']} $table_pk_label $fetched";
			$hideForm = false;

			//Produce HTML for colored button if an existing record and on data entry page
			if ((PAGE == "DataEntry/index.php" || $isCalPopup) && isset($fetched))
			{
				// Determine if this form is set to repeat
				$isRepeatingForm = ($isRepeatingFormOrEvent && isset($Proj->RepeatingFormsEvents[$_GET['event_id']][$form_name]));
				$numInstances = count($info['form_status']);
				$form_has_multiple_instances = (isset($info['form_status']) && is_array($info['form_status']) && $numInstances > 1);
				$maxInstance = ($form_has_multiple_instances) ? max(array_keys($info['form_status'])) : 1;
				
				// Determine the event instance
				$instance = $_GET['instance'];
				$instance_url = "";
				if (($isRepeatingForm && $form_name == $_GET['page']) || ($longitudinal && $isRepeatingEvent)) {
					// If the current form is a repeating form OR if event is an entire repeating event, then add current instance to form link
					$instance_url = "&instance=$instance";
				} elseif (!$isRepeatingEvent && $form_name != $_GET['page']) {
					// If this is not a repeating event, then always return it back to instance 1 (since form instances are independent)
					$instance = 1;
				}
				
				// If it's a survey response, display different icons
				if (isset($surveyResponses[$fetched][$event_id][$form_name][$instance])) {
					//Determine color of button based on response status
					switch ($surveyResponses[$fetched][$event_id][$form_name][$instance]) {
						case '2':
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_green_tick_stack.png' : 'circle_green_tick.png');
							$iconTitle = $lang['global_94'];
							break;
						default:
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_orange_tick_stack.png' : 'circle_orange_tick.png');
							$iconTitle = $lang['global_95'];
					}
				} else {

					$form_status_instance = (isset($info['form_status']) && isset($info['form_status'][$instance])) ? $info['form_status'][$instance] : '';

					//Determine color of button based on form status value
					switch ($form_status_instance) {
						case '0':
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_red_stack.png' : 'circle_red.png');
							$iconTitle = $lang['global_92'];
							break;
						case '1':
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_yellow_stack.png' : 'circle_yellow.png');
							$iconTitle = $lang['global_93'];
							break;
						case '2':
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_green_stack.png' : 'circle_green.png');
							$iconTitle = $lang['survey_28'];
							break;
						default:
							$holder_color = APP_PATH_IMAGES . ($form_has_multiple_instances ? 'circle_gray_stack.png' : 'circle_gray.png');
							$iconTitle = $lang['global_92'];
					}
				}
				
				// Check if this form in the menu is the current form
				$statusIconStyle = ($form_has_multiple_instances) ? 'width:22px;margin-left:-3px;' : 'width:16px;';
				if ($form_name == $_GET['page']) {
					$form_link_classes = "round form_menu_selected";
				}
				// Make other forms faded out if on an instance of a repeating form
				elseif ($form_name != $_GET['page'] && !$isRepeatingEvent && $_GET['instance'] > 1) {
					$form_link_classes = "formMenuListGrayed";
					// Set status icon as invisible
					$statusIconStyle = 'visibility:hidden;width:16px;';
				}
				
				// If on a repeating form that has multiple instances saved already
				if ($isRepeatingForm && $form_has_multiple_instances) {
					// Add instance number to form label on menu
					$menu_text .= "<span class='repeat_event_count_menu'>(";				
					if ($form_name == $_GET['page']) {
						$menu_text .= "$instance<span>/</span>";
					}
					$menu_text .= ($instance > $maxInstance ? $instance : $maxInstance) . ")</span>";
				}
				
				// HTML for colored button
				if ($hidden_edit) {
					$href = $isCalPopup ? "javascript:;" : "{$menu_page}{$instance_url}";
					$onclick = $isCalPopup ? "onclick=\"window.opener.location.href='{$menu_page}{$instance_url}';self.close();\"" : "";
					$hold_color_link = "<a title='$iconTitle' href='$href' $onclick><img src='$holder_color' style='height:16px;$statusIconStyle'></a>";
				}
			}

			// Set lock icon html, if record-event-form is locked
			$show_lock = isset($locked_forms[$form_name]) ? $locked_forms[$form_name] : "";
			
			// Display normal form links ONLY if user has rights to the form
			if (isset($Proj->forms[$form_name]) && isset($user_rights['forms'][$form_name]) && $user_rights['forms'][$form_name] != "0"
				//&& ((!isDev() && !$longitudinal) || (($longitudinal || isDev()) 
				&& (!$longitudinal || ((PAGE == "DataEntry/index.php" || $isCalPopup) && isset($_GET['event_id']) && in_array($form_name, $Proj->eventsForms[$_GET['event_id']])))
			) {
				// If this is not the Data Entry Page, then keep forms hidden
				$showFormsList = (!$longitudinal && UIState::getUIStateValue(PROJECT_ID, 'sidebar', 'show-instruments-toggle') == '1');
				$hideForm = ((PAGE == "DataEntry/index.php" || $isCalPopup) || $showFormsList) ? "" : "hide";
				$href = $isCalPopup ? "javascript:;" : "{$menu_page}{$instance_url}";
				$onclick = $isCalPopup ? "onclick=\"window.opener.location.href='{$menu_page}{$instance_url}';self.close();\"" : "";				
				// Add form to menu
				$html .= "<div class='formMenuList $hideForm'>$hold_color_link &nbsp;";
				$html .= "<a id='form[$form_name]' class='$form_link_classes' href='$href' $onclick>$menu_text</a>{$show_lock}";
				// Add + button (if not already on a yet-to-exist instance)
				if (isset($fetched) && $isRepeatingForm && $form_status_instance != '') {
					$instance_url = "&instance=".($maxInstance+1);
					$href = $isCalPopup ? "javascript:;" : "{$menu_page}{$instance_url}";
					$onclick = $isCalPopup ? "onclick=\"window.opener.location.href='{$menu_page}{$instance_url}';self.close();\"" : "";	
					$html .= "<a href='$href' $onclick class='btn btn-defaultrc btnAddRptEv' title='".cleanHtml($lang['grid_43'])."'>+</a>";
				}
				$html .= "</div>";
			}
		}

		// Return form count, HTML, and locked form count
		return array(count($form_names), $html, count($locked_forms));
	}
	// ACTION TAGS: Return array of all action tags with tag name as array key and description as array value.
	// If the $onlineDesigner param is passed, it will return only those that are utilized on the Online Designer.
	public static function getActionTags($onlineDesigner=false)
	{
		global $lang, $mobile_app_enabled;
		// Set all elements of array
		$action_tags = array();
		if (!$onlineDesigner) {
			$action_tags['@DEFAULT'] = $lang['design_659'];
			$action_tags['@HIDDEN'] = $lang['design_609'];
			$action_tags['@HIDDEN-FORM'] = $lang['design_610'];
			$action_tags['@HIDDEN-SURVEY'] = $lang['design_611'];
			$action_tags['@READONLY'] = $lang['design_612'];
			$action_tags['@READONLY-FORM'] = $lang['design_613'];
			$action_tags['@READONLY-SURVEY'] = $lang['design_614'];
			$action_tags['@USERNAME'] = $lang['design_660'];
			$action_tags['@LATITUDE'] = $lang['design_629'];
			$action_tags['@LONGITUDE'] = $lang['design_630'];
			$action_tags['@NOW'] = $lang['design_697'];
			$action_tags['@TODAY'] = $lang['design_696'];
			// The following tags are only for when using the Mobile App
			if ($mobile_app_enabled) {
				$action_tags['@HIDDEN-APP'] = $lang['design_625'];
				$action_tags['@APPUSERNAME-APP'] = $lang['design_661'];
				$action_tags['@READONLY-APP'] = $lang['design_626'];
				$action_tags['@BARCODE-APP'] = $lang['design_633'];
				$action_tags['@SYNC-APP'] = $lang['design_702'];
			}
		}
		// The following tags will additionally be implemented on the Online Designer as a previw
		$action_tags['@PLACEHOLDER'] = $lang['design_703'];
		$action_tags['@PASSWORDMASK'] = $lang['design_624'];
		$action_tags['@HIDEBUTTON'] = $lang['design_662'];
		// Order the tags alphabetically by name
		ksort($action_tags);
		// Return array
		return $action_tags;
	}
	

	// ACTION TAGS: Determine if field has a @HIDDEN or @HIDDEN-SURVEY action tag
	public static function hasHiddenOrHiddenSurveyActionTag($action_tags)
	{
		// Explode all action tags into array
		$action_tags_array = explode(" ", $action_tags);
		// @HIDDEN or @HIDDEN-SURVEY?
		return (in_array('@HIDDEN', $action_tags_array) || in_array('@HIDDEN-SURVEY', $action_tags_array));
	}
	

	// ACTION TAGS: Determine if field has a @HIDDEN or @HIDDEN-FORM action tag
	public static function hasHiddenOrHiddenFormActionTag($action_tags)
	{
		// Explode all action tags into array
		$action_tags_array = explode(" ", $action_tags);
		// @HIDDEN or @HIDDEN-SURVEY?
		return (in_array('@HIDDEN', $action_tags_array) || in_array('@HIDDEN-FORM', $action_tags_array));
	}
	

	// ACTION TAGS: Determine if field has a @READONLY action tag
	public static function disableFieldViaActionTag($action_tags, $isSurveyPage=false)
	{
		// Explode all action tags into array
		$action_tags_array = explode(" ", $action_tags);
		// @READONLY
		if (in_array('@READONLY', $action_tags_array)) return true;
		// @READONLY-FORM
		if (!$isSurveyPage && in_array('@READONLY-FORM', $action_tags_array)) return true;
		// @READONLY-SURVEY
		if ($isSurveyPage && in_array('@READONLY-SURVEY', $action_tags_array)) return true;
		// Return false if we got tot his point
		return false;
	}
	

	// ACTION TAGS: Return the value inside quotes for certain action tags (@DEFAULT, @PLACEHOLDER, etc.)
	public static function getValueInQuotesActionTag($field_annotation, $actionTag="@DEFAULT")
	{
		// Obtain the quoted value via regex
		preg_match_all("/(".$actionTag."\s*=\s*)((\"[^\"]+\")|('[^']+'))/", $field_annotation, $matches);
		if (isset($matches[3][0]) && $matches[3][0] != '') {
			// Remove wrapping quotes
			$defaultValue = substr($matches[3][0], 1, -1);
		} elseif (isset($matches[4][0]) && $matches[4][0] != '') {
			// Remove wrapping quotes
			$defaultValue = substr($matches[4][0], 1, -1);
		} else {
			$defaultValue = '';
		}
		// Return the value inside the quotes
		return $defaultValue;
	}
	

	// ACTION TAGS: Create regex string to detect all action tags being used in the Field Annotation
	public static function getActionTagMatchRegex()
	{
		$action_tags_regex_quote = array();
		foreach (self::getActionTags() as $this_trig=>$this_descrip) {
			$action_tags_regex_quote[] = preg_quote($this_trig);
		}
		return "/(" . implode("|", $action_tags_regex_quote) .")($|[^(\-)])/";
	}
	

	// ACTION TAGS: Create regex string to detect all action tags being used in the Field Annotation
	// for ONLINE DESIGNER only (this will only be a minority of the action tags)
	public static function getActionTagMatchRegexOnlineDesigner()
	{
		$action_tags_regex_quote = array();
		foreach (self::getActionTags(true) as $this_trig=>$this_descrip) {
			$action_tags_regex_quote[] = preg_quote($this_trig);
		}
		return "/(" . implode("|", $action_tags_regex_quote) .")($|[^(\-)])/";
	}


	// Render data history log
	public static function renderDataHistoryLog($record, $event_id, $field_name, $instance)
	{
		global $lang, $require_change_reason;
		// Do URL decode of name (because it original was fetched from query string before sent via Post)
		$record = urldecode($record);
		// Set $instance
		$instance = is_numeric($instance) ? (int)$instance : 1;
		// Get data history log
		$time_value_array = self::getDataHistoryLog($record, $event_id, $field_name, $instance);
		// Get highest array key
		$max_dh_key = count($time_value_array)-1;
		// Loop through all rows and add to $rows
		foreach ($time_value_array as $key=>$row)
		{
			$rows .= RCView::tr(array('id'=>($max_dh_key == $key ? 'dh_table_last_tr' : '')),
						RCView::td(array('class'=>'data', 'style'=>'padding:5px 8px;text-align:center;width:150px;'),
							DateTimeRC::format_ts_from_ymd($row['ts']) .
							// Display "lastest change" label for the last row
							($max_dh_key == $key ? RCView::div(array('style'=>'color:#C00000;font-size:11px;padding-top:5px;'), $lang['dataqueries_277']) : '')
						) .
						RCView::td(array('class'=>'data', 'style'=>'border:1px solid #ddd;padding:3px 8px;text-align:center;width:100px;word-wrap:break-word;'),
							$row['user']
						) .
						RCView::td(array('class'=>'data', 'style'=>'border:1px solid #ddd;padding:3px 8px;'),
							$row['value']
						) .
						($require_change_reason
							? 	RCView::td(array('class'=>'data', 'style'=>'border:1px solid #ddd;padding:3px 8px;'),
									$row['change_reason']
								)
							: 	""
						)
					);
		}
		// If no data history log exists yet for field, give message
		if (empty($time_value_array))
		{
			$rows .= RCView::tr('',
						RCView::td(array('class'=>'data', 'colspan'=>($require_change_reason ? '4' : '3'), 'style'=>'border-top: 1px #ccc;padding:6px 8px;text-align:center;'),
							$lang['data_history_05']
						)
					);
		}
		// Output the table headers as a separate table (so they are visible when scrolling)
		$table = RCView::table(array('class'=>'form_border', 'style'=>'table-layout:fixed;border:1px solid #ddd;width:97%;'),
					RCView::tr('',
						RCView::td(array('class'=>'label_header', 'style'=>'padding:5px 8px;width:150px;'),
							$lang['data_history_01']
						) .
						RCView::td(array('class'=>'label_header', 'style'=>'padding:5px 8px;width:100px;'),
							$lang['global_17']
						) .
						RCView::td(array('class'=>'label_header', 'style'=>'padding:5px 8px;'),
							$lang['data_history_03']
						) .
						($require_change_reason
							? 	RCView::td(array('class'=>'label_header', 'style'=>'padding:5px 8px;'),
									$lang['data_history_04']
								)
							: 	""
						)
					)
				);
		// Output table html
		$table .= RCView::div(array('id'=>'data_history3', 'style'=>'overflow:auto;'),
					RCView::table(array('id'=>'dh_table', 'class'=>'form_border', 'style'=>'table-layout:fixed;border:1px solid #ddd;width:97%;'),
						$rows
					)
				  );
		// Return html
		return $table;
	}


	// Get log of data history (returns in chronological ASCENDING order)
	public static function getDataHistoryLog($record, $event_id, $field_name, $instance)
	{
		global $double_data_entry, $user_rights, $longitudinal, $Proj;

		// Set field values
		$field_type = $Proj->metadata[$field_name]['element_type'];

		// Determine if a multiple choice field (do not include checkboxes because we'll used their native logging format for display)
		$isMC = ($Proj->isMultipleChoice($field_name) && $field_type != 'checkbox');
		if ($isMC) {
			$field_choices = parseEnum($Proj->metadata[$field_name]['element_enum']);
		}

		// Format the field_name with escaped underscores for the query
		$field_name_q = str_replace("_", "\\_", $field_name);
		// Fashion the LIKE part of the query appropriately for the field type
		$field_name_q = ($field_type == "checkbox") ?  "%$field_name_q(%) = %checked%" : "%$field_name_q = \'%";
		// Set the 2nd query field (for "file" fields, it will be different)
		$qfield2 = ($field_type == "file") ? "description" : "data_values";
		
		
		// REPEATING FORMS/EVENTS: Check for "instance" number if the form is set to repeat
		$instanceSql = "";
		$isRepeatingFormOrEvent = $Proj->isRepeatingFormOrEvent($event_id, $Proj->metadata[$field_name]['form_name']);
		if ($isRepeatingFormOrEvent) {
			// Set $instance
			$instance = is_numeric($instance) ? (int)$instance : 1;
			if ($instance > 1) {
				$instanceSql = "and data_values like '[instance = $instance]%'";
			} else {
				$instanceSql = "and data_values not like '[instance = %'";
			}
		}

		// Adjust record name for DDE
		if ($double_data_entry && isset($user_rights) && $user_rights['double_data'] != 0) {
			$record .= "--" . $user_rights['double_data'];
		}

		// Default
		$time_value_array = array();

		// Retrieve history and parse field data values to obtain value for specific field
		$sql = "SELECT user, timestamp(ts) as ts, $qfield2 as values1, change_reason FROM redcap_log_event WHERE
				project_id = " . PROJECT_ID . "
				and pk = '" . prep($record) . "'
				and (event_id = $event_id " . ($longitudinal ? "" : "or event_id is null") . ")
				and legacy = 0 $instanceSql
				and
				(
					(
						event in ('INSERT', 'UPDATE')
						and description in ('Create record', 'Update record', 'Update record (import)',
							'Create record (import)', 'Merge records', 'Update record (API)', 'Create record (API)',
							'Update record (DTS)', 'Update record (DDP)', 'Erase survey responses and start survey over',
							'Update survey response', 'Create survey response', 'Update record (Auto calculation)',
							'Update survey response (Auto calculation)', 'Delete all record data for single form',
							'Delete all record data for single event')
						and data_values like '$field_name_q'
					)
					or
					(event = 'DOC_DELETE' and data_values like '%$field_name')
					or
					(event = 'DOC_UPLOAD' and data_values like '%$field_name = \'%\'')
				)";
		$q = db_query($sql);
		// Loop through each row from log_event table. Each will become a row in the new table displayed.
		while ($row = db_fetch_assoc($q))
		{
			// Flag to denote if found match in this row
			$matchedThisRow = false;
			// Get timestamp
			$ts = $row['ts'];
			// Get username
			$user = $row['user'];
			// Decode values
			$value = html_entity_decode($row['values1'], ENT_QUOTES);
			// All field types (except "file")
			if ($field_type != "file")
			{
				// Default return string
				$this_value = "";
				// Split each field into lines/array elements.
				// Loop to find the string match
				foreach (explode(",\n", $value) as $this_piece)
				{
					// Does this line match the logging format?
					$matched = self::dataHistoryMatchLogString($field_name, $field_type, $this_piece);
					// print "<div style='text-align:left;'>LINE: $this_piece<br>Matched: ".($matched === false ? 'false' : 'true')."</div>";
					if ($matched !== false)
					{
						// Set flag that match was found
						$matchedThisRow = true;
						// Stop looping once we have the value (except for checkboxes)
						if ($field_type != "checkbox")
						{
							$this_value = $matched;
							break;
						}
						// Checkboxes may have multiple values, so append onto each other if another match occurs
						else
						{
							$this_value .= $matched . "<br>";
						}
					}
				}

				// If a multiple choice question, give label AND coding
				if ($isMC && $this_value != "")
				{
					$this_value = decode_filter_tags($field_choices[$this_value]) . " ($this_value)";
				}
			}
			// "file" fields
			else
			{
				// Flag to denote if found match in this row
				$matchedThisRow = true;
				// Set value
				$this_value = $value;
			}

			// Add to array (if match was found in this row)
			if ($matchedThisRow) {
				// Set array key as timestamp
				$key = $ts;
				// Ensure that we don't overwrite existing logged events
				while (isset($time_value_array[$key])) $key .= "0";
				// Add to array
				$time_value_array[$key] = array('ts'=>$ts, 'value'=>nl2br(htmlspecialchars(br2nl(label_decode($this_value)), ENT_QUOTES)),
											'user'=>$user, 'change_reason'=>nl2br($row['change_reason']));
			}
		}
		// Sort by timestamp
		asort($time_value_array);
		// Return data history log
		return $time_value_array;
	}


	// Determine if string matches REDCap logging format (based upon field type)
	public static function dataHistoryMatchLogString($field_name, $field_type, $string)
	{
		// If matches checkbox logging
		if ($field_type == "checkbox" && substr($string, 0, strlen("$field_name(")) == "$field_name(") // && preg_match("/^($field_name\()([a-zA-Z_0-9])(\) = )(checked|unchecked)$/", $string))
		{
			return $string;
		}
		// If matches logging for all fields (excluding checkboxes)
		elseif ($field_type != "checkbox" && substr($string, 0, strlen("$field_name = '")) == "$field_name = '")
		{
			// Remove apostrophe from end (if exists)
			if (substr($string, -1) == "'") $string = substr($string, 0, -1);
			$value = substr($string, strlen("$field_name = '"));
			return ($value === false ? '' : $value);
		}
		// Did not match this line
		else
		{
			return false;
		}
	}


	// Parse the element_enum column into the 3 slider labels (if only 1 assume Left; if 2 asssum Left&Right)
	public static function parseSliderLabels($element_enum)
	{
		// Explode into array, where strings should be delimited with pipe |
		$slider_labels  = array();
		$slider_labels2 = array('left'=>'','middle'=>'','right'=>'');
		foreach (explode("|", $element_enum, 3) as $label)
		{
			$slider_labels[] = trim($label);
		}
		// Set keys
		switch (count($slider_labels))
		{
			case 1:
				$slider_labels2['left']   = $slider_labels[0];
				break;
			case 2:
				$slider_labels2['left']   = $slider_labels[0];
				$slider_labels2['right']  = $slider_labels[1];
				break;
			case 3:
				$slider_labels2['left']   = $slider_labels[0];
				$slider_labels2['middle'] = $slider_labels[1];
				$slider_labels2['right']  = $slider_labels[2];
				break;
		}
		// Return array
		return $slider_labels2;
	}


	// Get all options for drop-down displaying all project fields
	public static function getFieldDropdownOptions($removeCheckboxFields=false, $includeMultipleChoiceFieldsOnly=false,
												   $includeDAGoption=false, $includeEventsOption=false)
	{
		global $Proj, $lang;
		// Set array with initial "select a field" option
		$rc_fields = array(''=>'-- '.$lang['random_02'].' --');
		// Add the events field (if specified)
		if ($includeEventsOption) {
			$rc_fields[DataExport::LIVE_FILTER_EVENT_FIELD] = '['.$lang['global_45'].']';
		}
		// Add the DAG field (if specified)
		if ($includeDAGoption) {
			$rc_fields[DataExport::LIVE_FILTER_DAG_FIELD] = '['.$lang['global_22'].']';
		}
		// Build an array of drop-down options listing all REDCap fields
		foreach ($Proj->metadata as $this_field=>$attr1) {
			// Skip descriptive fields
			if ($attr1['element_type'] == 'descriptive') continue;
			// Skip checkbox fields if flag is set
			if ($removeCheckboxFields && $attr1['element_type'] == 'checkbox') continue;
			// Skip non-multiple choice fields, if specified
			if ($includeMultipleChoiceFieldsOnly && !$Proj->isMultipleChoice($this_field)) continue;
			// Add to fields/forms array. Get form of field.
			$this_form_label = $Proj->forms[$attr1['form_name']]['menu'];
			// Clean the label
			$attr1['element_label'] = strip_tags($attr1['element_label']);
			// Truncate label if long
			if (strlen($attr1['element_label']) > 65) {
				$attr1['element_label'] = trim(substr($attr1['element_label'], 0, 47)) . "... " . trim(substr($attr1['element_label'], -15));
			}
			$rc_fields[$this_form_label][$this_field] = "$this_field \"{$attr1['element_label']}\"";
		}
		// Return all options
		return $rc_fields;
	}


	// Return boolean if a calc field's equation in Draft Mode is being changed AND that field contains some data
	public static function changedCalculationsWithData()
	{
		global $Proj, $status;
		// On error, return false
		if ($status < 1 || empty($Proj->metadata_temp)) return false;
		// Add field to array if has a calculation change
		$calcs_changed = array();
		// Loop through drafted changes
		foreach ($Proj->metadata_temp as $this_field=>$attr1) {
			// Skip non-calc fields
			if ($attr1['element_type'] != 'calc') continue;
			// If field does not yet exist, then skip
			if (!isset($Proj->metadata[$this_field])) continue;
			// Compare the equation for each
			if (trim(label_decode($attr1['element_enum'])) != trim(label_decode($Proj->metadata[$this_field]['element_enum']))) {
				$calcs_changed[] = $this_field;
			}
		}
		// Return false if no calculations changed
		if (empty($calcs_changed)) return false;
		// Query to see if any data exists for any of these changed calc fields
		$sql = "select 1 from redcap_data where project_id = ".PROJECT_ID."
				and field_name in (".prep_implode($calcs_changed).") and value != '' limit 1";
		$q = db_query($sql);
		// Return true if any calc fields that were changed have data in them
		return (db_num_rows($q) > 0);
	}


	// Add web service values into cache table
	public static function addWebServiceCacheValues($project_id, $service, $category, $value, $label)
	{
		// First, check if it's already in the table. If so, return false
		if (self::getWebServiceCacheValues($project_id, $service, $category, $value) != '') {
			return false;
		}
		// Add to table
		$sql = "insert into redcap_web_service_cache (project_id, service, category, value, label)
				values ($project_id, '".prep($service)."', '".prep($category)."', '".prep($value)."', '".prep($label)."')";
		$q = db_query($sql);
		return db_insert_id();
	}


	// Obtain web service label from cache table of one item
	public static function getWebServiceCacheValues($project_id, $service, $category, $value)
	{
		// If value is blank, then return blank
		if ($value == '') return '';
		// Query table
		$sql = "select label from redcap_web_service_cache where project_id = $project_id
				and service = '".prep($service)."' and category = '".prep($category)."' and value = '".prep($value)."'";
		$q = db_query($sql);
		return (!db_num_rows($q) ? '' : db_result($q, 0));
	}


	// Perform server-side validation
	public static function serverSideValidation($postValues=array())
	{
		global $Proj;
		// Set array to collect any errors in server side validation
		$errors = array();
		// Create array of all field validation types and their attributes
		$valTypes = getValTypes();
		// Loop through submitted fields
		foreach ($postValues as $field=>$val)
		{
			// Make sure this is a real field, first
			if (!isset($Proj->metadata[$field])) continue;
			// Skip the record ID field
			if ($field == $Proj->table_pk) continue;
			// If a blank value, then skip
			if ($val == '') continue;
			// Get validation type
			$val_type = $Proj->metadata[$field]['element_validation_type'];
			// If field is multiple choice field, then validate its value
			if ($Proj->isMultipleChoice($field)) {
				// Parse the field's choices
				$enum = $Proj->metadata[$field]['element_enum'];
				$choices = ($Proj->metadata[$field]['element_type'] == 'sql') ? parseEnum(getSqlFieldEnum($enum)) : parseEnum($enum);
				// If not a valid choice, then add to errors array
				if (!isset($choices[$val])) $errors[$field] = $val;
			} 
			// If field is text field with validation
			elseif ($Proj->metadata[$field]['element_type'] == 'text' && $val_type != '') {
				// Get the regex
				if ($val_type == 'int') $val_type = 'integer';
				elseif ($val_type == 'float') $val_type = 'number';
				if (!isset($valTypes[$val_type])) continue;
				$regex = $valTypes[$val_type]['regex_php'];
				// Run the value through the regex pattern
				preg_match($regex, $val, $regex_matches);
				// Was it validated? (If so, will have a value in 0 key in array returned.)
				$failed_regex = (!isset($regex_matches[0]));
				// Set error message if failed regex
				if ($failed_regex) $errors[$field] = $val;
			}			
		}		
		
		// Remove any fields from POST if they failed server-side validation
		Form::removeFailedServerSideValidationsPost($errors);
		
		// Add the failed server-side validations to session to pick up elsewhere
		if (!empty($errors)) $_SESSION['serverSideValErrors'] = $errors;
		
		// Return errors
		return $errors;
	}
	
	// Remove any fields from POST if they failed server-side validation
	public static function removeFailedServerSideValidationsPost($serverSideValErrors=array())
	{
		foreach ($serverSideValErrors as $field=>$val) {
			unset($_POST[$field]);
		}
	}
	
	// Display dialog if server-side validation was violated
	public static function displayFailedServerSideValidationsPopup($serverSideValErrors)
	{
		global $lang, $Proj;
		// Obtain the field labels
		$fieldLabels = array();
		$fields = explode(",", strip_tags($serverSideValErrors));
		foreach ($fields as $field) {
			if (!isset($Proj->metadata[$field])) continue;
			$label = strip_tags(label_decode($Proj->metadata[$field]['element_label']));
			if (strlen($label) > 60) $label = substr($label, 0, 40)."...".substr($label, -18);
			$fieldLabels[] = $label;			
		}
		// Output hidden dialog div 
		print 	RCView::div(array('id'=>'serverside_validation_violated', 'class'=>'simpleDialog'),
					RCView::div(array('style'=>'padding-bottom:10px;'), $lang['data_entry_271']) .
					RCView::div(array('style'=>'font-weight:bold;'), $lang['data_entry_272']) .
					"<ul><li>\"" . implode("\"</li><li>\"", $fieldLabels) . "\"</li></ul>"
				);
		// Javascript
		?>
		<script type='text/javascript'>
		$(function(){
			setTimeout(function(){
				// POP-UP DIALOG
				$('#serverside_validation_violated').dialog({ bgiframe: true, modal: true, width: (isMobileDevice ? $(window).width() : 500), open: function(){fitDialog(this)},
					title: '<?php echo cleanHtml(RCView::img(array('src'=>'exclamation_frame.png','style'=>'vertical-align:middle;')) . RCView::span(array('style'=>'vertical-align:middle;'), "{$lang['global_48']}{$lang['colon']} {$lang['data_entry_270']}")) ?>',
					buttons: {
						Close: function() { $(this).dialog('close'); }
					}
				});
			},(isMobileDevice ? 1500 : 0));
		});
		</script>
		<?php
	}

}