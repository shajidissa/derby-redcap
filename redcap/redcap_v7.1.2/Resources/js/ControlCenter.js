// Validate IP ranges for 2FA
// If all are valid, returns true, else returns comma-delimited list of invalid IPs.
function validateIpRanges(ranges) {
	// Remove all whitespace
	ranges = ranges.replace(/\s+/, "");
	// Replace all semi-colons with commas
	ranges = ranges.replace(/;/g, ",");
	// Replace all dashes with commas (so we can treat min/max of range as separate IPs)
	ranges = ranges.replace(/-/g, ",");
	// Now split into individual IP address components to check format via regex
	var ranges_array = ranges.split(',');
	var regex = /^((\*|[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}(\*|[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])(\/([0-9]|[1-2][0-9]|3[0-2]))?$/;
	var bad_ips = new Array();
	var k=0;
	for (var i=0; i<ranges_array.length; i++) {
		var match = (ranges_array[i].match(regex) != null);
		if (!match) {
			bad_ips[k++] = ranges_array[i];
		}
	}
	// Display error msg if any IPs are invalid
	if (bad_ips.length > 0) {
		return bad_ips.join(',');
	}
	return true;
}

// Opens dialog popup for viewing all users in Control Center
function openUserHistoryList(showSearchOnly) {
	var days = $('#activity-level').val();
	var title = $('#activity-level option:selected').text();
	var search_term = '';
	var search_attr = '';
	if ($('#user_list_search').length) {
		search_term = trim($('#user_list_search').val());
		search_attr = $('#user_list_search_attr').val();
	}
	if (showSearchOnly == '1') {
		$('#user_list_search').val('');
		$('#user_list_search_attr').val('');
	}
	// Set progress spinner and reset div
	$('#userListTable').html('');
	$('#userListProgress').show();
	// Open dialog
	if ($('#userList').hasClass('ui-dialog-content')) $('#userList').dialog('destroy');
	var userListDialog = $('#userList').dialog({ title: title, bgiframe: true, modal: true, position: { my: "top", at: "top+100px", of: window }, width: ($(document).width() > 1000 ? 1000 : $(document).width()-20), buttons: { Close: function() { $(this).dialog('close'); } } });
	// Ajax call
	$.get(app_path_webroot+'ControlCenter/user_list_ajax.php', { showSearchOnly: showSearchOnly, d: days, search_term: search_term, search_attr: search_attr}, function(data) {
		// Inject table
		$('#userListProgress').hide();
		$('#userListTable').html(data);
		$('#userListCatSpan').html(title);
		// Reset dialog dimensions
		fitDialog(userListDialog);
		// Enabled buttons
		initButtonWidgets();
	});
}

// Download CSV list of users listed in popup
function downloadUserHistoryList() {
	var days = $('#activity-level').val();
	var search_term = '';
	var search_attr = '';
	if ($('#user_list_search').length) {
		search_term = trim($('#user_list_search').val());
		search_attr = $('#user_list_search_attr').val();
	}
	window.location.href = app_path_webroot+'ControlCenter/user_list_ajax.php?d='+days+'&search_term='+encodeURIComponent(search_term)+'&search_attr='+encodeURIComponent(search_attr);

}