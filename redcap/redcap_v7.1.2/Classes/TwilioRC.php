<?php

/**
 * TwilioRC
 * This class is used for processes related to Voice Calling & SMS via Twilio.com's REST API
 */
class TwilioRC
{
	// Set max length for any SMS. Real limit is 160, but need some buffer room to add "(1/total) " at beginning and ellipses at end
	const MAX_SMS_LENGTH = 150;

	// Pressing this button on a voice call skips the current question (saves value as blank) - if skippable
	const VOICE_SKIP_DIGIT = "*";

	// Initialize Twilio classes and settings
	public static function init()
	{
		global $rc_autoload_function;
		// Call Twilio classes
		require_once dirname(dirname(__FILE__)) . "/Libraries/Twilio/Services/Twilio.php";
		// Reset the class autoload function because Twilio's classes changed it
		spl_autoload_register($rc_autoload_function);
	}


	// Get array of all voices (genders) available in Twilio voice calling service
	public static function getAllVoices()
	{
		return array('man', 'woman', 'alice');
	}


	// Get array of all languages available in Twilio voice calling service
	public static function getAllLanguages()
	{
		return array(
					// Male/Female only
					'en'=>'English, United States',
					'en-gb'=>'English, UK',
					'es'=>'Spanish, Spain',
					'fr'=>'French, France',
					'de'=>'German, Germany',
					'it'=>'Italian, Italy',
					// Alice only
					'da-DK'=>'Danish, Denmark',
					'de-DE'=>'German, Germany',
					'en-AU'=>'English, Australia',
					'en-CA'=>'English, Canada',
					'en-GB'=>'English, UK',
					'en-IN'=>'English, India',
					'en-US'=>'English, United States',
					'ca-ES'=>'Catalan, Spain',
					'es-ES'=>'Spanish, Spain',
					'es-MX'=>'Spanish, Mexico',
					'fi-FI'=>'Finnish, Finland',
					'fr-CA'=>'French, Canada',
					'fr-FR'=>'French, France',
					'it-IT'=>'Italian, Italy',
					'ja-JP'=>'Japanese, Japan',
					'ko-KR'=>'Korean, Korea',
					'nb-NO'=>'Norwegian, Norway',
					'nl-NL'=>'Dutch, Netherlands',
					'pl-PL'=>'Polish-Poland',
					'pt-BR'=>'Portuguese, Brazil',
					'pt-PT'=>'Portuguese, Portugal',
					'ru-RU'=>'Russian, Russia',
					'sv-SE'=>'Swedish, Sweden',
					'zh-CN'=>'Chinese (Mandarin)',
					'zh-HK'=>'Chinese (Cantonese)',
					'zh-TW'=>'Chinese (Taiwanese Mandarin)'
			);
	}


	// Get array of all Twilio languages spoken only by the 'man' voice (the rest will be spoken by 'alice')
	public static function getManOnlyLanguages()
	{
		return array('en', 'en-gb', 'es', 'fr', 'de', 'it');
	}


	// Return dropdown options (as array) of all languages available in Twilio voice calling service
	public static function getDropdownAllLanguages()
	{
		global $lang;
		// Get all languages available
		$allLang = self::getAllLanguages();
		// Get all voices available
		$allVoices = self::getAllVoices();
		// Get all 'man'-only languages (the rest will be spoken by 'alice')
		$manLang = self::getManOnlyLanguages();
		// Build an array of drop-down options listing all voices/languages
		$options = array();
		foreach ($allLang as $this_lang=>$this_label) {
			// Is alice voice?
			$isAlice = (!in_array($this_lang, $manLang));
			// Get group name
			$this_group_label = $isAlice ? $lang['survey_723'] : $lang['survey_724'];
			// Add to array
			$options[$this_group_label][$this_lang] = "$this_label ($this_group_label)";
		}
		// Return array of options
		return $options;
	}


	// Initialize Twilio client object

	public static function client()
	{
		// Get global variables, or if don't have them, set locals from above as globals
		global $twilio_account_sid, $twilio_auth_token, $twilio_from_number;
		// If not in a project (e.g. entering Survey Access Code) and Twilio is posting,
		// then use the AccountSid passed to retrive the Twilio auth token from the redcap_projects table.
		if (!defined("PROJECT_ID") && isset($_SERVER['HTTP_X_TWILIO_SIGNATURE']) && isset($_POST['AccountSid'])) {
			$twilio_account_sid = $_POST['AccountSid'];
			list ($twilio_auth_token, $twilio_from_number) = self::getTokenByAcctSid($twilio_account_sid);
		}
		// Instantiate a new Twilio Rest Client
		return new Services_Twilio($twilio_account_sid, $twilio_auth_token);
	}


	// Retrive the Twilio auth token from the redcap_projects table using the Twilio account SID
	public static function getTokenByAcctSid($twilio_account_sid)
	{
		$sql = "select twilio_auth_token, twilio_from_number from redcap_projects
				where twilio_account_sid = '".prep($twilio_account_sid)."' limit 1";
		$q = db_query($sql);
		$twilio_auth_token  = db_result($q, 0, 'twilio_auth_token');
		$twilio_from_number = db_result($q, 0, 'twilio_from_number');
		return array($twilio_auth_token, $twilio_from_number);
	}


	// Obtain the voice call "language" setting for the project
	public static function getLanguage()
	{
		global $twilio_voice_language;
		// Get all languages available
		$allLang = self::getAllLanguages();
		// Return abbreviation for language that is set for this request
		return ($twilio_voice_language == null || ($twilio_voice_language != null && !isset($allLang[$twilio_voice_language])))
				? 'en' : $twilio_voice_language;
	}


	// Obtain the gender of the "voice" for the voice call based upon the language selected.
	// Note: Use "man" for en, en-gb, es, fr, de, and it, but for all other languages, use "alice".
	public static function getVoiceGender()
	{
		// Get current language selected
		$current_language = self::getLanguage();
		// Get all 'man'-only languages (the rest will be spoken by 'alice')
		$manLang = self::getManOnlyLanguages();
		// Is alice voice?
		return (in_array($current_language, $manLang)) ? 'man' : 'alice';
	}


	// Return TRUE if Twilio's Request Inspector is enabled.
	// NOTE: This will cause the Twilio account to be charged the cost of a 1-minute voice call.
	public static function requestInspectorEnabled()
	{
		global $twilio_from_number;
		// Initialize Twilio
		TwilioRC::init();
		// Instantiate a new Twilio Rest Client
		$twilioClient = TwilioRC::client();
		// Create call error (have Twilio call itself for a URL that produces invalid TWIML)
		$call = $twilioClient->account->calls->create(self::formatNumber($twilio_from_number), self::formatNumber($twilio_from_number), APP_PATH_SURVEY_FULL . "?__twilio_request_inspector_test=1");
		for ($i = 0; $i < 20; $i++) {
			// Pause for 2 seconds to allow call to fail
			sleep(2);
			// Has the call completed yet? If not, then loop again and wait for next.
			$log = $twilioClient->account->calls->get($call->sid);
			if ($log->status != 'completed') continue;
			// Call has completed, so check its response_body
			foreach ($twilioClient->account->notifications->getIterator(0, 50, array("MessageDate" => date("Y-m-d"), "Log" => "0")) as $notification) {
				// Skip all except the one we're looking for
				if ($notification->call_sid != $call->sid) continue;
				// Is RI enabled? Response body will be blank if not enabled.
				$requestInspectorEnabled = ($notification->response_body != "");
				// Remove the notification now that we've tested it
				$twilioClient->account->notifications->delete($notification->sid);
				// Set timestamp and "enabled" value in db table to note when this was checked
				$sql = "update redcap_projects set twilio_request_inspector_checked = '".NOW."',
						twilio_request_inspector_enabled = ".($requestInspectorEnabled ? '1' : '0')."
						where project_id = " . PROJECT_ID;
				$q = db_query($sql);
				// If response_body is blank, then Request Inspector is enabled
				return $requestInspectorEnabled;
			}
		}
		return false;
	}


	// Add random hash to table for erasing a Twilio call/message call once they have completed
	public static function addEraseCall($project_id, $sid, $sid_hash='', $account_sid=null)
	{
		// If project_id is missing, but we have the $account_sid, then determine project_id based upon $account_sid.
		if (!is_numeric($project_id) && $account_sid != null) {
			$sql = "select project_id from redcap_projects where twilio_enabled = 1
					and twilio_account_sid = '".prep($account_sid)."' order by project_id desc limit 1";
			$q = db_query($sql);
			if (db_num_rows($q)) $project_id = db_result($q, 0);
		}
		// Add to table
		$sql = "insert into redcap_surveys_erase_twilio_log (project_id, ts, sid, sid_hash) values
				(".checkNull($project_id).", '".NOW."', '".prep($sid)."', ".checkNull($sid_hash).")";
		return db_query($sql);
	}


	// Use an sid hash that will be passed by Twilio for its callback when a request ends in order to then
	// call Twilio to delete the log of the Twilio event. This cleans up the Twilio log right after the event.
	// Returns the original SID of the event.
	public static function eraseCallLog($sid_hash)
	{
		$sql = "select tl_id, sid, project_id from redcap_surveys_erase_twilio_log where sid_hash = '".prep($sid_hash)."'";
		$q = db_query($sql);
		if (!db_num_rows($q)) return array(false, false);
		// Get sid
		$sid = db_result($q, 0, 'sid');
		$tl_id = db_result($q, 0, 'tl_id');
		$project_id = db_result($q, 0, 'project_id');
		// Delete row from table
		$sql = "delete from redcap_surveys_erase_twilio_log where tl_id = $tl_id";
		$q = db_query($sql);
		// Return the sid
		return array($project_id, $sid);
	}


	// Delete the Twilio back-end and front-end log of a given SMS (will try every second for up to 30 seconds)
	public static function deleteLogForSMS($sid, $twilioClient)
	{
		// Delete the log of this SMS (try every second for up to 30 seconds)
		for ($i = 0; $i < 30; $i++) {
			// Pause for 1 second to allow SMS to get delivered to carrier
			if ($i > 0) sleep(1);
			// Has it been delivered yet? If not, wait another second.
			$log = $twilioClient->account->sms_messages->get($sid);
			if ($log->status != 'delivered') continue;
			// Yes, it was delivered, so delete the log of it being sent.
			$twilioClient->account->messages->delete($sid);
			return true;
		}
		// Failed
		return false;
	}


	// Delete the Twilio back-end and front-end log of a given call (will try every second for up to 30 seconds)
	public static function deleteLogForCall($sid, $twilioClient)
	{
		// Delete the log of this SMS (try every second for up to 30 seconds)
		for ($i = 0; $i < 30; $i++) {
			// Pause for 1 second to allow SMS to get delivered to carrier
			if ($i > 0) sleep(1);
			// Has it been delivered yet? If not, wait another second.
			$log = $twilioClient->account->calls->get($sid);
			if ($log->status != 'completed') continue;
			// Yes, it was delivered, so delete the log of it being sent.
			$twilioClient->account->calls->delete($sid);
			return true;
		}
		// Failed
		return false;
	}


	// Convert phone nubmer to E.164 format before handing off to Twilio
	public static function formatNumber($phoneNumber)
	{
		// If number contains an extension (denoted by a comma between the number and extension), then separate here and add later
		$phoneExtension = "";
		if (strpos($phoneNumber, ",") !== false) {
			list ($phoneNumber, $phoneExtension) = explode(",", $phoneNumber, 2);
		}
		// Remove all non-numerals
		$phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);
		// Prepend number with + for international use cases
		$phoneNumber = (isPhoneUS($phoneNumber) ? "+1" : "+") . $phoneNumber;
		// If has an extension, re-add it
		if ($phoneExtension != "") $phoneNumber .= ",$phoneExtension";
		// Return formatted number
		return $phoneNumber;
	}


	// Function to send SMS message. Segments by 160 characters per SMS, if body is longer.
	public static function sendSMS($text, $number_to_sms, $twilioClient, $twilio_from_number_alt=null, $deleteSmsFromLog=true)
	{
		// Get the 'From' number
		if ($twilio_from_number_alt == null) {
			global $twilio_from_number;
		} else {
			$twilio_from_number = $twilio_from_number_alt;
		}
		// Set random string to use to explode message into multiple parts
		$sms_splitter = "||RCSMS||";
		// Clean string
		$text = trim(replaceNBSP(strip_tags(str_replace(array("\r\n", "\n", "\t"), array(" ", " ", " "), label_decode($text)))));
		// Dev testing of output
		//if (isDev() && !isset($_SERVER['HTTP_X_TWILIO_SIGNATURE'])) print "TEXT: $text\n";
		// If From and To number are the same, return an error
		if (str_replace(array(" ", "(", ")", "-"), array("", "", "", ""), $twilio_from_number)
				== str_replace(array(" ", "(", ")", "-"), array("", "", "", ""), $number_to_sms)) {
			return "ERROR: The From and To number cannot be the same ($number_to_sms).";
		}
		// Send SMS (Twilio currently has the ability to automatically segment messages according to carrier.
		// Will this work 100% of the time? If you find that it does not, then uncomment lines below to allow REDCap to segment it.)
		try {
			$sms = $twilioClient->account->messages->sendMessage(self::formatNumber($twilio_from_number), self::formatNumber($number_to_sms), $text);
			// Wait till the SMS sends completely and then remove it from the Twilio logs
			if ($deleteSmsFromLog) {
				sleep(1);
				self::deleteLogForSMS($sms->sid, $twilioClient);
			}
			// Successful, so return true
			return true;
		} catch (Exception $e) {
			// On failure, return error message
			return $e->getMessage();
		}
	}


	// Ask respondent to enter survey access code (either voice call or SMS)
	public static function promptSurveyCode($voiceCall=true, $respondentPhoneNumber=null)
	{
		global $lang;
		// If missing the respondent's phone number, then return error
		if ($respondentPhoneNumber == null) exit("ERROR!");

		if ($voiceCall) {
			## VOICE CALL
			// Instantiate Twilio TwiML object
			$twiml = new Services_Twilio_Twiml();
			// Set question properties
			$gather = $twiml->gather(array('method'=>'POST', 'action'=>APP_PATH_SURVEY_FULL, 'finishOnKey'=>self::VOICE_SKIP_DIGIT));
			// Say the field label
			$gather->say($lang['survey_619']);
			// Output twiml
			print $twiml;
		} else {
			## SMS
			// Instantiate a new Twilio Rest Client
			$twilioClient = TwilioRC::client();
			// Send SMS
			$smsSuccess = self::sendSMS($lang['survey_619'], $respondentPhoneNumber, $twilioClient);
			if ($smsSuccess !== true) {
				// Error sending SMS
			}
		}
		exit;
	}


	// Clean and format the phone numbers used to query the redcap_surveys_phone_codes table
	public static function formatSmsAccessCodePhoneNumbers($participant_phone, $twilio_phone)
	{
		// Remove all non-numeral characters
		$participant_phone = preg_replace('/[^0-9]+/', '', $participant_phone);
		$twilio_phone = preg_replace('/[^0-9]+/', '', $twilio_phone);
		// Remove "1" as U.S. prefix
		if (strlen($participant_phone) == 11 && substr($participant_phone, 0, 1) == '1') {
			$participant_phone = substr($participant_phone, 1);
		}
		if (strlen($twilio_phone) == 11 && substr($twilio_phone, 0, 1) == '1') {
			$twilio_phone = substr($twilio_phone, 1);
		}
		// Return numbers
		return array($participant_phone, $twilio_phone);
	}


	// Obtain the Survey Access Code for a given phone number from the redcap_surveys_phone_codes table
	public static function getSmsAccessCodeFromPhoneNumber($participant_phone, $twilio_phone)
	{
		// Clean and format the phone numbers used to query the redcap_surveys_phone_codes table
		list ($participant_phone, $twilio_phone) = self::formatSmsAccessCodePhoneNumbers($participant_phone, $twilio_phone);
		// Return null if either numbers are blank
		if ($participant_phone == '' || $twilio_phone == '') return null;
		// Check if in table
		$sql = "select c.access_code, p.twilio_multiple_sms_behavior
				from redcap_surveys_phone_codes c, redcap_projects p, redcap_surveys_participants a, redcap_surveys_response r
				where c.phone_number = '".prep($participant_phone)."' and c.twilio_number = '".prep($twilio_phone)."'
				and c.project_id = p.project_id and a.access_code_numeral = replace(c.access_code, 'V', '') and a.participant_email is not null
				and a.participant_id = r.participant_id and r.completion_time is null order by c.pc_id desc";
		$q = db_query($sql);		
		$num_rows = db_num_rows($q);
		// If failed to find the access code, then check public survey link
		if ($num_rows == 0) {
			$sql = "select distinct c.access_code, p.twilio_multiple_sms_behavior
					from redcap_surveys_phone_codes c, redcap_projects p, redcap_surveys_participants a
					where c.phone_number = '".prep($participant_phone)."' and c.twilio_number = '".prep($twilio_phone)."'
					and c.project_id = p.project_id and a.access_code_numeral = replace(c.access_code, 'V', '') 
					and a.participant_email is null order by c.pc_id desc";
			$q = db_query($sql);		
			$num_rows = db_num_rows($q);
		}
		// Return access code
		if ($num_rows > 0) {
			// Return code
			$access_codes = array();
			while ($row = db_fetch_assoc($q)) {
				// Set this loop's values
				$sms_behavior = $row['twilio_multiple_sms_behavior'];
				$access_code = $row['access_code'];
				// RETURN LAST INVITE'S ACCESS CODE or the ONLY ACCESS CODE: If this project is set to return only the LAST SMS invite sent, then ignore the rest
				if ($num_rows == 1 || $sms_behavior == 'OVERWRITE') {
					// Return access code
					return $access_code;
				}
				// RETURN ALL INVITES with their access codes as an array
				else {
					$access_codes[] = $access_code;
				}
			}
			// If only returning the FIRST invitation's access code (chronologically speaking), then return here (will be last here because we're doing DESC order)
			if ($sms_behavior == 'FIRST') {
				return $access_code;
			}
			// Since we're returning all access codes available, return them as an array
			return $access_codes;
		} else {
			// Return null since the number has no stored code
			return null;
		}
	}


	// Delete the Survey Access Code for a given phone number from the redcap_surveys_phone_codes table
	public static function deleteSmsAccessCodeFromPhoneNumber($participant_phone, $twilio_phone, $access_code=null)
	{
		// Clean and format the phone numbers used to query the redcap_surveys_phone_codes table
		list ($participant_phone, $twilio_phone) = self::formatSmsAccessCodePhoneNumbers($participant_phone, $twilio_phone);
		// Return null if either numbers are blank
		if ($participant_phone == '' || $twilio_phone == '') return false;
		// Now delete the code from the table since we no longer need it
		$sql = "delete from redcap_surveys_phone_codes where phone_number = '".prep($participant_phone)."'
				and twilio_number = '".prep($twilio_phone)."'";
		if ($access_code != null) {
			$sql .= " and access_code = '".prep($access_code)."'";
		}
		return db_query($sql);
	}


	// Add Survey Access Code for a given phone number to the redcap_surveys_phone_codes table
	public static function addSmsAccessCodeForPhoneNumber($participant_phone, $twilio_phone, $access_code, $project_id='')
	{
		// Remove all non-numeral characters
		$participant_phone = preg_replace('/[^0-9]+/', '', $participant_phone);
		if ($participant_phone == '') return null;
		$twilio_phone = preg_replace('/[^0-9]+/', '', $twilio_phone);
		if ($twilio_phone == '') return null;
		// Remove "1" as U.S. prefix
		if (strlen($participant_phone) == 11 && substr($participant_phone, 0, 1) == '1') {
			$participant_phone = substr($participant_phone, 1);
		}
		if (strlen($twilio_phone) == 11 && substr($twilio_phone, 0, 1) == '1') {
			$twilio_phone = substr($twilio_phone, 1);
		}
		// Add to table (update table if phone number already exists for this survey)
		$sql = "insert into redcap_surveys_phone_codes (phone_number, twilio_number, access_code, project_id)
				values ('".prep($participant_phone)."', '".prep($twilio_phone)."', '".prep($access_code)."', ".checkNull($project_id).")";
		// Return true on success or false on fail
		return db_query($sql);
	}


	// Obtain the project_id of a project from one or more number survey access codes
	public static function getProjectIdFromNumericAccessCode($codes)
	{
		// If not an array, then convert to array
		if (!is_array($codes)) $codes = array($codes);
		// Remove the "V" at beginning of any codes because we're checking on access_code_numeral only
		foreach ($codes as &$code) {
			$code = str_replace("V", "", $code);
		}
		// Get project_id
		$sql = "select s.project_id from redcap_surveys_participants p, redcap_surveys s
				where p.access_code_numeral in (".prep_implode($codes).") and s.survey_id = p.survey_id limit 1";
		$q = db_query($sql);
		return db_result($q, 0);
	}


	// Obtain an array of survey access codes (as keys) and survey titles (values) from one or more number survey access codes
	public static function getSurveyTitlesFromNumericAccessCode($codes, $truncateSurveyTitle=true)
	{
		// If not an array, then convert to array
		if (!is_array($codes)) $codes = array($codes);
		// Remove the "V" at beginning of any codes because we're checking on access_code_numeral only
		$codes_sql = $codes_orig = array();
		foreach ($codes as $code) {
			$code_numeric = str_replace("V", "", $code);
			$codes_sql[] = $code_numeric;
			$codes_orig[$code_numeric] = $code;
		}
		// Get titles
		$sql = "select s.title, p.access_code_numeral
				from redcap_surveys_participants p, redcap_surveys s, redcap_surveys_phone_codes c
				where p.access_code_numeral in (".prep_implode($codes_sql).") and s.survey_id = p.survey_id
				and p.access_code_numeral = replace(c.access_code, 'V', '') order by c.pc_id";
		$q = db_query($sql);
		$phone_codes_titles = array();
		while ($srow = db_fetch_assoc($q)) {
			// Limit title to 20 chars (replacing middle chars with ellipsis)
			$srow['title'] = strip_tags(label_decode($srow['title']));
			if ($truncateSurveyTitle && strlen($srow['title']) > 20) {
				$srow['title'] = substr($srow['title'], 0, 12) . "..." . substr($srow['title'], -6);
			}
			// Add to array
			$phone_codes_titles[$codes_orig[$srow['access_code_numeral']]] = $srow['title'];
		}
		return $phone_codes_titles;
	}


	// Determine if a field's multiple choice options all have numerical coded values
	// $enum is provided as the element_enum string
	public static function allChoicesNumerical($enum)
	{
		foreach (parseEnum($enum) as $this_code=>$this_label) {
			if (!is_numeric($this_code)) return false;
		}
		return true;
	}

	// Determine if a field's usage in a SMS or voice call survey is viable for those mediums.
	// Provide $field_type of the field and $type as "SMS" or "VOICE", as well as its validation type $val_type, if applicable.
	// Return FALSE if the field is not viable for the given medium, which means that the field will be skipped in the survey.
	public static function fieldUsageIVR($type="SMS", $field_name)
	{
		// Get globals
		global $Proj, $lang;

		// Get all validation types
		$all_val_types = getValTypes();

		// Get field attributes
		$field_type = $Proj->metadata[$field_name]['element_type'];
		$choices = $Proj->metadata[$field_name]['element_enum'];
		$val_type = convertLegacyValidationType($Proj->metadata[$field_name]['element_validation_type']);
		$data_type = ($field_type == 'text' && $val_type != '') ? $all_val_types[$val_type]['data_type'] : '';

		## SMS
		if ($type == "SMS") {
			if ($field_type == 'text') {
				return true;
			} elseif ($field_type == 'textarea') {
				return true;
			} elseif ($field_type == 'calc') {
				return $lang['survey_886'];
			} elseif ($field_type == 'select') {
				return true;
			} elseif ($field_type == 'radio') {
				return true;
			} elseif ($field_type == 'yesno') {
				return true;
			} elseif ($field_type == 'truefalse') {
				return true;
			} elseif ($field_type == 'checkbox') {
				return true;
			} elseif ($field_type == 'file') {
				return $lang['survey_888'];
			} elseif ($field_type == 'slider') {
				return true;
			} elseif ($field_type == 'descriptive') {
				return true;
			} elseif ($field_type == 'sql') {
				return true;
			} else {
				return $lang['survey_887'];
			}
		}

		## VOICE CALL
		else {
			if ($field_type == 'text') {
				// Only allow number or integer data types
				return ($data_type == 'integer' || $data_type == 'number' ? true : $lang['survey_889']);
			} elseif ($field_type == 'textarea') {
				return $lang['survey_892'];
			} elseif ($field_type == 'calc') {
				return $lang['survey_886'];
			} elseif ($field_type == 'select') {
				return (self::allChoicesNumerical($choices) ? true : $lang['survey_890']);
			} elseif ($field_type == 'radio') {
				return (self::allChoicesNumerical($choices) ? true : $lang['survey_890']);
			} elseif ($field_type == 'yesno') {
				return true;
			} elseif ($field_type == 'truefalse') {
				return true;
			} elseif ($field_type == 'checkbox') {
				return $lang['survey_891'];
			} elseif ($field_type == 'file') {
				return $lang['survey_888'];
			} elseif ($field_type == 'slider') {
				return true;
			} elseif ($field_type == 'descriptive') {
				return true;
			} elseif ($field_type == 'sql') {
				return (self::allChoicesNumerical(getSqlFieldEnum($choices)) ? true : $lang['survey_890']);
			} else {
				return $lang['survey_887'];
			}
		}
	}


	// Redirect Twilio to another survey page
	public static function redirectSurvey($hash=null)
	{
		// Redirect to survey page
		print  '<?xml version="1.0" encoding="UTF-8"?>
				<Response>
					<Redirect method="POST">'.APP_PATH_SURVEY."index.php".($hash == null ? "" : "?s=$hash").'</Redirect>
				</Response>';
		exit;
	}


	// Take enum array and return int of the maximum number of numerical digits that a set of choices has
	public static function getChoicesMaxDigits($this_enum_array)
	{
		// Set defaults
		$num_digits = 1;
		// In not array, return default
		if (!is_array($this_enum_array)) return $num_digits;
		// Loop through choices
		foreach ($this_enum_array as $key=>$val) {
			// If not numeric, then skip
			if (!is_numeric($key)) continue;
			// If numeric, then count digits
			$num_digits = strlen($key."");
		}
		// Return count
		return $num_digits;
	}


	// Use $_SERVER['HTTP_X_TWILIO_SIGNATURE'] to validate that this request is truly coming from Twilio
	public static function verifyTwilioServerSignature($twilioAuthToken="", $current_url)
	{
		require_once dirname(dirname(__FILE__)) . "/Config/init_global.php";
		// Initialize Twilio classes
		self::init();
		// Instatiate the validator
		$validator = new Services_Twilio_RequestValidator($twilioAuthToken);
		// Validate the signature
		return $validator->validate($_SERVER['HTTP_X_TWILIO_SIGNATURE'], $current_url, $_POST);
	}


	/**
	 * ERASE TWILIO CALL/SMS LOGS FROM THE TWILIO ACCOUNT
	 * Clear all items from redcap_surveys_erase_twilio_log table.
	 */
	public static function EraseTwilioWebsiteLog()
	{
		// See if any are in the table
		$sql = "select l.tl_id, l.project_id, l.sid, p.twilio_account_sid, p.twilio_auth_token, p.twilio_from_number
				from redcap_surveys_erase_twilio_log l, redcap_projects p
				where p.project_id = l.project_id order by l.ts desc";
		$q = db_query($sql);
		$rowsDeleted = 0;
		$phoneNumbers = array();
		if (db_num_rows($q) > 0) {
			// Initialize Twilio
			TwilioRC::init();
			// Loop through results
			while ($row = db_fetch_assoc($q)) {
				// Erase the log of this event (either SMS or call)
				try {
					// Set Twilio client
					$twilioClient = new Services_Twilio($row['twilio_account_sid'], $row['twilio_auth_token']);
					// Delete this SID
					if (substr($row['sid'], 0, 2) == 'SM') {
						$twilioClient->account->messages->delete($row['sid']);
					} else {
						$twilioClient->account->calls->delete($row['sid']);
					}
				} catch (Exception $e) { }
				// Add to $phoneNumbers					
				if (!isset($phoneNumbers[$row['project_id']])) {
					$phoneNumbers[$row['project_id']] = array('sid'=>$row['twilio_account_sid'], 'token'=>$row['twilio_auth_token'], 'phone'=>$row['twilio_from_number']);
				}
				// Delete row from table
				$sql = "delete from redcap_surveys_erase_twilio_log where tl_id = " . $row['tl_id'];
				db_query($sql);
				$rowsDeleted += db_affected_rows();
			}
			// Do extra cleanup of ALL the phone number's logs (for compliance purposes, just in case we've missed something)
			foreach ($phoneNumbers as $attr) {
				self::EraseAllTwilioWebsiteLog($attr['sid'], $attr['token'], $attr['phone']);
			}
		}
		// Return count of rows deleted
		return $rowsDeleted;
	}


	/**
	 * ERASE *ALL* TWILIO CALL/SMS LOGS FOR A GIVEN PHONE NUMBER
	 * Serves as extra cleaning in case EraseTwilioWebsiteLog() missed something
	 */
	public static function EraseAllTwilioWebsiteLog($sid, $token, $phone)
	{
		// Format phone
		if ($phone == '') return;
		$phone = self::formatNumber($phone);
		// Set Twilio client
		$twilioClient = new Services_Twilio($sid, $token);	
		// ToFrom array
		$toFroms = array("From", "To");
		try {
			$itemTypes = array($twilioClient->account->calls, $twilioClient->account->messages);
			// Loop through both calls and SMS
			foreach ($itemTypes as $itemType) {
				// Loop through both To and From calls/SMS or this phone number
				foreach ($toFroms as $toFrom) {
					// Loop through each call/SMS in the log and delete it
					foreach ($itemType->getIterator(0, 50, array($toFrom => $phone)) as $item) {		
						// Delete the log of this call/SMS
						try {
							$itemType->delete($item->sid);
						} catch (Exception $e) { }
					}
				}
			}
		} catch (Exception $e) { }
	}

}