// On pageload
$(function(){

	// Make all text fields submit form when click Enter on them
	$(':input').keydown(function(e) {
		if (this.type == 'checkbox' && e.which == 13) {
			return false;
		} else if (this.type == 'text' && e.which == 13) {
			// First check secondary id field (if exists on page) and don't allow form submission since we need to wait for ajax response
			if (secondary_pk != '' && $('#form :input[name="'+secondary_pk+'"]').length && this.name == secondary_pk) {
				$('#form :input[name="'+secondary_pk+'"]').trigger('blur');
				return false;
			}
			// Do not submit the form is this is an auto-suggest field being clicked Enter on
			else if ($(this).hasClass('autosug-search') || $(this).hasClass('rc-autocomplete')) {
				return false;
			} else {
				// Make sure we validate the field first, if has validation, before submitting the form. This will not fix the value in
				// all cases if the value has incorrect format, but it will sometimes.
				$(this).trigger('blur');
				// Submit form normally when pressing Enter key in text field
				if ($('#field_validation_error_state').val() == '0') {
					dataEntrySubmit($('form#form :input[name="submit-btn-saverecord"]'));
				}
			}
		}
	});
	
	// Hack to un-truncate long select options: http://stackoverflow.com/a/19734474/1402028
	if (isIOS) $("#questiontable select").append('<optgroup label=""></optgroup>');

	// Enable action tags
	enableActionTags();

	// Enable auto-complete for drop-downs
	enableDropdownAutocomplete();

	// Survey responses: Add 'tooltip' popup for user list of those who contributed to a survey response
	$('.resp_users_contribute').tooltip2({
		tip: '#tooltip',
		tipClass: 'tooltip4',
		position: 'top center',
		delay: 0
	});

	// Scroll to position on page if scrollTop provided in query string
	var scrollTopNum = getParameterByName('scrollTop');
	if (isNumeric(scrollTopNum)) $(window).scrollTop(scrollTopNum);

	// Enable green row highlight for data entry form table
	enableDataEntryRowHighlight();

	// Open Save button tooltip	fixed at top-right of data entry forms
	displayFormSaveBtnTooltip();

	// PUT FOCUS ON FIRST FIELD IN FORM (but not if we're putting focus on another field first)
	setTimeout(function(){ // Do a slight delay to deal with some issues where jQuery will be moved fields around after this (e.g., randomization button)
		// Do not do this for the mobile view since it causes the keyboard to open on text fields
		if (getParameterByName('fldfocus') == '') {
			// Do not put focus if a dialog is open
			var dqDialogOpen = ($("#dq_rules_violated").length && $("#dq_rules_violated").hasClass("ui-dialog-content") && $("#dq_rules_violated").dialog("isOpen"));
			var reqFldDialogOpen = ($("#reqPopup").length && $("#reqPopup").hasClass("ui-dialog-content") && $("#reqPopup").dialog("isOpen"));
			if (dqDialogOpen || reqFldDialogOpen) return false;
			// Loop through fields to find the first
			$('form#form .slider, form#form input:visible, form#form textarea:visible, form#form select:visible, form#form a.fileuploadlink:visible').each(function(){
				var thisfld = $(this);
				// Skip the DAG drop-down, calc fields, and the invisible input companions for radios
				if (thisfld.attr('name') != '__GROUPID__' && !thisfld.hasClass('choicevert0') && !(thisfld.attr('type') == 'text' && thisfld.attr('readonly') == 'readonly')) {
					try {
						if (thisfld.hasClass('slider')) {
							thisfld.find(':first-child').trigger('focus');
						} else {
							thisfld.trigger('focus');
						}
						// If a drop-down autocomplete field is selected, then hide the drop-down options
						if (thisfld.hasClass('rc-autocomplete') && thisfld.val() == '') {
							$('ul.ui-autocomplete').hide();
						}
					} catch (e) { }
					return false;
				}
			});
		}
	},10);

	// Hide or disable fields if using special annotation
	triggerActionTags();

	// If user modifies any values on the data entry form, set flag to TRUE
	$('form#form').change(function(e){
		dataEntryFormValuesChanged = true;
	});

	// If user tries to navigate off page after modifying any values on the data entry form, then stop and prompt user if they really want to leave page
	$('a').click(function(e){
		// If the user has the ability to modify the form
		var userCanModifyData = ( $('#form :input[name="submit-btn-saverecord"]').length && (!$('#__LOCKRECORD__').length || ($('#__LOCKRECORD__').length && !$('#__LOCKRECORD__').prop('disabled'))) );
		// If form values have changed...
		if (dataEntryFormValuesChanged && userCanModifyData) {
			// Ignore if has 'rc_attach' class, which is an attachment link
			if ($(this).hasClass('rc_attach')) {
				// Temporarily set to false, then back to true right afterward (to allow us to bypass the window.onbeforeunload function that would otherwise catch it)
				dataEntryFormValuesChanged = false;
				setTimeout(function(){
					dataEntryFormValuesChanged = true;
				}, 1000);
				return true;
			}
			// If is not a proper link but is mailto: or javascript:, then stop here
			var link = this;
			var href = trim(link.href.toLowerCase());
			var target = ($(link).attr('target') == null) ? '' : trim($(link).attr('target').toLowerCase());
			if (href != '#' && href.indexOf(window.location.href.toLowerCase()+'#') !== 0 && href.indexOf('javascript:') !== 0
				&& href.indexOf('mailto:') !== 0 && target != '_blank') {
				// Prevent navigating to page
				e.preventDefault();
				// Display confirmation dialog
				$('#stayOnPageReminderDialog').dialog({ bgiframe: true, modal: true, width: 650,
					title: '<img src="'+app_path_images+'exclamation_red.png" style="vertical-align:middle;"> <span style="color:#800000;vertical-align:middle;">'+langDlgSaveDataTitle+'</span>',
					buttons: [{
						text: langStayOnPage,
						click: function() { $(this).dialog("close"); }
					},{
						text: langLeavePage,
						"class": 'dataEntryLeavePageBtn',
						click: function() {
							// Disable the onbeforeunload so that we don't get an alert before we leave
							window.onbeforeunload = function() { }
							// Redirect to next page
							window.location.href = link.href;
						}
					},{
						text: langSaveLeavePage,
						"class": 'dataEntrySaveLeavePageBtn',
						click: function() {
							// Add element to form to denote how to redirect after saving
							appendHiddenInputToForm('save-and-redirect',link.href);
							// Save form
							dataEntrySubmit($('form#form :input[name="submit-btn-savecontinue"]'));
							return false;
						}
					}]
				});
			}
		}
	});

	// Set autocomplete for BioPortal ontology search for ALL fields on a page
	initAllWebServiceAutoSuggest();

	// Make sure dropdowns don't get too wide so that they create horizontal scrollbar
	shrinkWideDropDowns();
	
	// Enable repeating forms buttons
	$('.formMenuList .btnAddRptEv').on({
		mouseenter: function(){
			$(this).removeClass('btn-defaultrc').addClass('btn-success');
		},
		mouseleave: function () {
			$(this).removeClass('btn-success').addClass('btn-defaultrc');
		}
	});
	
	// Set click action for repeating forms drop-down list
	$('#repeatInstanceDropdownDiv ul li a').click(function(){
		$('#repeatInstanceDropdown>span').html( $(this).html() + '<img src="'+app_path_images+'arrow_state_grey_expanded.png" style="margin-left:6px;vertical-align:middle;position:relative;top:-1px;">' );
		$('#repeatInstanceDropdownDiv').hide();
	});
	
	// Set "Save and ..." button trigger for popup
	$('.btn-saveand').popover({ container: 'body', html: true });
});

// If user tries to close the page after modifying any values on the data entry form, then stop and prompt user if they really want to leave page
window.onbeforeunload = function() {
	// If form values have changed...
	if (dataEntryFormValuesChanged) {
		var separator = "#########################################\n";
		// Prompt user with confirmation
		return separator + langDlgSaveDataTitleCaps + "\n\n" + langDlgSaveDataMsg + "\n" + separator;
	}
}

// Open Save button tooltip	fixed at top-right of data entry forms
function displayFormSaveBtnTooltip() {
	// If save buttons are not displayed (e.g., form is locked), then don't display tooltip
	if ($('#__SUBMITBUTTONS__-div').length == 0 || $('#__SUBMITBUTTONS__-div').css('display') == 'none') return;
	// Hide if showing mobile friendly page
	var scrollBarWidth = ($(document).height() > $(window).height()) ? getScrollBarWidth() : 0;
	if ($(window).width()+scrollBarWidth <= maxMobileWidth) {
		$('#formSaveTip').hide();
		return;
	}
	// Copy all the buttons from bottom of page and put in div
	$('#formSaveTip').html( $('#__SUBMITBUTTONS__-div').html() );
	$('#formSaveTip').find('button.btn-primary').css({'font-size':'13px'});
	$('#formSaveTip .btn-group').css({'display':'block'});
	$('#formSaveTip .btn-saveand').attr('data-placement','bottom');
	// Open tooltip	fixed at top-right of page
	$('#formSaveTip').css({
		'position': "fixed",
		'left': ($('form#form #questiontable').offset().left + $('form#form #questiontable').outerWidth() - 100) + "px"
	}).show();
}