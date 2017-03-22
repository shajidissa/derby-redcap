<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . "/Config/init_project.php";
require_once APP_PATH_DOCROOT . 'ProjectGeneral/form_renderer_functions.php';
require_once APP_PATH_DOCROOT  . "Surveys/survey_functions.php";

// Determine the instrument
$form = (isset($_GET['page']) && isset($Proj->forms[$_GET['page']])) ? $_GET['page'] : $Proj->firstForm;

// If no survey id, assume it's the first form and retrieve
if (!isset($_GET['survey_id']))
{
	$_GET['survey_id'] = getSurveyId($form);
}


if (checkSurveyProject($_GET['survey_id']))
{
	// Default message
	$msg = "";

	// Retrieve survey info
	$q = db_query("select * from redcap_surveys where project_id = $project_id and survey_id = " . $_GET['survey_id']);
	foreach (db_fetch_assoc($q) as $key => $value)
	{
		if ($value === null) {
			$$key = $value;
		} else {
			// Replace non-break spaces because they cause issues with html_entity_decode()
			$value = str_replace(array("&amp;nbsp;", "&nbsp;"), array(" ", " "), $value);
			// Don't decode if cannnot detect encoding
			if (function_exists('mb_detect_encoding') && (
				(mb_detect_encoding($value) == 'UTF-8' && mb_detect_encoding(html_entity_decode($value, ENT_QUOTES)) === false)
				|| (mb_detect_encoding($value) == 'ASCII' && mb_detect_encoding(html_entity_decode($value, ENT_QUOTES)) === 'UTF-8')
			)) {
				$$key = trim($value);
			} else {
				$$key = trim(html_entity_decode($value, ENT_QUOTES));
			}
		}
	}
	if ($survey_expiration != '')
	{
		$expiration = substr($survey_expiration, 0, -3);
		if (strstr($expiration, ' '))
		{
			list ($survey_expiration_date, $survey_expiration_time) = explode(" ", $expiration, 2);
			$survey_expiration = DateTimeRC::format_ts_from_ymd($survey_expiration_date)." $survey_expiration_time";
		}
		else
		{
			$survey_expiration_time = '';
			list ($survey_expiration_date,) = explode(" ", $expiration, 2);
			$survey_expiration = DateTimeRC::format_ts_from_ymd($survey_expiration_date);
		}
	}


	/**
	 * PROCESS SUBMITTED CHANGES
	 */
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Build "go back" button to specific page
		if (isset($_GET['redirectDesigner'])) {
			// Go back to Online Designer
			$goBackBtn = renderPrevPageBtn("Design/online_designer.php",$lang['global_77'],false);
		} else {
			// Go back to Project Setup page
			$goBackBtn = renderPrevPageBtn("ProjectSetup/index.php?&msg=surveymodified",$lang['global_77'],false);
		}
		$msg = RCView::div(array('style'=>'padding:0 0 20px;'), $goBackBtn);
		// Assign Post array as globals
		foreach ($_POST as $key => $value) $$key = $value;
		// If some fields are missing from Post because disabled drop-downs don't post, then manually set their default value.
		if (!isset($_POST['question_auto_numbering'])) 	$question_auto_numbering = '0';
		if (!isset($_POST['show_required_field_text'])) $show_required_field_text = '0';
		if (!isset($_POST['save_and_return'])) 			$save_and_return = '0';
		if (!isset($_POST['question_by_section'])) 		$question_by_section = '1';
		if (!isset($_POST['view_results'])) 			$view_results = '0';
		if (!isset($_POST['promis_skip_question'])) 	$promis_skip_question = '0';
		if (!isset($_POST['survey_auth_enabled_single'])) 	$survey_auth_enabled_single = '0';
		$enhanced_choices = (isset($_POST['enhanced_choices']) && is_numeric($_POST['enhanced_choices'])) ? $_POST['enhanced_choices'] : '0';
		$edit_completed_response = (isset($_POST['edit_completed_response']) && $_POST['edit_completed_response'] == 'on') ? '1' : '0';
		$display_page_number = (isset($_POST['display_page_number']) && $_POST['display_page_number'] == 'on') ? '1' : '0';
		$hide_back_button = (isset($_POST['hide_back_button']) && $_POST['hide_back_button'] == 'on') ? '1' : '0';
		// Set checkbox value
		$check_diversity_view_results = (isset($check_diversity_view_results) && $check_diversity_view_results == 'on') ? 1 : 0;
		if (!isset($view_results)) $view_results = 0;
		if (!isset($min_responses_view_results)) $min_responses_view_results = 10;
		if ($survey_termination_options == 'url') {
			$acknowledgement = '';
		} else {
			$end_survey_redirect_url = '';
		}
		// AutoContinue - Set checkbox to 0 if not in post
		$end_survey_redirect_next_survey = (isset($_POST['end_survey_redirect_next_survey']) && $_POST['end_survey_redirect_next_survey'] == 'on') ? '1' : '0';
		// Reformat $survey_expiration from MDYHS to YMDHS for saving purposes
		if ($survey_expiration != '') {
			$survey_expiration_save = DateTimeRC::format_ts_to_ymd(trim($survey_expiration)).":00";
		} else {
			$survey_expiration_save = '';
		}
		// Set if the survey is active or offline
		if (isset($_POST['survey_enabled'])) {
			$survey_enabled = $_POST['survey_enabled'];
		}
		$survey_enabled = ($survey_enabled == '1') ? '1' : '0';
		$repeat_survey_enabled = (isset($repeat_survey_enabled) && $repeat_survey_enabled == 'on') ? '1' : '0';
		if (!$repeat_survey_enabled) $repeat_survey_btn_text = '';
		$text_to_speech = (is_numeric($text_to_speech)) ? $text_to_speech : '0';
		if ($confirmation_email_content == '') $confirmation_email_from = '';
		if ($text_to_speech_language == '') $text_to_speech_language = 'en';
		if (!isset($text_size) || !is_numeric($text_size)) $text_size = '';
		if (!isset($font_family) || !is_numeric($font_family)) $font_family = '';
		$repeat_survey_btn_location = ($repeat_survey_btn_location == 'BEFORE_SUBMIT') ? 'BEFORE_SUBMIT' : 'AFTER_SUBMIT';
		// Custom theme elements
		if (!isset($_POST['theme'])) {
			$theme = '';
			$regex_color = "/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/";
			$theme_bg_page = (isset($_POST['theme_bg_page']) && preg_match($regex_color, $_POST['theme_bg_page'])) ? substr($_POST['theme_bg_page'], 1) : '';
			$theme_text_buttons = (isset($_POST['theme_text_buttons']) && preg_match($regex_color, $_POST['theme_text_buttons'])) ? substr($_POST['theme_text_buttons'], 1) : '';
			$theme_text_title = (isset($_POST['theme_text_title']) && preg_match($regex_color, $_POST['theme_text_title'])) ? substr($_POST['theme_text_title'], 1) : '';
			$theme_bg_title = (isset($_POST['theme_bg_title']) && preg_match($regex_color, $_POST['theme_bg_title'])) ? substr($_POST['theme_bg_title'], 1) : '';
			$theme_text_question = (isset($_POST['theme_text_question']) && preg_match($regex_color, $_POST['theme_text_question'])) ? substr($_POST['theme_text_question'], 1) : '';
			$theme_bg_question = (isset($_POST['theme_bg_question']) && preg_match($regex_color, $_POST['theme_bg_question'])) ? substr($_POST['theme_bg_question'], 1) : '';
			$theme_text_sectionheader = (isset($_POST['theme_text_sectionheader']) && preg_match($regex_color, $_POST['theme_text_sectionheader'])) ? substr($_POST['theme_text_sectionheader'], 1) : '';
			$theme_bg_sectionheader = (isset($_POST['theme_bg_sectionheader']) && preg_match($regex_color, $_POST['theme_bg_sectionheader'])) ? substr($_POST['theme_bg_sectionheader'], 1) : '';
		} else {
			$theme = $_POST['theme'];
		}

		// Save survey info
		$sql = "update redcap_surveys set title = '" . prep($title) . "', acknowledgement = '" . prep($acknowledgement) . "',
				instructions = '" . prep($instructions) . "', question_by_section = '" . prep($question_by_section) . "',
				question_auto_numbering = '" . prep($question_auto_numbering) . "', save_and_return = '" . prep($save_and_return) . "',
				view_results = '" . prep($view_results) . "', min_responses_view_results = '" . prep($min_responses_view_results) . "',
				check_diversity_view_results = '" . prep($check_diversity_view_results) . "',
				end_survey_redirect_url = " . checkNull($end_survey_redirect_url) . ", survey_expiration = " . checkNull($survey_expiration_save) . ",
				survey_enabled = " . prep($survey_enabled) . ", promis_skip_question = '".prep($promis_skip_question)."',
				survey_auth_enabled_single = '".prep($survey_auth_enabled_single)."',
				edit_completed_response = '".prep($edit_completed_response)."', display_page_number = '".prep($display_page_number)."',
				hide_back_button = '".prep($hide_back_button)."', show_required_field_text = '".prep($show_required_field_text)."',
				confirmation_email_subject = ".checkNull($confirmation_email_subject).", confirmation_email_content = ".checkNull($confirmation_email_content).",
				confirmation_email_from = ".checkNull($confirmation_email_from).", text_to_speech = '" . prep($text_to_speech) . "',
				text_to_speech_language = '" . prep($text_to_speech_language) . "',
				end_survey_redirect_next_survey = '" . prep($end_survey_redirect_next_survey) . "', enhanced_choices = '".prep($enhanced_choices)."',
				theme = ".checkNull($theme).", text_size = ".checkNull($text_size).", font_family = ".checkNull($font_family).",
				theme_bg_page = ".checkNull($theme_bg_page).", theme_text_buttons = ".checkNull($theme_text_buttons).", theme_text_title = ".checkNull($theme_text_title).",
				theme_bg_title = ".checkNull($theme_bg_title).", theme_text_question = ".checkNull($theme_text_question).", theme_bg_question = ".checkNull($theme_bg_question).",
				theme_text_sectionheader = ".checkNull($theme_text_sectionheader).", theme_bg_sectionheader = ".checkNull($theme_bg_sectionheader).",
				repeat_survey_enabled = '" . prep($repeat_survey_enabled) . "', repeat_survey_btn_text = ".checkNull($repeat_survey_btn_text).",
				repeat_survey_btn_location = '" . prep($repeat_survey_btn_location) . "'
				where survey_id = $survey_id";
		if (db_query($sql))
		{
			$msg .= RCView::div(array('id'=>'saveSurveyMsg','class'=>'darkgreen','style'=>'display:none;vertical-align:middle;text-align:center;margin:0 0 25px;'),
						RCView::img(array('src'=>'tick.png')) . $lang['control_center_48']
					);
		}
		else
		{
			$msg = 	RCView::div(array('id'=>'saveSurveyMsg','class'=>'red','style'=>'display:none;vertical-align:middle;text-align:center;margin:0 0 25px;'),
						RCView::img(array('src'=>'exclamation.png')) . $lang['survey_159']
					);
		}

		// Upload logo
		$hide_title = ($hide_title == "on") ? "1" : "0";
		if (!empty($_FILES['logo']['name'])) {
			// Check if it is an image file
			$file_ext = getFileExt($_FILES['logo']['name']);
			if (in_array(strtolower($file_ext), array("jpeg", "jpg", "gif", "bmp", "png"))) {
				// Upload the image
				$logo = Files::uploadFile($_FILES['logo']);
				// Add doc_id to redcap_surveys table
				if ($logo != 0) {
					db_query("update redcap_surveys set logo = $logo, hide_title = $hide_title where survey_id = $survey_id");
				}
			}
		} elseif (empty($old_logo)) {
			// Mark existing field for deletion in edocs table, then in redcap_surveys table
			$logo = db_result(db_query("select logo from redcap_surveys where survey_id = $survey_id"), 0);
			if (!empty($logo)) {
				db_query("update redcap_edocs_metadata set delete_date = '".NOW."' where doc_id = $logo");
				db_query("update redcap_surveys set logo = null, hide_title = 0 where survey_id = $survey_id");
			}
			// Set back to default values
			$logo = "";
			$hide_title = "0";
		} elseif (!empty($old_logo)) {
			db_query("update redcap_surveys set hide_title = $hide_title where survey_id = $survey_id");
		}

		// Upload survey confirmation email attachment
		if (!empty($_FILES['confirmation_email_attachment']['name'])) {
			// Upload image
			$confirmation_email_attachment = Files::uploadFile($_FILES['confirmation_email_attachment']);
			// Add doc_id to redcap_surveys table
			if ($confirmation_email_attachment != 0) {
				db_query("update redcap_surveys set confirmation_email_attachment = $confirmation_email_attachment where survey_id = $survey_id");
			}
		} elseif (empty($old_confirmation_email_attachment)) {
			// Mark existing field for deletion in edocs table, then in redcap_surveys table
			$confirmation_email_attachment = db_result(db_query("select confirmation_email_attachment from redcap_surveys where survey_id = $survey_id"), 0);
			if (!empty($confirmation_email_attachment)) {
				db_query("update redcap_edocs_metadata set delete_date = '".NOW."' where doc_id = $confirmation_email_attachment");
				db_query("update redcap_surveys set confirmation_email_attachment = null where survey_id = $survey_id");
			}
			// Set back to default values
			$confirmation_email_attachment = "";
		}

		// Log the event
		Logging::logEvent($sql, "redcap_surveys", "MANAGE", $survey_id, "survey_id = $survey_id", "Modify survey info");

		// Once the survey is created, redirect to Online Designer and display "saved changes" message
		redirect(APP_PATH_WEBROOT . "Design/online_designer.php?pid=$project_id&survey_save=edit");
	}













	// Header
	include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

	// TABS
	include APP_PATH_DOCROOT . "ProjectSetup/tabs.php";

	?>
	<script type="text/javascript">
	// Display "saved changes" message, if just saved survey settings
	$(function(){
		if ($('#saveSurveyMsg').length) {
			setTimeout(function(){
				$('#saveSurveyMsg').slideToggle('normal');
			},200);
			setTimeout(function(){
				$('#saveSurveyMsg').slideToggle(1200);
			},5000);
		}
	});
	</script>

	<p style="margin-bottom:20px;"><?php echo $lang['survey_160'] ?></p>

	<?php
	// Display error message, if exists
	if (!empty($msg)) print $msg;
	?>

	<div class="blue" style="max-width:830px;">
		<div style="float:left;">
			<img src="<?php echo APP_PATH_IMAGES ?>pencil.png">
			<?php
			print $lang['setup_05'];
			print " {$lang['setup_89']} \"<b>".RCView::escape($Proj->forms[$form]['menu'])."</b>\"";
			?>
		</div>
		<?php if ($_SERVER['REQUEST_METHOD'] != 'POST') { ?>
		<div style="float:right;">
			<button class="btn btn-defaultrc btn-xs" onclick="history.go(-1)"><?php echo cleanHtml2($lang['global_53']) ?></button>
		</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
	<div style="background-color:#FAFAFA;border:1px solid #DDDDDD;padding:0 6px;max-width:830px;">
	<?php

	// Render the create/edit survey table
	include APP_PATH_DOCROOT . "Surveys/survey_info_table.php";

	print "</div>";

	// Footer
	include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
}