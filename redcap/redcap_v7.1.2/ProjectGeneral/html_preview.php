<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

if (isset($_GET['pid']) && $_GET['pid'] == '') {
	// Super users: Non-project page
	require_once dirname(dirname(__FILE__)) . '/Config/init_global.php';
	// If not a super user, then stop here
	if (!SUPER_USER && !ACCOUNT_MANAGER) exit("");
} else {
	// Project page
	require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';
	// Make sure has Design or Survey Participant or User Rights privileges
	if (!$user_rights['user_rights'] && !$user_rights['design'] && !$user_rights['participants']) exit("");
}

// Look for 'contents' parameter
if (!isset($_POST['contents'])) exit("");

// Replace line breaks with <br>
$message = nl2br(label_decode($_POST['contents']));

// Filter any potentially harmful tags/attributes
$message = filter_tags($message);

// Simulate piping using fake data (project-level pages only)
if (defined("PROJECT_ID")) {
	$message = Piping::replaceVariablesInLabel($message, 1, $Proj->firstEventId, 1, array(), true, null, false, "" , 1, true);
}

// If flag was passed, then add survey link placeholder
if (isset($_POST['addSurveyLink']) && $_POST['addSurveyLink'] == '1') 
{
	$surveyLink = APP_PATH_SURVEY_FULL . '?s=XXXXXX';
	$message .= '<br /><br />'.$lang['survey_134'].'<br />
				<a style="text-decoration:underline;" target="_blank" href="' . $surveyLink . '">'.$lang['survey_1081'].'</a><br /><br />
				'.$lang['survey_135'].'<br />' . $surveyLink . '<br /><br />'.$lang['survey_137'];
}

// If sending a test message, then get subject and from email address also, then send email to user's primary email account
if (isset($_POST['from']) && isset($_POST['subject'])) 
{
	$subject = trim(strip_tags($_POST['subject']));
	if ($subject == '') $subject = '[No subject]';
	$email = new Message();
	$email->setTo($user_email);
	$email->setFrom(trim(strip_tags($_POST['from'])));
	$email->setSubject($subject);
	$email->setBody("<html><body style=\"font-family:arial,helvetica;font-size:10pt;\">$message</body></html>");
	if ($email->send()) print $user_email;
}
// Return just the email message contents
else 
{
	print $message;
}