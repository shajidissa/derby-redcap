<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Display header and call config file
require_once dirname(dirname(__FILE__)) . '/Config/init_global.php';

// Initialize page display object
$objHtmlPage = new HtmlPage();
$objHtmlPage->addExternalJS(APP_PATH_JS . "base.js");
$objHtmlPage->addStylesheet("jquery-ui.min.css", 'screen,print');
$objHtmlPage->addStylesheet("style.css", 'screen,print');
$objHtmlPage->addStylesheet("home.css", 'screen,print');
$objHtmlPage->PrintHeader();
// Get tabs as $tabs
include APP_PATH_VIEWS . 'HomeTabs.php';

print "<h4><img src='".APP_PATH_IMAGES."user_edit.png'> <span style='color:#800000;'>{$lang['user_08']}</span></h4>";



## DISPLAY PAGE
?>
<style type="text/css">
table#userProfileTable { border:1px solid #ddd;font-size:13px;width:95%;max-width:800px;margin-right:80px; }
table#userProfileTable td { background-color:#f5f5f5;padding: 5px 20px; }
</style>

<script type='text/javascript'>
function validateUserInfoForm() {
	if ($('#user_email').val().length < 1 || $('#user_firstname').val().length < 1 || $('#user_lastname').val().length < 1) {
		simpleDialog('<?php echo cleanHtml($lang['user_17']) ?>');
		return false;
	}
	return emailChange(document.getElementById('user_email'));
}
function emailChange(ob) {
	$(ob).val( trim($(ob).val()) );
	$('#reenterPrimary').hide();
	$('#reenterPrimary2').hide();
	if (!redcap_validate(ob,'','','hard','email')) return false;
	var id = $(ob).attr('id');
	// Make sure the new primary email isn't already a secondary/tertiary email
	if ($(ob).val() != '' && (($('#user_email2-span').text() != '' && $(ob).val() == $('#user_email2-span').text())
		|| ($('#user_email3-span').text() != '' && $(ob).val() == $('#user_email3-span').text()))) {
		simpleDialog('<b>'+$(ob).val()+'</b> <?php echo cleanHtml($lang['user_35']) ?>',null,null,null,"$('#"+id+"').val( $('#"+id+"').attr('oldval') ).focus();");
		return false;
	}
	// If email_domain_whitelist is enabled, then check the email against it
	if (emailInDomainWhitelist(ob) === false) {
		$(ob).val('');
		return false;
	}
	// Display "re-enter email" field if email is changing
	if ($(ob).val() != '' && $(ob).attr('oldval') != null && $(ob).val() != $(ob).attr('oldval') && $('#user_email_dup').val() != $(ob).val()) {
		$('#reenterPrimary').show('fade',function(){ $('#user_email_dup').focus() });
		$('#reenterPrimary2').show('fade');
		return false;
	}
	return true;
}
</script>
<?php

// Get user info
$user_info = User::getUserInfo($userid);

// Instructions
print  "<p>{$lang['user_11']}</p>";

// If posted, show message showing that changes have been made
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Sanitize inputs
	foreach ($_POST as &$val) $val = strip_tags(html_entity_decode($val, ENT_QUOTES));
	// If "domain whitelist for user emails" is enabled and email fails test, then revert it to old value
	if (User::emailInDomainWhitelist($_POST['user_email']) === false) {
		$_POST['user_email'] = $user_info['user_email'];
	}
	if (!isset($_POST['user_phone'])) $_POST['user_phone'] = $user_info['user_phone'];
	if (!isset($_POST['user_phone_sms'])) $_POST['user_phone_sms'] = $user_info['user_phone_sms'];
	//Make changes to user's info
	$sql = "update redcap_user_information set
			user_email = '".prep($_POST['user_email'])."',
			user_firstname = '".prep($_POST['user_firstname'])."',
			user_lastname = '".prep($_POST['user_lastname'])."',
			user_phone = ".checkNull($_POST['user_phone']).",
			user_phone_sms = ".checkNull($_POST['user_phone_sms']);
	if (isset($_POST['datetime_format'])) {
		$sql .= ", datetime_format = '".prep($_POST['datetime_format'])."',
				number_format_decimal = '".prep($_POST['number_format_decimal'])."',
				number_format_thousands_sep = '".prep(trim($_POST['number_format_thousands_sep']))."'";
	}
	$sql .= " where username = '".prep($userid)."'";
	if (db_query($sql)) {
		print '<div class="darkgreen" style="text-align:center;max-width:100%;">
				<img src="'.APP_PATH_IMAGES.'tick.png"> '.$lang['user_09'].'
			   </div><br>';
	} else {
		print '<div class="red" style="text-align:center;max-width:100%;">
				<img src="'.APP_PATH_IMAGES.'exclamation.png"> '.$lang['global_01'].$lang['colon'].' '.$lang['user_10'].'
			   </div><br>';
	}
	print "<script type='text/javascript'>$(function(){ setTimeout(function(){ $('.red').hide('blind');$('.darkgreen').hide('blind'); },3000); });</script>";
	//Set new values for display
	$user_firstname = $_POST['user_firstname'];
	$user_lastname  = $_POST['user_lastname'];
	$user_email 	= $_POST['user_email'];
	$datetime_format = $_POST['datetime_format'];
	$number_format_decimal = $_POST['number_format_decimal'];
	$number_format_thousands_sep = $_POST['number_format_thousands_sep'];
	$user_info['user_phone'] = $_POST['user_phone'];
	$user_info['user_phone_sms'] = $_POST['user_phone_sms'];
	// Logging
	Logging::logEvent($sql,"redcap_user_information","MANAGE",$userid,"username = '".prep($userid)."'","Update user info");
	// If the user changed their email address, then send them a verification email so they can confirm that email account
	if ($user_info['user_email'] != $_POST['user_email'])
	{
		// Now send an email to their account so they can verify their email
		$verificationCode = User::setUserVerificationCode($user_info['ui_id'], 1);
		if ($verificationCode !== false) {
			// Send verification email to user
			$emailSent = User::sendUserVerificationCode($_POST['user_email'], $verificationCode);
			if ($emailSent) {
				// Redirect back to previous page to display confirmation message and notify user that they were sent an email
				redirect(APP_PATH_WEBROOT . "Profile/user_profile.php?verify_email_sent=1");
			}
		}
	}
}


print "<div style='text-align:center;padding:10px 0px;' align='center'>";
print "<form id='form' method=\"post\" action=\"" . PAGE_FULL . ((isset($_GET['pnid']) && $_GET['pnid'] != "") ? "?pid=$project_id" : "") . "\">";
print "<center>";

// TABLE
print  "<table id='userProfileTable'>";
// Header
print  "<tr><td colspan='2' style='padding:10px 8px 5px;color:#800000;font-weight:bold;font-size:14px;'>
		{$lang['user_58']}
		</td></tr>";
// First name
print  "<tr><td>{$lang['pub_023']}{$lang['colon']} </td><td>";
// If global setting is set to restrict editing of first/last name, then display as hidden field that is not editable
if ($my_profile_enable_edit || $super_user) {
	print "<input type=\"text\" class=\"x-form-text x-form-field\" id=\"user_firstname\" name=\"user_firstname\" value=\"".str_replace("\"","&quot;", isset($user_firstname) ? $user_firstname : '')."\" size=20 onkeydown='if(event.keyCode == 13) return false;'>";
} else {
	print  "<b>$user_firstname</b>
			<input type=\"hidden\" id=\"user_firstname\" name=\"user_firstname\" value=\"".str_replace("\"","&quot;",$user_firstname)."\">";
}
print "</td></tr>";
// Last name
print "<tr><td>{$lang['pub_024']}{$lang['colon']} </td><td>";
if ($my_profile_enable_edit || $super_user) {
	print "<input type=\"text\" class=\"x-form-text x-form-field\" id=\"user_lastname\" name=\"user_lastname\" value=\"".str_replace("\"","&quot;", isset($user_lastname) ? $user_lastname : '')."\" size=20 onkeydown='if(event.keyCode == 13) return false;'>";
} else {
	print  "<b>$user_lastname</b>
			<input type=\"hidden\" id=\"user_lastname\" name=\"user_lastname\" value=\"".str_replace("\"","&quot;",$user_lastname)."\">";
}
print "</td></tr>";
// Primary email
print 	"<tr>
			<td>
				<img src='".APP_PATH_IMAGES."email.png'>
				{$lang['user_45']}{$lang['colon']}
			</td>
			<td>
				<input type=\"text\" class=\"x-form-text x-form-field\" value=\"" . (isset($user_email) ? $user_email : '') . "\" oldval=\"" . (isset($user_email) ? $user_email : '') . "\" id=\"user_email\" name=\"user_email\" size=35 onkeydown='if(event.keyCode == 13) return false;' onBlur=\"emailChange(this)\">
		   </td>
		  </tr>";
// Primary email (re-enter)
print 	"<tr id='reenterPrimary' style='display:none;'>
			<td valign='top' class='yellow' style='color:red;border-bottom:0;border-right:0;background-color:#FFF7D2;'>
				<img src='".APP_PATH_IMAGES."email.png'>
				{$lang['user_15']}{$lang['colon']}
			</td>
			<td valign='top' class='yellow' style='border-bottom:0;border-left:0;background-color:#FFF7D2;'>
				<input type=\"text\" class=\"x-form-text x-form-field\" id=\"user_email_dup\" size=35 onkeydown='if(event.keyCode == 13) return false;' onBlur=\"this.value=trim(this.value);if(this.value.length<1){return false;} if (!redcap_validate(this,'','','hard','email')) { return false; } validateEmailMatch('user_email','user_email_dup');\">
				<div style='max-width:300px;font-size:11px;color:red;'>{$lang['user_33']}</div>
			</td>
		  </tr>
		  <tr id='reenterPrimary2' style='display:none;'>
			<td colspan='2' class='yellow' style='line-height:11px;background-image:url();border-top:0;border-right:0;background-color:#FFF7D2;font-size:11px;color:#800000;'>
				<img src='".APP_PATH_IMAGES."mail_small2.png'>
				<b>{$lang['global_02']}{$lang['colon']}</b> {$lang['user_34']}
			</td>
		  </tr>";
// Phone number
// If using Two Factor auth with Twilio SMS enabled, add note that the phone number can be used for that.
if ($two_factor_auth_enabled && $two_factor_auth_twilio_enabled) {
	print 	"<tr>
				<td valign='top' style='padding-top:10px;'>
					<img src='".APP_PATH_IMAGES."phone_big.png' style='height:16px;'>
					{$lang['system_config_478']}{$lang['colon']}
					<div style='margin-left: 20px;font-size:11px;color:#777;'>{$lang['system_config_479']}</div>
				</td>
				<td valign='top' style='padding-top:10px;'>
					<input type=\"text\" class=\"x-form-text x-form-field\" value=\"".cleanHtml2($user_info['user_phone'])."\" id=\"user_phone\" name=\"user_phone\" size=20 onkeydown='if(event.keyCode == 13) return false;' onBlur=\"this.value = this.value.replace(/[^0-9,]/g,'');\">
					<div style='max-width:250px;font-size:11px;line-height:11px;color:#000066;margin:3px 0;'>{$lang['system_config_486']}</div>
				</td>
			</tr>";
	print 	"<tr>
				<td valign='top' style='padding-top:4px;'>
					<img src='".APP_PATH_IMAGES."sms_big.png' style='height:16px;'>
					{$lang['system_config_452']}{$lang['colon']}
					<div style='margin-left: 20px;font-size:11px;color:#777;'>{$lang['system_config_480']}</div>
				</td>
				<td valign='top' style='padding-top:4px;'>
					<input type=\"text\" class=\"x-form-text x-form-field\" value=\"".cleanHtml2($user_info['user_phone_sms'])."\" id=\"user_phone_sms\" name=\"user_phone_sms\" size=20 onkeydown='if(event.keyCode == 13) return false;' onBlur=\"this.value = this.value.replace(/[^0-9,]/g,'');\">
				</td>
			</tr>";
}

// Submit button (and Reset Password button, if applicable)
print 	"<tr>
			<td></td>
			<td style='white-space:nowrap;color:#800000;padding-bottom:20px;'>
				<button class='jqbutton' style='font-weight:bold;' onclick=\"if(validateUserInfoForm()){ $('#form').submit(); } return false;\">{$lang['user_60']}</button>
			</td>
		</tr>";


## LOGIN RELATED OPTIONS
// Reset Password: If user is a table-based user (i.e. in redcap_auth table), then give option to reset password
$passwordResetOptions = "";
if (($auth_meth_global == "table" || $auth_meth_global == "ldap_table") && User::isTableUser($userid)) {
	// Reset password button & reset security question button
	$passwordResetOptions .=
		"<div style='padding:10px 20px 5px;'>
			<button class='jqbuttonmed' style='margin-right:15px;color:#800000;' onclick=\"
				simpleDialog('".cleanHtml($lang['user_13'])."','".cleanHtml($lang['user_12'])."',null,null,null,'".cleanHtml($lang['global_53'])."','$.get(app_path_webroot+\'ControlCenter/user_controls_ajax.php\',{action:\'reset_password_as_temp\'},function(data){if(data==\'0\'){alert(woops);return;}window.location.reload();});','".cleanHtml($lang['setup_53'])."');
				return false;
			\">{$lang['control_center_140']}</button>
			<button class='jqbuttonmed' style='color:#000066;' onclick=\"
				simpleDialog('".cleanHtml($lang['user_78'])."','".cleanHtml($lang['user_77'])."',null,null,null,'".cleanHtml($lang['global_53'])."','$.get(app_path_webroot+\'ControlCenter/user_controls_ajax.php\',{action:\'reset_security_question\'},function(data){if(data==\'0\'){alert(woops);return;}window.location.href=app_path_webroot_full+\'index.php?action=myprojects\';});','".cleanHtml($lang['setup_53'])."');
				return false;
			\">{$lang['control_center_4407']}</button>
		</div>";
}
// If using Two Factor auth with Google Authenticator enabled
if ($two_factor_auth_enabled && $two_factor_auth_authenticator_enabled) {
	$passwordResetOptions .= 	RCView::div(array('style'=>'padding:10px 20px 5px;'),
									RCView::button(array('class'=>'jqbuttonmed', 'onclick'=>"simpleDialog(null,null,'two_factor_totp_setup',550);return false;"),
										RCView::img(array('src'=>'google_authenticator_sm.png', 'style'=>'vertical-align:middle;')) .
										RCView::span(array('style'=>'vertical-align:middle;'), $lang['system_config_445'])
									)
								);
}
// Display login-related options as row
if ($passwordResetOptions != "") {
	print 	"<tr>
				<td colspan='2' style='border-top:1px solid #ddd;padding:10px 8px;'>
					<div style='color:#800000;font-weight:bold;font-size:14px;'>{$lang['user_93']}</div>
					$passwordResetOptions
				</td>
			</tr>";
}


// Super API Token: If user has a super token, then allow them to view it
if ($user_info['api_token'] != '')
{
	print 	"<tr>
				<td colspan='2' style='border-top:1px solid #ddd;padding:10px 8px 15px;'>
					<div style='color:#800000;font-weight:bold;font-size:14px;'>
						{$lang['control_center_4515']}
						<img src='".APP_PATH_IMAGES."coin.png' style='vertical-align:middle;'>
					</div>
					<div style='margin:10px 0 10px;'>{$lang['control_center_4529']}</div>
					<div>
						<input name='super_api_token' type='password' value='{$user_info['api_token']}' class='staticInput' readonly='readonly'
							onclick='this.select();' style='background-color:#fff;padding:5px;font-size:13px;width:350px;font-weight:bold;color:#347235;margin-right:15px;'>
						<a href='javascript:;' onclick=\"$(this).remove();showTwilioAuthToken('super_api_token');$('input[name=super_api_token]').width(570).effect('highlight',{},2000);\" style='text-decoration:underline;'>{$lang['control_center_4530']}</a>
					</div>
				</td>
			</tr>";
}


// Additional Info Header
print  "<tr><td colspan='2' style='border-top:1px solid #ddd;padding:10px 8px 5px;'>
			<div style='color:#800000;font-weight:bold;font-size:14px;'>{$lang['user_59']}</div>
			<div style='color:#555;font-size:11px;line-height:11px;padding:6px 0 3px;'>{$lang['user_61']}</div>
		</td></tr>";
// Secondary email
print 	"<tr>
			<td>{$lang['user_46']}{$lang['colon']} </td>
			<td style='white-space:nowrap;color:#800000;'>";
if (isset($user_email2) && $user_email2 != '') {
	print  "<span id='user_email2-span'>$user_email2</span> &nbsp;
			<a href='javascript:;' style='text-decoration:underline;font-size:10px;font-family:tahoma;' onclick=\"removeAdditionalEmail(2);return false;\">{$lang['scheduling_57']}</a>";
} else {
	print  "<button class='jqbuttonmed' style='color:green;' onclick=\"setUpAdditionalEmails();return false;\">{$lang['user_42']}</button>";
}
print " 	</td>
		</tr>";
// Tertiary email
print 	"<tr>
			<td>{$lang['user_55']}{$lang['colon']} </td>
			<td style='white-space:nowrap;color:#800000;'>";
if (isset($user_email3) && $user_email3 != '') {
	print  "<span id='user_email3-span'>$user_email3</span> &nbsp;
			<a href='javascript:;' style='text-decoration:underline;font-size:10px;font-family:tahoma;' onclick=\"removeAdditionalEmail(3);return false;\">{$lang['scheduling_57']}</a>";
} else {
	print  "<button class='jqbuttonmed' style='color:green;' onclick=\"setUpAdditionalEmails();return false;\">{$lang['user_42']}</button>";
}
print  " 	</td>
		</tr>";
// Spacer row
print 	"<tr>
			<td style='padding-bottom:10px;'> </td>
			<td style='padding-bottom:10px;'> </td>
		</tr>";



// User Preferences
print  "<tr><td colspan='2' style='border-top:1px solid #ddd;padding:10px 8px 5px;'>
			<div style='color:#800000;font-weight:bold;font-size:14px;'>{$lang['user_80']}</div>
			<div style='color:#555;font-size:11px;line-height:11px;padding:6px 0 3px;'>{$lang['user_81']}</div>
		</td></tr>";
// Datetime display
print 	"<tr>
			<td valign='top' style='padding-top:8px;'>{$lang['user_82']} </td>
			<td style='white-space:nowrap;'>
				".RCView::select(array('name'=>'datetime_format', 'class'=>'x-form-text x-form-field', 'style'=>'font-family:tahoma;'),
					DateTimeRC::getDatetimeDisplayFormatOptions(), $datetime_format)."
				<div style='color:#800000;font-size:11px;padding-top:3px;'>(e.g., 12/31/2004 22:57 or 31/12/2004 10:57pm)</div>
			</td>
		</tr>";
// Number display (decimal)
print 	"<tr>
			<td valign='top' style='padding-top:8px;'>{$lang['user_83']} </td>
			<td>
				".RCView::select(array('name'=>'number_format_decimal', 'class'=>'x-form-text x-form-field', 'style'=>'font-family:tahoma;'),
				User::getNumberDecimalFormatOptions(), isset($number_format_decimal) ? $number_format_decimal : '')."
				<div style='color:#800000;font-size:11px;padding-top:3px;'>(e.g., 3.14 or 3,14)</div>
			</td>
		</tr>";
// Number display (thousands separator)
print 	"<tr>
			<td valign='top' style='padding-top:8px;'>{$lang['user_84']} </td>
			<td>
				".RCView::select(array('name'=>'number_format_thousands_sep', 'class'=>'x-form-text x-form-field', 'style'=>'font-family:tahoma;'),
				User::getNumberThousandsSeparatorOptions(), ((isset($number_format_thousands_sep) && $number_format_thousands_sep == ' ') ? 'SPACE' : (isset($number_format_thousands_sep) ? $number_format_thousands_sep : '')))."
				<div style='color:#800000;font-size:11px;padding-top:3px;'>(e.g., 1,000,000 or 1.000.000 or 1 000 000)</div>
			</td>
		</tr>";
// Submit button (and Reset Password button, if applicable)
print 	"<tr>
			<td></td>
			<td style='white-space:nowrap;color:#800000;padding-bottom:20px;'>
				<button class='jqbutton' style='font-weight:bold;' onclick=\"if(validateUserInfoForm()){ $('#form').submit(); } return false;\">{$lang['user_89']}</button>
			</td>
		</tr>";
// Spacer row
print 	"<tr>
			<td style='padding-bottom:10px;'> </td>
			<td style='padding-bottom:10px;'> </td>
		</tr>";


print  "</table>";

print  "</center>";
print "</form>";

print "</div>";


## QR code dialog for enabling REDCap in Google Authenticator
if ($two_factor_auth_authenticator_enabled)
{
	// Get user info
	$user_info = User::getUserInfo(defined('USERID') ? USERID : '');
	// Get REDCap server's domain name
	$parse = parse_url(APP_PATH_WEBROOT_FULL);
	$redcap_server_hostname = $parse['host'];
	// Generate string to be converted into QR code to enable 2FA in an app
	$otpauth = 'otpauth://totp/' . urlencode((defined('USERID') ? USERID : '') . "@" . $redcap_server_hostname)
			 . '?secret=' .  urlencode($user_info['two_factor_auth_secret']) . '&issuer=REDCap';
	// Dialog content
	print	RCView::div(array('id'=>'two_factor_totp_setup', 'class'=>'simpleDialog', 'title'=>$lang['system_config_445'], 'style'=>'font-size:13px;display:none;'),
				// Instructions
				RCView::div(array('style'=>'font-size:14px;'),
					$lang['system_config_446'] . RCView::br() . RCView::br() .
					// Step 1
					RCView::span(array('style'=>'color:#C00000;font-weight:bold;font-size:14px;'), $lang['system_config_448']) .
					// Google Authenticator
					RCView::div(array('style'=>'margin:3px 0 15px 22px;'),
						$lang['system_config_449'] .
						RCView::a(array('href'=>'https://itunes.apple.com/us/app/google-authenticator/id388497605', 'target'=>'_blank', 'style'=>'margin:0 3px;text-decoration:underline;font-size:14px;'),
							"Apple App Store"
						) .
						$lang['global_47'] .
						RCView::a(array('href'=>'https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2', 'target'=>'_blank', 'style'=>'margin:0 3px;text-decoration:underline;font-size:14px;'),
							"Google Play Store"
						) .
						$lang['system_config_447']
					) .
					// Step 2
					RCView::span(array('style'=>'color:#C00000;font-weight:bold;font-size:14px;'), $lang['system_config_373']) . RCView::br() .
					// Display QR code
					RCView::div(array('style'=>'margin-left:10px;'),
						"<img src='".APP_PATH_WEBROOT."Authentication/generate_qrcode.php?value=".urlencode($otpauth)."'>"
					) .
					// Manual method
					RCView::div(array('style'=>'margin:0 0 15px 25px;'),
						RCView::a(array('href'=>'javascript:', 'onclick'=>"$('#qrcode_manual').toggle('fade');", 'style'=>'font-size:12px;text-decoration:underline;'),
							$lang['system_config_513']
						)
					) .
					RCView::div(array('id'=>'qrcode_manual', 'style'=>'font-size:13px;display:none;margin:10px 0 10px 25px;color:#800000;border:1px solid #ccc;padding:5px;'),
						$lang['system_config_514'] . RCView::br() . RCView::br() .
					$lang['system_config_515'] . " " . RCView::b((defined('USERID') ? USERID : '') . "@" . $redcap_server_hostname) . RCView::br() .
						$lang['system_config_516'] . " " . RCView::b($user_info['two_factor_auth_secret'])
					) .
					// Step 3
					RCView::span(array('style'=>'color:#C00000;font-weight:bold;font-size:14px;'), $lang['system_config_451']) .
					// Final words
					RCView::div(array('style'=>'margin:3px 0 0 22px;'),
						$lang['system_config_450']
					)
				)
			);
}

// Hidden dialog to confirm removal of secondary/tertiary email address
print RCView::simpleDialog($lang['user_57'].RCView::div(array('id'=>'user-email-dialog','style'=>'font-weight:bold;padding-top:15px;'), ""),$lang['user_56'],"removeAdditionalEmail");

// Display footer
$objHtmlPage->PrintFooter();
