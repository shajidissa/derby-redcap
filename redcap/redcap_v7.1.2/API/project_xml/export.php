<?php
global $format, $returnFormat, $post;

$Proj = new Project(PROJECT_ID);
$user_rights = UserRights::getPrivileges(PROJECT_ID, USERID);
$user_rights = $user_rights[PROJECT_ID][strtolower(USERID)];
$ur = new UserRights();
$ur->setFormLevelPrivileges();

# Get REDCap XML file/string
$post['returnMetadataOnly'] = !(!isset($post['returnMetadataOnly']) || (isset($post['returnMetadataOnly']) && !$post['returnMetadataOnly']));
$post['exportFiles'] = !(!isset($post['exportFiles']) || (isset($post['exportFiles']) && !$post['exportFiles']));
$content = Project::getProjectXML($post['returnMetadataOnly'], $post['records'], $post['fields'], $post['events'], $user_rights['group_id'],
								  $post['exportDataAccessGroups'], $post['exportSurveyFields'], $post['filterLogic'], $post['exportFiles']);

# Logging
Logging::logEvent("", "redcap_projects", "MANAGE", PROJECT_ID, "project_id = " . PROJECT_ID, "Export project XML (API$playground)");

# Send the response to the requestor
RestUtility::sendResponse(200, $content, $format);