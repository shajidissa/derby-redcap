<?php

class ControlCenterController extends Controller
{
	// Render the Find Calculation Errors page
	public function findCalcErrors()
	{
		if (!SUPER_USER) exit('ERROR'); // Super users only
		global $isAjax;
		if ($isAjax && isset($_GET['pid']) && $_GET['action'] == 'findErrors') {
			ControlCenter::findCalcErrorsSingleProject();
		} elseif ($isAjax && $_GET['action'] == 'contactUsers' && isset($_POST['projectsUsers']) && strlen($_POST['projectsUsers']) > 0) {
			ControlCenter::findCalcErrorsEmailUsers();
		} else {
			$GLOBALS['project_ids'] = ControlCenter::findCalcErrorsGetProjectList($_GET['includeDevProjects']);
			$this->render('ControlCenter/findCalcErrors.php', $GLOBALS);
		}
	}
}