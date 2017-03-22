<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/




/**
 * RENDER TABS
 */
$projectSetupTabs = array();
$projectSetupTabs["index.php"] = array("glyphicon"=>"home", "label"=>$lang['bottom_44']);
$projectSetupTabs["ProjectSetup/index.php"] = array("icon"=>"checklist_flat.png", "label"=>$lang['app_17']);
// Page-sensitive tabs that appear
if (PAGE == "UserRights/index.php" || PAGE == "DataAccessGroups/index.php")
{
	if ($user_rights['user_rights']) {
		$projectSetupTabs["UserRights/index.php"] = array("icon"=>"user.png", "label"=>$lang['app_05']);
	}
	//
	if ($user_rights['data_access_groups']) {
		$projectSetupTabs["DataAccessGroups/index.php"] = array("icon"=>"group.png", "label"=>$lang['global_22']);
	}
}
elseif (PAGE == "Surveys/edit_info.php" || PAGE == "Surveys/create_survey.php")
{
	$projectSetupTabs["Design/online_designer.php"] = array("icon"=>"blog_pencil.png", "label"=>$lang['design_25']);
	if (PAGE == "Surveys/edit_info.php") {
		$projectSetupTabs[PAGE] = array("icon"=>"pencil.png", "label"=>$lang['setup_05']);
	} else {
		$projectSetupTabs[PAGE] = array("icon"=>"add.png", "label"=>$lang['setup_06']);
	}
}
elseif (PAGE == "ProjectGeneral/edit_project_settings.php")
{
	$projectSetupTabs["ProjectGeneral/edit_project_settings.php"] = array("icon"=>"pencil.png", "label"=>$lang['edit_project_38']);
}
elseif (PAGE == "Design/data_dictionary_codebook.php") {
	$projectSetupTabs["Design/data_dictionary_codebook.php"] = array("icon"=>"codebook.png", "label"=>$lang['design_482']);
}
elseif (PAGE == "Design/online_designer.php" || PAGE == "Design/data_dictionary_upload.php" || PAGE == "SharedLibrary/index.php") {
	$projectSetupTabs["Design/online_designer.php"] = array("icon"=>"blog_pencil.png", "label"=>$lang['design_25']);
	$projectSetupTabs["Design/data_dictionary_upload.php"] = array("icon"=>"xlsup.gif", "label"=>$lang['global_09']);
	if ($shared_library_enabled && PAGE == "SharedLibrary/index.php") {
		$projectSetupTabs["SharedLibrary/index.php"] = array("icon"=>"blogs_arrow.png", "label"=>$lang['design_37']);
	}
}
elseif (PAGE == "ExternalLinks/index.php") {
	$projectSetupTabs["ExternalLinks/index.php"] = array("icon"=>"chain_arrow.png", "label"=>$lang['app_19']);
}
// Default tabs
else {
	if ($user_rights['design']) {
		$projectSetupTabs["ProjectSetup/other_functionality.php"] = array("glyphicon"=>"book", "label"=>$lang['setup_68']);
		$projectSetupTabs["ProjectSetup/project_revision_history.php"] = array("icon"=>"history_back.png", "label"=>$lang['app_18']);
	}
}


// Display any warnings for Index or Setup pages
if (PAGE == "index.php" || PAGE == "ProjectSetup/index.php" || PAGE == "ProjectSetup/other_functionality.php")
{
	//Custom index page header note
	if (trim($custom_index_page_note) != '') {
		print "<div class='green notranslate' style='font-size:11px;'>" . nl2br($custom_index_page_note) . "</div>";
	}

	//If system is offline, give message to super users that system is currently offline
	if ($system_offline && $super_user)
	{
		print  "<div class='red'>
					{$lang['index_38']}
					<a href='".APP_PATH_WEBROOT."ControlCenter/general_settings.php'
						style='text-decoration:underline;font-family:verdana;'>{$lang['global_07']}</a>".$lang['period']."
				</div>";
	}

	//If project is offline, give message to super users that project is currently offline
	if (!$online_offline && $super_user) {
		print  "<div class='red'>
					{$lang['index_48']}
					<a href='".APP_PATH_WEBROOT."ControlCenter/edit_project.php?project=$project_id'
						style='text-decoration:underline;font-family:verdana;'>{$lang['global_07']}</a>".$lang['period']."
				</div>";
	}

	// Give warning if beginning survey is used with DDE enabled
	if ($double_data_entry && isset($Proj->forms[$Proj->firstForm]['survey_id']))
	{
		print  "<div class='red'>
					<b>{$lang['global_01']}{$lang['colon']}</b><br>
					{$lang['index_71']}
				</div>";
	}

}


// Display the "Edit project settings link"?
$showEditProjSettings = (SUPER_USER && in_array(PAGE, array('index.php', 'ProjectSetup/index.php', 'ProjectSetup/other_functionality.php', 'ProjectSetup/project_revision_history.php')));

?>
<div id="sub-nav" class="project_setup_tabs hidden-xs">
	<ul>
		<?php foreach ($projectSetupTabs as $this_url=>$this_set) { ?>
		<li <?php if ($this_url == PAGE) echo 'class="active"'?>>
			<a href="<?php echo APP_PATH_WEBROOT . $this_url . "?pid=" . PROJECT_ID ?>" style="font-size:13px;color:#393733;padding:7px 9px;">
				<?php if (isset($this_set['glyphicon'])) { ?>
					<span class="glyphicon glyphicon-<?php echo $this_set['glyphicon'] ?>" aria-hidden="true"></span> 
				<?php } elseif (empty($this_set['icon'])) { ?>
					<img src="<?php echo APP_PATH_IMAGES ?>spacer.gif" style="height:16px;width:1px;">
				<?php } else { ?>
					<img src="<?php echo APP_PATH_IMAGES . $this_set['icon'] ?>" style="height:16px;width:16px;">
				<?php } ?>
				<?php echo $this_set['label'] ?>
			</a>
		</li>
		<?php } ?>
		<?php if ($showEditProjSettings) { ?>
		<li class="hidden-sm hidden-md"style="background-image:none;border:0;">
			<a href="<?php echo APP_PATH_WEBROOT . "ControlCenter/edit_project.php?project=" . PROJECT_ID ?>" style="border:0;background-image:none;font-weight:normal;font-size:11px;text-decoration:underline;color:#000066;padding:8px 9px 2px 12px;">
				<span class="glyphicon glyphicon-cog" aria-hidden="true" style="margin-right:2px;"></span><?php print $lang['project_settings_49'] ?></a>
		</li>
		<?php } ?>
	</ul>
</div>

<div style="clear:both;"></div>
<div class="btn-group hidden-sm hidden-md hidden-lg" style="margin-bottom:10px;">
	<button type="button" class="btn btn-defaultrc dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php
		foreach ($projectSetupTabs as $this_url=>$this_set) {
			if ($this_url != PAGE) continue;
			if (isset($this_set['glyphicon'])) {
				print '<span class="glyphicon glyphicon-'.$this_set['glyphicon'].'" aria-hidden="true"></span> ' . $this_set['label'];
			} else {
				print '<img src="'. APP_PATH_IMAGES . $this_set['icon'] .'" style="height:16px;width:16px;"> ' . $this_set['label'];
			}
		}
		?>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li style="background-image:none;border:0;">
			<a href="<?php echo APP_PATH_WEBROOT_PARENT ?>index.php?action=myprojects" style="font-size:15px;color:#393733;padding:7px 9px;">
				<span class='glyphicon glyphicon-list-alt' style='text-indent:0;' aria-hidden='true'></span> <?php print $lang['bottom_03'] ?></a>
		</li>
		<?php foreach ($projectSetupTabs as $this_url=>$this_set) { ?>
		<li>
			<a href="<?php echo APP_PATH_WEBROOT . $this_url . "?pid=" . PROJECT_ID ?>" style="font-size:15px;color:#393733;padding:7px 9px;">
				<?php if (isset($this_set['glyphicon'])) { ?>
					<span class="glyphicon glyphicon-<?php echo $this_set['glyphicon'] ?>" aria-hidden="true"></span> 
				<?php } elseif (empty($this_set['icon'])) { ?>
					<img src="<?php echo APP_PATH_IMAGES ?>spacer.gif" style="height:16px;width:1px;">
				<?php } else { ?>
					<img src="<?php echo APP_PATH_IMAGES . $this_set['icon'] ?>" style="height:16px;width:16px;">
				<?php } ?>
				<?php echo $this_set['label'] ?>
			</a>
		</li>
		<?php } ?>
		<?php if ($showEditProjSettings) { ?>
		<li style="background-image:none;border:0;">
			<a href="<?php echo APP_PATH_WEBROOT . "ControlCenter/edit_project.php?project=" . PROJECT_ID ?>" style="font-size:15px;color:#393733;padding:7px 9px;">
				<img src="<?php echo APP_PATH_IMAGES ?>gear.png" style="height:16px;width:16px;"> <?php print $lang['project_settings_49'] ?></a>
		</li>
		<?php } ?>
	</ul>
</div>
