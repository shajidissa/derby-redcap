<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


/**
 * ProjectSetup Class
 */
class ProjectSetup
{
	// Render the Project Setup check list from an array
	public static function renderSetupCheckList($checkList=array(),$checkedOff=array())
	{
		global 	$lang, $user_rights, $repeatforms, $surveys_enabled, $survey_email_participant_field,
				$twilio_enabled_by_super_users_only, $longitudinal;
		foreach ($checkList as $value)
		{
			// Boolean if step has been manually marked as done
			$markedByUserAsDone = isset($value['name']) && isset($checkedOff[$value['name']]);
			// Determine icon and status text
			switch ($value['status'])
			{
				// "done"
				case '2':
					$icon = "checkbox_checked.png";
					$status_text = $lang['setup_03'];
					$status_text_color = "green";
					break;
				// "in progress"
				case '1':
					$icon = "checkbox_progress.png";
					$status_text = $lang['setup_101'];
					$status_text_color = "#5897C8";
					break;
				// "not done"
				case '0':
					$icon = "checkbox_cross.png";
					$status_text = $lang['setup_102'];
					$status_text_color = "#F47F6C";
					break;
				// "optional"
				default:
					$icon = "checkbox_gear.png";
					$status_text = $lang['setup_103'];
					$status_text_color = "#999";
			}

			?>
			<div <?php echo (!isset($value['name']) || $value['name'] == '' ? '' : 'id="setupChklist-'.$value['name'].'"') ?> class="round chklist col-xs-12">
				<table cellspacing="0" width="100%">
					<tr>
						<td valign="top" style="width:70px;text-align:center;">
							<?php if ($icon != "") { ?>
								<!-- Icon -->
								<div <?php echo ($value['status'] == '4' ? 'class="opacity25"' : '') ?>>
									<img id="img-<?php echo isset($value['name']) ? $value['name'] : ''; ?>" src="<?php echo APP_PATH_IMAGES . $icon ?>">
								</div>
							<?php } ?>
							<?php if ($status_text != "") { ?>
								<!-- Colored text below icon -->
								<div id="lbl-<?php echo isset($value['name']) ? $value['name'] : ''; ?>" style='color:<?php echo $status_text_color ?>;'><?php echo $status_text ?></div>
							<?php } ?>
							<!-- "I'm done!" button OR "Not complete?" link -->
							<?php if ($user_rights['design'] && $value['status'] != '2' && isset($value['name']) && !empty($value['name'])) { ?>
								<div class="chklist_comp">
									<button id="btn-<?php echo $value['name'] ?>" class="btn btn-defaultrc btn-xs doneBtn" title="<?php echo $lang['setup_01'] ?>" onclick="doDoneBtn('<?php echo $value['name'] ?>',1);"><?php echo $lang['setup_02'] ?></button>
								</div>
							<?php } elseif ($user_rights['design'] && isset($value['name']) && !empty($value['name']) && isset($checkedOff[$value['name']])) { ?>
								<div class="chklist_comp">
									<a href="javascript:;" style="" onclick="doDoneBtn('<?php echo $value['name'] ?>',0);"><?php echo $lang['setup_04'] ?></a>
								</div>
							<?php } ?>
						</td>
						<td valign="top" style="padding-left:30px;">
							<div class="chklisthdr">
								<span><?php echo $value['header'] ?></span>
							</div>
							<div class="chklisttext">
								<?php echo $value['text'] ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
		// Javascript
		?>
		<script type="text/javascript">
		$(function(){
			$(".doneBtn").tooltip2({ tipClass: 'tooltip4sm', position: 'top center' });
		});

		// Save project setting (e.g., auto-numbering) when user clicks checkbox in optional modules section
		function saveProjectSetting(ob,name,checkedValue,uncheckedValue,reloadPage,anchor) {
			if (ob.is('button')) {
				// Get value from button attribute
				var value = (ob.attr('checked') == 'checked') ? uncheckedValue : checkedValue;
			} else {
				// Get value on checkbox checked status
				var value = ob.prop('checked') ? checkedValue : uncheckedValue;
			}
			$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, { name: name, value: value }, function(data){
				if (data != '1') {
					alert('data: "' + data + '"');
					alert(woops);
				} else {
					ob.parent().find('.savedMsg:first').css({'visibility':'visible'});
					if (reloadPage) {
						// For certain settings, append the URL with a msg
						var url_append = "";
						// Determine how to reload the page
						setTimeout(function(){
							if (getParameterByName('msg') == '' && url_append == '') {
								// Reload page
								window.location.reload();
							} else {
								// If msg is in query string, then don't do regular redirect because it'll redisplay msg again
								var url = app_path_webroot + page + "?pid=" + pid + url_append;
								if (anchor != null) url += "&z="+Math.random()+"#"+anchor;
								window.location.href = url;
							}
						},200);
					} else {
						setTimeout(function(){
							ob.parent().find('.savedMsg:first').css({'visibility':'hidden'});
						},2000);
					}
				}
			});
		}

		// When user clicks "I'm Done" button on Setup Checklist page
		function doDoneBtn(name,action,optionalSaveValue) {
			// Ensure that name exists
			if (name == '') return;
			// Set optional save value
			if (optionalSaveValue == null) optionalSaveValue = "";
			// Set action
			action = (action == 1) ? 'add' : 'remove';
			// Change icon and text
			$('#btn-'+name).hide();
			// Save the user-defined value
			$.post(app_path_webroot+'ProjectSetup/checkmark_ajax.php?pid='+pid, { name: name, action: action, optionalSaveValue: optionalSaveValue }, function(data){
				if (data != '1') {
					if (action == 'add') {
						$('#btn-'+name).show();
					}
					alert(woops);
				} else if (action == 'remove') {
					window.location.href = app_path_webroot+page+'?pid='+pid;
				} else if (action == 'add') {
					// Increment the steps completed at top of page
					var stepsCompleted = $('#stepsCompleted').text()*1 + 1;
					var stepsTotal = $('#stepsTotal').text()*1;
					if (stepsCompleted > stepsTotal) stepsCompleted = stepsTotal;
					$('#stepsCompleted').html(stepsCompleted);
					// Success
					if (optionalSaveValue === "") {
						// Change icon
						$('#img-'+name).prop('src', app_path_images+'checkbox_checked.png');
						$('#lbl-'+name).html('<?php echo cleanHtml($lang['setup_03']) ?>');
						$('#lbl-'+name).css('color','green');
						$('#lbl-'+name).next('.chklist_comp').html('<a href="javascript:;" onclick="doDoneBtn(\''+name+'\',0);"><?php echo cleanHtml($lang['setup_04']) ?></a>');
						$(".tooltip4sm").css('display','none');
					} else {
						// Change icon and reload page
						$('#lbl-'+name).html('');
						window.location.href = app_path_webroot+page+'?pid='+pid;
					}
				}
			});
		}

		// Prompt user to confirm if they want to turn off longitudinal (because their other arms/events will get orphaned)
		function confirmUndoLongitudinal() {
			simpleDialog(null,null,'longiConfirmDialog',null,null,'<?php echo cleanHtml($lang['global_53']) ?>',"saveProjectSetting($('#setupLongiBtn'),'repeatforms','1','0',1);",'<?php echo cleanHtml($lang['control_center_153']) ?>');
		}

		// Prompt user to confirm if they want to turn off survey usage (because their surveys will get orphaned)
		function confirmUndoEnableSurveys() {
			simpleDialog(null,null,'useSurveysConfirmDialog',null,null,'<?php echo cleanHtml($lang['global_53']) ?>',"saveProjectSetting($('#setupEnableSurveysBtn'),'surveys_enabled','1','0',1);",'<?php echo cleanHtml($lang['control_center_153']) ?>');
		}

		// Change color of "twilio_enabled" row in dialog to enable Twilio services
		function enableTwilioRowColor() {
			var ob = $('#TwilioEnableDialog select[name="twilio_enabled"]');
			var enable = ob.val();
			if (enable == '1') {
				ob.parents('tr:first').children().removeClass('red').addClass('darkgreen');
			} else {
				ob.parents('tr:first').children().removeClass('darkgreen').addClass('red');
			}
		}

		// Dialog to enable/disable Twilio services
		function dialogTwilioEnable() {
			$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, { action: 'view', setting: 'twilio_enabled' }, function(data){
				if (data == '0') {
					alert(woops);
					return;
				}
				initDialog('TwilioEnableDialog');
				$('#TwilioEnableDialog')
					.html(data)
					.dialog({ bgiframe: true, modal: true, width: 800, title: '<?php echo cleanHtml($lang['survey_711']) ?>', buttons: {
					<?php if (SUPER_USER || (!$twilio_enabled_by_super_users_only && $user_rights['design'])) { ?>
						'<?php echo cleanHtml($lang['global_53']) ?>': function() {
							$(this).dialog('close');
						},
						'<?php echo cleanHtml($lang['pub_085']) ?>': function() {
							// Ajax call
							showProgress(1);
							$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, $('#twilio_setup_form').serializeObject(), function(data){
								showProgress(0,0);
								if (data == '0' || data == '') {
									alert(woops);
								} else if (data == '1') {
									$('#TwilioEnableDialog').dialog('close');
									setTimeout(function(){
										window.location.href = app_path_webroot + page + "?pid=" + pid + "&msg=twilio_enabled&z="+Math.random()+"#setupChklist-modules";
									},200);
								} else {
									simpleDialog(data,'<?php echo cleanHtml($lang['global_01']) ?>',null,550,"$('#TwilioEnableDialog').dialog('close');showProgress(1);dialogTwilioEnable();showProgress(0,0);");
								}
							});
						}
					<?php } ?>
				}});
				fitDialog($('#TwilioEnableDialog'));
				$('#TwilioEnableDialog select[name="twilio_enabled"]').focus();
			});
		}

		// Dialog to set up settings for Twilio services
		function dialogTwilioSetup() {
			$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, { action: 'view', setting: 'twilio_setup' }, function(data){
				if (data == '0') {
					alert(woops);
					return;
				}
				initDialog('TwilioEnableDialog');
				$('#TwilioEnableDialog')
					.html(data)
					.dialog({ bgiframe: true, modal: true, width: 800, title: '<?php echo cleanHtml($lang['survey_711']) ?>', buttons: {
					'<?php echo cleanHtml($lang['global_53']) ?>': function() {
						$(this).dialog('close');
					},
					'<?php echo cleanHtml($lang['pub_085']) ?>': function() {
						// Make sure at least one checkbox is selected
						if ($('td#twilio_options_checkboxes input[type="checkbox"]:checked').length < 1) {
							simpleDialog('<?php echo cleanHtml($lang['survey_904']) ?>');
							return;
						}
						// Make sure the invitation preference selected has been checked as a checkbox (excluding EMAIL)
						var twilio_default_delivery_preference = $('#TwilioEnableDialog select[name="twilio_default_delivery_preference"] option:selected').val();
						if (twilio_default_delivery_preference != 'EMAIL') {
							var twilio_default_delivery_preference2 = 'twilio_option_'+twilio_default_delivery_preference.toLowerCase();
							if (!$('#TwilioEnableDialog input[name="'+twilio_default_delivery_preference2+'"][type="checkbox"]:checked').length) {
								simpleDialog('<?php echo cleanHtml($lang['survey_926']) ?>');
								return;
							}
						}
						// Ajax call
						showProgress(1);
						$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, $('#twilio_setup_form').serializeObject(), function(data){
							showProgress(0,0);
							if (data == '0' || data == '') {
								alert(woops);
							} else if (data == '1') {
								$('#TwilioEnableDialog').dialog('close');
								setTimeout(function(){
									window.location.href = app_path_webroot + page + "?pid=" + pid + "&msg=1";
								},200);
							} else {
								simpleDialog(data,'<?php echo cleanHtml($lang['global_01']) ?>',null,550,"$('#TwilioEnableDialog').dialog('close');showProgress(1);dialogTwilioEnable();showProgress(0,0);");
							}
						});
					}
				}});
				fitDialog($('#TwilioEnableDialog'));
				$('#TwilioEnableDialog select[name="twilio_voice_language"]').focus();
			});
		}

		// Dialog to enable/disable survey participant email field
		function dialogSurveyEmailField(enable) {
			if (enable) {
				// Prompt with dialog to enable the field
				$.post(app_path_webroot+'ProjectSetup/modify_project_setting_ajax.php?pid='+pid, { action: 'view', setting: 'survey_email_participant_field' }, function(data){
					if (data == '0') {
						alert(woops);
						return;
					}
					initDialog('surveyEmailFieldEnableDialog');
					$('#surveyEmailFieldEnableDialog')
						.html(data)
						.dialog({ bgiframe: true, modal: true, width: 600, title: '<?php echo cleanHtml($lang['setup_113']) ?>', buttons: {
						'<?php echo cleanHtml($lang['global_53']) ?>': function() {
							$(this).dialog('close');
						},
						'<?php echo cleanHtml($lang['pub_085']) ?>': function() {
							if ( $('#surveyPartEmailFieldName').val().length < 1) {
								simpleDialog('<?php echo cleanHtml($lang['setup_117']) ?>');
							} else {
								$('#surveyEmailFieldEnableDialog').dialog('close');
								saveProjectSetting($('#enableSurveyPartEmailFieldBtn'),'survey_email_participant_field',$('#surveyPartEmailFieldName').val(),'',1);
							}
						}
					}});
				});
			} else {
				// Prompt with dialog to disable the field
				simpleDialog('<?php echo cleanHtml($lang['setup_118']) ?>','<?php echo cleanHtml($lang['setup_119']." \"$survey_email_participant_field\"".$lang['questionmark']) ?>',null,null,null,'<?php echo cleanHtml($lang['global_53']) ?>',"saveProjectSetting($('#enableSurveyPartEmailFieldBtn'),'survey_email_participant_field','','',1); ",'<?php echo cleanHtml($lang['setup_120']) ?>');
			}
		}

		// Dialog to open repeating forms/events dialog
		function dialogRepeatingInstance() {
			$.post(app_path_webroot+'index.php?pid='+pid+'&route=RepeatInstanceController:renderSetup', { }, function(data){
				if (data == '0') {
					alert(woops);
					return;
				}
				initDialog('repeatingInstanceEnableDialog');
				$('#repeatingInstanceEnableDialog').html(data);
				$('#repeatingInstanceEnableDialog').dialog({ bgiframe: true, modal: true, width: (longitudinal ? 850 : 700), open: function(){ fitDialog(this) }, title: '<?php echo cleanHtml($longitudinal ? $lang['setup_146'] : $lang['setup_145']) ?>', buttons: {
					'<?php echo cleanHtml($lang['global_53']) ?>': function() {
						$(this).dialog('close');
					},
					'<?php echo cleanHtml($lang['pub_085']) ?>': function() {
						// Make sure we don't have any repeating forms with no forms selected
						var errors = 0;
						$('#repeatingInstanceEnableDialog .repeat_select option[value="PARTIAL"]:selected').each(function(){
							var tr = $(this).parents('tr:first');
							if (!$('.repeat_form_chkbox:checked', tr).length) errors++;
						});
						if (errors > 0) {
							simpleDialog('<?php echo cleanHtml($lang['setup_161']) ?>');
							return;
						}
						// Save via ajax
						$('#repeatingInstanceEnableDialog').dialog('close');
						$.post(app_path_webroot+'index.php?pid='+pid+'&route=RepeatInstanceController:saveSetup',$('#repeat_instance_setup_form').serializeObject(),function(data){
							if (data == '0') {
								alert(woops);
								return;
							}
							$('#repeatingInstanceEnableDialog').remove();
							simpleDialog('<img src="'+app_path_images+'tick.png"> <span style="font-size:14px;color:green;"><?php echo cleanHtml($lang['setup_157']) ?></span>','<?php echo cleanHtml($lang['survey_605']) ?>',null,null,function(){ window.location.reload(); },'<?php echo cleanHtml($lang['calendar_popup_01']) ?>');
							setTimeout(function(){ window.location.reload(); },2500);
						});
					}
				}});
			});
		}
		
		// Action when selecting repeating event/form option
		function showEventRepeatingForms(ob,event_id) {
			var tr = $(ob).parents('tr:first');
			if ($(ob).val() == 'PARTIAL') {
				$('input', tr).prop('disabled', false);
				$('.repeat_event_form_div_parent', tr).removeClass('text-muted-more');
			} else {
				$('input', tr).prop('disabled', true);
				$('.repeat_event_form_div_parent', tr).addClass('text-muted-more');
				// Check all instruments if selecting Entire Event
				if ($(ob).val() == 'WHOLE') {
					$('input', tr).prop('checked', true);
				}
			}			
			if ($(ob).val() == '') {
				$('img', tr).addClass('hide');
				$('.text-success-more', tr).addClass('text-danger').removeClass('text-success-more');
				// Uncheck all instruments if selecting Not Repeating
				$('input', tr).prop('checked', false);
			} else {
				$('img', tr).removeClass('hide');
				$('.text-danger', tr).addClass('text-success-more').removeClass('text-danger');
			}
		}
		
		// Action when clicking checkbox of repeating form option
		function setRepeatingFormsLabel(ob) {
			var tr = $(ob).parents('tr:first');
			if ($(ob).prop('checked')) {
				$('.text-danger', tr).addClass('text-success-more').removeClass('text-danger');
			} else {
				$('.text-success-more', tr).addClass('text-danger').removeClass('text-success-more');
			}
		}
		</script>
		<?php
	}

}
