<?php

class ProjectFolders
{
	const FOLDER_GRADIENT = 0.9;

	static function grouped($folders, $count)
	{
		return array_chunk($folders, $count, true);
	}

	// handle jQuery drag and drop sort output
	static function reSort($user, $data)
	{
		$ids = str_replace('&', ',', str_replace('f[]=', '', $data));

		$sql = "
		  SELECT folder_id
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  ORDER BY FIELD(folder_id, $ids)
		";

		$query = db_query($sql);

		if($query !== false)
		{
			$position = 0;

			while($row = db_fetch_assoc($query))
			{
				$sql = "
				  UPDATE redcap_folders
				  SET position = $position
				  WHERE ui_id = {$user['ui_id']}
				  AND folder_id = {$row[folder_id]}
				";

				db_query($sql);

				++$position;
			}
		}
	}

	// toggle folder collapse/expand status
	static function toggleFolderCollapse($user, $folder_id)
	{
		$sql = "
		  SELECT collapsed
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = '$folder_id'
		";

		$query = db_query($sql);

		if($query !== false)
		{
			$row = db_fetch_assoc($query);
			$collapsed = $row['collapsed'] == 1 ? 0 : 1;

			$sql = "
			  UPDATE redcap_folders
			  SET collapsed = $collapsed
			  WHERE ui_id = {$user['ui_id']}
			  AND folder_id = $folder_id
			";

			db_query($sql);
		}
	}

	// get project ids
	static function projectIDs($projects)
	{
		$ids = array();

		if(ProjectFolders::inFolders($projects))
		{
			foreach($projects as $f)
			{
				foreach($f['projects'] as $p)
				{
					$ids[] = $p['project_id'];
				}
			}

			return $ids;
		}

		foreach($projects as $p)
		{
			$ids[] = $p['project_id'];
		}

		return $ids;
	}

	// test if $projects are in folders
	static function inFolders($projects)
	{
		if(empty($projects))
		{
			return false;
		}

		// because $projects indexes are folder ids
		$keys = array_keys($projects);

		// check for a folder name
		return isset($projects[$keys[0]]['name']);
	}

	// get folders for projects
	static function forProjects($user, $projects)
	{
		// gather project ids to query by
		$projects_ids = array();
		foreach($projects as $p)
		{
			$project_ids[] = $p['project_id'];
		}
		$project_ids = implode(',', $project_ids);

		$folders = array();

		if(count($project_ids))
		{
			$sql = "
			  SELECT
				f.folder_id,
				f.name,
				f.collapsed,
				f.foreground,
				f.background,
				pf.project_id
			  FROM redcap_folders_projects pf
			  LEFT JOIN redcap_folders f
			  ON pf.folder_id = f.folder_id
			  WHERE f.ui_id = {$user['ui_id']}
			  AND pf.project_id IN ($project_ids)
			  ORDER BY f.position, f.name, pf.project_id
			";

			$query = db_query($sql);

			if($query !== false)
			{
				while($row = db_fetch_assoc($query))
				{
					$folders[] = $row;
				}
			}
		}

		return $folders;
	}

	// put projects into folders
	static function projectsInFolders($user, $projects)
	{
		global $lang;

		$folders = ProjectFolders::forProjects($user, $projects);
		$unfoldered = array_keys($projects);

		$a = array();

		// remove foldered projects from unfoldered
		foreach($folders as $f)
		{
			foreach($projects as $k => $p)
			{
				if($f['project_id'] == $p['project_id'])
				{
					$key = array_search($k, $unfoldered);
					if($key !== false)
					{
						unset($unfoldered[$key]);
					}
				}
			}
		}

		// put unfoldered projects into $a first
		if(count($unfoldered))
		{
			$a[0] = array(
				'name'       => $lang['folders_21'],
				'collapsed'  => 0,
				'foreground' => '000000',
				'background' => 'eeeeee',
				'projects'   => array()
			);

			foreach($unfoldered as $k)
			{
				$a[0]['projects'][$k] = $projects[$k];
			}
		}

		// place foldered projects into folders last
		foreach($folders as $f)
		{
			// add folder to $a if not present
			if(!isset($a[$f['folder_id']]))
			{
				$a[$f['folder_id']] = array(
					'name'       => $f['name'],
					'collapsed'  => $f['collapsed'],
					'foreground' => $f['foreground'],
					'background' => $f['background'],
					'projects'   => array()
				);
			}

			// put projects into their correct folders
			foreach($projects as $k => $p)
			{
				if($f['project_id'] == $p['project_id'])
				{
					$a[$f['folder_id']]['projects'][$k] = $p;
				}
			}
		}

		return $a;
	}

	// copy folder assignments from old project to new project
	static function copyProjectFolders($user, $project_id, $new_project_id)
	{
		$sql = "
		  SELECT folder_id
		  FROM redcap_folders_projects
		  WHERE ui_id = {$user['ui_id']}
		  AND project_id = $project_id
		";

		$query = db_query($sql);

		if($query !== false)
		{
			while($row = db_fetch_assoc($query))
			{
				ProjectFolders::createProjectFolder($user, $row['folder_id'], $new_project_id);
			}
		}
	}

	// save folder assignments for a new project
	static function addNewProjectFolders($user, $project_id, $post)
	{
		$folder_ids = isset($post['folder_ids']) ? $post['folder_ids'] : array();

		foreach($folder_ids as $folder_id)
		{
			ProjectFolders::createProjectFolder($user, $folder_id, $project_id);
		}
	}

	// save modified folder
	static function update($user, $folder_id, $name, $fg, $bg)
	{
		$sql = "
		  UPDATE redcap_folders
		  SET
			name = '".prep($name)."',
			foreground = '$fg',
			background = '$bg'
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = $folder_id
		";

		db_query($sql);
	}

	// remove project folder assignment
	static function deleteProjectFolder($user, $folder_id, $project_id)
	{
		$sql = "
		  DELETE FROM redcap_folders_projects
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = $folder_id
		  AND project_id = $project_id
		";

		db_query($sql);
	}

	// save a project folder assignment
	static function createProjectFolder($user, $folder_id, $project_id)
	{
		$sql = "
		  INSERT INTO redcap_folders_projects (
			ui_id, folder_id, project_id
		  ) VALUES (
			{$user['ui_id']}, $folder_id, $project_id
		  )
		";

		db_query($sql);
	}

	// check if a project folder assignment exists
	static function projectFolderExists($user, $folder_id, $project_id)
	{
		$sql = "
		  SELECT folder_id
		  FROM redcap_folders_projects
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = $folder_id
		  AND project_id = $project_id
		";

		$query = db_query($sql);

		if($query !== false)
		{
			return (db_num_rows($query) > 0);
		}

		return false;
	}

	// get all project folder assignments for a user
	static function allProjectFolders($user)
	{
		$all = array();

		$sql = "
		  SELECT
			project_id,
			folder_id
		  FROM redcap_folders_projects
		  WHERE ui_id = {$user['ui_id']}
		";

		$query = db_query($sql);

		if($query !== false)
		{
			while($row = db_fetch_assoc($query))
			{
				$all[$row['project_id']] = $row['folder_id'];
			}
		}

		return $all;
	}

	// toggle a project folder assignment
	static function toggleProjectFolder($user, $folder_id, $project_id)
	{
		if(ProjectFolders::projectFolderExists($user, $folder_id, $project_id))
		{
			ProjectFolders::deleteProjectFolder($user, $folder_id, $project_id);
			return 0;
		}
		else
		{
			ProjectFolders::createProjectFolder($user, $folder_id, $project_id);
			return 1;
		}
	}

	// get user projects, assigned to folders and not
	static function getProjects($user, $folder_id)
	{
		$all_project_folders = ProjectFolders::allProjectFolders($user);
		$hide_assigned = (isset($_SESSION['hide_assigned']) && $_SESSION['hide_assigned'] == 1);
		$hide_archived = (!isset($_SESSION['hide_archived']) || (isset($_SESSION['hide_archived']) && $_SESSION['hide_archived'] == 1));
		$projects = array();

		// get projects assigned to $folder_id
		$sql = "
		  SELECT
			pf.project_id,
			pf.folder_id,
			p.app_title,
			p.status
		  FROM redcap_folders_projects pf
		  LEFT JOIN redcap_projects p
		  ON pf.project_id = p.project_id
		  WHERE pf.ui_id = {$user['ui_id']}
		  AND pf.folder_id = $folder_id
		  AND p.date_deleted IS NULL
		  ORDER BY p.project_id
		";

		$query = db_query($sql);

		if($query !== false)
		{
			while($row = db_fetch_assoc($query))
			{
				$projects[$row['project_id']] = array(
					'folder_id' => $row['folder_id'],
					'name'      => strip_tags(label_decode($row['app_title'])),
					'status'    => $row['status']
				);
			}
		}

		// get remaining projects
		$sql = "
		  SELECT
			p.project_id,
			p.app_title,
			p.status
		  FROM
			redcap_user_rights u,
			redcap_projects p
		  WHERE u.project_id = p.project_id
		  AND u.username = '".prep(USERID)."'
		  AND p.date_deleted IS NULL
		  ORDER BY p.project_id
		";

		$query = db_query($sql);

		if($query !== false)
		{
			while($row = db_fetch_assoc($query))
			{
				// skip projects already in array
				if(isset($projects[$row['project_id']]))
				{
					continue;
				}

				// skip projects assigned to other folders
				if($hide_assigned && isset($all_project_folders[$row['project_id']]))
				{
					continue;
				}

				// skip projects that are in archived status
				if($hide_archived && $row['status'] == 3)
				{
					continue;
				}

				$projects[$row['project_id']] = array(
					'folder_id' => 0,
					'name'      => strip_tags(label_decode($row['app_title'])),
					'status'    => $row['status']
				);
			}
		}

		return $projects;
	}

	// delete a folder
	static function delete($user, $id)
	{
		// clear project folder assignments first
		$sql = "
		  DELETE FROM redcap_folders_projects
		  WHERE folder_id = $id
		";

		db_query($sql);

		$sql = "
		  DELETE FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = $id
		";

		db_query($sql);
	}

	// check if a user folder exists
	static function alreadyExists($user, $name)
	{
		$sql = "
		  SELECT folder_id
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  AND name = '".prep($name)."'
		";

		$query = db_query($sql);

		if($query !== false)
		{
			return (db_num_rows($query) > 0);
		}

		return false;
	}

	static function nextPosition($user)
	{
		$sql = "
		  SELECT position
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  ORDER BY position DESC
		  LIMIT 1
		";

		$query = db_query($sql);

		if($query !== false)
		{
			$row = db_fetch_assoc($query);
			return $row['position'] + 1;
		}
	}

	// create new user folder
	static function create($user, $name)
	{
		$position = ProjectFolders::nextPosition($user);

		$sql = "
		  INSERT INTO redcap_folders (
			ui_id, name, position, foreground, background, collapsed
		  ) VALUES (
			{$user['ui_id']}, '".prep($name)."', $position, '000000', 'ffffff', 0
		  )
		";

		$query = db_query($sql);

		if($query !== false)
		{
			return db_insert_id();
		}

		return 0;
	}

	// get all folders for a user
	static function getAll($user)
	{
		$folders = array();

		$sql = "
		  SELECT *
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  ORDER BY position, name
		";

		$query = db_query($sql);

		if($query !== false)
		{
			while($row = db_fetch_assoc($query))
			{
				$folders[] = $row;
			}
		}

		return $folders;
	}

	// get a user folder by folder_id
	static function get($user, $folder_id)
	{
		$sql = "
		  SELECT *
		  FROM redcap_folders
		  WHERE ui_id = {$user['ui_id']}
		  AND folder_id = $folder_id
		";

		$query = db_query($sql);

		if($query !== false)
		{
			return db_fetch_assoc($query);
		}

		return null;
	}

	// render folders array into html table rows
	static function toTRs($folders)
	{
		global $lang;

		$html = '';
		$edit   = RCView::img(array('src'=>'pencil.png', 'style'=>'vertical-align:middle;padding:3px;'));
		$delete = RCView::img(array('src'=>'cross.png', 'style'=>'vertical-align:middle;'));
		foreach($folders as $f)
		{
			// escape single quotes for JS output
			$name = str_replace("'", '&#39;', $f['name']);

			$bg2 = RenderProjectList::bgColor($f['background'], ProjectFolders::FOLDER_GRADIENT);
			$background = RenderProjectList::bgGradientStyles($f['background'], $bg2);

			$td1 = RCView::td(array(
				'class'       => 'data',
				'style'       => "font-size:12px; padding:3px 0 3px 4px; width:330px; color:#{$f['foreground']}; $background",
				'onmouseover' => "this.style.cursor='move'"
			), $name);

			$a2 = RCview::a(array(
				'title'   => $lang['folders_22'],
				'href'    => 'javascript:;',
				'onclick' => "editFolder({$f['folder_id']});"
			), $edit);
			$td2 = RCView::td(array('style'=>'text-align:center;width:20px;', 'class'=>'data'), $a2);

			$a3 = RCview::a(array(
				'title'   => $lang['folders_23'],
				'href'    => 'javascript:;',
				'onclick' => "deleteFolder({$f['folder_id']},1);"
			), $delete);
			$td3 = RCView::td(array('style'=>'text-align:center;width:20px;', 'class'=>'data'), $a3);

			$html .= RCView::tr(array('id'=>"f_{$f['folder_id']}"), $td1 . $td2 . $td3);
		}

		return $html;
	}

	// render projects into html checkbox table rows
	static function toCheckboxTRs($projects)
	{
		global $lang;
		$html = '';

		foreach($projects as $project_id => $p)
		{
			// escape single quotes for JS output
			$name = str_replace("'", '&#39;', $p['name']);

			$params = array(
				'type'    => 'checkbox',
				'id'      => "pid_$project_id",
				'onclick' => "tglFld($project_id);",
			);

			if($p['folder_id'] > 0)
			{
				$params['checked'] = 'checked';
			}


			// If typical project, display icon based upon status value
			switch($p['status'])
			{
				case 0: // Development
					$iconstatus = '<span class="glyphicon glyphicon-wrench" style="color:#444;" aria-hidden="true" title="' . cleanHtml2($lang['global_29']) . '"></span>';
					break;
				case 1: // Production
					$iconstatus = '<span class="glyphicon glyphicon-check" style="color:#00A000;" aria-hidden="true" title="' . cleanHtml2($lang['global_30']) . '"></span>';
					break;
				case 2: // Inactive
					$iconstatus = '<span class="glyphicon glyphicon-minus-sign" style="color:#800000;" aria-hidden="true" title="' . cleanHtml2($lang['global_31']) . '"></span>';
					break;
				case 3: // Archived
					$iconstatus = '<span class="glyphicon glyphicon-trash" aria-hidden="true" title="' . cleanHtml2($lang['global_26']) . '"></span>';
					break;
			}

			$td1 = RCView::td(array('class'=>'data fldrplist1', 'valign'=>'top'), RCView::input($params));
			$td2 = RCview::td(array('class'=>'data fldrplist2'),
					$iconstatus.RCView::span(array('style'=>'vertical-align:middle;padding-left:6px;'), $name) .
					RCView::div(array(
						'id'=>"proj_saved_$project_id",
						'class'=>'fldrsvsts'
					), $lang['design_243'])
				   );
			$html .= RCView::tr(array('id'=>"proj_tr_$project_id"), $td1 . $td2);
		}

		return $html;
	}

	// tranform folders array into html select options array
	static function forSelectOpts($folders)
	{
		global $lang;

		$opts = array('' => "--- {$lang[folders_24]} ---");

		foreach($folders as $f)
		{
			$opts[$f['folder_id']] = $f['name'];
		}

		return $opts;
	}
}
