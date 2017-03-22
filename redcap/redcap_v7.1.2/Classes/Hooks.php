<?php

// Include REDCap Hooks file, if defined
global $hook_functions_file;
$hook_functions_file = trim($hook_functions_file);
if (isset($hook_functions_file) && $hook_functions_file != '') {
	if (!include_once($hook_functions_file)) {
		if (!include_once(dirname(dirname($hook_functions_file)).DS.basename($hook_functions_file))) {
			include_once(dirname(dirname(dirname($hook_functions_file))).DS.basename($hook_functions_file));
		}
	}
}


/**
 * CLASS FOR PROCESSING REDCAP HOOK FUNCTIONS
 * Each function will be called in a REDCap script via Hooks::call($function_name, $params=array()),
 * which will call the custom function defined inside $hook_functions_file. The returned values from the
 * custom function will then be processed by a method in this class having the same function name.
 */
class Hooks
{
	// Call a REDCap Hook function
	public static function call($function_name, $params=array())
	{
		// If function does not exist in this class or in the custom PHP file, then return
		if (!function_exists($function_name) || !method_exists(__CLASS__, $function_name)) return false;
		// Call the hook function
		$result = call_user_func_array($function_name, $params);
		// If an array is not returned, then return
		if (!is_array($result)) return false;
		// Call the appropriate method to process the return values, then return anything returned by the custom function
		return call_user_func_array(__CLASS__ . '::' . $function_name, array($result));
	}


	/**
	 * SUMMARY: Allows custom actions to be performed at the top of every page in REDCap (including plugins that render the REDCap page header)
	 * DESCRIPTION: void <b>redcap_every_page_top</b> ( int <b>$project_id</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed at the top of every page in REDCap (including plugins that render the REDCap page header). You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired. <b>NOTICE: Regardless of the modifications made to the REDCap user interface with this hook, the REDCap copyright statement must still be visible on every page. If the copyright statement is obscured or removed by a hook, it should be displayed somewhere else on that page using REDCap::getCopyright.</b>
	 * PARAM: project_id - The project ID number of the REDCap project in which the hook is being called. If this hook is called on a non-project page, project_id will be NULL.
	 * LOCATION_OF_EXECUTION: The function is executed at the very top of *every* page in REDCap (right after the initial BODY tag) on project and non-project pages.
	 * VERSION: 6.14.0
	 * EXAMPLE: Add some custom CSS to every page to change the style of the entire application.
<pre>
function redcap_every_page_top($project_id)
{
	?>&lt;link rel="stylesheet" type="text/css" href="/plugins/fancy/style.css" media="screen">&lt;?php
}
</pre>
	 * EXAMPLE: Add some custom session variables to be used for only by specific users for every PHP script in REDCap.
<pre>
function redcap_every_page_top($project_id)
{
	// Set a value based upon the logged-in user's username
	if (SUPER_USER || USERID == 'paul.harris') 
	{
		// Use this session variable in other hooks to perform a specic action/behavior
		$_SESSION['show_special_features'] = true;
	}
}
</pre>
	 * EXAMPLE: Add some page-specific logic to perform things only for specific pages in REDCap. Note: You can use the PAGE constant to refer to specific PHP scripts within subdirctories in the REDCap version directory (e.g., redcap_vX.X.X) in which they will always have the format SubdirectoryName/my_php_script.php.
<pre>
function redcap_every_page_top($project_id)
{
	// Do something on the Online Designer page
	if (PAGE == 'Design/online_designer.php') 
	{
		// ...
	}
	
	// Do something on the File Repository page but only for a specific project
	elseif ($project_id == 759 && PAGE == 'FileRepository/index.php') 
	{
		// ...
	}
}
</pre>
	 * EXAMPLE: Incorporate calls to a framework or helper scripts that you wish to utilize throughout REDCap on every page.
<pre>
function redcap_every_page_top($project_id)
{
	// Call the framework class (this is just an example of how this methodology *might* look)
	require "/framework_path/my_framework.php";
	
	// Instantiate the object to use as a global variable in other hooks or plugins throughout REDCap.
	$framework = new FrameworkObject();
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_survey_page.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
	 */
    public static function redcap_every_page_top($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed by every PHP script in REDCap (including plugins) before the script itself begins to be formally processed.
	 * DESCRIPTION: void <b>redcap_every_page_before_render</b> ( int <b>$project_id</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed by every PHP script in REDCap (including plugins) before the script itself begins to be processed (i.e., it is executed at the end of REDCap's config script prior to formal processing of the parent script). You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired. <b>NOTICE: Regardless of the modifications made to the REDCap user interface with this hook, the REDCap copyright statement must still be visible on every page. If the copyright statement is obscured or removed by a hook, it should be displayed somewhere else on that page using REDCap::getCopyright.</b>
	 * PARAM: project_id - The project ID number of the REDCap project in which the hook is being called. If this hook is called on a non-project page, project_id will be NULL.
	 * LOCATION_OF_EXECUTION: The function is executed by *every* PHP script in REDCap before the script is even processed (i.e., it is executed at the end of REDCap's config script prior to formal processing of the parent script).
	 * VERSION: 6.14.0
	 * EXAMPLE: Add some custom session variables to be used for only by specific users for every PHP script in REDCap.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Set a value based upon the logged-in user's username
	if (SUPER_USER || USERID == 'paul.harris') 
	{
		// Use this session variable in other hooks to perform a specic action/behavior
		$_SESSION['show_special_features'] = true;
	}
}
</pre>
	 * EXAMPLE: Add some page-specific logic to perform things only for specific pages in REDCap. Note: You can use the PAGE constant to refer to specific PHP scripts within subdirctories in the REDCap version directory (e.g., redcap_vX.X.X) in which they will always have the format SubdirectoryName/my_php_script.php.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Do something on the Online Designer page
	if (PAGE == 'Design/online_designer.php') 
	{
		// ...
	}
	
	// Do something on the File Repository page but only for a specific project
	elseif ($project_id == 759 && PAGE == 'FileRepository/index.php') 
	{
		// ...
	}
}
</pre>
	 * EXAMPLE: Incorporate calls to a framework or helper scripts that you wish to utilize throughout REDCap on every page.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Call the framework class (this is just an example of how this methodology *might* look)
	require "/framework_path/my_framework.php";
	
	// Instantiate the object to use as a global variable in other hooks or plugins throughout REDCap.
	$framework = new FrameworkObject();
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_survey_page.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_every_page_before_render($project_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_every_page_before_render.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_every_page_before_render($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed and (optional) custom messaging to user when someone attempts to grant a user access to a REDCap project on the User Rights page (to be used for external authentication methods only)
	 * DESCRIPTION: array <b>redcap_custom_verify_username</b> ( string <b>$username</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed and (optional) custom messaging to user when someone attempts to grant a user access to a REDCap project on the User Rights page (to be used for external authentication methods only). If using external authentication (e.g., LDAP, Shibboleth), this function provides the option to verify whether a username is valid in the external authentication system before that username can be granted access to a project on the User Rights page. This function is called when adding a user with custom rights or when assigning a new user to a role. Example use case: If using LDAP authentication, you may have the function connect and bind to your LDAP server and then search your LDAP directory to validate the username so that only valid LDAP users can be given access to the project.
	 * PARAM: username - The username of the REDCap user when the function gets executed.
	 * RETURN: Your function should return an associative array with two elements: 'status' (either TRUE or FALSE) and 'message' (text that you wish to be displayed on the page). If 'message' is blank/null, then it will do nothing. If a 'message' value is returned, then it will output the text to the page inside a red box. If 'status' is FALSE, then it will display the message and stop processing (i.e., the user will NOT be granted access to the project), but if 'status' is TRUE, then it will display the message but will allow the user to be granted access.
	 * LOCATION_OF_EXECUTION: The function is executed on a project's User Rights page when someone attempts to add a user to the project whenever they click either the 'Add with custom rights' button or 'Assign to role' button.
	 * VERSION: 5.8.0
	 * EXAMPLE: This example returns an error because the username is NOT valid.
<pre>
function redcap_custom_verify_username($username) {
	...
	// Perform logic to verify if username is valid, and determines that it is not.
	...
	return array('status'=>FALSE, 'message'=>'ERROR: User $username is not a valid username!');
}
</pre>
	 * EXAMPLE: This example does not return an error because the username IS valid.
<pre>
function redcap_custom_verify_username($username) {
	...
	// Perform logic to verify if username is valid, and determines that it is.
	...
	return array('status'=>TRUE, 'message'=>'');
}
</pre>
	 * EXAMPLE: This example determines that the username IS valid but displays a custom message to the user.
<pre>
function redcap_custom_verify_username($username) {
	...
	// Perform logic to verify if username is valid, and determines that it is.
	...
	return array('status'=>TRUE, 'message'=>'Although this user is valid, please be sure
			to [DO WHATEVER] before adding them to the project.');
}
</pre>
	 */
    public static function redcap_custom_verify_username($result)
	{
		// If a message is returned, then output the message in a red div
		if (isset($result['message']) && !empty($result['message'])) {
			// Display the message in a red div
			print RCView::div(array('class'=>'red', 'style'=>'margin:10px 0;'), $result['message']);
			// If status is FALSE, then stop script execution
			if (isset($result['status']) && ($result['status'] === false)) exit;
		}
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on a survey page
	 * DESCRIPTION: void <b>redcap_survey_page</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL, string <b>$survey_hash</b>, int <b>$response_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on a survey page. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.<br><br>NOTE: This hook function does not get executed after the survey is completed (i.e., on the Survey Acknowledgment page). If you wish to perform an action after the survey has been completed, you should use the redcap_survey_complete() hook function.
	 * PARAM: project_id - The project ID number of the REDCap project to which the survey belongs.
	 * PARAM: record - The name of the record to which the current survey response belongs, assuming the response has been created. If the record/response does not exist yet (e.g., if participant is just beginning the first survey), its value will be NULL.
	 * PARAM: instrument - The name of the data collection instrument (i.e., the unique name, not the instrument label) to which this survey corresponds. This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current survey response, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * PARAM: survey_hash - The hashed string of alphanumeric text in the survey link (i.e., the "s" parameter in the query string of the survey URL). NOTE: If this is a public survey, the survey hash will always be the same for every participant.
	 * PARAM: response_id  - The response ID number of the current survey response, in which the response_id originates from the redcap_surveys_response database table. The response_id is particular to a specific record-event_id pair for the given survey. If the record does not exist yet (e.g., if participant is just beginning the first survey), the response_id value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very BOTTOM of every survey page (after the survey has been rendered).
	 * VERSION: 5.11.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL surveys, such as displaying static HTML at the bottom of EVERY survey page.
<pre>
function redcap_survey_page($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the very bottom of every survey.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_survey_page($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_survey_page.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_survey_page($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_survey_page.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_survey_page($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed at the top of a survey page - exactly like redcap_survey_page but executed in a different location
	 * DESCRIPTION: void <b>redcap_survey_page_top</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL, string <b>$survey_hash</b>, int <b>$response_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed at the top of a survey page. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.<br><br>NOTE: This hook function does not get executed after the survey is completed (i.e., on the Survey Acknowledgment page). If you wish to perform an action after the survey has been completed, you should use the redcap_survey_complete() hook function.
	 * PARAM: project_id - The project ID number of the REDCap project to which the survey belongs.
	 * PARAM: record - The name of the record to which the current survey response belongs, assuming the response has been created. If the record/response does not exist yet (e.g., if participant is just beginning the first survey), its value will be NULL.
	 * PARAM: instrument - The name of the data collection instrument (i.e., the unique name, not the instrument label) to which this survey corresponds. This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current survey response, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * PARAM: survey_hash - The hashed string of alphanumeric text in the survey link (i.e., the "s" parameter in the query string of the survey URL). NOTE: If this is a public survey, the survey hash will always be the same for every participant.
	 * PARAM: response_id  - The response ID number of the current survey response, in which the response_id originates from the redcap_surveys_response database table. The response_id is particular to a specific record-event_id pair for the given survey. If the record does not exist yet (e.g., if participant is just beginning the first survey), the response_id value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very TOP of every survey page (near the initial BODY tag - before the survey has been rendered).
	 * VERSION: 6.8.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL surveys, such as displaying static HTML at the top of EVERY survey page.
<pre>
function redcap_survey_page_top($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the top of every survey.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_survey_page_top($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_survey_page.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_survey_page_top($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_survey_page_top.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_survey_page_top($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on the "Add/Edit Records" page in a project
	 * DESCRIPTION: void <b>redcap_add_edit_records_page</b> ( int <b>$project_id</b>, string <b>$instrument</b>, int <b>$event_id</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on the "Add/Edit Records" page in a project. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * PARAM: project_id - The project ID number of the REDCap project.
	 * PARAM: instrument - The name of the current data collection instrument (i.e., the unique name, not the instrument label). This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current data entry form, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very TOP of the "Add/Edit Records" page (BEFORE the main page is rendered but AFTER the left-hand menu has been rendered).
	 * VERSION: 6.8.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL projects, such as displaying static HTML at the top of the "Add/Edit Records" page.
<pre>
function redcap_add_edit_records_page($project_id, $instrument, $event_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the top of the page.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_add_edit_records_page($project_id, $instrument, $event_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_data_entry_form.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_add_edit_records_page($project_id, $instrument, $event_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_add_edit_records_page.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_add_edit_records_page($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on the "Project Home" page in a project
	 * DESCRIPTION: void <b>redcap_project_home_page</b> ( int <b>$project_id</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on the "Project Home" page in a project, specifically near the top of the page just below the tabs. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * PARAM: project_id - The project ID number of the REDCap project.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed near the TOP of the "Project Home" page (just below where the tabs are displayed).
	 * VERSION: 6.9.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL projects, such as displaying static HTML at the top of the "Add/Edit Records" page.
<pre>
function redcap_project_home_page($project_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the top of the home page.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_project_home_page($project_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_data_entry_form.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_project_home_page($project_id, $instrument, $event_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_project_home_page.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_project_home_page($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on a data entry form (excludes survey pages)
	 * DESCRIPTION: void <b>redcap_data_entry_form</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on a data entry form (excludes survey pages). You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * PARAM: project_id - The project ID number of the REDCap project to which the data entry form belongs.
	 * PARAM: record - The name of the record, assuming the record has been created. If the record does not exist yet (e.g., if says "Adding new record" in green at top of page), its value will be NULL.
	 * PARAM: instrument - The name of the current data collection instrument (i.e., the unique name, not the instrument label). This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current data entry form, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very BOTTOM of every data entry form (AFTER the form has been rendered).
	 * VERSION: 5.11.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL projects, such as displaying static HTML at the bottom of EVERY data entry form.
<pre>
function redcap_data_entry_form($project_id, $record, $instrument, $event_id, $group_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the very bottom
			of every data entry form.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_data_entry_form($project_id, $record, $instrument, $event_id, $group_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_data_entry_form.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_data_entry_form($project_id, $record, $instrument, $event_id, $group_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_data_entry_form.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_data_entry_form($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed at the top of a data entry form (excludes survey pages) - exactly like redcap_data_entry_form but executed in a different location
	 * DESCRIPTION: void <b>redcap_data_entry_form_top</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed at the top of a data entry form (excludes survey pages). You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * PARAM: project_id - The project ID number of the REDCap project to which the data entry form belongs.
	 * PARAM: record - The name of the record, assuming the record has been created. If the record does not exist yet (e.g., if says "Adding new record" in green at top of page), its value will be NULL.
	 * PARAM: instrument - The name of the current data collection instrument (i.e., the unique name, not the instrument label). This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current data entry form, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very TOP of every data entry form (BEFORE the form has been rendered but AFTER the left-hand menu has been rendered).
	 * VERSION: 6.8.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL projects, such as displaying static HTML at the top of EVERY data entry form.
<pre>
function redcap_data_entry_form_top($project_id, $record, $instrument, $event_id, $group_id)
{
	print '&lt;div class="yellow"&gt;Special announcement text to display at the top
			of every data entry form.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_data_entry_form_top($project_id, $record, $instrument, $event_id, $group_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_data_entry_form.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_data_entry_form_top($project_id, $record, $instrument, $event_id, $group_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_data_entry_form_top.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_data_entry_form_top($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on a survey immediately after the survey has been completed.
	 * DESCRIPTION: void <b>redcap_survey_complete</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL, string <b>$survey_hash</b>, int <b>$response_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on a survey immediately after the survey has been completed, either at the bottom of the survey acknowledgment page or (if not using the Survey Acknowledgment Text option) right before the participant gets redirected to a custom URL. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * PARAM: project_id - The project ID number of the REDCap project to which the survey belongs.
	 * PARAM: record - The name of the record to which the current survey response belongs, assuming the response has been created. If the record/response does not exist yet (e.g., if participant is just beginning the first survey), its value will be NULL.
	 * PARAM: instrument - The name of the data collection instrument (i.e., the unique name, not the instrument label) to which this survey corresponds. This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current survey response, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * PARAM: survey_hash - The hashed string of alphanumeric text in the survey link (i.e., the "s" parameter in the query string of the survey URL). NOTE: If this is a public survey, the survey hash will always be the same for every participant.
	 * PARAM: response_id  - The response ID number of the current survey response, in which the response_id originates from the redcap_surveys_response database table. The response_id is particular to a specific record-event_id pair for the given survey. If the record does not exist yet (e.g., if participant is just beginning the first survey), the response_id value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed on a survey immediately after the survey has been completed, either at the bottom of the survey acknowledgment page or (if not using the Survey Acknowledgment Text option) right before the participant gets redirected to a custom URL
	 * VERSION: 5.11.0
	 * EXAMPLE: This example illustrates how to perform desired operations for ALL surveys, such as displaying static HTML at the bottom of EVERY survey page.
<pre>
function redcap_survey_complete()
{
	print '&lt;div class="yellow"&gt;Special announcement text to display right below the survey acknowledgment text.&lt;/div&gt;';
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_survey_complete($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_survey_complete.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_survey_complete($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_survey_complete.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 * EXAMPLE: This example provides a simple illustration of how one might redirect participants (after they complete a survey) to a custom webpage while passing the record name in URL, which might be done in order to display something to the participant that is particular to them or to process/save something regarding that participant (e.g., save something in a database table or send an email). NOTE: The PHP script below is the project handler script that gets included by the Hook function, as seen in the previous example.
<pre>
&lt;?php
// This is a project handler script with filename ...redcap/hooks/pid1256/redcap_survey_complete.php
// This script is only included by surveys completed in project_id 1256

// Only perform the redirection for the survey corresponding to the instrument 'diabetes_questionnaire'
if ($instrument == 'diabetes_questionnaire')
{
	// Redirect the participant to the custom URL appended with the record name
	redirect("https://mywebsite.edu/redcap/plugins/process_questionnaires.php?record=" . $record);
}
</pre>
	 */
    public static function redcap_survey_complete($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on any of the pages in REDCap's Control Center
	 * DESCRIPTION: void <b>redcap_control_center</b> ( void )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on any of the pages in REDCap's Control Center. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very bottom of every page in the Control Center.
	 * VERSION: 5.11.0
	 * EXAMPLE: This example demonstrates how to perform a specific operation on every page in the Control Center, in which some HTML is output to the page and then manipulated using JavaScript/jQuery to move it to a different location on the page. This specific example shows how to add new menu items to the left-hand menu, whose DIV has an ID of "control_center_menu".
<pre>
function redcap_control_center()
{
	// Output a link inside a div onto the page
	print  "&lt;div id='my_custom_cc_link'&gt;
				&lt;a href='https://mysite.edu/otherpage/'&gt;My Custom link to another page&lt;/a&gt;
			&lt;/div&gt;";

	// Use JavaScript/jQuery to append our link to the bottom of the left-hand menu
	print  "&lt;script type='text/javascript'&gt;
			$(document).ready(function(){
				// Append link to left-hand menu
				$( 'div#my_custom_cc_link' ).appendTo( 'div#control_center_menu' );
			});
			&lt;/script&gt;";
}
</pre>
	 */
    public static function redcap_control_center($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed on the User Rights page of every project
	 * DESCRIPTION: void <b>redcap_user_rights</b> (  int <b>$project_id</b> )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed on the User Rights page of every project. You may utilize this hook to 1) perform back-end operations, such as adding or modifying data in database tables, which can be done when the page loads or when triggered by a user action on the page via JavaScript, or 2) output custom HTML, JavaScript, and/or CSS to modify the current page in any way desired.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed at the very bottom of User Rights page of every project. Anything output by the hook (such as HTML) will be displayed directly beneath the table of users/roles on the page.
	 * VERSION: 5.11.0
	 * EXAMPLE: This example demonstrates how to perform a specific operation on the User Rights page of every project, in which some HTML is output to the page and then manipulated using JavaScript/jQuery to move it to a different location on the page. This specific example shows how to add a box of yellow text on the page and then move it so that it appears directly beneath the instructional text on the page.
<pre>
function redcap_user_rights()
{
	// Output a div containing a special announcement onto the page
	print  '&lt;div class="yellow" id="my_custom_user_rights_div"&gt;
				Special announcement text to display right below the instructional text
				on every User Rights page.
			&lt;/div&gt;';

	// Use JavaScript/jQuery to move our div right below the instructional text
	print  "&lt;script type='text/javascript'&gt;
			$(document).ready(function(){
				// Move our div right above the table listing all the users/roles
				$( 'div#user_rights_roles_table_parent' ).before( $('div#my_custom_user_rights_div') );
			});
			&lt;/script&gt;";
}
</pre>
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_user_rights($project_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_user_rights.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_user_rights($project_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_user_rights.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 */
    public static function redcap_user_rights($result)
	{
		// Don't return anything
	}


	/**
	 * SUMMARY: Allows custom actions to be performed immediately after a record has been saved on a data entry form or survey page
	 * DESCRIPTION: void <b>redcap_save_record</b> ( int <b>$project_id</b>, string <b>$record</b> = NULL, string <b>$instrument</b>, int <b>$event_id</b>, int <b>$group_id</b> = NULL, string <b>$survey_hash</b> = NULL, int <b>$response_id</b> = NULL )
	 * DESCRIPTION_TEXT: Allows custom actions to be performed immediately after a record has been saved (either created or modified) on a data entry form or survey page whenever the user/participant clicks the Save/Submit/Next Page button.<br><br>NOTE: This hook function differs from the redcap_survey_page(), redcap_survey_complete(), and redcap_data_entry_form() functions in that those are only executed once the page has been rendered, while the redcap_save_record() function is executed during post-processing prior to the page being rendered.
	 * PARAM: project_id - The project ID number of the REDCap project to which the survey belongs.
	 * PARAM: record - The name of the record/response that was just created or modified.
	 * PARAM: instrument - The name of the current data collection instrument (i.e., the unique name, not the instrument label). This corresponds to the value of Column B in the Data Dictionary.
	 * PARAM: event_id - The event ID number of the current data entry form or survey, in which the event_id corresponds to a defined event in a longitudinal project. For classic projects, there will only ever be one event_id for the project.
	 * PARAM: group_id  - The group ID number corresponding to the data access group to which this record has been assigned. If no DAGs exist or if the record has not been assigned to a DAG, its value will be NULL.
	 * PARAM: survey_hash - (only for survey pages) The hashed string of alphanumeric text in the survey link (i.e., the "s" parameter in the query string of the survey URL). NOTE: If this is a public survey, the survey hash will always be the same for every participant. If not currently on a survey page, this value will be NULL.
	 * PARAM: response_id  - (only for survey pages) The response ID number of the current survey response, in which the response_id originates from the redcap_surveys_response database table. The response_id is particular to a specific record-event_id pair for the given survey. If the record does not exist yet (e.g., if participant is just beginning the first survey), the response_id value will be NULL. If not currently on a survey page, this value will be NULL.
	 * RETURN: Nothing. Your function does not need to return anything.
	 * LOCATION_OF_EXECUTION: The function is executed immediately after a record has been saved on a data entry form or survey page whenever the user/participant clicks the Save/Submit/Next Page button.
	 * VERSION: 5.11.0
	 * EXAMPLE: This example shows a simple way of performing project-specific actions using the $project_id parameter. NOTE: This particular method is not as clean or as easy to maintain for many projects at once. See the next example for a better way to implement project-specific actions for many projects.
<pre>
function redcap_save_record($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Perform certain actions for specific projects (using "switch" or "if" statements).
	switch ($project_id) {

		// Perform operations for project_id 212
		case 212:
			// do something specific for this project ...
			break;

		// Perform operations for project_id 4775
		case 4775:
			// do something specific for this project ...
			break;

		// ...
	}
}
</pre>
	 * EXAMPLE: A much more manageable way to perform project-specific operations for many projects at once is to create a directory structure where each project has its own subdirectory under the main Hooks directory (e.g., named "redcap/hooks/pid{$project_id}/redcap_save_record.php"). This allows the code for each project to be sandboxed and separated and also makes it more manageable to utilize other files (e.g., PHP, HTML, CSS, and/or JavaScript files) that you can keep in the project's subdirectory (i.e., "pid{$project_id}") in the Hooks folder. Then the designated project handler PHP script can utilize any of the parameters passed in the function to perform actions specific to each project. NOTE: This example assumes that the "hooks" sub-directory is located in the same directory as the PHP file containing the Hook functions.
<pre>
function redcap_save_record($project_id, $record, $instrument, $event_id, $group_id, $survey_hash, $response_id)
{
	// Set the full path of the project handler PHP script located inside the
	// project-specific sub-folder, which itself exists in the main Hooks folder.
	$project_handler_script = dirname(__FILE__) . "/hooks/pid{$project_id}/redcap_save_record.php";

	// Check if the project handler PHP script exists for this project, and if so,
	// then "include" the script to execute it. If not, do nothing.
	if (file_exists($project_handler_script)) include $project_handler_script;
}
</pre>
	 * EXAMPLE: This example provides a simple illustration of how one might email a survey administrator based upon a specific response by a participant.
<pre>
&lt;?php
// This is a project handler script with filename ...redcap/hooks/pid998/redcap_save_record.php
// This script only gets executed by surveys for project_id 998

// Only perform this action for the survey corresponding to the instrument 'mental_health_survey'
if ($instrument == 'mental_health_survey' && $_POST['suicidal'] == '1' && $response_id != null)
{
	// If the participant just answered "Yes" (1) to the question "Are you suicidal?" (variable "suicidal"),
	// then immediately send an email to the survey administrator so the proper actions may be taken.
	$email_text = "A participant (record '$record') noted on the survey that they are suicidal. "
				. "Please take appropriate actions immediately to contact them.";
	REDCap::email('surveyadmin@mystudy.com', 'redcap@yoursite.edu', 'Suicide alert', $email_text);
}
</pre>
	 */
    public static function redcap_save_record($result)
	{
		// Don't return anything
	}

}