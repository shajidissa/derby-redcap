<?php
/***********************************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
************************************************************************************************************/
// Call Shared Library functions
require_once APP_PATH_DOCROOT . 'SharedLibrary/functions.php';
// Call survey_functions
require_once APP_PATH_DOCROOT . "Surveys/survey_functions.php";
// Render a form
function form_renderer($elements, $element_data=array(), $hideFields=array())
{
	// Global variables needed
	global $project_id, $app_name, $user_rights, $reset_radio, $edoc_field_option_enabled, $hidden_edit, $multiple_arms,
		   $table_pk, $table_pk_label, $this_form_menu_name, $sql_fields, $sendit_enabled, $Proj, $double_data_entry, $isIpad,
		   $lang, $history_widget_enabled, $surveys_enabled, $isMobileDevice, $isIOS, $isIE, $isTablet, $secondary_pk, $longitudinal, $display_today_now_button,
		   $enable_edit_survey_response, $randomization, $custom_record_label, $data_resolution_enabled,
		   $survey_auth_enabled, $survey_auth_apply_all_surveys, $enable_field_attachment_video_url,
		   $pageFields, $question_by_section, $totalPages;
	// Is this form being displayed as a survey?
	$isSurveyPage = ((isset($_GET['s']) && PAGE == "surveys/index.php" && defined("NOAUTH")) || PAGE == "Surveys/theme_view.php");
	// Defaults
	$table_width = "";
	$bookend1 = '';
	$bookend2 = '';
	$bookend3 = '';
	$colClassLeft  	  = $isSurveyPage ? 'col-xs-6' : 'col-xs-7';
	$colClassRight 	  = 'col-xs-5';
	$colClassCombined = $isSurveyPage ? 'col-xs-11' : 'col-xs-12';
	// Alter how records are saved if project is Double Data Entry (i.e. add --# to end of Study ID)
	$entry_num = ($double_data_entry && $user_rights['double_data'] != 0) ? "--".$user_rights['double_data'] : "";
	// For surveys, is question auto numbering enabled?
	if ($isSurveyPage)
	{
		$question_auto_numbering = $Proj->surveys[$Proj->forms[$_GET['page']]['survey_id']]['question_auto_numbering'];
	}
	// Set image onload for IE due to random image loading issues related to image width
	$surveyImgOnload = ($isSurveyPage && vIE() > 7) ? " onload='imgSizeIE(this)'" : "";
	## SECONDARY UNIQUE IDENTIFIER
	// For longitudinal projects, if 2ndary id is changed, then change for ALL events that use that form.
	if ($secondary_pk != '' & $longitudinal && PAGE == 'DataEntry/index.php' && isset($_GET['id'])
		&& $_GET['page'] == $Proj->metadata[$secondary_pk]['form_name'])
	{
		// Form name of secondary id
		$secondary_pk_form = $Proj->metadata[$secondary_pk]['form_name'];
		// Store events where secondary id's form is used
		$secondary_pk_form_events = array();
		// Check if other events use this form
		foreach ($Proj->eventsForms as $this_event_id=>$these_forms) {
			if (in_array($secondary_pk_form, $these_forms)) {
				// Get first event that uses the secondary id's form
				if (!isset($secondary_pk_form_first_event)) {
					$secondary_pk_form_first_event = $this_event_id;
				}
				// Collect all events where the form is used
				$secondary_pk_form_events[] = $this_event_id;
			}
		}
		// Add special note to display under $secondary_pk field ONLY IF this form is used on multiple events
		if (count($secondary_pk_form_events) > 1) {
			$secondary_pk_note = "<span class='note' style='color:#666;'>({$lang['data_entry_125']})</span><div class='note' style='color:#800000;'>{$lang['data_entry_113']}</div>";
		}
	}
	// Use different form name/id for Randomization widget pop-up
	$formJsName = (PAGE == 'Randomization/randomize_record.php') ? 'random_form' : 'form';
	/**
	 * Begin form
	 */
	if (!(PAGE == 'Design/online_designer_render_fields.php' && isset($_GET['edit_question'])))
	{
		print "<form autocomplete='off' action='" . PAGE_FULL;
		if (isset($_GET['pid']) && !$isSurveyPage) {
			// Add strings to form action, if a form and not a survey
			print "?pid=$project_id";
			// Display event_id and page from URL, if exist
			if (isset($_GET['page'])) {
				print "&event_id=".(isset($_GET['event_id']) && is_numeric($_GET['event_id']) ? $_GET['event_id'] : $Proj->firstEventId)
					. "&page=".$_GET['page'];
			}
			// If performing Save-and-Continue when editing a survey response, keep as still editing when page reloads
			if (isset($_GET['editresp']) && $_GET['editresp']) {
				print "&editresp=1";
			}
			// Repeating event instance
			print "&instance=" . $_GET['instance'];
		} elseif ($isSurveyPage) {
			// If this is a survey, then pass 's' URL variable in form action
			print "?s=".$_GET['s'];
			// If viewing survey in Preview mode, keep "preview" variable in URL
			if (isset($_GET['preview'])) {
				print "&preview=".$_GET['preview'];
			}
			// Set table attributes
			$table_width = "style='display:none;' id='questiontable'";
		} elseif (PAGE == 'install.php' && isset($_GET['version'])) {
			// If on install page
			print "?version=".$_GET['version'];
		}
		// If we are on Control Center page, use "project" and "view" URL variables
		if (isset($_GET['view']) && !$isSurveyPage) {
			print "?view=".$_GET['view'];
			print isset($_GET['project']) ? "&project=".$_GET['project'] : "";
		}
		// Finish form tag
		print "' enctype='multipart/form-data' target='_self' method='post' name='$formJsName' id='$formJsName'>";
	}
	// Go ahead and manually add the CSRF token even though jQuery will automatically add it after DOM loads.
	// (This is done in case the page is very long and user submits form before the DOM has finished loading.)
	print "<input type='hidden' name='redcap_csrf_token' value='".System::getCsrfToken()."'>";
	
	
	// READ-ONLY MODE (disable all fields on the page)
	// Set default if all fields should be disabled
	$disable_all = false;
	// Disable if user has read-only rights
	if ((PAGE == "DataEntry/index.php") && isset($_GET['id'])
		&& isset($user_rights) && $user_rights['forms'][$_GET['page']] == '2')
	{
		$disable_all = true;
	}

	// Determine if another user is on this form for this record for this project (do not allow the page to load, if so)
	$otherUserOnPage = checkSimultaneousUsers();
	if (!$disable_all && $otherUserOnPage !== false)
	{
		// Set disable all flag
		$disable_all = true;
		// If the edit survey flag exists, then remove it
		if (isset($_GET['editresp'])) unset($_GET['editresp']);
		// Obtain other user's email/name for display
		$q = db_query("select * from redcap_user_information where username = '" . prep($otherUserOnPage) . "'");
		$otherUserEmail = db_result($q, 0, "user_email");
		$otherUserName = db_result($q, 0, "user_firstname") . " " . db_result($q, 0, "user_lastname");
		// Display msg to user
		print  "<div class='yellow' style='margin:15px 0;padding:10px;'>
					<div>
						<img src='".APP_PATH_IMAGES."exclamation_orange.png'>
						<b>{$lang['data_entry_279']}</b><br><br>
						{$lang['data_entry_78']} (<b>$otherUserOnPage</b> - <a href='mailto:$otherUserEmail'>$otherUserName</a>)
						{$lang['data_entry_79']} (\"<b>{$_GET['id']}</b>\"){$lang['period']} {$lang['data_entry_280']}
					</div>
					<div id='errconflict' class='brown' style='display:none;margin:10px 0;'>
						{$lang['data_entry_81']} ($autologout_timer {$lang['data_entry_82']}){$lang['data_entry_83']}
					</div>
					<div style='margin-top:10px;'>
						<table style='width:100%;'><tr>
						<td>
							<button onclick='window.location.reload();return false;'>{$lang['data_entry_84']}</button>
						</td>
						<td style='text-align:right;'>
							<a href='javascript:;' onclick=\"$(this).remove();$('#errconflict').show('fast');\" style='font-size:11px;'>{$lang['data_entry_85']}</a>
						</td>
						</tr></table>
					</div>
				</div>";
	}
	
	// Begin div and set width
	if ($isMobileDevice || $isSurveyPage) {
		print "<div>";
	} else {
		print "<div style='max-width:800px;'>";
	}
	if ($isSurveyPage || ((PAGE == "DataEntry/index.php") && isset($_GET['id'])))
	{
		## MATRIX RANKING
		// Set invisible div that says "value removed" if user clicks same column for another field in the matrix
		print RCView::span(array('id'=>'matrix_rank_remove_label', 'class'=>'opacity75', 'style'=>'display:none;'), $lang['data_entry_203']);
		## PIPING
		// Create array as field list of piping transmitters (i.e. fields to be replaced in field labels)
		$piping_transmitter_fields = array();
		// Create array as event list of piping transmitters (solely for the data pull)
		$piping_transmitter_events = array(); // may contain be event_ids and unique event names
		// Set array to denote which fields/attributes in $elements need to be replaced (so we don't have to scan the whole array a second time)
		$elements_replace = array();
		// Put all drop-down fields that are piping receivers into special array so we can do ajax requests if their transmitter is changed.
		// Keys will be piping transmitters, and values will be receiver field drop-downs.
		$piping_receiver_dropdown_fields = array();
		// Set array of field attributes to look at in $elements
		$elements_attr_to_replace = array('label', 'enum', 'value', 'note', 'slider_labels');
		// Loop through all fields to be displayed on this form/survey
		foreach ($elements as $key=>$attr)
		{
			// Ignore some field types that aren't applicable
			if ($attr['rr_type'] == 'hidden' || $attr['rr_type'] == 'static') continue;
			// Loop through all relevant field attributes for this field
			foreach ($elements_attr_to_replace as $this_attr_type)
			{
				// Skip if field doesn't have current attribute
				if (!isset($attr[$this_attr_type])) continue;
				// Set array of elements to loop through
				$these_strings = ($this_attr_type == 'slider_labels') ? $attr[$this_attr_type] : array($attr[$this_attr_type]);
				// Loop through string(s)
				foreach ($these_strings as $this_key=>$this_string)
				{
					// If a field, check field label
					if ($this_string != '' && strpos($this_string, '[') !== false && strpos($this_string, ']') !== false)
					{
						// Set flag to add this field/attribute to the elements_replace array
						$replace_this_attr = false;
						// Replace field label
						foreach (array_keys(getBracketedFields($this_string, true, true, false)) as $this_field) {
							// If longitudinal with a dot, parse it out
							if (strpos($this_field, '.') !== false) {
								// Separate event from field
								list ($this_event, $this_field) = explode(".", $this_field, 2);
							} else {
								// Set this_event as current event_id
								$this_event = $_GET['event_id'];
							}
							// Validate field name
							if (!isset($Proj->metadata[$this_field])) continue;
							// Add field and event to transmitter arrays
							$piping_transmitter_fields[] = $this_field;
							$piping_transmitter_events[] = $this_event;
							// Set flag
							$replace_this_attr = true;
							// If field is a drop-down and has choice option as a piping receiver, put in array for later.
							// Keys will be piping transmitters, and values will be receiver field drop-downs.
							if ($attr['rr_type'] == 'select' && $this_attr_type == 'enum') {
								$piping_receiver_dropdown_fields[$this_field][] = $attr['field'];
							}
						}
						// Add key and attribute type to elements_replace so we can replace in $elements w/o having to loop
						// through the entire $elements array a second time below.
						if ($replace_this_attr)	$elements_replace[$key][] = $this_attr_type;
					}
				}
			}
		}
		// If there are strings to replace, then get data for fields/events and do replacing
		if (!empty($elements_replace))
		{
			## REPLACE FIELDS IN STRING WITH DATA
			// Set piping transmitter fields/events as unique
			$piping_transmitter_fields = array_unique($piping_transmitter_fields);
			$piping_transmitter_events = array_unique($piping_transmitter_events);
			// Obtain saved data for all piping receivers used in field labels and MC option labels
			$piping_record_data = Records::getData('array', $_GET['id'].$entry_num, $piping_transmitter_fields, $piping_transmitter_events);
			// Now loop through all fields again and replace those that need replacing
			foreach ($elements_replace as $key=>$attr) {
				// Loop through each attribute and REPLACE
				foreach ($attr as $this_attr_type) {
					// Slider only: loop through slider label options
					if ($this_attr_type == 'slider_labels') {
						foreach ($elements[$key][$this_attr_type] as $this_skey=>$this_slabel) {
							$elements[$key][$this_attr_type][$this_skey] = Piping::replaceVariablesInLabel($this_slabel, $_GET['id'].$entry_num, $_GET['event_id'], $_GET['instance'], $piping_record_data);
						}
					}
					// All other fields besides sliders
					else {
						$elements[$key][$this_attr_type] = Piping::replaceVariablesInLabel($elements[$key][$this_attr_type], $_GET['id'].$entry_num, $_GET['event_id'], $_GET['instance'], $piping_record_data);
					}
				}
			}
			## CREATE JQUERY TRIGGERS FOR REAL-TIME PIPING ON PAGE
			// Parse out trasmitter fields by field type
			$piping_transmitter_fields_types = array('text'=>array(), 'radio'=>array(), 'select'=>array(), 'calc'=>array());
			$piping_transmitter_fields_survey_prefill = "";
			foreach ($piping_transmitter_fields as $this_field) {
				// Get thid field's field type
				$this_type = $Proj->metadata[$this_field]['element_type'];
				// If survey questions are being pre-filled via query string or Post pre-fill method, then trigger them after page load
				// so that the pre-filled value gets piped.
				$isPipingTransmitterPrefilledOnSurvey = ($isSurveyPage && (($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$this_field]))
														|| (isset($_POST['__prefill']) && isset($_POST[$this_field]))));
				// Add to sub-array based on field type
				// NOTE: Slider fields will be handled independently in enableSldr() in base.js
				if ($this_type == 'text') {
					$piping_transmitter_fields_types['text'][] = "form#form :input[name='$this_field']";
				} elseif ($this_type == 'textarea') {
					$piping_transmitter_fields_types['text'][] = "form#form textarea[name='$this_field']";
				} elseif (in_array($this_type, array('radio', 'yesno', 'truefalse'))) {
					$piping_transmitter_fields_types['radio'][] = "form#form :input[name='{$this_field}___radio']";
				} elseif ($this_type == 'select' || $this_type == 'sql') {
					$piping_transmitter_fields_types['dropdown'][] = "form#form select[name='$this_field']";
				} elseif ($this_type == 'calc') {
					$piping_transmitter_fields_types['calc'][] = "form#form :input[name='$this_field']";;
				}
				// If the field is pre-filled on a survey, set jQuery trigger
				if ($isPipingTransmitterPrefilledOnSurvey) {
					if (in_array($this_type, array('text', 'textarea', 'calc'))) {
						$piping_transmitter_fields_survey_prefill .= "$('form#form :input[name=\"{$this_field}\"]').trigger('blur');";
					} elseif (in_array($this_type, array('radio', 'yesno', 'truefalse'))) {
						$piping_transmitter_fields_survey_prefill .= "$('form#form :input[name=\"{$this_field}___radio\"]:checked').trigger('click');";
					} elseif (in_array($this_type, array('select', 'sql'))) {
						$piping_transmitter_fields_survey_prefill .= "$('form#form select[name=\"{$this_field}\"]').trigger('change');";
					}
				}
			}
			// Set name of page for ajax request (for surveys, use passthru mechanism)
			if ($isSurveyPage) {
				$piping_dropdown_replace_page = APP_PATH_SURVEY . "index.php?s={$_GET['s']}&__passthru=".urlencode("DataEntry/piping_dropdown_replace.php");
			} else {
				$piping_dropdown_replace_page = APP_PATH_WEBROOT . "DataEntry/piping_dropdown_replace.php?pid=$project_id";
			}
			// JavaScript to perform real-time dynamic piping on forms/survey pages
			?>
			<script type="text/javascript">
			// PIPING
			<?php if (!empty($piping_transmitter_fields_types['calc'])) { ?>
			// Update any calc field piping receivers on the page
			function updateCalcPipingReceivers(isOnPageLoad) {
				// Calc fields (do not run when page loads but only as calc fields get updated later)
				if (!isOnPageLoad) {
					$("<?php print implode(", ", $piping_transmitter_fields_types['calc']) ?>").each(function(){
						var val = ($(this).val() != '') ? $(this).val() : '<?php print Piping::missing_data_replacement ?>';
						var name = $(this).attr('name');
						// Set value for all piping receivers on page
						$('.<?php print Piping::piping_receiver_class.".".Piping::piping_receiver_class_field ?>'+event_id+'-'+name).html(val);
						// Update drop-down options separately via ajax
						updatePipingDropdowns(name,val);
					});
				}
			}
			<?php } ?>
			// Update drop-down options that are piping receivers via ajax. Returns json of drop-down options to replace on page.
			function updatePipingDropdowns(transmitter_field,transmitter_field_value) {
				<?php if (!empty($piping_receiver_dropdown_fields)) { ?>
				// Set array of transmitter fields that are triggers. If field not in this array, then stop here.
				var piping_transmitter_fields = new Array(<?php print prep_implode(array_keys($piping_receiver_dropdown_fields)) ?>);
				if (!in_array(transmitter_field, piping_transmitter_fields)) return false;
				// Set json string to send
				var json_piping_receiver_dropdown_fields = '<?php print json_encode($piping_receiver_dropdown_fields) ?>';
				// Ajax request
				$.post('<?php print $piping_dropdown_replace_page ?>',{ formdata: JSON.stringify($('#form').serializeObject()), record: '<?php echo cleanHtml($_GET['id']) ?>', event_id: event_id, json_piping_receiver_dropdown_fields: json_piping_receiver_dropdown_fields, transmitter_field: transmitter_field, transmitter_field_value: transmitter_field_value },function(data){
					if (data != '') {
						// Parse JSON and update all affected drop-down fields' options with new text
						var json_data = jQuery.parseJSON(data);
						// Loop through fields
						for (var this_field in json_data) {
							for (var this_code in json_data[this_field]) {
								var this_label = json_data[this_field][this_code];
								// Update this option for this field
								$("form#form select[name='"+this_field+"'] option[value='"+this_code+"']").html( this_label );
							}
							// Update autocomplete options, if dropdown using autocomplete
							if ($("form#form select[name='"+this_field+"'].rc-autocomplete").length) {
								$("form#form select[name='"+this_field+"']").removeClass('rc-autocomplete-enabled');
								$("form#form table tr#"+this_field+"-tr input.rc-autocomplete, form#form table tr#"+this_field+"-tr button.rc-autocomplete").unbind();
								$("form#form table tr#"+this_field+"-tr input.rc-autocomplete").autocomplete("destroy");
							}
						}
						// Update autocomplete options
						enableDropdownAutocomplete();
					}
				});
				<?php } ?>
			}
			// Piping transmitter field triggers
			$(function(){
				<?php if (!empty($piping_transmitter_fields_types['text'])) { ?>
					// Text fields
					$("<?php print implode(", ", $piping_transmitter_fields_types['text']) ?>").blur(function(){
						var val = ($(this).val() != '') ? nl2br(filter_tags($(this).val())) : '<?php print Piping::missing_data_replacement ?>';
						var name = $(this).attr('name');
						// Set value for all piping receivers on page
						$('.<?php print Piping::piping_receiver_class.".".Piping::piping_receiver_class_field ?>'+event_id+'-'+name).html(val);
						// Update drop-down options separately via ajax
						updatePipingDropdowns(name,val);
					});
				<?php } ?>
				<?php if (!empty($piping_transmitter_fields_types['radio'])) { ?>
					// Radio fields
					$("<?php print implode(", ", $piping_transmitter_fields_types['radio']) ?>").click(function(){
						// Remove "___radio" from end of name
						var name = $(this).attr('name').substring(0, $(this).attr('name').length-8);
						var label = $(this).parent().html();
						// Remove radio input from label
						if ($(this).attr('label') != null) {
							label = $(this).attr('label');
						} else {
							label = label.substring(label.indexOf('>')+2);
						}
						var val = ($(this).val() != '') ? $(this).val() : '<?php print Piping::missing_data_replacement ?>';
						// Set value for all piping receivers on page
						$('.<?php print Piping::piping_receiver_class.".".Piping::piping_receiver_class_field ?>'+event_id+'-'+name).html(label);
						// Update drop-down options separately via ajax
						updatePipingDropdowns(name,val);
					});
				<?php } ?>
				<?php if (!empty($piping_transmitter_fields_types['dropdown'])) { ?>
					// Drop-down fields
					$("<?php print implode(", ", $piping_transmitter_fields_types['dropdown']) ?>").change(function(){
						var name = $(this).attr('name');
						var val = ($(this).val() != '') ? $(this).val() : '<?php print Piping::missing_data_replacement ?>';
						// Find selected option to get its label
						var label = ($(this).val() != '') ? $("form#form select[name='"+name+"'] option:selected").text() : '<?php print Piping::missing_data_replacement ?>';
						// Set value for all piping receivers on page
						$('.<?php print Piping::piping_receiver_class.".".Piping::piping_receiver_class_field ?>'+event_id+'-'+name).html(label);
						// Update drop-down options separately via ajax
						updatePipingDropdowns(name,val);
					});
				<?php }
				// Survey only: If any piping transmitters are pre-filled on a survey, then add JS to trigger them after page load to perform piping.
				print $piping_transmitter_fields_survey_prefill;
				?>
			});
			</script>
			<?php
			// Remove variables no longer needed
			unset($elements_replace, $piping_record_data, $piping_transmitter_fields_types);
		}
		## Render temporary "loading.." div while page is loading (only show after delay of 0.75 seconds)
		print  "<div id='questiontable_loading'>
					<img src='".APP_PATH_IMAGES."progress_circle.gif'> {$lang['data_entry_64']}
				</div>
				<script type='text/javascript'>
					setTimeout(function(){
						document.getElementById('questiontable_loading').style.visibility='visible';
					},750);
				</script>";
	}
	// Set flag that form is not locked (default)
	$form_locked = array('status'=>false);
	## RANDOMIZATION
	if ($isSurveyPage || ((PAGE == "DataEntry/index.php") && isset($_GET['id'])))
	{
		// Check if randomization has been enabled
		$randomizationEnabled = ($randomization && Randomization::setupStatus());
		// If enabled, get randomization field and criteria fields
		if ($randomizationEnabled)
		{
			// Get randomization attributes
			$randAttr = Randomization::getRandomizationAttributes();
			// Set fields for reference later
			$randomizationField = $randAttr['targetField'];
			$randomizationEvent = $randAttr['targetEvent'];
			$randomizationCriteriaFields = $randAttr['strata'];
			$randomizationGroupBy = $randAttr['group_by'];
			// Determine if this record has already been randomized
			$wasRecordRandomized = Randomization::wasRecordRandomized($_GET['id']);
			// If record was randomized and grouping by DAG, then disable DAG drop-down for all events
			if ($wasRecordRandomized && $randomizationGroupBy == 'DAG' && $user_rights['group_id'] == '')
			{
				?>
				<script type="text/javascript">
				$(function(){
					$('form#form select[name="__GROUPID__"]').prop('disabled',true);
				});
				</script>
				<?php
			}
			// If record was randomized, then set javascript variable to prevent randomization field and strata
			// from being hidden by branching logic.
			if ($wasRecordRandomized)
			{
				// Build JS array of criteria fields IF they exist on the current event
				$randomizationCriteriaFieldList = array();
				if ($randomizationEvent == $_GET['event_id']) $randomizationCriteriaFieldList[] = $randomizationField;
				foreach ($randomizationCriteriaFields as $this_strata_field=>$this_strata_event_id) {
					if ($this_strata_event_id == $_GET['event_id']) $randomizationCriteriaFieldList[] = $this_strata_field;
				}
				if (!empty($randomizationCriteriaFieldList))
				{
					?>
					<script type="text/javascript">
					var randomizationCriteriaFieldList = new Array(<?php echo prep_implode($randomizationCriteriaFieldList) ?>);
					</script>
					<?php
				}
			}
		}
	}
	// PROMIS: Determine if instrument is an adaptive PROMIS instrument
	if (!$isSurveyPage) {
		list ($isPromisInstrument, $isAutoScoringInstrument) = PROMIS::isPromisInstrument(isset($_GET['page']) ? $_GET['page'] : '');
		// If record exists, then display the save buttons in case need to lock/e-sign it
		if ($isPromisInstrument && $hidden_edit == 1) {
			if ($user_rights['forms'][$_GET['page']] == '3' && $user_rights['lock_record'] > 0) {
				$_GET['editresp'] = '1';
				?>
				<script type='text/javascript'>
				$(function(){
					// Keep save buttons disabled until survey has been started by participant
					if ($('#form_response_header').length) {
						$('form#form :input[name="submit-btn-cancel"]').removeClass('disabled').prop('disabled',false);
						$('form#form :input[name="submit-btn-delete"]').removeClass('disabled').prop('disabled',false);
						$('form#form :input[name="submit-btn-deleteform"]').removeClass('disabled').prop('disabled',false);
						$('form#form :input[name="submit-btn-deleteevent"]').removeClass('disabled').prop('disabled',false);
					} else {
						$('#formSaveTip, #submit-btn-cancel-tr, #__DELETEBUTTONS__-tr, #__SUBMITBUTTONS__-tr, #__LOCKRECORD__-tr').hide();
					}
				});
				</script>
				<?php
			} else {
				?>
				<script type='text/javascript'>
				$(function(){
					$('#formSaveTip').hide();
				});
				</script>
				<?php
			}
		}
		// Hide SAVE buttons and record locking options, etc. if record doesn't exist yet
		if ($isPromisInstrument && $hidden_edit == 0) {
			// If record doesn't exist yet, give information on how to create it via
			if ($isAutoScoringInstrument) {
				print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0;padding:5px 8px 8px;'),
							RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
								RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_249'])
							) .
							$lang['data_entry_250'] . " " .
							$lang['data_entry_251'] . " " .
							RCView::a(array('href'=>APP_PATH_WEBROOT."Surveys/invite_participants.php?pid=".PROJECT_ID, 'style'=>'text-decoration:underline;'), $lang['app_22']) . " " .
							$lang['data_entry_252']
						);
			} else {
				print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0;padding:5px 8px 8px;'),
							RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
								RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_217'])
							) .
							$lang['data_entry_218'] . " " .
							$lang['data_entry_222'] . " " .
							RCView::a(array('href'=>APP_PATH_WEBROOT."Surveys/invite_participants.php?pid=".PROJECT_ID, 'style'=>'text-decoration:underline;'), $lang['app_22']) . " " .
							$lang['data_entry_223']
						);
			}
			?>
			<script type='text/javascript'>
			$(function(){
				$('#formSaveTip, #submit-btn-cancel-tr, #__DELETEBUTTONS__-tr, #__SUBMITBUTTONS__-tr, #__LOCKRECORD__-tr').hide();
			});
			</script>
			<?php
		}
	}
	/**
	 * DATA ENTRY PAGE (WITH RECORD SELECTED)
	 */
	if ((PAGE == "DataEntry/index.php") && isset($_GET['id']))
	{
		//Set table width (don't do for mobile viewing)
		$table_width = "id='questiontable'";
		if (PAGE == "DataEntry/index.php") {
			$table_width .= " style='display:none;'";
		}
		//If there is no form status data value for this data entry form, add it as 0 (default)
		if (!isset($element_data[$_GET['page']."_complete"])) $element_data[$_GET['page']."_complete"] = '0';
		## E-SIGNATURE: Determine if this form for this record has esignature set
		$sql = "select display_esignature from redcap_locking_labels where project_id = $project_id and form_name = '{$_GET['page']}' limit 1";
		$q = db_query($sql);
		// If it is NOT in the table OR if it IS in table with display=1, then show e-signature, if user has rights
		$displayEsignature = (db_num_rows($q) && db_result($q, 0) == "1");
		if ($displayEsignature)
		{
			// Determine how to display the e-signature and if user has rights to view it
			$sql = "select e.username, e.timestamp, u.user_firstname, u.user_lastname from redcap_esignatures e, redcap_user_information u
					where e.project_id = " . PROJECT_ID . " and e.username = u.username
					and e.record = '" . prep($_GET['id'].$entry_num) . "'
					and e.event_id = {$_GET['event_id']} and e.form_name = '{$_GET['page']}'
					and e.instance = '".prep($_GET['instance'])."' limit 1";
			$q = db_query($sql);
			$is_esigned = db_num_rows($q);
			
			// If form is disabled (for whatever reason), give option to e-sign it via ajax
			$onclick = ($disable_all) ? "onclick=\"$('#__LOCKRECORD__').prop('checked',true);saveLocking(($('#__LOCKRECORD__').prop('disabled') ? 2 : 1),'save');\"" : "";
			// Set html for esign checkbox
			$esignature_text = "<div id='esignchk'>
									<input type='checkbox' id='__ESIGNATURE__' $onclick " . ($is_esigned ? "checked disabled" : "") . ">
									<img src='" . APP_PATH_IMAGES . "tick_shield.png'>
									{$lang['global_34']} &nbsp;<span style='color:#444;font-weight:normal;'>(<a style='text-decoration:underline;font-size:10px;font-family:tahoma;'
										href='javascript:;' onclick='esignExplainLink(); return false;'>{$lang['form_renderer_02']}</a>)</span>
								</div>";
			// If e-sign exists, display who and when
			if ($is_esigned)
			{
				$esign = db_fetch_assoc($q);
				// Set basic e-sign info to be inserted in 2 places on page
				$esign_info =  "<b>{$lang['form_renderer_03']} {$esign['username']}</b> ({$esign['user_firstname']} {$esign['user_lastname']})
								{$lang['global_51']} " . DateTimeRC::format_ts_from_ymd($esign['timestamp']);
				// Text for bottom of page
				$esignature_text .= "<div id='esignts'>$esign_info</div>";
				// Text for top of page
				print "<div class='darkgreen' id='esign_msg'><img src='" . APP_PATH_IMAGES . "tick_shield.png'> $esign_info</div>";
			}
			// If not already e-signed and user has NO e-sign rights, then do not show e-signature option
			elseif (!$is_esigned && $user_rights['lock_record'] < 2)
			{
				$esignature_text = "";
			}
		}
		// User has set the option to NOT show the e-signature for this form
		else
		{
			$esignature_text = "";
		}
		## LOCKING: Disable all fields if form has been locked for this record when user does not have lock/unlock privileges
		$sql = "select l.username, l.timestamp, u.user_firstname, u.user_lastname from redcap_locking_data l
				left outer join redcap_user_information u on l.username = u.username
				where l.project_id = " . PROJECT_ID . " and l.record = '" . prep($_GET['id'].$entry_num) . "'
				and l.event_id = {$_GET['event_id']} and l.form_name = '{$_GET['page']}'
				and l.instance = '".prep($_GET['instance'])."' limit 1";
		$q = db_query($sql);
		if (db_num_rows($q))
		{
			// Set flag that form is locked
			$form_locked['status'] = true;
			// Set username and timestamp of locked record
			$form_locked['timestamp'] = db_result($q, 0, 'timestamp');
			$form_locked['user_firstname']   = db_result($q, 0, 'user_firstname');
			$form_locked['user_lastname']    = db_result($q, 0, 'user_lastname');
			$form_locked['username']  		 = db_result($q, 0, 'username');
			// Set flag to disable all fields on this form
			$disable_all = true;
			// Give message to user about all fields being disabled
			print  "<div class='red' id='lock_record_msg' style='text-align:left;margin:10px 0;'>
						<div style='margin-left:2em;text-indent:-1.8em;'>
							<img src='".APP_PATH_IMAGES."lock.png'>
							<b>{$lang['form_renderer_05']} ";
			if ($form_locked['username'] != "") {
				print  "	{$lang['form_renderer_06']} {$form_locked['username']}</b> ({$form_locked['user_firstname']} {$form_locked['user_lastname']}) ";
			} else {
				print  "</b>";
			}
			print  	"		{$lang['global_51']} " . DateTimeRC::format_ts_from_ymd($form_locked['timestamp']) . "
						</div><br>
						{$lang['form_renderer_07']} \"".$_GET["id"]."\" {$lang['form_renderer_08']} \"" . $Proj->forms[$_GET["page"]]["menu"] . "\".
						{$lang['form_renderer_09']}
					</div>
					<br>";
		}
		
		print "<div id='formtop-div'>";
					
		// If project has repeating forms
		$repeatInstanceDropdown = "";
		$instanceList = array();
		if ($Proj->isRepeatingForm($_GET['event_id'], $_GET['page'])) 
		{
			// Get instance count
			$instanceList = RepeatInstance::getRepeatFormInstanceList(addDDEending($_GET['id']), $_GET['event_id'], $_GET['page']);
			$instanceCount = count($instanceList);
			$instanceMax = max(array_keys($instanceList));
			if ($instanceCount > 0) 
			{
				// CUSTOM FORM LABEL PIPING: Gather field names of all custom form labels (if any)
				$pipedFormLabels = RepeatInstance::getPipedCustomRepeatingFormLabels(addDDEending($_GET['id']), $_GET['event_id'], $_GET['page']);
				// Get pre-piped custom repeating form label
				$pre_piped_label = $Proj->RepeatingFormsEvents[$_GET['event_id']][$_GET['page']];
				// Set html for drop-down list
				$repeatInstanceDropdownChoices = "";
				$instanceChoiceBaseUrl = APP_PATH_WEBROOT."DataEntry/index.php?pid=".PROJECT_ID."&page={$_GET['page']}&id={$_GET['id']}&event_id={$_GET['event_id']}&instance=";
				foreach ($instanceList as $this_instance=>$this_form_status) 
				{
					// Pipe any custom form labels
					$pipedLabel = "";
					if ($pre_piped_label != "" && isset($pipedFormLabels[addDDEending($_GET['id'])][$this_instance])) {
						$pipedLabel = "<span style='color:#999;margin:0 4px 0 2px;'>&ndash;</span>"
									. $pipedFormLabels[addDDEending($_GET['id'])][$this_instance];
					}
					// Set bg color if on this instance
					$instanceBgColor = ($this_instance == $_GET['instance']) ? "background:#dadada;" : "";
					// Add choice
					$repeatInstanceDropdownChoices .= RCView::li(array('style'=>$instanceBgColor),
														RCView::a(array('href'=>$instanceChoiceBaseUrl.$this_instance, 'style'=>'display:block;text-decoration:none;'),
															"<span style='vertical-align:middle;'>".RCView::img(array('src'=>RepeatInstance::getStatusIcon($this_form_status))) .
															"<span style='color:#800000;'><span style='margin:0 2px;'>$this_instance</span>".
															"/<span style='margin:0 2px;'>$instanceMax</span></span>$pipedLabel</span>"
														)
													);
				}
				// Add "add new instance" choice to drop-down (if we're not already on it)
				if ($_GET['instance'] <= $instanceMax) {
					$repeatInstanceDropdownChoices .= RCView::li(array('style'=>'border-top:1px solid #eee;'),
														RCView::a(array('href'=>$instanceChoiceBaseUrl.($instanceMax+1), 'style'=>'display:block;color:#888;text-decoration:none;'),
															RCView::button(array('class'=>'btn btn-defaultrc btnAddRptEv', 'style'=>'padding:0px 4px !important;margin:0 2px 2px 0;'), ' + ') .
															$lang['data_entry_247']
														)
													);
				}
				// Is this a partially/completed response?
				$formStatus = $element_data[$_GET['page']."_complete"];
				if ($_GET['instance'] > $instanceMax) {
					$formStatus = '';
					$instanceMax++;
				} elseif (isset($Proj->forms[$_GET['page']]['survey_id'])) {
					$responseCompleted = isResponseCompleted($Proj->forms[$_GET['page']]['survey_id'], addDDEending($_GET['id']), $_GET['event_id'], $_GET['instance']);
					if ($responseCompleted !== false) {
						// Set to 4=completed or 3=partial
						$formStatus = $responseCompleted == 1 ? 4 : 3;
					}
				}
				// Current instance piping: Pipe any custom form labels
				$pipedLabel = "";
				if ($pre_piped_label != "") {
					$pipedLabel = trim(Piping::replaceVariablesInLabel($pre_piped_label, addDDEending($_GET['id']), $_GET['event_id'], $_GET['instance'], $piped_data, false, null, false, $_GET['page']));
					if ($pipedLabel != "") $pipedLabel = "<span style='color:#999;margin:0 4px 0 2px;'>&ndash;</span>$pipedLabel";
				}
				// Output the drop-down
				$repeatInstanceDropdown = RCView::div(array('style'=>'float:left;'), 
											RCView::span(array('style'=>'font-size:13px;margin-right:5px;'), $lang['grid_46']) . 
											RCView::button(array('id'=>'repeatInstanceDropdown', 'onclick'=>"showBtnDropdownList(this,event,'repeatInstanceDropdownDiv');return false;", 'class'=>'jqbuttonmed'),
												RCView::img(array('src'=>RepeatInstance::getStatusIcon($formStatus), 'style'=>'vertical-align:middle;margin-left:2px;')) .
												"<span style='vertical-align:middle;'><span style='color:#800000;'><span style='margin:0 2px;'>{$_GET['instance']}</span>".
												"/<span style='margin:0 2px;'>$instanceMax</span></span>$pipedLabel</span>" .
												RCView::img(array('src'=>'arrow_state_grey_expanded.png', 'style'=>'margin-left:6px;vertical-align:middle;position:relative;top:-1px;'))
											) .
											RCView::div(array('id'=>'repeatInstanceDropdownDiv', 'style'=>'z-index:2;display:none;position:absolute;'),
												RCView::ul(array('id'=>'repeatInstanceDropdownUl'),
													$repeatInstanceDropdownChoices
												)
											)
										  );
			}
		}
		
		// Get DAGs
		$dags = $Proj->getGroups();

		// Display repeating instance drop-down here and then reset the string
		if ($repeatInstanceDropdown != "" && (!empty($dags) || !isset($Proj->forms[$_GET['page']]['survey_id']))) {
			print $repeatInstanceDropdown;
			$repeatInstanceDropdown = "";
		}
		
		//If a user group exists for this project, show all groups in drop-down
		if (!empty($dags))
		{
			if ($user_rights['group_id'] == "") {
				//User not in a group but groups exist, so give choice to associate this record with a group if not already associated with a group
				// If record already in a DAG, then display DAG name. ONLY allow editing of DAG when creating record.
				if ($hidden_edit) {
					// Existing record: Display DAG name
					print "<div class='wrap' style='float:right;margin-right:5px;'>".$lang['global_78'].$lang['colon']."<span style='margin-left:6px;'>";
					if ($element_data['__GROUPID__'] != '') {
						print RCView::b(RCView::escape($dags[$element_data['__GROUPID__']]));
					} else {
						print RCView::b($lang['data_access_groups_ajax_23']);
					}
					print  "</span>
							<a href='javascript:;' title='".cleanHtml($lang['data_entry_330'].($element_data['__GROUPID__'] != '' ? " ".$lang['data_entry_324'] : ''))."' class='help' onclick=\"simpleDialog('".cleanHtml($lang['data_entry_331'])."','".cleanHtml($lang['data_entry_330'])."',null,550);\">?</a>
							</div>";
				} 
				// Display DAG dropdown (if creating record) or outut as hidden (if existing record)
				$dagDropdownDisplay = $hidden_edit ? 'display:none;' : '';
				print "<div class='wrap' style='float:right;$dagDropdownDisplay'>";
				print (!isset($element_data['__GROUPID__']) || $element_data['__GROUPID__'] == '') ? $lang['form_renderer_10'] : $lang['form_renderer_11'];
				$group_id_disabled = ($user_rights['forms'][$_GET['page']] == '2') ? 'disabled' : '';
				print "<select name='__GROUPID__' class='x-form-text x-form-field' style='margin-left:8px;font-size:12px;' $group_id_disabled>
					   <option value=''> -- {$lang['data_access_groups_ajax_22']} -- </option>
					   <option value=''>{$lang['data_access_groups_ajax_23']}</option>";
				foreach ($dags as $group_id=>$group_name) {
					print "<option value='$group_id' ";
					if (isset($element_data['__GROUPID__']) && $element_data['__GROUPID__'] == $group_id) print "selected";
					print ">$group_name</option>";
				}
				print "</select></div>";
			} else {
				//Check to make sure user is in the same group as record. If not, don't allow access and redirect page.
				if ((isset($element_data['__GROUPID__']) && $user_rights['group_id'] != $element_data['__GROUPID__']) || (!isset($element_data['__GROUPID__']) && $hidden_edit)) {
					print "<script type='text/javascript'>$(function(){ $('#questiontable_loading').hide(); });</script>";
					exit("<div class='red'>
						  <img src='".APP_PATH_IMAGES."exclamation.png'>
						  <b>{$lang['global_49']} ".$_GET['id']." {$lang['form_renderer_13']}</b><br><br>
						  {$lang['form_renderer_14']}<br><br>
						  <a href='".APP_PATH_WEBROOT."DataEntry/index.php?pid=$project_id&page=".$_GET['page']."'
							style='text-decoration:underline'><< {$lang['form_renderer_15']}</a>
						  <br><br></div>");
				}
				//Since user is in a group, they can only have access to this page if the record itself is in the same group.
				//Give a hidden field for the group id value to be saved in data table.
				print "<input type='hidden' name='__GROUPID__' value='".$user_rights['group_id']."'>";
			}
		}
		
		print "<div class='clear'></div></div>";
	}
	/**
	 * ONLINE DESIGNER
	 */
	elseif (PAGE == "Design/online_designer.php" || PAGE == "Design/online_designer_render_fields.php")
	{
		// Default
		$table_width = " id='draggable'";
		// Add surrounding HTML to table rows when in Edit Mode on Design page (to display "add field" buttons)
		if (isset($_GET['page']))
		{
			// Set "add matrix fields" button
			$addMatrixBtn = '<input id="btn-{name}-m" type="button" class="btn2" value="'.cleanHtml2($lang['design_307']).'"
							onmouseover="this.className=\'btn2 btn2hov\'" onmouseout="this.className=\'btn2\'"
							onclick="openAddMatrix(\'\',\'{name}\')">';
			// Set array of strings to be replaced out of $bookend1 for each field
			$orig1 = array("{name}", "{rr_type}", "{branching_logic}", "{display_stopactions}", "{signature}");
			$bookend1 = '<td class="frmedit_row" style="padding:0 10px;background-color:#ddd;">
					<div class="frmedit" style="max-width:700px;text-align:center;padding:8px;background-color:#ddd;{addFieldBtnStyle}">
						<input id="btn-{name}-f" type="button" class="btn2" value="'.cleanHtml2($lang['design_309']).'"
							onmouseover="this.className=\'btn2 btn2hov\'" onmouseout="this.className=\'btn2\'"
							onclick="openAddQuesForm(\'{name}\',\'\',0,0)">
						'.$addMatrixBtn.'
					</div>
					{matrixGroupIcons}
					<table class="frmedit_tbl" id="design-{name}" cellspacing=0 width=100%>
					<tr {style-display}>
						<td class="frmedit" colspan="2" valign="top" style="padding:4px 0 4px 5px;border-bottom:1px solid #e5e5e5;background-color:#f3f3f3;">
							<div class="frmedit_icons">{field_icons}</div>
							{matrixHdrs}
						</td>
					</tr>
					<tr>';
			$bookend2 = '</tr></table></td>';
			//Last "Add Field Here" button at bottom
			if (PAGE == "Design/online_designer.php" || (PAGE == "Design/online_designer_render_fields.php" && (isset($_GET['ordering']) && $_GET['ordering'] == "1")))
			{
				$bookend3 = '<tr NoDrag="1"><td class="frmedit" style="padding:0 10px;background-color:#DDDDDD;">
							 <div style="max-width:700px;text-align:center;padding:8px;background-color:#ddd;">
								<input id="btn-last" type="button" class="btn2" value="'.cleanHtml2($lang['design_309']).'"
									onmouseover="this.className=\'btn2 btn2hov\'" onmouseout="this.className=\'btn2\'"
									onclick="openAddQuesForm(\'\',\'\',0,0)">
								'.$addMatrixBtn.'
							 </div>
							 </td></tr>';
				$table_width = "style='width:100%;border:1px solid #bbb;' id='draggable'";
			}
		}
	}
	// CHECK LOCKING STATUS FOR SURVEYS
	if ($isSurveyPage)
	{
		## LOCKING: Disable all fields if form has been locked for this record when user does not have lock/unlock privileges
		$sql = "select l.username, l.timestamp, u.user_firstname, u.user_lastname from redcap_locking_data l
				left outer join redcap_user_information u on l.username = u.username
				where l.project_id = " . PROJECT_ID . " and l.record = '" . prep($_GET['id']) . "'
				and l.event_id = {$_GET['event_id']} and l.form_name = '{$_GET['page']}'
				and l.instance = '".prep($_GET['instance'])."' limit 1";
		$q = db_query($sql);
		if (db_num_rows($q)) {
			// Set flag to disable all fields on this form
			$disable_all = true;
			// Hide SAVE buttons and display notification of why page is disabled
			?>
			<script type='text/javascript'>
			$(function(){
				$('form#form tr.surveysubmit').remove();
				$('form#form').before('<?php print cleanHtml(RCView::div(array('class'=>'yellow', 'style'=>'max-width:97%;'), RCView::img(array( 'src'=>'exclamation_orange.png')) . $lang['survey_674'])) ?>');
			});
			</script>
			<style type="text/css">
			</style>
			<?php
		}
	}
	// If VIEWING A SURVEY RESPONSE on the first form, set flag to disable all fields on this form
	if (!$isSurveyPage && PAGE == 'DataEntry/index.php' && isset($_GET['id']) && $surveys_enabled
		&& isset($Proj->forms[$_GET['page']]['survey_id']) && $hidden_edit == 1 && isset($Proj->forms[$_GET['page']]['survey_id']))
	{
		// Now ensure that this was an actual survey response and not entered as manual response on the form
		$survey_id = $Proj->forms[$_GET['page']]['survey_id'];
		// Determine if this is a repeated instance of an instrument, and if so, if it has data yet (if not, then don't fetch a hash placeholder)
		$fetchHash = ($_GET['instance'] == '1' || isset($instanceList[$_GET['instance']]));		
		// Get participant_id and hash for this event-record-survey
		if ($fetchHash) {
			list ($participant_id, $hash) = Survey::getFollowupSurveyParticipantIdHash($survey_id, addDDEending($_GET['id']), $_GET['event_id'], false, $_GET['instance']);
		}
		// Create survey action buttons as a drop-down
		$surveyActionDropdown = "";
		if ($user_rights['participants'])
		{
			// Set disabled flag for drop-down if on a repeating instance that has no data yet
			$surveyActionDropdownDisabled = $fetchHash ? "" : "disabled";
			$surveyActionDropdownOnclick = $fetchHash ? "" : "simpleDialog('".cleanHtml($lang['survey_1085'])."','".cleanHtml($lang['survey_1084'])."');";
			// Set html for drop-down list
			$surveyActionDropdown =
					RCView::span(array('onclick'=>$surveyActionDropdownOnclick),
						RCView::button(array('id'=>'SurveyActionDropDown', $surveyActionDropdownDisabled=>$surveyActionDropdownDisabled, 'onclick'=>"showBtnDropdownList(this,event,'SurveyActionDropDownDiv');return false;", 'class'=>'jqbuttonmed'),
							RCView::img(array('src'=>'blog_arrow.png', 'style'=>'vertical-align:middle;position:relative;top:-1px;margin-left:2px;')) .
							RCView::span(array('style'=>'vertical-align:middle;margin-right:40px;'), $lang['survey_649']) .
							RCView::img(array('src'=>'arrow_state_grey_expanded.png', 'style'=>'margin-left:2px;vertical-align:middle;position:relative;top:-1px;'))
						) .
						// Survey action drop-down (initially hidden)
						RCView::div(array('id'=>'SurveyActionDropDownDiv', 'style'=>'display:none;position:absolute;z-index:1000;'),
							RCView::ul(array('id'=>'SurveyActionDropDownUl'),
								// Open survey
								RCView::li(array(),
									RCView::a(array('id'=>'surveyoption-openSurvey', 'href'=>'javascript:;', 'style'=>'text-decoration:none;color:green;', 'onclick'=>"surveyOpen('".APP_PATH_SURVEY_FULL."?s=$hash',0);return false;"),
										RCView::img(array('src'=>'arrow_right_curve.png')) .
										$lang['survey_220']
									)
								) .
								// Invite respondent via email
								RCView::li(array(),
									RCView::a(array('id'=>'surveyoption-composeInvite', 'href'=>'javascript:;', 'style'=>'text-decoration:none;', 'onclick'=>"inviteFollowupSurveyPopup($survey_id,'{$_GET['page']}','{$_GET['id']}','{$_GET['event_id']}','{$_GET['instance']}');return false;"),
										RCView::img(array('src'=>'email.png')) .
										$lang['survey_278']
									)
								) .
								// Access Code and QR code
								RCView::li(array(),
									RCView::a(array('id'=>'surveyoption-accessCode', 'href'=>'javascript:;', 'style'=>'text-decoration:none;color:#000;', 'onclick'=>"getAccessCode('$hash');return false;"),
										RCView::img(array('src'=>'ticket_arrow.png')) .
										$lang['survey_628'] .
										(!gd2_enabled() ? '' :
											RCView::SP . $lang['global_43'] . RCView::br() .
											RCView::img(array('src'=>'qrcode.png')) .
											$lang['survey_664']
										)
									)
								) .
								// Survey Queue (only display if queue is enabled and this record has at least one queue item
								(!(Survey::surveyQueueEnabled() && Survey::getSurveyQueueForRecord($_GET['id'], true)) ? '' :
									RCView::li(array(),
										RCView::a(array('id'=>'surveyoption-surveyQueue', 'href'=>'javascript:;', 'style'=>'text-decoration:none;color:#800000;', 'onclick'=>"surveyOpen('".APP_PATH_SURVEY_FULL . '?sq=' . Survey::getRecordSurveyQueueHash($_GET['id'])."',0);return false;"),
											RCView::img(array('src'=>'list_red.gif')) .
											$lang['survey_505']
										)
									)
								)
							)
						)
					);
		}
		// Query to check if in response table
		$sql = "select p.participant_id, r.response_id, r.first_submit_time, r.completion_time, 
				r.return_code, p.participant_identifier, p.participant_email
				from redcap_surveys_participants p, redcap_surveys_response r where p.survey_id = $survey_id
				and p.event_id = " . getEventId() . " and p.participant_id = r.participant_id
				and r.record = '" . prep(addDDEending($_GET['id'])) . "' and r.first_submit_time is not null
				and r.instance = '".prep($_GET['instance'])."' order by p.participant_email desc limit 1";
		$q = db_query($sql);
		## RESPONSE EXISTS: A survey response exists for this record for this instrument
		if (db_num_rows($q) > 0)
		{
			// Set vars
			$response_id		      = db_result($q, 0, "response_id");
			$survey_completion_time   = db_result($q, 0, "completion_time");
			$survey_first_submit_time = db_result($q, 0, "first_submit_time");
			$return_code 			  = strtoupper(db_result($q, 0, "return_code"));
			$participant_identifier   = db_result($q, 0, "participant_identifier");
			$participant_id   		  = db_result($q, 0, "participant_id");
			$participant_email   	  = db_result($q, 0, "participant_email");
			if ($participant_identifier != "") {
				$participant_identifier = " {$lang['form_renderer_06']} <b>$participant_identifier</b>";
			}
			// Set flag if survey is still active/editable
			$responseCompleted = ($survey_completion_time != '');
			$responsePartiallyCompleted = (!$responseCompleted && $survey_first_submit_time != '');
			// If the response is NOT active or returnable, then disable some choices in the drop-down
			if (
				// If survey is not active anymore
				!$Proj->surveys[$survey_id]['survey_enabled']
				// Or if returning to a partially completed response
				// Or if returning to a fully completed response (with Edit Completed Response option enabled)
				|| ($responseCompleted && (!$Proj->surveys[$survey_id]['save_and_return'] || !$Proj->surveys[$survey_id]['edit_completed_response']))
			) {
				?>
				<script type="text/javascript">
				$(function(){
					// Disable survey option drop-down choices that are no longer usable
					$('#SurveyActionDropDownUl #surveyoption-openSurvey, #SurveyActionDropDownUl #surveyoption-composeInvite, '
						+ '#SurveyActionDropDownUl #surveyoption-accessCode').addClass('opacity35').attr('onclick','').css('cursor','default');
					// If all choices are disabled, then disable whole drop-down
					if ($('#SurveyActionDropDownDiv a').length == $('#SurveyActionDropDownDiv a.opacity35').length) {
						$('#SurveyActionDropDown').button('disable');
					}
				});
				</script>
				<?php
			}
			// For Completed Responses, if there is no form status value for this form (and/or it's value was set to 0 above), then set to 2
			if ($survey_completion_time != "" && $element_data[$_GET['page']."_complete"] == '0') {
				// Set value to 2 for page element
				$element_data[$_GET['page']."_complete"] = '2';
				// Now manually fix this on the back-end so that the data accurately reflects it (try update first, then insert)
				$sql = "update redcap_data set value = '2' where project_id = $project_id and
						event_id = " . getEventId() . " and record = '" . prep(addDDEending($_GET['id'])) . "' and
						field_name = '{$_GET['page']}_complete'";
				$q = db_query($sql);
				if (!$q || db_affected_rows() < 1) {
					$sql = "insert into redcap_data (project_id, event_id, record, field_name, value) values
							($project_id, " . getEventId() . ", '" . prep(addDDEending($_GET['id'])) . "', '{$_GET['page']}_complete', '2')";
					db_query($sql);
				}
			}
			// If survey has Save & Return Later enabled BUT participant has NO return code, then generate one on the fly and save it.
			if ($Proj->surveys[$survey_id]['save_and_return'] && $return_code == "")
			{
				$return_code = Survey::getUniqueReturnCode($survey_id, $response_id);
			}
			// Hide SAVE AND MARK RESPONSE AS COMPLETE button since this response has been completed
			if ($enable_edit_survey_response && $survey_completion_time != "" && $user_rights['forms'][$_GET['page']] == '3' && isset($_GET['editresp']))
			{
				?>
				<script type='text/javascript'>
				$(function(){
					$('#formSaveTip input[name="submit-btn-savecompresp"], #form :input[name="submit-btn-savecompresp"]').remove();
				});
				</script>
				<?php
			}
			// Disable regular fields if user does NOT have "edit survey response" rights (value=3)
			if (!($enable_edit_survey_response && $user_rights['forms'][$_GET['page']] == '3' && isset($_GET['editresp'])))
			{
				// Disable all fields
				$disable_all = true;
				// Disable record renaming (even though already disabled)
				$user_rights['record_rename'] = 0;
				// Hide SAVE buttons and display notification of why page is disabled
				?>
				<script type='text/javascript'>
				$(function(){
					$('#<?php echo $table_pk ?>-tr').next('#<?php echo $table_pk ?>-tr').hide();
					var formStatusRow = $('#'+getParameterByName('page')+'_complete-tr');
					formStatusRow.next('tr').hide();
					formStatusRow.next('tr').next('tr').hide();
					formStatusRow.next('tr').next('tr').next('tr').hide();
					formStatusRow.next('tr').next('tr').next('tr').next('tr').hide();
				});
				</script>
				<style type="text/css">
				#__SUBMITBUTTONS__-tr, #formSaveTip, #__DELETEBUTTONS__-tr, #__LOCKRECORD__-tr, td.context_msg { display: none; }
				#<?php echo $table_pk ?>-tr {border: 1px solid #DDD; }
				</style>
				<?php
			}
			// PROMIS: Determine if instrument is an adaptive PROMIS instrument
			if ($isPromisInstrument)
			{
				if ($isAutoScoringInstrument) {
					print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0 5px;padding:5px 8px 8px;'),
								RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
									RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_249'])
								) .
								$lang['data_entry_250']
							);
				} else {
					print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0 5px;padding:5px 8px 8px;'),
								RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
									RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_217'])
								) .
								$lang['data_entry_218']
							);
				}
			}
			// Display repeating instance drop-down
			if ($repeatInstanceDropdown != "") {
				print "<div id='formtop-div' style='display:block;'>$repeatInstanceDropdown<div class='clear'></div></div>";
			}
			?>
			<div class="red" id="form_response_header">
				<?php if ($user_rights['forms'][$_GET['page']] == '3' && $enable_edit_survey_response && !$isPromisInstrument) { ?>
					<!-- Survey response is editable -->
					<img src="<?php echo APP_PATH_IMAGES ?>pencil.png">
					<b><?php echo $lang['data_entry_148'] ?></b>
					<?php if (isset($_GET['editresp'])) { ?>
						<b style='color:red;margin-left:5px;'><?php echo $lang['data_entry_150'] ?></b>
					<?php } elseif ($otherUserOnPage === false) { ?>
						&nbsp; <button class="jqbuttonmed" style="font-size:12px;" onclick="window.location.href = app_path_webroot+'<?php echo PAGE ?>?pid=<?php echo PROJECT_ID ?>&page='+getParameterByName('page')+'&id='+getParameterByName('id')+'&event_id='+event_id+(getParameterByName('instance')==''?'':'&instance='+getParameterByName('instance'))+'&editresp=1';return false;"><?php echo $lang['data_entry_174'] ?></button>
					<?php } ?>
				<?php } else { ?>
					<!-- Survey response is read-only -->
					<img src="<?php echo APP_PATH_IMAGES ?>lock.png">
					<b><?php echo $lang['data_entry_146'] ?></b>
				<?php }
				print RCView::SP . RCView::SP . $surveyActionDropdown;
				?>
				<br><br>
				<?php
				if ($survey_completion_time == "") {
					// Partial survey response
					print RCView::img(array('src'=>'circle_orange_tick.png')) . " <b>{$lang['data_entry_101']} {$lang['data_entry_100']} " . DateTimeRC::format_ts_from_ymd($survey_first_submit_time) . "</b>$participant_identifier" . $lang['period'] . " ";
				} else {
					// Complete survey response
					print RCView::img(array('src'=>'circle_green_tick.png')) . " <b>" . $lang['data_entry_152'] . " " . DateTimeRC::format_ts_from_ymd($survey_completion_time) . "</b>$participant_identifier" . $lang['period'] . " ";
				}
				if ($isPromisInstrument)
				{
					if ($isAutoScoringInstrument) {
						print " ".$lang['data_entry_254'];
					} else {
						print " ".$lang['data_entry_219'];
					}
				}
				elseif (!$enable_edit_survey_response)
				{
					print " ".$lang['data_entry_167'];
				}
				else
				{
					if ($user_rights['forms'][$_GET['page']] == '3') {
						// Survey response is editable
						print $lang['data_entry_149'];
						if (!isset($_GET['editresp'])) {
							print " ".$lang['data_entry_151'];
						}
					} else {
						// Survey response is read-only
						print $lang['data_entry_147'];
					}
					// Display who has edited this response thus far
					$usersContributeCompletedResponse = array();
					$usersContributeCompletedResponseUsers = array();
					$usersContributeSinceCompleted = array();
					$usersContributePartialResponse = array();
					$usersContributePartialResponseUsers = array();
					if ($survey_completion_time != "")
					{
						// Copy the completed survey response to the surveys_response_values table as a backup
						// of the completed response (unless already copied).
						copyCompletedSurveyResponse($response_id);
						// Users who contributed to this COMPLETED response (e.g., survey participant + 2 other users)
						$sql = "select username from redcap_surveys_response_users where response_id = $response_id";
						$q = db_query($sql);
						while ($row = db_fetch_assoc($q))
						{
							$usersContributeCompletedResponse[] = $row['username'];
							if ($row['username'] != '[survey respondent]') {
								$usersContributeCompletedResponseUsers[] = $row['username'];
							}
						}
						$numContributeCompletedResponse = count($usersContributeCompletedResponse);
						if ($numContributeCompletedResponse == 1) {
							// 1 person completed
							print " <b>$numContributeCompletedResponse {$lang['data_entry_153']}";
							if (in_array('[survey respondent]', $usersContributeCompletedResponse)) {
								print " {$lang['data_entry_159']}";
							}
							print "</b> {$lang['data_entry_154']}";
						} else {
							// Multiple people completed
							print " <b>$numContributeCompletedResponse {$lang['data_entry_155']}";
							if (in_array('[survey respondent]', $usersContributeCompletedResponse)) {
								$numUserText = ($numContributeCompletedResponse-1 == 1) ? $lang['data_entry_162'] : $lang['data_entry_161'];
								print " {$lang['data_entry_160']} <u class='resp_users_contribute' title='".implode(", ", $usersContributeCompletedResponseUsers)."'>".($numContributeCompletedResponse-1)." {$numUserText}</u>{$lang['data_entry_163']}";
							}
							print "</b> {$lang['data_entry_156']}";
						}
						// Users who have edited response SINCE COMPLETION
						$sql = "select distinct user from redcap_log_event where project_id = " . PROJECT_ID . "
								and event in ('UPDATE','INSERT') and object_type = 'redcap_data'
								and pk = '" . prep(addDDEending($_GET['id'])) . "' and event_id = {$_GET['event_id']}
								and ts > " . str_replace(array('-',' ',':'), array('','',''), $survey_completion_time);
						$q = db_query($sql);
						while ($row = db_fetch_assoc($q))
						{
							$usersContributeSinceCompleted[] = $row['user'];
						}
						$numContributeSinceCompleted = count($usersContributeSinceCompleted);
						if ($numContributeSinceCompleted == 1) {
							// 1 person edited since completion
							print " <u class='resp_users_contribute' title='".implode(", ", $usersContributeSinceCompleted)."'><b>$numContributeSinceCompleted {$lang['data_entry_153']}</b></u> {$lang['data_entry_157']}";
						} elseif ($numContributeSinceCompleted > 1) {
							// Multiple people edited since completion
							print " <u class='resp_users_contribute' title='".implode(", ", $usersContributeSinceCompleted)."'><b>$numContributeSinceCompleted {$lang['data_entry_155']}</b></u> {$lang['data_entry_158']}";
						} else {
							// No one
							print " <b>{$lang['data_entry_166']}</b> {$lang['data_entry_157']}";
						}
					}
					else
					{
						// Users who contributed to this PARTIAL response (e.g., survey participant + 2 other users)
						$sql = "select distinct user from redcap_log_event where project_id = " . PROJECT_ID . "
								and event in ('UPDATE','INSERT') and object_type = 'redcap_data'
								and pk = '" . prep(addDDEending($_GET['id'])) . "' and event_id = {$_GET['event_id']}";
						$q = db_query($sql);
						while ($row = db_fetch_assoc($q))
						{
							$usersContributePartialResponse[] = $row['user'];
							if ($row['user'] != '[survey respondent]') {
								$usersContributePartialResponseUsers[] = $row['user'];
							}
						}
						$numContributePartialResponse = count($usersContributePartialResponse);
						if ($numContributePartialResponse == 1) {
							// 1 person partially completed
							print " <b>$numContributePartialResponse {$lang['data_entry_153']}";
							if (in_array('[survey respondent]', $usersContributePartialResponse)) {
								print " {$lang['data_entry_159']}";
							}
							print "</b> {$lang['data_entry_164']}";
						} else {
							// Multiple people partially completed
							print " <b>$numContributePartialResponse {$lang['data_entry_155']}";
							if (in_array('[survey respondent]', $usersContributePartialResponse)) {
								$numUserText = ($numContributePartialResponse-1 == 1) ? $lang['data_entry_162'] : $lang['data_entry_161'];
								print " {$lang['data_entry_160']} <u class='resp_users_contribute' title='".implode(", ", $usersContributePartialResponseUsers)."'>".($numContributePartialResponse-1)." {$numUserText}</u>{$lang['data_entry_163']}";
							}
							print "</b> {$lang['data_entry_165']}";
						}
					}
				}
				// If survey has save&return enabled and this is a partial response (or is a completed response with Edit Completed Response enabled), then display Return Code
				// Do not show Return Code if Survey Login is enabled (which means that we don't need a Return code).
				if (!($survey_auth_enabled && ($survey_auth_apply_all_surveys || $Proj->surveys[$survey_id]['survey_auth_enabled_single']))
					&& ($survey_completion_time == "" || $Proj->surveys[$survey_id]['edit_completed_response'])
					&& $Proj->surveys[$survey_id]['save_and_return'] && $return_code != "")
				{
					print  "<div style='font-size:12px;color:#000060;padding:10px 0 2px;'>".
								($Proj->surveys[$survey_id]['edit_completed_response'] ? $lang['data_entry_231'] : $lang['data_entry_117']) .
								"<input value='$return_code' class='staticInput' readonly style='letter-spacing:1px;margin-left:10px;color:#111;font-size:12px;width:100px;padding:2px 6px;' onclick='this.select();'>
							</div>";
				}
				// Display record name
				print  "<div style='padding:10px 0 0;color:#000066;'>
							$table_pk_label <b>{$_GET['id']}</b>";
				// Display event name if longitudinal
				if ($longitudinal) {
					print RCView::span(array('style'=>'margin-left:5px;'),
							"&ndash; ".$Proj->eventInfo[$_GET['event_id']]['name_ext']
						  );
				}
				// Add instance number
				if ($_GET['instance'] > 1) {
					print "<span style='margin-left:5px;font-weight:normal;'>({$lang['data_entry_278']}{$_GET['instance']})</span>";
				}
				// Append secondary ID field value, if set for a "survey+forms" type project
				if ($secondary_pk != '')
				{
					$secondary_pk_val = $Proj->getSecondaryIdVal($_GET['id']);
					if ($secondary_pk_val != '') {
						// Add field value and its label to context message
						print "<span style='font-size:11px;padding-left:8px;'>({$Proj->metadata[$secondary_pk]['element_label']} <b>$secondary_pk_val</b>)</span>";
					}
				}
				// If Custom Record Label is specified (such as "[last_name], [first_name]", then parse and display)
				if ($custom_record_label != '')
				{
					print "<span style='font-size:11px;padding-left:8px;'>"
						. filter_tags(getCustomRecordLabels($custom_record_label, $Proj->getFirstEventIdArm(getArm()),
							$_GET['id'] . ($double_data_entry && $user_rights['double_data'] != 0 ? '--'.$user_rights['double_data'] : '')))
						. "</span>";
				}
				print  "</div>";
				?>
			</div>
			<br>
			<?php
		}
		## RESPONSE DOES NOT EXIST YET: RENDER EMAIL BUTTON
		// This form is a survey, but there is no response for it yet.
		// Give the option to add a response to the survey (ONLY if have 'participants' rights)
		elseif ($user_rights['participants'])
		{
			// Check if participant has already been sent an invitation. If so, display to user.
			$sql = "select e.email_sent, q.scheduled_time_to_send, q.reminder_num, q.reason_not_sent
					from redcap_surveys_participants p, redcap_surveys_response r, redcap_surveys_emails e,
					redcap_surveys_emails_recipients er left join redcap_surveys_scheduler_queue q
					on q.email_recip_id = er.email_recip_id	where p.participant_id = r.participant_id and
					p.participant_id = er.participant_id and e.email_id = er.email_id and p.survey_id = $survey_id
					and p.event_id = {$_GET['event_id']} and r.record = '".prep(addDDEending($_GET['id']))."'
					and q.ssq_id is not null and q.status != 'DELETED' and q.instance = {$_GET['instance']}
					order by e.email_id desc, q.reminder_num limit 1";
			$q = db_query($sql);
			$prevInviteStatus = "";
			if (db_num_rows($q)) {
				// Invitation has been scheduled or sent
				$inviteInfo = db_fetch_assoc($q);
				if ($inviteInfo['reason_not_sent'] != '') {
					// Invitation failed to sent for some reason
					$prevInviteStatus = RCView::img(array('src'=>'exclamation.png',
										'title'=>$lang['survey_1080']." ".DateTimeRC::format_ts_from_ymd($inviteInfo['scheduled_time_to_send'])));
				} elseif ($inviteInfo['email_sent'] == '' && $inviteInfo['scheduled_time_to_send'] != '') {
					// Invitation is scheduled but not sent
					$prevInviteStatus = RCView::img(array('src'=>'clock_fill.png',
										'title'=>$lang['survey_410']." ".DateTimeRC::format_ts_from_ymd($inviteInfo['scheduled_time_to_send'])));
				} elseif ($inviteInfo['email_sent'] != '') {
					// Invitation was sent
					$prevInviteStatus = RCView::img(array('src'=>'email_check.png',
										'title'=>$lang['survey_411']." ".DateTimeRC::format_ts_from_ymd($inviteInfo['email_sent'])));
				}
			}
			if ($prevInviteStatus == '') {
				// Invitation NOT sent yet
				$prevInviteStatus = RCView::img(array('src'=>'email_gray.gif',
									'title'=>$lang['survey_412']));
			}
			// PROMIS: Determine if instrument is an adaptive PROMIS instrument
			if ($isPromisInstrument)
			{
				if ($isAutoScoringInstrument) {
					print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0;padding:5px 8px 8px;'),
								RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
									RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_249'])
								) .
								$lang['data_entry_250'] . " " . $lang['data_entry_253']
							);
				} else {
					print	RCView::div(array('class'=>'darkgreen', 'style'=>'margin:15px 0;padding:5px 8px 8px;'),
								RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
									RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['data_entry_217'])
								) .
								$lang['data_entry_218'] . " " . $lang['data_entry_221']
							);
				}
			}
			// Display survey action buttons as a drop-down
			print RCView::div(array('id'=>'inviteFollowupSurveyBtn'),
					$repeatInstanceDropdown .
					RCView::div(array('style'=>'float:right;'),
						$surveyActionDropdown
					) .
					RCView::div(array('style'=>'float:right;color:#777;padding:3px 20px 0 0;'),
						"{$lang['survey_413']} &nbsp;$prevInviteStatus"
					) .
					RCView::div(array('class'=>'clear'), '')
				);
		}
	}	
	
	// If Enhanced Choices are enabled for radios and checkboxes on surveys
	$enhanced_choices = (($isSurveyPage && $Proj->surveys[$Proj->forms[$_GET['page']]['survey_id']]['enhanced_choices'])
						// or for Survey Theme View page
						|| (PAGE == 'Surveys/theme_view.php' && isset($_GET['enhanced_choices']) && $_GET['enhanced_choices'] == '1'));
	
	// If ALL fields on the form are disabled, then set variable to prevent branching logic prompt
	// of "Erase Value" (overwrites original value from base.js)
	if (!$isSurveyPage && $disable_all && !isset($_GET['editresp']))
	{
		?>
		<script type='text/javascript'>
		var showEraseValuePrompt = 0;
		</script>
		<?php
	}
	// SURVEYS: Use the surveys/index.php page as a pass through for certain files (file uploads/downloads, etc.)
	if ($isSurveyPage)
	{
		$file_download_page = APP_PATH_SURVEY . "index.php?pid=$project_id&__passthru=".urlencode("DataEntry/file_download.php");
		$file_delete_page   = APP_PATH_SURVEY . "index.php?pid=$project_id&__passthru=".urlencode("DataEntry/file_delete.php");
		$image_view_page    = APP_PATH_SURVEY . "index.php?pid=$project_id&__passthru=".urlencode("DataEntry/image_view.php");
		$field_label_page   = APP_PATH_SURVEY . "index.php?pid=$project_id&__passthru=".urlencode("Design/get_fieldlabel.php");
	}
	else
	{
		$file_download_page = APP_PATH_WEBROOT . "DataEntry/file_download.php?pid=$project_id";
		$file_delete_page   = APP_PATH_WEBROOT . "DataEntry/file_delete.php?pid=$project_id";
		$image_view_page    = APP_PATH_WEBROOT . "DataEntry/image_view.php?pid=$project_id";
		$field_label_page   = APP_PATH_WEBROOT . "Design/get_fieldlabel.php?pid=$project_id";
	}
	// DATA RESOLUTION/COMMENT LOG: Get array of fields that have a history
	if ($data_resolution_enabled > 0)
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';
		$dcFieldsWithHistory = DataQuality::fieldsWithDataResHistory($id.($double_data_entry && $user_rights['double_data'] != 0 ? "--".$user_rights['double_data'] : ""), $event_id, (isset($_GET['page']) ? $_GET['page'] : ''), $_GET['instance']);
	}
	// Set default value of NULL regarding whether this form/survey has any data saved yet (to be used with @DEFAULT action tag)
	$pageHasData = null;
	// Begin rendering form table
	print "<table class='form_border container-fluid' $table_width><tbody class='formtbody'>";
	// Loop through each element to render each row of the form's table
	foreach ($elements as $rr_key=>$rr_array)
	{
		// Re-format labels and notes to account for any HTML
		if (isset($rr_array['label']) && $rr_array['rr_type'] != 'surveysubmit') {
			$rr_array['label'] = decode_filter_tags($rr_array['label']);
		}
		if (isset($rr_array['note'])) {
			$rr_array['note']  = decode_filter_tags($rr_array['note']);
		}
		// Set up variables for this loop
		$rr_type = $rr_array['rr_type'];
		if (isset($rr_array['name'])) 			  {	$name 		= $rr_array['name']; if (!isset($rr_array['field'])) $rr_array['field'] = $name; } else { $name = ""; }
		if (isset($rr_array['value']))
		{
			$value = $rr_array['value'];
		}
		else
		{
			$value = isset($rr_array['field']) && isset($element_data[$rr_array['field']]) ? $element_data[$rr_array['field']] : '';
		}
		if (isset($rr_array['label']))				$label 		= $rr_array['label']; else $label = "";
		if (isset($rr_array['style'])) 				$style	 	= "style=\"".$rr_array['style']."\""; else $style = "";
		if (isset($rr_array['id'])) 				$id		 	= "id=\"".$rr_array['id']."\""; else $id = "";
		if (isset($rr_array['disabled'])) 		  { $disabled 	= "disabled"; $reset_radio = "none"; } else { $disabled = ""; $reset_radio = ""; }
		if (isset($rr_array['onclick'])) 			$onclick 	= "onclick=\"".$rr_array['onclick']."\""; else $onclick = "";
		if (isset($rr_array['onchange'])) 			$onchange 	= "onchange=\"".$rr_array['onchange']."\""; else $onchange = "";
		if (isset($rr_array['onblur'])) 			$onblur 	= "onblur=\"".$rr_array['onblur']."\""; else $onblur = "";
		if (isset($rr_array['onfocus'])) 			$onfocus 	= "onfocus=\"".$rr_array['onfocus']."\""; else $onfocus = "";
		if (isset($rr_array['onkeyup'])) 			$onkeyup 	= "onkeyup=\"".$rr_array['onkeyup']."\""; else $onkeyup = "";
		if (isset($rr_array['onkeydown'])) 			$onkeydown 	= "onkeydown=\"".$rr_array['onkeydown']."\""; else $onkeydown = "";
		if (isset($rr_array['css_element_class']))	$class 		= "class='".$rr_array['css_element_class']."'"; else $class = "";
		if (isset($rr_array['action_tag_class'])) $action_tag_class = "class='".$rr_array['action_tag_class']."'"; else $action_tag_class = "";
		if (isset($rr_array['tabindex']))			$tabindex	= "tabindex='".$rr_array['tabindex']."'"; else $tabindex = "";
		if (isset($rr_array['note']))				$note		= "<div class='note'>".$rr_array['note']."</div>"; else $note = "";
		if (isset($rr_array['src']))				$src 		= "src='".$rr_array['src']."'"; else $src = "";
		if (isset($rr_array['field_req']))			$field_req	= "req='1'"; else $field_req = "";
		if (isset($rr_array['custom_alignment']))	$custom_alignment = $rr_array['custom_alignment'];
		// For mobile devices, show all fields as left-aligned
		if ($isMobileDevice) {
			$custom_alignment = str_replace('R', 'L', $custom_alignment);
			if ($custom_alignment == '') $custom_alignment = 'LV';
		}
		// ACTION TAGS: Set tags as array
		$rr_array['action_tags'] = array();
		if (isset($rr_array['action_tag_class']) && $rr_array['action_tag_class'] != '') {
			$rr_array['action_tags'] = explode(" ", $rr_array['action_tag_class']);
		}
		// @USERNAME ACTION TAG
		if (($isSurveyPage || PAGE == 'DataEntry/index.php') && isset($_GET['id']) && in_array('@USERNAME', $rr_array['action_tags']) && $value == '')
		{
			$value = USERID;
		}
		// @DEFAULT ACTION TAG
		if (($isSurveyPage || PAGE == 'DataEntry/index.php') && isset($_GET['id']) && in_array('@DEFAULT', $rr_array['action_tags']))
		{
			// Obtain the default value for this field
			$defaultValue = Form::getValueInQuotesActionTag($Proj->metadata[$name]['misc'], "@DEFAULT");
			// Perform piping on the default value (if needed)
			$defaultValue = Piping::replaceVariablesInLabel($defaultValue, $_GET['id'].$entry_num, $_GET['event_id'], $_GET['instance'], array(), true, null, false);
			// If a survey page of a multi-page survey, check if this survey page has data yet
			if ($isSurveyPage && $hidden_edit == 1 && $question_by_section) {
				$pageHasData = Records::fieldsHaveData($_GET['id'].$entry_num, $pageFields[$_GET['__page__']], $_GET['event_id']);
			}
			// If record exists, then determine if this form as a whole has data
			elseif ($hidden_edit == 1 && $pageHasData === null) { // Don't call the formHasData method unless we have to.
				$pageHasData = Records::formHasData($_GET['id'].$entry_num, $_GET['page'], $_GET['event_id'], $_GET['instance']);
			}
			// Set value IF the record doesn't exist OR if the form has not been saved
			if ($value == '' && $defaultValue != '' && ($hidden_edit == 0 || $pageHasData === false)) {
				// If a checkbox, then parse the comma-delimited values into an array
				if ($Proj->isCheckbox($name)) {
					if (!is_array($value)) $value = array();
					foreach (explode(",", $defaultValue) as $thisChkVal) {
						$value[] = trim($thisChkVal);
					}
				} else {
					$value = $defaultValue;
				}
				// Make sure the Save Changes prompt gets triggered if they try to leave the page
				?><script type="text/javascript">dataEntryFormValuesChanged = true;</script><?php
			}
		}
		// @PLACEHOLDER ACTION TAG
		$placeholderText = "";
		if (in_array('@PLACEHOLDER', $rr_array['action_tags']))
		{
			// Obtain the PLACEHOLDER text for this field
			$placeholderText = Form::getValueInQuotesActionTag($Proj->metadata[$name]['misc'], "@PLACEHOLDER");
			if ($placeholderText != "") {
				$placeholderText = " placeholder='".htmlspecialchars($placeholderText, ENT_QUOTES)."'";
			}
		}
		// @DISABLED ACTION TAGS: Disable field if has disabled action tag
		$hasReadonlyActionTag = Form::disableFieldViaActionTag($rr_array['action_tag_class'], $isSurveyPage);
		if (isset($rr_array['action_tag_class']) && $hasReadonlyActionTag) {
			// Set "disabled" html for this form element
			$disabled = "disabled";
			// Set CSS to hide radio "reset value" links
			$reset_radio = "none";
		}
		// Initialize value to mark fields involved with randomization with special class (for unlocking purposes)
		$randFldClass = '';
		if ((PAGE == "DataEntry/index.php" || ($isSurveyPage && $disable_all)) && isset($_GET['id']))
		{
			// Disable all fields if form has been locked for this record (do not disable __LOCKRECORDS__ field)
			if ($disable_all || $isPromisInstrument)
			{
				// Set "disabled" html for each form element, UNLESS it's the study_id because we will lose
				// their values (gets posted as "" value) when disabled. Make study_id field "readonly" instead.
				$disabled = ($name == $table_pk) ? "readonly" : "disabled";
				// Set CSS to hide radio "reset value" links
				$reset_radio = "none";
				// Prevent from showing Submit buttons to users w/o lock rights (because we cannot easily disable them here like other fields - more complex)
				// But show them when user has e-sign rights and form is not e-signed
				if ($name == "__SUBMITBUTTONS__" || $name == "__DELETEBUTTONS__")
				{
					if ($user_rights['lock_record'] < 1) {
						// Do not display them if whole page is disabled
						continue;
					} elseif (!($user_rights['lock_record'] > 1 && (!isset($is_esigned) || !$is_esigned)) || !$displayEsignature) {
						// Display them if user has e-sign rights and form is not e-signed
						print "<script type='text/javascript'> $(function(){ $('#$name-div').css('display','none'); });</script>";
					}
				}
			}
			if (!$isSurveyPage && ($disable_all || ($user_rights['forms'][$_GET['page']] == '3' && $hidden_edit == 1 && (isset($survey_first_submit_time) && $survey_first_submit_time != null))))
			{
				// Form Status fields should not be disabled because gets posted as "", which turns into "0" as default.
				// Instead, remove all unselected options, and if user unlocks page, it will add back the other options.
				if ($name == $_GET['page']."_complete")
				{
					// If editing a survey response, then make Form Status field disabled, otherwise just leave as field with no other options.
					$disabled = ($user_rights['forms'][$_GET['page']] == '3') ? "readonly" : "";
					print  "<script type='text/javascript'> $(function(){ removeUnselectedFormStatusOptions(); }); </script>";
				}
			}
			## RANDOMIZATION
			// Lock the randomization field and strata fields
			if (!$isSurveyPage && isset($randomizationEnabled) && $randomizationEnabled && (
				// The randomization field should ALWAYS be locked...
				($randomizationField == $name) ||
				// OR if this is a criteria field (and event) for randomization AND the recod has been randomized, then lock the field
				(isset($wasRecordRandomized) && $wasRecordRandomized && isset($randomizationCriteriaFields[$name]) && $randomizationCriteriaFields[$name] == $_GET['event_id'])
				))
			{
				// If page is already locked, then lock the Randomize button too
				$disableRandBtn = $disabled;
				// Lock randomization/criteria fields
				$disabled = "disabled";
				$reset_radio = "none";
				$randFldClass = "randomizationField";
				// Add "Randomize" button for the randomization field (via javascript)
				if ($randomizationField == $name && $randomizationEvent == $_GET['event_id'])
				{
					// Check if randomized and set text accordingly
					$randomizeFieldDisplay = '';
					if ($wasRecordRandomized) {
						// If record was randomized
						$randomize_button = $lang['random_56'];
					} elseif (!$user_rights['random_perform']) {
						// If record is NOT randomized, but user does NOT have permission to randomize, then give text
						$randomize_button = RCView::span(array('style'=>'color:#888;'), $lang['random_69']);
					} else {
						// Give alert that the record needs to be saved first if doesn't exist yet
						$randomizeFieldDisplay = 'display:none;';
						$randomize_button_onclick = "randomizeDialog('".cleanHtml(strip_tags(label_decode($_GET['id'])))."'); return false;";
						$randomize_button = "<button id='redcapRandomizeBtn' class='jqbuttonmed' onclick=\"$randomize_button_onclick\" $disableRandBtn><img src='".APP_PATH_IMAGES."arrow_switch.png' style='vertical-align:middle;'> <span style='vertical-align:middle;color:green;'>{$lang['random_51']}</span></button>";
					}
					$randomize_button = "<div id='alreadyRandomizedText'>$randomize_button</div>";
					?>
					<script type="text/javascript">
					$(function(){
						var randomizationFieldTdObj = $('#<?php echo $randomizationField ?>-tr td.data');
						if (randomizationFieldTdObj.length) {
							// Right-aligned
							var randomizationFieldHtml = randomizationFieldTdObj.html();
							randomizationFieldTdObj.html('<?php echo cleanHtml($randomize_button) ?><div id="randomizationFieldHtml" style="<?php echo $randomizeFieldDisplay ?>">'+randomizationFieldHtml+'</div>');
						} else {
							// Left-aligned
							randomizationFieldTdObj = $('#<?php echo $randomizationField ?>-tr .labelrc');
							var labelText = trim($('#<?php echo $randomizationField ?>-tr .labelrc table td:first').html());
							var randomizationFieldHtml = randomizationFieldTdObj.html();
							randomizationFieldTdObj.html('<div class="randomizationDuplLabel">'+labelText+'<div class="space"></div></div><?php echo cleanHtml($randomize_button) ?><div id="randomizationFieldHtml" style="<?php echo $randomizeFieldDisplay ?>">'+randomizationFieldHtml+'</div>');
							<?php echo (!$wasRecordRandomized && $user_rights['random_perform']) ? "$('.randomizationDuplLabel').show();" : '' ?>
						}
						$('#alreadyRandomizedText button').button();
					});
					</script>
					<?php
				}
			}
		}
		// RANDOMIZATION ON SURVEY: Lock the randomization field IF it is displayed on a survey
		elseif ($isSurveyPage && isset($randomizationEnabled) && $randomizationEnabled && $randomizationField == $name)
		{
			// Lock randomization field
			$disabled = "disabled";
			$reset_radio = "none";
		}
		//If enum exists, make sure that the \n's are also treated as line breaks
		if (isset($rr_array['enum']) && strpos($rr_array['enum'],"\\n")) {
			$rr_array['enum'] = str_replace("\\n","\n",$rr_array['enum']);
		}
		// For survey pages ONLY, set $trclass as 'hide' to hide other-page fields for multi-page surveys
		$trclass = "";
		if ($isSurveyPage) {
			if ($rr_type != 'surveysubmit' && isset($rr_array['field'])) {
				$trclass = (in_array($rr_array['field'], $hideFields) ? " class='hide' " : "");
			} elseif ($rr_type != 'surveysubmit' && isset($rr_array['shfield'])) {
				$trclass = (in_array($rr_array['shfield'], $hideFields) ? " class='hide' " : "");
			} elseif ($rr_type == 'surveysubmit') {
				$trclass = " class='surveysubmit' ";
			}
		}
		if ($trclass == "" && $action_tag_class != "") {
			$trclass = $action_tag_class;
		}
		## Begin rendering row
		// Set default number of columns in table
		$sh_colspan = 2;
		// Normal Fields or Matrix header row
		if ($rr_type == 'matrix_header' || (isset($rr_array['field']) && $rr_type != 'hidden'))
		{
			// Normal field tr
			print "<tr ";
			// Add attributes to rows for matrix fields
			if (isset($rr_array['matrix_field'])) {
				if (PAGE == "Design/online_designer.php" || PAGE == "Design/online_designer_render_fields.php") {
					// Online Designer: Do not allow any matrix fields to be dragged
					// Do not allow other fields to be dragged into a matrix group
					print "NoDrag='1' class='mtxRow' NoDrop='1' ";
				} else {
					// Form/Survey: Add attribute to row, if a matrix field
					print "mtxgrp='{$rr_array['grid_name']}' ";
				}
			}
			// Set special id for matrix headers
			if ($rr_type == 'matrix_header') {
				print "$trclass id='{$rr_array['grid_name']}-mtxhdr-tr' mtxgrp='{$rr_array['grid_name']}' ";
			} else {
				print "$trclass id='{$rr_array['field']}-tr' sq_id='{$rr_array['field']}' $field_req";
				// Do not allow users to move the Primary Key field in the Online Designer
				if ($rr_array['field'] == $table_pk && (PAGE == "Design/online_designer.php" || PAGE == "Design/online_designer_render_fields.php")) {
					print "NoDrag='1' NoDrop='1' ";
				}
			}
			// If a saved value already exists for the field, note it as an attribute flag to use when processing required fields/branching during form submission
			if (($isSurveyPage || PAGE == "DataEntry/index.php") && isset($value) && $value != "") {
				print " hasval='1'";
			}
			print ">";
			$end_row = "</tr>";
			// For surveys, add extra table cell in each row for placing question numbers (for both custom and auto numbering)
			if ($isSurveyPage)
			{
				$quesnum_class = (isset($rr_array['matrix_field'])) ? "labelmatrix questionnummatrix col-xs-1" : "labelrc questionnum col-xs-1";
				print "<td class='$quesnum_class' valign='top'>";
				// Add custom number, if option is enabled for survey
				if (!$question_auto_numbering && $rr_type != 'matrix_header') {
					print $Proj->metadata[$rr_array['field']]['question_num'];
				}
				print "</td>";
			}
		}
		// Section Headers
		elseif (isset($rr_array['shfield']) && $rr_type != 'hidden')
		{
			print "<tr $trclass id='{$rr_array['shfield']}-sh-tr' sq_id='{" . (isset($rr_array['field']) ? $rr_array['field'] : '') . "}'>";
			$end_row = "</tr>";
			// For surveys, change colspan to 3 to deal with table modification due to addition of new cell for question numbers
			if ($isSurveyPage) {
				$sh_colspan = 3;
			}
		}
		// For survey submit buttons
		elseif ($rr_type == 'surveysubmit')
		{
			print "<tr $trclass>";
			$end_row = "</tr>";
			$sh_colspan = 3;
		}
		// For other matters
		elseif ($rr_type != 'hidden')
		{
			print "<tr $trclass>";
			$end_row = "</tr>";
		}
		// Hidden Fields
		else
		{
			$end_row = "";
		}
		// If on Design page, add "add field" button and show icons
		if (PAGE == "Design/online_designer.php" || PAGE == "Design/online_designer_render_fields.php")
		{
			// HTML to display matrix group icons for actions
			$matrixGroupIcons = "";
			if ((isset($rr_array['matrix_field']) && $rr_array['matrix_field'] == '1' && $rr_type == "header") || (isset($rr_array['matrix_field']) && $rr_array['matrix_field'] == '1' && !isset($rr_array['hasSH']))) {
				$matrixGroupIcons = "<div class='designMtxGrpIcons'>
										<a href='javascript:;' onclick=\"openAddMatrix('{name}','')\"
										><img src='".APP_PATH_IMAGES."pencil.png' ignore='Yes' title='Edit Matrix'></a>&nbsp;
										<a href='javascript:;' onclick=\"moveField('{name}','{$rr_array['grid_name']}')\"
										><img src='".APP_PATH_IMAGES."file_move.png' ignore='Yes' title='Move Matrix'></a>&nbsp;
										<a href='javascript:;' onclick=\"deleteMatrix('{name}','{$rr_array['grid_name']}');\"
										><img src='".APP_PATH_IMAGES."cross.png' ignore='Yes' title='Delete Matrix'></a>
										&nbsp;&nbsp;&nbsp;
										<span class='mtxgrpname'>
											<i>{$lang['design_302']}</i>&nbsp; {$rr_array['grid_name']}
										</span>
									 </div>";
			}
			// Hide icons for Section Headers, as they are not applicable
			// Flag to show/hide the Add Field buttons
			$addFieldBtnStyle = "";
			if ($rr_type == "header") {
				## SECTION HEADER
				$this_bookend1 = str_replace(array("{style-display}","{matrixHdrs}","{matrixGroupIcons}","{field_icons}","{addFieldBtnStyle}"),
											 array('style="display:none;"','',$matrixGroupIcons,"",$addFieldBtnStyle),
											 $bookend1);
				$name = $rr_array['field'];
			} else {
				## REGULAR FIELDS
				// Replace string for Matrix question headers to display
				$matrixHdrsRepl = '';
				$fieldIcons =  '<a href="javascript:;" onclick="openAddQuesForm(\'{name}\',\'{rr_type}\',0,\'{signature}\');"
								><img src="'.APP_PATH_IMAGES.'pencil.png" ignore="Yes" title="Edit"></a>&nbsp;
								<a href="javascript:;" onClick="copyField(\'{name}\')"
								><img src="'.APP_PATH_IMAGES.'page_copy.png" ignore="Yes" title="Copy"/></a>&nbsp;
								<a href="javascript:;" onClick="openLogicBuilder(\'{name}\')"
								><img src="'.APP_PATH_IMAGES.'arrow_branch_side.png" ignore="Yes" title="Branching Logic"/></a>&nbsp;
								<a href="javascript:;" onClick="moveField(\'{name}\',\'\')"
								><img src="'.APP_PATH_IMAGES.'file_move.png" ignore="Yes" title="Move"/></a>&nbsp;
								<a href="javascript:;" onClick="setStopActions(\'{name}\')"
								><img style="display:{display_stopactions};margin-right:4px;" src="'.APP_PATH_IMAGES.'stopsign.gif" ignore="Yes" title="Stop Actions for Surveys"/></a
								><a href="javascript:;" onClick="deleteField(\'{name}\',0);"
								><img src="'.APP_PATH_IMAGES.'cross.png" ignore="Yes" title="Delete Field"/></a>
								&nbsp;&nbsp;&nbsp;
								<span class="designVarName">
									<i>'.$lang['form_renderer_16'].'</i> {name}
									{branching_logic}
									'.(isset($Proj->forms[$_GET['page']]['survey_id']) ? '<span class="pkNoDispMsg"></span>' : '').'
								</span>';
				// If this is first field (PK field), then hide Add Question button and remove delete/move icons
				if ($rr_array['field'] == $table_pk)
				{
					$addFieldBtnStyle = "visibility:hidden;padding:1px;height:10px;";
					$fieldIcons =  '<a href="javascript:;" onclick="openAddQuesForm(\'{name}\',\'{rr_type}\',0,\'{signature}\');"
									><img src="'.APP_PATH_IMAGES.'pencil.png" ignore="Yes" title="Edit"></a>
									&nbsp;&nbsp;&nbsp;
									<span class="designVarName">
										<i>'.$lang['form_renderer_16'].'</i> {name}
										{branching_logic}
										'.(isset($Proj->forms[$_GET['page']]['survey_id']) ? '<span class="pkNoDispMsg"></span>' : '').'
									</span>';
				}
				// Format matrix fields differently
				elseif (isset($rr_array['enum']) && $rr_array['enum'] != "" && isset($rr_array['matrix_field']))
				{
					// Only show matrix column headers for first field in matrix group
					if ($rr_array['matrix_field'] == '1') {
						$matrixHdrsRepl =  matrixHeaderTable($rr_array['enum'], getMatrixHdrWidths(count(parseEnum($rr_array['enum']))), $rr_array['matrix_field'], $rr_array['grid_rank']);
					}
					// Hide Add Field buttons between matrix questions (swap out CSS to hide it)
					if ($rr_array['matrix_field'] != '1' || ($rr_array['matrix_field'] == '1' && isset($rr_array['hasSH']))) {
						$addFieldBtnStyle = "visibility:hidden;padding:1px;height:0;";
					}
					// Use different field icons for matrix fields
					$fieldIcons =  '<a href="javascript:;" onClick="openLogicBuilder(\'{name}\')"
									><img src="'.APP_PATH_IMAGES.'arrow_branch_side.png" ignore="Yes" title="Branching Logic"/></a
									>&nbsp;
									<a href="javascript:;" onClick="setStopActions(\'{name}\')"
									><img style="display:{display_stopactions};margin-right:4px;" src="'.APP_PATH_IMAGES.'stopsign.gif" ignore="Yes" title="Stop Actions for Surveys"/></a>
									&nbsp;&nbsp;&nbsp;
									<span style="font-size:10px;position:relative;top:-4px;">
										<i>'.$lang['form_renderer_16'].'</i> {name}
										{branching_logic}
									</span>';
				}
				// Replace the strings
				$this_bookend1 = str_replace(array("{field_icons}","{matrixHdrs}","{addFieldBtnStyle}","{matrixGroupIcons}","{style-display}"),
											 array($fieldIcons, $matrixHdrsRepl,$addFieldBtnStyle,$matrixGroupIcons,""),
											 $bookend1);
			}
			// If form is set up as a survey AND this field is multiple choice, show the Stop Action icon
			$displayStopAction = "none";
			if (isset($Proj->forms[$_GET['page']]['survey_id']) && in_array($rr_type, array('select','radio','yesno','truefalse','checkbox'))) {
				$displayStopAction = "";
			}
			// Set up replacement values ("sql" field type is special case since it is rendered as "select")
			$repl1 = array($name, $rr_type, (isset($rr_array['branching_logic']) ? $rr_array['branching_logic'] : ''), $displayStopAction, (isset($rr_array['validation']) && $rr_array['validation'] == 'signature' ? '1' : '0'));
			if ($rr_type == "select") {
				if (in_array($name, $sql_fields)) {
					$repl1 = array($name, "sql", $rr_array['branching_logic'], $displayStopAction, ($rr_array['validation'] == 'signature' ? '1' : '0'));
				}
			}
			// Replace strings to customize each field in Design mode
			print str_replace($orig1, $repl1, $this_bookend1);
		}
		// For data entry forms, render ICON FOR DATA HISTORY (i.e. replace label with extra surrounding html)
		elseif (PAGE == "DataEntry/index.php" && isset($_GET['id'])
			// exclude certain field types
			&& !in_array($rr_type, array("static", "hidden", "button", "lock_record", "esignature", "descriptive", "matrix_header")))
		{
			$label =   "<table style='width:100%;height:100%;max-height:100%;' cellspacing='0' cellpadding='0'>
							<tr>
								<td>
									$label
								</td>
								<td style='width:10px;padding-left:5px;'>";
			// If data history widget is enabled, display the icon
			if ($history_widget_enabled) {
				$label .=  "		<a href='javascript:;' onclick=\"dataHist('$name',{$_GET['event_id']});return false;\"><img src='".APP_PATH_IMAGES."history.png'
									title='".cleanHtml($lang['data_entry_181'])."' onmouseover='dh1(this)' onmouseout='dh2(this)' style='margin-bottom:1px;'></a><br>";
			}
			// Data Resolution icon
			if ($data_resolution_enabled > 0) {
				// Set icon to display (gray if field has no data cleaner history)
				$fieldHasDRHistory = array_key_exists($name, $dcFieldsWithHistory);
				if ($fieldHasDRHistory) {
					$dc_field_mouse_over = "";
					if ($dcFieldsWithHistory[$name]['status'] == 'OPEN' && !$dcFieldsWithHistory[$name]['responded']) {
						$dc_field_icon = "balloon_exclamation.gif";
					} elseif ($dcFieldsWithHistory[$name]['status'] == 'OPEN' && $dcFieldsWithHistory[$name]['responded']) {
						$dc_field_icon = "balloon_exclamation_blue.gif";
					} elseif ($dcFieldsWithHistory[$name]['status'] == 'CLOSED') {
						$dc_field_icon = "balloon_tick.gif";
					} elseif ($dcFieldsWithHistory[$name]['status'] == 'VERIFIED') {
						$dc_field_icon = "tick_circle.png";
					} elseif ($dcFieldsWithHistory[$name]['status'] == 'DEVERIFIED') {
						$dc_field_icon = "exclamation_red.png";
					} else {
						$dc_field_icon = "balloon_left.png";
					}
				} else {
					$dc_field_icon = "balloon_left_bw2.gif";
					$dc_field_mouse_over = "onmouseover='dc1(this)' onmouseout='dc2(this)'";
				}
				$fieldForm = '';
				$hasFormEditRights = false;
				if (isset($name))
				{
					$fieldForm = $Proj->metadata[$name]['form_name'];
					$hasFormEditRights = ($user_rights['forms'][$Proj->metadata[$name]['form_name']] != '2');
				}
				// Display DR balloon icon if...
				if (
					// Has field comment log enabled AND
					($data_resolution_enabled == '1' && ($fieldHasDRHistory || (!$fieldHasDRHistory && $hasFormEditRights)))
					// OR has DQ resolution workflow enabled AND (user has edit rights OR user has view rights and field has history)
					|| ($data_resolution_enabled == '2'
						&& ($user_rights['data_quality_resolution'] > 1 || ($fieldHasDRHistory && $user_rights['data_quality_resolution'] > 0))))
				{
					$dc_field_icon_title = ($data_resolution_enabled == '1') ? $lang['dataqueries_145'] : $lang['dataqueries_140'];
					$label .=  "	<a href='javascript:;' onclick=\"dataResPopup('$name',{$_GET['event_id']},null,null,null,{$_GET['instance']});return false;\"><img id='dc-icon-$name' src='".APP_PATH_IMAGES."$dc_field_icon'
									title='".cleanHtml($dc_field_icon_title)."' $dc_field_mouse_over></a>";
				}
			}
			$label .=  "		</td>
							</tr>
						</table>";
		}
		// Render html table row for each field type
		switch ($rr_type)
		{
			// Section headers AND context messages
			case 'header':
				if (PAGE == "DataEntry/index.php" || $isSurveyPage) {
					$value = decode_filter_tags($value);
				}
				print "<td $class $style colspan='$sh_colspan'>$value</td>";
				break;
			// Survey "submit" buttons
			case 'surveysubmit':
				print  "<td class='labelrc col-xs-12' style='padding:5px;' colspan='$sh_colspan'>$label</td>";
				break;
			// Descriptive text with option image/file attachment OR embedded video
			case 'descriptive':
				print "<td class='labelrc $colClassCombined' colspan='2'>$label";
				// Check if has a file attachment or video url
				$edoc_id = isset($rr_array['edoc_id']) ? $rr_array['edoc_id'] : '';
				$edoc_display_img = isset($rr_array['edoc_display_img']) ? $rr_array['edoc_display_img'] : '';
				$video_url = isset($rr_array['video_url']) ? $rr_array['video_url'] : '';
				$video_display_inline = isset($rr_array['video_display_inline']) ? $rr_array['video_display_inline'] : '';
				// ATTACHMENT OR INLINE IMAGE
				if (is_numeric($edoc_id))
				{
					// Query edocs table to get file attachment info
					$sql = "select * from redcap_edocs_metadata where project_id = " . PROJECT_ID . " and delete_date is null
							and doc_id = $edoc_id";
					$q = db_query($sql);
					// Show text for downloading file or viewing image
					if (db_num_rows($q) < 1)
					{
						print "<br><br><i style='font-weight:normal;color:#666;'>{$lang['design_204']}</i>";
					}
					else
					{
						$edoc_info = db_fetch_assoc($q);
						//Set max-width for logo (include for mobile devices)
						$img_attach_width = (isset($isMobileDevice) && $isMobileDevice) ? '250' : '670';
						// If an image file and set to view as image, then do so and resize (if needed)
						$img_types = array("jpeg", "jpg", "gif", "png", "bmp");
						if ($edoc_display_img == '2')
						{
							// Embedded audio
							if ($isIE && $edoc_info['mime_type'] != 'audio/mp3'){ //if IE use the embed tag
								print "<br><br><embed src='$file_download_page&doc_id_hash=".Files::docIdHash($edoc_id)."&instance={$_GET['instance']}&id=$edoc_id&stream=1"
								. ($isSurveyPage ? "&s=".$_GET['s'] : "") . "' autostart=false class='audio-player'>";
							} else{ //use the HTML audio tag on chrome and other browsers
								print "<br><br><audio controls='controls' type='{$edoc_info['mime_type']}'><source src='$file_download_page&doc_id_hash=".Files::docIdHash($edoc_id)."&instance={$_GET['instance']}&id=$edoc_id&stream=1"
											. ($isSurveyPage ? "&s=".$_GET['s'] : "") . "'/>{$lang['global_121']}</audio>";
							}
						}
						elseif ($edoc_display_img == '1' && in_array(strtolower($edoc_info['file_extension']), $img_types))
						{
							// Inline image
							print "<br><br><img src='$image_view_page&doc_id_hash=".Files::docIdHash($edoc_id)."&id=$edoc_id&instance={$_GET['instance']}"
										. ($isSurveyPage ? "&s=".$_GET['s'] : "") .
										"' {$surveyImgOnload}alt='[IMAGE]' style='max-width:{$img_attach_width}px; expression(this.width > $img_attach_width ? $img_attach_width : true);'>";
						}
						// Else display as a link for download
						else
						{
							// Set file size in MB
							$edoc_info['doc_size'] = round_up($edoc_info['doc_size'] / 1024 / 1024);
							// Display icon for appriopriate files
							switch (strtolower($edoc_info['file_extension'])) {
								case "csv":	$icon = "csv.gif"; break;
								case "xls":
								case "xlsx":$icon = "xls.gif"; break;
								case "doc":
								case "docx":$icon = "doc.gif"; break;
								case "pdf":	$icon = "pdf.gif"; break;
								case "ppt":
								case "pptx":$icon = "ppt.gif"; break;
								case "jpg":
								case "jpeg":
								case "gif":
								case "png":
								case "bmp": $icon = "picture.png"; break;
								case "zip": $icon = "zip.png"; break;
								default:	$icon = "attach.png";
							}
							// Display link for downloading file
							print  "<div class='div_attach'>
										{$lang['design_205']} &nbsp;
										<img src='" . APP_PATH_IMAGES . "$icon'>
										<a class='rc_attach' href='$file_download_page&doc_id_hash=".Files::docIdHash($edoc_id)."&instance={$_GET['instance']}&id=$edoc_id"
										. ($isSurveyPage ? "&s=".$_GET['s'] : "") . "'>{$edoc_info['doc_name']}</a>&nbsp;
										({$edoc_info['doc_size']} MB)
									</div>";
						}
					}
				}
				// EMBEDDED VIDEO
				elseif ($enable_field_attachment_video_url && $video_url != '')
				{
					// Default values
					$unknown_video_service = '1';
					$video_url_formatted = $video_url;
					// Vimeo URL
					if (stripos($video_url, 'vimeo.com') !== false
						&& preg_match("/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/", $video_url, $matches)) {
						$unknown_video_service = '0';
						$video_url_formatted = 'https://player.vimeo.com/video/' . $matches[3];
					}
					// Youtube URL
					elseif ((stripos($video_url, 'youtube.com') !== false || stripos($video_url, 'youtu.be') !== false)
							&& preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=embed/)[^&\n]+|(?<=v=)[^&\??n]+|(?<=youtu.be/)[^&\n]+#", $video_url, $matches)) {
						$unknown_video_service = '0';
						$video_url_formatted = 'https://www.youtube.com/embed/' . $matches[0] . '?wmode=transparent';
					}
					// Inline display
					if ($video_display_inline == '1') {
						$video_height = (isset($isMobileDevice) && $isMobileDevice) ? '180' : '450';
						print "<div class='div_embed_video'>";
						if ($unknown_video_service) {
							print "<embed src='".cleanHtml($video_url_formatted)."' width='100%' height='$video_height' scale='aspect' controller='true' autostart='false' autostart='0'></embed>";
						} else {
							print "<iframe src='".cleanHtml($video_url_formatted)."' type='text/html' frameborder='0' allowfullscreen width='100%' height='$video_height'></iframe>";
						}
						print "</div>";
					}
					// Display inside popup
					else {
						print  "<div class='div_embed_video'>
									<button ignore='Yes' class='jqbuttonmed' onclick=\"openEmbedVideoDlg('".cleanHtml($video_url_formatted)."',$unknown_video_service,'$name');return false;\">
										<img src='" . APP_PATH_IMAGES . "video_icon.png'>
										<span>{$lang['global_120']}</span>
									</button>
								</div>";
					}
				}
				print "</td>";
				break;
			//Static element (put lots of things here)
			case 'static':
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'>$value";
				//Let $table_pk be hidden if static (for posting purposes)
				if ((PAGE == "DataEntry/index.php") && $rr_array['field'] == $table_pk)
				{
					// Use '__old_id__' field to determine if record id gets changed (if option is enabled)	when on first form
					if (isset($user_rights) && $user_rights['record_rename'] && isset($_GET['page']) && $_GET['page'] == $Proj->firstForm)
					{
						// Add hidden old id field (to catch record renaming)
						print "<input type='hidden' name='__old_id__' value='$value'>";
						print "<div style='color:#777;font-size:7pt;line-height:8pt;padding:5px 0 2px;'>".$lang['data_entry_322'];
						print ' <a class="opacity75" style="font-size:11px;text-decoration:underline;font-size:7pt;line-height:8pt;" href="'.APP_PATH_WEBROOT.'DataEntry/record_home.php?pid='.PROJECT_ID.'&id='.$_GET['id'].($Proj->eventInfo[$_GET['event_id']]['arm_num'] > 1 ? '&arm='.$Proj->eventInfo[$_GET['event_id']]['arm_num'] : '').'">'.$lang['grid_42'].'</a>'.$lang['period'];
						print "</div>";
						// Add javascript to editable record id field to prevent users from renaming to a blank value
						print  "<script type='text/javascript'>
								$(function(){
									$('#form input[type=\"text\"][name=\"'+table_pk+'\"]').blur(function(){
										var table_pk_newval = trim( $(this).val() );
										if (table_pk_newval.length < 1) {
											alert('".cleanHtml($lang['data_entry_168'])."');
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
										if (table_pk_newval.length > 100) {
											alert('".cleanHtml($lang['data_entry_186'])."');
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
										table_pk_newval = table_pk_newval.replace(/&quot;/g,''); // HTML char code of double quote
										// Don't allow pound signs in record names
										if (/#/g.test(table_pk_newval)) {
											alert(\"Pound signs (#) are not allowed in record names! Please enter another record name.\");
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
										// Don't allow apostrophes in record names
										if (/'/g.test(table_pk_newval)) {
											alert(\"Apostrophes are not allowed in record names! Please enter another record name.\");
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
										// Don't allow ampersands in record names
										if (/&/g.test(table_pk_newval)) {
											alert(\"Ampersands (&) are not allowed in record names! Please enter another record name.\");
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
										// Don't allow plus signs in record names
										if (/\+/g.test(table_pk_newval)) {
											alert(\"Plus signs (+) are not allowed in record names! Please enter another record name.\");
											$(this).val( $('#form :input[name=\"__old_id__\"]').val() ).focus();
											return false;
										}
									});
								});
								</script>";
					}
				}
				print "</td>";
				break;
			//Images
			case 'image':
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'><img $id $src $onclick></td>";
				break;
			//Advcheckbox
			case 'advcheckbox':
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'>";
				print  '<input '.$id.' type="checkbox" '." $disabled $tabindex $onchange $onblur $onfocus".' onclick="
						document.form.'.$name.'.value=(this.checked)?1:0;doBranching();" name="_checkbox_'.$name.'" ';
				if ($value == '1') {
					print 'checked> ';
					$default_value = '1';
				} else {
					print '> ';
					$default_value = '0'; //Default value is 0 if no present value exists
				}
				print  '<input type="hidden" value="'.$default_value.'" name="'.$name.'">';
				print  "$note</td>";
				break;
			//Lock/Unlock records
			case 'lock_record':
				// If form is disabled (for whatever reason), give option to lock it via ajax
				$onclick = ($disabled != 'disabled') ? '' : "onclick='lockDisabledForm(this)'";
				if ($disabled == 'disabled' && !$form_locked['status']) $disabled = '';
				// Output row
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight' style='padding:5px;'><input type='checkbox' id='__LOCKRECORD__' $onclick $disabled";
				if ($form_locked['status']) print ' checked ';
				print  " >&nbsp;<img src='".APP_PATH_IMAGES."lock.png'> <b style='color:#A86700'>{$lang['form_renderer_18']}</b>";
				// Display username and timestamp to ALL users if locked
				if ($form_locked['status'])
				{
					// Render link to unlock
					if ($user_rights['lock_record'] > 0) {
						print  "<span id='unlockbtn' style='padding-left:20px;'><input type='button' onclick='unlockForm();'
							style='font-size:11px;' value='".cleanHtml($lang['data_entry_182'])."'></span>";
					}
					print  "<div id='lockingts'><b>{$lang['form_renderer_05']}</b> ";
					if ($form_locked['username'] != "") {
						print  "<b>{$lang['form_renderer_06']} {$form_locked['username']}</b> ({$form_locked['user_firstname']}
							{$form_locked['user_lastname']}) ";
					}
					print  "{$lang['global_51']} " . DateTimeRC::format_ts_from_ymd($form_locked['timestamp']);
					print  "</div>";
				}
				// Display e-signature info, if any and/or if user has e-signature rights
				print $esignature_text;
				print  "</td>";
				break;
			//Single Checkbox
			case 'checkbox_single':
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'><input $id type='checkbox' name='$name' $disabled $tabindex $onchange $onblur $onfocus>$note</td>";
				break;
			//Multiple Answer Checkbox
			case 'checkbox':
				// Is Matrix field?
				$matrix_col_width = null;
				if (isset($rr_array['matrix_field'])) {
					// Determine width of each column based upon number of choices
					$matrix_col_width = getMatrixHdrWidths(count(parseEnum($rr_array['enum'])));
					print  "<td class='labelmatrix $colClassCombined' colspan='2'>
								<table cellspacing='0' style='width:100%;'><tr>
									<td style='padding:2px 0;'>$label</td>";
				// Right-aligned
				} elseif ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				render_checkboxes($rr_array['enum'], (isset($value) ? $value : ''), $name, "$id $onchange $onclick $onblur $onfocus $disabled", $custom_alignment, $matrix_col_width, $tabindex, $disabled=='disabled', $enhanced_choices, $hasReadonlyActionTag);
				if (isset($rr_array['matrix_field'])) {
					print "</tr></table>";
				} else {
					print "<div class='space'></div>";
				}
				print "$note</td>";
				break;
			//Hidden fields
			case 'hidden':
				// If this is really a date[time][_seconds] field that is hidden, then make sure we reformat the date for display on the page
				if (isset($Proj->metadata[$name]) && $Proj->metadata[$name]['element_type'] == 'text')
				{
					if (substr($Proj->metadata[$name]['element_validation_type'], -4) == '_mdy') {
						list ($this_date, $this_time) = explode(" ", $value);
						$value = trim(DateTimeRC::date_ymd2mdy($this_date) . " " . $this_time);
					} elseif (substr($Proj->metadata[$name]['element_validation_type'], -4) == '_dmy') {
						list ($this_date, $this_time) = explode(" ", $value);
						$value = trim(DateTimeRC::date_ymd2dmy($this_date) . " " . $this_time);
					}
				}
				print "\n<input type='hidden' name='$name' $id value='".str_replace("'","&#039;",$value)."'>";
				break;
			//HTML "file" input fields, not REDCap "file" field types
			case 'file2':
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'><input type='file' name='$name' id='$name'></td>";
				break;
			//Textarea
			case 'textarea':
				// Clean the value for </textarea> tags used in XSS
				$value = RCView::escape(isset($value) ? $value : '', false);
				// Output row
				if (!isset($custom_alignment) || $custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				print  "	<textarea class='x-form-field notesbox' id='$name' name='$name' $tabindex $disabled $onchange $onclick $onblur $onfocus $placeholderText>$value</textarea>
							<div id='{$name}-expand' class='expandLinkParent'>
								<a href='javascript:;' class='expandLink' onclick=\"growTextarea('$name')\">{$lang['form_renderer_19']}</a>&nbsp;
							</div>
							$note
						</td>";
				break;
			//True-False
			case 'truefalse':
				// Validate that the value is either 1 or 0 or blank. If none, then set to blank.
				if (isset($value) && $value != '' && $value != '0' && $value != '1') $value = '';
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				print  "<input name='$name' value='" . (isset($value) ? $value : '') . "' $tabindex onfocus=\"doFocusRadio('$name','$formJsName');\" class='choicevert0'>";
				render_radio($rr_array['enum'], (isset($value) ? $value : ''), $name, "$id $onchange $onclick $onblur $onfocus $disabled" . ($randFldClass==''?'':" class='$randFldClass'"), $custom_alignment, null, $disabled=='disabled', $enhanced_choices, $hasReadonlyActionTag);
				print "<div class='resetLinkParent'><a href='javascript:;' class='smalllink $randFldClass' style='display:$reset_radio;'
					onclick=\"return radioResetVal('$name','$formJsName');\" onfocus=\"doFocusNext('$name','$formJsName');\">{$lang['form_renderer_20']}</a></div>";
				print "$note</td>";
				break;
			//Yes-No
			case 'yesno':
				// Validate that the value is either 1 or 0 or blank. If none, then set to blank.
				if (isset($value) && $value != '' && $value != '0' && $value != '1') $value = '';
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				print  "<input name='$name' value='" . (isset($value) ? $value : '') . "' $tabindex onfocus=\"doFocusRadio('$name','$formJsName');\" class='choicevert0'>";
				render_radio($rr_array['enum'], (isset($value) ? $value : ''), $name, "$id $onchange $onclick $onblur $onfocus $disabled" . ($randFldClass==''?'':" class='$randFldClass'"), $custom_alignment, null, $disabled=='disabled', $enhanced_choices, $hasReadonlyActionTag);
				print "<div class='resetLinkParent'><a href='javascript:;' class='smalllink $randFldClass' style='display:$reset_radio;'
					onclick=\"return radioResetVal('$name','$formJsName');\" onfocus=\"doFocusNext('$name','$formJsName');\">{$lang['form_renderer_20']}</a></div>";
				print "$note</td>";
				break;
			// Matrix group header
			case 'matrix_header':
				// Determine width of each column based upon number of choices
				$matrix_col_width = getMatrixHdrWidths(count(parseEnum($rr_array['enum'])));
				// First column (which is blank)
				print  "<td class='labelmatrix $colClassCombined' colspan='2' style='padding:10px 0 0;vertical-align:bottom;'>";
				print  matrixHeaderTable($rr_array['enum'], $matrix_col_width, null, $rr_array['grid_rank']);
				print  "</td>";
				break;
			//Radio
			case 'radio':
				// Validate the format of the value. If has illegal characters, then set to blank. (Some Assessment Center API assessments might contain a dash.)
				if (isset($value) && !is_numeric($value) && !preg_match("/^([a-zA-Z0-9._]+)$/", $value) && !(isset($isPromisInstrument) && $isPromisInstrument)) $value = '';
				// Is Matrix field?
				$matrix_col_width = null;
				if (isset($rr_array['matrix_field'])) {
					// Determine width of each column based upon number of choices
					$matrix_col_width = getMatrixHdrWidths(count(parseEnum($rr_array['enum'])));
					print  "<td class='labelmatrix $colClassCombined' colspan='2'>
								<table cellspacing=0 width=100%><tr>
									<td style='padding:2px 0;'>$label</td>";
				// Right-aligned
				} elseif ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				print  "<input name='$name' value='" . (isset($value) ? $value : '') . "' $tabindex onfocus=\"doFocusRadio('$name','$formJsName');\" class='choicevert0'>";
				render_radio($rr_array['enum'], (isset($value) ? $value : ''), $name, "$id $onchange $onclick $onblur $onfocus $disabled" . ($randFldClass==''?'':" class='$randFldClass'"), $custom_alignment, $matrix_col_width, $disabled=='disabled', $enhanced_choices, $hasReadonlyActionTag);
				if (isset($rr_array['matrix_field'])) {
					print "</tr></table>";
				}
				print  "<div class='resetLinkParent'><a href='javascript:;' class='smalllink $randFldClass' style='display:$reset_radio;'
						onclick=\"return radioResetVal('$name','$formJsName');\" onfocus=\"doFocusNext('$name','$formJsName');\">{$lang['form_renderer_20']}</a></div>";
				print "$note</td>";
				break;
			//Drop-down
			case 'select':
				// Validate the format of the value. If has illegal characters, then set to blank.
				if (PAGE != 'install.php' && $Proj->metadata[$name]['element_type'] != 'sql' && isset($value) && !is_numeric($value)
					&& !preg_match("/^([a-zA-Z0-9._]+)$/", $value)) {
					$value = '';
				}
				// If this field is REALLY an SQL field type, then do a string replace in the value to deal with commas and parsing
				if ($Proj->metadata[$name]['element_type'] == 'sql') {
					$value = str_replace(array('"',"'","&#39;",","), array('&quot;',"&#039;","&#039;","&#44;"), $value);
					$rr_array['enum'] = str_replace(array('"',"'","&#39;"), array('&quot;',"&#039;","&#039;"), $rr_array['enum']);
				}
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				// Enable auto-complete?
				$enable_dd_auto_complete = (isset($rr_array['validation']) && $rr_array['validation'] == 'autocomplete');
				$dd_auto_complete_class = "";
				$dd_auto_complete_input = "";
				if ($enable_dd_auto_complete) {
					// Build HTML for input/button to replace select box
					$dd_auto_complete_btn_onclick = (PAGE == "Design/online_designer.php" || PAGE == "Design/online_designer_render_fields.php")
													? "enableDropdownAutocomplete();return false;" : "return false;";
					$dd_auto_complete_input = "<div class='nowrap' style='max-width:95%;'>"
											. "<input $tabindex $placeholderText type='text' $disabled class='x-form-text x-form-field rc-autocomplete' id='rc-ac-input_$name'>"
											. "<button $disabled listopen='0' tabindex='-1' onclick='$dd_auto_complete_btn_onclick' class='ui-button ui-widget ui-state-default ui-corner-right rc-autocomplete'>"
											. "<img class='rc-autocomplete' src='".APP_PATH_IMAGES."arrow_state_grey_expanded.png'></button></div>";
					// Set new values for the select box
					$tabindex = "";
					$dd_auto_complete_class = "rc-autocomplete";
				}
				// Render the drop-down
				print  "<span $class><select class='x-form-text x-form-field $dd_auto_complete_class $randFldClass' name='$name' $id $disabled $onchange $onclick $onblur $onfocus $tabindex>";
				render_dropdown($rr_array['enum'],$value);
				print  "</select></span>$dd_auto_complete_input
						$note
						</td>";
				break;
			//Text
			case 'text':
				// Alignment class
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					$newclass = "";
				} else {
					$newclass = "rci-left";
				}
				// If needed, deal with Date and Time validated fields
				$style = "";
				$nowBtn = "";
				$inputPattern = "";
				$fv_attr = "";
				$value = isset($value) ? $value : '';
				if (isset($rr_array['validation']))
				{
					// Set field attribute
					$fv_attr = "fv='{$rr_array['validation']}'";
					// Dates
					if ($rr_array['validation'] == 'date' || $rr_array['validation'] == 'date_ymd' || $rr_array['validation'] == 'date_mdy' || $rr_array['validation'] == 'date_dmy')
					{
						if (!$disable_all) {
							$newclass = $rr_array['validation'];
							if ($rr_array['validation'] == 'date') {
								$newclass = 'date_ymd';
							}
							$dformat = MetaData::getDateFormatDisplay($rr_array['validation']);
							if ($display_today_now_button) $nowBtn = "&nbsp;&nbsp; <button ignore='Yes' class='jqbuttonsm' onclick=\"setToday('$name','{$rr_array['validation']}');return false;\">{$lang['dashboard_32']}</button>";
							$nowBtn .= "<span class='df'>$dformat</span>";
						}
						// Reformat MDY/DMY values
						if ($rr_array['validation'] == 'date_mdy') {
							$value = DateTimeRC::date_ymd2mdy($value);
						} elseif ($rr_array['validation'] == 'date_dmy') {
							$value = DateTimeRC::date_ymd2dmy($value);
						}
						$onkeydown = "onkeydown=\"dateKeyDown(event,'$name')\"";
					}
					// Time
					elseif ($rr_array['validation'] == 'time')
					{
						if (!$disable_all) {
							$newclass = "time2";
							if ($display_today_now_button) $nowBtn = "&nbsp;&nbsp; <button ignore='Yes' class='jqbuttonsm' onclick=\"setNowTime('$name');return false;\">{$lang['form_renderer_29']}</button>";
							$dformat = MetaData::getDateFormatDisplay($rr_array['validation']);
							$nowBtn .= "<span class='df'>$dformat</span>";
						}
					}
					// Datetimes
					elseif ($rr_array['validation'] == 'datetime' || $rr_array['validation'] == 'datetime_ymd' || $rr_array['validation'] == 'datetime_mdy' || $rr_array['validation'] == 'datetime_dmy')
					{
						if (!$disable_all) {
							$newclass = $rr_array['validation'];
							if ($rr_array['validation'] == 'datetime') {
								$newclass = 'datetime_ymd';
							}
							$dformat = MetaData::getDateFormatDisplay($rr_array['validation']);
							if ($display_today_now_button) $nowBtn = "&nbsp;&nbsp; <button ignore='Yes' class='jqbuttonsm' onclick=\"setNowDateTime('$name',0,'{$rr_array['validation']}');return false;\">{$lang['form_renderer_29']}</button>";
							$nowBtn .= "<span class='df'>$dformat</span>";
						}
						// Reformat MDY/DMY values
						if ($rr_array['validation'] == 'datetime_mdy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2mdy($this_date) . " " . $this_time);
						} elseif ($rr_array['validation'] == 'datetime_dmy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2dmy($this_date) . " " . $this_time);
						}
						$onkeydown = "onkeydown=\"dateKeyDown(event,'$name')\"";
					}
					// Datetime_seconds
					elseif ($rr_array['validation'] == 'datetime_seconds' || $rr_array['validation'] == 'datetime_seconds_ymd' || $rr_array['validation'] == 'datetime_seconds_mdy' || $rr_array['validation'] == 'datetime_seconds_dmy')
					{
						if (!$disable_all) {
							$newclass = $rr_array['validation'];
							if ($rr_array['validation'] == 'datetime_seconds') {
								$newclass = 'datetime_seconds_ymd';
							}
							$dformat = MetaData::getDateFormatDisplay($rr_array['validation']);
							if ($display_today_now_button) $nowBtn = "&nbsp;&nbsp; <button ignore='Yes' class='jqbuttonsm' onclick=\"setNowDateTime('$name',1,'{$rr_array['validation']}');return false;\">{$lang['form_renderer_29']}</button>";
							$nowBtn .= "<span class='df'>$dformat</span>";
						}
						// Reformat MDY/DMY values
						if ($rr_array['validation'] == 'datetime_seconds_mdy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2mdy($this_date) . " " . $this_time);
						} elseif ($rr_array['validation'] == 'datetime_seconds_dmy') {
							list ($this_date, $this_time) = explode(" ", $value);
							$value = trim(DateTimeRC::date_ymd2dmy($this_date) . " " . $this_time);
						}
						$onkeydown = "onkeydown=\"dateKeyDown(event,'$name')\"";
					}
					// INTEGER or PHONE field on MOBILE devices and TABLETS only (switch to number pad instead of regular keyboard)
					elseif (($isTablet || $isMobileDevice)
						&& ($rr_array['validation'] == 'integer'
						// Phone won't work on Android because it strangely erases the field value after being entered
						|| ($isIOS && $rr_array['validation'] == 'phone')))
					{
						if ($isIOS) {
							// iOS
							$inputPattern = "pattern='\d*'";
						} else {
							// Android, etc.
							$rr_type = "number";
						}
					}
					// ACTION TAGS for NOW and TODAY: Format value according to validation type
					if (in_array("@TODAY", $rr_array['action_tags']) || in_array("@NOW", $rr_array['action_tags'])) {
						$onkeydown = "";
						// If has read-only tag, then remove Update button
						if ($hasReadonlyActionTag) {
							$nowBtn = "<span class='df'>$dformat</span>";
						}
					}
				}				
				// ACTION TAG Customizations
				if (in_array("@TODAY", $rr_array['action_tags']) || in_array("@NOW", $rr_array['action_tags'])) {
					$disabled = "readonly";
				} elseif (in_array("@PASSWORDMASK", $rr_array['action_tags'])) {
					$rr_type = "password";
					$style = "style='max-width:70%;'";
					//$note .= "<div class='note'>".$lang['data_entry_262']."</div>";
					$nowBtn .= "&nbsp;&nbsp;<a ignore='Yes' class='smalllink' style='color:#800000;font-family:Tahoma;' href='javascript:;' onclick=\"simpleDialog('".cleanHtml($isSurveyPage ? $lang['data_entry_262'] : $lang['data_entry_263'])."','".cleanHtml($lang['form_renderer_22'])."');\">{$lang['form_renderer_22']}</a>";
				} elseif (in_array("@LATITUDE", $rr_array['action_tags'])) {
					$style = "style='max-width:130px;'";
					$nowBtn = "&nbsp;&nbsp;<button ignore='Yes' class='jqbuttonsm' onclick=\"getGeolocation('latitude','$name','form',true);dataEntryFormValuesChanged=true;return false;\">{$lang['global_125']}</button>";
					$nowBtn .= "&nbsp;&nbsp;<a ignore='Yes' class='smalllink' href='javascript:;' onclick=\"$('[name=$name]').val('');dataEntryFormValuesChanged=true;try{calculate();doBranching();}catch(e){} return false;\">{$lang['form_renderer_20']}</a>";
				} elseif (in_array("@LONGITUDE", $rr_array['action_tags'])) {
					$style = "style='max-width:130px;'";
					$nowBtn = "&nbsp;&nbsp;<button ignore='Yes' class='jqbuttonsm' onclick=\"getGeolocation('longitude','$name','form',true);dataEntryFormValuesChanged=true;return false;\">{$lang['global_125']}</button>";
					$nowBtn .= "&nbsp;&nbsp;<a ignore='Yes' class='smalllink' href='javascript:;' onclick=\"$('[name=$name]').val('');dataEntryFormValuesChanged=true;try{calculate();doBranching();}catch(e){} return false;\">{$lang['form_renderer_20']}</a>";
				}
				if (in_array('@HIDEBUTTON', $rr_array['action_tags'])) {
					$nowBtn = "<span class='df'>$dformat</span>";
				}
				// Add extra note for longitudinal projects employing the secondary identifier field
				$extra_note = (isset($secondary_pk_note) && $name == $secondary_pk) ? $secondary_pk_note : "";
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				// Ontology search
				$autosuggest = "";
				if (isset($rr_array['element_enum']) && $rr_array['element_enum'] != '' && strpos($rr_array['element_enum'], ":") !== false) {
					// Get the name of the name of the web service API and the category (ontology) name
					list ($autosuggest_service, $autosuggest_cat) = explode(":", $rr_array['element_enum'], 2);
					// Set field as read-only
					$disabled = "readonly";
					// Set class
					$newclass = "autosug-ont-field";
					$style = "";
					// Set elements for ontology search
					print  "<input id='$name-autosuggest-span' class='x-form-text x-form-field autosug-span' type='text' readonly value='".str_replace("'","&#039;",Form::getWebServiceCacheValues(PROJECT_ID, $autosuggest_service, $autosuggest_cat, $value))."'>
							<input id='$name-autosuggest' class='x-form-text x-form-field autosug-search' type='text'>
							<span class='nowrap'>
								<span id='$name-autosuggest-instr' class='autosug-instr'>{$lang['data_entry_260']}</span>
								<img id='$name-autosuggest-progress' class='autosug-progress' src='".APP_PATH_IMAGES."progress_circle.gif'>
							</span>";
				}
				// Text input
				print  "	<input autocomplete='off' class='x-form-text x-form-field $newclass' $id type='$rr_type' name='$name' value='".str_replace("'","&#039;",$value)."'
							$disabled $id $style $onchange $onclick $onblur $onfocus $tabindex $onkeydown $onkeyup $fv_attr $inputPattern $placeholderText>
							$nowBtn $extra_note $note";
				print  "</td>";
				break;
			//Calculated Field
			case 'calc':
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				print  "	<input type='text' name='$name' value='" . (isset($value) ? $value : '') . "' $id $onfocus $tabindex readonly='readonly'
								 class='x-form-text x-form-field rci-calc' onfocus=\"doFocusNext('$name','$formJsName');\">&nbsp;&nbsp;<a href='javascript:;' ignore='Yes' class='viewEq'
							onclick=\"viewEq('$name');\">{$lang['form_renderer_21']}</a>
							$note
						</td>";
				break;
			//Slider / Visual Analog Scale
			case 'slider':
				// Show or hide slider display value? (if 'number', then show it)
				$sliderValDispVis = ($rr_array['slider_labels'][3] == "number") ? "visible" : "hidden";
				// Alter slider text for mobile devices and iPads
				$sliderDispText = ($isMobileDevice || $isIpad) ? $lang['design_182'] : $lang['design_183'];
				// For mobile devices, only show sliders as left-aligned
				if ($isMobileDevice) $custom_alignment = 'LV';
				// Validate that the slider's value (if existing) is numeric. If not, set to blank.
				if (isset($value) && !is_numeric($value)) $value = '';
				// Render slider row
				switch ($custom_alignment) {
					case '':
					case 'RV':
						$alignment_class = 'right-vertical';
						$sliderNoPadStyle = "sldrnopad";
						break;
					case 'RH':
						$alignment_class = 'right-horizontal';
						$sliderNoPadStyle = "";
						break;
					case 'LH':
						$alignment_class = 'left-horizontal';
						$sliderNoPadStyle = "";
						break;
					case 'LV':
						$alignment_class = 'left-vertical';
						$sliderNoPadStyle = "sldrnopad";
						break;
				}
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label<div class='space'></div>";
				}
				$sliderStyle = ($custom_alignment == 'LV') ? "sldrmsgl" : "sldrmsg";
				print  "	<table class='sldrparent' style='position:relative;'>
								<tr>
									<td colspan='3' style='padding:3px 3px 0 5px;'>
										<table class='sliderlabels $alignment_class'>
											<tr style='font-size:11px;font-weight:normal;'>
												<td class='sldrlaba ".($rr_array['slider_labels'][0] == "" ? "sliderlabels-e" : "sliderlabels-ne")."'>{$rr_array['slider_labels'][0]}</td>
												<td class='sldrlabb $sliderNoPadStyle ".($rr_array['slider_labels'][1] == "" ? "sliderlabels-e" : "sliderlabels-ne")."'>{$rr_array['slider_labels'][1]}</td>
												<td class='sldrlabc ".($rr_array['slider_labels'][2] == "" ? "sliderlabels-e" : "sliderlabels-ne")."'>{$rr_array['slider_labels'][2]}</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class='sldrtd'>
										<div id='slider-$name' class='slider' data-align='$alignment_class' onmousedown=\"enableSldr('$name')\"></div>
									</td>
									<td valign='bottom' class='sldrnumtd $alignment_class'>
										<input type='text' name='$name' value='" . (isset($value) ? $value : '') . "' $id $onfocus $tabindex readonly='readonly'
											style='visibility: $sliderValDispVis;' class='sldrnum'>
									</td>
								</tr>
								<tr>
									<td id='sldrmsg-$name' class='$sliderStyle' colspan='3'>
										$sliderDispText
									</td>
								</tr>
							</table>";
				//Set to already posted values
				if (isset($value) && $value != "" && is_numeric($value)) {
					print "<script type='text/javascript'>\$(function(){setSlider('$name','$value');});</script>";
				}
				print  "	<div style='text-align:right;'><a href='javascript:;' class='smalllink' style='display:$reset_radio;'
							onclick=\"resetSlider('$name');return false;\">{$lang['form_renderer_20']}</a></div>
							$note
						</td>";
				break;
			//Buttons
			case 'button':
			case 'submit':
				$btnclass = (isset($rr_array['btnclass'])) ? "class='{$rr_array['btnclass']}'" : "";
				print  "<td class='labelrc $colClassLeft'>$label</td>
						<td class='data $colClassRight'><span $class><input type='$rr_type' name='$name'
							value='$value' $id $disabled $onchange $onclick $onblur $onfocus $tabindex $btnclass></span></td>";
				break;
			//E-doc file uploading
			case 'file':
				// Render row
				if ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'RH') {
					print  "<td class='labelrc $colClassLeft'>$label</td><td class='data $colClassRight'>";
					$file_align = "right";
				} else {
					print  "<td class='labelrc $colClassCombined' colspan='2'>$label";
					$file_align = "left";
				}
				if ($edoc_field_option_enabled) {
					// Boolean if field is a 'signature' file upload type
					$signature_field = (isset($rr_array['validation']) && $rr_array['validation'] == 'signature') ? '1' : '0';
					// Hidden input containing real value
					print "<input type='hidden' name='$name' value='" . (isset($value) && $value != '' ? (int)$value : '') . "'>";
					//If edoc upload capability is turned on
					if (!isset($value) || $value == '') {
						//If no document has been uploaded, give link to upload new document
						$this_file_link = '';
						$this_file_link_display = 'none';
						if ((!isset($user_rights) || (isset($user_rights) && ($user_rights['forms'][$_GET['page']] == '1' || $user_rights['forms'][$_GET['page']] == '3'))) && !$disable_all) {
							$this_file_link_value = ($signature_field) ? $lang['form_renderer_31'] : $lang['form_renderer_23'];
							$this_file_link_img = '<img src="'.APP_PATH_IMAGES.'add.png">';
						} else {
							$this_file_link_value = '';
							$this_file_link_img = '';
						}
						$this_file_link_new = $this_file_link_img.' <a href="javascript:;" '.$tabindex.'
							onclick="filePopUp(\''.$name.'\',\''.$field_label_page.'\','.$signature_field.');return false;" class="fileuploadlink">'.$this_file_link_value.'</a>';
						$q_fileup = array();
					} else {
						$value = (int)$value;
						//If document has been uploaded, give link to download and link to delete
						$this_file_link = $file_download_page.'&doc_id_hash='.Files::docIdHash($value).'&id='.$value.'&s='.(isset($_GET['s']) ? $_GET['s'] : '')."&page={$_GET['page']}&record={$_GET['id']}".(($double_data_entry && isset($user_rights) && $user_rights['double_data'] != 0) ? "--".$user_rights['double_data'] : "")."&event_id={$_GET['event_id']}&field_name=$name&instance={$_GET['instance']}";
						$this_file_link_display = 'block';
						$senditText = '';
						if ((!isset($user_rights) || (isset($user_rights) && ($user_rights['forms'][$_GET['page']] == '1' || $user_rights['forms'][$_GET['page']] == '3'))) && !$disable_all 
							&& !$hasReadonlyActionTag)
						{
							$this_file_link_value = $lang['form_renderer_24'];
							$this_file_link_img = '<img src="'.APP_PATH_IMAGES.'bullet_delete.png"> ';
							if ($sendit_enabled == 1 || $sendit_enabled == 3) {
								$senditText = "<span class=\"sendit-lnk\"><span style=\"font-size:10px;padding:0 10px;\">or</span><img src=\"".APP_PATH_IMAGES."mail_small.png\"
									/><a onclick=\"popupSendIt($value,3);return false;\" href=\"javascript:;\"
									style=\"font-size:10px;\">{$lang['form_renderer_25']}</a></span>&nbsp;</span>";
							}
						} else {
							$this_file_link_value = '';
							$this_file_link_img = '';
						}
						$this_file_link_new = '<span class="edoc-link">'.$this_file_link_img.'<a href="javascript:;" style="font-size:10px;color:red;"
							onclick=\'deleteDocumentConfirm('.$value.',"'.$name.'","'.$_GET['id'].'",'.$_GET['event_id'].','.$_GET['instance'].',"'.$file_delete_page.'&__response_hash__="+$("#form :input[name=__response_hash__]").val());return false;\'>'.$this_file_link_value.'</a>'.$senditText.'</span>';
						// Query edocs table for file attributes
						$q_fileup_query = db_query("select doc_name, doc_size from redcap_edocs_metadata where doc_id = $value limit 1");
						$q_fileup = db_fetch_array($q_fileup_query);
						$q_fileup['doc_size'] = round_up($q_fileup['doc_size'] / 1024 / 1024);
						if (strlen($q_fileup['doc_name']) > 34) $q_fileup['doc_name'] = substr($q_fileup['doc_name'],0,32)."...";
					}
					// If a signature field that has a signature saved, display as inline image
					$link_margin = "margin:0 10px;";
					if ($signature_field) {
						if (isset($value) && $value != '') {
							$signature_img_src = $image_view_page.'&doc_id_hash='.Files::docIdHash($value).'&id='.$value.'&s='.(isset($_GET['s']) ? $_GET['s'] : '')."&page={$_GET['page']}&record={$_GET['id']}".(($double_data_entry && isset($user_rights) && $user_rights['double_data'] != 0) ? "--".$user_rights['double_data'] : "")."&event_id={$_GET['event_id']}&field_name=$name&instance={$_GET['instance']}&signature=1";
							$signature_img = "<img src='$signature_img_src' alt='[SIGNATURE]'>";
							$signature_img_display = "block";
						} else {
							$signature_img = "";
							$signature_img_display = "none";
						}
						$link_margin = "margin:0 20px;";
						print "<div id='$name-sigimg' class='sig-img' style='text-align:$file_align;display:$signature_img_display;'>$signature_img</div>";
					}
					// Display "upload document" link OR download file link
					print '<a target="_blank" name="'.$name.'" '.$tabindex.' href=\''.$this_file_link.'\' onclick="return appendRespHash(\''.$name.'\');" id="'.$name.'-link"
						   style="text-align:'.$file_align.';font-weight:normal;display:'.$this_file_link_display.';text-decoration:underline;'.$link_margin.'position:relative;">' . (isset($q_fileup['doc_name']) ? $q_fileup['doc_name'] : '') . ' (' . (isset($q_fileup['doc_size']) ? $q_fileup['doc_size'] : '') . ' MB)</a>
						   <div style="font-weight:normal;margin:10px 5px 0 0;position:relative;text-align:'.$file_align.';" id="'.$name.'-linknew">'.$this_file_link_new.'</div>';
				} else {
					//File upload capabilities are turned off
					print '<span style="color:#808080;">'.$lang['form_renderer_26'].'</span>';
				}
				print "<div class='space'></div>$note</td>";
				break;
		}
		print $bookend2;
		print $end_row;
	}
	print $bookend3;
	// Print copyright info for instrument, if available
	if (((PAGE == "DataEntry/index.php") && isset($_GET['id'])) || PAGE == "Design/online_designer.php"
		|| ($isSurveyPage && isset($_GET['__page__']) && $_GET['__page__'] == '1'))
	{
		$ack = getAcknowledgement($project_id, $_GET['page']);
		if ($ack != "") {
			print "<tr $trclass NoDrag='1' NoDrop='1'><td class='header' style='font-size:12px;font-weight:normal;border:1px solid #CCCCCC;' colspan='".($isSurveyPage ? '3' : '2')."'>".nl2br($ack)."</td></tr>";
		}
	}
	print "</tbody></table>";
	print "</div>";
	if (!(PAGE == 'Design/online_designer_render_fields.php' && isset($_GET['edit_question'])))
	{
		print "</form>";
	}
	// If data entry form is disabled for a record
	if ($disable_all && (PAGE == "DataEntry/index.php") && isset($_GET['id']))
	{
		?>
		<script type='text/javascript'>
		$(function(){
			// Disable all Sliders on the page
			$('.slider').each(function(){
				$(this).prop('onmousedown','');
				try { $(this).slider('disable'); }catch(e){ }
			});
			// Hide button box at top right of page
			$('#formSaveTip').hide();
		});
		</script>
		<?php
	}
}
//Function to render drop-down fields
function render_dropdown($select_choices, $element_value="", $blankDDlabel="")
{
	// Set drop-down label text for record drop-downs
	global $surveys_enabled;
	// If DROPDOWN_DISABLE_BLANK constant is not defined, then given drop-downs a blank value as first option
	if (!defined('DROPDOWN_DISABLE_BLANK')) {
		print "<option value=''>$blankDDlabel</option>";
	}
	$select_choices = trim($select_choices);
	if ($select_choices != "")
	{
		$select_array = explode("\n",$select_choices);
		foreach ($select_array as $key=>$value) {
			if (strpos($value,",")) {
				$pos = strpos($value, ",");
				$this_value = trim(substr($value,0,$pos));
				$this_text = strip_tags(label_decode(trim(substr($value,$pos+1))));
				print "<option value='$this_value' ";
				if ($this_value."" === $element_value."") print "selected";
				print ">$this_text</option>";
			} else {
				$value = trim($value);
				print "<option value='$value' ";
				if ($value."" === $element_value."") print "selected";
				print ">$value</option>";
			}
		}
	}
}
//Function to render radio fields
function render_radio($select_choices,$element_value,$name,$attr,$custom_alignment='',$matrix_col_width=null,$disabled=false,$enhanced_choices=false,$readonly=false)
{
	// Set parameters
	$isMatrixField = is_numeric($matrix_col_width);
	$vertical_align = ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'LV');
	$select_choices = trim($select_choices);
	$onclick = $disabled ? '' : 'sr(this,event)';
	$enhanced_choices_html = '';
	$standard_choices_display = ($enhanced_choices) ? ' hide' : '';
	if ($select_choices != "")
	{
		// Add HTML for enhanced choices
		if ($enhanced_choices) $enhanced_choices_html .= "<div class='enhancedchoice_wrapper'>";
		// Loop through each choice
		foreach (explode("\n",$select_choices) as $key=>$value)
		{
			// Begin output for this choice
			if ($isMatrixField) {
				print "<td class='data choicematrix' style='width:{$matrix_col_width}%;'>";
			} elseif ($vertical_align) {
				print "<div class='choicevert{$standard_choices_display}' onclick='$onclick'>";
			} else {
				print "<span class='choicehoriz{$standard_choices_display}' onclick='$onclick'>";
			}
			if (strpos($value, ",")) {
				$pos = strpos($value,",");
				$this_value = trim(substr($value,0,$pos));
				$this_text = decode_filter_tags(trim(substr($value,$pos+1)));
				$currentChoiceSelected = ($this_value."" === $element_value."");
				if ($isMatrixField) {
					$mtx_id = "mtxopt-".$name."_".$this_value;
					print "<input type='radio' id='$mtx_id' name='".$name."___radio' $attr value='$this_value' ";
				} else {
					print "<input type='radio' name='".$name."___radio' $attr value='$this_value' ";
					// Enhanced choices
					if ($enhanced_choices) {
						if ($this_text == "") $this_text = "&nbsp;";
						$enhanced_choices_class = $currentChoiceSelected ? 'selectedradio' : '';
						$enhanced_choices_class2 = $readonly ? '' : 'hover';
						$enhanced_choices_onclick = $readonly ? "" : "onclick='enhanceChoiceSelect(this)'";
						$enhanced_choices_html .= "<div class='enhancedchoice col-xs-12 col-sm-6'>"
							. "<label $enhanced_choices_onclick for='$name,value,$this_value' class='$enhanced_choices_class2 $enhanced_choices_class'><span class='ec'>$this_text</span></label></div>";
					}
				}
				if ($isMatrixField) print "label='".cleanHtml(strip_tags(label_decode($this_text)))."' ";
				if ($currentChoiceSelected) print "checked";
				print ">";
				if (!$isMatrixField) print " $this_text";
			} else {
				$this_value = trim($value);
				$currentChoiceSelected = ($this_value."" === $element_value."");
				print "<input type='radio' name='".$name."___radio' $attr value='$this_value' ";
				if ($isMatrixField) print "label='".cleanHtml(strip_tags(label_decode($this_value)))."' ";
				if ($currentChoiceSelected) print "checked";
				print ">";
				if (!$isMatrixField) {
					print " $this_value";
					// Enhanced choices
					if ($enhanced_choices) {
						if ($this_text == "") $this_text = "&nbsp;";
						$enhanced_choices_class = $currentChoiceSelected ? 'selectedradio' : '';
						$enhanced_choices_class2 = $readonly ? '' : 'hover';
						$enhanced_choices_onclick = $readonly ? "" : "onclick='enhanceChoiceSelect(this)'";
						$enhanced_choices_html .= "<div class='enhancedchoice col-xs-12 col-sm-6'>"
							. "<label $enhanced_choices_onclick for='$name,value,$this_value' class='$enhanced_choices_class2 $enhanced_choices_class'><span class='ec'>$this_text</span></label></div>";
					}
				}
			}
			// Finalize output for this choice
			if ($isMatrixField) {
				print "</td>";
			} elseif ($vertical_align) {
				print "</div>";
			} else {
				print "</span>";
			}
		}
		// Output the enhanced choices HTML
		if ($enhanced_choices) print $enhanced_choices_html . "</div>";
	}
}
//Function to render radio fields
function render_checkboxes($select_choices,$element_value,$name,$attr,$custom_alignment='',$matrix_col_width=null,$tabindex,$disabled=false,$enhanced_choices=false,$readonly=false)
{
	// Convert tabindex string to its tabindex number
	$tabindex = preg_replace("/[^0-9]/", "", $tabindex);
	// Set parameters
	$isMatrixField = is_numeric($matrix_col_width);
	$vertical_align = ($custom_alignment == '' || $custom_alignment == 'RV' || $custom_alignment == 'LV');
	$select_choices = trim($select_choices);
	$onclick = $disabled ? '' : 'sr(this,event)';
	$enhanced_choices_html = '';
	$standard_choices_display = ($enhanced_choices) ? ' hide' : '';
	if ($select_choices != "")
	{
		// Add HTML for enhanced choices
		if ($enhanced_choices) $enhanced_choices_html .= "<div class='enhancedchoice_wrapper'>";
		// Loop through each choice
		foreach (explode("\n",$select_choices) as $key=>$value)
		{
			// Begin output for this choice
			if ($isMatrixField) {
				print "<td class='data choicematrix' style='width:{$matrix_col_width}%;'>";
			} elseif ($vertical_align) {
				print "<div class='choicevert{$standard_choices_display}' onclick='$onclick'>";
			} else {
				print "<span class='choicehoriz{$standard_choices_display}' onclick='$onclick'>";
			}
			if (strpos($value,",")) {
				$pos = strpos($value,",");
				$this_value = trim(substr($value,0,$pos));
				$this_text = decode_filter_tags(trim(substr($value,$pos+1)));
			} else {
				$this_text = $this_value = trim($value);
			}
			// Note: IE 6-9 does not trigger onchange when clicking checkboxes, so adding calculate();doBranching(); here for onclick for IE only.
			print "<input type='checkbox' tabindex='".$tabindex++."' $attr name='__chkn__{$name}' code='{$this_value}' onclick=\"
					document.forms['form'].elements['__chk__{$name}_RC_{$this_value}'].value=$(this).prop('checked')?'$this_value':'';calculate();doBranching();\" ";
			if (gettype($element_value) == 'array' && in_array($this_value, $element_value, true)) {
				print 'checked>';
				$default_value = $this_value;
				$currentChoiceSelected = true;
			} else {
				print '>';
				$default_value = ''; //Default value is 'null' if no present value exists
				$currentChoiceSelected = false;
			}
			print '<input type="hidden" value="'.$default_value.'" name="__chk__'.$name.'_RC_'.$this_value.'">';
			if (!$isMatrixField) {
				print " $this_text";				
				// Enhanced choices
				if ($enhanced_choices) {
					if ($this_text == "") $this_text = "&nbsp;";
					$enhanced_choices_class = $currentChoiceSelected ? 'selectedchkbox' : 'unselectedchkbox';
					$enhanced_choices_class2 = $readonly ? '' : 'hover';
					$enhanced_choices_onclick = $readonly ? "" : "onclick='enhanceChoiceSelect(this)'";
					$enhanced_choices_html .= "<div class='enhancedchoice col-xs-12 col-sm-6'>"
						. "<label $enhanced_choices_onclick for='$name,code,$this_value' class='$enhanced_choices_class2 $enhanced_choices_class'><span class='ec'>$this_text</span></label></div>";
				}
			}
			// Finalize output for this choice
			if ($isMatrixField) {
				print "</td>";
			} elseif ($vertical_align) {
				print "</div>";
			} else {
				print "</span>";
			}
		}
		// Output the enhanced choices HTML
		if ($enhanced_choices) print $enhanced_choices_html . "</div>";
	}
}
// Function for saving submitted data to the data table
function saveRecord($fetched, $saveCalculations=true)
{
	global $double_data_entry, $user_rights, $table_pk, $require_change_reason, $context_msg_update, $multiple_arms,
		   $context_msg_error_existing, $context_msg_insert, $secondary_pk, $longitudinal, $Proj, $data_resolution_enabled,
		   $realtime_webservice_global_enabled, $randomization;
	// Set project values if not set (depends on context)
	if ($table_pk == null) $table_pk = $Proj->table_pk;
	if ($longitudinal == null) $longitudinal = $Proj->longitudinal;
	if ($multiple_arms == null) $multiple_arms = $Proj->multiple_arms;
	if ($double_data_entry == null) $double_data_entry = $Proj->project['double_data_entry'];
	if ($require_change_reason == null) $require_change_reason = $Proj->project['require_change_reason'];
	if ($secondary_pk == null) $secondary_pk = $Proj->project['secondary_pk'];
	if ($data_resolution_enabled == null) $data_resolution_enabled = $Proj->project['data_resolution_enabled'];
	$realtime_webservice_enabled = ($realtime_webservice_global_enabled && $Proj->project['realtime_webservice_enabled']);
	// Get array of repeating forms/events
	$RepeatingFormsEvents = $Proj->getRepeatingFormsEvents();
	$hasRepeatingFormsEvents = !empty($RepeatingFormsEvents);
	// Ignore special fields that only occur for surveys
	$postIgnore = array('__page__', '__response_hash__', '__response_id__');
	// Just in case this wasn't removed earlier, remove CSRF token from Post to prevent it from being added to logging
	unset($_POST['redcap_csrf_token']);
	// If deleting the form or event, then create a special flag
	$deletingFormOrEvent = false;
	if (isset($_POST['submit-action']) && ($_POST['submit-action'] == "submit-btn-deleteform" || $_POST['submit-action'] == "submit-btn-deleteevent")) {
		// Reset this Post value
		$_POST['submit-action'] = "submit-btn-saverecord";
		// Set flag
		$deletingFormOrEvent = true;
	}
	// If repeating the survey, then create a special flag
	$repeatThisSurvey = false;
	if (isset($_POST['submit-action']) && $_POST['submit-action'] == "submit-btn-saverepeat") {
		// Reset this Post value
		$_POST['submit-action'] = "submit-btn-saverecord";
		// Set flag
		$repeatThisSurvey = true;
	}
	// Just in case the Primary Key field is missing (how?), make sure it's in Post anyway.
	$_POST[$table_pk] = $fetched = trim($fetched);
	// Decode and trim new record name (in case has quotes or spaces), if renaming record.
	if (isset($_POST['__old_id__'])) {
		$_POST['__old_id__'] = trim(html_entity_decode($_POST['__old_id__'], ENT_QUOTES));
	}
	// If user is a double data entry person, append --# to record id when saving
	if ($double_data_entry && isset($user_rights) && $user_rights['double_data'] != 0) {
		$fetched .= "--" . $user_rights['double_data'];
		$_POST[$table_pk] .= "--" . $user_rights['double_data'];
		if (isset($_POST['__old_id__'])) $_POST['__old_id__'] .= "--" . $user_rights['double_data'];
	}
	// Does record exist?
	$recordExists = Records::recordExists($fetched, (($longitudinal && $multiple_arms && isset($Proj->eventInfo[$_GET['event_id']]['arm_num'])) ? $Proj->eventInfo[$_GET['event_id']]['arm_num'] : null));
	// First, determine what notification message to show AND if record id was changed (if option is enabled)
	if (isset($_POST['hidden_edit_flag']) && $_POST['hidden_edit_flag'] == 1) {
		//Updating existing record
		$context_msg = $context_msg_update;
		//Check if record id changed. If yes, alter listing in data table to reflect the change.
		if (isset($_POST['__old_id__'])) {
			// If record name was changed...
			if ($_POST['__old_id__'] !== $fetched) {
				// Check if new record name exists already (can't change to record that already exists)
				if ($recordExists)
				{
					// New record already exists, so can't change record id
					$context_msg = $context_msg_error_existing;
					// Reset id number back to original value so data can be saved
					$fetched = $_POST[$table_pk] = $_POST['__old_id__'];
					// Set extra __rename_failed__ flag to denote that the record rename failed because the record already exists
					$_POST['__rename_failed__'] = true;
				} else {
					// New record does not exist, so change record id
					changeRecordId($_POST['__old_id__'], $fetched);
				}
			}
		}
	} else {
		// Creating new record (or changed record id)
		$context_msg = $context_msg_insert;
	}
	// Prevent altering of randomization field value. Determine if this record has already been randomized.
	// If on data entry form, then remove randomization field's value from POST array.
	if ($randomization && PAGE == 'DataEntry/index.php' && Randomization::setupStatus() && Randomization::wasRecordRandomized($fetched)) {
		// Get randomization attributes
		$randAttr = Randomization::getRandomizationAttributes();
		$randomizationField = $randAttr['targetField'];
		// Remove randomization field from POST array
		if (isset($_POST[$randomizationField])) {
			unset($_POST[$randomizationField]);
		}
	}
	// Check if event_id exists in URL. If not, then this is not "longitudinal" and has one event, so retrieve event_id.
	if (!isset($_GET['event_id']) || $_GET['event_id'] == "") {
		$_GET['event_id'] = $Proj->firstEventId;
	}
	if (!$deletingFormOrEvent)
	{		
		// If Form Status is blank, set to Incomplete
		if (!$deletingFormOrEvent && $saveCalculations && isset($_GET['page']) && (!isset($_POST[$_GET['page']."_complete"]) || (isset($_POST[$_GET['page']."_complete"]) && empty($_POST[$_GET['page']."_complete"]))))
		{
			$_POST[$_GET['page']."_complete"] = '0';
		}
		// Build sql for data retrieval for checking if new data or if overwriting old data
		$datasql = "select field_name, value from redcap_data where record = '" . prep($fetched) . "'
					and event_id = {$_GET['event_id']} and project_id = " . PROJECT_ID .
					($hasRepeatingFormsEvents ? " and instance ".($_GET['instance'] == '1' ? "is NULL" : "= ".$_GET['instance']) : "") .  
					" and field_name in (";
		foreach ($_POST as $key=>$value)
		{
			// Ignore special Post fields
			if (in_array($key, $postIgnore)) continue;
			// Ignore the "name" from the "checkbox" field's checkboxes (although do NOT ignore the "checkbox" hidden fields beginning with "__chk__")
			if (substr($key, 0, 8) == '__chkn__')
			{
				// Remove the field from Post
				unset($_POST[$key]);
			}
			// Reformat any checkboxes
			elseif (substr($key, 0, 7) == '__chk__')
			{
				// Parse out the field name and the checkbox coded value
				list ($key, $chkval) = explode('_RC_', substr($key, 7), 2);
				$datasql .= "'$key', ";
			}
			// Non-checkbox fields
			else
			{
				$datasql .= "'$key', ";
			}
			// Also, check if field is a Text field with MDY or DMY date validation.
			// If so, convert to YMD format before saving.
			if ($_POST[$key] != '' && isset($Proj->metadata[$key]) && $Proj->metadata[$key]['element_type'] == 'text'
				&& (substr($Proj->metadata[$key]['element_validation_type'], -4) == "_dmy" || substr($Proj->metadata[$key]['element_validation_type'], -4) == "_mdy"))
			{
				$thisValType = $Proj->metadata[$key]['element_validation_type'];
				if ($thisValType == 'date_mdy') {
					$_POST[$key] = DateTimeRC::date_mdy2ymd($_POST[$key]);
				} elseif ($thisValType == 'date_dmy') {
					$_POST[$key] = DateTimeRC::date_dmy2ymd($_POST[$key]);
				} elseif ($thisValType == 'datetime_mdy' || $thisValType == 'datetime_seconds_mdy') {
					list ($this_date, $this_time) = explode(" ", $_POST[$key]);
					$_POST[$key] = DateTimeRC::date_mdy2ymd($this_date) . " " . $this_time;
				} elseif ($thisValType == 'datetime_dmy' || $thisValType == 'datetime_seconds_dmy') {
					list ($this_date, $this_time) = explode(" ", $_POST[$key]);
					$_POST[$key] = DateTimeRC::date_dmy2ymd($this_date) . " " . $this_time;
				}
			}
		}
		$datasql = substr($datasql,0,-2).")";
		//Execute query and put any existing data into an array to display on form
		$q = db_query($datasql);
		while ($row_data = db_fetch_array($q))
		{
			//Checkbox: Add data as array
			if ($Proj->isCheckbox($row_data['field_name'])) {
				$current_data[$row_data['field_name']][$row_data['value']] = $row_data['value'];
			//Non-checkbox fields: Add data as string
			} else {
				$current_data[$row_data['field_name']] = $row_data['value'];
			}
		}
		// print "<br><br>SQL: $datasql<br>Current data: ";print_array($current_data);print_array($_POST);
		// Data Resolution Workflow: If enabled, create array to capture record/event/fields that
		// had their data value changed just now so they can be De-verified, if already Verified.
		$autoDeverify = array();
		// Keep track of all fields where a value changed, added, or deleted
		$field_values_changed = array();
		// Loop through all posted values. Update if exists. Insert if not exist.
		foreach ($_POST as $field_name=>$value)
		{
			// Ignore special Post fields
			if (in_array($field_name, $postIgnore)) continue;
			// Do not save fields that failed server-side validation
			if (isset($serverSideValErrors[$field_name])) continue;
			// Flag for if field is a checkbox
			$is_checkbox = false;
			// Handle the Lock Record field by simply ignoring it
			if ($field_name == '__LOCKRECORD__') continue;
			// Reformat the fieldnames of any checkboxes
			if (substr($field_name, 0, 7) == '__chk__') {
				// Parse out the field name and the checkbox coded value
				list ($field_name, $chkval) = explode('_RC_', substr($field_name, 7), 2);
				// Set flag
				$is_checkbox = true;
			}
			// Because all GET/POST elements get HTML-escaped, we need to HTML-unescape them here
			$value = html_entity_decode($value, ENT_QUOTES);
			// Ignore certain fields that are not real metadata fields
			if (strpos($field_name, "-") === false && $field_name != 'hidden_edit_flag' && $field_name != '__old_id__' && !(substr($field_name,0,10) == '_checkbox_' && $value == 'on'))
			{
				// If on a form or survey, only save fields on this form (don't save hidden fields due to cross-form branching/calcs)
				if ($saveCalculations && isset($_GET['page']) && $field_name != $Proj->table_pk && $field_name != "__GROUPID__"
					&& $field_name != '__LOCKRECORD__' && !isset($Proj->forms[$_GET['page']]['fields'][$field_name])) {
					continue;
				}
				## OPTION 1: If data exists for this field (and it's not a checkbox), update the value
				if (isset($current_data[$field_name]) && !$is_checkbox) {
					if ($value !== $current_data[$field_name]) {
						//If current data is different from submitted data, then update
						if ($value != '') {
							$sql_all[] = $sql = "UPDATE redcap_data SET value = '" . prep($value) . "' WHERE project_id = " . PROJECT_ID
											  . " AND record = '" . prep($fetched) . "' AND event_id = {$_GET['event_id']} AND field_name = '$field_name'"
											  . ($hasRepeatingFormsEvents ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "");
						} else {
							$sql_all[] = $sql = "DELETE FROM redcap_data WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($fetched) . "'"
											  . " AND event_id = {$_GET['event_id']} AND field_name = '$field_name'"
											  . ($hasRepeatingFormsEvents ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "");
						}
						db_query($sql);
						// Add field to values changed array
						$field_values_changed[] = $field_name;
						// Add to De-verify array
						$autoDeverify[$fetched][$_GET['event_id']][$field_name] = true;
						//Gather new values for logging display
						if ($field_name != "__GROUPID__" && $field_name != '__LOCKRECORD__') {
							$display[] = "$field_name = '$value'";
						}
						// If we're changing the DAG association of the record, make sure we update any calendar events for this record with the new DAG
						elseif ($field_name == "__GROUPID__") {
							// Set flag to log DAG designation
							$dag_sql_all = array($sql);
							// Update calendar table (just in case)
							$sql_all[] = $dag_sql_all[] = $sql = "UPDATE redcap_events_calendar SET group_id = " . checkNull($value) . " WHERE project_id = " . PROJECT_ID
											  . " AND record = '" . prep($fetched) . "'";
							db_query($sql);
							// Also, make sure that ALL EVENTS get assigned the new group_id value
							if ($value == '') {
								$dag_log_descrip = "Remove record from Data Access Group";
								$sql_all[] = $dag_sql_all[] = $sql = "DELETE FROM redcap_data WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($fetched) . "'"
												  . " AND field_name = '$field_name'";
							} else {
								$dag_log_descrip = "Assign record to Data Access Group";
								$sql_all[] = $dag_sql_all[] = $sql = "UPDATE redcap_data SET value = '" . prep($value) . "' WHERE project_id = " . PROJECT_ID
												  . " AND record = '" . prep($fetched) . "' AND field_name = '$field_name'";
							}
							db_query($sql);
						}
					}
				## OPTION 2: If field is a checkbox and it was just unchecked, remove the data point completely
		} elseif (isset($chkval) && isset($current_data[$field_name][$chkval]) && $is_checkbox && $value == "") {
					// If a checkbox field and was just unchecked, then remove from table completely
					$sql_all[] = $sql = "DELETE FROM redcap_data WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($fetched) . "'"
									  . " AND event_id = {$_GET['event_id']} AND field_name = '$field_name'"
									  . " AND value = '" . prep($chkval) . "'"
									  . ($hasRepeatingFormsEvents ? " AND instance ".($_GET['instance'] == '1' ? "is NULL" : "= '".prep($_GET['instance'])."'") : "")
									  . " LIMIT 1";
					db_query($sql);
					// Add field to values changed array
					$field_values_changed[] = $field_name;
					// Add to De-verify array
					$autoDeverify[$fetched][$_GET['event_id']][$field_name] = true;
					//Gather new values for logging display
					if ($field_name != "__GROUPID__" && $field_name != '__LOCKRECORD__') {
						$display[] = $is_checkbox ? ("$field_name($chkval) = " . (($value == "") ? "unchecked" : "checked")) : "$field_name = '$value'";
					}
				## OPTION 3: If there is no data for this field (checkbox or non-checkbox)
				} elseif ((isset($chkval) && !isset($current_data[$field_name][$chkval]) && $is_checkbox) || (!isset($current_data[$field_name]) && !$is_checkbox)) {
					if ($value != '' && strpos($field_name, '___') === false) { //Do not insert if blank or if the excess Radio field element (which has ___)
						//Insert values
						$sql_all[] = $sql = "INSERT INTO redcap_data (project_id, event_id, record, field_name, value, instance) "
										  . "VALUES (" . PROJECT_ID . ", {$_GET['event_id']}, '" . prep($fetched) . "', "
										  . "'$field_name', '" . prep($value) . "', " 
										  . ($_GET['instance'] == '1' ? "NULL" : "'".prep($_GET['instance'])."'") . ")";
						db_query($sql);
						// Add field to values changed array
						$field_values_changed[] = $field_name;
						// Add to De-verify array
						$autoDeverify[$fetched][$_GET['event_id']][$field_name] = true;
						//Gather new values for logging display
						if ($field_name != "__GROUPID__" && $field_name != '__LOCKRECORD__') {
							$display[] = $is_checkbox ? ("$field_name($chkval) = " . (($value == "") ? "unchecked" : "checked")) : "$field_name = '$value'";
						}
						// If we're setting the DAG association of the record, make sure we update any calendar events for this record with the new DAG
						elseif ($field_name == "__GROUPID__") {
							// Set flag to log DAG designation
							$dag_sql_all = array($sql);
							$dag_log_descrip = "Assign record to Data Access Group";
							// Update calendar table (just in case)
							$sql_all[] = $dag_sql_all[] = $sql = "UPDATE redcap_events_calendar SET group_id = " . checkNull($value) . " WHERE project_id = " . PROJECT_ID
											  . " AND record = '" . prep($fetched) . "'";
							db_query($sql);
						}
					}
				}
			}
		}
		## SECONDARY UNIQUE IDENTIFIER IS CHANGED (LONGITUDINAL)
		// If changing 2ndary id in a longitudinal project, then set that value for ALL instances of the field
		// in other Events (keep them synced for consistency).
		if ($longitudinal && $secondary_pk != '' && isset($_POST[$secondary_pk]) && $_POST[$secondary_pk] !== $current_data[$secondary_pk])
		{
			// Form name of secondary id
			$secondary_pk_form = $Proj->metadata[$secondary_pk]['form_name'];
			// Determine if this is the data entry page of a project
			if ((PAGE == "DataEntry/index.php") && isset($_GET['page']) && isset($_GET['event_id'])
				// Only do this if the secondary_pk field belongs on this form (rather than is as a hidden field on another form),
				// in which it may be blank. This could happen when using secondary_pk in cross-event calc fields.
				&& $_GET['page'] == $secondary_pk_form)
			{
				// Store events where secondary id's form is used
				$secondary_pk_form_events = array();
				// If longitudinal with multiple arms, determine on which arms the record exists.
				if ($longitudinal && $multiple_arms) {
					// Get current arm
					$current_arm = getArm();
					// Get all arms on which the record exists
					$this_record_arms = array();
					$sql = "select distinct a.arm_num from redcap_data d, redcap_events_metadata e, redcap_events_arms a
							where a.project_id = " . PROJECT_ID . " and a.project_id = d.project_id and a.arm_id = e.arm_id
							and e.event_id = d.event_id and d.record = '" . prep($fetched) . "'";
					$q = db_query($sql);
					while ($row = db_fetch_assoc($q)) {
						$this_record_arms[] = $row['arm_num'];
					}
				}
				// Get all events that use the form
				foreach ($Proj->eventsForms as $this_event_id=>$these_forms) {
					if (in_array($secondary_pk_form, $these_forms)) {
						// If longitudinal with multiple arms, determine on which arms the record exists.
						if ($longitudinal && $multiple_arms) {
							// If record does not exist on current arm, then skip
							$this_event_arm = $Proj->eventInfo[$this_event_id]['arm_num'];
							if (!in_array($this_event_arm, $this_record_arms)) {
								continue;
							}
						}
						// Collect all events where the form is used
						$secondary_pk_form_events[] = $this_event_id;
					}
				}
				// First delete all instances of the value on ALL events
				$sql_all[] = $sql = "DELETE FROM redcap_data WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($fetched) . "' "
								  . "AND event_id in (" . implode(", ", array_keys($Proj->eventInfo)) . ") AND field_name = '$secondary_pk'";
				db_query($sql);
				// Now loop through all events where 2ndary id is used and insert
				foreach ($secondary_pk_form_events as $this_event_id)
				{
					$sql_all[] = $sql = "INSERT INTO redcap_data (project_id, event_id, record, field_name, value) "
									  . "VALUES (" . PROJECT_ID . ", $this_event_id, '" . prep($fetched) . "', "
									  . "'$secondary_pk', '" . prep($_POST[$secondary_pk]) . "')";
					db_query($sql);
				}
			}
		}
		## Logging
		// Determine if updating or creating a record
		if ($recordExists) {
			$event  = "update";
			$log_descrip = (PAGE == "surveys/index.php") ? "Update survey response" : "Update record";
		} else {
			$event  = "insert";
			$log_descrip = (PAGE == "surveys/index.php") ? "Create survey response" : "Create record";
		}
		// Append note if we're doing automatic calculations
		$log_descrip .= (!$saveCalculations) ? " (Auto calculation)" : "";
		// Add logging info for Part 11 compliance, if enabled
		$change_reason = ($require_change_reason && isset($_POST['change-reason'])) ? $_POST['change-reason'] : "";
		// Log the data change
		$log_event_id = Logging::logEvent(implode(";\n",isset($sql_all) ? $sql_all : array()), "redcap_data", $event, $fetched, implode(",\n", isset($display) ? $display : array()), $log_descrip, $change_reason, "", "", true, null, $_GET['instance']);
		// Log DAG designation (if occurred)
		if (isset($dag_sql_all) && !empty($dag_sql_all))
		{
			$group_name = ($_POST['__GROUPID__'] == '') ? '' : $Proj->getUniqueGroupNames($_POST['__GROUPID__']);
			Logging::logEvent(implode(";\n",$dag_sql_all), "redcap_data", "update", $fetched, "redcap_data_access_group = '$group_name'", $dag_log_descrip, "", "", "", true, null, $_GET['instance']);
		}
	}
	## DATA RESOLUTION WORKFLOW: If enabled, deverify any record/event/fields that
	// are Verified but had their data value changed just now.
	if ($data_resolution_enabled == '2' && !empty($autoDeverify))
	{
		$num_deverified = DataQuality::dataResolutionAutoDeverify($autoDeverify);
	}
	## DO CALCULATIONS (unless disabled for project)
	if ($saveCalculations && !$Proj->project['disable_autocalcs']) {
		// Was this a form/survey submission?
		// If so, remove any calc fields that were just submitted on a form (don't need to calculate since JavaScript already calculated them)
		if (isset($_GET['page']) && isset($Proj->forms[$_GET['page']])) {
			// Get trigger fields based ONLY on fields that were just modified
			$calcFields = Calculate::getCalcFieldsByTriggerField(array_unique($field_values_changed));
			// Remove any calc fields just submitted (unless this form is utilized on another event - longitudinal only)
			if (!$Proj->longitudinal || ($Proj->longitudinal && $Proj->numEventsFormDesignated($_GET['page'], array($_GET['event_id'])) < 1)) {
				foreach (array_keys($Proj->forms[$_GET['page']]['fields']) as $this_field) {
					if (isset($_POST[$this_field]) && $Proj->metadata[$this_field]['element_type'] == 'calc') {
						// This is a calc field on the current form AND its value was just submitted, so skip it
						$this_key = array_search($this_field, $calcFields);
						if ($this_key !== false) {
							unset($calcFields[$this_key]);
						}
					}
				}
			}
		} else {
			// Not a form submission (e.g. Data Quality rule, data import)
			$calcFields = Calculate::getCalcFieldsByTriggerField(array_keys($_POST));
		}
		// If there are some calc fields to calculate, then do so
		if (!empty($calcFields)) {
			$calcValuesUpdated = Calculate::saveCalcFields(array($fetched), $calcFields, $_GET['event_id']);
		}
	}
	## SURVEY INVITATION SCHEDULE LISTENER
	// If the form is designated as a survey, check if a survey schedule has been defined for this event.
	// If so, perform check to see if this record/participant is NOT a completed response and needs to be scheduled for the mailer.
	if (!empty($Proj->surveys))
	{
		// Check if we're ready to schedule the participant's survey invitation to be sent
		$surveyScheduler = new SurveyScheduler();
		// Return count of invitation scheduled, if any
		$numInvitationsScheduled = $surveyScheduler->checkToScheduleParticipantInvitation($fetched);
		// If this was a survey response that was just completed AND it already has an invitation queued,
		// then flag it in scheduler_queue table (if already in there).
		if (PAGE == 'surveys/index.php' || $_POST['submit-action'] == "submit-btn-savecompresp") {
			// Return boolean for if invitation status was changed to SURVEY ALREADY COMPLETED
			$invitationUnscheduled = SurveyScheduler::deleteInviteIfCompletedSurvey($Proj->forms[$_GET['page']]['survey_id'], $_GET['event_id'], $fetched, $_GET['instance']);
		}
	}
	
	## DDP: If using DDP and the source identifier field's value just changed, then purge that record's cached data
	## so it can be reobtained from the source system.
	if ($realtime_webservice_enabled) {
		// Make sure DDP has been mapped in this project
		$DDP = new DynamicDataPull(PROJECT_ID);
		if ($DDP->isMappingSetUp()) {
			// Get the DDP identifier field
			list ($ddp_id_field, $ddp_id_event) = $DDP->getMappedIdRedcapFieldEvent();
			if ($ddp_id_event == $_GET['event_id'] && in_array($ddp_id_field, $field_values_changed)) {
				$DDP->purgeDataCache($fetched);
			}
		}
	}
	
	## DATA ENTRY TRIGGER
	// If the Data Entry Trigger is enabled, then send HTTP Post request to specified URL
	launchDataEntryTrigger();
	
	## REPEAT THE SURVEY
	if ($repeatThisSurvey) 
	{
		// Get count of existing instances and find next instance number
		list ($instanceTotal, $instanceMax) = RepeatInstance::getRepeatFormInstanceMaxCount($fetched, $_GET['event_id'], $_GET['page']);
		$instanceNext = max(array($instanceMax, $_GET['instance'])) + 1;
		// Get the next instance's survey url
		$repeatSurveyLink = REDCap::getSurveyLink($fetched, $_GET['page'], $_GET['event_id'], $instanceNext);
		redirect($repeatSurveyLink);
	}
	
	// Return the current record name (in case was renamed) and context message for user display
	return array($fetched, $context_msg, $log_event_id);
}
//Function for changing a record id (if option is enabled)
function changeRecordId($old_id, $new_id)
{
	global $Proj, $table_pk, $multiple_arms, $status;
	// If multiple arms exist, get list of all event_ids from current arm, so we can tack this on to each query (so don't rename records from other arms)
	$eventList = "";
	$arm_id = getArmId();
	if ($multiple_arms && isset($_GET['event_id'])) {
		// Only rename this record for THIS ARM
		$eventPreQuery = pre_query("select event_id from redcap_events_metadata where arm_id = $arm_id");
		$eventList = " AND event_id IN ($eventPreQuery)";
		$eventList2 = " AND rss.event_id IN ($eventPreQuery)";
	}
	//Change record id value first for the id field
	$sql_all[] = $sql = "UPDATE redcap_data SET value = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' AND field_name = '$table_pk' $eventList";
	db_query($sql);
	//Change record id for all fields
	$sql_all[] = $sql = "UPDATE redcap_data SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change logging history to reflect new id number
	$sql_all[] = $sql = "UPDATE redcap_log_event SET pk = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND pk = '" . prep($old_id) . "' AND legacy = '0' $eventList";
	db_query($sql);
	//Change record id in calendar
	$sql_all[] = $sql = "UPDATE redcap_events_calendar SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change record id in locking_data table
	$sql_all[] = $sql = "UPDATE redcap_locking_data SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change record id in e-signatures table
	$sql_all[] = $sql = "UPDATE redcap_esignatures SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change record id in data quality table
	$sql_all[] = $sql = "UPDATE redcap_data_quality_status SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change record id in survey response values table (archive of completed survey responses)
	$sql_all[] = $sql = "UPDATE redcap_surveys_response_values SET record = '" . prep($new_id) . "' WHERE project_id = " . PROJECT_ID
					  . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Change record id in survey response table
	$participant_ids = pre_query("select p.participant_id from redcap_surveys_participants p, redcap_surveys_response r, redcap_surveys s
								 where s.project_id = " . PROJECT_ID . " and s.survey_id = p.survey_id and p.participant_id = r.participant_id
								 and p.event_id in (".pre_query("select event_id from redcap_events_metadata where arm_id = $arm_id").")
								 and r.record = '" . prep($old_id) . "'");
	$sql_all[] = $sql = "UPDATE redcap_surveys_response SET record = '" . prep($new_id) . "' WHERE record = '" . prep($old_id) . "'"
					  . " AND participant_id in ($participant_ids)";
	db_query($sql);
	// Change record id in randomization allocation table (if applicable)
	$sql_all[] = $sql = "UPDATE redcap_randomization_allocation a, redcap_randomization r
						 SET a.is_used_by = '" . prep($new_id) . "'
						 WHERE r.project_id = " . PROJECT_ID . " and a.project_status = $status
						 and r.rid = a.rid and a.is_used_by = '".prep($old_id)."'";
	db_query($sql);
	// Change record id in redcap_ddp_records
	$sql_all[] = $sql = "UPDATE redcap_ddp_records SET record = '" . prep($new_id) . "'
						 WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($old_id) . "'";
	db_query($sql);
	// Change record id in redcap_surveys_queue_hashes
	$sql_all[] = $sql = "UPDATE redcap_surveys_queue_hashes SET record = '" . prep($new_id) . "'
						 WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($old_id) . "'";
	db_query($sql);
	// Change record id in redcap_surveys_scheduler_queue
	$sql_all[] = $sql = "UPDATE redcap_surveys_scheduler rss, redcap_events_metadata rem, redcap_events_arms rea, redcap_surveys_scheduler_queue ssq
						SET ssq.record = '" . prep($new_id) . "' WHERE rss.event_id = rem.event_id and rem.arm_id = rea.arm_id $eventList2
						and rea.project_id = " . PROJECT_ID . " and ssq.ss_id = rss.ss_id and ssq.record = '" . prep($old_id) . "'";
	db_query($sql);
	// Change record id in redcap_surveys_login
	$sql_all[] = $sql = "UPDATE redcap_surveys_login SET record = '" . prep($new_id) . "'
						 WHERE record = '" . prep($old_id) . "' AND event_id in (".implode(', ', array_keys($Proj->eventInfo)).")";
	db_query($sql);
	// Change record id in redcap_new_record_cache
	$sql_all[] = $sql = "UPDATE redcap_new_record_cache SET record = '" . prep($new_id) . "'
						 WHERE project_id = " . PROJECT_ID . " AND record = '" . prep($old_id) . "' $eventList";
	db_query($sql);
	//Logging
	Logging::logEvent(implode(";\n",$sql_all),"redcap_data","update",$new_id,"$table_pk = '$new_id'","Update record");
}

//Function for deleting a record (if option is enabled) - if multiple arms exist, will only delete record for current arm
function deleteRecord($fetched)
{
	global $table_pk, $multiple_arms, $randomization, $status, $require_change_reason;
	$arm_id = getArmId();
    Records::deleteRecord($fetched, $table_pk, $multiple_arms, $randomization, $status, $require_change_reason, $arm_id);
}

// Retrieve data values for Context Detail, if has been set
function parse_context_msg($custom_record_label,$context_msg,$removeIdentifiers=false)
{
	global $secondary_pk, $Proj, $user_rights, $double_data_entry;
	// Append secondary ID field value, if set for a "survey+forms" type project
	if ($secondary_pk != '')
	{
		// Is 2ndary PK an identifier?
		$secondary_pk_val = ($removeIdentifiers && $Proj->metadata[$secondary_pk]['field_phi'] && $user_rights['data_export_tool'] == '2') ? "[IDENTIFIER]" : $Proj->getSecondaryIdVal($_GET['id']);
		// Add field value and its label to context message
		if ($secondary_pk_val != '') {
			$context_msg = substr($context_msg, 0, -6)
						 . "<span style='font-size:11px;color:#800000;padding-left:8px;'>("
						 . $Proj->metadata[$secondary_pk]['element_label']
						 . " <b>$secondary_pk_val</b>)</span></div>";
		}
	}
	// If Custom Record Label is specified (such as "[last_name], [first_name]", then parse and display)
	if (!empty($custom_record_label))
	{
		// Add to context message
		$context_msg = substr($context_msg, 0, -6) . " <span style='font-size:11px;padding-left:8px;'>"
					 . getCustomRecordLabels($custom_record_label, $Proj->getFirstEventIdArm(getArm()),
							$_GET['id'] . ($double_data_entry && $user_rights['double_data'] != 0 ? '--'.$user_rights['double_data'] : ''),
							$removeIdentifiers)
					 . "</span></div>";
	}
	// Return value
	return $context_msg;
}
//Function for rendering Context Detail at top of data entry page, if specified in Control Center
function render_context_msg($custom_record_label,$context_msg)
{
	global $Proj, $longitudinal, $multiple_arms, $lang, $hidden_edit, $user_firstname, $user_lastname, $user_email;
	// Retrieve data values for Context Detail, if has been set
	$context_msg = parse_context_msg($custom_record_label, $context_msg);
	//If multiple events exist, display this Event name
	if ($longitudinal)
	{
		// Get all repeating events
		$repeatingFormsEvents = $Proj->getRepeatingFormsEvents();
		// Add instance number if a repeating instance		
		$is_repeating_event = (isset($repeatingFormsEvents[$_GET['event_id']]) && !is_array($repeatingFormsEvents[$_GET['event_id']]));
		$instanceNum = ($is_repeating_event && $_GET['instance'] > 1) ? "<span style='margin-left:4px;'>({$lang['data_entry_278']}{$_GET['instance']})</span>" : "";
		//Render the event name, if longitudinal
		$event_name = $Proj->eventInfo[$_GET['event_id']]['name_ext'];
		$context_msg .= "<div class='yellow'>
						 <img src='".APP_PATH_IMAGES."spacer.gif' style='width:16px;height:1px;'>
						 {$lang['global_10']}{$lang['colon']} 
						 <span style='font-weight:bold;color:#800000;'>".RCView::escape(strip_tags($event_name))."</span>
						 $instanceNum
						 </div>";
	}
	return "<div id='contextMsg'>$context_msg</div>";
}
// Input a multi-line value for Select Choices values and return a formated enum string (auto-code when any values do not have manual coding)
function autoCodeEnum($enum) {
	// Set default max coded value (to use for any non-manual codings)
	$maxcode = 0;
	// Create array to use to auto-coding when no manual coding is supplied by user
	$auto_coded_labels = array();
	// Create temp array for cleaning $enum_array array
	$enum_array2 = array();
	// Check if manually coded. If not, do auto coding.
	$enum_array = explode("\n", $enum);
	// Loop through coded variables, remove any non-numerical codings, and add codings for those not coded by user
	foreach ($enum_array as $choice)
	{
		$choice = trim($choice);
		if ($choice != "") {
			// If coded manually, clean and do checking of format
			$pos = strpos($choice, ",");
			if ($pos !== false) {
				$coded_value = trim(substr($choice, 0, $pos));
				$label = trim(substr($choice, $pos + 1));
				if ($coded_value != "") {
					// If coded value is not numeric AND doesn't pass RegEx for acceptable raw value format, then don't process here but add to array for later auto-coding
					if (!preg_match("/[0-9A-Za-z_]/", $coded_value)) {
						$auto_coded_labels[] = $choice;
					// Add to array after parsing
					} else {
						$enum_array2[$coded_value] = $label;
						// Set this as max coded value, if it is the highest number value thus far
						if (is_numeric($coded_value) && $coded_value > $maxcode) {
							$maxcode = $coded_value;
						}
					}
				}
			// If not coded manually, add to array for later auto-coding
			} else {
				$auto_coded_labels[] = $choice;
			}
		}
	}
	// Loop through non-manually coded values and add to temp array
	foreach ($auto_coded_labels as $label) {
		$maxcode++;
		$enum_array2[$maxcode] = $label;
	}
	// Set variable back again with new values
	$enum_array = array();
	foreach ($enum_array2 as $coded_value=>$label) {
		$enum_array[] = "$coded_value, $label";
	}
	// Return the new value
	return implode(" \\n ", $enum_array);
}
// On Data Entry Form, get next form that the user has access to
function getNextForm($current_form, $event_id)
{
	global $Proj, $user_rights;
	if (!is_numeric($event_id)) return '';
	$current_form_key = array_search($current_form, $Proj->eventsForms[$event_id]);
	if ($current_form_key === false) return '';
	foreach ($Proj->eventsForms[$event_id] as $key=>$this_form) {
		// Get the next form that the user has access to
		if ($key > $current_form_key && isset($user_rights['forms'][$this_form]) && $user_rights['forms'][$this_form] > 0) {
			return $this_form;
		}
	}
	return '';
}
/**
 * GENERATE NEW AUTO ID FOR A DATA ENTRY PAGE
 * NOTE: For longitudinal projects, it does NOT get next ID for the selected arm BUT returns next ID
 * considering all arms together (prevents duplication of records across arms).
 */
function getAutoId()
{
	global $user_rights, $table_pk;
	// User is in a DAG, so only pull records from this DAG
	if (isset($user_rights['group_id']) && $user_rights['group_id'] != "")
	{
		$sql = "select distinct(substring(a.record,".(strlen($user_rights['group_id'])+2).")) as record
				from redcap_data a left join redcap_data b
				on a.project_id = b.project_id and a.record = b.record and b.field_name = '__GROUPID__'
				where a.record like '{$user_rights['group_id']}-%' and a.field_name = '$table_pk'
				and a.project_id = " . PROJECT_ID;
		$recs = db_query($sql);
	}
	// User is not in a DAG
	else {
		$sql = "select distinct record from redcap_data where project_id = " . PROJECT_ID . " and field_name = '$table_pk'";
		$recs = db_query($sql);
	}
	//Use query from above and find the largest record id and add 1
	$holder = 0;
	while ($row = db_fetch_assoc($recs))
	{
		if (is_numeric($row['record']) && is_int($row['record'] + 0) && $row['record'] > $holder)
		{
			$holder = $row['record'];
		}
	}
	db_free_result($recs);
	// Increment the highest value by 1 to get the new value
	$holder++;
	//If user is in a DAG append DAGid+dash to beginning of record
	if (isset($user_rights['group_id']) && $user_rights['group_id'] != "")
	{
		$holder = $user_rights['group_id'] . "-" . $holder;
	}
	// Return new auto id value
	return $holder;
}
// Return arrays of calc fields on a form and fields involved in calc equation
function getCalcFields($form)
{
	global $Proj, $longitudinal;
	$calc_fields_this_form = array();
	$calc_triggers = array();
	// Pull any calc fields from other forms that are dependent upon fields on this form (need to add as hidden fields here)
	$subquery_array = array();
	foreach (array_keys($Proj->forms[$form]['fields']) as $this_field)
	{
		$subquery_array[] = "element_enum like '%[$this_field]%'";
	}
	if (!empty($subquery_array)) {
		$subquery = "or field_name in ("
				  . pre_query("select field_name from redcap_metadata where element_type = 'calc' and form_name != '$form'
							   and project_id = " . PROJECT_ID . " and (" . implode(" or ", $subquery_array) . ")")
				  . ")";
	} else {
		$subquery = "";
	}
	// If field is not on this form, then add it as a hidden field at bottom near Save buttons
	$sql = "select field_name, element_enum, form_name from redcap_metadata where element_type = 'calc' and element_enum != ''
			and (form_name = '$form' $subquery) and project_id = " . PROJECT_ID . " order by field_order";
	$q = db_query($sql);
	while ($rowcalc = db_fetch_assoc($q))
	{
		//Add this Calc field to Calculate Object for rendering the JavaScript
		if ($rowcalc['form_name'] == $form) {
			$calc_triggers[$rowcalc['field_name']] = $rowcalc['element_enum'];
		}
		//Add all fields in the equation to array
		foreach (array_keys(getBracketedFields($rowcalc['element_enum'], true, true)) as $this_field)
		{
			$calc_fields_this_form[] = $this_field;
		}
		// If field is on other form, then add to $calc_fields_this_form so that it gets added as hidden field
		if ($rowcalc['form_name'] != $form)
		{
			$calc_fields_this_form[] = $rowcalc['field_name'];
		}
	}
	array_unique($calc_fields_this_form);
	// If using unique event name in equation and we're currently on that event, replace the event name in the JS
	if ($longitudinal)
	{
		foreach ($calc_fields_this_form as $this_key=>$this_field)
		{
			if (strpos($this_field, ".") !== false)
			{
				list ($this_event, $this_field) = explode(".", $this_field, 2);
				$this_event_id = array_search($this_event, $Proj->getUniqueEventNames());
				if ($this_event_id == $_GET['event_id'])
				{
					$calc_fields_this_form[$this_key] = $this_field;
				}
			}
		}
	}
	array_unique($calc_fields_this_form);
	// Return the two arrays
	return array($calc_triggers, $calc_fields_this_form);
}
// Return arrays of fields with branching logic on a form and fields involved in the logic
function getBranchingFields($form)
{
	global $longitudinal, $Proj;
	$bl_fields_this_form = array();
	$bl_triggers = array();
	// If field is not on this form, then add it as a hidden field at bottom near Save buttons
	$q = db_query("select field_name, branching_logic from redcap_metadata where form_name = '$form'
				   and branching_logic is not null and project_id = " . PROJECT_ID . " order by field_order");
	while ($row = db_fetch_array($q))
	{
		//Add this Calc field to Calculate Object for rendering the JavaScript
		$bl_triggers[$row['field_name']] = $row['branching_logic'];
		//Add all fields in the equation to array
		foreach (array_keys(getBracketedFields($row['branching_logic'], true, true)) as $this_field)
		{
			$bl_fields_this_form[] = $this_field;
		}
	}
	array_unique($bl_fields_this_form);
	// If using unique event name in equation and we're currently on that event, replace the event name in the JS
	if ($longitudinal)
	{
		foreach ($bl_fields_this_form as $this_key=>$this_field)
		{
			if (strpos($this_field, ".") !== false)
			{
				list ($this_event, $this_field) = explode(".", $this_field, 2);
				$this_event_id = array_search($this_event, $Proj->getUniqueEventNames());
				if ($this_event_id == $_GET['event_id'])
				{
					$bl_fields_this_form[$this_key] = $this_field;
				}
			}
		}
	}
	array_unique($bl_fields_this_form);
	// Return the two arrays
	return array($bl_triggers, $bl_fields_this_form);
}
// Gather and structure metadata for a given form, and return output as array to place in form_renderer() function
function buildFormData($form_name, $skipFields=array())
{
	global $Proj, $lang, $user_rights, $table_pk, $cp, $bl, $longitudinal, $auto_inc_set;
	## Calculated Fields: Get all field names involved in calculations
	// Get list of calc trigger fields and fields involved in calcultions
	list ($calc_triggers, $calc_fields_this_form) = getCalcFields($form_name);
	// Add each Calc field to Calculate Object for rendering the JavaScript
	foreach ($calc_triggers as $this_field=>$this_enum)
	{
		// If field is in $skipFields, then skip it
		if (in_array($this_field, $skipFields)) continue;
		// Add field
		$cp->feedEquation($this_field, $this_enum);
	}
	## Branching Logic: Get all field names involved in branching equation
	// If field is not on this form, then add it as a hidden field at bottom near Save buttons
	list ($bl_triggers, $branch_fields_this_form) = getBranchingFields($form_name);
	// Add each Branching field to BranchingLogic Object for rendering the JavaScript
	foreach ($bl_triggers as $this_field=>$this_enum)
	{
		// If field is in $skipFields, then skip it
		if (in_array($this_field, $skipFields)) continue;
		// Add field
		$bl->feedBranchingEquation($this_field, $this_enum);
	}
	// Obtain the unique event name for this event (longitudinal only)
	$this_unique_event = null;
	if ($longitudinal) {
		$unique_event_names = $Proj->getUniqueEventNames();
		$this_unique_event  =  $unique_event_names[$_GET['event_id']];
	}
	// Obtain the list of DAGs and set flags if DAGs exist
	$dags = $Proj->getGroups();
	$removeRecordIdValidation = (!empty($dags) && $auto_inc_set && $user_rights['record_rename']);
	// ACTION TAGS: Create regex string to detect all action tags being used in the Field Annotation
	$action_tags_regex = Form::getActionTagMatchRegex();
	// Set array to catch checkbox fieldnames
	$chkbox_flds = array();
	// Initialize the counter
	$j = 0;
	// Initialize string
	$string_data1 = "";
	// Set initial grid name for Matrix question formatting groups
	$prev_grid_name = "";
	//print_array($skipFields);
	// Loop through all fields for this form
	foreach (array_keys($Proj->forms[$form_name]['fields']) as $field_name)
	{
		// If field is in $skipFields, then skip it
		if (in_array($field_name, $skipFields)) continue;
		// Increment counter
		$j++;
		//Replace any single or double quotes since they cause rendering problems
		$orig_quote = array("'", "\"");
		$repl_quote = array("&#039;", "&quot;");
		$element_label = str_replace($orig_quote, $repl_quote, $Proj->metadata[$field_name]['element_label']);
		$element_preceding_header = $Proj->metadata[$field_name]['element_preceding_header'];
		$element_type = $Proj->metadata[$field_name]['element_type'];
		$element_enum = str_replace($orig_quote, $repl_quote, $Proj->metadata[$field_name]['element_enum']);
		$element_note = $Proj->metadata[$field_name]['element_note'];
		$element_validation_type = $Proj->metadata[$field_name]['element_validation_type'];
		$element_validation_min = $Proj->metadata[$field_name]['element_validation_min'];
		$element_validation_max = $Proj->metadata[$field_name]['element_validation_max'];
		$element_validation_checktype = $Proj->metadata[$field_name]['element_validation_checktype'];
		$field_req = $Proj->metadata[$field_name]['field_req'];
		$edoc_id = $Proj->metadata[$field_name]['edoc_id'];
		$edoc_display_img = $Proj->metadata[$field_name]['edoc_display_img'];
		$custom_alignment = $Proj->metadata[$field_name]['custom_alignment'];
		$grid_name = trim($Proj->metadata[$field_name]['grid_name']);
		$grid_rank = $Proj->metadata[$field_name]['grid_rank'];
		$video_url = trim($Proj->metadata[$field_name]['video_url']);
		$video_display_inline = trim($Proj->metadata[$field_name]['video_display_inline']);
		// First check to see if this is the record id.
		// If so, use use rights to determine if it should be rendered as an editable entity
		if ($field_name == $table_pk && isset($user_rights) && !$user_rights['record_rename']) {
			continue;
		}
		
		// Make sure the record ID field is not editable (because users should rename it on the Record Home page, not here on the form)
		if ($field_name == $table_pk) $element_type = 'hidden';
		
		## SECTION HEADER: If this data field specifies a 'header' separator - process this first
		if ($element_preceding_header)
		{
			if (strpos($element_preceding_header,"'") !== false) $element_preceding_header = str_replace("'","&#39;",$element_preceding_header); //Apostrophes cause issues when rendered, so replace with equivalent html character
			$element_preceding_header = nl2br($element_preceding_header);
			$string_data1 .= " \$elements1[]=array('rr_type'=>'header', 'shfield'=>'$field_name', 'css_element_class'=>'header','value'=>'$element_preceding_header');\n";
		}
		## MATRIX QUESTION GROUPS
		$isMatrixField = false; //default
		// Beginning a new grid
		if ($grid_name != "" && $prev_grid_name != $grid_name)
		{
			// Insert matrix header row
			$string_data1 .= " \$elements1[]=array('rr_type'=>'matrix_header', 'grid_name'=>'$grid_name', 'grid_rank'=>'$grid_rank', "
						   . "'field'=>'$field_name', 'enum'=>'" . cleanLabel($element_enum) . "');\n"."";
			// Set flag that this is a matrix field
			$isMatrixField = true;
			// Set that field is the first field in matrix group
			$matrixGroupPosition = '1';
		}
		// Continuing an existing grid
		elseif ($grid_name != "" && $prev_grid_name == $grid_name)
		{
			// Set flag that this is a matrix field
			$isMatrixField = true;
			// Set that field is *not* the first field in matrix group
			$matrixGroupPosition = 'X';
		}
		// Set value for next loop
		$prev_grid_name = $grid_name;
		// Process the data element itself
		$string_data1 .= " \$elements1[]=array('field'=>'$field_name', 'name'=>'$field_name', 'rr_type'=>";
		$string_data1 .= ($element_type == 'sql') ? "'select'" : "'$element_type'";
		// IF a matrix field, then set flag in this element
		if ($isMatrixField) {
			$string_data1 .= ", 'matrix_field'=>'$matrixGroupPosition', 'grid_name'=>'$grid_name'";
		}
		//Process required field status (add note underneath field label)
		if ($field_req == '1')
		{
			$fieldReqClass = ($isMatrixField) ? 'requiredlabelmatrix' : 'requiredlabel'; // make matrix fields more compact
			$element_label .= "<div class='$fieldReqClass'>* {$lang['data_entry_39']}</div>";
			// Add 'required field' flag
			$string_data1 .= ", 'field_req'=>'1'";
		}
		// Process field label
		$string_data1 .= ", 'label'=>' " . nl2br(cleanLabel($element_label)) . "'";
		// Custom alignment
		$string_data1 .= ", 'custom_alignment'=>'$custom_alignment'";
		// If field_annotation has @, then assume it might be an action tag
		if (strpos($Proj->metadata[$field_name]['misc'], '@') !== false) {
			// Match triggers via regex
			preg_match_all($action_tags_regex, $Proj->metadata[$field_name]['misc'], $this_misc_match);
			if (isset($this_misc_match[1]) && !empty($this_misc_match[1])) {
				$string_data1 .= ", 'action_tag_class'=>'".implode(" ", $this_misc_match[1])."'";
			}
		}
		// Tabbing order for fields
		$string_data1 .= ", 'tabindex'=>'$j'";
		// If a checkbox, then increment $j for all checkbox options so that each gets a different tabindex
		if ($element_type == 'checkbox') {
			$this_chk_enum = $Proj->metadata[$field_name]['element_enum'];
			if ($this_chk_enum != '') {
				$j = $j - 1 + count(parseEnum($this_chk_enum));
			}
		}
		// Add slider labels & and display value option
		if ($element_type == 'slider')
		{
			$slider_labels = Form::parseSliderLabels($element_enum);
			$string_data1 .= ", 'slider_labels'=>array('" . cleanHtml(emoticon_replace(decode_filter_tags($slider_labels['left']))) . "',
								'" . cleanHtml(emoticon_replace(decode_filter_tags($slider_labels['middle']))) . "',
								'" . cleanHtml(emoticon_replace(decode_filter_tags($slider_labels['right']))) . "',
								'" . cleanHtml(cleanLabel($element_validation_type)) . "')";
		}
		//For elements of type 'text', we'll handle data validation if details are provided in metadata
		if ($element_type == 'text' || $element_type == 'calc')
		{
			// Check if using validation
			if (!empty($element_validation_type)
				// If auto-numbering is enabled AND user is in a DAG AND has record rename rights,
				// then remove the record ID field's validation to prevent issues when the first form loads for an existing record.
				// (It would get the user stuck on the page forever unless they closed the tab/window.)
				&& !($field_name == $table_pk && $removeRecordIdValidation))
			{
				// Catch specific regex validation types
				if ($element_validation_type == "date" || $element_validation_type == "datetime" || $element_validation_type == "datetime_seconds") {
					// Add "_ymd" to end of legacy date validation names so that they correspond with values from validation table
					$element_validation_type .= "_ymd";
				// Catch legacy values
				} elseif ($element_validation_type == "int") {
					$element_validation_type = "integer";
				} elseif ($element_validation_type == "float") {
					$element_validation_type = "number";
				}
				// Set javascript validation function
				$hold_validation_string  = "redcap_validate(this,'$element_validation_min','$element_validation_max',";
				$hold_validation_string .= (!empty($element_validation_checktype) ? "'$element_validation_checktype'" : "'soft_typed'");
				$hold_validation_string .= ",'$element_validation_type',1)";
				$string_data1 .= ", 'validation'=>'$element_validation_type', 'onblur'=>\"$hold_validation_string\"";
			}
			// ONTOLOGY AUTO-SUGGEST
			elseif ($element_type == 'text' && $element_enum != '' && strpos($element_enum, ":") !== false) {
				$string_data1 .= ", 'element_enum'=>'$element_enum'";
			}
		}
		// Add $element_validation_type for FILE fields (for signatures only) and SELECT fields (for auto-complete)
		if (($element_type == 'file' || $element_type == 'select' || $element_type == 'sql') && $element_validation_type != '') {
			$string_data1 .= ", 'validation'=>'" . cleanHtml($element_validation_type) . "'";
		}
		// Add edoc_id, if a Descriptive field has an attachement or video url
		if ($element_type == 'descriptive') {
			if (is_numeric($edoc_id)) {
				$string_data1 .= ", 'edoc_id'=>$edoc_id, 'edoc_display_img'=>$edoc_display_img";
			} elseif ($video_url != '') {
				$string_data1 .= ", 'video_url'=>'$video_url', 'video_display_inline'=>'$video_display_inline'";
			}
		}
		// Using either Calculated Fields OR Branching Logic OR both
		$useBranch = (in_array($field_name, $branch_fields_this_form) || ($longitudinal && in_array("$this_unique_event.$field_name", $branch_fields_this_form)));
		$useCalc   = (in_array($field_name, $calc_fields_this_form)   || ($longitudinal && in_array("$this_unique_event.$field_name", $calc_fields_this_form)));
		if ($useCalc || $useBranch)
		{
			// Set string to run calculate() function: ALWAYS perform branching after calculation to catch any changes from calculation
			$calcFuncString = ($useCalc ? "calculate();" : "");
			// Calc & Branching: Radios and checkboxes need to use onclick to work in some browsers
			if ($element_type == 'radio' || $element_type == 'yesno' || $element_type == 'truefalse') {
				## MC fields (excluding checkboxes)
				// if radio button is part of a ranking matrix field, add js to rank, while still allowing to branch and calculate
				$js = (!$grid_rank) ? "" :	"matrix_rank(this.value,'$field_name','" . implode(",", $Proj->matrixGroupNames[$grid_name]) . "');";
				// Use different javascript for Randomization widget popup
				$js .= (PAGE == 'Randomization/randomize_record.php') ? "document.forms['random_form'].$field_name.value=this.value;" : "document.forms['form'].$field_name.value=this.value;setTimeout(function(){{$calcFuncString}doBranching();},50);";
				$string_data1 .= ", 'onclick'=>\"$js\"";
			} else {
				## All non-MC fields (including checkboxes)
				// Use different javascript for Randomization widget popup
				$js = (PAGE == 'Randomization/randomize_record.php') ? "" : "setTimeout(function(){{$calcFuncString}doBranching();},50);";
				$string_data1 .= ", 'onchange'=>\"$js\"";
			}
		}
		// Add onclick to all radios to change hidden input's value
		elseif ($element_type == 'radio' || $element_type == 'yesno' || $element_type == 'truefalse') {
			// if radio button is part of a ranking matrix field, add js to rank, while still allowing to branch and calculate
			$js = (!$grid_rank) ? "" :	"matrix_rank(this.value,'$field_name','" . implode(",", $Proj->matrixGroupNames[$grid_name]) . "');";
			// Use different javascript for Randomization widget popup
			$js .= (PAGE == 'Randomization/randomize_record.php') ? "document.forms['random_form'].$field_name.value=this.value;" : "document.forms['form'].$field_name.value=this.value;";
			$string_data1 .= ", 'onclick'=>\"$js\"";
		}
		//For elements of type 'select', we need to include the $element_enum information
		if ($element_type == 'truefalse' || $element_type == 'yesno' || $element_type == 'select' || $element_type == 'radio' || $element_type == 'checkbox' || $element_type == 'sql')
		{
			//Add any checkbox fields to array to use during data pull later to fill form with existing data
			if ($element_type == 'checkbox') {
				$chkbox_flds[$field_name] = "";
			}
			//Do normal select/radio options
			if ($element_type != 'sql') {
				$string_data1 .= ", 'enum'=>'" . cleanLabel($element_enum) . "'";
			//Do SQL field for dynamic select box (Must be "select" statement)
			} else {
				$string_data1 .= ', \'enum\'=>"' . str_replace(array('"',"'"), array('&quot;',"&#39;"), getSqlFieldEnum($element_enum)) . '"';
			}
		}
		//If an element_note is specified, we'll utilize here:
		if ($element_note)
		{
			if (strpos($element_note, "'") !== false) $element_note = str_replace("'", "&#39;", $element_note); //Apostrophes cause issues when rendered, so replace with equivalent html character
			$string_data1 .= ", 'note'=>'" . cleanLabel($element_note) . "'";
		}
		// Finalize string for this field
		$string_data1 .= " );\n";
	}
	// Evaluate the string to produce the $elements1 array
	eval($string_data1);
	return array($elements1, array_unique($calc_fields_this_form), array_unique($branch_fields_this_form), $chkbox_flds);
}
// Check for REQUIRED FIELDS: First, check for any required fields that weren't entered (checkboxes are ignored - cannot be Required)
// Return TRUE if clean, and return FALSE if a required field was left blank for surveys OR redirect back to form if not survey.
function checkReqFields($fetched, $isSurveyPage=false, $reqmsg_maxlength = 1500)
{
	global $Proj, $double_data_entry, $user_rights;
	// Set array of submit-actions to ignore
	$ignoreSubmitActions = array('submit-btn-cancel', 'submit-btn-delete', 'submit-btn-deleteform', 'submit-btn-deleteevent');
	// Check required fields
	if (isset($_POST['submit-action']) && !in_array($_POST['submit-action'], $ignoreSubmitActions))
	{
		// Defaults
		$__reqmsg = '';
		// Loop through each to check if required
		foreach ($Proj->forms[$_GET['page']]['fields'] as $this_field=>$this_label)
		{
			// Only check field's value if the field is required
			if ($Proj->metadata[$this_field]['field_req'])
			{
				// If this field has an @HIDDEN[-??] action tag, then skip
				if (($isSurveyPage && Form::hasHiddenOrHiddenSurveyActionTag($Proj->metadata[$this_field]['misc']))
					|| (!$isSurveyPage && Form::hasHiddenOrHiddenFormActionTag($Proj->metadata[$this_field]['misc']))) {
					continue;
				}
				// Set flag
				$missingFieldValue = false;
				// Do check for non-checkbox fields
				if (isset($_POST[$this_field]) && !$Proj->isCheckbox($this_field) && $_POST[$this_field] == '')
				{
					$missingFieldValue = true;
				}
				// Do check for checkboxes, making sure at least one checkbox is checked
				elseif ($Proj->isCheckbox($this_field) && !isset($_POST["__chkn__".$this_field]))
				{
					// Check if checkboxes are visible and if none are checked
					$doReqChk = false;
					foreach (array_keys(parseEnum($Proj->metadata[$this_field]['element_enum'])) as $key) {
						if (isset($_POST["__chk__".$this_field."_RC_".$key])) {
							$doReqChk = true;
							break;
						}
					}
					if ($doReqChk)
					{
						// Build temp array of checkbox-formatted variable names that is used on html form for this field (e.g., __chk__matrix_2_RC_6)
						$numCheckBoxesChecked = 0;
						foreach (array_keys(parseEnum($Proj->metadata[$this_field]['element_enum'])) as $key) {
							$this_field_chkbox = "__chk__".$this_field."_RC_".$key;
							if (isset($_POST[$this_field_chkbox]) && $_POST[$this_field_chkbox] != '') {
								$numCheckBoxesChecked++;
							}
						}
					}
					// If zero boxes are checked for this checkbox
					if ($doReqChk && $numCheckBoxesChecked == 0)
					{
						$missingFieldValue = true;
					}
				}
				// If field's value is missing, add label to reqmsg to prompt
				if ($missingFieldValue)
				{
					$__reqmsg .= $this_field . ",";
				}
			}
		}
		// If some required fields weren't entered, save and return to page with user prompt
		if ($__reqmsg != '')
		{
			// Remove last comma
			$__reqmsg = $_GET['__reqmsgpre'] = substr($__reqmsg, 0, -1);
			// Perform server-side validation
			Form::serverSideValidation($_POST);
			// Save data (but NOT if previewing a survey)
			list ($fetched, $context_msg, $log_event_id) = saveRecord($fetched);
			// Set first submit time if null
			if ($isSurveyPage && isset($_POST['__response_id__'])) {
				// Set first_submit_time in response table, if null
				$sql = "update redcap_surveys_response set first_submit_time = '".NOW."'
						where response_id = {$_POST['__response_id__']} and first_submit_time is null";
				$q = db_query($sql);
			}
			// REDCap Hook injection point: Pass project_id and record name to method
			$group_id = (empty($Proj->groups)) ? null : Records::getRecordGroupId(PROJECT_ID, $fetched);
			if (!is_numeric($group_id)) $group_id = null;
			Hooks::call('redcap_save_record', array(PROJECT_ID, $fetched, $_GET['page'], $_GET['event_id'], $group_id, ($isSurveyPage ? $_GET['s'] : null), (isset($_POST['__response_id__']) && $isSurveyPage ? $_POST['__response_id__'] : null)));
			// To prevent having a URL length overflow issue, truncate string after set limit
			if (strlen($__reqmsg) > $reqmsg_maxlength) {
				$__reqmsg = substr($__reqmsg, 0, strpos($__reqmsg, ",", $reqmsg_maxlength)) . ",[more]";
			}
			// For surveys, don't redirect (because we'll lose our session) but merely set $_GET variable (to be utilized at bottom of page)
			// Don't enforce for surveys if going backward to previous page.
			if ($isSurveyPage && !isset($_GET['__prevpage'])) {
				// Set required field query string param
				$_GET['__reqmsg'] = urlencode(strip_tags($__reqmsg));				
				// If server-side validation was violated, then add to redirect URL
				if (isset($_SESSION['serverSideValErrors'])) {
					// Build query string parameter
					$_GET['serverside_error_fields'] = implode(",", array_keys($_SESSION['serverSideValErrors']));
					// Remove from session
					unset($_SESSION['serverSideValErrors']);
				}
				return false;
			}
			// Redirect with '__reqmsg' URL variable (and accomodate DDE persons, if applicable)
			elseif (!$isSurveyPage) {
				// Set URL to be redirected to
				$fetched = rawurlencode(label_decode($fetched));
				$url = PAGE_FULL . "?pid=" . PROJECT_ID . "&page=" . $_GET['page']
					 . "&id=" . (($double_data_entry && $user_rights['double_data'] != 0) ? substr($fetched, 0, -3) : $fetched)
					 . "&event_id={$_GET['event_id']}&__reqmsg=" . urlencode(strip_tags($__reqmsg));
				// SET UP DATA QUALITY RUNS TO RUN IN REAL TIME WITH ANY DATA CHANGES ON FORM
				$dq = new DataQuality();
				// Check for any errors and return array of DQ rule_id's for those rules that were violated
				list ($dq_errors, $dq_errors_excluded) = $dq->checkViolationsSingleRecord($fetched, $_GET['event_id'], $_GET['page']);
				// If rules were violated, reload page and then display pop-up message about discrepancies
				if (!empty($dq_errors)) {
					// Build query string parameter
					$url .= '&dq_error_ruleids=' . implode(",", array_merge($dq_errors, $dq_errors_excluded));
				}			
				// SET SERVER-SIDE VALIDATION CATCHING
				// If server-side validation was violated, then add to redirect URL
				if (isset($_SESSION['serverSideValErrors'])) {
					// Build query string parameter
					$url .= '&serverside_error_fields=' . implode(",", array_keys($_SESSION['serverSideValErrors']));
					// Remove from session
					unset($_SESSION['serverSideValErrors']);
				}
				// Finally redirect
				redirect($url);
				return false;
			}
		}
	}
	return true;
}
// REQUIRED FIELDS pop-up message (URL variable 'msg' has been passed)
function msgReqFields($fetched, $last_form='', $isSurveyPage=false)
{
	global $Proj, $lang, $double_data_entry, $user_rights, $multiple_arms, $longitudinal;
	if (isset($_GET['__reqmsg']) && trim($_GET['__reqmsg']) != '')
	{
		$_GET['__reqmsg'] = explode(",", strip_tags(urldecode($_GET['__reqmsg'])));
		//Render javascript for pop-up
		print  "<div id='reqPopup' title='".cleanHtml("{$lang['global_02']}{$lang['colon']} {$lang['data_entry_71']}")."' style='display:none;text-align:left;'>
					{$lang['data_entry_72']}<br/><br/>
					{$lang['data_entry_73']}<br/>
					<div style='font-size:11px;font-family:tahoma,arial;font-weight:bold;padding:3px 0;'>";
		foreach ($_GET['__reqmsg'] as $this_req)
		{
			$this_req = trim($this_req);
			if ($this_req == '') continue;
			if ($this_req == '[more]') {
				$this_label = $this_req;
			} else {
				$this_label = filter_tags(label_decode($Proj->metadata[$this_req]['element_label']));
			}
			print "<div style='margin-left: 1.5em;text-indent: -1em;'> &bull; ".$this_label."</div>";
		}
		print  "</div>";
		print  "</div>";
		?>
		<script type='text/javascript'>
		$(function(){
			setTimeout(function(){
				// REQUIRED FIELDS POP-UP DIALOG
				$('#reqPopup').dialog({ bgiframe: true, modal: true, width: (isMobileDevice ? $(window).width() : 570), open: function(){fitDialog(this)},
				<?php echo (count($_GET['__reqmsg']) > 10 ? "height: 600,": "") ?>
				buttons: {
					<?php
					// Don't show all buttons on survey page
					if (!$isSurveyPage) {
						// If user is on last form, don't show the button "Ignore and go to Next Form"
						if ($_GET['page'] != $last_form && !empty($last_form))
						{
							// Show button "ignore and go to next form"
							print "'" . cleanHtml($lang['data_entry_74']) . "': function(){ window.location.href='".PAGE_FULL."?pid=".PROJECT_ID."&page=".getNextForm($_GET['page'], $_GET['event_id'])."&id=".(($double_data_entry && $user_rights['double_data'] != 0) ? substr($fetched, 0, -3) : $fetched)."&event_id={$_GET['event_id']}'; },";
						}
						// Show button "ignore and leave record"
						print "'" . cleanHtml($lang['data_entry_76']) . "': function(){ window.location.href=app_path_webroot+'"
							. ($longitudinal ? 'DataEntry/record_home.php' : 'DataEntry/index.php')
							. "?pid=" . PROJECT_ID
							. (!$longitudinal ? "&page={$_GET['page']}" : "&id=".(($double_data_entry && $user_rights['double_data'] != 0) ? substr($fetched, 0, -3) : $fetched))
							. ($multiple_arms ? "&arm=".getArm() : "")
							. "'; },";
					}
					?>
					Okay: function() { $(this).dialog('close'); }
				} });
			},(isMobileDevice ? 1500 : 0));
		});
		</script>
		<?php
	}
}
// Determine if another user is on this form for this record for this project (do not allow the page to load, if so).
// Returns the username of the user already on the form.
function checkSimultaneousUsers()
{
	global $autologout_timer, $hidden_edit, $auto_inc_set, $double_data_entry, $user_rights;
	// Need to use autologout timer value to determine span of time to evaluate
	if (empty($autologout_timer) || $autologout_timer == 0 || !is_numeric($autologout_timer)) return false;
	// Ignore if project uses auto-numbering and the user is on an uncreated record (i.e. $hidden_edit=0 on first form)
	if ($hidden_edit === 0 && $auto_inc_set) return false;
	// If for some reason there is no session, then assume the other user won't have a session, which negates checking here.
	if (!session_id()) return false;
	// If user has form "read-only" privileges, then allow them access to this form if someone else is already on it.
	if ($user_rights['forms'][$_GET['page']] == '2') return false;
	// Check sessions table using log_view table session_id values
	if ((PAGE == "DataEntry/index.php" || PAGE == "ProjectGeneral/keep_alive.php") && isset($_GET['page']) && isset($_GET['id']) && isset($_GET['event_id']))
	{
		// Set window of time after which the user should have been logged out (based on system-wide parameter)
		$bufferTime = 3; // X minutes of buffer time (2 minute auto-logout warning + 1 minute buffer for lag, slow page load, etc.)
		$logoutWindow = date("Y-m-d H:i:s", mktime(date("H"),date("i")-(Authentication::AUTO_LOGOUT_RESET_TIME+$bufferTime),date("s"),date("m"),date("d"),date("Y")));
		// Ignore users sitting on page for uncreated records when auto-numbering is enabled
		$ignoreUncreatedAutoId = ($auto_inc_set ? "and a.full_url not like '%&auto%'" : "");
		// Set record (account for DDE)
		$record = $_GET['id'] . (($double_data_entry && $user_rights['double_data'] != '0') ? '--'.$user_rights['double_data'] : '');
		// Check latest log_view listing in past [MaxLogoutTime] minutes for this form/record (for users other than current user, ignore super users)
		$sql = "select a.session_id, a.user
				from redcap_log_view a
				inner join redcap_user_rights u ON a.user = u.username AND u.project_id = a.project_id
				inner join redcap_user_information i ON i.username = u.username
				left join redcap_user_roles ur ON u.role_id = ur.role_id
				where a.project_id = " . PROJECT_ID . "
				and a.ts >= '$logoutWindow'
				and a.user != '" . prep(USERID) . "'
				and a.event_id = {$_GET['event_id']}
				and a.record = '".prep($record)."'
				and a.form_name = '{$_GET['page']}'
				and a.page in ('DataEntry/index.php', 'ProjectGeneral/keep_alive.php')
				and (((u.data_entry like '%[{$_GET['page']},1]%' OR u.data_entry like '%[{$_GET['page']},3]%') AND ur.role_id IS NULL) 
					OR ((ur.data_entry LIKE '%[{$_GET['page']},1]%' OR ur.data_entry LIKE '%[{$_GET['page']},3]%') AND ur.role_id IS NOT NULL)
					OR i.super_user = 1)
				and a.log_view_id = (select b.log_view_id from redcap_log_view b where b.user = a.user order by b.log_view_id desc limit 1)
				$ignoreUncreatedAutoId
				order by a.log_view_id desc limit 1";
		$q = db_query($sql);
		if (db_num_rows($q) > 0)
		{
			// Now use the session_id from log_view table to see if they're still logged in (check sessions table)
			$session_id = db_result($q, 0, "session_id");
			$other_user = db_result($q, 0, "user");
			$sql = "select 1 from redcap_sessions where session_id = '$session_id' and session_expiration >= '$logoutWindow' limit 1";
			$q = db_query($sql);
			if (db_num_rows($q) > 0)
			{
				## We have 2 users on same form/record. Prevent loading of page.
				// First remove the new row just made in log_view table (otherwise, can simply refresh page to gain access)
				$sql = "update redcap_log_view force index (user_project)
						".(db_get_version() > 5.0 ? "force index for order by (PRIMARY)" : "")."
						set record = null, miscellaneous = 'record = \'{$record}\'\\n// Simultaneous user detected on form' where project_id = " . PROJECT_ID . "
						and event_id = {$_GET['event_id']} and form_name = '{$_GET['page']}'
						and user = '" . USERID . "' and page in ('DataEntry/index.php', 'ProjectGeneral/keep_alive.php')
						order by log_view_id desc limit 1";
				$q = db_query($sql);
				// Return the username of the user already on the form
				return $other_user;
			}
		}
	}
	return false;
}
// Initialize and render the "file" field type pop-up box (initially hidden)
function initFileUploadPopup()
{
	global $lang, $isMobileDevice;
	// Is this form being displayed as a survey?
	$isSurveyPage = ((isset($_GET['s']) && !empty($_GET['s']) && PAGE == "surveys/index.php" && defined("NOAUTH")) || PAGE == "Surveys/preview.php");
	// SURVEYS: Use the surveys/index.php page as a pass through for certain files (file uploads/downloads, etc.)
	if ($isSurveyPage)
	{
		$file_upload_page = APP_PATH_SURVEY . "index.php?pid=" . PROJECT_ID . "&__passthru=".urlencode("DataEntry/file_upload.php");
		$file_empty_page  = APP_PATH_SURVEY . "index.php?pid=" . PROJECT_ID . "&__passthru=".urlencode("DataEntry/empty.php") . '&s=' . $_GET['s'];
	}
	else
	{
		$file_upload_page = APP_PATH_WEBROOT . "DataEntry/file_upload.php?pid=" . PROJECT_ID;
		$file_empty_page  = APP_PATH_WEBROOT . "DataEntry/empty.php?pid=" . PROJECT_ID;
	}
	// Set the form action URL (must be customized in case we're on survey page, which has no authentication)
	$formAction = $file_upload_page.'&id='.rawurlencode($_GET['id']).'&event_id='.$_GET['event_id'].'&instance='.$_GET['instance'];
	if ($isSurveyPage) $formAction .= '&s='.$_GET['s'];
	// Set up file_upload pop-up html
	$f1_upload_form =  '<div style="color:#800000;margin:20px 0;font-size:14px;">'.$lang['data_entry_62'].'</div>
						<div style="margin:15px 0;">
							<input name="myfile" type="file" size="40">
							<input name="myfile_base64" type="hidden">
							<input name="myfile_base64_edited" type="hidden" value="0">
						</div>
						<input type="submit" style="padding:6px 10px;font-size:14px;" value="'.cleanHtml2($lang['form_renderer_23']).'">
						<span style="margin-left:10px;color:#888;">('.$lang['data_entry_63'].' '.maxUploadSizeEdoc().' MB)</span>';
	$file_upload_win = '<form autocomplete="off" id="form_file_upload" action="'.$formAction.'" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="return startUpload();" >
							<div id="this_upload_field">
								<span style="font-size:13px;" id="field_name_popup">'.$lang['data_entry_64'].'</span><br/><br/>
							</div>
							<div id="signature-div" onchange=\'if($(this).jSignature("getData","base30")[1].length){ $("#f1_upload_form input[name=myfile_base64_edited]").val("1"); }\'></div>
							<div id="signature-div-actions" style="padding-top:25px;">
								<button style="padding:4px 8px;font-size:14px;" onclick="saveSignature();return false;">'.$lang['form_renderer_30'].'</button>
								<a href="javascript:;" style="margin-left:15px;text-decoration:underline;" onclick=\'$("#signature-div").jSignature("reset");$("#f1_upload_form input[name=myfile_base64_edited]").val("0");return false;\'>'.$lang['form_renderer_20'].'</a>
							</div>
							<div id="f1_upload_process" style="display:none;font-weight:bold;font-size:14px;text-align:center;">
								<br>'.$lang['data_entry_65'].'<br><img src="'.APP_PATH_IMAGES.'loader.gif">
							</div>
							<div id="f1_upload_form">'.$f1_upload_form.'</div>
							<input type="hidden" id="field_name" name="field_name" value="">
							'.($isSurveyPage ? '' : '<input type="hidden" name="redcap_csrf_token" value="'.System::getCsrfToken().'">').'
							<iframe id="upload_target" name="upload_target" src="'.$file_empty_page.'" style="width:0;height:0;border:0px solid #fff;"></iframe>
						</form>';
	?>
	<!-- Edoc file upload dialog pop-up divs and javascript -->
	<div id="file_upload" class="simpleDialog" title="<?php echo cleanHtml2($lang['form_renderer_23']) ?>"></div>
	<div id="fade" class="black_overlay"></div>
	<script type='text/javascript'>
	// Set html for file upload pop-up (for resetting purposes)
	var file_upload_win = '<?php echo cleanHtml($file_upload_win) ?>';
	var f1_upload_form = '<?php echo cleanHtml($f1_upload_form) ?>';
	// Language for file upload dialog title
	var lang_file_upload_title1 = '<?php echo cleanHtml($lang['form_renderer_23']) ?>';
	var lang_file_upload_title2 = '<?php echo cleanHtml($lang['form_renderer_31']) ?>';
	</script>
	<script type="text/javascript" src="<?php print APP_PATH_JS?>jSignature.js"></script>
	<script type="text/javascript" src="<?php print APP_PATH_JS?>jSignature.SignHere.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php print APP_PATH_JS?>flashcanvas.js"></script>
	<![endif]-->
	<?php
}
// For metadata labels, clean the string of anything that would cause the page to break
function cleanLabel($string)
{
	// Apostrophes cause issues when rendered, so replace with equivalent html character
	if (strpos($string, "'") !== false) $string = str_replace("'", "&#39;", $string);
	// Backslashes at the beginning or end of the string will crash in the eval, so pad with a space if that occurs
	if (substr($string, 0, 1) == '\\') $string  = ' ' . $string;
	if (substr($string, -1)   == '\\') $string .= ' ';
	// Return cleaned string
	return $string;
}
// CALC FIELDS AND BRANCHING LOGIC: Add fields from other forms as hidden fields if involved in calc/branching on this form
function addHiddenFieldsOtherForms($current_form, $calc_branch_fields_all_forms)
{
	global $table_pk;
	// Add fields to elements array
	$elements = array();
	$chkbox_flds = array();
	$jsHideOtherFormChkbox = "<script type='text/javascript'>";
	// Remove event prefix (if any are using cross-event logic)
	foreach ($calc_branch_fields_all_forms as $key=>$value) {
		$dot_pos  = strpos($value, ".");
		if ($dot_pos !== false) {
			$calc_branch_fields_all_forms[$key] = substr($value, $dot_pos+1);
		}
	}
	$sql = "select field_name, element_type, element_enum from redcap_metadata where form_name != '$current_form'
			and project_id = '" . PROJECT_ID . "' and field_name in ('".implode("','",array_unique($calc_branch_fields_all_forms))."')
			and field_name != '$table_pk'";
	$q = db_query($sql);
	while ($rowq = db_fetch_array($q))
	{
		// If a checkbox AND we've not already added it
		if ($rowq['element_type'] == "checkbox" && !isset($chkbox_flds[$rowq['field_name']]))
		{
			// Add as official checkbox field on this form (will be displayed as table row, but will hide later using javascript)
			$elements[] = array('rr_type'=>'checkbox', 'field'=>$rowq['field_name'], 'label'=>'Label', 'enum'=>$rowq['element_enum'],
								'name'=>$rowq['field_name']);
			$chkbox_flds[$rowq['field_name']] = "";
			// Run javascript when page finishes loading to hide the row (since we cannot easily use hidden fields for invisible checkboxes
			$jsHideOtherFormChkbox .= "document.getElementById('{$rowq['field_name']}-tr').style.display='none';";
		}
		else
		{
			// Add field and its value as hidden field
			$elements[] = array('rr_type'=>'hidden', 'field'=>$rowq['field_name'], 'name'=>$rowq['field_name']);
		}
	}
	$jsHideOtherFormChkbox .= "</script>";
	// Return elements array
	return array($elements, $chkbox_flds, $jsHideOtherFormChkbox);
}

// Parse the stop_actions column into an array
function parseStopActions($string)
{
	// Explode into array, where strings should be delimited with pipe |
	$codes = array();
	if (strpos($string, ",") !== false)
	{
		foreach (explode(",", $string) as $code)
		{
			$codes[] = trim($code);
		}
	}
	elseif ($string != "")
	{
		$codes[] = trim($string);
	}
	return $codes;
}
// Render javascript to enable Stop Actions on a survey
function enableStopActions()
{
	global $Proj;
	// Begin rendering javascript
	print "<script type='text/javascript'>\n\$(function(){";
	// Loop through all fields
	foreach ($Proj->metadata as $this_field=>$attr)
	{
		// Ignore fields without stop actions
		if ($attr['stop_actions'] == "") continue;
		// Parse this field's stop actions
		$stop_actions = parseStopActions($attr['stop_actions']);
		// Enable for Radio buttons, YesNo, and TrueFalse
		if (in_array($attr['element_type'], array('radio','yesno','truefalse')))
		{
			print  "\n\$('#form :input[name=\"{$this_field}___radio\"]').each(function(){"
				.		"if(in_array(\$(this).val(),['".implode("','", $stop_actions)."'])){\$(this).click(function(){triggerStopAction(\$(this));});}"
				.  "});";
		}
		// Enable for Checkboxes
		elseif ($attr['element_type'] == 'checkbox')
		{
			print  "\n\$('#form :input[name=\"__chkn__{$this_field}\"]').each(function(){"
				.  		"if(in_array(\$(this).attr('code'),['".implode("','", $stop_actions)."'])){\$(this).click(function(){triggerStopAction(\$(this));});}"
				.  "});";
		}
		// Enable for Drop-downs
		elseif ($attr['element_type'] == 'select')
		{
			print  "\n\$('#form select[name=\"{$this_field}\"]').change(function(){"
				.		"if(in_array(\$(this).val(),['".implode("','", $stop_actions)."'])){triggerStopAction(\$(this));}"
				.  "});";
		}
	}
	print "\n});\n</script>";
}
// Make sure that there is a case sensitivity issue with the record name. Check value of id in URL with back-end value.
// If doesn't match back-end case, then reload page using back-end case in URL.
function checkRecordNameCaseSensitive()
{
	global $double_data_entry, $user_rights;
	// Set record (account for DDE)
	$record = "" . $_GET['id'] . (($double_data_entry && $user_rights['double_data'] != '0') ? '--'.$user_rights['double_data'] : '');
	// Compare with back-end value, if exists
	$backEndRecordName = Records::checkRecordNameCaseSensitive($record);
	if ($record !== $backEndRecordName)
	{
		// They don't match, so reload page using back-end value
		redirect(PAGE_FULL . "?pid=" . PROJECT_ID . "&page={$_GET['page']}&event_id={$_GET['event_id']}&id=$backEndRecordName" . (isset($_GET['auto']) ? "&auto=1" : ""));
	}
}
// Replace text-based emoticons with emoticon image icons
function emoticon_replace($string)
{
	/*
	// Array that stores text/image equivalents of the emoticons
	$emoticons = array
	(
		':)' => 'smiley.png',
		':(' => 'smiley_frown.gif',
		':/' => 'smiley_indifferent.gif'
	);
	// Replace the emoticon text in the string with html image
	foreach ($emoticons as $text=>$icon)
	{
		$string = str_replace($text, "<img src='" . APP_PATH_IMAGES . "$icon'>", $string);
	}
	*/
	// Now return the string
	return $string;
}
// Display search utility on data entry page
function renderSearchUtility()
{
	global $lang, $Proj, $longitudinal, $user_rights;	
	// Build the options for the field drop-down list
	$field_dropdown = "";
	$exclude_fieldtypes = array("file", "descriptive", "checkbox", "dropdown", "select", "radio", "yesno", "truefalse");
	foreach ($Proj->metadata as $row)
	{
		// Do not include certain field types
		if (in_array($row['element_type'], $exclude_fieldtypes)) continue;
		// Do not include fields from forms the user does not have access to
		if ($user_rights['forms'][$row['form_name']] == '0') continue;
		// Build list option
		$this_select_dispval = $row['field_name']." (".strip_tags(label_decode($row['element_label'])).")";
		$maxlength = 70;
		if (strlen($this_select_dispval) > $maxlength) {
			$this_select_dispval = substr($this_select_dispval, 0, $maxlength-2) . "...)";
		}
		$field_dropdown .= "<option value='{$row['field_name']}'>$this_select_dispval</option>";
	}
	// Disply html table of search utility
	?>
	<div style="max-width:700px;margin:40px 0 0;">
		<table class="form_border" width=100%>
			<tr>
				<td class="header" colspan="2" style="font-weight:normal;padding:10px 5px;color:#800000;font-size:13px;">
					<?php echo $lang['data_entry_138'] ?>
				</td>
			</tr>
			<tr>
				<td class="labelrc" style="width:275px;padding:10px 8px;">
					<?php echo $lang['data_entry_139'] ?>
					<div style="font-size:10px;font-weight:normal;color:#555;"><?php echo $lang['data_entry_141'] ?></div>
				</td>
				<td class="data" style="padding:10px 8px;">
					<select id="field_select" class="x-form-text x-form-field" style="max-width:300px;">
						<option value=""><?php echo $lang['dataqueries_183'] ?></option>
						<?php echo $field_dropdown ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="labelrc" style="width:275px;padding:10px 8px;">
					<?php echo $lang['data_entry_142'] ?>
					<div style="padding-top:4px;font-size:10px;font-weight:normal;color:#555;"><?php echo $lang['data_entry_143'] ?></div>
				</td>
				<td class="data" style="padding:10px 8px;">
					<input type="text" id="search_query" size="30" class="x-form-text x-form-field" autocomplete="off">
					<span id="search_progress" style="padding-left:10px;display:none;">
						<img src="<?php echo APP_PATH_IMAGES ?>progress_circle.gif" style="vertical-align:middle;">
						<?php echo $lang['data_entry_145'] ?>
					</span>
				</td>
			</tr>
		</table>
	</div>
	<script type="text/javascript">
	// Show the searching progress icon
	function showSearchProgress(count) {
		var repeat = false;
		if (count == 1) {
			$('#search_progress').show();
			repeat = true;
		} else {
			if ($('.autocomplete div#searching').length < 2 || $('#search_query').val().length < 1) {
				$('#search_progress').hide('fade');
			} else {
				repeat = true;
			}
		}
		if (repeat) {
			// Check every 0.5 seconds until the div appears
			count++;
			setTimeout("showSearchProgress("+count+")", 500);
		}
	}
	// Initialize Data Search object variable
	var search;
	// Set Data Search autocomplete trigger
	function enableDataSearchAutocomplete(field,arm) {
		search = null;
		search = 	$('#search_query').autocomplete({
						source: app_path_webroot+'DataEntry/search.php?field='+field+'&pid='+pid+'&arm='+arm,
						minLength: 1,
						delay: 0,
						select: function( event, ui ) {
							// Reset value in textbox
							$('#search_query').val('');
							// Get record and event_id values and redirect to form
							var data_arr = ui.item.value.split('|',4);
							window.location.href = app_path_webroot+'DataEntry/index.php?pid='+pid+'&page='+data_arr[1]+'&event_id='+data_arr[2]+'&id='+data_arr[3]+'&instance='+data_arr[0];
							return false;
						},
						focus: function (event, ui) {
							// Reset value in textbox
							$('#search_query').val('');
							return false;
						}			
					})
					.data('ui-autocomplete')._renderItem = function( ul, item ) {
						return $("<li></li>")
							.data("item", item)
							.append("<a>"+item.label+"</a>")
							.appendTo(ul);
					};
	}
	$(function(){
		// Enable searching via auto complete
		enableDataSearchAutocomplete('','<?php echo getArm() ?>');
		// If user selects new field for Data Search, set search query input to blank
		$('#field_select').change(function(){
			// Reset query text
			$('#search_query').val('');
			// Enable searching via auto complete
			enableDataSearchAutocomplete($(this).val(),'<?php echo getArm() ?>');
		});
		// Make progress gif appear when loading new results
		$('#search_query').keydown(function(){
			$('.autocomplete div#searching').each(function(){
				$(this).remove();
			});
			if ($('.autocomplete').length) {
				$('.autocomplete').prepend('<div id="searching" style="display:none;"></div>');
			}
			showSearchProgress(1);
		});
	});
	</script>
	<?php
}
// If downloading/deleting file from a survey, double check to make sure that only the respondent who uploaded the file has rights to it
function checkSurveyFileRights()
{
	global $lang;
	// We can only do the check if we have certain parameters
	if (isset($_GET['s']) && !empty($_GET['s']) && isset($_GET['field_name']) && isset($_GET['record']) && isset($_GET['event_id']) && is_numeric($_GET['event_id']))
	{
		// If record is empty or don't have a response_id in session yet, then give note that cannot yield
		// the file until the record has been saved (security reasons).
		if ($_GET['record'] == "" || !isset($_GET['__response_hash__']) || (isset($_GET['__response_hash__']) && empty($_GET['__response_hash__'])))
		{
			// Make sure record exists. If it does, give notice that record must be saved/created first in order to download/delete the file
			if ($_GET['record'] != "" && !Records::recordExists($_GET['record'])) return;
			// Make sure we have a non-blank response hash
			if (isset($_GET['__response_hash__']) && !empty($_GET['__response_hash__'])) return;
			// Record exists, but we don't have a response_id (i.e. we're on first page of survey), so page must be saved first
			$HtmlPage = new HtmlPage();
			$HtmlPage->PrintHeaderExt();
			print "<b>{$lang['global_03']}{$lang['colon']}</b> {$lang['survey_217']}";
			$HtmlPage->PrintFooterExt();
			exit;
		}
		//Cross reference the doc_id, project_id, field_name, and record to ensure they all match up for this
		$sql = "select 1 from redcap_metadata m, redcap_edocs_metadata e, redcap_data d where m.project_id = " . PROJECT_ID . " and
				m.project_id = d.project_id and m.project_id = e.project_id and m.field_name = '" . prep($_GET['field_name']) . "'
				and m.field_name = d.field_name and m.element_type = 'file' and d.event_id = {$_GET['event_id']}
				and d.record = '" . prep($_GET['record']) . "' and d.value = e.doc_id and e.doc_id = '" . prep($_GET['id']) . "'
				and d.instance ".($_GET['instance'] == '1' ? "is null" : "= '" . prep($_GET['instance']) . "'")." limit 1";
		$q = db_query($sql);
		$matchesRecord = db_num_rows($q);
		// If we're deleting a file for an existing record, but the edoc_id itself has not been saved
		// into redcap_data yet, then all is fine, so return.
		if (!$matchesRecord && strpos($_GET['__passthru'], 'file_delete.php') !== false) return;
		// Also cross reference the survey hash, response_id, and record number in the surveys tables
		$sql = "select participant_id from redcap_surveys_participants where hash = '".prep($_GET['s'])."' limit 1";
		$q = db_query($sql);
		$participant_id = db_result($q, 0);
		$response_id = decryptResponseHash($_GET['__response_hash__'], $participant_id);
		$sql = "select 1 from redcap_surveys_participants p, redcap_surveys_response r where p.hash = '{$_GET['s']}'
				and p.participant_id = r.participant_id and r.response_id = '$response_id'
				and r.record = '" . prep($_GET['record']) . "' limit 1";
		$q = db_query($sql);
		$matchesResponseId = db_num_rows($q);
		// If the record exists and the file was uploaded, but the survey page has not been saved
		if (!$matchesRecord && $matchesResponseId)
		{
			$HtmlPage = new HtmlPage();
			$HtmlPage->PrintHeaderExt();
			print "<b>{$lang['global_03']}{$lang['colon']}</b> {$lang['survey_217']}";
			$HtmlPage->PrintFooterExt();
			exit;
		}
		// If does not match all existing data for this response, then do not allow downloading of file (i.e. they don't have rights to do so)
		elseif (!$matchesRecord || !$matchesResponseId)
		{
			exit("{$lang['global_01']}!");
		}
	}
}
// If downloading/deleting file from a form, double check to make sure that the user has rights to it
function checkFormFileRights()
{
	global $lang, $Proj, $user_rights;
	// Since this is a project file, we can safely assume it's not a survey logo,
	// so it MUST be either an image/file attachment for a field, a survey email attachment, OR an uploaded file.
	// First, check if the file is an image/file attachment
	$sql = "select 1 from redcap_metadata m, redcap_edocs_metadata e where m.project_id = " . PROJECT_ID . " and
			m.project_id = e.project_id and m.element_type = 'descriptive' and m.edoc_id = '".prep($_GET['id'])."'
			and e.doc_id = m.edoc_id limit 1";
	$q = db_query($sql);
	$isNotRecordFile = db_num_rows($q);
	// If not an image/file attachement, check if it is a survey email attachment
	if (!$isNotRecordFile) {
		$sql = "select 1 from redcap_surveys where project_id = " . PROJECT_ID . " and
				confirmation_email_attachment = '".prep($_GET['id'])."' limit 1";
		$q = db_query($sql);
		$isNotRecordFile = db_num_rows($q);
	}
	// Check if a file sent from the REDCap mobile app
	if (!$isNotRecordFile) {
		$appFileInfo = MobileApp::getAppArchiveFiles(PROJECT_ID, $_GET['id']);
		$isNotRecordFile = (!empty($appFileInfo));
	}
	// Check if this is a Data Dictionary snapshot AND user has Design privileges
	if (!$isNotRecordFile && $user_rights['design']) {		
		$sql = "select 1 from redcap_data_dictionaries where project_id = " . PROJECT_ID . " and
				doc_id = '".prep($_GET['id'])."' limit 1";
		$q = db_query($sql);
		$isNotRecordFile = db_num_rows($q);
	}
	// If the file is a user-uploaded file (i.e. NOT a field attachment), then it MUST have a field_name in the query string that we can now validate
	if (!$isNotRecordFile)
	{
		// Validate the field name, and also check that the record/event_id are included in the query string
		if (!isset($_GET['field_name']) || (isset($_GET['field_name']) && !isset($Proj->metadata[$_GET['field_name']]))
			|| !isset($_GET['record']) || !isset($_GET['event_id']) || !is_numeric($_GET['event_id']))
		{
			exit("{$lang['global_01']}!");
		}
		// Add logic if user is in a DAG
		$group_sql = ($user_rights['group_id'] == "") ? "" : "and d.record in (" . pre_query("select record from redcap_data where project_id = " . PROJECT_ID . " and field_name = '__GROUPID__' and value = '{$user_rights['group_id']}'") . ")";
		// Cross reference the doc_id, project_id, field_name, and record to ensure they all match up for this (include DAG permissions)
		$sql = "select 1 from redcap_metadata m, redcap_edocs_metadata e, redcap_data d where m.project_id = " . PROJECT_ID . " and
				m.project_id = d.project_id and m.project_id = e.project_id and m.field_name = '" . prep($_GET['field_name']) . "'
				and m.field_name = d.field_name and m.element_type = 'file' and d.event_id = {$_GET['event_id']} $group_sql
				and d.record = '" . prep($_GET['record']) . "' and d.value = e.doc_id 
				and d.instance ".($_GET['instance'] == '1' ? "is null" : "= '" . prep($_GET['instance']) . "'")." 
				and e.doc_id = '" . prep($_GET['id']) . "' limit 1";
		$q = db_query($sql);
		$matchesRecord = db_num_rows($q);
		// If record permissions don't add up, give error message
		if (!$matchesRecord)
		{
			// Make sure record exists. If it does, give notice that record must be saved/created first in order to download the file
			if (!Records::recordExists($_GET['record']))
			{
				// Record doesn't exist
				// If deleting the file on the form when the record doesn't exist yet, don't render an error here
				if (PAGE == 'DataEntry/file_delete.php') return;
				// Make an exception if this is the image_view.php page when viewing a signature
				if (isset($_GET['signature']) && PAGE == 'DataEntry/image_view.php') return;
				// Give error message
				$HtmlPage = new HtmlPage();
				$HtmlPage->PrintHeaderExt();
				print "<b>{$lang['global_03']}{$lang['colon']}</b> {$lang['survey_217']}";
				$HtmlPage->PrintFooterExt();
				exit;
			}
			else
			{
				// Record exists, but user doesn't have proper permissions
				exit("{$lang['global_01']}!");
			}
		}
		// Lastly, check form-level rights to make sure the user can access any data on the form that the file exists on
		$form = $Proj->metadata[$_GET['field_name']]['form_name'];
		if ($user_rights['forms'][$form] == '0') exit("{$lang['global_01']}!");
	}
}
// SECONDARY UNIQUE FIELD: Render the secondary unique field JavaScript to prevent duplicate values
function renderSecondaryIdJs()
{
	global $secondary_pk, $lang;
	?>
	<script type='text/javascript'>
	// Set secondary_id and see if it's on this page
	var secondary_pk = '<?php echo $secondary_pk ?>';
	// Initial function (default return true)
	var checkSecondaryUniqueField = function(){ return; };
	// On pageload
	$(function(){
		// Create onblur event to make an ajax call to check uniqueness
		if (secondary_pk != '' && $('#form :input[name="'+secondary_pk+'"]').length) {
			// Add extra inline onblur attribute for fastest reaction time to prevent submitting form
			var onblur = ($('#form :input[name="'+secondary_pk+'"]').attr('onblur') == null) ? '' : ($('#form :input[name="'+secondary_pk+'"]').attr('onblur')+';');
			$('#form :input[name="'+secondary_pk+'"]').attr('onblur', onblur+'checkSecondaryUniqueField($(this));');
			// Check if value is unique
			checkSecondaryUniqueField = function(ob){
				// Disable all form buttons temporarily
				$('#formSaveTip input[type="button"], #form input[type="button"], #form :input[name="'+secondary_pk+'"]').prop('disabled', true);
				// Init values
				//var ob = $(this);
				var url_base = 'DataEntry/check_unique_ajax.php';
				if (page == 'surveys/index.php') {
					// Survey page
					var record = ((document.form.__response_hash__.value == '') ? '' : $('#form :input[name="'+table_pk+'"]').val());
					var url = app_path_webroot_full+page+'?s='+getParameterByName('s')+'&__passthru='+encodeURIComponent(url_base);
				} else {
					// Data entry page
					var record = ((document.form.hidden_edit_flag.value == '0') ? '' : getParameterByName('id'));
					var url = app_path_webroot+url_base;
				}
				ob.val( trim(ob.val()) );
				if (ob.val().length > 0) {
					// Make ajax request
					$.ajax({
						url: url,
						type: 'GET',
						data: { pid: pid, field_name: secondary_pk, event_id: event_id, record: record, instance: '<?php echo $_GET['instance'] ?>', value: ob.val() },
						async: false,
						success:
							function(data){
								if (data.length == 0) {
									alert(woops);
									setTimeout(function () { ob.focus() }, 1);
								} else if (data != '0') {
									if (page == 'surveys/index.php') {
										simpleDialog('<?php echo cleanHtml($lang['data_entry_169']) ?> ("'+ob.val()
											+ '") <?php echo $lang['data_entry_170'] ?> <?php echo cleanHtml($lang['data_entry_108']) ?>','<?php echo cleanHtml($lang['data_entry_105']) ?>',null,null,"$('#form :input[name="+secondary_pk+"]').focus();",'<?php echo cleanHtml($lang['calendar_popup_01']) ?>');
									} else {
										simpleDialog('<?php echo cleanHtml($lang['data_entry_106']) ?> ('+secondary_pk
											+ ')<?php echo cleanHtml("{$lang['data_entry_107']} {$lang['data_entry_109']} {$lang['data_entry_110']}") ?> '
											+ '<?php echo cleanHtml($lang['data_entry_111']) ?> ("'+ob.val()
											+ '")<?php echo $lang['period'] ?> <?php echo cleanHtml($lang['data_entry_108']) ?>','<?php echo cleanHtml($lang['data_entry_105']) ?>',null,null,"$('#form :input[name="+secondary_pk+"]').focus();",'<?php echo cleanHtml($lang['calendar_popup_01']) ?>');
									}
									ob.css('font-weight','bold');
									ob.css('background-color','#FFB7BE');
								} else {
									ob.css('font-weight','normal');
									ob.css('background-color','#FFFFFF');
								}
								// Enable all form buttons again
								$('#formSaveTip input[type="button"], #form input[type="button"], #form :input[name="'+secondary_pk+'"]').prop('disabled', false);
							}
					});
				} else {
					// Enable all form buttons again
					$('#formSaveTip input[type="button"], #form input[type="button"], #form :input[name="'+secondary_pk+'"]').prop('disabled', false);
				}
			}
		}
	});
	</script>
	<?php
}
// Retrieve data for a record (can limit by an event) and return as array
function getRecordData($record, $event_id=null)
{
	global $table_pk, $Proj;
	// Query data table for data
	$datasql = "select field_name, value from redcap_data where	project_id = ".PROJECT_ID." and record = '".prep($record)."'
				order by field_name, value";
	if (is_numeric($event_id)) {
		$datasql .= " and event_id = $event_id";
	}
	$q = db_query($datasql);
	$data = array();
	while ($row_data = db_fetch_assoc($q))
	{
		// Checkbox
		if ($Proj->metadata[$row_data['field_name']]['element_type'] == 'checkbox') {
			// If checkbox has no data yet, then pre-fill with 0's first
			if (!isset($data[$row_data['field_name']])) {
				foreach (array_keys(parseEnum($Proj->metadata[$row_data['field_name']]['element_enum'])) as $code) {
					$data[$row_data['field_name']][$code] = '0';
				}
			}
			$data[$row_data['field_name']][$row_data['value']] = '1';
		// Non-checkbox, non-date field
		} else {
			$data[$row_data['field_name']] = $row_data['value'];
		}
	}
	// Return data array
	return $data;
}
// Determine width of each column based upon number of choices
function getMatrixHdrWidths($num_matrix_headers)
{
	// Total percentage width of all choices combined (i.e., w/o the label)
	$totalPercentWidthChoices = 66;
	// Return column width percentage of each
	return round($totalPercentWidthChoices/$num_matrix_headers, 1);
}
// Produce HTML table to display a matrix question's headers
function matrixHeaderTable($enum, $matrix_col_width, $isFirstInGroup=null, $hasRanking=0)
{
	global $lang;
	// For Online Designer, add a table attribute so we can know if this field is the first field of a matrix group (for previewing form)
	$firstMatrix = "";
	if ($isFirstInGroup != null) {
		$firstMatrix = ($isFirstInGroup == '1') ? "fmtx='1'" : "";
	}
	// First column (which is blank)
	$html = "<table cellspacing=0 class='headermatrix' $firstMatrix>
				<tr>
				  <td class='matrix_first_col_hdr'>".($hasRanking ? $lang['data_entry_204'] : "")."</td>";
	// Loop through all choices and display their label
	foreach (parseEnum($enum) as $this_hdr) {
		$html .= "<td style='width:{$matrix_col_width}%;'>".decode_filter_tags($this_hdr)."</td>";
	}
	$html .= "	</tr>
			</table>";
	// Return table html
	return $html;
}
// If the Data Entry Trigger is enabled, then send HTTP Post request to specified URL
function launchDataEntryTrigger()
{
	global $data_entry_trigger_url, $table_pk, $longitudinal, $Proj, $data_entry_trigger_enabled, $redcap_version;
	// First, check if enabled
	if (!$data_entry_trigger_enabled || $data_entry_trigger_url == '') {
		return false;
	}
	// Set record name
	$record = $_POST[$table_pk];
	// Build HTTP Post request parameters to send
	$params = array('redcap_url'=>APP_PATH_WEBROOT_FULL,
					'project_url'=>APP_PATH_WEBROOT_FULL."redcap_v{$redcap_version}/index.php?pid=".PROJECT_ID,
					'project_id'=>PROJECT_ID, 'username'=>USERID);
	// Add record name (using its literal variable name as key)
	$params['record'] = $record;
	// If longitudinal, include unique event name
	if ($longitudinal) {
		$params['redcap_event_name'] = $Proj->getUniqueEventNames($_GET['event_id']);
	}
	// Add unique data access group, if record is in a DAG
	if (PAGE != 'surveys/index.php' && isset($_POST['__GROUPID__']) && !empty($_POST['__GROUPID__'])) {
		// Data Entry Form: Get group_id from Post value
		$unique_group_name = $Proj->getUniqueGroupNames($_POST['__GROUPID__']);
	} elseif (PAGE == 'surveys/index.php') {
		// Survey: Check if DAGs exist and get DAG manually from back-end
		$uniqueDags = $Proj->getUniqueGroupNames();
		if (!empty($uniqueDags)) {
			// Query back-end to get DAG for this record (if in a DAG)
			$group_id = Records::getRecordGroupId(PROJECT_ID, $record);
			if ($group_id !== false) {
				$unique_group_name = $Proj->getUniqueGroupNames($group_id);
			}
		}
	}
	if (isset($unique_group_name) && !empty($unique_group_name)) {
		$params['redcap_data_access_group'] = $unique_group_name;
	}
	// Add name of data collection instrument and its status value (0,1,2) unless we're merging a DDE record
	if (PAGE != 'DataComparisonController:index') {
		$params['instrument'] = $_GET['page'];
		// Add status of data collection instrument for this record (0=Incomplete, 1=Unverified, 2=Complete)
		$formStatusField = $_GET['page'].'_complete';
		$params[$formStatusField] = $_POST[$formStatusField];
	}
	// Set timeout value for http request
	$timeout = 10; // seconds
	// If $data_entry_trigger_url is a relative URL, then prepend with server domain
	$pre_url = "";
	if (substr($data_entry_trigger_url, 0, 1) == "/") {
		$pre_url = (SSL ? "https://" : "http://") . SERVER_NAME;
	}
	// Send Post request
	$response = http_post($pre_url . $data_entry_trigger_url, $params, $timeout);
	// Return boolean for success
	return !!$response;
}
