<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

include 'header.php';
if (!SUPER_USER) redirect(APP_PATH_WEBROOT);

// If project values were changed, update redcap_projects table with new values
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Validate project_id
	if (!isset($_GET['project']) || (isset($_GET['project']) && !is_numeric($_GET['project']))) exit('ERROR!');

	// Loop through submitted values to build query
	$sql_set = array();
	foreach ($_POST as $field=>$value) {
		// Don't add apostrophes for NULLs
		$value = ($value == "NULL") ? "NULL" : "'" . prep($value) . "'";
		// Add to array
		$sql_set[] = "$field = $value";
	}
	// Execute query
	$sql = "update redcap_projects set " . implode(", ", $sql_set) . " where project_id = '{$_GET['project']}'";
	$q = db_query($sql);
	// Give confirmation of changes
	if ($q) {
		// Logging
		Logging::logEvent($sql,"redcap_projects","MANAGE",$_GET['project'],implode(",\n",$sql_set),"Modify settings for single project");
		print  "<div class='yellow' style='margin-bottom:20px;text-align:center;'>
					<img src='".APP_PATH_IMAGES."exclamation_orange.png'>
					{$lang['control_center_48']}
				</div>";
	} else {
		print  "<div class='red' style='margin-bottom:20px; text-align:center;'>
					<img src='".APP_PATH_IMAGES."exclamation.png'>
					{$lang['global_01']}: {$lang['control_center_49']}
				</div>";
	}
}

if (isset($_GET['project']) && !is_numeric($_GET['project'])) unset($_GET['project']);

// Retrieve data to pre-fill in form
$element_data = array();
if (isset($_GET['project'])) {
	$q = db_query("select * from redcap_projects where project_id = '".prep($_GET['project'])."'");
	$num_cols = db_num_fields($q);
	while ($row = db_fetch_array($q)) {
		for ($i = 0; $i < $num_cols; $i++) {
			$this_fieldname = db_field_name($q, $i);
			$this_value = $row[$i];
			$element_data[$this_fieldname] = $this_value;
		}
	}
}
?>

<h4 style="margin-top: 0;"><?php echo RCView::img(array('src'=>'folder_pencil.png')) . $lang['control_center_4396'] ?></h4>

<p><?php echo $lang['control_center_50'] ?></p>

<p style='padding:15px 0 0;'>
	<b><?php echo $lang['control_center_51'] ?></b><br>
	<select style='max-width:500px;' class='x-form-text x-form-field'
		onchange="window.location.href='<?php echo PAGE_FULL ?>?project=' + this.value">
		<option value=''>--- <?php echo $lang['control_center_52'] ?> ---</option>
		<?php
		$q = db_query("select project_id, trim(app_title) as app_title from redcap_projects order by trim(app_title)");
		while ($row = db_fetch_assoc($q))
		{
			$row['app_title'] = strip_tags(str_replace('<br>', ' ', $row['app_title']));
			// If title is too long, then shorten it
			if (strlen($row['app_title']) > 90) {
				$row['app_title'] = trim(substr($row['app_title'], 0, 66)) . " ... " . trim(substr($row['app_title'], -20));
			}
			if ($row['app_title'] == "") {
				$row['app_title'] = $lang['create_project_82'];
			}
			print "<option class='notranslate' value='{$row['project_id']}' ";
			if (isset($_GET['project']) && $row['project_id'] == $_GET['project']) {
				print "selected";
				$this_app_title = $row['app_title'];
			}
			print ">{$row['app_title']}</option>";
		}
		?>
	</select>
</p>

<?php
## Display project values since project has been selected
if (isset($_GET['project']) && $_GET['project'] != "")
{
	// Link to go to project page
	print  "<p style='margin-bottom:30px;font-size:14px;'>
				&gt;&gt; {$lang['control_center_53']} <a href='" . APP_PATH_WEBROOT . "index.php?pid={$_GET['project']}'
					style='font-weight:bold;color:#800000;font-size:14px;text-decoration:underline;'>$this_app_title</a>
			</p>";
	?>

	<form action='<?php echo PAGE_FULL ?>?project=<?php echo $_GET['project'] ?>' enctype='multipart/form-data' target='_self' method='post' name='form' id='form'>
	<?php
	// Go ahead and manually add the CSRF token even though jQuery will automatically add it after DOM loads.
	// (This is done in case the page is very long and user submits form before the DOM has finished loading.)
	print "<input type='hidden' name='redcap_csrf_token' value='".System::getCsrfToken()."'>";
	?>
	<table style="border: 1px solid #ccc; background-color: #f0f0f0; width: 100%;">
	<tr id="online_offline-tr" sq_id="online_offline">
		<td class="cc_label"><?php echo $lang['project_settings_02'] ?></td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="online_offline">
				<option value='0' <?php echo ($element_data['online_offline'] == 0) ? "selected" : "" ?>><?php echo $lang['project_settings_04'] ?></option>
				<option value='1' <?php echo ($element_data['online_offline'] == 1) ? "selected" : "" ?>><?php echo $lang['project_settings_05'] ?></option>
			</select><br/>
			<div class="cc_info">
				<?php echo $lang['project_settings_03'] ?>
			</div>
		</td>
	</tr>
	<tr  id="auth_meth-tr" sq_id="auth_meth">
		<td class="cc_label">
			<?php echo $lang['project_settings_06'] ?>
		</td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="auth_meth">
				<option value='none' <?php echo ($element_data['auth_meth'] == "none" ? "selected" : "") ?>><?php echo $lang['system_config_08'] ?></option>
				<option value='table' <?php echo ($element_data['auth_meth'] == "table" ? "selected" : "") ?>><?php echo $lang['system_config_09'] ?></option>
				<option value='ldap' <?php echo ($element_data['auth_meth'] == "ldap" ? "selected" : "") ?>>LDAP</option>
				<option value='ldap_table' <?php echo ($element_data['auth_meth'] == "ldap_table" ? "selected" : "") ?>>LDAP & <?php echo $lang['system_config_09'] ?></option>
				<option value='shibboleth' <?php echo ($element_data['auth_meth'] == "shibboleth" ? "selected" : "") ?>>Shibboleth</option>
				<option value='rsa' <?php echo ($element_data['auth_meth'] == "rsa" ? "selected" : "") ?>>RSA SecurID (two-factor authentication)</option>
				<option value='sams' <?php echo ($element_data['auth_meth'] == "sams" ? "selected" : "") ?>>SAMS (for CDC only)</option>
				<option value='openid_google' <?php echo ($element_data['auth_meth'] == "openid_google" ? "selected" : "") ?>>Google OAuth2</option>
				<option value='openid' <?php echo ($element_data['auth_meth'] == "openid" ? "selected" : "") ?>>OpenID</option>
			</select>
			<div class="cc_info" style="font-weight:normal;">
				<?php echo $lang['system_config_222'] ?>
				<a href="https://community.projectredcap.org/articles/691/authentication-how-to-change-and-set-up-authentica.html" target="_blank" style="text-decoration:underline;"><?php echo $lang['system_config_223'] ?></a><?php echo $lang['system_config_224'] ?>
			</div>
		</td>
	</tr>
	<tr  id="project_language-tr" sq_id="project_language">
		<td class="cc_label"><?php echo $lang['system_config_90'] ?></td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="project_language">
				<?php
				$languages = Language::getLanguageList();
				foreach ($languages as $language) {
					$selected = ($element_data['project_language'] == $language) ? "selected" : "";
					echo "<option value='$language' $selected>$language</option>";
				}
				?>
			</select><br/>
			<div class="cc_info">
				<?php echo $lang['system_config_107'] ?>
				<a href="<?php echo APP_PATH_WEBROOT ?>LanguageUpdater/" target='_blank' style='text-decoration:underline;'>Language File Creator/Updater</a>
				<?php echo $lang['system_config_108'] ?>
				<a href='https://community.projectredcap.org/articles/676/redcap-language-center.html' target='_blank' style='text-decoration:underline;'>REDCap wiki Language Center</a>.
				<br/><br/><?php echo $lang['system_config_109']." ".dirname(APP_PATH_DOCROOT).DS."languages".DS ?>
			</div>
		</td>
	</tr>

	<tr>
		<td class="cc_label">
			<?php echo $lang['system_config_293'] ?>
			<div class="cc_info">
				<?php echo $lang['system_config_294'] ?>
			</div>
		</td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="project_encoding">
				<option value='NULL' <?php echo ($element_data['project_encoding'] == '') ? "selected" : "" ?>><?php echo $lang['system_config_295'] ?></option>
				<option value='japanese_sjis' <?php echo ($element_data['project_encoding'] == 'japanese_sjis') ? "selected" : "" ?>><?php echo $lang['system_config_296'] ?></option>
				<option value='chinese_utf8' <?php echo ($element_data['project_encoding'] == 'chinese_utf8') ? "selected" : "" ?>><?php echo $lang['system_config_297'] ?></option>
			</select>
			<div class="cc_info">
				<?php echo $lang['system_config_298'] ?>
			</div>
		</td>
	</tr>

	<!-- Exempt project from auto-calcs -->
	<tr>
		<td class="cc_label">
			<?php echo $lang['project_settings_50'] ?>
			<div class="cc_info">
				<?php echo $lang['project_settings_51'] ?>
			</div>
		</td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="disable_autocalcs">
				<option value='1' <?php echo ($element_data['disable_autocalcs'] == 1) ? "selected" : "" ?>><?php echo $lang['global_23'] ?></option>
				<option value='0' <?php echo ($element_data['disable_autocalcs'] == 0) ? "selected" : "" ?>><?php echo $lang['system_config_27'] ?></option>
			</select>
			<div class="cc_info">
				<?php echo $lang['project_settings_52'] ?>
			</div>
		</td>
	</tr>

	<!-- 2FA settings -->
	<?php if ($two_factor_auth_enabled) { ?>
	<tr><td colspan="2" class="cc_label" style="color:#800000;"><hr>
		<?php echo $lang['system_config_501'] ?>
	</td></tr>
	<tr>
		<td class="cc_label">
			<img src="<?php echo APP_PATH_IMAGES ?>smartphone_key.png" style="position:relative;"><img src="<?php echo APP_PATH_IMAGES ?>cross.png" style="position:relative;left:-7px;margin-right:-7px;">
			<?php echo $lang['system_config_502'] ?>
			<div class="cc_info">
				<?php echo $lang['system_config_507'] ?>
			</div>
		</td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="two_factor_exempt_project">
				<option value='0' <?php echo ($element_data['two_factor_exempt_project'] == 0) ? "selected" : "" ?>><?php echo $lang['system_config_503'] ?></option>
				<option value='1' <?php echo ($element_data['two_factor_exempt_project'] == 1) ? "selected" : "" ?>><?php echo $lang['system_config_504'] ?></option>
			</select><br/>
			<div class="cc_info">
				<?php echo $lang['system_config_505'] ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="cc_label">
			<img src="<?php echo APP_PATH_IMAGES ?>smartphone_key.png" style="position:relative;"><img src="<?php echo APP_PATH_IMAGES ?>arrow_circle_double_135.png" style="position:relative;left:-6px;margin-right:-6px;">
			<?php echo $lang['system_config_506'] ?>
			<div class="cc_info">
				<?php echo $lang['system_config_509'] ?>
			</div>
		</td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="two_factor_force_project">
				<option value='0' <?php echo ($element_data['two_factor_force_project'] == 0) ? "selected" : "" ?>><?php echo $lang['system_config_503'] ?></option>
				<option value='1' <?php echo ($element_data['two_factor_force_project'] == 1) ? "selected" : "" ?>><?php echo $lang['system_config_508'] ?></option>
			</select><br/>
			<div class="cc_info">
				<?php echo $lang['system_config_511'] ?>
			</div>
			<div class="cc_info" style="color:#800000;">
				<?php echo $lang['system_config_510'] ?>
			</div>
		</td>
	</tr>
	<?php } else { ?>
		<input type="hidden" name="two_factor_exempt_project" value="<?php echo $element_data['two_factor_exempt_project'] ?>">
		<input type="hidden" name="two_factor_force_project" value="<?php echo $element_data['two_factor_force_project'] ?>">
	<?php } ?>

	<tr><td colspan="2"><hr></td></tr>
	<tr  id="dts_enabled-tr">
		<td class="cc_label"><img src="<?php echo APP_PATH_IMAGES ?>databases_arrow.png"> <?php echo $lang['rights_132'] ?></td>
		<td class="cc_data">
			<?php $disabled = (!$dts_enabled_global) ? "disabled" : ""; ?>
			<select class="x-form-text x-form-field" style="" name="dts_enabled" <?php echo $disabled ?>>
				<option value='0' <?php echo ($element_data['dts_enabled'] == 0) ? "selected" : "" ?>><?php echo $lang['global_23'] ?></option>
				<option value='1' <?php echo ($element_data['dts_enabled'] == 1) ? "selected" : "" ?>><?php echo $lang['system_config_27'] ?></option>
			</select><br/>
			<div class="cc_info">
				<?php
				if ($dts_enabled_global)
					echo $lang['system_config_125'];
				else
					echo $lang['system_config_126'];
				?>
			</div>
		</td>
	</tr>
	<tr id="double_data_entry-tr" sq_id="double_data_entry">
		<td class="cc_label"><?php echo $lang['global_04'] ?></td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="double_data_entry">
				<option value='0' <?php echo ($element_data['double_data_entry'] == 0) ? "selected" : "" ?>><?php echo $lang['global_23'] ?></option>
				<option value='1' <?php echo ($element_data['double_data_entry'] == 1) ? "selected" : "" ?>><?php echo $lang['system_config_27'] ?></option>
			</select><br/>
			<div class="cc_info">
				<?php echo $lang['project_settings_18'] ?>
			</div>
		</td>
	</tr>
	<tr><td colspan="2"><br/><hr></td></tr>
	<tr  id="date_shift_max-tr" sq_id="date_shift_max">
		<td class="cc_label"><?php echo $lang['project_settings_29'] ?></td>
		<td class="cc_data">
			<input class='x-form-text x-form-field '  type='text' name='date_shift_max' value='<?php echo htmlspecialchars($element_data['date_shift_max'], ENT_QUOTES) ?>'
				onblur="redcap_validate(this,'0','','soft_typed','int')" size='10' />
			<span style="color: #888;"><?php echo $lang['project_settings_31'] ?></span><br/>
			<div class="cc_info">
				<?php echo $lang['project_settings_30'] ?>
			</div>
		</td>
	</tr>



	<tr><td colspan="2"><br/><hr></td></tr>

	<tr  id="investigators-tr" sq_id="investigators">
		<td class="cc_label"><?php echo $lang['project_settings_09'] ?></td>
		<td class="cc_data">
			<textarea class='x-form-field notesbox' id='investigators' name='investigators'><?php echo $element_data['investigators'] ?></textarea><br/>
			<div id='investigators-expand' style='text-align:right;'>
				<a href='javascript:;' style='font-weight:normal;text-decoration:none;color:#999;font-family:tahoma;font-size:10px;'
					onclick="growTextarea('investigators')"><?php echo $lang['form_renderer_19'] ?></a>&nbsp;
			</div>
			<div class="cc_info">
				<?php echo $lang['project_settings_10'] ?>
			</div>
		</td>
	</tr>
	<tr  id="custom_index_page_note-tr" sq_id="custom_index_page_note">
		<td class="cc_label"><?php echo $lang['project_settings_47'] ?></td>
		<td class="cc_data">
			<textarea class='x-form-field notesbox' id='custom_index_page_note' name='custom_index_page_note'><?php echo $element_data['custom_index_page_note'] ?></textarea><br/>
			<div id='custom_index_page_note-expand' style='text-align:right;'>
				<a href='javascript:;' style='font-weight:normal;text-decoration:none;color:#999;font-family:tahoma;font-size:10px;'
					onclick="growTextarea('custom_index_page_note')"><?php echo $lang['form_renderer_19'] ?></a>&nbsp;
			</div>
		</td>
	</tr>
	<tr  id="custom_data_entry_note-tr" sq_id="custom_data_entry_note">
		<td class="cc_label"><?php echo $lang['project_settings_48'] ?></td>
		<td class="cc_data">
			<textarea class='x-form-field notesbox' id='custom_data_entry_note' name='custom_data_entry_note'><?php echo $element_data['custom_data_entry_note'] ?></textarea><br/>
			<div id='custom_data_entry_note-expand' style='text-align:right;'>
				<a href='javascript:;' style='font-weight:normal;text-decoration:none;color:#999;font-family:tahoma;font-size:10px;'
					onclick="growTextarea('custom_data_entry_note')"><?php echo $lang['form_renderer_19'] ?></a>&nbsp;
			</div>
		</td>
	</tr>
	<tr>
		<td class="cc_label"><?php echo $lang['system_config_129'] ?></td>
		<td class="cc_data">
			<select class="x-form-text x-form-field" style="" name="display_project_logo_institution">
				<option value='0' <?php echo ($element_data['display_project_logo_institution'] == 0) ? "selected" : "" ?>><?php echo $lang['system_config_231'] ?></option>
				<option value='1' <?php echo ($element_data['display_project_logo_institution'] == 1) ? "selected" : "" ?>><?php echo $lang['system_config_230'] ?></option>
			</select><br/>
		</td>
	</tr>



	<tr>
		<td colspan="2">
			<br/><hr>
			<h4 style="font-size:14px;padding:0 10px;color:#800000;"><?php echo $lang['system_config_308'] ?></h4>
			<div style="padding:0 10px;color:#800000;"><?php echo $lang['system_config_309'] ?></div>
		</td>
	</tr>
	<tr  id="project_contact_name-tr" sq_id="project_contact_name">
		<td class="cc_label">
			<?php echo $lang['system_config_549'] ?>
			<div class="cc_info">
				<?php echo $lang['system_config_92'] ?>
			</div>
		</td>
		<td class="cc_data">
			<input class='x-form-text x-form-field ' type='text' name='project_contact_name' value='<?php echo htmlspecialchars($element_data['project_contact_name'], ENT_QUOTES) ?>'  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>$project_contact_name</b>" ?></div>
		</td>
	</tr>
	<tr  id="project_contact_email-tr" sq_id="project_contact_email">
		<td class="cc_label"><?php echo "{$lang['system_config_550']}" ?></td>
		<td class="cc_data">
			<input class='x-form-text x-form-field '  type='text' name='project_contact_email' value='<?php echo htmlspecialchars($element_data['project_contact_email'], ENT_QUOTES) ?>'
				onblur="redcap_validate(this,'','','soft_typed','email')"  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>$project_contact_email</b>" ?></div>
		</td>
	</tr>
	<tr  id="institution-tr" sq_id="institution">
		<td class="cc_label"><?php echo $lang['system_config_97'] ?></td>
		<td class="cc_data">
			<input class='x-form-text x-form-field ' type='text' name='institution' value='<?php echo htmlspecialchars($element_data['institution'], ENT_QUOTES) ?>'  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>".($institution == '' ? $lang['system_config_311'] : $institution)."</b>" ?></div>
		</td>
	</tr>
	<tr  id="site_org_type-tr" sq_id="site_org_type">
		<td class="cc_label"><?php echo $lang['system_config_98'] ?></td>
		<td class="cc_data">
			<input class='x-form-text x-form-field ' type='text' name='site_org_type' value='<?php echo htmlspecialchars($element_data['site_org_type'], ENT_QUOTES) ?>'  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>".($site_org_type == '' ? $lang['system_config_311'] : $site_org_type)."</b>" ?></div>
		</td>
	</tr>
	<tr  id="grant_cite-tr" sq_id="grant_cite">
		<td class="cc_label">
			<?php echo $lang['system_config_313'] ?>
			<div class="cc_info">
			<?php echo $lang['system_config_100'] ?>
			</div>
		</td>
		<td class="cc_data">
			<input class='x-form-text x-form-field ' type='text' name='grant_cite' value='<?php echo htmlspecialchars($element_data['grant_cite'], ENT_QUOTES) ?>'  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>".($grant_cite == '' ? $lang['system_config_311'] : $grant_cite)."</b>" ?></div>
		</td>
	</tr>
	<tr  id="headerlogo-tr" sq_id="headerlogo">
		<td class="cc_label">
			<?php echo $lang['system_config_312'] ?>
			<div class="cc_info">
			<?php echo $lang['system_config_102'] ?>
			</div>
		</td>
		<td class="cc_data">
			<input class='x-form-text x-form-field ' type='text' name='headerlogo' value='<?php echo htmlspecialchars($element_data['headerlogo'], ENT_QUOTES) ?>'  /><br/>
			<div class="cc_info" style="color:#800000;"><?php echo $lang['system_config_310'] . " <b>".($headerlogo == '' ? $lang['system_config_311'] : $headerlogo)."</b>" ?></div>
		</td>
	</tr>


	</table><br/>
	<div style="text-align: center;"><input type='submit' name='' value='Save Changes' /></div><br/>
	</form>
<?php } ?>

<?php include 'footer.php'; ?>
