<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


// Config
require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Do user rights check (normally this is done by init_project.php, but we actually have multiple rights
// levels here for a single page (so it's not applicable).
if ($data_resolution_enabled != '2' || $user_rights['data_quality_resolution'] == '0')
{
	redirect(APP_PATH_WEBROOT . "index.php?pid=$project_id");
}

// Instantiate DataQuality object
$dq = new DataQuality();

// Header
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

// Page title
renderPageTitle("<img src='".APP_PATH_IMAGES."checklist.png'> {$lang['app_20']}");

// Display tabs
print $dq->renderTabs();

// Instructions
print RCView::p(array('style'=>'margin:0 0 20px;'),
		$lang['dataqueries_171']
	  );

// Set issue type to view (Open vs. Closed) and which rule/field
if (!isset($_GET['status_type'])) $_GET['status_type'] = 'OPEN';

// Render resolution table
print RCView::div(array('id'=>'resTableParent'),
		$dq->renderResolutionTable($_GET['status_type'], $_GET['field_rule_filter'], $_GET['event_id'], $_GET['group_id'])
	  );

// Data Resolution Workflow: Render the file upload dialog (when applicable)
print DataQuality::renderDataResFileUploadDialog();

// Footer
require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';