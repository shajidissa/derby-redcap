<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

$isPromisInstrument = false;
if (isset($_GET['survey_id']))
{
	// Detect if any branching logic exists in survey. If so, disable question auto numbering.
	$hasBranching = Design::checkSurveyBranchingExists($Proj->surveys[$_GET['survey_id']]['form_name']);
	if ($hasBranching) $question_auto_numbering = false;
	// Determine if this survey is a PROMIS CAT
	list ($isPromisInstrument, $isAutoScoringInstrument) = PROMIS::isPromisInstrument($Proj->surveys[$_GET['survey_id']]['form_name']);
}

// Get current time zone, if possible
$timezoneText = "{$lang['survey_296']} <b>".getTimeZone()."</b>{$lang['survey_297']}<br/><b>" . DateTimeRC::format_user_datetime(NOW, 'Y-M-D_24', null, true) . "</b>{$lang['period']}";

// Set repeat survey button text, if not set
if (trim($repeat_survey_btn_text) == '') $repeat_survey_btn_text = $lang['survey_1090'];

// If there is an email attachment, then get the uploaded filename of the attachment
if (is_numeric($confirmation_email_attachment)) {
	$q = db_query("select doc_name, doc_size from redcap_edocs_metadata
				   where delete_date is null and doc_id = ".prep($confirmation_email_attachment));
	// Set file size in MB
	$confirmation_email_attachment_size = round_up(db_result($q, 0, 'doc_size') / 1024 / 1024);
	$confirmation_email_attachment_filename = db_result($q, 0, 'doc_name') . " &nbsp;($confirmation_email_attachment_size MB)";
} else {
	$confirmation_email_attachment_filename = "";
}

## SURVEY FONTS
// Get survey fonts
$fonts = Survey::getFonts();
$nonLatinFonts = Survey::getNonLatinFontIndex();
// Loop through fonts and build LI elements
$surveyFontDropdownOptionsNonLatin = $surveyFontDropdownOptions = "";
foreach ($fonts as $font_num=>$this_font_text) {
	// Format the text name
	$this_font_display = str_replace("'", "", substr($this_font_text, 0, strpos($this_font_text, ",")));
	// Set HTML option
	if (in_array($font_num, $nonLatinFonts)) {
		// Non-Latin
		$surveyFontDropdownOptionsNonLatin .= "<option value='$font_num' style=\"font-size:18px;font-family:$this_font_text;\" ";
		if ($font_num."" === $font_family."") $surveyFontDropdownOptionsNonLatin .= "selected";
		$surveyFontDropdownOptionsNonLatin .= ">$this_font_display</option>";
	} else {
		// Latin
		$surveyFontDropdownOptions .= "<option value='$font_num' style=\"font-size:18px;font-family:$this_font_text;\" ";
		if ($font_num."" === $font_family."") $surveyFontDropdownOptions .= "selected";
		$surveyFontDropdownOptions .= ">$this_font_display</option>";
	}
}
$surveyFontDropdownOptions =   "<optgroup label='".cleanHtml($lang['survey_1064'])."'>
								<option value='' style=\"font-size:18px;\" "
								. ($font_family == '' ? "selected" : "") . ">Arial</option>
								$surveyFontDropdownOptions								
								</optgroup>
								<optgroup label='".cleanHtml($lang['survey_1065'])."'>								
								$surveyFontDropdownOptionsNonLatin
								</optgroup>";
$surveyFontDropdown = "<select id='font_family' name='font_family' class='x-form-text x-form-field' style='' onchange='updateThemeIframe();'>"
					. "$surveyFontDropdownOptions</select>";

## SURVEY THEMES
$customizeThemeBtnDisabled = ($theme == '' && $theme_bg_page != '' ? 'disabled' : '');
$survey_themes_dropdown = Survey::renderSurveyThemeDropdown($theme, ($theme == '' && $theme_bg_page != ''));
$userHasCustomThemes = Survey::userHasCustomThemes();

$showCopyDesignOptions = (count($Proj->surveys) > (is_numeric($_GET['survey_id']) ? 1 : 0));


?>
<!-- TinyMCE Rich Text Editor -->
<script type="text/javascript" src="<?php echo APP_PATH_MCE ?>tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	editor_deselector: "tinyNoEditor",
	relative_urls : false,
	mode : "textareas",
	theme : "advanced",
	plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,forecolor,backcolor,separator,justifyleft,justifycenter,justifyright,justifyfull,|,hr,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,code",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,tablecontrols,separator,undo,redo",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "bottom",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	// Skin options
	skin : "o2k7",
	skin_variant : "silver"
});
</script>

<form id="survey_settings" action="<?php echo $_SERVER['REQUEST_URI'] . ((isset($_GET['redirectInvite']) && $_GET['redirectInvite']) ? "&redirectInvite=1" : "") ?>" method="post" enctype="multipart/form-data">
	<table cellspacing="3" style="width:100%;">
		<?php if (PAGE == 'Surveys/edit_info.php') { ?>
		<!-- Make survey active or offline (only when editing surveys) -->
		<tr>
			<td colspan="3">
				<div id="survey_enabled_div" class="<?php echo($survey_enabled ? 'darkgreen' : 'red') ?>" style="max-width:900px;margin: -5px -7px 0px;font-size:12px;">
					<div style="float:left;width:300px;font-weight:bold;padding:5px 0 0 25px;">
						<?php echo $lang['survey_374'] ?>
					</div>
					<div style="float:left;">
						<img id="survey_enabled_img" style="margin-right:5px;" src="<?php echo APP_PATH_IMAGES . ($survey_enabled ? "accept.png" : "delete.png") ?>">
						<select name="survey_enabled" class="x-form-text x-form-field" style="margin-bottom:3px;"
							onchange="if ($(this).val()=='1'){ $('#survey_enabled_img').attr('src',app_path_images+'accept.png');$('#survey_enabled_div').removeClass('red').addClass('darkgreen'); } else { $('#survey_enabled_img').attr('src',app_path_images+'delete.png');$('#survey_enabled_div').removeClass('darkgreen').addClass('red'); }">
							<option value="1" <?php echo ( $survey_enabled ? 'selected' : '') ?>><?php echo $lang['survey_376'] ?></option>
							<option value="0" <?php echo (!$survey_enabled ? 'selected' : '') ?>><?php echo $lang['survey_375'] ?></option>
						</select><br>
						<span class="newdbsub" style="margin-left:26px;"><?php echo $lang['survey_377'] ?></span>
					</div>
					<div class="clear"></div>
				</div>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="3">
				<div class="header" style="padding:7px 10px 5px;margin:-5px -7px 10px;"><?php echo $lang['survey_1011'] ?></div>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>tag_orange.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_49'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:5px;">
				<input name="title" type="text" value="<?php echo str_replace('"', '&quot;', label_decode($title)) ?>" class="x-form-text x-form-field" style="width:80%;" onkeydown="if(event.keyCode==13){return false;}">
				<div class="newdbsub">
					<?php echo $lang['survey_50'] ?>
				</div>
			</td>
		</tr>

		<!-- Instructions -->
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>page_white_text.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_65'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_66'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<textarea style="width:98%;height:225px;" name="instructions"><?php echo $instructions ?></textarea>
				<!-- Piping link -->
				<div style="margin:5px 0 0;">
					<img src="<?php echo APP_PATH_IMAGES ?>pipe.png">
					<a href="javascript:;" style="font-weight:normal;color:#3E72A8;text-decoration:underline;" onclick="pipingExplanation();"><?php echo $lang['design_463'] ?></a>
				</div>
			</td>
		</tr>

		<!-- Themes and text size -->
		<tr>
			<td colspan="3">
				<div class="header" style="padding:7px 10px 10px;margin:-5px -7px 10px;">
				<?php
				print 	RCView::div(array('style'=>'float:left;margin-top:4px;'),
							$lang['survey_291']
						) .
						(!$showCopyDesignOptions ? '' :
							RCView::div(array('style'=>'float:right;margin:0 10px 5px 0;'),
								// Save theme button
								RCView::button(array('class'=>'jqbuttonmed', 'style'=>'', 'onclick'=>"openCopyDesignSettingsPopup();return false;"),
									RCView::img(array('src'=>'blogs_arrow.png', 'style'=>'position:relative;top:-1px;vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'), $lang['survey_1042'])
								)
							)
						) .
						RCView::br();
				?>
				</div>
			</td>
		</tr>

		<!-- Logo -->
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>picture.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding:0 0 10px 0;">
				<?php echo $lang['survey_59'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_60'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding:0 0 10px 0;padding-left:15px;padding-bottom:15px;">
				<input type="hidden" name="old_logo" id="old_logo" value="<?php echo $logo ?>">
				<div id="old_logo_div" style=";color:#555;font-size:12px;display:<?php echo (!empty($logo) ? "block" : "none") ?>">
					<?php echo $lang['survey_61'] ?> &nbsp;
					<a href="javascript:;" style="font-size:12px;color:#A00000;text-decoration:none;" onclick='
						if (confirm("<?php echo cleanHtml(cleanHtml2($lang['survey_757'])) ?>")) {
							$("#new_logo_div").css({"display":"block"});
							$("#old_logo_div").css({"display":"none"});
							$("#old_logo").val("");
						}
					'>[X] <?php echo $lang['survey_62'] ?></a>
					<br>
					<img src="<?php echo APP_PATH_WEBROOT ?>DataEntry/image_view.php?pid=<?php echo $project_id ?>&doc_id_hash=<?php echo Files::docIdHash($logo) ?>&id=<?php echo $logo ?>" alt="[IMAGE]" title="[IMAGE]" style="max-width:500px; expression(this.width > 500 ? 500 : true);">
				</div>
				<div id="new_logo_div" style="color:#555;font-size:12px;display:<?php echo (empty($logo) ? "block" : "none") ?>">
					<?php echo $lang['survey_63'] ?><br>
					<input type="file" name="logo" id="logo_id" size="30" style="font-size:13px;" onchange="checkLogo(this.value);">
					<div style="color:#777;font-size:11px;padding:2px 0 0;">
						<?php echo $lang['design_198'] ?>
					</div>
				</div>
				<div id="hide_title_div" style="font-size:12px;padding:2px 0;">
					<input type="checkbox" name="hide_title" id="hide_title" <?php echo ($hide_title ? "checked" : "") ?>>
					<?php echo $lang['survey_64'] ?>
				</div>
			</td>
		</tr>

		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>ui-radio-buttons-list.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_1072'] ?>
				<div style="font-weight:normal;padding-bottom:10px;">
					<i><?php echo $lang['survey_1077'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<select id="enhanced_choices" name="enhanced_choices" class="x-form-text x-form-field" style="" onchange="updateThemeIframe();">
					<option value="0" <?php echo ($enhanced_choices == '0' ? 'selected' : '') ?>><?php echo $lang['survey_1073'] ?></option>
					<option value="1" <?php echo ($enhanced_choices == '1' ? 'selected' : '') ?>><?php echo $lang['survey_1074'] ?></option>
				</select>
				<a href="javascript:;" onclick="simpleDialog(null,null,'enhanced_choices_example',720);" style="font-size:11px;text-decoration:underline;margin-left:15px;"><?php print $lang['survey_1075'] ?></a>
				<div id="enhanced_choices_example" class="simpleDialog" title="<?php echo cleanHtml2($lang['survey_1074']) ?>">
					<?php print $lang['survey_1076'] ?>
					<p><img src="<?php echo APP_PATH_IMAGES ?>enhanced_choices_example.png" style="max-width:100%;"></p>
				</div>
			</td>
		</tr>

		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>font_add.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_1012'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<select id="text_size" name="text_size" class="x-form-text x-form-field" style="" onchange="updateThemeIframe();">
					<option value=""  <?php echo ($text_size == '' 	? 'selected' : '') ?>><?php echo $lang['survey_1013'] ?></option>
					<option value="1" <?php echo ($text_size == '1' ? 'selected' : '') ?>><?php echo $lang['survey_1014'] ?></option>
					<option value="2" <?php echo ($text_size == '2' ? 'selected' : '') ?>><?php echo $lang['survey_1015'] ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>font_type.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_1018'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<?php echo $surveyFontDropdown; ?>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>themes.png" style="width:16px;height:16px;">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_1016'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:5px;">
				<?php
				print 	RCView::span(array('id'=>'theme_parent'), $survey_themes_dropdown) .
						RCView::button(array('id'=>'showCustomThemeOptionsBtn', 'class'=>'jqbuttonmed', 'style'=>'margin-left:20px;', $customizeThemeBtnDisabled=>$customizeThemeBtnDisabled,
							'onclick'=>"showCustomThemeOptions();return false;"), $lang['survey_1032']) .
						RCView::span(array('id'=>'cancelCustomThemeOptionsBtn', 'style'=>($theme == '' && $theme_bg_page != '' ? '' : 'visibility:hidden;').'margin-left:10px;'),
							RCView::img(array('src'=>'cross_small2.png')) .
							RCView::a(array('href'=>'javascript:;', 'style'=>'font-size:11px;text-decoration:underline;color:#800000;',
								'onclick'=>"cancelCustomThemeOptions();return false;"), $lang['survey_1033'])
						);
				?>
			</td>
		</tr>
		<?php

		// Custom theme spectrum widgets
		$custom_theme_opts = RCView::table(array('style'=>'margin:3px 0;padding:6px 0;width:100%;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;', 'cellpadding'=>0, 'cellspacing'=>0),
								RCView::tr(array(),
									// Page bg and button text
									RCView::td(array('style'=>'padding:3px 0 5px 22px;border-right:1px solid #ccc;'),
										RCView::div(array('style'=>'font-weight:bold;margin-bottom:5px;'), $lang['survey_1030']) .
										RCView::div(array('style'=>'float:left;width:110px;padding-top:8px;'), $lang['survey_1028']) .
										RCView::div(array('style'=>'float:left;'), RCView::input(array('name'=>'theme_bg_page', 'type'=>'text', 'size'=>4))) .
										RCView::div(array('style'=>'clear:both;float:left;width:110px;padding-top:10px;'), $lang['survey_1029']) .
										RCView::div(array('style'=>'float:left;padding-top:2px;'), RCView::input(array('name'=>'theme_text_buttons', 'type'=>'text', 'size'=>4)))
									) .
									// Title & instructions
									RCView::td(array('style'=>'padding:3px 0 5px 8px;border-right:1px solid #ccc;'),
										RCView::div(array('style'=>'font-weight:bold;margin-bottom:5px;'), $lang['survey_1025']) .
										RCView::div(array('style'=>'float:left;width:110px;padding-top:8px;'), $lang['folders_08']) .
										RCView::div(array('style'=>'float:left;'), RCView::input(array('name'=>'theme_text_title', 'type'=>'text', 'size'=>4))) .
										RCView::div(array('style'=>'clear:both;float:left;width:110px;padding-top:10px;'), $lang['folders_09']) .
										RCView::div(array('style'=>'float:left;padding-top:2px;'), RCView::input(array('name'=>'theme_bg_title', 'type'=>'text', 'size'=>4)))
									) .
									// Section headers
									RCView::td(array('style'=>'padding:3px 0 5px 8px;border-right:1px solid #ccc;'),
										RCView::div(array('style'=>'font-weight:bold;margin-bottom:5px;'), $lang['survey_1027']) .
										RCView::div(array('style'=>'float:left;width:110px;padding-top:8px;'), $lang['folders_08']) .
										RCView::div(array('style'=>'float:left;'), RCView::input(array('name'=>'theme_text_sectionheader', 'type'=>'text', 'size'=>4))) .
										RCView::div(array('style'=>'clear:both;float:left;width:110px;padding-top:10px;'), $lang['folders_09']) .
										RCView::div(array('style'=>'float:left;padding-top:2px;'), RCView::input(array('name'=>'theme_bg_sectionheader', 'type'=>'text', 'size'=>4)))
									) .
									// Questions
									RCView::td(array('style'=>'padding:3px 0 5px 8px;'),
										RCView::div(array('style'=>'font-weight:bold;margin-bottom:5px;'), $lang['survey_1026']) .
										RCView::div(array('style'=>'float:left;width:110px;padding-top:8px;'), $lang['folders_08']) .
										RCView::div(array('style'=>'float:left;'), RCView::input(array('name'=>'theme_text_question', 'type'=>'text', 'size'=>4))) .
										RCView::div(array('style'=>'clear:both;float:left;width:110px;padding-top:10px;'), $lang['folders_09']) .
										RCView::div(array('style'=>'float:left;padding-top:2px;'), RCView::input(array('name'=>'theme_bg_question', 'type'=>'text', 'size'=>4)))
									)
								)
							);

		print 	RCView::tr(array('id'=>'row_custom_theme', 'style'=>($theme_bg_page == '' ? 'display:none;' : '')),
					RCView::td(array('colspan'=>'3', 'style'=>'padding:10px 0 0;'),
						RCView::div(array('style'=>'font-weight:bold;font-size:13px;color:#800000;margin-bottom:4px;'),
							$lang['survey_1031']
						) .
						$custom_theme_opts .
						RCView::div(array('style'=>'margin:10px 0 10px 25px;'),
							// Save theme button
							RCView::button(array('id'=>'openSaveThemePopupBtn', 'class'=>'jqbuttonsm', 'style'=>'font-size:11px;color:green;',
								'onclick'=>"openSaveThemePopup();return false;"),
								RCView::img(array('src'=>'plus_small2.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'), $lang['survey_1034'])
							) .
							RCView::button(array('id'=>'openManageThemePopupBtn', 'class'=>'jqbuttonsm', 'style'=>($userHasCustomThemes ? '' : 'display:none;').'margin-left:10px;font-size:11px;',
								'onclick'=>"openManageThemesPopup();return false;"),
								RCView::img(array('src'=>'pencil_small2.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'), $lang['survey_1041'])
							)
						)
					)
				);
		?>
		<tr>
			<td colspan=3 valign="top" style="padding:10px 5px 13px 24px;">
				<div style="padding-bottom:2px;">
					<div style="float:left;"><?php echo $lang['survey_1020'] ?></div>
					<div style="float:right;"><a href="javascript:;" onclick="$('#survey_theme_design').height(500);" style="text-decoration:underline;"><?php echo $lang['form_renderer_19'] ?></a></div>
					<div style="clear:both;"></div>
				</div>
				<iframe id="survey_theme_design" style="width:100%;max-width:98%;height:200px;border:1px solid #ccc;" src="<?php echo APP_PATH_WEBROOT ?>Surveys/theme_view.php?pid=<?php echo $project_id ?>&iframe=1&font_family=<?php echo $font_family ?>&theme=<?php echo $theme ?>&text_size=<?php echo $text_size ?>&enhanced_choices=<?php echo $enhanced_choices ?>&theme_text_buttons=<?php echo $theme_text_buttons ?>&theme_bg_page=<?php echo $theme_bg_page ?>&theme_text_title=<?php echo $theme_text_title ?>&theme_bg_title=<?php echo $theme_bg_title ?>&theme_text_sectionheader=<?php echo $theme_text_sectionheader ?>&theme_bg_sectionheader=<?php echo $theme_bg_sectionheader ?>&theme_text_question=<?php echo $theme_text_question ?>&theme_bg_question=<?php echo $theme_bg_question ?>"></iframe>
			</td>
		</tr>

		<!-- Survey Customizations -->
		<tr>
			<td colspan="3">
				<div class="header" style="padding:7px 10px 5px;margin:0 -7px 10px;"><?php echo $lang['survey_647'] ?></div>
			</td>
		</tr>
		<?php
		if ($isPromisInstrument) {
			print	RCView::tr(array(),
						RCView::td(array('colspan'=>3, 'style'=>'padding:5px 0 10px;'),
							RCView::div(array('colspan'=>3, 'class'=>'darkgreen', 'style'=>'margin:0 20px;padding:5px 8px 8px;'),
								RCView::div(array('style'=>'font-weight:bold;margin:3px 0;color:green;'),
									RCView::img(array('src'=>'flag_green.png', 'style'=>'vertical-align:middle;')) .
									RCView::span(array('style'=>'vertical-align:middle;'),
										($isAutoScoringInstrument ? $lang['data_entry_258'] : $lang['survey_557']))
								) .
								RCView::div(array('style'=>'margin-bottom:10px;'),
									($isAutoScoringInstrument ? $lang['data_entry_259'] : $lang['data_entry_220'])
								) .
								RCView::div(array('style'=>'font-weight:bold;'),
									$lang['survey_954'] .
									RCView::select(array('class'=>'x-form-text x-form-field', 'style'=>'margin:0 4px 0 30px;', 'name'=>'promis_skip_question'),
										array(0=>$lang['design_99'], 1=>$lang['design_100']),
										$promis_skip_question
									) .
									RCView::span(array('style'=>'font-weight:normal;font-size:10px;font-family:tahoma;'),
										$lang['survey_558']
									)
								)
							)
						)
					);
		}
		?>

		<tr id="question_auto_numbering-tr">
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>text_list_numbers.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_51'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<select name="question_auto_numbering" <?php if (isset($hasBranching) && $hasBranching) echo "disabled" ?> class="x-form-text x-form-field" style="">
					<option value="1" <?php echo ( $question_auto_numbering ? 'selected' : '') ?>><?php echo $lang['survey_52'] ?></option>
					<option value="0" <?php echo (!$question_auto_numbering ? 'selected' : '') ?>><?php echo $lang['survey_53'] ?></option>
				</select>
				<?php if (isset($hasBranching) && $hasBranching) { ?>
					<div class="cc_info" style="color:#C00000;line-height:11px;">
						<?php echo $lang['survey_06'] ?>
					</div>
				<?php } ?>
			</td>
		</tr>

		<tr id="question_by_section-tr">
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>table_gear.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_54'] ?>
				<div style="font-weight:normal;"><i><?php echo $lang['survey_645'] ?></i></div>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:10px;">
				<select name="question_by_section" class="x-form-text x-form-field" style="" onchange="
					// Uncheck edit completed response checkbox if set to No
					if (this.value == '0') {
						$('input[name=display_page_number], input[name=hide_back_button]').prop('checked', false);
						$('#display_page_number-div, #hide_back_button-div').addClass('opacity35');
					} else {
						$('#display_page_number-div, #hide_back_button-div').removeClass('opacity35');
					}
				">
					<option value="0" <?php echo (!$question_by_section ? 'selected' : '') ?>><?php echo $lang['survey_55'] ?></option>
					<option value="1" <?php echo ( $question_by_section ? 'selected' : '') ?>><?php echo $lang['survey_56'] . " " . $lang['survey_646'] ?></option>
				</select>
				<?php
				// Display the page number?
				$display_page_number_checked = ($question_by_section && $display_page_number) ? "checked" : "";
				$display_page_number_opacity = ($question_by_section) ? "" : "opacity35";
				print 	RCView::div(array('id'=>'display_page_number-div', 'style'=>'margin:5px 0;color:#333;', 'class'=>$display_page_number_opacity),
							RCView::checkbox(array('name'=>'display_page_number', $display_page_number_checked=>$display_page_number_checked)) .
							$lang['survey_644']
						);
				// Display the BACK button
				$hide_back_button_checked = ($question_by_section && $hide_back_button) ? "checked" : "";
				$hide_back_button_opacity = ($question_by_section) ? "" : "opacity35";
				print 	RCView::div(array('id'=>'hide_back_button-div', 'style'=>'margin:5px 0;color:#333;', 'class'=>$hide_back_button_opacity),
							RCView::checkbox(array('name'=>'hide_back_button', $hide_back_button_checked=>$hide_back_button_checked)) .
							$lang['survey_750'] .
							RCView::div(array('style'=>'margin-left: 1.8em;color:#888;font-size:11px;'),
								$lang['survey_751']
							)
						);
				?>
			</td>
		</tr>

		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>star_red.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_752'] ?>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:15px;">
				<select name="show_required_field_text" class="x-form-text x-form-field" style="">
					<option value="0" <?php echo (!$show_required_field_text ? 'selected' : '') ?>><?php echo $lang['design_99'] ?></option>
					<option value="1" <?php echo ($show_required_field_text  ? 'selected' : '') ?>><?php echo $lang['design_100'] ?></option>
				</select>
				<div class="cc_info" style="">
					<?php echo $lang['survey_753'] ?>
					<span class="requiredlabel">* <?php echo $lang['data_entry_39'] ?></span>
				</div>
			</td>
		</tr>

		<!-- View Results -->
		<?php if ($enable_plotting_survey_results) { ?>
		<tr id="view_results-tr">
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>chart_bar.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding:0 0 10px 0;">
				<?php echo $lang['survey_184'] ?>
				<div style="margin-top:5px;color:#666;font-family:tahoma,arial;font-size:9px;font-weight:normal;">
					<?php echo $lang['survey_185'] ?>
				</div>
			</td>
			<td valign="top" style="padding:0 0 10px 0;padding-left:15px;padding-bottom:25px;">
				<table cellpadding=0 cellspacing=0>
					<tr>
						<td colspan="2" valign="top" style="padding-bottom:15px;">
							<select id="view_results" name="view_results" class="x-form-text x-form-field" style=""
								onchange="if (this.value != '0' && $('#survey_termination_options_url').prop('checked')){ setTimeout(function(){ $('#view_results').val('0'); },10);simpleDialog('<?php echo cleanHtml2($lang['survey_303']) ?>','<?php echo cleanHtml2($lang['survey_302']) ?>');}">
								<option value="0" <?php echo ($view_results == '0' ? 'selected' : '') ?>><?php echo $lang['global_23'] ?></option>
								<!-- Plots only -->
								<option value="1" <?php echo ($view_results == '1' ? 'selected' : '') ?>><?php echo $lang['survey_203'] ?></option>
								<!-- Stats only -->
								<option value="2" <?php echo ($view_results == '2' ? 'selected' : '') ?>><?php echo $lang['survey_204'] ?></option>
								<!-- Plots + Stats -->
								<option value="3" <?php echo ($view_results == '3' ? 'selected' : '') ?>><?php echo $lang['survey_205'] ?></option>
							</select>
						</td>
					</tr>
					<tr class="view_results_options">
						<td valign="top" colspan="3" style="color:#444;font-weight:bold;padding:2px 0 3px;">
							<?php echo $lang['survey_188'] ?>
						</td>
					</tr>
					<tr class="view_results_options">
						<td valign="top" style="text-align:right;padding:5px 0;">
							<input name="min_responses_view_results" type="text" value="<?php echo $min_responses_view_results ?>" class="x-form-text x-form-field" style="width:20px;" maxlength="4" onkeydown="if(event.keyCode==13){return false;}" onblur="redcap_validate(this,'1','9999','soft_typed','int')">
						</td>
						<td valign="top" style="padding:5px 0;padding-left:15px;color:#444;">
							<?php echo $lang['survey_187'] ?>
						</td>
					</tr>
					<tr class="view_results_options">
						<td valign="top" style="text-align:right;">
							<input type="checkbox" name="check_diversity_view_results" id="check_diversity_view_results" <?php echo ($check_diversity_view_results ? "checked" : "") ?>>
						</td>
						<td valign="top" style="padding-left:15px;color:#444;">
							<?php echo $lang['survey_186'] ?><br>
							(<a href="javascript:;" style="text-decoration:underline;font-size:10px;font-family:tahoma;" onclick="
								$('#diversity_explain').dialog({ bgiframe: true, modal: true, width: 500,
									buttons: { Okay: function() { $(this).dialog('close'); } }
								});
							"><?php echo $lang['survey_189'] ?></a>)
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?php } ?>

		<!-- Text-To-Speech -->
		<?php if ($enable_survey_text_to_speech) { ?>
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>text_to_speech.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding-bottom:15px;">
				<?php echo $lang['survey_984'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_985'] ?></i>
				</div>
				<div class="cc_info" style="margin-top:8px;line-height:11px;">
					<?php echo $lang['survey_986'] ?>
				</div>
			</td>
			<td valign="top" style="padding:0 0 10px 15px;">
				<div style="">
					<select name="text_to_speech" class="x-form-text x-form-field" style="" onchange="
						if (this.value != '0') {
							$('#text_to_speech_language_div').removeClass('opacity50');
							$('#text_to_speech_language').prop('disabled', false);
						} else {
							$('#text_to_speech_language_div').addClass('opacity50');
							$('#text_to_speech_language').prop('disabled', true);
						}
					">
						<option value="0" <?php echo (!$text_to_speech == '0' ? 'selected' : '') ?>><?php echo $lang['global_23'] ?></option>
						<option value="1" <?php echo ($text_to_speech == '1'  ? 'selected' : '') ?>><?php echo $lang['system_config_27'] . " " . $lang['survey_995'] ?></option>
						<option value="2" <?php echo ($text_to_speech == '2'  ? 'selected' : '') ?>><?php echo $lang['system_config_27'] . " " . $lang['survey_996'] ?></option>
					</select>
				</div>

				<!-- Add hidden input to preserve current language until pay TTS service is used -->
				<input type="hidden" name="text_to_speech_language" value="<?php print $text_to_speech_language ?>">
				<!--
				<div id="text_to_speech_language_div" <?php if (!$text_to_speech) print 'class="opacity50"'; ?> style="margin-top:15px;">
					<?php
					$text_to_speech_language_disabled = ($text_to_speech ? "" : "disabled");
					echo RCView::b($lang['survey_988']);
					echo RCView::select(array('id'=>'text_to_speech_language', 'name'=>'text_to_speech_language', $text_to_speech_language_disabled=>$text_to_speech_language_disabled,
						'class'=>'x-form-text x-form-field', 'style'=>'margin-left:8px;'),
						Survey::getTextToSpeechLanguages(), $text_to_speech_language) . RCView::br();
					echo RCView::span(array('style'=>'line-height:22px;margin-left:5px;font-size:11px;color:#888;'), $lang['survey_991'])
					?>
				</div>
				-->
				<div class="cc_info" style="color:#800000;margin-top:15px;">
					<?php echo $lang['survey_1009'] ?>
					<?php if (SUPER_USER) { ?>
						<a href="javascript:;" onclick="simpleDialog('<?php echo cleanHtml($lang['survey_987']) ?>','<?php echo cleanHtml($lang['survey_990']) ?>');" style="display:block;text-decoration:underline;"><?php echo $lang['survey_990'] ?></a>
					<?php } ?>
				</div>
			</td>
		</tr>
		<?php } ?>


		<!-- Survey Access -->
		<tr>
			<td colspan="3">
				<div class="header" style="padding:7px 10px 5px;margin:0 -7px 10px;"><?php echo $lang['survey_293'] ?></div>
			</td>
		</tr>

		<!-- Survey Expiration -->
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>calendar_exclamation.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_294'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_295'] ?></i>
					<a href="javascript:;" onclick="simpleDialog('<?php echo cleanHtml($lang['survey_299']) ?>','<?php echo cleanHtml($lang['survey_294']) ?>')"><img src="<?php echo APP_PATH_IMAGES ?>help.png" style="vertical-align:middle;"></a>
				</div>
			</td>
			<td valign="top" style="padding:0 0 5px 15px;">
				<input id="survey_expiration" name="survey_expiration" type="text" style="width:103px;" class="x-form-text x-form-field"
					onblur="redcap_validate(this,'','','hard','datetime_'+user_date_format_validation,1,1,user_date_format_delimiter)"
					value="<?php echo $survey_expiration ?>"
					onkeydown="if(event.keyCode==13){return false;}"
					onfocus="this.value=trim(this.value); if(this.value.length == 0 && $('.ui-datepicker:first').css('display')=='none'){$(this).next('img').trigger('click');}">
				<span class='df'><?php echo DateTimeRC::get_user_format_label() ?> H:M</span>
				<div class="cc_info">
					<?php echo $timezoneText ?>
				</div>
			</td>
		</tr>

		<?php
		// If SURVEY LOGIN is enabled for SELECTED surveys, then give choice to use Survey Login for this survey
		if ($survey_auth_enabled && !$survey_auth_apply_all_surveys) { ?>
		<!-- Survey Login -->
		<tr>
			<td valign="top" style="width:20px;padding:10px 0;">
				<img src="<?php echo APP_PATH_IMAGES ?>key.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding:10px 0;">
				<?php echo $lang['survey_618'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_638'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding:10px 0;padding-left:15px;">
				<select name="survey_auth_enabled_single" class="x-form-text x-form-field" style="" onchange="
					if (this.value == '1') {
						$('#survey-login-note-save-return').show('fade');
					} else {
						$('#survey-login-note-save-return').hide('fade');
					}
				">
					<option value="0" <?php echo (!$survey_auth_enabled_single ? 'selected' : '') ?>><?php echo $lang['design_99'] ?></option>
					<option value="1" <?php echo ($survey_auth_enabled_single  ? 'selected' : '') ?>><?php echo $lang['design_100'] ?></option>
				</select>
				<div class="cc_info">
					<?php echo $lang['survey_636'] ?>
				</div>
				<?php
				// If this survey is the first survey, add reminder that Survey Login won't work for Public Surveys or if the record doesn't exist yet
				if (is_numeric($survey_id) && $survey_id == $Proj->firstFormSurveyId) { ?>
					<div class="cc_info" style="margin-top:8px;color:#800000;">
						<?php echo $lang['survey_639'] ?>
					</div>
				<?php } ?>
			</td>
		</tr>
		<?php } else { ?>
			<input type="hidden" name="survey_auth_enabled_single" value="<?php echo $survey_auth_enabled_single ?>">
		<?php } ?>

		<!-- SAVE AND RETURN LATER -->
		<tr id="save_and_return-tr">
			<td valign="top" style="width:20px;padding:10px 0;">
				<img src="<?php echo APP_PATH_IMAGES ?>arrow_circle_315.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding:10px 0;">
				<?php echo $lang['survey_57'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_304'] ?></i>
					<a href="javascript:;" onclick="simpleDialog('<?php echo cleanHtml($lang['survey_637']) ?>','<?php echo cleanHtml($lang['survey_57']) ?>')"><img src="<?php echo APP_PATH_IMAGES ?>help.png" style="vertical-align:middle;"></a>
				</div>
			</td>
			<td valign="top" style="padding:10px 0;padding-left:15px;">
				<select name="save_and_return" class="x-form-text x-form-field" style="" onchange="
					// Uncheck edit completed response checkbox if set to No
					if (this.value == '0') {
						$('input[name=edit_completed_response]').prop('checked', false);
					}
				">
					<option value="0" <?php echo (!$save_and_return ? 'selected' : '') ?>><?php echo $lang['design_99'] ?></option>
					<option value="1" <?php echo ($save_and_return  ? 'selected' : '') ?>><?php echo $lang['design_100'] ?></option>
				</select>
				<?php
				// Allow respondents to edit completed responses?
				$edit_completed_response_checked = ($save_and_return && $edit_completed_response) ? "checked" : "";
				print 	RCView::div(array('style'=>'font-weight:bold;margin-top:10px;color:#333;'),
							RCView::checkbox(array('name'=>'edit_completed_response', $edit_completed_response_checked=>$edit_completed_response_checked, "onclick"=>"
								if ($(this).prop('checked') && $('select[name=save_and_return]').val() == '0') {
									$(this).prop('checked', false);
									simpleDialog('".cleanHtml($lang['survey_660'])."');
								}
							")) .
							$lang['survey_640'] .
							RCView::a(array('href'=>'javascript:;', 'style'=>'margin-left:3px;', 'onclick'=>"simpleDialog('".prep($lang['survey_643'])."','".prep($lang['survey_640'])."');"),
								RCView::img(array('src'=>'help.png'))
							)
						);
				// If Survey Login is enabled for ALL surveys or JUST this one, then put note that Survey Login will be used instead of Return Codes
				print 	RCView::div(array('id'=>'survey-login-note-save-return', 'style'=>(($survey_auth_enabled && ($survey_auth_apply_all_surveys || $survey_auth_enabled_single)) ? '' : 'display:none;').'color:#865200;margin-top:10px;text-indent:-1.7em;margin-left:1.8em;'),
							RCView::img(array('src'=>'key.png', 'style'=>'top:6px;')) .
							($survey_auth_apply_all_surveys ? $lang['survey_617'] : $lang['survey_635'])
						);
				?>
			</td>
		</tr>


		<tr>
			<td colspan="3">
				<div class="header" style="padding:7px 10px 5px;margin:0 -7px 10px;"><?php echo $lang['survey_290'] ?></div>
			</td>
		</tr>

		

		<!-- AUTOCONTINUE -->
		<tr>
			<td valign="top" style="width:20px;">
					<input type="checkbox" style="position:relative;top:-3px;" id="end_survey_redirect_next_survey" name="end_survey_redirect_next_survey" <?php echo (isset($end_survey_redirect_next_survey) && $end_survey_redirect_next_survey == '1' ? 'checked' : '') ?>>
			</td>
			<td valign="top" style="width:200px;padding-bottom:3px;" colspan=2>
				<?php echo RCView::b($lang['survey_1002']) . " " . $lang['survey_999'] ?>
				<a href="javascript:;" onclick="$('#end_survey_redirect_next_survey_explain').toggle('fade');"><img src="<?php echo APP_PATH_IMAGES ?>help.png" style="vertical-align:middle;position:relative;top:-1px;"></a>
				<div id="end_survey_redirect_next_survey_explain" class="cc_info" style="display:none;font-size:12px;line-height:13px;">
					<?php echo $lang['survey_1000'] ?>
				</div>
			</td>
		</tr>

		<!-- OTHERWISE  -->
		<tr>
			<td valign="top" colspan="3" style="padding:10px 0px 16px 8px;color:#777;">
				&mdash; <?php echo $lang['global_123'] ?> &mdash;
			</td>
		</tr>

		<!-- End Survey Redirect URL -->
		<tr>
			<td valign="top" style="width:20px;">
				<input type="radio" id="survey_termination_options_url" name="survey_termination_options" value="url" <?php echo ($end_survey_redirect_url != '' ? 'checked' : '') ?>
					onclick="$('#repeat_survey_enabled').prop('checked',false);$('#end_survey_redirect_url').focus();">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding-bottom:3px;">
				<?php echo $lang['survey_288'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_292'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding-left:15px;">
				<input id="end_survey_redirect_url" name="end_survey_redirect_url" type="text" onblur="isUrlError(this);if(this.value==''){$('#survey_termination_options_text').prop('checked',true);}else if($('#view_results').val() != '0'){ $('#view_results').val('0');simpleDialog('<?php echo cleanHtml2($lang['survey_301']) ?>','<?php echo cleanHtml2($lang['survey_300']) ?>','',600); }" onfocus="$('#survey_termination_options_url').prop('checked',true);" value="<?php echo str_replace('"', '&quot;', label_decode($end_survey_redirect_url)) ?>" class="x-form-text x-form-field" style="width:88%;" onkeydown="if(event.keyCode==13){return false;}">
				<div class="cc_info" style="margin:0;color:#777;">
					<?php echo $lang['survey_289'] ?>
				</div>
				<!-- Piping link -->
				<div style="margin:5px 0 0;">
					<img src="<?php echo APP_PATH_IMAGES ?>pipe_small.gif">
					<a href="javascript:;" style="font-size:11px;font-weight:normal;color:#3E72A8;text-decoration:underline;" onclick="pipingExplanation();"><?php echo $lang['design_463'] ?></a>
				</div>
			</td>
		</tr>

		<!-- OR -->
		<tr>
			<td valign="top" colspan="3" style="padding:0px 0px 12px 8px;color:#777;">
				&mdash; <?php echo $lang['global_46'] ?> &mdash;
			</td>
		</tr>
		
		<!-- REPEAT SURVEY (if repeating instrument is enabled for this instrument on any event) -->
		<?php if ($Proj->isRepeatingFormAnyEvent($_GET['page'])) { ?>
		<tr>
			<td valign="top" style="width:20px;padding:5px 0 12px;">
				<input type="checkbox" style="position:relative;top:-3px;" id="repeat_survey_enabled" name="repeat_survey_enabled" <?php echo (isset($repeat_survey_enabled) && $repeat_survey_enabled == '1' ? 'checked' : '') ?>
					onclick="if (this.checked) $('#repeat_survey_btn_text').focus();">
			</td>
			<td valign="top" style="width:200px;padding:5px 0 12px;" colspan=2>
				<?php echo RCView::b($lang['survey_1087']) . " " . $lang['survey_1088'] ?>
				<a href="javascript:;" onclick="$('#repeat_survey_enabled_explain').toggle('fade');"><img src="<?php echo APP_PATH_IMAGES ?>help.png" style="vertical-align:middle;position:relative;top:-1px;"></a>
				
				<div style="margin-top:2px;">
					<?php echo $lang['survey_1091'] ?>&nbsp;
					<input id="repeat_survey_btn_text" name="repeat_survey_btn_text" type="text"  value="<?php echo str_replace('"', '&quot;', label_decode($repeat_survey_btn_text)) ?>" class="x-form-text x-form-field" style="width:200px;" maxlength=255 onkeydown="if(event.keyCode==13){return false;}">
				</div>
				<div style="margin-top:2px;">
					<?php echo $lang['survey_1094'] ?>&nbsp;
					<select name="repeat_survey_btn_location" class="x-form-text x-form-field" style="max-width:500px;">
						<option value="BEFORE_SUBMIT" <?php echo ($repeat_survey_btn_location == 'BEFORE_SUBMIT' ? 'selected' : '') ?>><?php echo $lang['survey_1095'] ?></option>
						<option value="AFTER_SUBMIT" <?php echo ($repeat_survey_btn_location == 'AFTER_SUBMIT'  ? 'selected' : '') ?>><?php echo $lang['survey_1096'] ?></option>
					</select>
				</div>
				
				<div id="repeat_survey_enabled_explain" class="cc_info" style="display:none;font-size:12px;line-height:13px;">
					<?php echo $lang['survey_1089'] ?>
				</div>
			</td>
		</tr>
		<?php } else { ?>
			<input type="hidden" name="repeat_survey_enabled" value="<?php echo (isset($repeat_survey_enabled) && $repeat_survey_enabled == '1' ? '1' : '0') ?>">
		<?php } ?>

		<!-- Acknowledgement -->
		<tr>
			<td valign="top" style="width:20px;">
				<input type="radio" id="survey_termination_options_text" name="survey_termination_options" value="text" <?php echo ($end_survey_redirect_url == '' ? 'checked' : '') ?>>
			</td>
			<td valign="top" style="width:290px;font-weight:bold;">
				<?php echo $lang['survey_747'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_748'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding-left:15px;padding-bottom:20px;">
				<textarea style="width:98%;height:225px;" name="acknowledgement"><?php echo $acknowledgement ?></textarea>
				<!-- Piping link -->
				<div style="margin:5px 0 0;">
					<img src="<?php echo APP_PATH_IMAGES ?>pipe.png">
					<a href="javascript:;" style="font-weight:normal;color:#3E72A8;text-decoration:underline;" onclick="pipingExplanation();"><?php echo $lang['design_463'] ?></a>
				</div>
			</td>
		</tr>

		<!-- Survey confirmation email -->
		<tr>
			<td colspan="3" style="padding-bottom:15px;">
				<div class="spacer" style="border-color:#ddd;max-width:800px;"> </div>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width:20px;">
				<img src="<?php echo APP_PATH_IMAGES ?>email_go.png">
			</td>
			<td valign="top" style="width:290px;font-weight:bold;padding:0 0 10px 0;">
				<?php echo $lang['survey_755'] ?>
				<div style="font-weight:normal;">
					<i><?php echo $lang['survey_756'] ?></i>
				</div>
			</td>
			<td valign="top" style="padding:0 0 10px 0;padding-left:15px;padding-bottom:30px;">
				<div style="">
					<select id="confirmation_email_enable" class="x-form-text x-form-field" style="" onchange='
						if ($(this).val() == "1") {
							$("#confirmation_email_parent_div").show("fade");
						} else {
							var confirmEmailVal = $("#confirmation_email_subject").val().length
								+ $("#confirmation_email_content").val().length
								+ $("#confirmation_email_attachment").val().length
								+ $("#old_confirmation_email_attachment").val().length;
							if (confirmEmailVal == 0 || (confirmEmailVal > 0 && confirm("<?php echo cleanHtml(cleanHtml2($lang['survey_761'])) ?>"))) {
								$("#confirmation_email_parent_div, #old_confirmation_email_attachment_div").hide();
								$("#confirmation_email_subject, #confirmation_email_content, #confirmation_email_attachment, #old_confirmation_email_attachment").val("");
								$("#confirmation_email_attachment_div").show();
							}
						}
					'>
						<option value="0" <?php echo ($confirmation_email_content == '' ? "selected" : "") ?>><?php echo $lang['design_99'] ?></option>
						<option value="1" <?php echo ($confirmation_email_content != '' ? "selected" : "") ?>><?php echo $lang['design_100'] ?></option>
					</select>
				</div>
				<div id="confirmation_email_parent_div" style="padding-top:10px;margin-top:10px;border-top:1px dashed #ccc;display:<?php echo ($confirmation_email_content != '' ? "block" : "none") ?>;">
					<div style="margin-bottom:18px;font-size:11px;color:#666;padding-right:10px;">
						<?php echo $lang['survey_760'] ?>
						<!-- Piping link -->
						<span style="margin:0 0 0 10px;">
							<img src="<?php echo APP_PATH_IMAGES ?>pipe_small.gif">
							<a href="javascript:;" style="font-size:11px;font-weight:normal;color:#3E72A8;text-decoration:underline;" onclick="pipingExplanation();"><?php echo $lang['design_463'] ?></a>
						</span>
					</div>
					<div style="margin-bottom:8px;">
						<span style="vertical-align:middle;margin-right:20px;"><?php echo $lang['global_37'] ?></span>
						<?php print User::emailDropDownListAllUsers(isset($confirmation_email_from) ? $confirmation_email_from : '', true, 'confirmation_email_from', 'confirmation_email_from'); ?>
					</div>
					<div style="margin-bottom:8px;">
						<span style="vertical-align:middle;margin-right:8px;"><?php echo $lang['email_users_10'] ?></span>
						<input style="vertical-align:middle;max-width:350px;" id="confirmation_email_subject" name="confirmation_email_subject" type="text" value="<?php echo str_replace('"', '&quot;', label_decode($confirmation_email_subject)) ?>" class="x-form-text x-form-field" onkeydown="if(event.keyCode==13){return false;}">
					</div>
					<!-- Compose/Preview tabs -->
					<div class="textarea-preview-parent" message="#confirmation_email_content" subject="#confirmation_email_subject" from="#confirmation_email_from">
						<div id="sub-nav" class="textarea-preview-tab-parent"><ul>
							<li class="active"><a class="textarea-compose" href="javascript:;" onclick="toggleTextareaPreviewBtn(this,0)"><?php echo $lang['design_698'] ?></a></li>
							<li><a class="textarea-preview" href="javascript:;" onclick="toggleTextareaPreviewBtn(this,0)"><?php echo $lang['design_699'] ?></a></li>
							<li class="emailtest"><a href="javascript:;" onclick="textareaTestPreviewEmail(this,0);"><?php echo $lang['design_700'] ?></a></li>
						</ul></div>
					</div>
					<textarea class="x-form-field notesbox tinyNoEditor" style="height:85px;width:95%;" id="confirmation_email_content" name="confirmation_email_content"><?php echo $confirmation_email_content ?></textarea>
					<div id="confirmation_email_attachment_div" style="margin-top:5px;display:<?php echo ($confirmation_email_attachment == '' ? "block" : "none") ?>;">
						<span style="vertical-align:middle;margin-right:5px;">
							<img src="<?php echo APP_PATH_IMAGES ?>attach.png">
							<?php echo $lang['design_205'] ?>
						</span>
						<input style="vertical-align:middle;" type="file" id="confirmation_email_attachment" name="confirmation_email_attachment" >
						<input type="hidden" id="old_confirmation_email_attachment" name="old_confirmation_email_attachment" value="<?php echo $confirmation_email_attachment ?>">
					</div>
					<div id="old_confirmation_email_attachment_div" style="margin-top:5px;display:<?php echo ($confirmation_email_attachment != '' ? "block" : "none") ?>;">
						<span style="vertical-align:middle;margin-right:5px;">
							<img src="<?php echo APP_PATH_IMAGES ?>attach.png">
							<?php echo $lang['design_205'] ?>
						</span>
						<a target="_blank" href="<?php echo APP_PATH_WEBROOT . "DataEntry/file_download.php?pid=$project_id&doc_id_hash=".Files::docIdHash($confirmation_email_attachment)."&id=$confirmation_email_attachment" ?>" style="vertical-align:middle;text-decoration:underline;"><?php print $confirmation_email_attachment_filename ?></a>
						<a href="javascript:;" class="nowrap" style="vertical-align:middle;margin-left:15px;font-family:tahoma;font-size:10px;color:#800000;" onclick='
							if (confirm("<?php echo cleanHtml(cleanHtml2($lang['survey_758'])) ?>")) {
								$("#confirmation_email_attachment_div").show();
								$("#old_confirmation_email_attachment_div").hide();
								$("#old_confirmation_email_attachment").val("");
							}
						'>[X] <?php echo $lang['survey_759'] ?></a>
					</div>
				</div>
			</td>
		</tr>

		<!-- Save Button -->
		<tr>
			<td colspan="2" style="border-top:1px solid #ddd;"></td>
			<td valign="middle" style="border-top:1px solid #ddd;padding:20px 0 20px 15px;">
				<button class="btn btn-primary" style="font-weight:bold;" onclick='
					$("#confirmation_email_subject").val( trim($("#confirmation_email_subject").val()) );
					$("#confirmation_email_content").val( trim($("#confirmation_email_content").val()) );
					var confirmEmailVal = ($("#confirmation_email_subject").val() != "" &&  $("#confirmation_email_content").val() != "");
					if ($("#confirmation_email_enable").val() == "1" && !confirmEmailVal) {
						simpleDialog("<?php echo cleanHtml(cleanHtml2($lang['survey_762'])) ?>",null,null,null,function(){ $("#confirmation_email_subject").focus(); });
						return false;
					} else if ($("#confirmation_email_enable").val() == "0" && confirmEmailVal) {
						$("#confirmation_email_subject").val("");
						$("#confirmation_email_content").val("");
						$("#confirmation_email_attachment").val("");
					}
					$("#survey_settings").submit();
				'><?php print $lang['report_builder_28'] ?></button>
			</td>
		</tr>

		<!-- Cancel/Delete buttons -->
		<tr>
			<td colspan="2" style="border-top:1px solid #ddd;"></td>
			<td valign="middle" style="border-top:1px solid #ddd;padding:10px 0 20px 15px;">
				<button class="btn btn-defaultrc" onclick="history.go(-1)">-- <?php echo cleanHtml2($lang['global_53']) ?>--</button><br>
				<?php if (PAGE == 'Surveys/edit_info.php' && !$isPromisInstrument) { ?>
					<!-- Option to delete the survey (only when editing surveys - do NOT allow this for CATs since they only work in survey mode) -->
					<div style="margin:30px 0 10px;">
						<button class="btn btn-defaultrc btn-sm" style="color:#A00000;" onclick="deleteSurvey(<?php echo $_GET['survey_id'] ?>);return false;"><?php echo cleanHtml2($lang['survey_1070']) ?></button>
					</div>
					<!-- Info about what deleting a survey does -->
					<div style="margin-top:7px;font-size:11px;color:#777;line-height:11px;">
						<?php echo RCView::b($lang['survey_1070'].$lang['colon']) . ' ' . $lang['survey_381'] ?>
					</div>
				<?php } ?>
			</td>
		</tr>

	</table>
</form>

<!-- Hidden div for explaining the graphical diversity restriction setting -->
<div id="diversity_explain" style="display:none;" title="<?php echo cleanHtml2($lang['survey_189']) ?>">
	<p><?php echo "{$lang['survey_190']} <b>{$lang['survey_208']} <i style='color:#666;'>\"{$lang['survey_202']}\"</i></b>" ?></p>
	<p><?php echo $lang['survey_207'] ?></p>
</div>

<!-- Hidden div for copy design settings to other surveys -->
<div id="copyDesignSettingsPopup" style="display:none;" title="<?php echo cleanHtml2($lang['survey_1042']) ?>">
	<p><?php echo $lang['survey_1043'] ?></p>
	<table cellspacing=0 style="margin-top:20px;width:100%;table-layout:fixed;">
	<tr>
		<td valign="top" style="width:290px;">
			<b><?php echo $lang['survey_1045'] ?></b>
			<div class="hang">
				<span id="copy_design_logo_parent">
					<input type="checkbox" id="copy_design_logo" checked>
					<?php echo $lang['survey_59'] ?>
				</span><br>
				<span id="copy_design_logo_msg" style="color:#C00000;font-size:11px;"><?php echo $lang['survey_1047'] ?></span>
			</div>			
			<div class="hang">
				<input type="checkbox" id="copy_design_enhanced_choices" checked> <?php echo $lang['survey_1078'] ?>
			</div>			
			<div class="hang">
				<input type="checkbox" id="copy_design_text_size" checked> <?php echo $lang['survey_1012'] ?>
			</div>
			<div class="hang">
				<input type="checkbox" id="copy_design_font_family" checked> <?php echo $lang['survey_1018'] ?>
			</div>
			<div class="hang">
				<input type="checkbox" id="copy_design_theme" checked> <?php echo $lang['survey_1016'] . " " . $lang['survey_1050'] ?>
			</div>
		</td>
		<td valign="top" style="width:35px;text-align:right;padding-right:30px;">
			<img src="<?php echo APP_PATH_IMAGES ?>arrow.png" style="margin-bottom:50px;"><br>
			<img src="<?php echo APP_PATH_IMAGES ?>arrow.png">
		</td>
		<td valign="top" id="copy_design_survey_select">
			<b style="margin-right:10px;"><?php echo $lang['survey_1046'] ?></b>
			<span style="color:#999;font-size:14px;">
				(<a href="javascript:;" onclick="$('#copy_design_survey_select input').prop('checked',true);" style="margin-left:2px;margin-right:5px;text-decoration:underline;font-size:11px;"
					><?php echo $lang['email_users_17'] ?></a>|<a href="javascript:;" onclick="$('#copy_design_survey_select input').prop('checked',false);" style="margin-left:4px;text-decoration:underline;font-size:11px;margin-right:2px;"><?php echo $lang['email_users_18'] ?></a>)
			</span>
			<?php
			// Loop through all surveys and display checkbox for each
			foreach ($Proj->surveys as $this_survey_id=>$sattr) {
				if (isset($_GET['survey_id']) && $_GET['survey_id'] == $this_survey_id) continue;
				$survey_title = ($sattr['title'] == '') ? $Proj->forms[$sattr['form_name']]['menu'] : $sattr['title'];
				print 	RCView::div(array('class'=>'hang', 'style'=>'line-height: 11px;'),
							RCView::input(array('type'=>'checkbox', 'sid'=>$this_survey_id)).
							"\"".RCView::escape($survey_title)."\""
						);
			}
			?>
		</td>
	</tr>
	</table>
</div>

<!-- Hidden div containing USER LIST for choosing selected users who can access a resource -->
<div id="save_custom_theme_div">
	<div id="save_custom_theme_div_sub" style="max-width:320px;min-width:320px;">
		<div style="color:#800000;font-weight:bold;font-size:13px;padding:6px 3px 5px;margin-bottom:3px;border-bottom:1px solid #ccc;">
			<img src="<?php echo APP_PATH_IMAGES ?>themes.png" style="width:16px;height:16px;">
			<?php echo $lang['survey_1035'] ?>
		</div>
		<div style="padding:5px;color:#333;">
			<?php echo $lang['survey_1037'] ?>
		</div>
		<div style="padding:5px;">
			<input id="custom_theme_name" type="text" placeholder="<?php echo cleanHtml2($lang['survey_1036']) ?>" class="x-form-text x-form-field" style="width:170px;margin-right:2px;" maxlength="50" onkeydown="if(event.keyCode==13){return false;}">
			<button id="custom_theme_name_btn" class="jqbuttonmed" onclick="saveUserTheme()" style="margin-right:0px;"><?php echo $lang['designate_forms_13'] ?></button>
			<img src="<?php echo APP_PATH_IMAGES ?>spacer.gif" style="width:5px;height:16px;visibility:hidden;">
			<img id="custom_theme_icon_progress" src="<?php echo APP_PATH_IMAGES ?>progress_circle.gif" style="display:none;">
			<span id="custom_theme_icon_success">
				<img src="<?php echo APP_PATH_IMAGES ?>tick.png">
				<?php echo $lang['design_243'] ?>
			</span>
			<a id="custom_theme_icon_cancel" href="javascript:;" onclick="$('#save_custom_theme_div').hide();" style="text-decoration:underline;font-size:11px;margin-left: 2px;"><?php echo $lang['global_53'] ?></a>
		</div>
	</div>
</div>

<!-- Spectrum JS and CSS for custom theme pickers -->
<style type="text/css">
#save_custom_theme_div {
	min-width:320px;
	background: transparent url(<?php echo APP_PATH_IMAGES ?>upArrow.png) no-repeat center top;
	position:absolute;
	padding:9px 0 0;
	display: none;
	font-size:11px;
}
#save_custom_theme_div_sub {
	background-color: #fafafa;
	padding:3px 6px 10px;
	border:1px solid #000;
}
#custom_theme_icon_success { color: green;display:none;font-size:12px;font-weight:bold; }
</style>
<link rel='stylesheet' href='<?php echo APP_PATH_CSS ?>spectrum.css'>
<script type="text/javascript" src='<?php echo APP_PATH_JS ?>spectrum.js'></script>
<script type="text/javascript" src='<?php echo APP_PATH_JS ?>SurveySettings.js'></script>
<!-- Javascript needed -->
<script type="text/javascript">
var isPromisInstrument = <?php print ($isPromisInstrument ? 1 : 0) ?>;
var surveySettingsLang01 = '<?php echo cleanHtml($lang['global_79']) ?>';
var surveySettingsLang02 = '<?php echo cleanHtml($lang['global_53']) ?>';
var surveySettingsLang03 = '<?php echo cleanHtml($lang['survey_1044']) ?>';
var surveySettingsLang04 = '<?php echo cleanHtml($lang['survey_1048']) ?>';
var surveySettingsLang05 = '<?php echo cleanHtml($lang['survey_1062']) ?>';
var surveySettingsLang06 = '<?php echo cleanHtml($lang['survey_1063']) ?>';
var surveySettingsLang07 = '<?php echo cleanHtml($lang['questionmark']) ?>';
$(function(){
	// Custom spectrum pickers for survey themes
	initSpectrum('input[name="theme_text_buttons"]', '#<?php print $theme_text_buttons ?>');
	initSpectrum('input[name="theme_bg_page"]', '#<?php print $theme_bg_page ?>');
	initSpectrum('input[name="theme_text_title"]', '#<?php print $theme_text_title ?>');
	initSpectrum('input[name="theme_bg_title"]', '#<?php print $theme_bg_title ?>');
	initSpectrum('input[name="theme_text_sectionheader"]', '#<?php print $theme_text_sectionheader ?>');
	initSpectrum('input[name="theme_bg_sectionheader"]', '#<?php print $theme_bg_sectionheader ?>');
	initSpectrum('input[name="theme_text_question"]', '#<?php print $theme_text_question ?>');
	initSpectrum('input[name="theme_bg_question"]', '#<?php print $theme_bg_question ?>');
});

// Delete the survey
function deleteSurvey(survey_id) {
	simpleDialog('<?php echo cleanHtml(RCView::div(array('style'=>'font-weight:bold;margin-bottom:10px;'), $lang['survey_381']).RCView::div(array('style'=>'margin-top:10px;color:red;'), RCView::b($lang['global_03'].$lang['colon']) . " " . $lang['survey_382'])) ?>','<?php echo cleanHtml($lang['survey_1071']) ?>',null,600,null,"Cancel","deleteSurveySave("+survey_id+");",'<?php echo cleanHtml($lang['survey_1070']) ?>');
}
function deleteSurveySave(survey_id) {
	$.post(app_path_webroot+'Surveys/delete_survey.php?pid='+pid+'&survey_id=<?php echo (isset($_GET['survey_id']) ? $_GET['survey_id'] : ''); ?>',{ },function(data){
		if (data != '1') {
			alert(woops);
		} else {
			simpleDialog('<?php echo cleanHtml($lang['survey_385']) ?>','<?php echo cleanHtml($lang['survey_384']) ?>',null,null,"window.location.href='"+app_path_webroot+"Design/online_designer.php?pid="+pid+"';");
		}
	});
}
</script>