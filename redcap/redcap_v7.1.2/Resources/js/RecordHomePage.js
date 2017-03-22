$(function(){
	// Center the record ID name with the table
	var eg = $('#event_grid_table');
	if (eg.width() < 800) $('#record_display_name').width( eg.width() );
	$('#record_display_name').css('visibility','visible');
	// Enable repeating forms buttons
	$('.btnAddRptEv').on({
		mouseenter: function(){
			$(this).removeClass('btn-defaultrc').removeClass('opacity50').addClass('btn-success');
		},
		mouseleave: function () {
			$(this).removeClass('btn-success').addClass('opacity50').addClass('btn-defaultrc');
		}
	});
	// Clickable buttons to collapse tables
	initBtnsCollapseTables();
	// Enable fixed table headers for event grid
	enableFixedTableHdrs('event_grid_table');
	// Move collapse icon position for main table
	$('#event_grid_table .btn-table-collapse').css('position','absolute').show().position({ my: 'left top', at: 'left+3 top+4', of: $('#event_grid_table') });
	setTimeout(function(){
		$('#event_grid_table .btn-table-collapse').position({ my: 'left top', at: 'left+3 top+4', of: $('#event_grid_table') });
	},500);
});

// Clickable buttons to collapse tables
function initBtnsCollapseTables() {
	$('.btn-table-collapse, .btn-event-collapse').on({
		mouseenter: function(){
			if ($(this).attr('collapsed') == '1') return;
			$(this).removeClass('opacity50').addClass($(this).hasClass('btn-table-collapse') ? 'btn-primary' : 'btn-warning');
		},
		mouseleave: function () {
			if ($(this).attr('collapsed') == '1') return;
			$(this).addClass('opacity50').removeClass($(this).hasClass('btn-table-collapse') ? 'btn-primary' : 'btn-warning');
		}
	});
	$('#recordhome-uncollapse-all').on({
		mouseenter: function(){
			$(this).removeClass('opacity65');
		},
		mouseleave: function () {
			$(this).addClass('opacity65');
		}
	});
	// Uncollapse all tables/events on the Record Home Page
	$('#recordhome-uncollapse-all').click(function(){		
		var targetids = new Array();
		var i = 0;
		$('.btn-table-collapse.btn-primary, .btn-event-collapse.btn-warning').each(function(){
			if ($(this).attr('targetid') == null) return;
			// Add .collapse-no-save class to prevent individual AJAX request from firing from each
			$(this).addClass('collapse-no-save').trigger('click');
			// Get targetid
			targetids[i++] = $(this).attr('targetid');
		});
		if (!targetids.length) return;
		// Save all at once via AJAX
		$.post(app_path_webroot+'DataEntry/record_home_collapse_table.php?pid='+pid,{ collapse: 0, object: 'record_home', targetid: targetids.join(',') });
		// Reset footer position
		displayUncollapseAllLink();
		setProjectFooterPosition();
	});
	// Collapse or uncollapse tables or event columns
	$('.btn-table-collapse, .btn-event-collapse').click(function(){
		var targetid = $(this).attr('targetid');
		var collapsed = ($(this).attr('collapsed') == '1') ? '1' : '0';
		var collapse = Math.abs(collapsed-1);
		$(this).attr('collapsed', collapse);
		if ($(this).hasClass('btn-table-collapse')) {
			// Collapse table
			if (collapsed == '1') {
				$(this).removeClass('btn-primary');
				$('#'+targetid+' tr:not(:first)').removeClass('hide').show();
				$('.FixedHeader_Left').show();
			} else {
				$(this).addClass('btn-primary');
				$('#'+targetid+' tr:not(:first)').hide();
				$('.FixedHeader_Left').hide();
			}
		} else {
			// Collapse event columns
			if (collapsed == '1') {
				$(this).removeClass('btn-warning');
				$('.eventCol-'+targetid).removeClass('hide').show();
				$('span:first', this).removeClass('glyphicon-forward').addClass('glyphicon-backward');
			} else {
				$(this).addClass('btn-warning');
				$('.eventCol-'+targetid).hide();
				$('span:first', this).removeClass('glyphicon-backward').addClass('glyphicon-forward');
			}
			targetid = 'repeat_event-'+targetid;
		}
		// If button contains .collapse-no-save class, then skip the AJAX save
		if (!$(this).hasClass('collapse-no-save')) {
			$.post(app_path_webroot+'DataEntry/record_home_collapse_table.php?pid='+pid,{ collapse: collapse, object: 'record_home', targetid: targetid });
		}
		// Now remove the .collapse-no-save class since we are done with this item
		$(this).removeClass('collapse-no-save');
		// Reset footer position
		displayUncollapseAllLink();
		setProjectFooterPosition();
	});
	// If some tables or event columns are collapsed, then display the "Uncollapse all" link
	displayUncollapseAllLink();
}

// If some tables or event columns are collapsed, then display the "Uncollapse all" link
function displayUncollapseAllLink() {
	if ($('.btn-table-collapse.btn-primary, .btn-event-collapse.btn-warning').length) {
		$('#recordhome-uncollapse-all').show();
	} else {
		$('#recordhome-uncollapse-all').hide();
	}
}

// Action when click button to repeat an event - adds new column to table
function gridAddRepeatingEvent(ob) {
	var index = $(ob).parentsUntil('th').parent().index();
	var cellTag = 'th';
	var cell, clone;
	// Get current instance
	var newInstance = $(ob).attr('instance')*1 + 1;
	// Get event_id
	var event_id = $(ob).attr('event_id');
	// Have floating headers been enabled for the table? If so, remove them, then re-add at end.
	var hasFloatingHdrs = ($('div.FixedHeader_Cloned').length > 0);
	if (hasFloatingHdrs) $('div.FixedHeader_Cloned').remove();
	// Remove button just pressed and the arrow button
	$('table.event_grid_table tr th:eq('+(index)+') .divBtnAddRptEv, table.event_grid_table tr th:eq('+(index)+') .btn-event-collapse').css('display','none');
	// Loop through table rows
	$('#event_grid_table tr').each(function(){
		// Find cell
		cell = $(cellTag+':eq('+index+')', this);
		// Clone the cell and append it
		clone = clone2 = cell.clone();
		cell.after(clone);
		clone.hide().fadeIn(500);
		// Modify new column
		if (cellTag == 'th') {
			// Header
			clone.find('.instanceNum').html(newInstance);
			clone.find('.evTitle').remove();
			clone.find('.custom_event_label').remove();
			clone.css({'background-color':'#C1FFC1'});
			// Add delete icon
			clone.prepend('<div style="text-align:center;margin-bottom:10px;"><a href="javascript:;" onclick="gridDeleteRepeatingEvent(this)"><img src="'+app_path_images+'cross.png"></a></div>');
			// Set for all remaining loops
			cellTag = 'td';			
			// Add to floating table header, if displayed
			if ($('div.FixedHeader_Header table').length) {
				$('div.FixedHeader_Header table tr th:eq('+index+')').after(clone2);
			}
		} else {
			// Normal row
			clone.css({'background-color':'#C1FFC1'});
			clone.find('.gridLockEsign').remove();
			clone.find('.glyphicon-remove').remove();
			// Set all status icons as gray icon
			clone.find('img').prop('src',app_path_images+'circle_gray.png');
			// Change all icon URLs to point to new instance
			clone.find('a').each(function(){
				var href = $(this).attr('href').replace('&instance=','&oldinstance=');
				$(this).prop('href', href+'&instance='+newInstance);
			});
		}
	});
	// Make sure all instance numbers are displayed (if this is the first repeating event)
	$('.evGridHdrInstance-'+event_id).show();	
	// Re-enable fixed table headers for event grid
	if (hasFloatingHdrs) {
		setTimeout(function(){
			enableFixedTableHdrs('event_grid_table');
			// Due to weird quirk, remove table width attribute in clone
			setTimeout(function(){
				$('div.FixedHeader_Header table, div.FixedHeader_Left table, div.FixedHeader_LeftHead table').width('auto');
			},50);
		},550);
	}
}

// Action when click delete icon to remove tentative repeating event
function gridDeleteRepeatingEvent(ob) {	
	var index = $(ob).parentsUntil('th').parent().index();
	var cellTag = 'th';
	var cell, this_event_id;
	// Have floating headers been enabled for the table? If so, remove them, then re-add at end.
	var hasFloatingHdrs = ($('div.FixedHeader_Cloned').length > 0);
	if (hasFloatingHdrs) $('div.FixedHeader_Cloned').remove();
	// Loop through table rows
	$('#event_grid_table tr').each(function(){
		// Remove cell
		cell = $(cellTag+':eq('+index+')', this);
		if (cellTag == 'th') {	
			cell.fadeOut('slow',function(){ 
				$(this).remove(); 
				// Restore "repeat" button and arrow button for event
				$('table.event_grid_table tr th:eq('+(index-1)+') .divBtnAddRptEv, table.event_grid_table tr th:eq('+(index-1)+') .btn-event-collapse').show();
			});
			// Set for all remaining loops
			cellTag = 'td';
		} else {
			cell.fadeOut(500,function(){ $(this).remove(); });
		}
	});	
	// Re-enable fixed table headers for event grid
	if (hasFloatingHdrs) {
		setTimeout(function(){
			enableFixedTableHdrs('event_grid_table');
			// Due to weird quirk, remove table width attribute in clone
			setTimeout(function(){
				$('div.FixedHeader_Header table, div.FixedHeader_Left table, div.FixedHeader_LeftHead table').width('auto');
				$('.FixedHeader_Header table.event_grid_table tr th:eq('+(index-1)+') .divBtnAddRptEv, .FixedHeader_Header table.event_grid_table tr th:eq('+(index-1)+') .btn-event-collapse').css('display','');
			},50);
		},550);
	}
}