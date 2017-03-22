<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

if (isset($_POST['chart_download']) && !empty($_POST['chart_download'])) {
	$str = $_POST['chart_download'];
	// Get mime type and filename
	$mime_type = substr($str, 5, strpos($str, ';')-5);
	if (isset($_POST['image_name'])) {
		$filename = $_POST['image_name'];
	} else {
		$filename = "image." . str_replace("image/", "", $mime_type);
	}
	$commaPos = strpos($str, ',');
	if ($commaPos !== false) {
		$str = substr($str, $commaPos+1);
	}
	// Headers
	header('Content-Type: '.$mime_type.'; name="'.$filename.'"');
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	// Output content
	print base64_decode($str);
	// Logging
	Logging::logEvent("","redcap_data","manage",$_GET['field'],"field_name = '".prep($_GET['field'])."'","Download graphical chart for field");
} else {
	print "ERROR!";
}