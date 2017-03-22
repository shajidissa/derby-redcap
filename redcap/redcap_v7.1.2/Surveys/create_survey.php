<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . "/Config/init_project.php";
require_once APP_PATH_DOCROOT . 'ProjectGeneral/form_renderer_functions.php';
require_once APP_PATH_DOCROOT . "Surveys/survey_functions.php";

// Determine the instrument
$form = (isset($_GET['page']) && isset($Proj->forms[$_GET['page']])) ? $_GET['page'] : null;

// If survey has already been created (it shouldn't have been), then redirect to edit_info page to edit survey
if (isset($Proj->forms[$form]['survey_id'])) {
	redirect(str_replace(PAGE, 'Surveys/edit_info.php', $_SERVER['REQUEST_URI']));
}


/**
 * PROCESS SUBMITTED CHANGES
 */
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// Assign Post array as globals
	foreach ($_POST as $key => $value) $$key = $value;
	// Set values
	$check_diversity_view_results = (isset($check_diversity_view_results) && $check_diversity_view_results == 'on') ? 1 : 0;
	if (!isset($view_results)) $view_results = 0;
	if (!isset($min_responses_view_results)) $min_responses_view_results = 10;
	if ($survey_termination_options == 'url') {
		$acknowledgement = '';
	} else {
		$end_survey_redirect_url = '';
	}
	// Survey Auto-Continue - Set checkbox to 0 if not in post
	$end_survey_redirect_next_survey = (isset($_POST['end_survey_redirect_next_survey']) && $_POST['end_survey_redirect_next_survey'] == 'on') ? '1' : '0';
	// Reformat $survey_expiration from MDYHS to YMDHS for saving purposes
	if ($survey_expiration != '') {
		list ($this_date, $this_time) = explode(" ", $survey_expiration);
		$survey_expiration = trim(DateTimeRC::date_mdy2ymd($this_date) . " " . $this_time);
	}
	if (!isset($survey_auth_enabled_single)) $survey_auth_enabled_single = '0';
	$edit_completed_response = (isset($edit_completed_response) && $edit_completed_response == 'on') ? '1' : '0';
	$repeat_survey_enabled = (isset($repeat_survey_enabled) && $repeat_survey_enabled == 'on') ? '1' : '0';
	if (!$repeat_survey_enabled) $repeat_survey_btn_text = '';
	
	$display_page_number = (isset($display_page_number) && $display_page_number == 'on') ? '1' : '0';
	$hide_back_button = (isset($hide_back_button) && $hide_back_button == 'on') ? '1' : '0';
	if ($confirmation_email_content == '') $confirmation_email_from = '';
	$text_to_speech = (isset($text_to_speech) && is_numeric($text_to_speech)) ? $text_to_speech : '0';
	if (!isset($text_to_speech_language) || $text_to_speech_language == '') $text_to_speech_language = 'en';
	if (!isset($text_size) || !is_numeric($text_size)) $text_size = '';
	if (!isset($font_family) || !is_numeric($font_family)) $font_family = '';
	$enhanced_choices = (isset($enhanced_choices) && is_numeric($enhanced_choices)) ? $enhanced_choices : '0';
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
	$sql = "insert into redcap_surveys (project_id, form_name, acknowledgement, instructions, question_by_section,
			question_auto_numbering, save_and_return, survey_enabled, title,
			view_results, min_responses_view_results, check_diversity_view_results, end_survey_redirect_url, survey_expiration,
			survey_auth_enabled_single, edit_completed_response, display_page_number, hide_back_button, show_required_field_text,
			confirmation_email_subject, confirmation_email_content, confirmation_email_from, text_to_speech, text_to_speech_language,
			end_survey_redirect_next_survey, enhanced_choices, theme, text_size, font_family,
			theme_bg_page, theme_text_buttons, theme_text_title, theme_bg_title,
			theme_text_question, theme_bg_question, theme_text_sectionheader, theme_bg_sectionheader, 
			repeat_survey_enabled, repeat_survey_btn_text, repeat_survey_btn_location)
			values ($project_id, '" . prep($form) . "',
			'" . prep($acknowledgement) . "', '" . prep($instructions) . "',
			'" . prep($question_by_section) . "', '" . prep($question_auto_numbering) . "',
			'" . prep($save_and_return) . "', 1, '" . prep($title) . "',
			'" . prep($view_results) . "', '" . prep($min_responses_view_results) . "', '" . prep($check_diversity_view_results) . "',
			" . checkNull($end_survey_redirect_url) . ", " . checkNull($survey_expiration) . ",
			'" . prep($survey_auth_enabled_single) . "', '" . prep($edit_completed_response) . "', '" . prep($display_page_number) . "',
			'" . prep($hide_back_button) . "', '" . prep($show_required_field_text) . "',
			" . checkNull($confirmation_email_subject) . ", " . checkNull($confirmation_email_content) . ",
			" . checkNull($confirmation_email_from) . ", '" . prep($text_to_speech) . "', '" . prep($text_to_speech_language) . "',
			'" . prep($end_survey_redirect_next_survey) . "', '" . prep($enhanced_choices) . "', 
			" . checkNull($theme) . ", " . checkNull($text_size) . ", " . checkNull($font_family) . ",
			" . checkNull($theme_bg_page) . ", " . checkNull($theme_text_buttons) . ", " . checkNull($theme_text_title) . ", " . checkNull($theme_bg_title) . ",
			" . checkNull($theme_text_question) . ", " . checkNull($theme_bg_question) . ", " . checkNull($theme_text_sectionheader) . ", 
			" . checkNull($theme_bg_sectionheader) . ", '" . prep($repeat_survey_enabled) . "', " . checkNull($repeat_survey_btn_text) . ",
			'" . prep($repeat_survey_btn_location) . "'" . 
			")";
	$survey_id = (db_query($sql) ? db_insert_id() : exit("An error occurred. Please try again."));

	// Upload logo
	$hide_title = (isset($hide_title) && $hide_title == "on" ? "1" : "0");
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
	Logging::logEvent($sql, "redcap_surveys", "MANAGE", $survey_id, "survey_id = $survey_id", "Set up survey");

	// Once the survey is created, redirect to Online Designer and display "saved changes" message
	redirect(APP_PATH_WEBROOT . "Design/online_designer.php?pid=$project_id&survey_save=create");
}








// Header
include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

// TABS
include APP_PATH_DOCROOT . "ProjectSetup/tabs.php";

// Instructions
?>
<p style="margin-bottom:20px;">
	<?php
	print $lang['survey_271'] . " " . $lang['survey_272'];
	?>
</p>
<?php


// If form name does not exist (except only in Draft Mode), then give error message
if ($form == null && $status > 0 && $draft_mode == 1)
{
	print 	RCView::div(array('class'=>'yellow','style'=>''),
				RCView::img(array('src'=>'exclamation_orange.png')) .
				RCView::b($lang['global_01'].$lang['colon']) . " " . $lang['survey_496']
			);

	include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
	exit;
}

// Force user to click button to begin survey-enabling process
if (!isset($_GET['view']))
{
	?>
	<div class="yellow" style="text-align:center;font-weight:bold;padding:10px;">
		<?php echo $lang['survey_151'] ?>
		<br><br>
		<button class="jqbutton" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI'] ?>&view=showform';"
			><?php echo $lang['survey_152'] ?> "<?php echo $Proj->forms[$form]['menu'] ?>" <?php echo $lang['survey_153'] ?></button>
	</div>
	<?php
}


// Display form to enable survey
elseif (isset($_GET['view']) && $_GET['view'] == "showform")
{
	?>
	<div class="darkgreen" style="max-width:830px;">
		<div style="float:left;">
			<img src="<?php echo APP_PATH_IMAGES ?>add.png">
			<?php
			print $lang['setup_24'];
			print " {$lang['setup_89']} \"<b>".RCView::escape($Proj->forms[$form]['menu'])."</b>\"";
			?>
		</div>
		<div style="float:right;">
			<button class="btn btn-defaultrc btn-xs" onclick="history.go(-1)"><?php echo cleanHtml2($lang['global_53']) ?></button>
		</div>
		<div class="clear"></div>
	</div>
	<div style="background-color:#FAFAFA;border:1px solid #DDDDDD;padding:0 6px;max-width:830px;">
		<?php
		// Set defaults to pre-fill table
		$title = empty($Proj->forms[$form]['menu']) ? "My Survey" : $Proj->forms[$form]['menu'];
		$question_auto_numbering = 1;
		$question_by_section = 0;
		$save_and_return = 0;
		$logo = $confirmation_email_subject = $confirmation_email_content = $confirmation_email_attachment = "";
		$hide_title = 0;
		$instructions = '<p><strong>'.$lang['survey_154'].'</strong></p><p>'.$lang['global_83'].'</p>';
		$acknowledgement = '<p><strong>'.$lang['survey_155'].'</strong></p><p>'.$lang['survey_156'].'</p>';
		$view_results = 0;
		$min_responses_view_results = 10;
		$check_diversity_view_results = 1;
		$end_survey_redirect_url = '';
		$survey_expiration = '';
		$survey_auth_enabled_single = '0';
		$edit_completed_response = 0;
		$display_page_number = 0;
		$hide_back_button = 0;
		$show_required_field_text = 1;
		$text_to_speech = 0;
		$text_to_speech_language = 'en';
		$theme = '';
		$text_size = '1';
		$font_family = '16';
		$theme_text_buttons = $theme_bg_page = $theme_text_title = $theme_bg_title = $repeat_survey_btn_text = '';
		$theme_text_sectionheader = $theme_bg_sectionheader = $theme_text_question = $theme_bg_question = '';
		$enhanced_choices = $repeat_survey_enabled = 0;
		$repeat_survey_btn_location = 'BEFORE_SUBMIT';
		// Render the create/edit survey table
		include APP_PATH_DOCROOT . "Surveys/survey_info_table.php";
		?>
	</div>
	<?php
}


// Footer
include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
