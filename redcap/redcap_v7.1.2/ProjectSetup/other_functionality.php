<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';



## MOVE TO PROD & SET TO INACTIVE/BACK TO PROD
// Set up status-specific language and actions
$status_change_btn   = $lang['edit_project_07'];
$status_change_text  = $lang['edit_project_08'];
$status_dialog_title = $lang['edit_project_09'];
$status_dialog_btn 	 = $lang['edit_project_166'];
$type = isset($_GET['type']) ? $_GET['type'] : '';
$user_email = isset($_GET['user_email']) ? $_GET['user_email'] : '';
$status_dialog_btn_action = "doChangeStatus(0,'{$type}','{$user_email}');";
$status_dialog_text  = $lang['edit_project_11'];
switch ($status) {
	case 0: // Development
		break;
	case 1: // Production
		$status_change_btn   = $lang['edit_project_164'];
		$status_change_text  = $lang['edit_project_24'];
		$status_dialog_title = $lang['edit_project_25'];
		$status_dialog_btn 	 = $lang['edit_project_165'];
		$status_dialog_text  = $lang['edit_project_26'];
		break;
	case 2: // Inactive
		break;
	case 3: // Archived
		break;
}

$otherFuncTable = '';



// API help
if ($api_enabled)
{
	$h = ''; // will hold the HTML to display in API div (all JS is included inline at the bottom)
	$h .= RCView::div(array('class' => 'chklisthdr'), $lang['edit_project_52']);
	$apiHelpLink = RCView::a(array('id' => 'apiHelpBtnId', 'style' => 'text-decoration:underline;', 'href' => '#'),
					$lang['edit_project_142']);
	$h .= RCView::div(array('style' => 'margin:5px 0 0;'),
					$lang['system_config_114'] . ' ' . $apiHelpLink . $lang['period'] . RCView::br() . RCView::br() . $lang['system_config_189']);
	// Display option to erase all API tokens
	if ($super_user)
	{
		$db = new RedCapDB();
		$numtokens = $db->countAPITokensByProject($project_id);
		$numtokenstext = RCView::span(array('style'=>'color:#800000;line-height:22px;'),
						$lang['edit_project_108'] . $lang['colon'] . ' ' .
						RCView::span(array('id' => 'apiTokenCountId'), $numtokens)
					);
		// JS handler for this button is at the bottom
		if ($numtokens > 0) {
			$btn = RCView::button(array('id' => 'apiEraseBtnId', 'class' => 'jqbuttonmed'),
							str_replace(' ', RCView::SP, $lang['edit_project_106']));
			$h .= RCView::table(array('cellspacing' => '12', 'width' => '100%', 'style' => 'border-collapse: collapse; margin-top: 10px;'),
				RCView::tr(array('id' => 'row_token_erase'),
							RCView::td(array('valign' => 'top', 'style' => 'padding: 0px 15px 0px 5px;'), $btn) .
							RCView::td(array('valign' => 'top', 'style' => 'padding: 0px 5px 0px 0px;'),
											$lang['edit_project_107'] . ' ' .
											RCView::b($lang['edit_project_77']) . RCView::br() . $numtokenstext
									)));
		} else {
			$h .= $numtokenstext;
		}
	}
	$otherFuncTable .= RCView::div(array('class' => 'round chklist', 'style' => 'padding:15px 20px;'), $h);
}


## Copy or back up project
if ($display_project_xml_backup_option || $allow_create_db)
{
	if ($display_project_xml_backup_option && $allow_create_db) {
		$copyBackupText = $lang['edit_project_161'];
	} elseif ($display_project_xml_backup_option && !$allow_create_db) {
		$copyBackupText = $lang['edit_project_162'];
	} else {
		$copyBackupText = $lang['edit_project_175'];
	}
	$otherFuncTable .= "<div class='round chklist' style='padding:15px 20px 0;'>" .
					RCView::div(array('class' => 'chklisthdr copy-bck-target'), ($allow_create_db ? $lang['edit_project_161'] : $lang['edit_project_162'])) .
					"<table class='proj-setup-table'>";
if ($allow_create_db)
{
	// COPY project
	$otherFuncTable .= "<tr id='row_copy'>
							<td valign='top'>
								<button class='jqbuttonmed nowrap' style='color:#000066;' onclick=\"window.location.href = app_path_webroot+'ProjectGeneral/copy_project_form.php?pid=$project_id'\">
									<img src='".APP_PATH_IMAGES."page_copy.png' style='vertical-align:middle;'>
									<span style='vertical-align:middle;margin:0 2px;'>{$lang['edit_project_146']}</span>
								</button>
								</td>
								<td valign='top'>
									<b>{$lang['edit_project_167']}</b>
									{$lang['edit_project_168']}
								</td>
							</tr>";
	}
	// ODM: Export whole project as ODM XML
	if ($display_project_xml_backup_option)
	{
		$odmDisabled = ($user_rights['data_export_tool'] < 1) ? "disabled" : "";
		$odmDisabledOnclick = ($user_rights['data_export_tool'] < 1) ? "onclick=\"simpleDialog('".cleanHtml($lang['edit_project_171'])."');\"" : "";
		$odmInstructions = ($user_rights['data_export_tool'] < 1) ? $lang['edit_project_172'] : (($longitudinal ? $lang['data_export_tool_202'] : $lang['data_export_tool_201'])." ".$lang['data_export_tool_203']);
$otherFuncTable .= "<tr>
								<td valign='top'>
									<div style='margin:3px 0 10px;'>
										<button class='jqbuttonmed nowrap' onclick=\"window.location.href = app_path_webroot+'ProjectSetup/export_project_odm.php?pid=$project_id'\">
											<img src='".APP_PATH_IMAGES."redcap_icon.gif' style='vertical-align:middle;'>
											<span style='vertical-align:middle;margin:0 2px;'>{$lang['data_export_tool_215']}</span>
										</button>
									</div>
									<div $odmDisabledOnclick>
										<button $odmDisabled class='jqbuttonmed nowrap' onclick=\"showExportFormatDialog('ALL',true);\">
											<img src='".APP_PATH_IMAGES."redcap_icon.gif' style='vertical-align:middle;'>
											<span style='vertical-align:middle;margin:0 2px;'>{$lang['data_export_tool_216']}</span>
										</button>
									</div>
								</td>
								<td valign='top'>
									<b>{$lang['data_export_tool_214']}</b>
									$odmInstructions
									<div style='color:#888;font-size:11px;line-height:11px;margin-top:4px;'>{$lang['edit_project_173']}</div>
								</td>
							</tr>";
	}
	$otherFuncTable .= "</table></div>";
}

## Other functionality (copy, delete, erase, archive)
$otherFuncTable .= "<div class='round chklist' style='padding:15px 20px 5px;'>" .
					RCView::div(array('class' => 'chklisthdr delete-target'), $lang['edit_project_163']) .
					"<table class='proj-setup-table'>";


if ($status > 0)
{
	// Display DELETE option
	if (!$super_user) {
		$db = new RedCapDB();
		$userInfo = $db->getUserInfoByUsername($userid);
		$ui_id = $userInfo->ui_id;
		$todo_type = 'delete project';
		// print $ui_id;
		$delBtnTxt = ($super_user || defined("AUTOMATE_ALL") ? 'control_center_105' : 'control_center_4532');
		$request_count = ToDoList::checkIfRequestExist($project_id, $ui_id, $todo_type);
		if($request_count > 0){
			$otherFuncTable .= "<tr id='row_delete_project'>
									<td valign='top'>
										<button class='jqbuttonmed nowrap' style='color:rgba(192, 0, 0, 0.66);'>
											<img src='".APP_PATH_IMAGES."cross.png' style='vertical-align:middle;'>
											<span style='vertical-align:middle;margin:0 2px;'>{$lang[$delBtnTxt]}</span>
										</button>
									</td>
									<td valign='top'>
										<b style='display:block;color:#C00000;'>{$lang['edit_project_179']} <button class='jqbuttonmed nowrap' onclick=\"cancelRequest(pid,'delete project',".$ui_id.")\" class='cancel-delete-req-btn'>{$lang['global_128']}</button></b>
										{$lang['edit_project_50']}";
		}else{
			$otherFuncTable .= "<tr id='row_delete_project'>
			<td valign='top'>
			<button class='jqbuttonmed nowrap' style='color:#C00000;' onclick=\"delete_project(pid,this,".$super_user.",".$status.")\">
			<img src='".APP_PATH_IMAGES."cross.png' style='vertical-align:middle;'>
			<span style='vertical-align:middle;margin:0 2px;'>{$lang[$delBtnTxt]}</span>
			</button>
			</td>
			<td valign='top'>
			{$lang['edit_project_50']}";
		}
		if (!$super_user && $status < 1) {
			$otherFuncTable .=  	" {$lang['edit_project_78']}";
		} elseif ($status > 0 && !$super_user){
			$otherFuncTable .=  	" <b>{$lang['edit_project_174']}</b>";
		} elseif ($status > 0) {
			$otherFuncTable .=  	" <b>{$lang['edit_project_77']}</b>";
		}
		$otherFuncTable .= "	</td>
							</tr>";
	}
	// If Inactive/Archived, set back to production
	$otherFuncTable .= "<tr>
							<td valign='top'>
								<button class='jqbuttonmed nowrap' onclick='btnMoveToProd()'>
									<img src='".APP_PATH_IMAGES."arrow_skip_180.png' style='vertical-align:middle;'>
									<span style='vertical-align:middle;margin:0 2px;'>$status_change_btn</span>
								</button>
							</td>
							<td valign='top'>$status_change_text</td>
						</tr>";

	// If in production, MOVE BACK TO DEVELOPMENT (super users only)
	if ($super_user)
	{
		// Set flag if using DTS. If so, don't allow to move back to dev because it will break DTS mapping
		$usingDTS = $dts_enabled ? '1' : '0';
		// Display table row
		$otherFuncTable .= "<tr>
								<td valign='top'>
									<button class='jqbuttonmed' onclick='MoveToDev($draft_mode,$usingDTS)'>
										<img src='".APP_PATH_IMAGES."arrow_skip_180.png' style='vertical-align:middle;'>
										<span style='vertical-align:middle;margin:0 2px;'>{$lang['edit_project_79']}</span>
									</button>
								</td>
								<td valign='top'>
									{$lang['edit_project_80']} ";
		if ($draft_mode > 0) {
			$otherFuncTable .= "<span style='color:#800000;'>{$lang['edit_project_81']}</span> ";
		}
		$otherFuncTable .= "		<b>{$lang['edit_project_77']}</b></td>
							</tr>";
	}
}

if ($status < 1 || $super_user)
{
	// Display option to DELETE the project (ONLY if in development)
	// $delBtnTxt = ($super_user ? 'control_center_105' : 'control_center_4532');
	$otherFuncTable .= "<tr id='row_delete_project'>
							<td valign='top'>
								<button class='jqbuttonmed nowrap' style='color:#C00000;' onclick=\"delete_project(pid,this,".$super_user.",".$status.")\">
									<img src='".APP_PATH_IMAGES."cross.png' style='vertical-align:middle;position:relative;top:-1px;'>
									<span style='vertical-align:middle;margin:0 2px;'>{$lang['control_center_105']}</span>
								</button>
							</td>
							<td valign='top'>
								{$lang['edit_project_50']}";
	if (!$super_user && $status < 1) {
		$otherFuncTable .=  	" {$lang['edit_project_78']}";
	} elseif ($status > 0) {
		$otherFuncTable .=  	" <b>{$lang['edit_project_77']}</b>";
	}
	$otherFuncTable .= "	</td>
						</tr>";
	// Display option to ERASE all data in the project (ONLY if in development)
	$otherFuncTable .= "<tr id='row_erase'>
							<td valign='top'>
								<button class='jqbuttonmed nowrap' style='color:#800000;' onclick=\"
									$('#erase_dialog').dialog({ bgiframe: true, modal: true, width: 500, buttons: {
										'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); },
										'".cleanHtml($lang['edit_project_147'])."': function() {
											showProgress(1);
											$(':button:contains(\'".cleanHtml($lang['global_53'])."\')').html('".cleanHtml($lang['design_160'])."');
											$(':button:contains(\'".cleanHtml($lang['edit_project_147'])."\')').button('option', 'disabled', true );
											$.post(app_path_webroot+'ProjectGeneral/erase_project_data.php?pid='+pid, { action: 'erase_data' },
												function(data) {
													showProgress(0,0);
													$('#erase_dialog').dialog('close');
													if (data == '1') {
														simpleDialog('".cleanHtml($lang['edit_project_31'])."','".cleanHtml($lang['global_79'])."');
													} else {
														alert(woops);
													}
												}
											);
										}
									} });
								\">
									<img src='".APP_PATH_IMAGES."broom.png' style='vertical-align:middle;'>
									<span style='vertical-align:middle;margin:0 2px;'>{$lang['edit_project_147']}</span>
								</button>
							</td>
							<td valign='top'>
								{$lang['edit_project_169']}";
	if (!$super_user && $status < 1) {
		$otherFuncTable .=  	" {$lang['edit_project_78']}";
	} elseif ($status > 0) {
		$otherFuncTable .=  	" <b>{$lang['edit_project_77']}</b>";
	}
	$otherFuncTable .= "
							</td>
						</tr>";
}
// Display option to archive the project (if not already archived)
if ($status != 3)
{
	if ($superusers_only_move_to_prod && $status < 1 && !$super_user) {
		// Don't allow users to archive dev projects (because it can bypass production approval) if ony super users can move to production
		$archiveJS = "simpleDialog('".cleanHtml($lang['edit_project_159'])."','".cleanHtml($lang['edit_project_158'])."');";
	} else {
		$archiveJS =   "$('#archive_dialog').dialog({ bgiframe: true, modal: true, width: 500, buttons: {
							'".cleanHtml($lang['global_53'])."': function() { $(this).dialog('close'); },
							'".cleanHtml($lang['edit_project_148'])."': function() { doChangeStatus(1,'','') }
						} });";
	}
	$otherFuncTable .= "<tr id='row_archive'>
							<td valign='top'>
								<button class='jqbuttonmed nowrap' onclick=\"$archiveJS\">
									<span class='glyphicon glyphicon-trash' style='vertical-align:middle;'></span>
									<span style='vertical-align:middle;margin:0 2px;'>{$lang['edit_project_148']}</span>
								</button>
							</td>
							<td valign='top'>
								{$lang['edit_project_33']}
							</td>
						</tr>";
}

// DDP - Purge unused source data cache
if ($DDP->isEnabledInSystem() && $DDP->isEnabledInProject())
{
	$otherFuncTable .= "<tr id='row_ddp'>
							<td valign='top'>
								<button id='purgeDdpBtn' class='jqbuttonmed nowrap' onclick=\"purgeDDPdata()\">
									<img src='".APP_PATH_IMAGES."databases_arrow.png' style='vertical-align:middle;position:relative;top:-1px;'>
									<span style='vertical-align:middle;margin:0 2px;'>{$lang['edit_project_149']}</span>
								</button>
							</td>
							<td valign='top'>
								{$lang['edit_project_150']}
							</td>
						</tr>";
}

$otherFuncTable .= "</table>
					</div>";

// Header
include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';
callJSfile('velocity-min.js');
callJSfile('DeletePrompt.js');
// Tabs
include APP_PATH_DOCROOT . "ProjectSetup/tabs.php";
?>


<!-- Invisible div for purging DDP data cache -->
<div id='purgeDDPdataDialog' title="<?php echo cleanHtml2(($status <= 1 ? $lang['edit_project_153'] : $lang['edit_project_149'])) ?>" class="simpleDialog">
	<?php echo ($status <= 1 ? RCView::div(array('style'=>'color:#C00000;'), $lang['edit_project_152']) : $lang['edit_project_151']) ?>
</div>

<!-- Invisible div for status change -->
<div id='status_dialog' title='<?php echo cleanHtml($status_dialog_title) ?>' style='display:none;'>
	<p style=''><?php echo $status_dialog_text ?></p>
</div>
<!--  Invisible div for archiving the project -->
<div id='archive_dialog' title='<?php echo cleanHtml($lang['edit_project_34']) ?>' style='display:none;'>
	<p style=''>
		<?php echo $lang['edit_project_35'] ?>
	</p>
</div>
<!--  Invisible div for erasing all data -->
<div id='erase_dialog' title='<?php echo cleanHtml($lang['edit_project_36']) ?>' style='display:none;'>
	<p style=''>
		<?php echo $lang['edit_project_37'] ?>
	</p>
</div>
<!--  Invisible div for erasing all API tokens -->
<div id='erase_api_dialog' title='<?php echo cleanHtml($lang['edit_project_109']) ?>' style='display:none;'>
	<p style=''>
		<?php echo $lang['edit_project_110'] ?>
	</p>
</div>

<script type='text/javascript'>
var langExporting = '<?php print cleanHtml($lang['report_builder_51']) ?>';
var langQuestionMark = '<?php print cleanHtml($lang['questionmark']) ?>';
var closeBtnTxt = '<?php print cleanHtml($lang['global_53']) ?>';
var exportBtnTxt = '<?php print cleanHtml($lang['report_builder_48']) ?>';
var exportBtnTxt2 = '<?php print cleanHtml($lang['data_export_tool_199']." ".$lang['data_export_tool_209']) ?>';
var langSaveValidate = '<?php print cleanHtml($lang['report_builder_52']) ?>';
var langIconSaveProgress = '<?php print cleanHtml($lang['report_builder_55']) ?>';
var langIconSaveProgress2 = '<?php print cleanHtml($lang['report_builder_56']) ?>';
var langCancel = '<?php print cleanHtml($lang['global_53']) ?>';
var langError = '<?php print cleanHtml($lang['global_01']) ?>';
var langExportFailed = '<?php print cleanHtml($lang['report_builder_129']) ?>';
var langExportWholeProject = '<?php print cleanHtml($lang['data_export_tool_208']) ?>';
var max_live_filters = <?php print DataExport::MAX_LIVE_FILTERS ?>;
$(function() {
	$("#apiHelpBtnId").click(function() {
		window.location.href='<?php echo APP_PATH_WEBROOT_PARENT; ?>api/help/';
	});
	$("#apiEraseBtnId").click(function() {
		if ($('#apiTokenCountId').html() == '0') {
			alert('There are no tokens to delete because no API tokens have been created yet.');
			return;
		}
		$('#erase_api_dialog').dialog(
			{ bgiframe: true, modal: true, width: 500,
				buttons: {
					Cancel: function() { $(this).dialog('close'); },
					'<?php echo cleanHtml($lang['edit_project_106']) ?>':
					function() {
						$.get(app_path_webroot + 'ControlCenter/user_api_ajax.php',
							{ action: 'deleteProjectTokens', api_pid: '<?php echo $project_id; ?>'},
							function(data) {
								alert(data);
								$.get(app_path_webroot + 'ControlCenter/user_api_ajax.php',
									{ action: 'countProjectTokens', api_pid: '<?php echo $project_id; ?>'},
									function(data) { $("#apiTokenCountId").html(data); }
								);
							}
						);
						$(this).dialog('close');
					}
				}
			}
		);
	});
});
function btnMoveToProd() {
	$('#status_dialog').dialog({ bgiframe: true, modal: true, width: 650, buttons: {
		'<?php echo cleanHtml($lang['global_53']) ?>': function() { $(this).dialog('close'); },
		'<?php echo cleanHtml($status_dialog_btn) ?>': function() { <?php echo $status_dialog_btn_action ?> }
	} });
}
function MoveToDev(draft_mode,usingDTS) {
	if (usingDTS) {
		alert('<?php echo cleanHtml($lang['edit_project_84']) . '\n\n' . cleanHtml($lang['edit_project_85']) ?>');
		return;
	}
	var msg = '<?php echo cleanHtml($lang['edit_project_82']) ?>';
	if (draft_mode > 0) {
		msg += ' <?php echo cleanHtml($lang['edit_project_83']) ?>';
	}
	if (confirm(msg)) {
		$.post(app_path_webroot+'ProjectGeneral/change_project_status.php?pid='+pid, { moveToDev: 1 }, function(data){
			if (data=='1') {
				window.location.href = app_path_webroot+'ProjectSetup/index.php?msg=movetodev&pid='+pid;
			} else {
				alert(woops);
			}
		});
	}
}
// Purge DDP data (with confirmation popup)
function purgeDDPdata() {
	var purgeLangClose  = (status <= 1 ? '<?php echo cleanHtml($lang['calendar_popup_01']) ?>' : '<?php echo cleanHtml($lang['global_53']) ?>');
	var purgeLangRemove = (status <= 1 ? null : '<?php echo cleanHtml($lang['scheduling_57']) ?>');
	var purgeFuncRemove = (status <= 1 ? null : (function(){
		$.post(app_path_webroot+'DynamicDataPull/purge_cache.php?pid='+pid,{ },function(data){
			if (data != '1') {
				alert(woops);
			} else {
				$('#purgeDdpBtn').button('disable');
				simpleDialog('<?php echo cleanHtml($lang['edit_project_154']) ?>', '<?php echo cleanHtml($lang['setup_08']) ?>');
			}
		});
	}));
	simpleDialog(null,null,'purgeDDPdataDialog',500,null,purgeLangClose,purgeFuncRemove,purgeLangRemove);
}
</script>

<?php
// Tables
print $otherFuncTable;
// ODM: Export whole project as ODM XML
if ($user_rights['data_export_tool'] > 0) {
	callJSfile('DataExport.js');
	// Hidden dialog to choose export format
	print DataExport::renderExportOptionDialog();
}
// Footer
include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
