<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

// Give link to go back to previous page if coming from a project page
$prevPageLink = "";
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "pid=") !== false) {
	$prevPageLink = "<div style='margin:0 0 20px;float:left;'>
						<img src='" . APP_PATH_IMAGES . "arrow_skip_180.png'>
						<a href='{$_SERVER['HTTP_REFERER']}' style='color:#2E87D2;font-weight:bold;'>{$lang['help_01']}</a>
					 </div>";
}
// Add note on how to use Ctrl+F
$prevPageLink .= RCView::div(array('style'=>'line-height:13px;font-size:12px;color:#555;float:right;padding:0 15px 10px 0px;'),
					$lang['home_51'] . RCView::br() .
					$lang['home_52']
				) .
				RCView::div(array('class'=>'clear'), '');

// If site has set custom text to be displayed at top of page, then display it
$helpfaq_custom_html = '';
if (trim($helpfaq_custom_text) != '')
{
	// Set html for div
	$helpfaq_custom_html = "<div class='blue' style='max-width:800px;margin:0px 10px 15px 0;padding:10px;'>".nl2br(decode_filter_tags($helpfaq_custom_text))."</div>";
}

print $helpfaq_custom_html . $prevPageLink;

// Include help content scraped from End-User FAQ wiki page
include APP_PATH_DOCROOT . 'Help/help_content.php';