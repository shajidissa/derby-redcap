<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Config for non-project pages
require_once dirname(dirname(__FILE__)) . '/Config/init_global.php';

$username = isset($_GET['username']) ? $_GET['username'] : '';
if($username)
{
	$user = User::getUserInfo($username);
	$folder_ids = isset($_GET['folder_ids']) ? explode(',', $_GET['folder_ids']) : array();
}
else
{
	$user = User::getUserInfo(USERID);
	$folder_ids = array();
}

// Parent/Child passthru
if (isset($_GET['parentchild']) && is_numeric($_GET['parentchild'])) {
	redirect(APP_PATH_WEBROOT . "DataEntry/parent_child.php?pid=" . $_GET['parentchild'] . (isset($_GET['record']) ? "&id=" . $_GET['record'] : ""));
}

// This file can ONLY be accessed via the main index.php that sits above the version folders
if (PAGE == "home.php") {
	redirect(APP_PATH_WEBROOT_PARENT . "index.php?action=myprojects");
}


// Initialize page display object
$objHtmlPage = new HtmlPage();
$objHtmlPage->addExternalJS(APP_PATH_JS . "base.js");
$objHtmlPage->addStylesheet("jquery-ui.min.css", 'screen,print');
$objHtmlPage->addStylesheet("style.css", 'screen,print');
$objHtmlPage->addStylesheet("home.css", 'screen,print');
$objHtmlPage->PrintHeader();
// Get tabs as $tabs
include APP_PATH_VIEWS . 'HomeTabs.php';


// Spacer for mobile
// if (!$isIE || vIE() > 8) print '<div class="hidden-sm hidden-md hidden-lg" style="margin-top:80px;"></div>';

//If system is offline, give message to super users that system is currently offline
if ($system_offline && $super_user)
{
	print  "<div class='red'>
				{$lang['home_01']}
				<a href='".APP_PATH_WEBROOT."ControlCenter/general_settings.php'
					style='text-decoration:underline;'>{$lang['global_07']}</a>.
			</div>";
}

// PASSWORD RESET KEY VIA EMAIL: If table-based user was created BUT authentication is still set to Public, then display message to user.
if ($auth_meth == 'none' && isset($_GET['action']) && $_GET['action'] == 'passwordreset' && isset($_GET['u']) && isset($_GET['k']))
{
	print RCView::div(array('class'=>'yellow'), RCView::b($lang['home_57']).RCView::br().$lang['home_58']);	
	$objHtmlPage->PrintFooter();
	exit;
}


/**
 * CREATE NEW PROJECT
 * Give form to create new REDCap project, if user selected it
 */
if (isset($_GET['action']) && $_GET['action'] == 'create')
{
	print  "<div class='well'>";
	print  '<div style="font-size: 18px;border-bottom:1px solid #aaa;padding-bottom:2px;margin-bottom:20px;">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> '.$lang['home_03'].'
			</div>';
	print  "<p>{$lang['home_04']} ";
	// If only super users are allowed to create new projects, then normal users will have email request sent to contact person for approval
	if ($superusers_only_create_project && !$super_user) {
		print  " {$lang['home_05']}<br><br></p>";
		print  "<form name='createdb' action='".APP_PATH_WEBROOT."ProjectGeneral/notifications.php?type=request_new' method='post' enctype='multipart/form-data'>";
		$btn_text = $lang['home_49'];
	} else {
		print  "<br><br></p>";
		print  "<form name='createdb' action='".APP_PATH_WEBROOT."ProjectGeneral/create_project.php' method='post' enctype='multipart/form-data'>";
		$btn_text = $lang['home_50'];
	}

	// Prepare a "certification" pop-up message when user clicks Create button if text has been set
	$certify_text_js = "if (setFieldsCreateFormChk()) { showProgress(1); document.createdb.submit(); }";
	if (trim($certify_text_create) != "" && (!$super_user || ($super_user && !isset($_GET['user_email']))))
	{
		print "<div id='certify_create' class='notranslate' title='Notice' style='display:none;text-align:left;'>".filter_tags(nl2br(label_decode($certify_text_create)))."</div>";
		$certify_text_js = "if (setFieldsCreateFormChk()) {
								$('#certify_create').dialog({ bgiframe: true, modal: true, width: 500, buttons: {
									'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); },
									'".cleanHtml($lang['create_project_72'])."': function() {
										$(this).dialog('close');
										showProgress(1);
										document.createdb.submit();
									}
								} });
							}";
	}

	//FORM
	print  "<table style='width:100%;table-layout:fixed;'>";

	// Include the page with the form
	include APP_PATH_DOCROOT . "ProjectGeneral/create_project_form.php";

	// Output table row for option to start from scratch or choose a project template
	print 	RCView::tr(array('valign'=>'top'),
				RCView::td(array('style'=>'padding-top:18px;padding-right:10px;font-weight:bold;'),
					$lang['create_project_75'] . RCView::br() . $lang['create_project_76']
				) .
				RCView::td(array('style'=>'padding-top:15px;'),
					// Blank slate
					RCView::div(array('style'=>'text-indent: -1.5em; margin-left: 1.5em;'),
						RCView::radio(array('name'=>'project_template_radio','value'=>'0','checked'=>'checked')) .
						$lang['create_project_67']
					) .
					// CDISC ODM (XML file)
					RCView::div(array('style'=>'text-indent: -1.5em; margin-left: 1.5em;'),
						RCView::radio(array('name'=>'project_template_radio','value'=>'2')) .
						$lang['create_project_109'] .
						RCView::a(array('href'=>'javascript:;', 'class'=>"help", 'onclick'=>"simpleDialog('".cleanHtml($lang['data_import_tool_248']." ".$lang['data_import_tool_250'])."','".cleanHtml($lang['create_project_109'])."');"), '?') .
						RCView::div(array('id'=>'odm_file_upload', 'style'=>'margin:6px 0px 8px 22px;color:#800000;display:none;'),
							RCView::img(array('src'=>'xml.png')) .
							$lang['create_project_110'] . RCView::SP . RCView::SP . 
							RCView::file(array('name'=>'odm', 'style'=>'display: inline;'))
						) .
						// Hidden input in case users must request projects and have already uploaded a file, in which
						// case, the file is stored and has an edoc_id value
						RCView::hidden(array('id'=>'odm_edoc_id', 'name'=>'odm_edoc_id', 'value'=>$_GET['odm_edoc_id'])) .
						RCView::div(array('id'=>'odm_edoc_id_msg', 'style'=>'margin:0px 0px 4px 22px;color:green;display:none;'),
							RCView::img(array('src'=>'tick.png')) .
							$lang['create_project_112']
						)
					) .
					// Template
					RCView::div(array('style'=>'text-indent: -1.5em; margin-left: 1.5em;'),
						RCView::radio(array('name'=>'project_template_radio','value'=>'1')) .
						$lang['create_project_68']
					)
				)
			);
	// Display table of project templates
	print 	RCView::tr(array('valign'=>'top'),
				RCView::td(array('colspan'=>'2','style'=>'padding-top:20px;padding-bottom:10px;'),
					ProjectTemplates::buildTemplateTable()
				)
			);

	// "Create Project"/Cancel buttons
	print  "<tr valign='top'>
				<td></td>
				<td style='padding:15px 0 15px 5px;'>
					<button class='btn btn-primary' onclick=\"$certify_text_js; return false;\">$btn_text</button>
					&nbsp; &nbsp; 
					<button class='btn btn-defaultrc create-project-cancel-btn' onclick=\"window.location.href='{$_SERVER['PHP_SELF']}'; return false;\">{$lang['global_53']}</button>
				</td>
			</tr>";

	// End of table
	print  "</table>";

	// If Super User is filling out for normal user request, use javascript to pre-fill form with existing info
	if (isset($_GET['type']) && $superusers_only_create_project && $super_user)
	{
		print  "<input type='hidden' name='user_email' value='{$_GET['user_email']}'>
				<input type='hidden' name='username' value='{$_GET['username']}'>
				<script type='text/javascript'>
				$(function(){
				setTimeout(function(){
					$('#app_title').val('" . cleanHtml(html_entity_decode(html_entity_decode($_GET['app_title'], ENT_QUOTES), ENT_QUOTES)) . "');
					$('#purpose').val('{$_GET['purpose']}');
					if ($('#purpose').val() == '1') {
						$('#purpose_other_span').css({'visibility':'visible'});
						$('#purpose_other_text').val('" . cleanHtml(html_entity_decode(html_entity_decode($_GET['purpose_other'], ENT_QUOTES), ENT_QUOTES)) . "');
						$('#purpose_other_text').css('display','');
					}
					if ($('#purpose').val() == '2') {
						$('#purpose_other_span').css({'visibility':'visible'});
						$('#purpose_other_research').css('display','');
						$('#project_pi_irb_div').css('display','');
						$('#project_pi_firstname').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_firstname'], ENT_QUOTES))) . "');
						$('#project_pi_mi').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_mi'], ENT_QUOTES))) . "');
						$('#project_pi_lastname').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_lastname'], ENT_QUOTES))) . "');
						$('#project_pi_email').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_email'], ENT_QUOTES))) . "');
						$('#project_pi_alias').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_alias'], ENT_QUOTES))) . "');
						$('#project_pi_username').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_pi_username'], ENT_QUOTES))) . "');
						$('#project_irb_number').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_irb_number'], ENT_QUOTES))) . "');
						$('#project_grant_number').val('" . cleanHtml(filter_tags(html_entity_decode($_GET['project_grant_number'], ENT_QUOTES))) . "');
						var purposeOther = '{$_GET['purpose_other']}';
						var purposeArray = purposeOther.split(',');
						for (i = 0; i < purposeArray.length; i++) {
							document.getElementById('purpose_other['+purposeArray[i]+']').checked = true;
						}
					}
					$('#project_note').val(br2nl('" . cleanHtml(filter_tags(urldecode(html_entity_decode($_GET['project_note'], ENT_QUOTES)))) . "'));
					$('#repeatforms_chk_div').css({'display':'block'});
					$('#datacollect_chk').prop('checked',true);
					$('#projecttype".($_GET['surveys_enabled'] == '1' ? '2' : ($_GET['surveys_enabled'] == '2' ? '0' : '1'))."').prop('checked',true);
					$('#repeatforms_chk".($_GET['repeatforms'] ? '2' : '1')."').prop('checked',true);
					if ({$_GET['scheduling']} == 1) $('#scheduling_chk').prop('checked',true);
					if ({$_GET['randomization']} == 1) $('#randomization_chk').prop('checked',true);
					setFieldsCreateForm();
					// If template was selected, select it
					if (isNumeric('{$_GET['template']}')) {
						$('#template_projects_list').fadeTo(0,1);
						$('#template_projects_list button, #template_projects_list input').prop('disabled',false);
						$('input[name=\"project_template_radio\"][value=\"1\"]').prop('checked',true);
						$('input[name=\"copyof\"][value=\"{$_GET['template']}\"]').prop('checked',true);
					}
					".(!(isset($_GET['odm_edoc_id']) && $_GET['odm_edoc_id_hash'] == Files::docIdHash($_GET['odm_edoc_id'])) ? "" :
						"// If uploaded ODM file, then select that option
						if (isNumeric('{$_GET['odm_edoc_id']}')) {
							$('input[name=\"project_template_radio\"][value=\"2\"]').prop('checked',true);
							$('#odm_edoc_id_msg').show();
						}"
					)."
				},(isIE6 ? 1000 : 10));
				});
				</script>";
	}

	//Finish bigger div
	print  "</form>";
	print "</div>";

	## Hide step 1 and 2 (legacy options from version 4.X)
	?>
	<script type="text/javascript">
	$(function(){
		// Select data entry forms project type option
		$('#projecttype1').prop('checked',true);
		// Select classic project option
		$('#repeatforms_chk1').prop('checked',true);
		// Run function to set all values in place
		setFieldsCreateForm();

		// Disable the template list
		$('#template_projects_list').fadeTo(0,0.4);
		$('#template_projects_list button, #template_projects_list input').prop('disabled',true);
		// If choose to use a template, then enable the tempate drop-down
		$('input[name="project_template_radio"]').change(function(){
			var project_template_radio = $('input[name="project_template_radio"]:checked').val();
			if (project_template_radio == '1') {
				// Enable drop-down and description box
				$('#template_projects_list button, #template_projects_list input').prop('disabled',false);
				$('#template_projects_list').fadeTo('fast',1);
				$('#odm_file_upload').hide();
			} else if (project_template_radio == '0') {
				// Disable the drop-down and reset its value
				$('input[name="copyof"]').prop('checked',false);
				$('#template_projects_list button, #template_projects_list input').prop('disabled',true);
				$('#template_projects_list').fadeTo('fast',0.4);
				$('#odm_file_upload').hide();
			} else {
				// ODM
				$('#odm_file_upload').show('fade',{ },'normal');
				$('#template_projects_list').fadeTo('fast',0.4);
			}
		});
		// Template table: If click row, have it select the radio
		$('#table-template_projects_list tr').click(function(){
			if (!$('input[name="project_template_radio"]').length || ($('input[name="project_template_radio"]').length && $('input[name="project_template_radio"]:checked').val() == '1')) {
				$(this).find('input[name="copyof"]').prop('checked',true);
			}
		});

		// Put focus in the project title text box
		$('#app_title').focus();
	});
	</script>
	<?php
}




/**
 * MY PROJECTS LIST
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'myprojects')
{
	// Show custom homepage announcement text (optional)
	if (trim($homepage_announcement) != "") {
		print RCView::div(array('style'=>'margin-bottom:10px;'), nl2br(decode_filter_tags($homepage_announcement)));
	}
	print  "<div style='margin:5px 0;padding:0;' class='hidden-xs col-sm-12'>
				{$lang['home_59']}
				<a href='javascript:;' style='text-decoration:underline;' onclick=\"$(this).remove();$('#myprojects-instructions').show('fade');\">{$lang['scheduling_78']}</a>
				<span id='myprojects-instructions' style='display:none;'>
					{$lang['home_60']} {$lang['home_07']} {$lang['home_08']}{$lang['home_09']}
					{$lang['home_45']} <img src='".APP_PATH_IMAGES."blog_blue.png' style='vertical-align:middle;padding-right:2px;'>{$lang['home_46']}
					<img src='".APP_PATH_IMAGES."blogs_stack.png' style='vertical-align:middle;padding-right:2px;'>{$lang['home_47']}
					".(defined('SUPER_USER') && SUPER_USER ? " {$lang['home_44']} <img src='".APP_PATH_IMAGES."star_small2.png' style='vertical-align:middle;'>{$lang['period']}" : "")."
				</span>
			</div>";

	// Display time that user last accessed the project user access dashboard (if enabled and user has User Rights privileges in at least one project)
	if (is_numeric($user_access_dashboard_enable) && $user_access_dashboard_enable > 0
	&& UserRights::hasUserRightsPrivileges(defined('USERID') ? USERID : ''))
	{
		// If custom notification text is set, then use it instead of the stock text
		$user_access_dashboard_custom_notify_text = (trim($user_access_dashboard_custom_notification) == '') ? $lang['rights_242'] : filter_tags($user_access_dashboard_custom_notification);
		// Determine if user has accessed the page this month. If not, give red alert IF $user_access_dashboard_enable > 1.
		if ($user_access_dashboard_enable > 1 && ($user_access_dashboard_view == '' || substr($user_access_dashboard_view, 0, 7) != date('Y-m'))) {
			// RED WARNING
			if ($user_access_dashboard_view == '') {
				// Never accessed the page
				$user_access_dashboard_action_text = "{$lang['rights_244']} $user_access_dashboard_custom_notify_text";
			} else {
				// Has not accessed the page this month
				$user_access_dashboard_view_text = floor((strtotime(TODAY)-strtotime(substr($user_access_dashboard_view, 0, 10)))/86400);
				$user_access_dashboard_action_text = "{$lang['rights_241']} ".
					($user_access_dashboard_view_text <= 1 ? ($user_access_dashboard_view_text == 1 ? $lang['rights_257'] : $lang['rights_258']) : "$user_access_dashboard_view_text ".$lang['rights_256'])."{$lang['period']} $user_access_dashboard_custom_notify_text";
			}
			// Display red box
			print 	RCView::div(array('class'=>'hidden-xs col-sm-12', 'style'=>'color:#800000;border:1px solid #C00000;background-color:#FFE1E1;font-size:11px;margin:5px 0 25px;padding:5px 10px;'),
						RCView::table(array('style'=>'width:100%;table-layout:fixed;', 'cellspacing'=>'0'),
							RCView::tr(array(),
								RCView::td(array(),
									RCView::div(array('style'=>'line-height:14px;'),
										RCView::b($lang['rights_243'])." " .
										$user_access_dashboard_action_text
									)
								) .
								RCView::td(array('style'=>'text-align:right;width:240px;padding:3px 0 1px;'),
									$lang['setup_45'] .
									RCView::button(array('class'=>'btn btn-defaultrc btn-xs', 'style'=>'margin-left:8px;', 'onclick'=>"window.location.href='".APP_PATH_WEBROOT_PARENT."index.php?action=user_access_dashboard';"),
										$lang['rights_226']
									)
								)
							)
						)
					);
		} else {
			// SUGGESTION
			print 	RCView::div(array('class'=>'hidden-xs col-sm-12', 'style'=>'padding:0;margin-bottom:20px;'),
						$lang['rights_322'] . " " .
						RCView::a(array('href'=>APP_PATH_WEBROOT_PARENT."index.php?action=user_access_dashboard", 'style'=>'text-decoration:underline;color:#800000;'),
							$lang['rights_226']
						) . $lang['period']
					);
		}

	}

	$projects = new RenderProjectList ();
	$projects->renderprojects();

	// Check if user has any Archived projects. If so, show link to display them, if desired.
	print  "<div style='margin-top:15px;'>";
	$sql = "select count(1) from redcap_user_rights u, redcap_projects p where u.project_id = p.project_id and
			u.username = '$userid' and p.status = 3";
	$num_archived = db_result(db_query($sql), 0);
	if ($num_archived > 0) {
		if (!isset($_GET['show_archived'])) {
			print  "<a style='font-size:11px;color:#666;' href='index.php?action=myprojects&show_archived'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> {$lang['home_10']}</a>";
		} else {
			print  "<a style='font-size:11px;color:#666;' href='index.php?action=myprojects'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> {$lang['home_11']}</a>";
		}
	}
	print  "</div>";


	// TWO FACTOR TWILIO WITH NO PHONE NUMBERS LISTED
	// Prompt user to enter a phone number since they have none in their user account.
	if ($auth_meth != 'none' && $two_factor_auth_enabled && $two_factor_auth_twilio_enabled
		// If user has no phone numbers listed
		&& $user_phone_sms == '' && $user_phone == ''
		// If the user was forced to perform two-factor for *this* session, then prompt them. Don't bother them if they didn't just do two-factor.
		&& Authentication::enforceTwoFactorByIP())
	{
		// Get user info
		$user_info = User::getUserInfo(USERID);
		// If have no phone numbers, then display
		if ($user_info['two_factor_auth_twilio_prompt_phone'])
		{
			// Dialog div
			$twilio_prompt_phone_dialog = 	RCView::div(array('style'=>'font-size:14px;line-height:16px;'),
												$lang['system_config_488'] . " " .
												RCView::b($lang['system_config_491']) . " " .
												$lang['system_config_492'] .
												RCView::div(array('style'=>'margin-top:20px;font-size:13px;'),
													RCView::checkbox(array('id'=>'twilio_prompt_phone_dialog_checkbox', 'onclick'=>"neverShowPhonePromptAgain();")) .
													RCView::span(array('onclick'=>"var ob = $('#twilio_prompt_phone_dialog_checkbox'); ob.prop('checked', !ob.prop('checked')); neverShowPhonePromptAgain();"),
														$lang['system_config_490']
													) .
													RCView::span(array('id'=>'twilio_prompt_phone_dialog_saved', 'style'=>'margin-left:15px;font-size:13px;font-weight:bold;color:green;visibility:hidden;'),
														RCView::img(array('src'=>'tick.png')) .
														$lang['design_243']
													)
												)
											);
			?><script type="text/javascript">
			$(function(){
				simpleDialog('<?php print cleanHtml($twilio_prompt_phone_dialog) ?>','<?php print cleanHtml($lang['system_config_487']) ?>','twilio_prompt_phone_dialog',500,null,null,"window.location.href = app_path_webroot+'Profile/user_profile.php';",'<?php print cleanHtml($lang['system_config_489']) ?>')
				$('#twilio_prompt_phone_dialog').parent().find('div.ui-dialog-buttonpane button:eq(1)').css({'font-weight':'bold','color':'#222'});
			});
			function neverShowPhonePromptAgain() {
				$.post(app_path_webroot+'Authentication/two_factor_hide_phone_prompt.php',{ two_factor_auth_twilio_prompt_phone: ($('#twilio_prompt_phone_dialog_checkbox').prop('checked') ? '0' : '1') },function(data){
					if (data == '1') {
						$('#twilio_prompt_phone_dialog_saved').css('visibility','visible');
						setTimeout(function(){
							$('#twilio_prompt_phone_dialog_saved').css('visibility','hidden');
						},2000);
					} else {
						alert(woops);
					}
				});
			}
			</script><?php
		}
	}
}



/**
 * GIVE USER CONFIRMATION IF REQUESTED NEW PROJECT
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'requested_new' && $superusers_only_create_project)
{
	//print  "<br><div style='width:95%;border:1px solid #d0d0d0;padding:0px 15px 15px 15px;background-color:#f5f5f5;'>";
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_12']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_13']} {$lang['home_14']} (<a href='mailto:$user_email' style='text-decoration:underline;'>$user_email</a>)
				{$lang['home_15']}
			</p>";
}



/**
 * GIVE USER CONFIRMATION IF REQUESTED TO COPY PROJECT
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'requested_copy' && $superusers_only_create_project)
{
	//print  "<br><div style='width:95%;border:1px solid #d0d0d0;padding:0px 15px 15px 15px;background-color:#f5f5f5;'>";
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_12']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_16']}
				<b>" . strip_tags(html_entity_decode($_GET['app_title'], ENT_QUOTES)) . "</b>.
				{$lang['home_14']} (<a href='mailto:$user_email' style='text-decoration:underline;'>$user_email</a>)
				{$lang['home_15']}
			</p>";
}

/**
 * GIVE USER CONFIRMATION IF REQUESTED TO DELETE PROJECT
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'requested_delete')
{
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_12']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_55']}
				<b>" . RCView::escape(ToDoList::getProjectTitle($_GET['pid'])) . "</b>{$lang['period']}
				{$lang['home_14']} (<a href='mailto:$user_email' style='text-decoration:underline;'>$user_email</a>)
				{$lang['home_56']}
			</p>";
}



/**
 * GIVE SUPER USER CONFIRMATION WHEN APPROVING NEW PROJECT
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'approved_new' && $superusers_only_create_project & $super_user)
{
	$project_link = "";
	if (isset($_GET['new_pid']) && is_numeric($_GET['new_pid'])) {
		$project_link = "{$lang['home_53']} <a href='".APP_PATH_WEBROOT."index.php?pid={$_GET['new_pid']}' style='text-decoration:underline;'>{$lang['home_54']}</a>{$lang['period']}";
	}
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_17']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_18']} (<a href='mailto:{$_GET['user_email']}' style='text-decoration:underline;'>{$_GET['user_email']}</a>){$lang['period']}
				$project_link
			</p>";
}



/**
 * GIVE SUPER USER CONFIRMATION WHEN COPYING PROJECT
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'approved_copy' && $superusers_only_create_project & $super_user)
{
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_17']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_19']} (<a href='mailto:{$_GET['user_email']}' style='text-decoration:underline;'>{$_GET['user_email']}</a>).
			</p>";
}



/**
 * GIVE SUPER USER CONFIRMATION WHEN MOVING PROJECT TO PRODUCTION (USER REQUESTED)
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'approved_movetoprod' && $superusers_only_move_to_prod & $super_user)
{
	print  "<h4 style='padding:3px; font-weight: bold;'>{$lang['home_17']}</h4>";
	print  "<p style='padding-bottom:50px;'>
				{$lang['home_43']} (<a href='mailto:{$_GET['user_email']}' style='text-decoration:underline;'>{$_GET['user_email']}</a>).
			</p>";
}



/**
 * TRAINING RESOURCES (VIDEOS, ETC.)
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'training')
{
	include APP_PATH_DOCROOT . "Home/training_resources.php";
}



/**
 * HELP & FAQ
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'help')
{
	include APP_PATH_DOCROOT . "Help/index.php";
}



/**
 * PROJECT ACCESS SUMMARY
 */
elseif (isset($_GET['action']) && $_GET['action'] == 'user_access_dashboard')
{
	include APP_PATH_DOCROOT . "Home/user_access_dashboard.php";
}




/**
 * HOME PAGE WITH GENERAL INFO
 */
else
{
	include APP_PATH_DOCROOT . "Home/info.php";
}

// Check if need to report institutional stats to REDCap consortium
checkReportStats();

$objHtmlPage->PrintFooter();
