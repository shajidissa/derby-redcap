<?php
// Prevent view from being called directly
require_once dirname(dirname(dirname(__FILE__))) . '/Config/init_functions.php';
System::init();

include APP_PATH_DOCROOT . 'ControlCenter/header.php';
print RCView::h4(array('style'=>'margin-top:0;font-weight: bold;'), $lang['control_center_4582']);
print RCView::p(array(), $lang['control_center_4583']);
print RCView::p(array('style'=>'color:#A00000;font-weight:bold;margin-bottom:0;'), $lang['control_center_4597']);
print RCView::p(array('style'=>'color:#A00000;margin-top:0;'), $lang['control_center_4587']);
print RCView::p(array('style'=>'color:#000066;font-weight:bold;margin-bottom:0;'), $lang['control_center_4598']);
print RCView::p(array('style'=>'color:#000066;margin-top:0;'), $lang['control_center_4588']);
if (!isset($_GET['action'])) {
	// Submit button
	print 	RCView::div(array('style'=>'margin:25px 0 0;'),
				RCView::button(array('class'=>'btn btn-primary', 'onclick'=>"showProgress(1);window.location.href='".$_SERVER['REQUEST_URI']."&action=findErrors&includeDevProjects='+($('#includeDevProjects').prop('checked') ? '1' : '0');"), $lang['control_center_4582']) .
				RCView::checkbox(array('id'=>'includeDevProjects', 'style'=>'margin-left:20px;')) .  
				$lang['control_center_4603']
			);
} else {
	// Progress table
	$numProjects = count($project_ids);
	$firstPid = array_shift($project_ids);
	print 	RCView::div(array('id'=>'findCalcErrorsResults'),
				RCView::div(array('id'=>'findCalcErrorsNotify', 'style'=>'margin:10px;'), 
					RCView::button(array('class'=>'btn btn-success opacity50', 'disabled'=>'disabled', 'onclick'=>"openFindCalcErrorsNotifyDialog();"), 
						RCView::span(array('class'=>'glyphicon glyphicon-envelope'), '') . ' ' .
						$lang['control_center_4589']
					)
				) . 
				RCView::div(array('id'=>'findCalcErrorsProgress', 'class'=>'gray', 'style'=>"font-weight:bold; padding:10px;font-size: 13px !important;"), 
					RCView::img(array('src'=>'progress_circle.gif')) . " " .
					$lang['control_center_4585'] . " $numProjects" . $lang['period'] . " " . 
					RCView::span(array('style'=>'color:#A00000;'),
						$lang['control_center_4586'] . " "
					) .
					RCView::span(array('id'=>'findCalcErrorsProgressTemp'), '0')
				)
			);
	print 	RCView::div(array('id'=>'findCalcErrorsNotifyDialog', 'class'=>'simpleDialog', 'title'=>$lang['control_center_4589']),
				$lang['control_center_4590'] . " " . RCView::b(RCView::u($project_contact_email) . $lang['period']) . 
				RCView::div(array('style'=>'margin-top:15px;'), 
					$lang['email_users_10'] . " " .
					RCView::text(array('id'=>'findCalcErrorsNotifySubject', 'class'=>'x-form-text x-form-field', 'style'=>'width:80%;max-width:400px;', 'value'=>"[REDCap] ".$lang['control_center_4591'])) 
				) .
				RCView::div(array('style'=>'margin-top:15px;'), 
					RCView::textarea(array('id'=>'findCalcErrorsNotifyMsg', 'class'=>'x-form-field notesbox', 'style'=>'height:300px;'), 
						str_replace(array("\r\n", "\n", "\t", "  ", "  "), array(" ", " ", " ", " ", " "), $lang['control_center_4596']) . "\n\n" .
						"<b>" . str_replace(array("\r\n", "\n", "\t", "  ", "  "), array(" ", " ", " ", " ", " "), $lang['control_center_4592']) . "</b>\n\n" .
						str_replace(array("\r\n", "\n", "\t", "  ", "  "), array(" ", " ", " ", " ", " "), $lang['control_center_4594']) . "\n\n" .
						str_replace(array("\r\n", "\n", "\t", "  ", "  "), array(" ", " ", " ", " ", " "), $lang['control_center_4602']) . "\n\n" .
						" - " . 
						str_replace(array("\r\n", "\n", "\t", "  ", "  "), array(" ", " ", " ", " ", " "), $lang['control_center_4595'])
					)
				)
			);
	// AJAX requests to find calc errors. Will run serially one at a time.
	?><script type="text/javascript">
	var nextPids = '<?php print implode(',', $project_ids) ?>';
	var firstPid = '<?php print $firstPid ?>';
	var successMsg = '<?php print cleanHtml($lang['control_center_4584'] . " " . RCView::span(array('style'=>'color:#A00000;'),$lang['control_center_4586'])) ?> ';
	var increment = 0;
	var numProjectsErrors = 0;
	var affectedProjectIds = '';
	$(function(){
		processProjects(firstPid, nextPids);
	});	
	function openFindCalcErrorsNotifyDialog() {
		simpleDialog(null,null,'findCalcErrorsNotifyDialog',700,'','<?php print cleanHtml($lang['global_53']) ?>',function(){
			showProgress(1);
			$.post('index.php?route=ControlCenterController:findCalcErrors&action=contactUsers', { emailContent: $('#findCalcErrorsNotifyMsg').val(), emailSubject: $('#findCalcErrorsNotifySubject').val(), projectsUsers: affectedProjectIds },function(data){
				showProgress(0,0);
				simpleDialog(data,'<?php print cleanHtml($lang['setup_08']) ?>');
				$('#findCalcErrorsNotify button').addClass('opacity50').prop('disabled', true);
			});
		},'<?php print cleanHtml($lang['survey_180']) ?>');
	}
	function processProjects(thisPid, nextPids) {
		if (thisPid == '') {
			$('#findCalcErrorsResults').html('COMPLETED! No issues found in any projects!')
			return;
		}
		increment++;
		var divId = 'findCallError_pid'+thisPid;
		$('#findCalcErrorsResults').append('<div id="'+divId+'" class="yellow">'+increment+' of <?php print $numProjects ?>)&nbsp; '
			+ '<a style="font-size:12px;" href="DataQuality/index.php?pid='+thisPid+'" target="_blank">Project ID '+thisPid+'</a>, '
			+ 'Status: <span class="status">Checking...</span></div>');
		$.post('<?php print $_SERVER['REQUEST_URI'] ?>&pid='+thisPid, { nextPids: nextPids },function(data){
			try {
				var json = jQuery.parseJSON(data);
				$('#'+divId).removeClass('yellow').addClass(json.hasErrors ? 'red' : 'darkgreen');
				$('#'+divId+' .status').html(json.hasErrors ? '<b>Calculation errors exist</b>&nbsp;&nbsp;(Project contact: <a style="font-size:11px;" href="mailto:'+json.contactEmail+'">'+json.contactEmail+'</a>)' : 'OK');
				if (json.hasErrors > 0) {
					numProjectsErrors++;
					affectedProjectIds += ','+thisPid+':'+json.contactUiId;
				}
				if (json.thisPid != '') {
					processProjects(json.thisPid, json.nextPids);
					$('#findCalcErrorsProgressTemp').html(numProjectsErrors);
				} else {
					$('#findCalcErrorsProgress').removeClass('gray').addClass('green').html(successMsg+' '+numProjectsErrors);
					if (numProjectsErrors > 0) $('#findCalcErrorsNotify button').removeClass('opacity50').prop('disabled', false);
				}
			} catch(e) { alert(woops) }
		});
	}
	</script>
	<style type="text/css">
	#findCalcErrorsResults div { font-size: 11px !important; padding: 3px; }
	</style>
	<?php
}
include APP_PATH_DOCROOT . 'ControlCenter/footer.php';