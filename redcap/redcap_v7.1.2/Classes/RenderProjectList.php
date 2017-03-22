<?php

/**
 * RENDER PROJECT LIST
 * Display all REDCap projects in table format
 */
class RenderProjectList
{
	static function getTRData($project, $dts_rights=array())
	{
		global  $display_nonauth_projects, $auth_meth_global, $dts_enabled_global, $google_translate_enabled,
				$isIE, $lang, $rc_connection, $realtime_webservice_global_enabled, $two_factor_auth_enabled;

		// Are we viewing the list from the Control Center?
		$isControlCenter = (strpos(PAGE_FULL, "/ControlCenter/") !== false);

		$all_proj_ids = array();

		// Store project_id in array to use in AJAX call on pageload
		$all_proj_ids[] = $project['project_id'];

		//Determine if we need to show if a production project's drafted changes are in review
		$in_review = '';
		if($project['draft_mode'] == '2')
		{
			$in_review = "<br><span class='aGridsub' onclick=\"window.location.href='" . APP_PATH_WEBROOT . "Design/project_modifications.php?pid={$project['project_id']}';return false;\">({$lang['control_center_104']})</span>";
		}

		//Determine if we need to show Super User functionality (edit db, delete db)
		$settings_link = '';
		if ($isControlCenter)
		{
			$settings_link = '<div class="aGridsub"><a style="color:#000;font-family:Tahoma;font-size:10px;" href="' . APP_PATH_WEBROOT . 'ControlCenter/edit_project.php?project=' . $project['project_id'] . '">' . $lang['control_center_106'] . '</a> | <a style="font-family:Tahoma;font-size:10px;" href="javascript:;" onclick="revHist(' . $project['project_id'] . ')">' . $lang['app_18'] . '</a> | ' . ($project['date_deleted'] == '' ? '<a style="color:#800000;font-family:Tahoma;font-size:10px;" href="javascript:;" onclick="delete_project(' . $project['project_id'] . ',this)">' . $lang['control_center_105'] . '</a>'	: '<a style="color:green;font-family:Tahoma;font-size:10px;" href="javascript:;" onclick="undelete_project(' . $project['project_id'] . ',this)">' . $lang['control_center_375'] . '</a><br /><img src="' . APP_PATH_IMAGES . 'bullet_delete.png"><span style="color:red;">' . $lang['control_center_380'] . ' ' . DateTimeRC::format_ts_from_ymd(date('Y-m-d H:i:s', strtotime($project['date_deleted']) + 3600 * 24 * Project::DELETE_PROJECT_DAY_LAG)) . '</span><br /><span style="color:#666;margin:0 3px 0 12px;">' . $lang['global_46'] . '</span><a style="text-decoration:underline;color:red;font-family:Tahoma;font-size:10px;" href="javascript:;" onclick="delete_project(' . $project['project_id'] . ',this,1,1,1)">' . $lang['control_center_381'] . '</a>') . '</div>';
		}

		// Project Templates: Build array of all templates so we can put a star by their title for super users only
		$templates = (defined('SUPER_USER') && SUPER_USER) ? ProjectTemplates::getTemplateList() : array();

		// DTS Adjudication notification (only on myProjects page)
		$dtsLink = '';

		// Determine if DTS is enabled globally and also for this user on this project
		if($dts_enabled_global && isset($dts_rights[$project['project_id']]))
		{
			// Instantiate new DtsController object
			$dts = new DtsController();
			// Get count of items that needed adjudication
			$recommendationCount = $dts->getPendingCountByProjectId($project['project_id']);
			// Render a link if items exist
			if($recommendationCount > 0)
			{
				$dtsLink = '<div class="aGridsub" style="padding:0 5px;text-align:right;"><a title="' . $lang['home_28'] . '" href="' . APP_PATH_WEBROOT . 'index.php?pid=' . $project['project_id'] . '&route=DtsController:adjudication" style="text-decoration:underline;color:green; font-family:Tahoma; font-size:10px;"><img src="' . APP_PATH_IMAGES . 'tick_small_circle.png">' . $lang['home_28'] . '</a></div>';
			}
			else
			{
				$dtsLink = '<div class="aGridsub" style="color:#aaa;padding:0 5px;text-align:right;">' . $lang['home_29'] . '</div>';
			}
		}
		
		// If project is a template, then display a star next to title (for super users only)
		$templateIcon = (isset($templates[$project['project_id']]))	? ($templates[$project['project_id']]['enabled'] ? RCView::img(array('src'=>'star_small2.png', 'style'=>'margin-left:5px;')) : RCView::img(array('src'=>'star_small_empty2.png','style'=>'margin-left:5px;'))) : '';
		
		// Project Notes: If has some text in its project notes, then display icon to mouse over to display the notes
		$project_note = $project_note_class = $project_link_title = '';

		if($project['project_note'] != '')
		{
			$project_note_class = " pnp";
			$project_link_title = ' pn="'.htmlspecialchars($project['project_note'], ENT_QUOTES).'"';
			$project_note = "<span class='aGridsub'><img src='".APP_PATH_IMAGES."document_small.gif' class='pnpimg'></span>";
		}

		// Exempt from Two Factor authentication
		$twoFactorExemptIcon = '';

		if($isControlCenter && $project['two_factor_exempt_project'] && $two_factor_auth_enabled)
		{
			$twoFactorExemptIcon = '<img style="margin-left:5px;" src="' . APP_PATH_IMAGES . 'smartphone_key.png" title="' . cleanHtml2($lang['system_config_512']) . '"><img style="vertical-align:middle;position:relative;left:-7px;margin-right:-7px;" src="' . APP_PATH_IMAGES . 'cross.png" title="' . cleanHtml2($lang['system_config_512']) . '">';
		}
		
		// Display the PID number in the Control Center's Browse Projects page
		$pidNum = ($isControlCenter) ? " <span class='browseProjPid'>PID {$project['project_id']}</span>" : "";

		// Title as link
		if($project['status'] < 1)
		{
			// Send to setup page if in development still
			$title = '<div class="projtitle' . $project_note_class . '"' . $project_link_title . '><a href="' . APP_PATH_WEBROOT . 'ProjectSetup/index.php?pid=' . $project['project_id'] . '" class="aGrid">' . $project['app_title'] . $pidNum . $templateIcon . $project_note . $twoFactorExemptIcon . $in_review . $settings_link . $dtsLink . $ddpLink . '</a></div>';
		}
		else
		{
			$title = '<div class="projtitle' . $project_note_class . '"' . $project_link_title . '><a href="' . APP_PATH_WEBROOT . 'index.php?pid=' . $project['project_id'] . '" class="aGrid">' . $project['app_title'] . $pidNum . $templateIcon . $project_note . $twoFactorExemptIcon . $in_review . $settings_link . $dtsLink . $ddpLink . '</a></div>';
		}

		// Status
		if($project['date_deleted'] != '')
		{
			// If project is "deleted", display cross icon
			$iconstatus = '<span class="glyphicon glyphicon-remove-sign" style="color:#C00000;font-size:14px;" aria-hidden="true" title="' . cleanHtml2($lang['global_106']) . '"></span>';
		}
		else
		{
			// If typical project, display icon based upon status value
			switch($project['status'])
			{
			case 0: // Development
				$iconstatus = '<span class="glyphicon glyphicon-wrench" style="color:#444;font-size:14px;" aria-hidden="true" title="' . cleanHtml2($lang['global_29']) . '"></span>';
				break;
			case 1: // Production
				$iconstatus = '<span class="glyphicon glyphicon-check" style="color:#00A000;font-size:14px;" aria-hidden="true" title="' . cleanHtml2($lang['global_30']) . '"></span>';
				break;
			case 2: // Inactive
				$iconstatus = '<span class="glyphicon glyphicon-minus-sign" style="color:#800000;font-size:14px;" aria-hidden="true" title="' . cleanHtml2($lang['global_31']) . '"></span>';
				break;
			case 3: // Archived
				$iconstatus = '<span class="glyphicon glyphicon-trash" style="font-size:14px;" aria-hidden="true" title="' . cleanHtml2($lang['global_26']) . '"></span>';
				break;
			}
		}

		// Project type (classic or longitudinal)
		$icontype = ($project['longitudinal']) ? RCView::img(array('src'=>'blogs_stack.png', 'title'=>$lang['create_project_51'])) : RCView::img(array('src'=>'blog_blue.png', 'title'=>$lang['create_project_49']));

		// Append $iconstatus with an invisible span containing the value (for ability to sort)
		$icontype .= RCView::span(array('class'=>'hidden'), $project['longitudinal']);

		$row_data = array(
			$title,
			"<span class='pid-cntr-{$project['project_id']}'><span class='pid-cnt'>{$lang['data_entry_64']}</span></span>",
			"<span class='pid-cntf-{$project['project_id']}'><span class='pid-cnt'>{$lang['data_entry_64']}</span></span>",
			"<span class='pid-cnti-{$project['project_id']}'><span class='pid-cnt'>{$lang['data_entry_64']}</span></span>",
			$icontype,
			$iconstatus
		);

		return array($row_data, $all_proj_ids);
	}

	// $opacity should be 0-1
	static function projectBGStyle($color, $opacity)
	{
		// get decimal values
		$r = hexdec($color[0] . $color[1]);
		$g = hexdec($color[2] . $color[3]);
		$b = hexdec($color[4] . $color[5]);

		// ms opacity must be in range 0-255
		$ms_opacity = dechex(255 * $opacity);

		// special ms format with alpha value first
		$ms_color = $ms_opacity . sprintf('%02X%02X%02X', $r, $g, $b);

		// specific styles and ordering for ie8 on win7
		return "background-color:rgb($r, $g, $b); background:transparent\9; background-color:rgba($r, $g, $b, $opacity); -ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#$ms_color, endColorstr=#$ms_color); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#$ms_color, endColorstr=#$ms_color);";
	}

	// $diff should be 0-1
	static function bgColor($color, $diff)
	{
		// get decimal values
		$r = hexdec($color[0] . $color[1]);
		$g = hexdec($color[2] . $color[3]);
		$b = hexdec($color[4] . $color[5]);

		// calculate new color values
		$r *= $diff;
		$g *= $diff;
		$b *= $diff;

		// ship it back in hex
		return sprintf('%02X%02X%02X', $r, $g, $b);
	}

	static function bgGradientStyles($bg1, $bg2)
	{
		return "background:-webkit-linear-gradient(#$bg1, #$bg2); background:-o-linear-gradient(#$bg1, #$bg2); background:-moz-linear-gradient(#$bg1, #$bg2); background:linear-gradient(#$bg1, #$bg2); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#$bg1, endColorstr=#$bg2); -ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#$bg1, endColorstr=#$bg2);";
	}

	static function getTRs($projects, $dts_rights)
	{
		$row_data = array();
		$all_proj_ids = array();

		// projects are in folders
		if(ProjectFolders::inFolders($projects))
		{
			foreach($projects as $folder_id => $f)
			{
				$bg2 = RenderProjectList::bgColor($f['background'], ProjectFolders::FOLDER_GRADIENT);
				$background = RenderProjectList::bgGradientStyles($f['background'], $bg2);
				$num_projects_folder = (count($f['projects'])-(isset($_GET['show_archived']) ? 0 : $f['archived']));
				if ($num_projects_folder == 0) continue;

				$row_data[] = array(
					$folder_id,
					$f['name'] . RCView::span(array('class'=>'fldcntnum opacity65'), '(' . $num_projects_folder . ')'),
					$f['collapsed'],
					array($f[foreground], $background, $f['background'])
				);

				foreach($f['projects'] as $p)
				{
					// If project is archived, do not show it unless the "Show Archived" link was clicked
					if($p['status'] == '3' && !isset($_GET['show_archived']))
					{
						continue;
					}

					list($data, $ids) = RenderProjectList::getTRData($p, $dts_rights);

					$row_data[] = $data;

					foreach($ids as $id)
					{
						$all_proj_ids[] = $id;
					}
				}
			}

			return array($row_data, $all_proj_ids);
		}

		// projects are not in folders
		foreach($projects as $p)
		{
			// If project is archived, do not show it unless the "Show Archived" link was clicked
			if($p['status'] == '3' && !isset($_GET['show_archived']))
			{
				continue;
			}

			list($data, $ids) = RenderProjectList::getTRData($p, array());

			$row_data[] = $data;

			foreach($ids as $id)
			{
				$all_proj_ids[] = $id;
			}
		}

		return array($row_data, $all_proj_ids);
	}


	// Display the project list
	function renderprojects($section = "")
	{
		global  $display_nonauth_projects, $auth_meth_global, $dts_enabled_global, $google_translate_enabled,
				$isIE, $lang, $rc_connection, $realtime_webservice_global_enabled, $two_factor_auth_enabled;

		// Reset session flag for Folder checkbox to hide already-assigned projects
		unset($_SESSION['hide_assigned']);
		// Place all project info into array
		$proj = array();
		// Are we viewing the list from the Control Center?
		$isControlCenter = (strpos(PAGE_FULL, "/ControlCenter/") !== false);

		//First get projects list from User Info and User Rights tables
		if ($isControlCenter && isset($_GET['userid']) && $_GET['userid'] != "") {
			// Show just one user's (not current user, since we are super user in Control Center)
			$sql = "select p.project_id, p.two_factor_exempt_project, p.project_note, p.project_name, p.app_title, p.status, p.draft_mode, p.surveys_enabled, p.date_deleted, p.repeatforms
					from redcap_user_rights u, redcap_projects p
					where u.project_id = p.project_id and u.username = '".prep($_GET['userid'])."' order by p.project_id";
		} elseif ($isControlCenter && isset($_GET['view_all'])) {
			// Show all projects
			$sql = "select p.project_id, p.two_factor_exempt_project, p.project_note, p.project_name, p.app_title, p.status, p.draft_mode, p.surveys_enabled, p.date_deleted, p.repeatforms
					from redcap_projects p order by p.project_id";
		} elseif ($isControlCenter && (!isset($_GET['userid']) || $_GET['userid'] == "")) {
			// Show no projects (default)
			$sql = "select 1 from redcap_projects limit 0";
		} else {
			// Show current user's (ignore "deleted" projects)
			$sql = "select p.project_id, p.two_factor_exempt_project, p.project_note, p.project_name, p.app_title, p.status, p.draft_mode, p.surveys_enabled, p.date_deleted, p.repeatforms
					from redcap_user_rights u, redcap_projects p
					where u.project_id = p.project_id and u.username = '" . prep(defined('USERID') ? USERID : '') . "'
					and p.date_deleted is null order by p.project_id";
		}

		$q = db_query($sql);
		while ($row = db_fetch_array($q))
		{
			$proj[$row['project_name']]['project_id'] = $row['project_id'];
			$proj[$row['project_name']]['project_note'] = strip_tags(str_replace(array("\r\n","\r","\n","\t"), array(" "," "," "," "), br2nl(label_decode(trim($row['project_note'])))));
			if (strlen($proj[$row['project_name']]['project_note']) > 136) {
				$proj[$row['project_name']]['project_note'] = substr($proj[$row['project_name']]['project_note'], 0, 134)."...";
			}
			$proj[$row['project_name']]['longitudinal'] = $row['repeatforms'];
			$proj[$row['project_name']]['status'] = $row['status'];
			$proj[$row['project_name']]['two_factor_exempt_project'] = $row['two_factor_exempt_project'];
			$proj[$row['project_name']]['date_deleted'] = $row['date_deleted'];
			$proj[$row['project_name']]['draft_mode'] = $row['draft_mode'];
			$proj[$row['project_name']]['surveys_enabled'] = $row['surveys_enabled'];
			$proj[$row['project_name']]['app_title'] = strip_tags(str_replace(array("<br>","<br/>","<br />"), array(" "," "," "), html_entity_decode($row['app_title'], ENT_QUOTES)));
			if (isset($_GET['no_counts'])) {
				$proj[$row['project_name']]['count'] = "";
				$proj[$row['project_name']]['field_num'] = "";
			} else {
				$proj[$row['project_name']]['count'] = 0;
				$proj[$row['project_name']]['field_num'] = 0;
			}
		}

		if(!$isControlCenter && !isset($_GET['userid']) || $_GET['userid'] != "")
		{
			$userid = isset($_GET['userid']) ? $_GET['userid'] : USERID;
			$proj = ProjectFolders::projectsInFolders(User::getUserInfo($userid), $proj);
		}

		// Add count of archived projects in each folder
		foreach ($proj as $this_folder_id=>$attr) {
			$this_folder_archived = 0;
			foreach ($attr['projects'] as $this_app_name=>$pattr) {
				if ($pattr['status'] == '3') $this_folder_archived++;
			}
			$proj[$this_folder_id]['archived'] = $this_folder_archived;
		}

		$proj_ids = ProjectFolders::projectIDs($proj);
		$proj_ids_list = count($proj_ids) ? implode(',', $proj_ids) : 0;


		## DTS: If enabled globally, build list of projects to check to see if adjudication is needed
		if ($dts_enabled_global)
		{
			// Set default
			$dts_rights = array();

			// Get projects with DTS enabled
			if (!$isControlCenter) {
				// Where normal user has DTS rights
				$sql = "select p.project_id from redcap_user_rights u, redcap_projects p where u.username = '" . prep(USERID) . "' and
						p.project_id = u.project_id and p.dts_enabled = 1 and
						p.project_id in ($proj_ids_list)";
				// Don't query using DTS user rights on project if a super user because they might not have those rights in
				// the user_rights table, although once they access the project, they are automatically given those rights
				// because super users get maximum rights for everything once they're inside a project.
				if (!SUPER_USER) {
					$sql .= " and u.dts = 1";
				}
			} else {
				// Super user in Control Center
				$sql = "select project_id from redcap_projects where dts_enabled = 1
						and project_id in ($proj_ids_list)";
			}
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q))
			{
				$dts_rights[$row['project_id']] = true;
			}
		}

		/*
		## DDP: If enabled globally, build list of projects to check to see if adjudication is needed
		// Set default
		$ddp_new_items = array();
		if ($realtime_webservice_global_enabled)
		{
			// Get projects with DDP enabled
			if (!$isControlCenter) {
				// Where normal user has DDP rights
				$sql = "select distinct p.project_id from redcap_user_rights u, redcap_projects p where u.username = '" . prep(USERID) . "' and
						p.project_id = u.project_id and p.realtime_webservice_enabled = 1 and
						p.project_name in (" . prep_implode(array_keys($proj)) . ")";
				// Don't query using DDP user rights on project if a super user because they might not have those rights in
				// the user_rights table, although once they access the project, they are automatically given those rights
				// because super users get maximum rights for everything once they're inside a project.
				if (!SUPER_USER) {
					$sql .= " and u.realtime_webservice_adjudicate = 1";
				}
			} else {
				// Super user in Control Center
				$sql = "select project_id from redcap_projects where realtime_webservice_enabled = 1
						and project_name in (" . prep_implode(array_keys($proj)) . ")";
			}
			$q = db_query($sql);
			while ($row = db_fetch_assoc($q))
			{
				$ddp_new_items[$row['project_id']] = 0;
			}
			// If any displayed projects have DDP enabled and user has "adjudication" rights, then go see if any new items to adjudicate
			if (!empty($ddp_new_items))
			{
				$sql = "select r.project_id from redcap_ddp_records r, redcap_ddp_records_data d
						where r.mr_id = d.mr_id and d.adjudicated = 0 and d.exclude = 0
						and r.project_id in (" . prep_implode(array_keys($ddp_new_items)) . ") group by r.project_id";
				$q = db_query($sql);
				while ($row = db_fetch_assoc($q))
				{
					$ddp_new_items[$row['project_id']] = 1;
				}
			}
		}
		*/

		list($row_data, $all_proj_ids) = RenderProjectList::getTRs($proj, $dts_rights);

		// If user has access to zero projects
		$filter_projects_style = '';
		if (empty($row_data)) {
			$row_data[] = array(($isControlCenter ? $lang['home_37'] : $lang['home_38']),"","","","","");
			// Hide the "filter projects" if no projects are showing
			$filter_projects_style = 'visibility:hidden;';
		}

		// Set table title name
		$tableHeader = $isControlCenter ? $lang['control_center_134'] : $lang['home_22'];
		$organizeBtn = $isControlCenter ? "" :
						RCView::button(array(
								'onclick' => 'organizeProjects();',
								'class'   => 'btn btn-defaultrc btn-xs',
								'style'   => 'margin-left:50px;color:#008000;'
							),
							RCView::span(array('class'=>'glyphicon glyphicon-folder-open','style'=>'margin-right:6px;'), '') .
							$lang['control_center_4516']
						);

		// Set "My Projects" column header's project search input
		$searchProjTextboxJsFocus = "if ($(this).val() == '".cleanHtml($lang['control_center_440'])."') {
									$(this).val(''); $(this).css('color','#000');
								  }";
		$searchProjTextboxJsBlur = "$(this).val( trim($(this).val()) );
								  if ($(this).val() == '') {
									$(this).val('".cleanHtml($lang['control_center_440'])."'); $(this).css('color','#999');
								  }";
		$tableTitle = 	RCView::div(array('style'=>''),
							RCView::div(array('style'=>'font-size:13px;float:left;margin:2px 0 0 3px;'),
								$tableHeader . $organizeBtn
							) .

							// Search text box
							RCView::div(array('style'=>'float:right;margin:0 10px 0 0;'),
								RCView::text(array('id'=>'proj_search', 'class'=>'x-form-text x-form-field',
									'style'=>'width:180px;color:#999;font-size:13px;padding: 3px 5px;'.$filter_projects_style, 'value'=>$lang['control_center_440'],
									'onfocus'=>$searchProjTextboxJsFocus,'onblur'=>$searchProjTextboxJsBlur))
							) .
							// Control Center only: Link to show Archived projects
							(!($isControlCenter && !isset($_GET['show_archived']) && (isset($_GET['userid']) || isset($_GET['view_all']))) ? '' :
								RCView::div(array('style'=>'float:right;margin:3px 40px 0 0;'),
									RCView::a(array('style'=>'font-weight:normal;font-size:11px;color:#666;', 'href'=>$_SERVER['REQUEST_URI']."&show_archived"), 
										'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> ' .$lang['home_10'])
								)
							) .
							RCView::div(array('class'=>'clear'), '')
						);

		// Render table
		$width = 850; // Whole table width
		$width2 = 52; // Records
		$width3 = 48; // Fields
		$width6 = 68; // Instruments
		$width5 = 38; // Type
		$width4 = 44; // Status
		if ($section == "control_center") $width = 710;
		$width1 = $width - $width2 - $width3 - $width4 - $width5 - $width6 - 73; // DB name
		$col_widths_headers[] = array($width1, $lang['home_30']);
		$col_widths_headers[] = array($width2, $lang['home_31'], "center", "int");
		$col_widths_headers[] = array($width3, $lang['home_32'], "center", "int");
		$col_widths_headers[] = array($width6, $lang['global_110'], "center", "int");
		$col_widths_headers[] = array($width5, $lang['home_39'], "center");
		$col_widths_headers[] = array($width4, $lang['home_33'], "center");

		// Build popup content
		$user = User::getUserInfo(USERID);



		$popup_content_left_td = RCView::td(array('style'=>'vertical-align:top'),
			RCView::div(array('class'=>'addFieldMatrixRowHdr', 'style'=>'width:400px; float:left;'),
				RCView::table(array('class'=>'form_border', 'style'=>'width:97%;'),
					RCView::tr(array(),
						RCView::td(array('class'=>'labelrc create_rprt_hdr', 'colspan'=>3, 'style'=>'padding:0;background:#fff;border:0;'),
							RCView::div(array('style'=>'position:relative;top:13px;background-color:#ddd;border:1px solid #ccc;border-bottom:1px solid #ddd;float:left;padding:8px 8px;'),
								$lang['folders_28']
							)
						)
					  ) .
					  RCView::tr(array(),
						RCView::td(array('class'=>'labelrc create_rprt_hdr', 'colspan'=>3, 'style'=>'padding:5px;'),
							RCView::div(array('style'=>'color:#444;float:left;font-weight:normal;margin-top:10px;'), $lang['folders_12']) .
							RCView::div(array('style'=>'float:right;margin-top:7px;'),
								RCView::input(array(
									'placeholder' => $lang['folders_17'],
									'id'          => 'folderName',
									'type'        => 'text',
									'maxlength'   => 64,
									'class'	  => 'x-form-text x-form-field',
									'style'   => 'width:150px;',
									'onkeypress'  => 'return checkFolderNameSubmit(event);'
								)) . '&nbsp;' .
								RCView::button(array(
									'id'      => 'addFolder',
									'class'	  => 'jqbuttonmed',
									'style'   => 'border-color:#999;font-weight:bold;font-size:13px;',
									'onclick' => 'newFolder();'
								), $lang['folders_18'])
							)
						)
					  )
				) .
				// List of projects
				RCView::div(array('id'=>'folders', 'style'=>'width:97%; height:320px; overflow-x:auto;'), '&nbsp;')
			)
		);

		$checkbox_array = array('id'=>'hide_assigned', 'onclick'=>'hideAssigned();');
		if(isset($_SESSION['hide_assigned']) && $_SESSION['hide_assigned'] == 1)
		{
			$checkbox_array['checked'] = 'checked';
		}

		$checkbox_archived_array = array('id'=>'hide_archived', 'onclick'=>'hideAssigned();');
		if(!isset($_SESSION['hide_archived']) || (isset($_SESSION['hide_archived']) && $_SESSION['hide_archived'] == 1))
		{
			$checkbox_archived_array['checked'] = 'checked';
		}

		$popup_content_right_td = RCView::td(array('style'=>'vertical-align:top'),
			RCView::div(array('class'=>'addFieldMatrixRowHdr', 'style'=>'float:left; margin-left:25px;width:440px;'),
				RCView::table(array('class'=>'form_border', 'style'=>'width:97%;'),
					RCView::tr(array(),
						RCView::td(array('class'=>'labelrc create_rprt_hdr', 'colspan'=>3, 'style'=>'padding:0;background:#fff;border:0;'),
							RCView::div(array('style'=>'position:relative;top:13px;background-color:#ddd;border:1px solid #ccc;border-bottom:1px solid #ddd;float:left;padding:8px 8px;'),
								$lang['folders_27']
							)
						)
					  ) .
					  RCView::tr(array(),
						RCView::td(array('class'=>'labelrc create_rprt_hdr', 'colspan'=>3, 'style'=>'padding:5px;'),
							// Project drop-down list
							RCView::table(array(),
								RCView::tr(array(),
									RCView::td(array('style'=>'padding-right:15px;'), RCView::div(array('id'=>'select_folders'), '&nbsp;')) .
									RCView::td(array('class'=>'nowrap', 'style'=>'padding-top:7px'),
										RCView::checkbox($checkbox_array) .
										RCView::span(array('style'=>'font-size:11px; color:#000;font-weight:normal;'), $lang['folders_19']) .
										RCView::br() .
										RCView::checkbox($checkbox_archived_array) .
										RCView::span(array('style'=>'font-size:11px; color:#000;font-weight:normal;'), $lang['home_11'])
									)
								)
							)
						)
					  )
				) .
				// List of projects
				RCView::div(array('id'=>'projects', 'style'=>'width:97%; height:320px; overflow-x:auto;'), '&nbsp;')
			)
		);

		$popup_content = RCView::div(array('style'=>''),
							$lang['folders_26']
						) .
						RCView::table(array(),
							RCView::tr(array(), $popup_content_left_td . $popup_content_right_td)
						);
		?>

		<style type="text/css">
		.pnpimg { vertical-align:middle;margin-left:10px;position:relative;top:-2px; }
		</style>
		<link rel='stylesheet' href='<?php echo APP_PATH_CSS ?>spectrum.css' />
		<script type="text/javascript" src='<?php echo APP_PATH_JS ?>spectrum.js'></script>
		<script type="text/javascript" src='<?php echo APP_PATH_JS ?>ProjectFolders.js'></script>
		<script type="text/javascript">
		// Set var for all pid's listed on the page
		var visiblePids = '<?php echo implode(",", $all_proj_ids) ?>';
		var langDelFolder = '<?php echo cleanHtml($lang['folders_16']); ?>';
		var langProjFolder01 = '<?php echo cleanHtml($lang['folders_20']); ?>';
		var langProjFolder02 = '<?php echo cleanHtml($popup_content); ?>';
		var langProjFolder03 = '<?php echo cleanHtml($lang['folders_23']); ?>';
		var langProjFolder04 = '<?php echo cleanHtml($lang['global_53']); ?>';
		var langProjFolder05 = '<?php echo cleanHtml($lang['folders_14']); ?>';
		// Remove extraneous table rows
		function removeExtraRows() {
			// Remove project folder rows
			$('#table-proj_table tr[id^=fold]').remove();
			$('#table-proj_table td').css('background','#f7f7f7');
			// Remove duplicate project rows
			var ps_ids = new Array();var i=0;
			$('#table-proj_table tr').each(function(){
				var ps_id = $(this).attr('ps_id');
				if (ps_id != null) {
					if (in_array(ps_id, ps_ids)) {
						$(this).remove();
					} else {
						ps_ids[i++] = ps_id;
					}
				}
			});
		}
		$(function(){
			$('#proj_table .hDiv table th:eq(0)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',0,'string');
			});
			$('#proj_table .hDiv table th:eq(1)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',1,'int');
			});
			$('#proj_table .hDiv table th:eq(2)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',2,'int');
			});
			$('#proj_table .hDiv table th:eq(3)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',3,'int');
			});
			$('#proj_table .hDiv table th:eq(4)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',4,'string');
			});
			$('#proj_table .hDiv table th:eq(5)').click(function(){
				removeExtraRows();
				SortTable('table-proj_table',5,'string');
			});
		});
		</script>
		<?php

		// Display table
		self::renderProjectsGrid("proj_table", $tableTitle, 'auto', 'auto', $col_widths_headers, $row_data);

		// Hidden tooltip div for Project Notes
		print RCView::div(array('class'=>'tooltip4', 'id'=>'pntooltip'), '');

		//Display any Public projects (using "none" auth) if flag is set in config table
		if ($display_nonauth_projects && $auth_meth_global != "none" && !$isControlCenter) {

			// Get all public dbs that the user does not already have access to (to prevent duplication in lists)
			$sql = "select project_id, project_name, app_title from redcap_projects where auth_meth = 'none'
					and status in (1, 0) and project_id not in
					(0,".pre_query("select project_id from redcap_user_rights where username = '" . prep(defined('USERID') ? USERID : '') . "'").")
					order by trim(app_title)";
			$q = db_query($sql, $rc_connection);

			// Only show this section if at least one public project exists
			if (db_num_rows($q) > 0)
			{
				print  "<div class='hidden-xs'>";
				print  "<p style='margin-top:40px;'>{$lang['home_34']}";
				//Give extra note to super user
				if (defined('SUPER_USER') ? SUPER_USER : '') {
					print  "<i>{$lang['home_35']}</i>";
				}
				print  "</p>";

				$pubList = array();
				while ($attr = db_fetch_assoc($q)) {
					//Title
					$pubList[] = array('<a title="'.htmlspecialchars(cleanHtml2($lang['control_center_432']), ENT_QUOTES).'" href="' . APP_PATH_WEBROOT . 'index.php?pid=' . $attr['project_id'] . '" class="aGrid">'.RCView::escape($attr['app_title']).'</a>');
				}

				$col_widths_headers = array(
										array(840, "<b>{$lang['home_36']}</b>")
									);
				renderGrid("proj_table_pub", "", 850, 'auto', $col_widths_headers, $pubList);
				print "</div>";
			}

		}

	}


	static function renderProjectsGrid($id, $title, $width_px='auto', $height_px='auto', $col_widths_headers=array(), &$row_data=array(), $show_headers=true, $enable_header_sort=false, $outputToPage=true)
	{
		global $lang;
		## SETTINGS
		// $col_widths_headers = array(  array($width_px, $header_text, $alignment, $data_type), ... );
		// $data_type = 'string','int','date'
		// $row_data = array(  array($col1, $col2, ...), ... );

		$collapse_ids = array();

		// Are we viewing the list from the Control Center?
		$isControlCenter = (strpos(PAGE_FULL, "/ControlCenter/") !== false);

		// Set dimensions and settings
		$width = is_numeric($width_px) ? "width: " . $width_px . "px;" : "width: 100%;";
		$height = ($height_px == 'auto') ? "" : "height: " . $height_px . "px; overflow-y: auto;";
		if (trim($id) == "") {
			$id = substr(md5(rand()), 0, 8);
		}
		$table_id_js = "table-$id";
		$table_id = "id=\"$table_id_js\"";
		$id = "id=\"$id\"";

		// Check column values
		$row_settings = array();
		foreach ($col_widths_headers as $this_key=>$this_col)
		{
			$this_width  = is_numeric($this_col[0]) ? $this_col[0] . "px" : "100%";
			$this_header = $this_col[1];
			$this_align  = isset($this_col[2]) ? $this_col[2] : "left";
			$this_type   = isset($this_col[3]) ? $this_col[3] : "string";

			// Re-assign checked values
			$col_widths_headers[$this_key] = array($this_width, $this_header, $this_align, $this_type);

			// Add width and alignment to other array (used when looping through each row)
			$row_settings[] = array('width'=>$this_width, 'align'=>$this_align);
		}

		// Render grid
		$grid = '<div class="flexigrid hidden-xs" ' . $id . ' style="' . $width . $height .'"><div class="mDiv"><div class="ftitle" ' . ((trim($title) != '') ? '' : 'style="display:none;"') . '>' . $title . '</div></div><div class="hDiv"' . ($show_headers ? '' : 'style="display:none;"') . '><div><table cellspacing="0"><tr>';
		$gridMobile =  '<div class="hideIE8 list-group hidden-sm hidden-md hidden-lg" style="margin-top:60px;">
							<a href="#" class="list-group-item" style="font-size:15px;font-weight:bold;background-color:#D7D7D7;border-color:#ccc;color:#000;">'.($isControlCenter ? $lang['control_center_134'] : $lang['home_22']).'</a>';

		foreach ($col_widths_headers as $col_key=>$this_col)
		{
			$grid .= '<th' . ($this_col[2] == 'left' ? '' : ' align="' . $this_col[2] . '"') . '><div style="' . ($this_col[2] == 'left' ? '' : 'text-align:'.$this_col[2] . ';') . 'width:' . $this_col[0] . ';">' . $this_col[1] . '</div></th>';
		}

		$grid .= '</tr></table></div></div><div class="bDiv"><table ' . $table_id . ' style="width:100%;" cellspacing="0">';

		$expand = RCView::img(array('src'=>'toggle-expand.png'));
		$collapse = RCView::img(array('src'=>'toggle-collapse.png'));
		$unorg_icon = RCView::img(array('src'=>'folder-grey.png', 'class'=>'opacity50'));

		// gather collapsed folder ids
		foreach ($row_data as $row_key => $this_row)
		{
			if(count($this_row) == 4 && $this_row[2] == 1)
			{
				$collapse_ids[] = $this_row[0];
			}
		}

		$user = User::getUserInfo(USERID);
		$user_folder_count = count(ProjectFolders::getAll($user));

		$project_bg = '';
		$row_class = 'myprojstripe';

		$dom = new DOMDocument;

		$in_folders = false;
		$i = 0;

		foreach ($row_data as $row_key => $this_row)
		{
			$count = count($this_row);

			// folder
			if($count == 4)
			{
				$folder_id = $this_row[0];

				// hide unorganized '0' folder if no other folders
				if($folder_id == 0 && $user_folder_count == 0)
				{
					continue;
				}

				$in_folders = true;
				$project_bg = RenderProjectList::projectBGStyle($this_row[3][2], 0.2);
				$ps_id = substr(md5($this_row[0]), 0, 8);

				$grid .= "<tr ps_id='$ps_id' class='nohover' id='fold_$folder_id' style='".($folder_id == '0' ? "" : "cursor:pointer;")."color:#" . $this_row[3][0] . ';' . $this_row[3][1] . "'>"
					   . "<td onclick='toggleFolderCollapse($folder_id);' colspan='6' class='fldrrwparent' style='" . $this_row[3][1] . "'>";

				$foldIcon = "<span class='fldrrwtoggle' id='fold_$folder_id'>";
				$foldIconM = "<span class='fldrrwtogglem' id='foldm_$folder_id'>";
				if (in_array($folder_id, $collapse_ids)) {
					$foldIcon .= "<span id='col_$folder_id' style='display:none'>$collapse</span><span id='exp_$folder_id'>$expand</span>";
					$foldIconM .= "<span id='colm_$folder_id' style='display:none'>$collapse</span><span id='expm_$folder_id'>$expand</span>";
				} else {
					$foldIcon .= "<span id='col_$folder_id'>".($folder_id == '0' ? $unorg_icon : $collapse)."</span><span id='exp_$folder_id' style='display:none'>$expand</span>";
					$foldIconM .= "<span id='colm_$folder_id'>".($folder_id == '0' ? $unorg_icon : $collapse)."</span><span id='expm_$folder_id' style='display:none'>$expand</span>";
				}
				$foldIcon .= "</span>";
				$foldIconM .= "</span>";

				$grid .= $foldIcon . "<div class='fldrrw'>{$this_row[1]}</div></td></tr>";

				$gridMobile .= '<a href="javascript:;" onclick="toggleFolderCollapse('.$folder_id.');" class="list-group-item" style="font-weight:bold;'.($folder_id == '0' ? "" : "cursor:pointer;")."color:#" . $this_row[3][0] . ';' . $this_row[3][1] . '">
									' . $foldIconM . $this_row[1] . '
								</a>';
			}

			// project
			if($count == 6)
			{
				// hide tr AND ignore quicksearch uncollapsing with custom 'qs' attribute
				$isCollapsed = in_array($folder_id, $collapse_ids);
				$hide = $isCollapsed ?  "ps='collapsed'" : "ps='expanded'";
				$row_style = $isCollapsed ?  "display:none;" : "";
				$ps_id = substr(md5($this_row[0]), 0, 8);
				$row_class = ($folder_id == '0' && $row_class == 'myprojstripe') ? "" : "myprojstripe";
				$rowId = "f_" . $folder_id . '_' . $row_key;
				$rowIdM = "fm_" . $folder_id . '_' . $row_key;

				$grid .= "<tr ps_id='" . $ps_id . "' class='$row_class' {$hide} style='$row_style' id='$rowId'>";

				// Extra link href from HTML link
				if (function_exists('mb_convert_encoding')) {
					$this_row[0] = mb_convert_encoding($this_row[0], 'HTML-ENTITIES', 'UTF-8');
				}
				$dom->loadHTML($this_row[0]);					
				$projectName = "";
				foreach ($dom->getElementsByTagName('a') as $node) {
					// Find the HREF and link label from the HTML in the row
					foreach ($node->getElementsByTagName('div') as $node2) {
						$node2->parentNode->removeChild($node2);
					}
					$projectName = $node->nodeValue;
					break;
				}
				if (!empty($this_row[4])) {
					$borderColor = $folder_id > 0 ? "border-color:#fff;" : "";
					$gridMobile .= '<a href="'.$node->getAttribute('href').'" id="'.$rowId.'" class="list-group-item myprojmitem '.$row_class.'" style="'.$row_style.$borderColor.$project_bg.'">
										'.strip_tags($projectName).'
										<span style="float:right;padding:0 3px;">'.$this_row[5].'</span>
										<span style="float:right;padding:0 3px;">'.$this_row[4].'</span>
									</a>';
					$i++;
				} else {
					$gridMobile .= '<a href="#" class="list-group-item myprojmitem" style="color:#777;">
										'.strip_tags($this_row[0]).'
									</a>';
				}

				foreach ($this_row as $col_key => $this_col)
				{
					$grid .= "<td style='$project_bg'" . ($row_settings[$col_key]['align'] == 'left' ? '' : ' align="' . $row_settings[$col_key]['align'] . '"') . '><div ';

					if ($row_settings[$col_key]['align'] == 'center')
					{
						$grid .= 'class="fc" ';
					}
					elseif ($row_settings[$col_key]['align'] == 'right')
					{
						$grid .= 'class="fr" ';
					}

					// remove 'px'
					$width = substr($row_settings[$col_key]['width'], 0, -2);

					$pad_left = 10;

					// adjustments for projects in folders
					if($in_folders && !$col_key)
					{
						$width -= 20;
						$pad_left += 20;
					}

					$grid .= 'style="width:' . $width . 'px; padding-left:' . $pad_left . 'px;">' . $this_col . '</div></td>';
				}

				$grid .= '</tr>';
			}

			// Delete last row to clear up memory as we go
			unset($row_data[$row_key]);
		}

		$grid .= '</table></div></div>';
		$gridMobile .= '</div>';

		// Render grid (or return as html string)
		if ($outputToPage)
		{
			print $grid . $gridMobile;
		}
		else
		{
			return $grid . $gridMobile;
		}
	}
}
