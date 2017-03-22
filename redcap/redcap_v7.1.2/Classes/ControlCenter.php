<?php

class ControlCenter
{	
	// Find Calc Errors: Get projects that have had activity in the past year (ignore Practice projects and those in Development)
	// and have at least one record and one calc field. Return array of project_id's.
	public static function findCalcErrorsGetProjectList($includeDevProjects=false)
	{
		global $auth_meth_global;
		$oneYearAgo = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")-1));
		$sqlsub = $includeDevProjects ? "" : "and p.status > 0";
		$sqlsub2 = ($auth_meth_global == 'none') ? "" : "and p.auth_meth != 'none'";		
		$sql = "select p.project_id from redcap_projects p 
				left join redcap_record_counts c on c.project_id = p.project_id
				where p.date_deleted is null and p.purpose > 0 and p.purpose is not null $sqlsub $sqlsub2
				and p.last_logged_event is not null and p.last_logged_event > '$oneYearAgo' 
				and if (c.record_count is not null, c.record_count, (select 1 from redcap_data d where d.project_id = p.project_id limit 1)) > 0
				and (select 1 from redcap_metadata m where m.project_id = p.project_id and m.element_type = 'calc' limit 1) > 0
				order by p.project_id";
		$q = db_query($sql);
		$projects = array();
		while ($row = db_fetch_assoc($q)) {
			$projects[] = $row['project_id'];			
		}
		return $projects;
	}
		
	// Render the Find Calc Errors page
	public static function findCalcErrorsSingleProject($numRecordsToCheck=100)
	{
		// Loop through each project
		global $Proj;
		$numRecordsToCheck = (int)$numRecordsToCheck;
		if ($numRecordsToCheck < 1) exit('0');
		$hasRepeatingFormsEvents = $Proj->hasRepeatingFormsEvents();
		// Parse the nextPids param
		$nextPids = array();
		foreach (explode(",", $_POST['nextPids']) as $nextPid) {
			if (is_numeric($nextPid)) $nextPids[] = $nextPid;
		}
		$nextPid = empty($nextPids) ? "" : array_shift($nextPids);
		// Collect all calc fields in project to use in next query
		$calc_fields = array();
		foreach ($Proj->metadata as $this_field=>$attr) {
			if ($attr['element_type'] != 'calc') continue;
			$calc_fields[] = $this_field;
		}
		// Get list of 100 random records from the project that have a value saved for a calc field
		$sql = "select distinct record from redcap_data where project_id = ".PROJECT_ID."
				and field_name in (" . prep_implode($calc_fields) . ") 
				order by rand() limit $numRecordsToCheck";
		$q = db_query($sql);
		$records = array();
		while ($row = db_fetch_assoc($q)) {
			$records[] = $row['record'];			
		}
		// If there are somethow no records, then skip (miscounted in original query?)
		if (!empty($records)) {
			// Find any incorrect calculations that exist in the data
			$incorrectCalcs = Calculate::calculateMultipleFields($records, array(), true);
			if (!empty($incorrectCalcs))
			{
				// Find any DQ exceptions for Rule H (pd-rule_id=10)
				$excluded = array();
				$sql = "select record, event_id, field_name, instance from redcap_data_quality_status
						where pd_rule_id = 10 and project_id = " . PROJECT_ID .  " and exclude = 1
						and record in (" . prep_implode($records) . ") and field_name in (" . prep_implode($calc_fields) . ")";
				$q = db_query($sql);
				while ($row = db_fetch_assoc($q))
				{
					// Repeating forms/events
					$isRepeatEvent = ($hasRepeatingFormsEvents && $Proj->isRepeatingEvent($row['event_id']));
					$isRepeatForm  = $isRepeatEvent ? false : ($hasRepeatingFormsEvents && $Proj->isRepeatingForm($row['event_id'], $Proj->metadata[$row['field_name']]['form_name']));
					$isRepeatEventOrForm = ($isRepeatEvent || $isRepeatForm);
					$repeat_instrument = $isRepeatForm ? $Proj->metadata[$row['field_name']]['form_name'] : "";
					$instance = $isRepeatEventOrForm ? $row['instance'] : 0;
					// Remove from $incorrectCalcs array, if exists
					if (isset($incorrectCalcs[$row['record']][$row['event_id']][$repeat_instrument][$instance][$row['field_name']])) {
						unset($incorrectCalcs[$row['record']][$row['event_id']][$repeat_instrument][$instance][$row['field_name']]);
					}
				}
				// Loop through $incorrectCalcs array and remove any sub-arrays that are now empty because we removed their values above
				foreach ($incorrectCalcs as $this_record=>$attr) {
					foreach ($attr as $this_event_id=>$bttr) {
						foreach ($bttr as $this_repeat_instrument=>$cttr) {
							foreach ($cttr as $this_repeat_instance=>$dttr) {
								if (empty($incorrectCalcs[$this_record][$this_event_id][$this_repeat_instrument][$this_repeat_instance])) unset($incorrectCalcs[$this_record][$this_event_id][$this_repeat_instrument][$this_repeat_instance]);
							}
							if (empty($incorrectCalcs[$this_record][$this_event_id][$this_repeat_instrument])) unset($incorrectCalcs[$this_record][$this_event_id][$this_repeat_instrument]);
						}
						if (empty($incorrectCalcs[$this_record][$this_event_id])) unset($incorrectCalcs[$this_record][$this_event_id]);
					}
					if (empty($incorrectCalcs[$this_record])) unset($incorrectCalcs[$this_record]);
				}
			}
		}
		// Return a 0 if no errors found, else return 1
		$hasErrors = (empty($records) || empty($incorrectCalcs)) ? 0 : 1;
		// Find first user with Design/User Rights privileges on project who logged into REDCap most recently
		$sql = "select i.ui_id, i.user_email from redcap_user_rights r, redcap_user_information i 
				where r.project_id = ".PROJECT_ID." and r.username = i.username and (r.user_rights = 1 or r.design = 1) 
				and r.expiration is null and i.user_email is not null and i.user_suspended_time is null
				order by i.user_lastlogin desc limit 1";
		$q = db_query($sql);
		// If there is no one to contact, then flag it as okay to ignore (not sure what else we can do)
		if (!db_num_rows($q)) $hasErrors = 0;
		$contactUiId = db_result($q, 0, 'ui_id');
		$contactEmail = db_result($q, 0, 'user_email');
		// Output JSON
		print json_encode(array('thisPid'=>$nextPid, 'hasErrors'=>$hasErrors, 
								'contactUiId'=>$contactUiId, 'contactEmail'=>$contactEmail, 
								'nextPids'=>implode(",", $nextPids)));
	}
		
	// Send notification email to users of affected projects on the the Find Calc Errors page
	public static function findCalcErrorsEmailUsers()
	{
		global $project_contact_email, $lang, $redcap_version;
		// Build userProjects array to loop through below when send emails
		$userProjects = $pidTitles = $userEmails = array();
		foreach (explode(",", $_POST['projectsUsers']) as $pidUser) {
			if ($pidUser == '') continue;
			list ($pid, $uiid) = explode(":", $pidUser, 2);
			if (!is_numeric($pid) || !is_numeric($uiid)) continue;
			$userProjects[$uiid][] = $pid;
			$pidTitles[$pid] = '';
		}
		// All the email address of all users here
		$sql = "select ui_id, user_email from redcap_user_information 
				where ui_id in (".prep_implode(array_keys($userProjects)).")";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$userEmails[$row['ui_id']] = $row['user_email'];
		}		
		// Obtain project title of all projects here
		$sql = "select project_id, app_title from redcap_projects 
				where project_id in (".prep_implode(array_keys($pidTitles)).")";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$pidTitles[$row['project_id']] = trim(strip_tags(label_decode($row['app_title'])));
		}
		// Init email
		$email = new Message();
		$email->setSubject($_POST['emailSubject']);
		$email->setFrom($project_contact_email);
		$_POST['emailContent'] = nl2br(trim($_POST['emailContent']));
		// Loop through users and send email to each
		foreach ($userProjects as $uiid=>$pids) {			
			// Send email to user for this project
			$email->setTo($userEmails[$uiid]);
			$emailContent = $_POST['emailContent'] . RCView::br() . RCView::br() . RCView::b($lang['control_center_4599']);
			// Append project titles to email content
			foreach ($pids as $pid) {
				$emailContent .= RCView::br() . " - \"" . RCView::a(array('href'=>APP_PATH_WEBROOT_FULL."redcap_v{$redcap_version}/DataQuality/index.php?pid=$pid"), $pidTitles[$pid]) . "\""; 
			}
			// Set body and send
			$email->setBody($emailContent, true);
			$email->send();
		}
		// Return 
		print 	RCView::div(array('class'=>'darkgreen', 'style'=>'font-size:14px;'),
					$lang['setup_08'] . " " . count($userProjects) . " " . $lang['control_center_4600'] . " " .
					count($pidTitles) . " " . $lang['control_center_4601']
				);
	}
}