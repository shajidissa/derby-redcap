<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Build dynamic filter options (if any)
$dynamic_filters = DataExport::displayReportDynamicFilterOptions($_POST['report_id']);
// Obtain any dynamic filters selected from query string params
list ($liveFilterLogic, $liveFilterGroupId, $liveFilterEventId) = DataExport::buildReportDynamicFilterLogic($_POST['report_id']);
// Get html report table
list ($report_table, $num_results_returned) = DataExport::doReport($_POST['report_id'], 'report', 'html', false, false, false, false,
												false, false, false, false, false, false, false,
												(isset($_GET['instruments']) ? explode(',', $_GET['instruments']) : array()),
												(isset($_GET['events']) ? explode(',', $_GET['events']) : array()),
												false, false, false, true, true, $liveFilterLogic, $liveFilterGroupId, $liveFilterEventId);
// Display report and title and other text
print  	"<div id='report_div' style='margin:10px 0 20px;'>" .
			RCView::div(array('style'=>''),
				RCView::div(array('class'=>'hide_in_print', 'style'=>'float:left;width:350px;padding-bottom:5px;'),
					RCView::div(array('style'=>'font-weight:bold;'),
						$lang['custom_reports_02'] .
						RCView::span(array('style'=>'margin-left:5px;color:#800000;font-size:15px;'),
							User::number_format_user($num_results_returned)
						)
					) .
					RCView::div(array(),
						$lang['custom_reports_03'] .
						RCView::span(array('id'=>'records_queried_count', 'style'=>'margin-left:5px;'), 
							User::number_format_user(Records::getCountRecordEventPairs())
						) .
						(!$longitudinal ? "" :
							RCView::div(array('style'=>'margin-top:3px;color:#888;font-size:11px;font-family:tahoma,arial;'),
								$lang['custom_reports_09']
							)
						)
					)
				) .
				RCView::div(array('class'=>'hide_in_print', 'style'=>'float:left;'),
					// Buttons: Stats, Export, Print, Edit
					RCView::div(array(),
						// Stats & Charts button
						(!$user_rights['graphical'] || !$enable_plotting ? '' :
							RCView::button(array('class'=>'report_btn jqbuttonmed', 'onclick'=>"window.location.href = '".APP_PATH_WEBROOT."DataExport/index.php?pid=".PROJECT_ID."&report_id={$_POST['report_id']}&stats_charts=1'+getInstrumentsListFromURL()+getLiveFilterUrl();", 'style'=>'font-size:12px;'),
								RCView::img(array('src'=>'chart_bar.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'),
									$lang['report_builder_78']
								)
							)
						) .
						RCView::SP .
						// Export Data button
						($user_rights['data_export_tool'] == '0' ? '' :
							RCView::button(array('class'=>'report_btn jqbuttonmed', 'onclick'=>"showExportFormatDialog('{$_POST['report_id']}');", 'style'=>'font-size:12px;'),
								RCView::img(array('src'=>'go-down.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'),
									$lang['custom_reports_12']
								)
							)
						) .
						RCView::SP .
						// Print link
						RCView::button(array('class'=>'report_btn jqbuttonmed', 'onclick'=>"window.print();", 'style'=>'font-size:12px;'),
							RCView::img(array('src'=>'printer.png', 'style'=>'vertical-align:middle;')) .
							RCView::span(array('style'=>'vertical-align:middle;'),
								$lang['custom_reports_13']
							)
						) .
						RCView::SP .
						($_POST['report_id'] == 'ALL' || $_POST['report_id'] == 'SELECTED' || !$user_rights['reports'] ? '' :
							// Edit report link
							RCView::button(array('class'=>'report_btn jqbuttonmed', 'onclick'=>"window.location.href = '".APP_PATH_WEBROOT."DataExport/index.php?pid=".PROJECT_ID."&report_id={$_POST['report_id']}&addedit=1';", 'style'=>'font-size:12px;'),
								RCView::img(array('src'=>'pencil_small.png', 'style'=>'vertical-align:middle;')) .
								RCView::span(array('style'=>'vertical-align:middle;'),
									$lang['custom_reports_14']
								)
							)
						)
					) .
					// Dynamic filters (if any)
					$dynamic_filters
				) .
				RCView::div(array('class'=>'clear'), '')
			) .
			// Report title
			RCView::div(array('id'=>'this_report_title', 'style'=>'margin:'.($dynamic_filters == '' ? '20' : '5').'px 0 8px;padding:5px 3px;color:#800000;font-size:18px;font-weight:bold;'),
				// Title
				DataExport::getReportNames($_POST['report_id'])
			) .
			// Report table
			$report_table .
		"</div>";
