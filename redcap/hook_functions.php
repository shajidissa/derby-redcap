<?php

// **********************************************************************************************
// This file is the HOOKS FUNCTIONS file that holds the functions for all hooks used by REDCap.
// NOTE: Most hooks point to a PHP file (named after the hook function) that sits inside a
// project-level sub-directory in the /redcap/hooks folder, so if you wish to utilize a hook
// for a specific project, create a sub-directory in the /redcap/hooks folder named
// "pid{$project_id}" with a PHP file named after the hook function inside it, and then that PHP
// file will be called when REDCap calls the hook for that project.
// **********************************************************************************************


// REDCAP_EVERY_PAGE_BEFORE_RENDER
function redcap_every_page_before_render($project_id=null) 
{
	if ($project_id !== null) {
		// Set the full path of the project handler PHP script located inside the 
		// project-specific sub-folder, which itself exists in the main Hooks folder.
		$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
		// Check if the project handler PHP script exists for this project, and if so,
		// then "include" the script to execute it. If not, do nothing.
		if (file_exists($project_handler_script)) include $project_handler_script;
	}
}


// REDCAP_EVERY_PAGE_TOP
function redcap_every_page_top($project_id=null) 
{
	if ($project_id !== null) {
		// Set the full path of the project handler PHP script located inside the 
		// project-specific sub-folder, which itself exists in the main Hooks folder.
		$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
		// Check if the project handler PHP script exists for this project, and if so,
		// then "include" the script to execute it. If not, do nothing.
		if (file_exists($project_handler_script)) include $project_handler_script;
	}
}


// REDCAP_DATA_ENTRY_FORM
function redcap_data_entry_form($project_id, $record, $instrument, $event_id, $group_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_DATA_ENTRY_FORM TOP
function redcap_data_entry_form_top($project_id, $record, $instrument, $event_id, $group_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_SAVE_RECORD
function redcap_save_record($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_SURVEY_COMPLETE
function redcap_survey_complete($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_SURVEY_PAGE
function redcap_survey_page($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_SURVEY_PAGE TOP
function redcap_survey_page_top($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// ADD/EDIT RECORDS PAGE
function redcap_add_edit_records_page($project_id, $instrument, $event_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_USER_RIGHTS
function redcap_user_rights($project_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_PROJECT_HOME_PAGE
function redcap_project_home_page($project_id)
{
	// Set the full path of the project handler PHP script located inside the 
    // project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/".__FUNCTION__.".php";
	// Check if the project handler PHP script exists for this project, and if so,
    // then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}


// REDCAP_CUSTOM_VERIFY_USERNAME
function redcap_custom_verify_username($user)
{
	
}
