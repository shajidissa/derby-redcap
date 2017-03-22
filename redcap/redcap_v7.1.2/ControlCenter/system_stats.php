<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

include 'header.php';
if (!SUPER_USER) redirect(APP_PATH_WEBROOT);
?>

<h4 style="margin-top: 0;"><?php echo RCView::img(array('src'=>'table.png')) . $lang['dashboard_48'] ?></h4>

<div id='controlcenter_stats' style='width:95%;max-width:420px;'>
	<img src="<?php echo APP_PATH_IMAGES ?>progress_circle.gif">
	<b><?php echo $lang['dashboard_01'] ?>...</b>
</div>

<script type="text/javascript">
// Chain all ajax events so that they are fired sequentially
var ccstats  = app_path_webroot + 'ControlCenter/stats_ajax.php';
$(function() {
	// Statistics table
	$.get(ccstats, {}, function(data) {
		// Create table on page
		$('#controlcenter_stats').html(data);
		// Multiple ajax calls for stats that take a long time
		$.get(ccstats, { logged_events: 1}, function(data) {
			var le = data.split("|");
			$('#logged_events_30min').html(le[0]);
			$('#logged_events_today').html(le[1]);
			$('#logged_events_week').html(le[2]);
			$('#logged_events_month').html(le[3]);
		} );
		setTimeout(function(){
			$.get(ccstats, { total_fields: 1}, function(data) { $('#total_fields').html(data); } );
			$.get(ccstats, { mysql_space: 1}, function(data) { $('#mysql_space').html(data); } );
			$.get(ccstats, { webserver_space: 1}, function(data) { $('#webserver_space').html(data); } );
		},100);
		setTimeout(function(){
			$.get(ccstats, { survey_participants: 1}, function(data) { $('#survey_participants').html(data); } );
			$.get(ccstats, { survey_invitations: 1}, function(data) {
				var si = data.split("|");
				$('#survey_invitations_sent').html(si[0]);
				$('#survey_invitations_responded').html(si[1]);
				$('#survey_invitations_unresponded').html(si[2]);
			} );
		},200);
		setTimeout(function(){
			$.get(ccstats, { ddp1: 1}, function(data) {
				var le = data.split("|");
				$('#total_ddp_values_adjudicated').html(le[0]);
				$('#total_ddp_projects_adjudicated').html(le[1]);
			} );
			$.get(ccstats, { ddp2: 1}, function(data) {
				$('#total_ddp_records_imported').html(data);
			} );
		},300);
	} );
});
function getTotalRecordCount() {
	$('#total_records').html('<span style="color:#999;"><?php echo $lang['dashboard_39'] ?>...</span>');
	$.get(ccstats, { total_records: 1}, function(data) { $('#total_records').html(data); } );
}
function getTotalLogEventCount() {
	$('#logged_events').html('<span style="color:#999;"><?php echo $lang['dashboard_39'] ?>...</span>');
	$.get(ccstats, { logged_events_total: 1}, function(data) { $('#logged_events').html(data); } );
}
</script>

<?php include 'footer.php';