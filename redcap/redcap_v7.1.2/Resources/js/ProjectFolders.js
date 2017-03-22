// Quicksearch for searching text in html tables
jQuery(function ($) {
    $.fn.projsearch = function (target, opt) {
	var ps_ids = [], timeout, cache, rowcache, jq_results, val = '', e = this, options = $.extend({
	    delay: 100,
	    selector: null,
	    stripeRows: null,
	    loader: null,
	    noResults: '',
	    bind: 'keyup',
	    onBefore: function () {
		return;
	    },
	    onAfter: function () {
		ps_ids = [];
		return;
	    },
	    show: function ()
	    {
		// ignore inner <tr> tags
		var ps_id = $(this).attr('ps_id');
		if(typeof ps_id == 'undefined')
		{
		    return;
		}

		if(val == '')
		{
		    // restore <tr>s to original
		    var ps = $(this).attr('ps');
		    if(typeof ps !== 'undefined' && ps == 'collapsed')
		    {
			this.style.display = 'none';
		    }
		    else
		    {
			this.style.display = '';
		    }
		}
		else
		{
		    this.style.display = '';
		}
	    },
	    hide: function () {

		// ignore inner <tr> tags
		var ps_id = $(this).attr('ps_id');
		if(typeof ps_id == 'undefined')
		{
		    return;
		}

		this.style.display = 'none';
	    }
	}, opt);

	this.go = function () {

	    var i = 0, noresults = true, vals = val.toLowerCase().split(' ');
	    var rowcache_length = rowcache.length;
	    for (var i = 0; i < rowcache_length; i++)
	    {
		var ps_id = $(rowcache[i]).attr('ps_id');

		if(val == '')
		{
		    options.show.apply(rowcache[i]);
		}
		else
		{
		    if(this.test(vals, cache[i]))
		    {
			// only show unique <tr>s
			if(typeof ps_id !== 'undefined' && ps_ids.indexOf(ps_id) == -1)
			{
			    // store <tr> ps_id to not show it again later
			    ps_ids.push(ps_id);

			    options.show.apply(rowcache[i]);
			    noresults = false;
			}
			else
			{
			    options.hide.apply(rowcache[i]);
			}
		    }
		    else
		    {
			options.hide.apply(rowcache[i]);
		    }
		}
	    }

	    if (noresults) {
		this.results(false);
	    } else {
		this.results(true);
		this.stripe();
	    }

	    this.loader(false);
	    options.onAfter();

	    return this;
	};

	this.stripe = function () {

	    if (typeof options.stripeRows === "object" && options.stripeRows !== null)
	    {
		var joined = options.stripeRows.join(' ');
		var stripeRows_length = options.stripeRows.length;

		jq_results.not(':hidden').each(function (i) {
		    $(this).removeClass(joined).addClass(options.stripeRows[i % stripeRows_length]);
		});
	    }

	    return this;
	};

	this.strip_html = function (input) {
	    var output = input.replace(/<\/?[^>]+>/gi, '');
	    output = $.trim(output.toLowerCase());
	    return output;
	};

	this.results = function (bool) {
	    if (typeof options.noResults === "string" && options.noResults !== "") {
		if (bool) {
		    $(options.noResults).hide();
		} else {
		    $(options.noResults).show();
		}
	    }
	    return this;
	};

	this.loader = function (bool) {
	    if (typeof options.loader === "string" && options.loader !== "") {
		(bool) ? $(options.loader).show() : $(options.loader).hide();
	    }
	    return this;
	};

	this.test = function (vals, t) {
	    for (var i = 0; i < vals.length; i += 1) {
		if (t.indexOf(vals[i]) === -1) {
		    return false;
		}
	    }
	    return true;
	};

	this.cache = function () {

	    jq_results = $(target);

	    if (typeof options.noResults === "string" && options.noResults !== "") {
		jq_results = jq_results.not(options.noResults);
	    }

	    var t = (typeof options.selector === "string") ? jq_results.find(options.selector) : $(target).not(options.noResults);
	    cache = t.map(function () {
		return e.strip_html(this.innerHTML);
	    });

	    rowcache = jq_results.map(function () {
		return this;
	    });

	    return this.go();
	};

	this.trigger = function () {
	    this.loader(true);
	    options.onBefore();

	    window.clearTimeout(timeout);
	    timeout = window.setTimeout(function () {
		e.go();
	    }, options.delay);

	    return this;
	};

	this.cache();
	this.results(true);
	this.stripe();
	this.loader(false);

	return this.each(function () {
	    $(this).bind(options.bind, function () {
		val = $(this).val();
		e.trigger();
	    });
	});

    };
});

$(function(){

	// Enable "search project" input
	$('#proj_search').projsearch('table#table-proj_table tbody tr', {'ignore':'1'});

	// Get counts for table
	getRecordOrFieldCountsMyProjects('fields', visiblePids);
	setTimeout("getRecordOrFieldCountsMyProjects('records', visiblePids)",100);
	// Set tooltip for Project Notes icons
	$('.projtitle').parent().parent().mouseover(function(){
		var this_row = $(this).children().eq(0).children().eq(0);
		if (!this_row.hasClass('pnp') || this_row.attr('pn') == null) {
			$('#pntooltip').hide();
			return;
		}
		var pnotes_img_pos = this_row.find('.pnpimg').offset();
		$('#pntooltip')
			.html(this_row.attr('pn'))
			.css({'text-align':'left','display':'block','position':'absolute'})
			.offset({ top: (pnotes_img_pos.top-118), left: (pnotes_img_pos.left - 100) })
			.hide()
			.show('fade',{ },200);
	});
	$('.pnp').parent().parent().mouseout(function(){
		$('#pntooltip').hide();
	});
	// Hide tooltip (if still showing) if click outside of projects table
	$(document).mouseup(function(e){
		var container = $('#pntooltip');
		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});
});

// Initialize jQuery spectrum widget
function initSpectrum(element, color)
{
	$(element).spectrum({
		preferredFormat: 'hex',
		showPaletteOnly: true,
		togglePaletteOnly: true,
		togglePaletteMoreText: 'more',
		togglePaletteLessText: 'less',
		hideAfterPaletteSelect: true,
		color: color,
		localStorageKey: 'redcap',
		change: function(color) {
			updateFolderColors();
		},
		palette: [
			["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
			["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
			["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
			["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
			["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
			["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
			["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
			["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
		]
	});
}

function newFolder()
{
	$('#folderName').val( trim($('#folderName').val()) );
	if ($('#folderName').val() == '') {
		simpleDialog(langProjFolder05,null,'',330,"$('#folderName').focus();");
		return;
	}
	$.post(
		app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
		{ new_folder: 1, name: $('#folderName').val() },
		function(data) { eval(data); }
	);
}

function updateFolderColors()
{
	$('#sample_folder').css({
	  'color':      $('#edit_folder_fg').spectrum('get').toString(),
	  'background': $('#edit_folder_bg').spectrum('get').toString()
	});
}

function hideAssigned()
{
	$.post(
		app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
		{ hide_assigned: 1, hide: ($('#hide_assigned').is(':checked') ? 1 : 0),
		  hide_archived: 1, archived: ($('#hide_archived').is(':checked') ? 1 : 0) },
		function(data) { getProjectFolders(); }
	);
}

function tglFld(project_id)
{
	$.post(
		app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
		{ toggle_project_folder: 1, project_id: project_id, folder_id: $('#folder_id').val() },
		function(data) { highlightSavedProject(project_id); }
	);
}

function editFolder(id,created)
{
	if (created != 1) created=0;
	$.ajax({
	  url: app_path_webroot + 'ProjectGeneral/project_folders_ajax.php?edit_folder=1&created='+created,
	  data: { folder_id: id },
	  success: function(data) { eval(data); }
	});
}

function deleteFolder(id,confirm)
{
	if (confirm == '1') {
		simpleDialog(langDelFolder, langProjFolder03, '', 400, '', langProjFolder04, 'deleteFolder('+id+',0);', langProjFolder03);
	} else {
		$.post(
			app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
			{ del_folder: 1, id: id },
			function(data) { getFolders(); }
		);
	}
}

function getFolders()
{
	$.ajax({
	  url: app_path_webroot + 'ProjectGeneral/project_folders_ajax.php?get_folders=1',
	  data: {},
	  success: function(data) {
		$('#folders').html(data);
		$('table#folders_list tbody').sortable({
		  containment:'parent',
		  tolerance: 'pointer',
		  update: function( event, ui ) {
				var data = $('table#folders_list tbody').sortable('serialize');
				$.post(app_path_webroot + 'ProjectGeneral/project_folders_ajax.php', { re_sort: 1, data: data },
					function(data) {
						getSelectFolders();
					}
				);
			}
		});
		getSelectFolders();
		initButtonWidgets();
	  }
	});
}

function getSelectFolders()
{
	$.ajax({
	  url: app_path_webroot + 'ProjectGeneral/project_folders_ajax.php?get_select_folders=1',
	  data: { selected: $('#folder_id').val() },
	  success: function(data) {
		$('#select_folders').html(data);
		$('#folder_id').on('change', function(){
			getProjectFolders();
		});
		getProjectFolders();
	  }
	});
}

function getProjectFolders()
{
	$.ajax({
	  url: app_path_webroot + 'ProjectGeneral/project_folders_ajax.php?get_project_folders=1',
	  data: { folder_id: $('#folder_id').val() },
	  success: function(data) {
		$('#projects').html(data);
	  }
	});
}

function saveFolder()
{
	var fg = $('#edit_folder_fg').spectrum('get').toString().substring(1, 7);
	var bg = $('#edit_folder_bg').spectrum('get').toString().substring(1, 7);
	$.post(
		app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
		{ save_folder: 1,
		  id: $('#edit_folder_id').val(),
		  name: $('#edit_folder_name').val(),
		  fg: fg, bg: bg
		},
		function(data) { getFolders(); }
	);
}

function checkAllProjects(folder_id, ids)
{
	var checkAll = $('input#checkAll').is(':checked');
	$.each(ids.split(','), function( k, v ) {
		$('input#pid_' + v).prop('checked', checkAll);
	});

	$.post(
		app_path_webroot + 'ProjectGeneral/project_folders_ajax.php',
		{ check_all_projects: 1, folder_id: folder_id, ids: ids, checkAll: checkAll },
		function(data) { highlightSavedProjectAll(); }
	);
}

function toggleFolderCollapse(id)
{
	if (id == '0') return;
	if(id && page != 'ControlCenter/view_projects.php')
	{
		$.ajax({
		  url: app_path_webroot + 'ProjectGeneral/project_folders_ajax.php?toggle_folder_collapse=1',
				data: { folder_id: id },
				success: function(data) { eval(data); }
		});
	}

	var expanded = isMobileDeviceFunc() ? $('span#colm_' + id).is(':visible') : $('span#col_' + id).is(':visible');

	if(expanded) {
		$('span#col_' + id + ', span#colm_' + id).hide();
		$('span#exp_' + id + ', span#expm_' + id).show();
	} else {
		$('span#col_' + id + ', span#colm_' + id).show();
		$('span#exp_' + id + ', span#expm_' + id).hide();
	}

	$('[id^=f_' + id + '], [id^=fm_' + id + ']').each( function( k, v ) {
		if(expanded) {
			$(v).attr('ps', 'collapsed');
			$(v).hide();
		} else {
			$(v).attr('ps', 'expanded');
			$(v).show();
		}
	});
}

function checkFolderNameSubmit(event)
{
	if(event && event.keyCode == 13)
	{
		newFolder();
	}
}

function highlightSavedProject(project_id)
{
	$('#proj_tr_' + project_id + ' td').effect('highlight', 1500);
	$('#proj_saved_' + project_id).show().fadeOut(1500);
}

function highlightSavedProjectAll()
{
	$('#projects tr[id^=proj_tr_] td').effect('highlight', 1500);
	$('#projects [id^=proj_saved_]').show().fadeOut(1500);
}

function organizeProjects()
{
	simpleDialog(langProjFolder02, "<div style='color:#008000;'><span class='glyphicon glyphicon-folder-open' style='margin-right:4px;'></span> "+langProjFolder01+"</div>", 'folders_popup', 894, "showProgress(1);window.location.href=dirname(dirname(app_path_webroot))+'/index.php?action=myprojects';");
	getFolders();
}