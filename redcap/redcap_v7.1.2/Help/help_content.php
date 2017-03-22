<div id="HELP_CONTENT">
<style type="text/css">
.faqq, .faqq p { font-weight:bold; font-size:15px; margin-top: 20px; line-height: 1.3em; color: #A00000 }
.faqa, .faqa p { font-size:14px; margin: 3px 0 10px; line-height: 1.3em; }
.faqa a:link, .faqa a:visited, .faqa a:active, .faqa a:hover { font-size:14px; text-decoration: underline; }
.faqm { font-size:14px; color:#A00000; margin: 6px 0 0; }
h3 { color: #C00000 !important; margin-top: 30px; cursor: pointer; cursor: hand;  }
h2 { color: #A00000 !important; cursor: pointer; cursor: hand;  }
#HELP_CONTENT td { padding: 5px !important;  border: 1px solid #ccc !important;}
.spacediv, .subspacediv { padding-top: 90px; }
.ddlabel { font-size:15px; line-height: 1.3em; margin:5px 10px; }
.btnlbl { color: #C00000; }
.ddhighlight { color: #D00000 !important; }
.spaceli a { font-weight:bold !important; line-height: 1; }
.subspaceli { height: 15px; margin-left: 15px; }
#faqDropdownParent { background-color: #f9f9f9; border: 1px solid #e5e5e5; padding:3px 10px 10px; width: 100%; max-width: 860px;}
#faqDropdownParent.floating { position: fixed; top: 50px; }
.faq_title { float:left; font-size:16px; font-weight:bold; color: #C00000; padding: 15px 30px 10px 10px; }
.faq_dd_parent { float:left; padding-top: 10px; }
.firstsubspace { padding-top: 0; }
</style>
<script type="text/javascript">
var faqoffset = $('#HELP_CONTENT').offset().top;
$(function(){
	// Floating navigation div
	$(window).scroll( function() {
        if ($(window).scrollTop() > faqoffset)
            $('#faqDropdownParent').addClass('floating');
        else
            $('#faqDropdownParent').removeClass('floating');
    });
	// Go to specified section
	var hashLoc = window.location.href.indexOf("#");
	if (hashLoc > -1) {
		var subSpaceId = window.location.href.substring(hashLoc+1);
		selectSection(subSpaceId.replace(/s/g,''));
	}
});
// Active when space is selected in drop-down
function selectSection(subSpaceId) {
	// Change text of drop-down selection
	$('#faqDropdownMenu span.btnlbl').html( $('#dd'+subSpaceId).text() );
	// Highlight the selected choice
	$('.ddhighlight').removeClass('ddhighlight');
	$('#dd'+subSpaceId).addClass('ddhighlight');
	// Navigate to the specific section
	setTimeout(function(){
		window.location.href = window.location.pathname.split("/").pop() + window.location.search + '#ss'+subSpaceId;
	},400);
}
</script>
	<div id="faqDropdownParent" class="">
		<div class="faq_title">REDCap Help &amp; FAQ</div>
		<div class="faq_dd_parent">
			<span class="ddlabel">Select a topic:</span>
			<span class="dropdown">
				<button class="btn btn-defaultrc dropdown-toggle" type="button" id="faqDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<span class="btnlbl">General</span>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="faqDropdownMenu">
																	<li class="spaceli" onclick="selectSection(42)"><a id="dd42" href="javascript:;">General</a></li>
													<li class="subspaceli" onclick="selectSection(43)"><a id="dd43" href="javascript:;"> - Mobile Devices</a></li>
													<li class="subspaceli" onclick="selectSection(45)"><a id="dd45" href="javascript:;"> - Language Modules</a></li>
													<li class="subspaceli" onclick="selectSection(46)"><a id="dd46" href="javascript:;"> - Licensing</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(37)"><a id="dd37" href="javascript:;">Project Setup / Design</a></li>
													<li class="subspaceli" onclick="selectSection(41)"><a id="dd41" href="javascript:;"> - Survey Design</a></li>
													<li class="subspaceli" onclick="selectSection(47)"><a id="dd47" href="javascript:;"> - Longitudinal</a></li>
													<li class="subspaceli" onclick="selectSection(48)"><a id="dd48" href="javascript:;"> - Copy a Project</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(39)"><a id="dd39" href="javascript:;">Data Collection Instrument Design</a></li>
													<li class="subspaceli" onclick="selectSection(49)"><a id="dd49" href="javascript:;"> - Online Designer / Data Dictionary</a></li>
													<li class="subspaceli" onclick="selectSection(50)"><a id="dd50" href="javascript:;"> - Field Types and Validation</a></li>
													<li class="subspaceli" onclick="selectSection(52)"><a id="dd52" href="javascript:;"> - Matrix Fields</a></li>
													<li class="subspaceli" onclick="selectSection(53)"><a id="dd53" href="javascript:;"> - Piping</a></li>
													<li class="subspaceli" onclick="selectSection(54)"><a id="dd54" href="javascript:;"> - Copy / Share Data Collection Instruments</a></li>
													<li class="subspaceli" onclick="selectSection(78)"><a id="dd78" href="javascript:;"> - Calculations</a></li>
													<li class="subspaceli" onclick="selectSection(79)"><a id="dd79" href="javascript:;"> - Branching Logic</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(55)"><a id="dd55" href="javascript:;">Data Entry / Collection</a></li>
													<li class="subspaceli" onclick="selectSection(56)"><a id="dd56" href="javascript:;"> - Surveys: Anonymous surveys</a></li>
													<li class="subspaceli" onclick="selectSection(57)"><a id="dd57" href="javascript:;"> - Surveys: Invite Participants</a></li>
													<li class="subspaceli" onclick="selectSection(58)"><a id="dd58" href="javascript:;"> - Surveys: Automated Survey Invitations</a></li>
													<li class="subspaceli" onclick="selectSection(59)"><a id="dd59" href="javascript:;"> - Surveys: How to pre-fill survey questions</a></li>
													<li class="subspaceli" onclick="selectSection(60)"><a id="dd60" href="javascript:;"> - Double Data Entry</a></li>
													<li class="subspaceli" onclick="selectSection(61)"><a id="dd61" href="javascript:;"> - Data Resolution Workflow</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(62)"><a id="dd62" href="javascript:;">Applications</a></li>
													<li class="subspaceli" onclick="selectSection(63)"><a id="dd63" href="javascript:;"> - Data Exports, Reports, and Stats</a></li>
													<li class="subspaceli" onclick="selectSection(64)"><a id="dd64" href="javascript:;"> - Data Import Tool</a></li>
													<li class="subspaceli" onclick="selectSection(65)"><a id="dd65" href="javascript:;"> - File Repository</a></li>
													<li class="subspaceli" onclick="selectSection(66)"><a id="dd66" href="javascript:;"> - User Rights</a></li>
													<li class="subspaceli" onclick="selectSection(67)"><a id="dd67" href="javascript:;"> - Data Access Groups</a></li>
													<li class="subspaceli" onclick="selectSection(68)"><a id="dd68" href="javascript:;"> - Data Quality Module</a></li>
													<li class="subspaceli" onclick="selectSection(69)"><a id="dd69" href="javascript:;"> - Functions for logic in Report filtering, Survey Queue, Data Quality, and ASIs</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(70)"><a id="dd70" href="javascript:;">Making Production Changes</a></li>
																	<li role="separator" class="divider"></li>						<li class="spaceli" onclick="selectSection(71)"><a id="dd71" href="javascript:;">Optional Modules and Services</a></li>
													<li class="subspaceli" onclick="selectSection(72)"><a id="dd72" href="javascript:;"> - API / Data Entry Trigger</a></li>
													<li class="subspaceli" onclick="selectSection(73)"><a id="dd73" href="javascript:;"> - Mobile App for iOS and Android</a></li>
													<li class="subspaceli" onclick="selectSection(74)"><a id="dd74" href="javascript:;"> - Randomization Module</a></li>
													<li class="subspaceli" onclick="selectSection(75)"><a id="dd75" href="javascript:;"> - Shared Library</a></li>
															</ul>
			</span>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="faq_spacer"></div><div id="faq_container"><div class="spacediv firstsubspace" id="s42"><div class="subspacediv firstsubspace" id="ss42"><h2 onclick="selectSection(42);window.location.href='#s42';">General</h2>
<div id="q1196" class="faqq">Can I transition data collected in other applications (ex: MS Access or Excel) into REDCap?</div>
<div class="faqa"><p>It depends on the project design and application you are transitioning from. For example, there are a few options to get metadata out of MS Access to facilitate the creation of a REDCap data dictionary:</p><p>For Access 2003 or earlier, there is a third-party software (CSD Tools) that can export field names, types, and descriptions to MS Excel. You can also extract this information yourself using MS Access. Table names can be queried from the hidden system table "MSysObjects", and a table's metadata can be accessed in VBA using the Fields collection of a DAO Recordset, ADO Recordset, or DAO TableDef.</p><p>The extracted metadata won't give you a complete REDCap data dictionary, but at least it's a start.</p><p>Once you have a REDCap project programmed, data can be imported using the Data Import Tool.</p><p>For additional details, contact your local REDCap Administrator.</p></div>
<div id="q1206" class="faqq">What can REDCap Administrators do that REDCap end users can't?</div>
<div class="faqa"><p>REDCap administrators, also knows as superusers, oversee the REDCap system and its settings. They often have the ability to do things that REDCap end users (regular users) can't do directly. Each REDCap system is overseen by a different group of administrators because each system is independently maintained and supported.  The following is a list of some common administrator capabilities and responsibilities.  Please contact your system's REDCap administrators if you would like to explore which of the following capabilities are available for your system.</p><ul><li>Project-specific tasks<ul><li>At some institutions, only superusers can create projects.</li><li>At some institutions, only superusers can move a project to production.</li><li>Add custom text to the top of the Home page of a project.</li><li>Add custom text to the top of all Data Entry pages of a project.</li><li>Add custom logo and institution name to the top of every page of a project.</li><li>Add grant to be cited.</li><li>Display a different language for text within a project. The languages available vary by institution.</li><li>Turn Double Data Entry on and off.</li><li>Customize the date shift range for date shifting de-identification.</li><li>Approve API token requests.</li><li>Delete all API tokens.</li><li>Create an SQL field, generally used to create a dynamic dropdown list with data drawn either from the same project or another.</li></ul></li></ul><ul><li>Additional project-specific tasks for projects in production status<ul><li>At some institutions, only superusers can approve some or all production changes, a.k.a. moving drafted changes to production.</li><li>Delete events.</li><li>Enable/Disable Main Project Settings: Use Longitudinal and Use Surveys</li><li>Erase all data.</li><li>Move the project back to development status.</li><li>Delete the project.</li></ul></li></ul><ul><li>User-specific tasks<ul><li>Suspend and unsuspend users from all of REDCap. (Note, however, that expiring a users' access to a specific project does not require a REDCap administrator.)</li><li>For sites that use REDCap's table-based, local authentication, reset the password for a user.</li><li>Update the email address associated with an account for a user, in case that user is neither able to log in nor has access to the email address associated with their account.</li></ul></li></ul><ul><li>Cross-project tasks<ul><li>Create project templates.</li></ul></li></ul></div>
<div id="q1708" class="faqq"><p>How much experience with programming, networking and/or database construction is required to use REDCap?</p></div>
<div class="faqa"><p>No programming, networking or database experience is needed to use REDCap. Simple design interfaces within REDCap handle all of these details automatically.</p><p>It is recommended that once designed, you have a statistician review your project. It is important to consider the planned statistical analysis before collecting any data. A statistician can help assure that you are collecting the appropriate fields, in the appropriate format necessary to perform the needed analysis.</p></div>
<div id="q1204" class="faqq">Where can I suggest a new REDCap feature?</div>
<div class="faqa">You can suggest a new REDCap feature by clicking on the "Suggest a New Feature" link located at the bottom of the left hand pane of a project. The link is under the "Help &amp; Information" header.</div>
<div id="q1194" class="faqq">Can I still maintain a paper trail for my study, even if I use REDCap?</div>
<div class="faqa">You can use paper forms to collect data first and then enter into REDCap.  All REDCap data collection instruments can also be downloaded and printed with data entered as a universal PDF file.</div>
</div><div class="subspacediv " id="ss43"><h3 onclick="selectSection(43);window.location.href='#ss43';">Mobile Devices</h3>
<div id="q1202" class="faqq">I won't have internet access where I need to use REDCap. Is there an offline version?</div>
<div class="faqa"><p>If you don't have internet access, you cannot use online REDCap. In such a situation, there are three potential methods to collect data for use in REDCap later. Those three methods are described below.</p><p>The lack of internet coverage in remote areas could be a significant challenge to using REDCap. There are absolutely success stories in similar situations. We know of several studies operating REDCap in the field in South Africa and in rural areas of South America. But only you can determine which of the following options is feasible for your work.</p><p>1) The REDCap Mobile App can be downloaded to any mobile device (e.g. smart phones, tablets) and used for offline data collection. It’s available in both Android and Apple app stores. The App is a true data collection tool; it has REDCap’s primary functionality, just offline. (It’s therefore slightly more limited functionality to online REDCap.) The App can ‘sync’ your offline data back to your real REDCap project when you return to internet connectivity. The ‘sync’ is a mass import of all the data you collected while offline. The App can send that back to your online REDCap project. Refer to the section 'Q: What is the REDCap mobile app?' to learn more about this separate feature.</p><p>2) Data can certainly be stored in another format and then uploaded into REDCap when the internet connection is reliable. This can be another alternative - to temporarily store the data in another file type and then transfer into REDCap incrementally. Though not ideal, you use another program offline (or even have paper copies of the instruments) to collect data in areas of low internet coverage. You could then enter that data in REDCap when the connection is more stable and use REDCap for an electronic record and to prepare the data for analysis.</p><p>3) Depending on your specific project, you might also be able to invest in purchasing a portable wireless router to act as an internet hotspot and enter data online in the field. This would allow you full use of the application from any low-coverage area. REDCap is accessible from any device having internet access, including the browsers of any smart phones or tablets (no Mobile App needed here). By providing your own internet access, the data could be stored securely (and directly in REDCap) from the start and there’s no need to transfer it from hard copies later.</p></div>
<div id="q1198" class="faqq">Does REDCap work on mobile devices like tablets and smart phones?</div>
<div class="faqa"><p>Yes! REDCap is entirely web-based; you can access it from any browser, anywhere on the planet, at any time.</p><p>No separate app, download, or software installation is needed. The view will automatically be optimized for whatever device is being used.</p><p>REDCap is compatible with (and can be used on) desktop computers, laptops, tablets (including iPads), smart phones (both Android and Apple), and any other device having an internet connection. There are no specific requirements to run REDCap on any of these devices and no known compatibility issues.</p><p>On most tablets, the default view is the same as a desktop computer. All features are available.</p><p>On most phones, the default view is REDCap Mobile - a view focusing on data entry. Not all features are available in this view. Any time you are on a smart phone, you can switch to desktop view at any time to get the full use of REDCap.</p><p>NOTE: REDCap can also be used on mobile devices in areas having no internet connection. Refer to the section 'Q: What is the REDCap mobile app?' to learn more about this separate feature.</p></div>
</div><div class="subspacediv " id="ss45"><h3 onclick="selectSection(45);window.location.href='#ss45';">Language Modules</h3>
<div id="q1210" class="faqq">Can the survey buttons at the bottom of the page: 'Next Page', 'Submit' and the other descriptors: '*these fields are required', 'reset value', etc. appear in a different language (ex: Chinese) in a project with non-English language survey questions?</div>
<div class="faqa">In a project with Chinese or other non-English language enabled there are some things (e.g. 'Next Page' and 'Submit' buttons) that for technical reasons cannot be translated.  The researcher may add descriptive text fields at the end of each page to translate 'Next Page', 'Previous', and 'Submit' buttons as needed.</div>
<div id="q1212" class="faqq">Can I use a language translation file to change the wording in the calendar widget to display a different language (ex: Spanish "Hoy" instead of "Today")?</div>
<div class="faqa">Some features in REDCap, such as the calendar widget, are hard-coded javascript and/or 3rd party code and cannot be abstracted.</div>
<div id="q1208" class="faqq">Can I create projects forms in languages other than English?</div>
<div class="faqa">The label text displayed for individual fields on a survey or data entry form can be in any language. Setting the text label for non-English languages is the same with English text, in which you will set the text for that field in either the Data Dictionary or Online Designer. If you wish to view all the static instructional text in REDCap in a different language, this can be done if that language is supported in REDCap at your local institution.If you wish to utilize the Language Modules, contact your local REDCap Administrator about which languages are available.  They can switch a REDCap project over so that it will display the new language text instead of English.</div>
<div id="q1214" class="faqq">Can I use special Spanish characters in my REDCap forms?</div>
<div class="faqa">
	<p><br>
		Yes, you can type in Spanish characters like you normally would. However, it can happen that users or participants can't see these characters properly. In these cases the characters in question are replaced by a little black diamond with question mark in it. However, it is possible to "hard-code" your Spanish characters into REDCap. The table below displays the acceptable HTML codes. You can either use the friendly code variant or the numerical code variant. Just type in either code instead of the normal Spanish character.<br>
	</p><br>
	<p><br>
		A link to all the special characters supported is here: <a target="_blank" href="http://www.w3schools.com/html/html_symbols.asp">http://www.w3schools.com/html/html_symbols.asp</a><br>
	</p><br>
	<br><br><table>
	
	<tbody><tr>
		<td><br>
			Display<br>
		</td>
		<td><br>
			Friendly Code<br>
		</td>
		<td><br>
			Numerical Code<br>
		</td>
		<td><br>
			Description<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Á<br>
		</td>
		<td><br>
			&amp;Aacute;<br>
		</td>
		<td><br>
			&amp;#193;<br>
		</td>
		<td><br>
			Capital A-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			á<br>
		</td>
		<td><br>
			&amp;aacute;<br>
		</td>
		<td><br>
			&amp;#225;<br>
		</td>
		<td><br>
			Lowercase a-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			É<br>
		</td>
		<td><br>
			&amp;Eacute;<br>
		</td>
		<td><br>
			&amp;#201;<br>
		</td>
		<td><br>
			Capital E-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			é<br>
		</td>
		<td><br>
			&amp;eacute;<br>
		</td>
		<td><br>
			&amp;#233;<br>
		</td>
		<td><br>
			Lowercase e-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Í<br>
		</td>
		<td><br>
			&amp;Iacute;<br>
		</td>
		<td><br>
			&amp;#205;<br>
		</td>
		<td><br>
			Capital I-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			í<br>
		</td>
		<td><br>
			&amp;Iacute;<br>
		</td>
		<td><br>
			&amp;#237;<br>
		</td>
		<td><br>
			Lowercase i-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Ñ<br>
		</td>
		<td><br>
			&amp;Ntilde;<br>
		</td>
		<td><br>
			&amp;#209;<br>
		</td>
		<td><br>
			Capital N-tilde<br>
		</td>
	</tr>
	<tr>
		<td><br>
			ñ<br>
		</td>
		<td><br>
			&amp;ntilde;<br>
		</td>
		<td><br>
			&amp;#241;<br>
		</td>
		<td><br>
			Lowercase n-tilde<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Ó<br>
		</td>
		<td><br>
			&amp;Oacute;<br>
		</td>
		<td><br>
			&amp;#211;<br>
		</td>
		<td><br>
			Capital O-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			ó<br>
		</td>
		<td><br>
			&amp;oacute;<br>
		</td>
		<td><br>
			&amp;#243;<br>
		</td>
		<td><br>
			Lowercase o-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Ú<br>
		</td>
		<td><br>
			&amp;Uacute;<br>
		</td>
		<td><br>
			&amp;#218;<br>
		</td>
		<td><br>
			Capital U-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			ú<br>
		</td>
		<td><br>
			&amp;uacute;<br>
		</td>
		<td><br>
			&amp;#250;<br>
		</td>
		<td><br>
			Lowercase u-acute<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Ü<br>
		</td>
		<td><br>
			&amp;Uuml;<br>
		</td>
		<td><br>
			&amp;#220;<br>
		</td>
		<td><br>
			Capital U-umlaut<br>
		</td>
	</tr>
	<tr>
		<td><br>
			ü<br>
		</td>
		<td><br>
			&amp;uuml;<br>
		</td>
		<td><br>
			&amp;#252;<br>
		</td>
		<td><br>
			Lowercase u-umlaut<br>
		</td>
	</tr>
	<tr>
		<td><br>
			«<br>
		</td>
		<td><br>
			&amp;laquo;<br>
		</td>
		<td><br>
			&amp;#171;<br>
		</td>
		<td><br>
			Left angle quotes<br>
		</td>
	</tr>
	<tr>
		<td><br>
			»<br>
		</td>
		<td><br>
			&amp;raquo;<br>
		</td>
		<td><br>
			&amp;#187;<br>
		</td>
		<td><br>
			Right angle quotes<br>
		</td>
	</tr>
	<tr>
		<td><br>
			¿<br>
		</td>
		<td><br>
			&amp;iquest;<br>
		</td>
		<td><br>
			&amp;#191;<br>
		</td>
		<td><br>
			Inverted question  mark<br>
		</td>
	</tr>
	<tr>
		<td><br>
			¡<br>
		</td>
		<td><br>
			&amp;iexcl;<br>
		</td>
		<td><br>
			&amp;#161;<br>
		</td>
		<td><br>
			Inverted  exclamation point<br>
		</td>
	</tr>
	<tr>
		<td><br>
			€<br>
		</td>
		<td><br>
			<br>
		</td>
		<td><br>
			&amp;#128;<br>
		</td>
		<td><br>
			Euro<br>
		</td>
	</tr>
	
	</tbody></table>
</div>
</div><div class="subspacediv " id="ss46"><h3 onclick="selectSection(46);window.location.href='#ss46';">Licensing</h3>
<div id="q1218" class="faqq">How can I use REDCap to support a network of investigators?</div>
<div class="faqa"><p>A local installation of REDCap can support a grant-supported network of investigators if your institution holds the network grant even though investigators may be running sub-projects at other institutions. However, you should be very deliberate up front in determining the inclusion/exclusion criteria for projects and investigators who can utilize the local REDCap installation.  In your model, you need to ensure that you don’t have one set of support policies/pricing for ‘local’ researchers and another for ‘non-local’ researchers (presumably you’ll have network grant funding covering infrastructure and training support for the entire network).</p><p>You should think about how you will discontinue services and handle study data closeout should the network be disbanded at some point in the future. Finally, from a practical standpoint, it is recommended that you make sure you are proactive about establishing data sharing policies across the institutions within your network.  In some cases, failure of such policies to meet the needs of all network members has caused the group of network sites to install separately licensed versions of REDCap for data hosting, but still maintain economy of scale by setting up a unified training/support core for network investigators.</p></div>
<div id="q1216" class="faqq">Who, other than members of my institution, can use my licensed REDCap software?</div>
<div class="faqa">If you are coordinating a multi-center study where the PI is at your local institution, you are well within your rights to use REDCap to support the study. On the other hand, if you want to use your local REDCap installation to support researchers at another institution (for single- or multi-center studies) where you don’t have a local researcher involved in the study, this can be a violation of the licensing agreement.Offering external research teams the use of a REDCap installation on a fee-for-service basis (or even gratis) is strictly forbidden under the licensing model.</div>
</div></div><div class="spacediv " id="s37"><div class="subspacediv " id="ss37"><h2 onclick="selectSection(37);window.location.href='#s37';">Project Setup / Design</h2>
<div id="q1226" class="faqq">Are there specific requirements to set up a project?</div>
<div class="faqa"><p>For projects with surveys, you must complete the "Set up my survey" step in order to activate the Survey URL.  If this step is not complete, the following message will appear to on the "Manage Survey Participants page:  "Enable my surveys(s) NOTICE".  You cannot utilized the "Manage Survey Participants" page until you have first enable one or more surveys..."</p><p>The survey-related options, like Survey Settings and Notifications, can be accessed on the Project Setup &gt; Online Designer page.</p><p>For ALL projects, you must define a <strong>unique identifier</strong> as the first field on your first data entry form.  The data values entered into this field must be unique.  The system will not allow for duplicate entries. If you do not have a specific unique identifier, you can enable the option “Auto-numbering for records”.</p><p><strong>Examples of Unique Identifiers:</strong>  Study-assigned ID</p><p><strong>Examples of Non-Unique Identifiers: </strong> Names, Dates of Birth, Consent Dates</p><p>The unique identifier must be a 'text' field. In addition, please note that unique identifier values will be visible at the end of the URL -- and likely cached in web browsers -- as individual records are viewed or entered. (Example URL:  <a href="https://xxx.xxx.xxx/redcap/redcap_vx.x.x/data_entry.php?pid=xxx&amp;page=xxx&amp;id=ID_VARIABLE_VALUE.%29It">https://xxx.xxx.xxx/redcap/redcap_vx.x.x/data_entry.php?pid=xxx&amp;page=xxx&amp;id=ID_VARIABLE_VALUE.)</a> </p><p><strong>It is strongly recommended that you do not use Protected Health Information (PHI) Identifiers such as MRN or DOB+initials as the unique identifier.</strong>  This is an additional precaution to preserve research participant confidentiality from displaying in the URL and becoming cached.</p></div>
<div id="q1224" class="faqq">What steps do I have to complete to set up a project?</div>
<div class="faqa"><p>Depending on which project settings are enabled, you will have the following steps/modules to complete on the Project Set-up page:</p><table><tbody><tr><td></td><td>Surveys</td><td>Classic</td><td>Longitudinal</td></tr><tr><td>Main Project Settings<br></td><td>Yes</td><td>Yes</td><td>Yes</td></tr><tr><td>Design Data Collection Instruments<br></td><td>Yes</td><td>Yes</td><td>Yes</td></tr><tr><td>Survey-related options &gt; Survey settings<br></td><td>Yes</td><td></td><td></td></tr><tr><td>Define Events and Designate Instruments<br></td><td></td><td></td><td>Yes</td></tr><tr><td>Enable optional modules and customizations<br></td><td>Yes</td><td>Yes</td><td>Yes</td></tr><tr><td>User Rights and Permissions<br></td><td>Yes</td><td>Yes</td><td>Yes</td></tr><tr><td>Move to Production<br></td><td>Yes</td><td>Yes</td><td>Yes</td></tr></tbody></table></div>
<div id="q1236" class="faqq">What are Project Statuses?</div>
<div class="faqa"><p>All projects when first created start in <strong>Development</strong>.  In Development, you can design, build, and test your REDCap projects.  All design decisions can be made in real time and are implemented immediately to your project.  All survey and data entry features/functions can and should be tested.</p><p>From Development, you will move your project to <strong>Production</strong> by clicking the button on the Project Setup page.  All survey and data entry features/functions will be exactly the same as they are in development with the exception of certain Project Setup features.  Some project and form design updates will require contacting a REDCap Admin and/or submitting data collection instrument changes in Draft Mode.  Changes to data collection instruments in Draft Mode are not made to your project in real time.  After making updates, you must submit the changes for review.  Review and approval time will vary and are institution specific.</p><p>From Production, you can move the projects to the following statuses on the Project Setup &gt; Other Functionality page:</p><p><strong>Inactive:</strong>  Move the project to inactive status if data collection is complete. This will disable most project functionality, but data will remain available for export. Once inactive, the project can be moved back to production status at any time.</p><p><strong>Archive:</strong> Move the project to archive status if data collection is complete and/or you no longer wish to view on My Projects List. Similar to Inactive status, this will disable most project functionality. The project can only be accessed again by clicking the Show Archived Projects link at the bottom of the My Projects page. Once archived, the project can be moved back to production status at any time.</p></div>
<div id="q1234" class="faqq">What’s the difference between the unique identifier, secondary unique identifier and the redcap_survey_identifier?</div>
<div class="faqa">
	<p>The first variable listed in your project is the <strong>unique identifier</strong> which links all your data.</p><p>For any type of project, you must define the unique identifier field. This is the first field of the first instrument and if not using a template, the default is <strong>Record ID</strong> [record_id]. For projects where a survey is the first data collection instrument, the value must be numeric and auto-increments starting with the highest value in the project. If no records exist, it will begin with '1'.</p><p>Users can define a unique identifier value that is not numeric (ex: Site-001) and does not auto-increment for projects with surveys: Instead of enabling the FIRST instrument as a survey, have a data collection instrument with data entry fields, then collect data via subsequent surveys. </p><p>The <strong>secondary unique field</strong> may be defined as any field on the data collection instruments. The value for the field you specify will be displayed next to the your unique identifier when choosing an existing record/response. It will also appear at the top of the data entry page when viewing a record/response. Unlike the value of the primary unique identifier field, it will not be visible in the URL.</p><p>The data values entered into the secondary unique field must also be unique. The system will not allow for duplicate entries and checks values entered in real time. If a duplicate value is entered, an error message will appear and the value must be changed to save/submit data entered on the data entry instrument.</p><p>The <strong>redcap_survey_identifier</strong> is the identifier defined for surveys when utilizing the Participant Email Contact List and sending survey invitations from the system. The “Participant Identifier” is an optional field you can use to identify individual survey responses so that the participant doesn’t have to enter any identifying information into the actual survey. This field is exported in the data set; the email address of the participant is not. </p><p><strong>NOTE</strong>: redcap_survey_identifier values cannot be used with "piping". If you want to send surveys to participants and pipe in values (ex: first and last name); create a data entry instrument prior to the survey. Add your required fields and an email <br>
	address to be used for the invitations (on the Project Setup page &gt; Designate An Email). Then<br>
	 you can enter or import your participants' information and send <br>
	the invitations using piping.</p>
</div>
<div id="q1240" class="faqq">If I enter data while I am testing my forms in Development, will it remain when I move to Production?</div>
<div class="faqa">It is strongly recommended that you test your projects prior to moving to Production, either by entering test data or real study data. Entering and saving data is the only way to test that the branching logic and calculated fields are working properly.When you click the "Move project to Production" button on the Project Setup page, a pop-up will prompt you to "Delete ALL data, calendar events, documents uploaded for records/responses, and (if applicable) survey responses?".  Check the option to delete data.  Uncheck the option to keep all data.</div>
<div id="q1238" class="faqq">Why do I have to "move" my project to production?</div>
<div class="faqa">Moving your project to Production once you start collecting study data ensures you're maintaining data accuracy and integrity.  The post-production change control process provides an additional check to ensure that data which has already been collected is not deleted, re-coded or overwritten unintentionally.  See FAQ topic "Making Production Changes" for additional details.</div>
<div id="q1230" class="faqq">How can I set the default auto-numbering to start at a particular number such as 2000?</div>
<div class="faqa">You can disable auto-numbering and add the first record using the ID number as the start value.  Once this record is saved, you can enable the auto-numbering customization.</div>
<div id="q1228" class="faqq">If the unique identifier is arbitrary to me, can the system auto-assign a unique value to each of my records?</div>
<div class="faqa">Yes.  You can enable auto-numbering for naming new project records on the Project Setup &gt; Enable optional modules and customizations page.  This option will remove the ability for users to name new records manually and will instead provide a link that will auto-generate a new unique record value.  The value is numeric and increments from the highest numeric record value in the project. If no records exist, it will begin with '1'.</div>
<div id="q1222" class="faqq">After my project is created, can I change the name and/or purpose of my project?</div>
<div class="faqa">Yes. After your project is created, you can navigate to the Project Setup page. Click on the “Modify project title, purpose, etc.”. Here you can update Project Title and Purpose during any project status.</div>
<div id="q1220" class="faqq">What types of projects can I create?</div>
<div class="faqa">Once a project is created, on the Project Setup page you will be able to “enable” two "Main project settings" (1) the longitudinal feature (repeating forms)and/or (2) surveys for data collection.  In a longitudinal project, for each instrument which is designated a survey, data can be entered directly by a participant for any/all events in the project.</div>
</div><div class="subspacediv " id="ss41"><h3 onclick="selectSection(41);window.location.href='#ss41';">Survey Design</h3>
<div id="q1307" class="faqq">Are there different languages available for the text to speech feature?</div>
<div class="faqa"><p>Currently, only English is supported.</p></div>
<div id="q1733" class="faqq"></div>
<div id="q1244" class="faqq">How can I send multiple surveys to participants and link their responses?</div>
<div class="faqa"><p>If the responses need to be anonymous, please see the section Surveys: Anonymous.</p><p>If responses do not need to be anonymous, you must at some point collect individual email addresses to send participants multiple surveys and have the data linked. You can do this in a few ways:</p><p><strong>1. Project’s first instrument is a Survey &amp; Use of Public URL &amp; Designate an email field:</strong> If you want to utilize the Public URL to distribute an initial survey and invite participants, the survey MUST contain a text field with validation = email to collect the participant’s email address.</p><p>On the Project Setup page &gt; Enable optional modules and customizations &gt; Enable: Designate an email field to use for invitations to survey participants. Designate the email address you are collecting on the first survey.</p><p>When participants complete the first survey, their email addresses will pre-populate the Participant Lists and will allow you to send additional surveys for the same record.</p><p>Surveys will be automatically linked by record ID. Participant Identifier on Participant List will not be editable.</p><p>Additional Notes: You will still be able to use the Participant List to send emails to the first survey, if needed. Participant will be prompted to enter their email address on the survey itself. You can also create new records using the Data Entry feature to populate the first survey and manually enter email addresses.</p><p><strong>LIMITATION:</strong> Only participants that answer the first survey with an email address will be able to respond to the follow-up surveys.</p><p><strong>2. Project’s first instrument is a Survey &amp; Use of Participant List:</strong></p><p>If have individual email addresses, you can create a project with multiple surveys. You would add individual emails to the Participant List with or without a Participant Identifier. Then you can send the survey invites through “Compose Survey Invitations”.</p><p><strong>LIMITATION:</strong> Only participants that answer the first survey will be able to respond to the follow-up surveys. If you wish to collect additional surveys for the non-responders, you will need to create additional REDCap projects with the follow-up surveys. Because of this limitation, you may want to try method #3:</p><p><strong>3. Project’s first instrument is Data Entry &amp; Use of “Designate an email field”:</strong></p><p>If you know your email addresses and want participants who haven't completed the first survey to be able to complete the second survey (within the same project), then you can do the following:</p><p>1. The first form is a data entry form (ex: “Email Form”). On the "Email Form", at minimum, you can have the participant ID number field and an email field: a text field with validation = email</p><p>2. On the Project Setup page &gt; Enable optional modules and customizations &gt; Enable: Designate an email field to use for invitations to survey participants</p><p>3. Select the email field you created on the "Email Form"</p><p>4. You can either import (Data Import Tool) or enter the email addresses directly into the data entry "Email Form". Entering the emails here will automatically populate the Participant Lists for all surveys in the project</p><p>You can send your invites to any surveys regardless of participant’s responses and survey completions.</p><p><strong>Advantages:</strong> You can import a list of pre-defined record IDs and email addresses. Record IDs do not have to be assigned incrementing values by REDCap.</p></div>
<div id="q1305" class="faqq">How do I turn text to speech on for a specific survey?</div>
<div class="faqa">You can turn on text to speech on in the survey settings of each survey under “survey customizations”.</div>
<div id="q1302" class="faqq">Do the remaining reminders get canceled once a participant fills out a survey?</div>
<div class="faqa">Yes, Once the specific survey gets filled out by the participant or a REDCap user, all remaining reminders get cancelled automatically.</div>
<div id="q1296" class="faqq">Can I pipe in information from the survey into my confirmation email?</div>
<div class="faqa">Yes, you can pipe in any information from the survey or any other form associated with the record.</div>
<div id="q1294" class="faqq">What kind of attachment can I send with a survey confirmation email?</div>
<div class="faqa">You can send one file of any type as long as it isn’t bigger than the size limit set by the local administrator. This is usually around 16 MB.</div>
<div id="q1290" class="faqq">Can my participants go back to a previously completed survey and make edits?</div>
<div class="faqa">Yes, but this feature is turned off by default for each survey. You will need to turn it on manually in the survey settings for each survey.</div>
<div id="q1286" class="faqq">What happened to the “Preview survey" feature?</div>
<div class="faqa">This feature is no longer available because branching logic or calculated fields would not always work correctly.  To preview your surveys, it is recommended to view the survey as a test participant when testing the project while in development status.</div>
<div id="q1282" class="faqq">What happens when I take the survey "offline"? What does the participant see if they click on the link?</div>
<div class="faqa">When a survey is "offline" participants will no longer be able to view your survey.  They will navigate to a page that displays "Thank you for your interest, but this survey is not currently active."  Project users will still have access to the project, all the applications and survey data.</div>
<div id="q1278" class="faqq">When a "stop action" condition is met, can I customize text to display to participants prior to the survey closing?</div>
<div class="faqa">Customized text cannot be incorporated into the standard REDCap message that displays to the participant.Another method instead of using the stop action feature, is to hide all other questions with branching logic.  A descriptive text field can be used to display instructions for those who meet the "end of survey" criteria.  These participants can then submit the survey as usual.</div>
<div id="q1276" class="faqq">If a participant answers a question in a certain way, can they be taken to the end of the survey if the rest of the questions are not applicable?</div>
<div class="faqa">Yes, you can indicate "Stop Actions" for survey fields only.  The survey participant will be prompted to end the survey when programmed criteria are selected.  Stop Actions will not be enabled on the data entry form when viewing as an authenticated user.  Stop Actions can only be enabled for certain field types.</div>
<div id="q1272" class="faqq">Can I receive a notification when a survey has been completed?</div>
<div class="faqa">Yes. On the Online Designer page, choose 'Survey Notifications' located in the Survey Options section. You may indicate which users should be notified when a survey is complete.</div>
<div id="q1264" class="faqq">For surveys with multiple pages, can the "Previous Page" button be disabled?</div>
<div class="faqa">Yes.  The "Previous Page" button option can be disabled on the Online Designer &gt; Survey Settings page.</div>
<div id="q1262" class="faqq">For surveys with multiple pages, can participants go back to a previous page to change answers?</div>
<div class="faqa">Yes.  Participants can go back to a previous section to change answers by clicking the “Previous Page” button at the bottom of the survey screen. Participants should only click the “Previous Page” button and not the web-browser’s back button.</div>
<div id="q1260" class="faqq">For surveys with multiple pages, is there a progress indicator on the survey?</div>
<div class="faqa">Yes. There is a “Page # of #” at the top right of the survey, so respondents know how many pages they have left.  You can hide/display this feature on the Online Designer &gt; Survey Settings page. The progress bar is not a feature of REDCap.</div>
<div id="q1258" class="faqq">When "Display Questions" = "One section per page" is enabled and entire sections/questions are hidden due to branching logic, are blank pages displayed to the participant?</div>
<div class="faqa">No, sections (creating a survey page) where ALL questions are hidden due to branching logic are skipped in survey view.</div>
<div id="q1256" class="faqq">If I enable "Display Questions" = "One section per page", do answers get saved after the respondent hits "next" to go on to the next page?</div>
<div class="faqa">Yes. Answers are committed to the database as you hit “Next”. So if responders quit the survey before finishing, you’ll have all the data up to that point (partial responses).</div>
<div id="q1254" class="faqq">My survey has matrix fields and it’s creating undesirable page breaks.  What is causing this?</div>
<div class="faqa">Matrix fields contain a “Matrix Header Text” which is actually a Section Header.  Using this field will cause a survey page break. To avoid this, instead of entering text into the header field, add a new “descriptive text field” above your matrix question and enter your text there.</div>
<div id="q1252" class="faqq">If my survey is really long, can I create page breaks?</div>
<div class="faqa">Navigate to Project Setup &gt; Modify Survey Settings.  Make sure to set "Display Questions" = "One section per page".  Then on your questionnaires, you can create page breaks by adding in fields (field type = section header) where you would like those breaks to occur.</div>
<div id="q1248" class="faqq">For Survey + Data Entry Projects, is it possible to start entering data on a data entry form for an individual prior to their completion of the survey?</div>
<div class="faqa">Yes, you can have multiple surveys and data entry forms in the same project.  You can start with a data entry form and enable the second instrument to be a survey.</div>
<div id="q1246" class="faqq">Can I create multiple surveys in the same project?</div>
<div class="faqa">Yes, you can have multiple surveys in the same project. The multiple surveys will be linked to a single participant. If your surveys are for different cohorts or populations, you will want to create separate projects for each survey.</div>
<div id="q1309" class="faqq">Is there a way to get rid of the red “must provide value” message for required fields?</div>
<div class="faqa">Yes, but only in survey mode. You can change this setting in the survey settings. The fields will still be required and the survey will display a warning if they are not filled out, but the red text will be gone.</div>
<div id="q1311" class="faqq">Can I collect anonymous survey data from participants?</div>
<div class="faqa"><p>Responses can only be collected anonymously using the Manage Survey Participants &gt; Public Survey Link.</p><p>The survey questionnaire must not contain any questions asking the participants for identifying data (ex: What is your email? name? address?).</p><p>Multiple Surveys:  Be mindful that projects with multiple surveys present potential challenges to anonymous data collection. If you are analyzing data in aggregate, you can having multiple REDCap projects, each using the Public Survey Link.  If you need to track individual responses over time, using the Public Survey Link for each survey (pre, post, follow-ups) requires that you collect data points within the survey questionnaire to later export and merge. The data points should not be identifying information, but specific enough question(s) that a participant will enter answers consistently (ex: last 5 digits of their first phone number; color of first car).</p><p>Projects containing data entry forms and surveys cannot be considered anonymous.  Manually entered data needs to be identified by the team to be properly associated and linked with survey responses.</p></div>
<div id="q1292" class="faqq">How do I setup a survey confirmation email?</div>
<div class="faqa"><p>You can setup a confirmation email in the survey settings of each email in the survey termination section. Select “Yes” on the dropdown and fill in the “From”, “Subject” and “Body” sections. You can also add an optional attachment.</p><p>Note: REDCap must have an email field defined for the project in order to send out the survey confirmation automatically.</p></div>
<div id="q1288" class="faqq"><p>How to do I set a survey expiration date for a specific survey?</p></div>
<div class="faqa"><p>You can set the survey expiration date for any survey in the survey settings. REDCap will deactivate the survey at the specified time point.</p><p>Note: The survey will be deactivated for all instances of that survey in all arms and events. It’s currently not possible to put expiration dates on specific surveys in specific events.</p></div>
<div id="q1270" class="faqq">Can survey respondents return and modify completed surveys?</div>
<div class="faqa"><p>Yes. This feature can be enabled on the Online Designer &gt; Survey Settings page under the "Save &amp; Return Later" section. Once enabled, a respondent will be able to return to their response and make any edits to it even if they have fully completed the survey.</p><p>Once enabled as part of the "Save &amp; Return Later" feature, respondents will need to provide a Return Code in order to make edits to a completed survey. If the Survey Login feature is enabled for the survey, then instead of using a Return Code, they will use their login credentials to return to the survey.</p><p>If enabled, participants who have completed the survey will still appear in the Participant List in the Compose Survey Invitations popup to allow them to be invited again to edit their completed response. Additionally, their survey link and survey return code will also remain in the Participant List for this same purpose.</p><p>Note: If Survey Notifications have been enabled for a survey that has the "Edit Completed Responses" option enabled, then whenever the respondent returns to the survey again and completes the survey again, it will again trigger the Survey Notifications to send an email to those users selected.</p></div>
<div id="q1250" class="faqq">What is “Designate an email field to use for invitations to survey participants” option?</div>
<div class="faqa"><p>Project users may designate a field in their project to be the survey participant email field for capturing the email address to be used.</p><p>The field can be designated in the "Enable optional modules and customizations" section of the Project Setup page.</p><p>Once designated, if an email address is entered into that field for any given record, users will then be able to use that email address for any survey in the project to send survey invitations.</p></div>
<div id="q1242" class="faqq">How do I enable surveys for my project?</div>
<div class="faqa"><p>Surveys can be enabled at any time in development mode by a project user with "Project Design &amp; Setup" User Rights.</p><p>On the Project Setup tab, in the Main Project Settings step at the top, click "Enable" button for "Use surveys in this project?".  This feature must be enabled in order to use surveys. </p><p>After enabling surveys, go to the Online Designer. A link to that page is on the Project Setup tab, in a lower step on the page. On the Designer, designate which instruments should be surveys by clicking the ‘Enable’ button next to them. You can enable surveys on as many instruments as you wish.</p><p>Each time you designate an instrument as a survey, you will be prompted to define some additional features of the survey. Be sure to scroll down and save those settings. You can return to them at any time to review and modify them as needed, even in production mode. They are found in the 'Survey Settings' buttons that will appear next to each survey instrument in the Online Designer.</p><p>To enable surveys for a project in "production" status, you must contact your REDCap Administrator.</p></div>
<div id="q1298" class="faqq"><p>Where can I setup survey reminders?</p></div>
<div class="faqa"><p>You can setup survey reminders in the same modules that REDCap allows you to send out a survey invitations: Automatic Invitations, Participant List, Compose Survey Invitations.</p></div>
<div id="q1300" class="faqq"><p>Can I send more than 5 survey reminders?</p></div>
<div class="faqa">The current maximum for reminders is 5 in order to prevent spamming people.</div>
<div id="q1284" class="faqq">What happens when a REDCap Administrator takes the system "offline" for routine upgrades and/or expected downtime?  What does the participant see if they click on the survey link?</div>
<div class="faqa"><p>When the REDCap system is "offline", participants will no longer be able to view your survey.  They will navigate to a page that displays "REDCap is currently offline. Please return at another time. We apologize for any inconvenience.</p><p>If you require assistance or have any questions about REDCap, please contact your REDCap Administrator.</p></div>
<div id="q1274" class="faqq">Why am I getting duplicate notifications when a survey has been completed?</div>
<div class="faqa"><p>REDCap specifically checks to ensure it doesn't send a double email to someone. However duplicate notifications can be sent if another user on that project has a slightly different version of your email address on their REDCap account e.g. <a href="mailto:jane.J.doe@vanderbilt.edu">jane.J.doe@vanderbilt.edu</a> vs <a href="mailto:jane.doe@vanderbilt.edu">jane.doe@vanderbilt.edu</a>. There is another possibility. After a survey participant finishes a survey he or she may refresh the acknowledgement page. This could result in another batch of emails being sent.</p></div>
<div id="q1266" class="faqq">Can survey respondents save, leave, and then go back to a survey to complete the questions?</div>
<div class="faqa"><p>Yes. You must enable the "Save and Return Later" option in the Modify Survey Settings section of the Project Setup tab. This option allows participants to save their progress and return where they left off any time in the future. They will be given a Return Code, which they will be required to enter in order to continue the survey.</p><p>	Note: If a project has the "Survey Login" feature enabled, Return Codes will not be used to return to the survey, but it will use the Survey Login's credentials instead.</p><p>	If participants forget their Return Code and contact you, you have access to participants codes on their Survey Results page. You will only be able to distribute lost codes if the survey responses capture identifiers.  If the survey is "anonymous" you will not be able to recover the Return Code for the participant.</p></div>
<div id="q1280" class="faqq">In REDCap is there a way to automatically display the current date/time on a survey?</div>
<div class="faqa">
	<p><br>
		Every survey that is submitted is date/time stamped.  This completion date and time are available in the data export and data entry forms.  However it’s not possible to display the current date on the survey while it’s being taken by participants.</p><p><br>
		You can add a question onto your survey to indicate "Today's Date".  The calendar pick list will have a button for "Today" or "Now" that the participant can easily click.</p><p><br>
		Action tags are a relatively new addition to REDCap and can be applied to any variable (see Action Tags info for additional details). These options are available:</p><p><br>
		<br><br>
		@NOW<br>
		<br><br>
	Automatically provides the user’s current time as the value of a Text when the page is loaded. Once the value is captured, it will not be changed when visiting the page at a later time. If the field has validation, the value will conform to the date/time format of the field. The field will be disabled and will not allow users to edit the value. NOTE: The time will be the user’s local time, which is derived from <br>
	their device/computer.</p><p><br>
		<br><br>
		@TODAY<br>
		<br><br>
	Automatically provides the user’s current date as the value of a Text when the page is loaded. Once the value is captured, it will not be changed when visiting the page at a later time. If the field has validation, the value will conform to the date/time format of the field. The field will be disabled and will not allow users to edit the value. NOTE: The date will be the user’s current date, which is derived from <br>
	their device/computer.</p><p><br>
		<br><br>
		@READONLY<br>
		<br><br>
	Makes the field read-only (i.e., disabled) on the survey page, the data entry form, and in the REDCap mobile app so that its value cannot be changed</p>
</div>
<div id="q1268" class="faqq">What is the Survey Login feature?</div>
<div class="faqa">
	<p>To provide improved security to your surveys, you can require the participant to enter specified login credentials in order to begin a survey and if the "Save &amp; Return Later" feature is enabled to return to a previously entered survey response.</p><p>	To enable the Survey Login feature, there is a button at the top of the instrument list on the Online Designer that will open up the Survey Login settings popup. Users who wish to enable Survey Login may choose one, two, or three fields in their project to be used as the login credential fields for surveys in their project.</p><p>	The Survey Login can be enabled for ALL surveys in a project or just selected surveys. For selected surveys, navigate to the Survey Settings page to enable.</p><p>	If Survey Login has been enabled and a record does not exist yet for the <br>
	respondent (e.g., if they are beginning a Public Survey), then the survey page will display directly without the login page. However, once the record exists, the respondent will always be prompted to log in to the survey.</p><p>	Note: If a survey has the "Save &amp; Return Later" feature enabled, Return Codes will not be used to return to the survey, but it will use the Survey Login's login credentials instead.</p>
</div>
</div><div class="subspacediv " id="ss47"><h3 onclick="selectSection(47);window.location.href='#ss47';">Longitudinal</h3>
<div id="q3611" class="faqq"></div>
<div id="q1325" class="faqq">How can I remove a subject in a multi-arm study from one arm, but not all arms?</div>
<div class="faqa">Go to the first form in the arm from which the subject will be removed and delete the record. This will remove the subject from that arm, but not other arms.How do I create a set of variables for an unknown number of possible responses for the same questions?</div>
<div id="q1319" class="faqq">In longitudinal project, how can I set up linkages between events and data entry forms?</div>
<div class="faqa">You can use the Designate Forms for my Events page to create linkages between events and data entry forms. In the Designate Forms for my Events page each arm of your study has its own tab. Choose an arm and click the Begin Editing button to link data entry forms to events. Check off boxes to indicate the forms which should be completed for any given event and then click the Save button. You will see a grid that displays the data entry forms that are assigned for completion during each event. Take care to designate forms for your events while the project is in development mode. These associations can only be changed by the REDCap Administrator after the project is in production and should be made with caution to ensure existing data are not corrupted.</div>
<div id="q1321" class="faqq">How can I establish the events and scheduling intervals for my project?</div>
<div class="faqa"><p>The Define My Events page allows you to establish the events and scheduling intervals for your project. An “event” may be a temporal visit in the course of your project such as a participant visit or a task to be performed. After events have been defined, you may use them and their Days Offset value to generate schedules. For data collection purposes, you will additionally need to designate the data entry forms that you wish to utilize for any or all events, thus allowing you to use a form for multiple events for the same database record. You may group your events into “arms” in which you may have one or more arms/groups for your project. Each arm can have as many events as you wish. To add new events provide an Event Name and Date Offset for that event and click the Add New Event button.</p><p>If you will be performing data collection on this project then once you have defined events in the Define My Events page, you may navigate to the Designate Instruments For My Events page where you may select the data collection instruments that you with to utilize for each event that you defined.</p></div>
<div id="q1317" class="faqq">How is longitudinal data stored?</div>
<div class="faqa"><p>In the traditional data collection model and for surveys, each project record is stored independently as a separate row of data, which can be seen when exported. But for longitudinal projects, each row of data actually represents that particular time-point (event) per database record.</p><p>For example, if four events are defined for the project, one record will have four separate rows of data when exported.  The data export will include a column "redcap_event_name" indicating the unique event name for each row.</p><p>Longitudinal projects are most commonly created for clinical and research data. A longitudinal project is created by selecting the "Longitudinal / repeating forms" collection format for data entry forms when creating or requesting a new project.</p></div>
<div id="q1315" class="faqq">What is a Longitudinal project?</div>
<div class="faqa"><p>A longitudinal project is similar to a traditional data collection project in that multiple data entry forms are defined. However unlike the traditional model, forms in a longitudinal project can be completed repeatedly for a single record. The longitudinal model allows any data entry page to be repeated any given number of times across pre-defined time-points, which are specified by the user before data is collected. So rather than repeating a data entry form multiple times in the Data Dictionary, it can exist only once in the Data Dictionary but be repeated N number of times using the longitudinal model.</p><p>The longitudinal project lets you define “events” for your project that allow the utilization of data collection forms multiple times for any given database record. An “event” may be a temporal event in the course of your project such as a participant visit or a task to be performed. After events have been defined, you will need to designate the data entry forms that you wish to utilize for any or all events, thus allowing you to use a form for multiple events for the same database record. You may group your events into “arms” in which you may have one or more arms/groups for your project. Each arm can have as many events as you wish. You may use the table provided to create new events and/or arms, or modify existing ones. One arm and one event will be initially defined as the default for all databases.</p></div>
<div id="q1323" class="faqq">How can I register a subject in a multi-arm study before the determination as to which arm they belong in can be made?</div>
<div class="faqa">You can set up an arm as a "screening and enrollment" arm. Once a subject becomes enrolled he or she can be added to an "active" arm.</div>
</div><div class="subspacediv " id="ss48"><h3 onclick="selectSection(48);window.location.href='#ss48';">Copy a Project</h3>
<div id="q1327" class="faqq">Can I create a copy of my project?</div>
<div class="faqa">Yes.  If you have the right to create/request new projects, you can navigate to the Project Setup &gt; Other Functionality page and request a "Copy" of the project.</div>
</div></div><div class="spacediv " id="s39"><div class="subspacediv " id="ss39"><h2 onclick="selectSection(39);window.location.href='#s39';">Data Collection Instrument Design</h2>
<div id="q1337" class="faqq">Are there any restrictions to what you can name a variable/field?</div>
<div class="faqa">Variable names cannot be duplicated and should always start with a letter. They must be lowercase and may contain only letters, numbers, and underscores. Although a maximum length of 26 characters is allowed, by convention, variable names should be as short in length as possible while maintaining meaning. Note: the terms "variable names" and "field names" are used interchangeably in REDCap.</div>
<div id="q1335" class="faqq">Are there any restrictions to what you can name a data collection instrument?</div>
<div class="faqa">Naming instruments using the Online Designer do not have restrictions.  Naming instruments using the Data Dictionary is restricted to lowercase and may contain only letters, numbers, and underscores.</div>
<div id="q1331" class="faqq">Are there restrictions to the number of data collection instruments you can have in one project?</div>
<div class="faqa">Currently, there are no restrictions on the number of data collection instruments per project.</div>
<div id="q1333" class="faqq">Are there restrictions to the number of fields you can have in one instrument?</div>
<div class="faqa"><p>No. There are no restrictions on the length or number of fields per instrument. The best practice is to keep instruments fairly short for easier data entry, and to ensure that you're saving data to the server more frequently.</p><p>For long surveys, you can use section headers and enable the feature "Display Questions" = One Section Per Page.  This will allow participants to save each section when they click "next page".</p></div>
<div id="q1329" class="faqq">What is the difference between a data entry form and a survey?</div>
<div class="faqa"><p>REDCap defines Data Collection Instruments as "data entry forms" and "surveys".</p><p>With "surveys" you can collect data directly from participants.  Participants will access your questions via a secure webpage.  No authentication is required; however, you can enable the Survey Login feature if needed.</p><p>With "data entry forms", data is entered by authorized REDCap project users.  REDCap log-in access and project rights are required to view and edit the data entry forms.</p></div>
<div id="q1339" class="faqq">Is it possible to change the format (colors, text) of the form, field or text display?</div>
<div class="faqa">
	<p>The general data entry templates are static and cannot be changed. Survey Themes in the Survey Settings page allows you to customize the font and background colors for many sections of a survey.<br>
	<br><br>
		REDCap does allow the use of some HTML and CSS in the Field Label and Field Notes.  Please note that HTML tags print as text on the pdf exports/forms and do not print the formats created with the HTML tags.<br>
	<br><br>
		Check out this example survey for formatting ideas:   <br>
		<a target="_blank" href="https://redcap.vanderbilt.edu/surveys/?s=u7B74tUTsa">https://redcap.vanderbilt.edu/surveys/?s=u7B74tUTsa</a></p>
</div>
</div><div class="subspacediv " id="ss49"><h3 onclick="selectSection(49);window.location.href='#ss49';">Online Designer / Data Dictionary</h3>
<div id="q1347" class="faqq">I get an error message when I attempt to upload a really large data dictionary.  Does REDCap set a limit on the file size of an imported data dictionary?</div>
<div class="faqa">REDCap can be configured to allow large files to be uploaded.  You'll need to contact your local REDCap Administrator about your institution's file upload limits.</div>
<div id="q1345" class="faqq">What is the Field Annotation?</div>
<div class="faqa">This metadata field was added in v6.5. An annotation can be added to any field via the Online Designer or Data Dictionary (column R). It can be used for several purposes, such as for the bookkeeping of a project's field structure (as metadata about the given field) for reference purposes regarding what the field represents or how it should be used (during data entry, analysis, etc.). Field annotations are not displayed on any page but are merely for reference. Field annotations can also be used to map the field to various standards (e.g., CDISC, SNOMED, LOINC) using whatever notation the user sees fit (e.g., using a simple ID code for the standard or a complex XML structure containing information about how to transform the data to the standard). Since it is an annotation for reference purposes, REDCap will not do anything with the field annotation text on its own, but the annotation can be obtained by users at any time for any purpose (typically accessed via the Data Dictionary download or via the API metadata export).</div>
<div id="q1343" class="faqq">What is the Data Dictionary?</div>
<div class="faqa">The Data Dictionary is a specifically formatted spreadsheet in CSV (comma separated values format) containing the metadata used to construct data collection instruments and fields. The changes you make with the data dictionary are not made in real time to the project (off-line method).  The modified file must first be uploaded successfully before changes are committed to the project.</div>
<div id="q1341" class="faqq">What is the Online Designer?</div>
<div class="faqa">The Online Designer will allow you to make create/modify/delete data collection instruments and fields (questions) very easily using your web browser.  Changes are made in real time and available immediately for review and testing.</div>
<div id="q1349" class="faqq">How do I make edits to a data dictionary for a project in development or already in production?</div>
<div class="faqa"><p>1. If the project is still in development, then download the current data dictionary and save as Version 0.  This step is not necessary for a project already in production since REDCap stores all previous versions of the data dictionary (since moving to production) in “Project Revision History”.</p><p>Note: If study records already exist in the database, then it is good practice to export the raw data before proceeding.  It is important to have a backup of your project as it currently exists should you need to go back to the original version.</p><p>2. Make a copy of the Version 0 database and save as Version 1 in CSV format.</p><p>3. Make edits/additions/deletions to Version 1 and save.</p><p>4. Upload the entire revised Version 1 data dictionary to your project.</p><p><strong>Warning</strong>: Uploading the new data dictionary will overwrite, not update, the original data dictionary (Version 0), so it is necessary to upload the revised file in its entirety. If you have multiple developers on a project, it is also important to communicate and coordinate revisions. You do not want to be working on an outdated "local" version of your data dictionary if others have been updating the project in REDCap. Always download a new current version prior to making changes.</p></div>
</div><div class="subspacediv " id="ss50"><h3 onclick="selectSection(50);window.location.href='#ss50';">Field Types and Validation</h3>
<div id="q1375" class="faqq">What are the Custom Alignment codes for the data dictionary?</div>
<div class="faqa"><p>RV – right vertical</p><p>RH – right horizontal</p><p>LV – left vertical</p><p>LH – left horizontal</p></div>
<div id="q1379" class="faqq">What are “identifiers”?</div>
<div class="faqa"><p>There are 18 pieces of information that are considered identifiers (also called protected health information, or PHI) for the purposes of HIPAA compliance. When you indicate a variable as an Identifier, you have the option to <strong>“de-identify” your data on data exports</strong>. In the Data Export Tool, the identifier variables appear in red and there are de-identification options you can select prior to exporting the data.</p><p>The 18 HIPAA identifiers are:</p><table><tbody><tr><td>1.</td><td>Name</td></tr><tr><td>2.</td><td>Fax number</td></tr><tr><td>3.</td><td>Phone number</td></tr><tr><td>4.</td><td>E-mail address</td></tr><tr><td>5.</td><td>Account numbers</td></tr><tr><td>6.</td><td>Social Security number</td></tr><tr><td>7.</td><td>Medical Record number</td></tr><tr><td>8.</td><td>Health Plan number</td></tr><tr><td>9.</td><td>Certificate/license numbers</td></tr><tr><td>10.</td><td>URL</td></tr><tr><td>11.</td><td>IP address</td></tr><tr><td>12.</td><td>Vehicle identifiers</td></tr><tr><td>13.</td><td>Device ID</td></tr><tr><td>14.</td><td>Biometric ID</td></tr><tr><td>15.</td><td>Full face/identifying photo</td></tr><tr><td>16.</td><td>Other unique identifying number, characteristic, or code</td></tr><tr><td>17.</td><td>Postal address (geographic subdivisions smaller than state)</td></tr><tr><td>18.</td><td>Date precision beyond year</td></tr></tbody></table></div>
<div id="q1361" class="faqq">How do I create a set of variables for an unknown number of possible responses for the same question?</div>
<div class="faqa"><p>For a question with an unknown number of answers, such as how many medications someone is taking, you may want to display the fields only as they are needed. REDCap currently is not able to dynamically create fields; however, there is a way to use branching logic to approximate this.</p><p>If you can estimate the maximum number of fields you will need, you can create that many copies of your field to hide and display as needed using branching logic.</p><p><strong>Example 1</strong>: If you think 15 is a good maximum, you would create 15 copies of the field. Then, in order to only show the fields that are needed, you could create a "count" variable. Your branching logic would look like this:</p><p>field1: [count]&gt;0</p><p>field2: [count]&gt;1</p><p>field3: [count]&gt;2</p><p>and so on.</p><p>If your variable is medications, and the respondent takes 2 medications, you enter 2 in [count] variable, then the med1 and med2 fields appear. If they take 3, you enter that, and meds1 to med3 fields appear.</p><p><strong>Example 2a:</strong> Another method is to first create the maximum number of fields that you estimate will be needed, as above, and then hide and display each field as the previous field receives data. Using this method will cause each field to show up as needed. Your branching logic would look like:</p><p>field2: [field1] &lt;&gt; "" or [field2] &lt;&gt; ""</p><p>field3: [field2] &lt;&gt; "" or [field3] &lt;&gt; ""</p><p>field4: [field3] &lt;&gt; "" or [field4] &lt;&gt; ""</p><p>and so on.</p><p>The fields in this example are text fields. If field1 "does not equal blank" (aka if data is entered for field1), then field2 will display. This example will also retain any given field that happens to have data already.</p><p><strong>Example 2b:</strong> If you want to only show a field if there is not a previous field that is empty, the branching logic will need to check every previous field:</p><p>field2: [field1] &lt;&gt; ""</p><p>field3: [field1] &lt;&gt; "" and [field2] &lt;&gt; ""</p><p>field4: [field1] &lt;&gt; "" and [field2] &lt;&gt; "" and [field3] &lt;&gt; ""</p><p>and so on.</p></div>
<div id="q1395" class="faqq">How do I display unknown dates?  What’s the best way to format MM-YYYY?</div>
<div class="faqa">When you set a text field validation type = date, the date entered must be a valid completed date. To include options for unknown or other date formats, you may need to break the date field into multiple fields. For Days and Months, you can create dropdown choices to include numbers (1-31, 1-12) and UNK value. For Year, you can define a text field with validation = number and set a min and max value (ex: 1920 – 2015).The advantage of the multi-field format is that you can include unknown value codes. The disadvantages are that you may need to validate date fields after data entry (i.e. ensure no Feb 31st) and there will be additional formatting steps required to analyze your data fields.</div>
<div id="q1393" class="faqq">How are the different date formats exported?</div>
<div class="faqa">The Data Export Tool will only export dates, datetimes, and datetime_seconds in YYYY-MM-DD format. Previously in 3.X-4.0, datetimes were exported as YYYY-MM-DD HH:MM, while dates were exported as MM/DD/YYYY.  By exporting only in YYYY-MM-DD format it is more consistent across the date validation field types.If exporting data to a stats package, such as SPSS, SAS, etc., it will still import the same since the syntax code has been modified for the stats package syntax files to accommodate the new YMD format for exported dates. The change in exported date format should not be a problem with regard to opening/viewing data in Excel or stats packages.</div>
<div id="q1391" class="faqq">How are the different date formats imported?</div>
<div class="faqa">While the different date formats allow users to enter and view dates in those formats on a survey/form, dates must still only be imported either in YYYY-MM-DD or MM/DD/YYYY format.</div>
<div id="q1387" class="faqq">Can I enter dates without dashes or slashes?</div>
<div class="faqa">Date values can be entered using several delimiters (period, dash, slash, or even a lack of delimiter) but will be reformatted to dashes before saving it (e.g. 05.31.09 or 05312009 will automatically be reformatted to 05-31-2009 for MM-DD-YYYY format).</div>
<div id="q1385" class="faqq">Can I change date formats if I've already entered data?</div>
<div class="faqa">Any date fields that already exist in a REDCap project can be easily converted to other formats without affecting the stored data value.  After altering the format of the existing date fields, dates stored in the project will display in the new date format when viewed on the survey/form. Therefore, you change the date format of a field without compromising the stored data.</div>
<div id="q1381" class="faqq">How are dates formatted?  Can I change the date format?</div>
<div class="faqa">Dates can be formatted as mm-dd-yyyy, dd-mm-yyyy, and yyyy-mm-dd by using the text field &gt; validation.  These formats cannot be modified.  It is recommended to always use the field label or field note to specify the required date format.</div>
<div id="q1377" class="faqq">What is the Question Number (surveys only) column in the data dictionary?</div>
<div class="faqa">For surveys, you can use this column to enter number of the survey question for screen display.</div>
<div id="q1369" class="faqq">Is it possible to restrict text inputs to a defined length or digit/character combination?</div>
<div class="faqa">You can restrict text inputs by using custom field validation types.  Custom field validation types must be created by the REDCap Development team.  Your REDCap Administrator will be able to submit requests for new custom field validation types.  The request will be evaluated by the concerned team and approved requests will be fulfilled.  However it is not possible to specify a deadline for meeting the request.</div>
<div id="q1363" class="faqq">Can I populate radio buttons, dropdowns and checkbox field choices using an "if then" statement?</div>
<div class="faqa">There is currently no way of populating field choices dynamically.  You can create multiple fields and response option lists and hide or display them using branching logic.  In certain circumstances, you may be able to populate a dropdown list from another REDCap field, but this is a very specific use case and requires contacting a REDCap Admin.</div>
<div id="q1359" class="faqq">Can I shorten an instrument by grouping related questions together using a columnar format?</div>
<div class="faqa">It is not possible to build survey or data entry forms in a columnar format in REDCap.  You can use a combination of branching logic, section headers and descriptive text to shorten the instrument and group related questions.</div>
<div id="q1357" class="faqq">Is there a question type that is a radiobutton/checkbox/dropdown with a text box for "Other, specify"?</div>
<div class="faqa">No, this specific question type is not available. You can add a text field after the question and use branching logic so that if "Other" is selected, a text box appears to capture the data.</div>
<div id="q1373" class="faqq">Can I set minimum and maximum ranges for certain fields?</div>
<div class="faqa"><p>If validation is employed for text fields, min and max values may be utilized. Min, max, neither or both can be used for each individual field. The following text validation types may utilize min and/or max values:</p><table><tbody><tr><td><strong>DATE_YMD</strong></td></tr><tr><td><strong>DATE_MDY</strong></td></tr><tr><td><strong>DATE_DMY</strong></td></tr><tr><td><strong>TIME</strong></td></tr><tr><td><strong>DATETIME_YMD</strong></td></tr><tr><td><strong>DATETIME_MDY</strong></td></tr><tr><td><strong>DATETIME_DMY</strong></td></tr><tr><td><strong>DATETIME_SECONDS_YMD</strong></td></tr><tr><td><strong>DATETIME_SECONDS_MDY</strong></td></tr><tr><td><strong>DATETIME_SECONDS_DMY</strong></td></tr><tr><td><strong>NUMBER</strong></td></tr><tr><td><strong>INTEGER</strong></td></tr></tbody></table><strong></strong></div>
<div id="q1389" class="faqq">Why can’t I see the different date formats in the Online Designer?</div>
<div class="faqa"><p>New validation types are not automatically available will need to be enabled by your REDCap Administrator. Once enabled, they'll appear in the text validation drop-down list in the Online Designer. All formats are available via the Data Dictionary.</p></div>
<div id="q1371" class="faqq">What is the character limit for a variable name, field label, text typed into a "text box (short text)", and text typed into a "notes box (paragraph text)"?</div>
<div class="faqa"><p>The maximum number of characters are:</p><ul><li>Field name: *Recommended: &lt;26, Max: 100 </li><li>Field label: ~65,000 </li><li>Text typed into a "text box" field: ~65,000 </li><li>Text typed into a "notes box" field: ~65,000</li></ul><p>*Most stats packages (SAS, STATA...) will truncate variable/field names to max of 26 characters.</p></div>
<div id="q1355" class="faqq">Can I upload files to attach to individual subject records?</div>
<div class="faqa"><p>Yes, you can upload documents for individual records.</p><p>To create a new document upload field in the Data Dictionary for any given REDCap project, set the Field Type = ‘file’. You may add as many 'file' fields as needed to your data collection instruments.</p><p>Documents can be uploaded and downloaded by navigating to the record’s data entry page and clicking the file link. A document can be deleted at any time, and there is no limit to how many times the document can be replaced by uploading another file to that record’s file upload field.</p><p>Contact your REDCap Administrator to confirm if this field type is available and what the maximum upload file size is at your institution.</p></div>
<div id="q1351" class="faqq">What are the field types?</div>
<div class="faqa"><p>The Field Type dictates how the field will be shown on the data entry form.</p><p>Options include:</p><table><tbody><tr><td>TEXT</td><td><p>single-line text box (for text and numbers)</p></td></tr><tr><td>NOTES</td><td><p>large text box for lots of text</p></td></tr><tr><td>DROPDOWN</td><td><p>dropdown menu with options</p></td></tr><tr><td>RADIO</td><td><p>radio buttons with options</p></td></tr><tr><td>CHECKBOX</td><td><p>checkboxes to allow selection of more than one option</p></td></tr><tr><td>FILE</td><td><p>upload a document</p><p>FILE with Text Validation "Signature" = Signature Field</p></td></tr><tr><td>CALC</td><td><p>perform real-time calculations</p></td></tr><tr><td>SQL</td><td><p>select query statement to populate dropdown choices</p></td></tr><tr><td>DESCRIPTIVE</td><td><p>text displayed with no data entry and optional image/file attachment</p></td></tr><tr><td>SLIDER</td><td><p>visual analogue scale; coded as 0-100</p></td></tr><tr><td>YESNO</td><td><p>radio buttons with yes and no options; coded as 1, Yes | 0, No</p></td></tr><tr><td>TRUEFALSE</td><td><p>radio buttons with true and false options; coded as 1, True | 0, False</p></td></tr></tbody></table></div>
<div id="q1365" class="faqq">Are data from checkbox (choose all that apply) field types handled differently from other field types when imported or exported?</div>
<div class="faqa"><p>Yes. When your data are exported, each option from a checkbox field becomes a separate variable coded 1 or 0 to reflect whether it is checked or unchecked. By default, each option is pre-coded 0, so even if you have not yet collected any data, you will see 0's for each checkbox option. The variable names will be the name of the field followed by the option number. So, for example, if you have a field coded as follows:</p><p>Race</p><p>1, Caucasian</p><p>2, African American</p><p>3, Asian</p><p>4, Other</p><p>In your exported dataset, you will have four variables representing the field Race that will be set as 0 by default, coded 1 if the option was checked for a record. The variable names will consist of the field name. three underscores, and the choice value:</p><p>race___1 <br>race___2 <br>race___3 <br>race___4 </p><p>Notes:</p><ul><li>when you import data into a checkbox field, you must code it based on the same model</li><li>negative values can be used as the raw coded values for checkbox fields. Due to certain limitations, negative values will not work when importing values using the Data Import Tool, API and cause problems when exporting data into a statistical analysis package. The workaround is that negative signs are replaced by an underscore in the export/import-specific version of the variable name (e.g., for a checkbox named "race", its choices "2" and "-2" would export as the fields</li></ul><p style="margin-left: 60px;">race___2 </p><p style="margin-left: 60px;">race____2</p><p>A checkbox field can be thought of as a series of yes/no questions in one field. Therefore, a yes (check) is coded as 1 and a no (uncheck) is coded a 0. An unchecked response on a checkbox field is still regarded as an answer and is not considered missing.</p></div>
<div id="q1383" class="faqq">How do I indicate “dates” in the data dictionary?</div>
<div class="faqa"><p>Text Validation Types: Use for text field data validation</p><table><tbody><tr><td>Format</td><td>Example</td></tr><tr><td><strong>DATE_DMY</strong></td><td>16-02-2011</td></tr><tr><td><strong>DATE_MDY</strong></td><td>02-16-2011</td></tr><tr><td><strong>DATE_YMD</strong></td><td>2011-02-16</td></tr><tr><td><strong>DATETIME_DMY</strong></td><td>16-02-2011 17:45</td></tr><tr><td><strong>DATETIME_MDY</strong></td><td>02-16-2011 17:45</td></tr><tr><td><strong>DATETIME_YMD</strong></td><td>2011-02-16 17:45</td></tr><tr><td><strong>DATETIME_SECONDS_DMY</strong></td><td>16-02-2011 17:45:23</td></tr><tr><td><strong>DATETIME_SECONDS_MDY</strong></td><td>02-16-2011 17:45:23</td></tr><tr><td><strong>DATETIME_SECONDS_YMD</strong></td><td>2011-02-16 17:45:23</td></tr></tbody></table></div>
<div id="q1353" class="faqq"><p>What to consider when choosing radio button vs drop-down?</p></div>
<div class="faqa">
	<p>Dropdown:</p><ol><br>
		<br>
	<li>Ability to use short cut keys </li>	<br>
	<li>Less space on forms; use when you have limited space</li></ol><p>	Radio Button:</p><ol><br>
		<br>
	<li>Good when you need your choices visible </li>	<br>
	<li>Good option for minimal response options </li>	<br>
	<li>Available with the matrix options when building forms</li></ol>
</div>
<div id="q1367" class="faqq">What are the possible Text Validation Types?</div>
<div class="faqa">
	<p>Certain text validation types must be enabled by a REDCap Admin. If you do not see an option below in your instance, contact your REDCap Administrator.</p><br>
	<br><br><table>
	 
	  <tbody><tr>
	   <td>Validation Annotation</td>
	   <td>Example</td>
	   <td>Notes</td>
	  </tr>
	  <tr>
	   <td>date_dmy</td>
	   <td>31-12-2008</td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>date_mdy</td>
	   <td>12-31-2008</td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>date_ymd</td>
	   <td>2008-12-31</td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_dmy</td>
	   <td><p>16-02-2011 17:45</p></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_mdy</td>
	   <td>02-16-2011 17:45<br></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_ymd</td>
	   <td>2011-02-16 17:45<br></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_seconds_dmy</td>
	   <td>16-02-2011 17:45:23<br></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_seconds_mdy</td>
	   <td>02-16-2011 17:45:23<br></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>datetime_seconds_ymd</td>
	   <td>2011-02-16 17:45:23<br></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>email</td>
	   <td><a href="mailto:john.doe@vanderbilt.edu">john.doe@vanderbilt.edu</a></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>integer</td>
	   <td>1, 4, -10<br></td>
	   <td>whole number with no decimal<br></td>
	  </tr>
	  <tr>
	   <td>alpha_only</td>
	   <td>name</td>
	   <td>letters only, no numbers, spaces or special characters<br></td>
	  </tr>
	  <tr>
	   <td>number</td>
	   <td>1.3, 22, -6.28<br></td>
	   <td>a general number<br></td>
	  </tr>
	  <tr>
	   <td>number_1dp_comma_decimal</td>
	   <td></td>
	   <td>number to 1 decimal place - comma as decimal<br></td>
	  </tr>
	  <tr>
	   <td>number_1dp</td>
	   <td></td>
	   <td>number to 1 decimal place<br></td>
	  </tr>
	  <tr>
	   <td>number_2dp_comma_decimal</td>
	   <td></td>
	   <td>number to 2 decimal place - comma as decimal<br></td>
	  </tr>
	  <tr>
	   <td>number_2dp</td>
	   <td></td>
	   <td><p>number to 2 decimal place</p></td>
	  </tr>
	  <tr>
	   <td>number_3dp_comma_decimal</td>
	   <td></td>
	   <td><p>number to 3 decimal place - comma as decimal</p></td>
	  </tr>
	  <tr>
	   <td>number_3dp</td>
	   <td></td>
	   <td><p>number to 3 decimal place</p></td>
	  </tr>
	  <tr>
	   <td>number_4dp_comma_decimal</td>
	   <td></td>
	   <td><p>number to 4 decimal place - comma as decimal</p></td>
	  </tr>
	  <tr>
	   <td>number_4dp</td>
	   <td></td>
	   <td><p>number to 4 decimal place</p></td>
	  </tr>
	  <tr>
	   <td>number_comma_decimal</td>
	   <td></td>
	   <td>number comma as decimal<br></td>
	  </tr>
	  <tr>
	   <td>phone_australia</td>
	   <td></td>
	   <td></td>
	  </tr>
	  <tr>
	   <td>phone</td>
	   <td>615-322-2222</td>
	   <td><br>
	    <ul><br>
	     <li>Area codes start with a number from 2-9, followed by 0-8 and then any third digit.</li><br>
	     <li>The second group of three digits, known as the central office or schange code, starts with a number from 2-9, followed by any two digits.</li><br>
	     <li>The final four digits, known as the station code, have no restrictions.</li><br>
	    </ul></td>
	  </tr>
	  <tr>
	   <td>postalcode_australia</td>
	   <td>2150</td>
	   <td>4-digit number<br></td>
	  </tr>
	  <tr>
	   <td>postalcode_canada</td>
	   <td>K1A 0B1<br></td>
	   <td>Format: A0A 0A0 where A is a letter and 0 is a digit<br></td>
	  </tr>
	  <tr>
	   <td>ssn</td>
	   <td>123-12-1234</td>
	   <td>Format: xxx-xx-xxxx<br></td>
	  </tr>
	  <tr>
	   <td>time_12h</td>
	   <td>04:25</td>
	   <td>12 hour clock, must be accompanied by AM or PM radio button field<br></td>
	  </tr>
	  <tr>
	   <td>time</td>
	   <td>19:30</td>
	   <td>military time<br></td>
	  </tr>
	  <tr>
	   <td>time_mm_ss</td>
	   <td>31:22</td>
	   <td>time in minutes and seconds<br></td>
	  </tr>
	  <tr>
	   <td>vmrn</td>
	   <td>0123456789</td>
	   <td>10 digits<br></td>
	  </tr>
	  <tr>
	   <td>zipcode</td>
	   <td>01239</td>
	   <td>U.S. Zipcode<br></td>
	  </tr>
	  <tr>
	   <td></td>
	   <td></td>
	   <td></td>
	  </tr>
	 
	</tbody></table>
</div>
<div id="q1729" class="faqq"><p><b>What are the field types?</b></p></div>
<div class="faqa"><p>The Field Type dictates how the field will be shown on the data entry form.</p><p>Options include:</p><table><tbody><tr><td><strong>TEXT</strong></td><td>- single-line text box (for text and numbers)</td></tr><tr><td><strong>NOTES</strong></td><td>- large text box for lots of text</td></tr><tr><td><strong>DROPDOWN</strong></td><td>- dropdown menu with options</td></tr><tr><td><strong>RADIO</strong></td><td>- radio buttons with options</td></tr><tr><td><strong>CHECKBOX</strong></td><td>- checkboxes to allow selection of more than one option</td></tr><tr><td><strong>FILE</strong></td><td>- upload a document</td></tr><tr><td><strong>CALC</strong></td><td>- perform real-time calculations</td></tr><tr><td><strong>SQL</strong></td><td>- select query statement to populate dropdown choices</td></tr><tr><td><strong>DESCRIPTIVE</strong></td><td>- text displayed with no data entry and optional image/file attachment</td></tr><tr><td><strong>SLIDER</strong></td><td>- visual analogue scale; coded as 0-100</td></tr><tr><td><strong>YESNO</strong></td><td>- radio buttons with yes and no options; coded as 1, Yes | 0, No</td></tr><tr><td><strong>TRUEFALSE</strong></td><td>- radio buttons with true and false options; coded as 1, True | 0, False</td></tr></tbody></table></div>
</div><div class="subspacediv " id="ss52"><h3 onclick="selectSection(52);window.location.href='#ss52';">Matrix Fields</h3>
<div id="q1455" class="faqq">How do I create a matrix of fields using the Online Designer?</div>
<div class="faqa">Navigate to the Online Designer and click the "Add Matrix of Fields" button that will appear either above or below each field. It will open up a pop-up where you can set up each field in the matrix. You can supply the field label and variable name for each field in the matrix, and you may also designate any as a required field. You have the option to display a section header above the matrix. You will also need to set the answer format for the matrix, either Single Answer (Radio Buttons) or Multiple Answers (Checkboxes), and then the matrix choice columns. Setting up the choices is exactly the same as for any normal multiple choice field in the Online Designer by providing one choice per line in the text box. Lastly, you will need to provide a matrix group name for your matrix of fields. The matrix group name is merely a tag that is used to group all the fields together in a single matrix group. The matrix group name can consist only of lowercase letters, numbers, and underscores, and the group name must not duplicate any other matrix group name in the project. Once you have provided all the requisite information for the matrix, click the Save button and the matrix will be created and displayed there with your other fields in the Online Designer.</div>
<div id="q1461" class="faqq">Why isn't the header for my matrix field hidden if all of the fields in the matrix are hidden?</div>
<div class="faqa">The Matrix Field Header is really just a Section Header. Like all Section Headers, it is only hidden if all of the fields in the section are hidden. Fields that come after the matrix but before another Section Header count as being part of the section.</div>
<div id="q1457" class="faqq">How do I create a matrix of fields using the Data Dictionary?</div>
<div class="faqa"><p>In a data dictionary, creating a matrix of fields is as easy as creating any regular radio button field or checkbox field. Create your first field in the matrix as either a radio or checkbox field type (since matrix fields can only be either of these) by adding it as a new row in the data dictionary. You must provide its variable name and form name (as usual), then set its field type as either "radio" or "checkbox". Then set its field label in column E, its multiple choice options in column F, and then lastly in column P you must provide a Matrix Group Name. </p><p>The matrix group name is how REDCap knows to display these fields together as a matrix. Without a matrix group name, REDCap will display the fields separately as normal radio buttons or checkboxes. </p><p>The matrix group name can consist only of lowercase letters, numbers, and underscores, and the group name must not duplicate any other matrix group name in the project. </p><p>After you have created your first field for the matrix and have given it a matrix group name, you may now create the other fields in the matrix in the rows directly below that field. </p><p>To save time, it is probably easiest to simply copy that row and paste it as the next immediate row in the Data Dictionary. Then you only need to modify the variable name and label for the new row. Once you have created all your fields for the matrix, you can upload your data dictionary on the "Data Dictionary Upload" page in your REDCap project, and those fields will be displayed as a matrix on your data collection instrument. </p><p>NOTE: All fields in a matrix must follow the following rules: </p><ol><li>must be either a "radio" or "checkbox" field type, </li><li>must have the *exact* same choices options in column F, </li><li>must have the same matrix group name in column P. </li></ol><p>If these requirements are not met, the "Upload Data Dictionary" page will not allow you to upload your data dictionary until these errors are fixed.</p></div>
<div id="q1459" class="faqq">How do I convert existing non-matrix multiple choice fields into a matrix of fields?</div>
<div class="faqa">
	<p>Any existing group of radio button fields or checkbox fields in a REDCap project might possibly be converted into a matrix of fields. In order for fields to be grouped together into a matrix, the following things are required: </p><ol><br>
	<li>fields must all be a Radio Button field or all be a Checkbox field, </li><li>they must have the *exact* same multiple choice options (same option label AND same raw coded value), and </li><li>they must all be adjacent to each other on the same data collection instrument (or if not, they can be moved first so that they are adjacent). </li></ol><p>A matrix can be created only if those three conditions are met. The conversion of regular checkbox/radio fields into a matrix of fields cannot be done in the Online Designer but only using the Data Dictionary. To accomplish this:</p><ol><li> Download the existing data dictionary for the project from the "Upload Data Dictionary" page. </li><li>Add to column P (i.e. Matrix Group Name) the matrix group name for *every* field that will be in the matrix.  </li><li>Save and upload the data dictionary on the "Data Dictionary Upload" page</li><li>Confirm those fields display as a matrix on your data collection instrument instead of separate fields.</li></ol><p>NOTE on Matrix Group name: The matrix group name is a tag that is used to group all the <br>
	fields together in a single matrix group. The matrix group name can <br>
	consist only of lowercase letters, numbers, and underscores, and the <br>
	group name must not duplicate any other matrix group name in the <br>
	project. The group name is not ever displayed on the form/survey during <br>
	data entry, but is used only for design and organizational purposes. The<br>
	 matrix group name can be any value (even an arbitrary value), but it <br>
	may be helpful to name it something related to the fields in the group <br>
	(e.g. "icecream" if all the matrix fields are about ice cream).</p>
</div>
<div id="q1453" class="faqq">What is a matrix of fields in REDCap?</div>
<div class="faqa"><p>REDCap can display a matrix group of fields in either Single Answer format (i.e. radio buttons) or Multiple Answer format (i.e. checkboxes). A matrix allows you to display a group of similar multiple choice fields in a very compact area on a page. This makes data entry forms and surveys much shorter looking. Using matrix fields is especially desirable on surveys because survey respondents are much less likely to leave a survey partially completed if the survey appears shorter, as opposed to looking very long, which can feel daunting to a respondent. So having compact sections of questions can actually improve a survey's response rate. </p><p>A matrix can have as many rows or columns as needed. Although the more choices you have, the narrower each choice column will be. Any field in a matrix can optionally have its own branching logic and can be set individually as a required field. A matrix can also optionally have a section header.</p><p><img src="https://redcap.vanderbilt.edu/misc/matrix_example.png" alt=""></p><p><strong></strong></p></div>
</div><div class="subspacediv " id="ss53"><h3 onclick="selectSection(53);window.location.href='#ss53';">Piping</h3>
<div id="q1463" class="faqq">What is Piping?</div>
<div class="faqa"><p>The 'Piping' feature in REDCap allows you to inject previously collected data into text on a data collection form or survey, thus providing greater precision and control over question wording.  See more about piping: <a target="_blank" href="http://tinyurl.com/redcappiping">http://tinyurl.com/redcappiping</a></p></div>
</div><div class="subspacediv " id="ss54"><h3 onclick="selectSection(54);window.location.href='#ss54';">Copy / Share Data Collection Instruments</h3>
<div id="q1467" class="faqq">How can I copy instruments from one project to another?</div>
<div class="faqa">You can do this by downloading the data dictionary from both projects.  You can then copy and paste the fields in the forms you want from one data dictionary to the other. You can do the same for data.  Just export those fields from one and then import into the other after you have uploaded the revised data dictionary.</div>
<div id="q1465" class="faqq">How can I copy an instrument within a project?</div>
<div class="faqa">You can duplicate the form by downloading the data dictionary, copying the relevant rows, changing the name of the form and the variable names on the new rows, and uploading the form.On the Online Designer, you can click the "Choose action" drop-down next to a given instrument to copy the instrument. You will be given the choice to name the new instrument and to also provide the suffix text that gets appended to each variable name to prevent duplication of variable names.</div>
</div><div class="subspacediv " id="ss78"><h3 onclick="selectSection(78);window.location.href='#ss78';">Calculations</h3>
<div id="q1407" class="faqq">Can calculated fields be referenced or nested in other calculated fields?</div>
<div class="faqa"><p>Yes. Calculations can reference other calculations. Be sure to thoroughly test to ensure correct expected values.</p></div>
<div id="q1419" class="faqq">Can I use conditional logic in a calculated field?</div>
<div class="faqa"><p>Yes. You may use conditional logic (i.e. an IF/THEN/ELSE statement) by using the function: </p><p><strong>if (CONDITION, value if condition is TRUE, value if condition is FALSE)</strong> </p><p>Note that all operands in CONDITION must be all numeric or all dates!</p><p>This construction is similar to IF statements in Microsoft Excel. Provide the condition first (e.g. [weight]=4), then give the resulting value if it is true, and lastly give the resulting value if the condition is false.  For example: </p><p>if([weight] &gt; 100, 44, 11)</p><p>In this example, if the value of the field 'weight' is greater than 100, then it will give a value of 44, but if 'weight' is less than or equal to 100, it will give 11 as the result.</p><p>IF statements may be used inside other IF statements (“nested”). Other advanced functions (described above) may also be used inside IF statements.</p></div>
<div id="q1415" class="faqq">What mathematical operations are available for calc fields?</div>
<div class="faqa"><p>+        Add</p><p>-        Subtract</p><p>*        Multiply</p><p>/        Divide</p><p><strong>Null</strong> or <strong>blank</strong> values can be referred to as<strong> ""</strong> or <strong>"NaN"</strong>. Be careful to include the quotes around NaN.</p></div>
<div id="q1411" class="faqq">Can I base my datediff calculation off of today?</div>
<div class="faqa"><p>Yes, for example, you can indicate elapsed months since screening date to the last time a record was edited as: </p><p><strong>datediff("today",[screen_date],"m")</strong></p><p>NOTE: The "today" variable can ONLY be used with date fields and NOT with time, datetime, or datetime_seconds fields.</p><p>It is strongly recommended, HOWEVER, that you do not use "today" in calc fields. This is because every time you access and save the form, the calculation will run. So if you calculate the age as of today, then a year later you access the form to review or make updates, the elapsed time as of "today" will also be updated (+1 yr). Most users calculate time off of another field (e.g. screening date, enrollment date).</p></div>
<div id="q1405" class="faqq">Can fields from different EVENTS be used in calculated fields (longitudinal only)?</div>
<div class="faqa"><p>Yes, for longitudinal projects (i.e. with multiple events defined), a calculated field's equation may utilize fields from other events (i.e. visits, time-points). The equation format is somewhat different from the normal format because the unique event name must be specified in the equation for the target event. The unique event name must be prepended (in square brackets) to the beginning of the variable name (in square brackets), i.e. [unique_event_name][variable_name]. Unique event names can be found listed on the project's Define My Event's page on the right-hand side of the events table, in which the unique name is automatically generated from the event name that you have defined.</p><p>For example, if the first event in the project is named "Enrollment", in which the unique event name for it is "enrollment_arm_1", then we can set up the equation as follows to perform a calculation utilizing the "weight" field from the Enrollment event: [enrollment_arm_1][weight]/[visit_weight]. Thus, presuming that this calculated field exists on a form that is utilized on multiple events, it will always perform the calculation using the value of weight from the Enrollment event while using the value of visit_weight for the current event the user is on.</p></div>
<div id="q1401" class="faqq">What are some common examples of calculated fields?</div>
<div class="faqa"><p>To calculate BMI (body mass index) from height and weight, you can create 'BMI' as a calculated field, as seen below. When values for height and weight are entered, REDCap will calculate the ‘BMI’ field. The data for a calculated field are saved to the database when the form is saved and can be exported just like all other fields.To create a calculated field, you will need to do two things:</p><p>1) Set the Field Type of the new field as Calculated Field in the Online Designer, or 'calc' if you are working in the data dictionary spreadsheet.</p><p>2) Provide the equation for the calculation in the Calculation Equation section of the Online Designer or the 'Choices OR Calculations' column in the data dictionary spreadsheet.</p><p>Below is an example equation for the BMI field above in which the fields named 'height' and 'weight' are used as variables.</p><p>[weight]*10000/([height]*[height])   =   units in kilograms and centimeters</p><p>([weight]/([height]*[height]))*703    =   units in pounds and inches</p><p>A more complex example for another calculated field might be as follows:</p><p>(([this]+525)/34)+(([this]/([that]-1000))*9.4)</p></div>
<div id="q1397" class="faqq">What are calculated fields?</div>
<div class="faqa">REDCap has the ability to make real-time calculations on data entry forms. It is recommended that 'calc' field types are not excessively utilized on REDCap data collection instruments and that they instead be used when it is necessary to know the calculated value while on that page or the following pages or when the result of the calculation affects data entry workflow.</div>
<div id="q1431" class="faqq">If I import data will new and modified data re-run and update the calculate fields?</div>
<div class="faqa">Yes. When performing a data import (via Data Import Tool or API), REDCap will perform the calculations for any calculated fields that are triggered by the values being imported. For example, if you have a BMI field whose calculation is based off of a height field and a weight field, then if you perform a data import of height and weight values, it will automatically calculate the BMI for each record that is imported and also save those calculations and log them on the Logging page.</div>
<div id="q1429" class="faqq">If I need to modify a calculated field, how can I update all the records previously entered?</div>
<div class="faqa">Data Quality rule (rule H) will find and fix all incorrect values for calculated fields in a project. If any calc fields have ended up with incorrect values (whether due to field changes in the project or due to previous data imports), users can now run rule H not only to find any incorrect calculated values, but it will additionally display a button that, when clicked, will auto-fix ALL of them for the project admin.</div>
<div id="q1425" class="faqq">Can I create a calculation that returns text as a result (Ex: "True" or "False")?</div>
<div class="faqa">No.  Calculations can only result in numbers.  You could indicate "1" = True and "0" = False.</div>
<div id="q1423" class="faqq">Why is my advanced calculation not working?</div>
<div class="faqa"><p>The equation may not be formatted correctly. You may try troubleshooting the equation by simplifying the equation first and then add functionality in steps as you test.</p><p>Another way to troubleshoot is to click “view equation”. All the variables you are referencing will be listed. If they are not, you will need to check and confirm the variable names.</p></div>
<div id="q1421" class="faqq">I created a calculated field after I entered data on a form, and it doesn’t look like it’s working. Why not?</div>
<div class="faqa"><p>If you add a calculated field where data already exist in a form, data must be re-saved for the calculation to be performed.</p><p>Use the Data Quality rule H to find and fix all incorrect values for calculated fields in a project.</p></div>
<div id="q1417" class="faqq">Can REDCap perform advanced functions in calculated fields?</div>
<div class="faqa"><p>Yes, it can perform many, which are listed below. NOTE: All function names (e.g. roundup, abs) listed below are case sensitive.</p><table><tbody><tr><td><strong>Function</strong></td><td><strong>Name/Type of function</strong></td><td><strong>Notes / examples</strong></td></tr><tr><td>if (CONDITION, VALUE if condition is TRUE, VALUE if condition is FALSE)</td><td><strong>If/Then/Else conditional logic</strong></td><td>Return a value based upon a condition. If CONDITION evaluates as a true statement, then it returns the first VALUE, and if false, it returns the second VALUE. E.g. if([weight] &gt; 100, 44, 11) will return 44 if "weight" is greater than 100, otherwise it will return 11. All operands in CONDITION must be all numeric or all dates!</td></tr><tr><td>datediff ([date1], [date2], "units", "dateformat", returnSignedValue)</td><td><strong>Datediff</strong></td><td>Calculate the difference between two dates or datetimes. Options for "units": "y" (years, 1 year = 365.2425 days), "M" (months, 1 month = 30.44 days), "d" (days), "h" (hours), "m" (minutes), "s" (seconds). The "dateformat" parameter must be "ymd", "mdy", or "dmy", which refer to the format of BOTH date/time fields as Y-M-D, M-D-Y, or D-M-Y, respectively. If not defined, it will default to "ymd". The parameter "returnSignedValue" must be either TRUE or FALSE and denotes whether you want the returned result to be either signed (have a minus in front if negative) or unsigned (absolute value), in which the default value is FALSE, which returns the absolute value of the difference. For example, if [date1] is larger than [date2], then the result will be negative if returnSignedValue is set to TRUE. If returnSignedValue is not set or is set to FALSE, then the result will ALWAYS be a positive number. If returnSignedValue is set to FALSE or not set, then the order of the dates in the equation does not matter because the resulting value will always be positive (although the + sign is not displayed but implied).</td></tr><tr><td>round(number,decimal places)</td><td><strong>Round</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round 14.384 to one decimal place: round(14.384,1) will yield 14.4</td></tr><tr><td>roundup(number,decimal places)</td><td><strong>Round Up</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round up 14.384 to one decimal place: roundup(14.384,1) will yield 14.4</td></tr><tr><td>rounddown(number,decimal places)</td><td><strong>Round Down</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round down 14.384 to one decimal place: rounddown(14.384,1) will yield 14.3</td></tr><tr><td>sqrt(number)</td><td><strong>Square Root</strong></td><td>E.g. sqrt([height]) or sqrt(([value1]*34)/98.3)</td></tr><tr><td>(number)^(exponent)</td><td><strong>Exponents</strong></td><td>Use caret ^ character and place both the number and its exponent inside parentheses: For example, (4)^(3) or ([weight]+43)^(2)</td></tr><tr><td>abs(number)</td><td><strong>Absolute Value</strong></td><td>Returns the absolute value (i.e. the magnitude of a real number without regard to its sign). E.g. abs(-7.1) will return 7.1 and abs(45) will return 45.</td></tr><tr><td>min(number,number,...)</td><td><strong>Minimum</strong></td><td>Returns the minimum value of a set of values in the format min([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the lowest numerical value. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>max(number,number,...)</td><td><strong>Maximum</strong></td><td>Returns the maximum value of a set of values in the format max([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the highest numerical value. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>mean(number,number,...)</td><td><strong>Mean</strong></td><td>Returns the mean (i.e. average) value of a set of values in the format mean([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the mean value computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>median(number,number,...)</td><td><strong>Median</strong></td><td>Returns the median value of a set of values in the format median([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the median value computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>sum(number,number,...)</td><td><strong>Sum</strong></td><td>Returns the sum total of a set of values in the format sum([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the sum total computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>stdev(number,number,...)</td><td><strong>Standard Deviation</strong></td><td>Returns the standard deviation of a set of values in the format stdev([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the standard deviation computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr></tbody></table></div>
<div id="q1413" class="faqq">Can I calculate a new date by adding days / months / years to a date entered (Example: [visit1_dt] + 30days)?</div>
<div class="faqa">No.  Calculations can only display numbers.</div>
<div id="q1409" class="faqq">How can I calculate the difference between two date or time fields (this includes datetime and datetime_seconds fields)?</div>
<div class="faqa">
	<p>You can calculate the difference between two dates or times by using the function:</p><p><strong>datediff([date1], [date2], "units", "dateformat", returnSignedValue)</strong></p><p>date1 and date2 are variables in your project</p><p><strong>units</strong></p><table><tbody><tr><td><strong>"y"</strong></td><td>years</td><td>1 year = 365.2425 days</td></tr><tr><td><strong>"M"</strong></td><td>months</td><td>1 month = 30.44 days</td></tr><tr><td><strong>"d"</strong></td><td>days</td></tr><tr><td><strong>"h"</strong></td><td>hours</td></tr><tr><td><strong>"m"</strong></td><td>minutes</td></tr><tr><td><strong>"s"</strong></td><td>seconds</td></tr></tbody></table><p><strong>dateformat</strong></p><table><tbody><tr><td><strong>"ymd"</strong></td><td>Y-M-D (default)</td></tr><tr><td><strong>"mdy"</strong></td><td>M-D-Y</td></tr><tr><td><strong>"dmy"</strong></td><td>D-M-Y</td></tr></tbody></table><ul><br>
	<li>If the dateformat is not provided, it will default to "ymd".</li><li>Both dates MUST be in the format specified in order to work.</li></ul><p><strong>returnSignedValue</strong></p><table><tbody><tr><td><strong>false</strong></td><td>(default)</td></tr><tr><td><strong>true</strong></td></tr></tbody></table><ul><br>
	<li>The parameter returnSignedValue denotes the result to be signed or unsigned (absolute value), in which the default value is "false", which returns the absolute value of the difference. For example, if [date1] is larger than [date2], then the result will be negative if returnSignedValue is set to true. If returnSignedValue is not set or is set to false, then the result will ALWAYS be a positive number. If returnSignedValue is set to false or not set, then the order of the dates in the equation does not matter because the resulting value will always be positive (although the + sign is not displayed but implied).</li></ul><p>Examples:</p><table><tbody><tr><td><strong>datediff([dob],[date_enrolled],"d")</strong></td><td>Yields the number of days between the dates for the date_enrolled and dob fields, which must be in Y-M-D format</td></tr><tr><td><strong>datediff([dob],"05-31-2007","h","mdy",true)</strong></td><td>Yields the number of hours between May 31, 2007, and the date for the dob field, which must be in M-D-Y format. Because returnSignedValue is set to true, the value will be negative if the dob field value is more recent than May 31, 2007.</td></tr></tbody></table>
</div>
<div id="q1403" class="faqq">Can fields from different FORMS be used in calculated fields?</div>
<div class="faqa">Yes, a calculated field's equation may utilize fields either on the current data entry form OR on other forms. The equation format is the same, so no special formatting is required.</div>
<div id="q1399" class="faqq">How do I format calculated fields?</div>
<div class="faqa"><p>In order for the calculated field to function, it will need to be formatted in a particular way. This is somewhat similar to constructing equations in Excel or with certain scientific calculators.</p><p>The variable names/field names used in the project's Data Dictionary can be used as variables in the equation, but you must place [ ] brackets around each variable. Please be sure that you follow the mathematical order of operations when constructing the equation or else your calculated results might end up being incorrect.</p></div>
<div id="q1427" class="faqq"><p>Can I create calculations and use branching logic to hide the values to the data entry personnel and/or the survey participants?</p></div>
<div class="faqa">
	<p><br>
		If the calculations result in a value (including "0"), the field will display regardless of branching logic.</p><p><br>
		You can hide calc fields with branching logic if you include conditional logic and enter the "false" statement to result in null:  " " or "NaN".  For example:  if([weight] &gt; 100, 44, "NaN")   Then the field will remain hidden (depending on branching logic) unless the calculation results in a value. Be careful to include the quotes around NaN.</p><p><br>
		Another relatively new option is to use an Action Tag:</p><p><br>
		@HIDDEN<br><br>
	Hides the field on the survey page, the data entry form, and in the REDCap mobile app. Field will stay hidden even if branching logic attempts to make it visible.</p><p><br>
		@HIDDEN-FORM<br><br>
	Hides the field only on the data entry form (i.e., not on the survey page). Field will stay hidden even if branching logic attempts to make it visible.</p><p><br>
		@HIDDEN-SURVEY<br><br>
	Hides the field only on the survey page (i.e., not on the data entry form). Field will stay hidden even if branching logic attempts to make it visible.</p><p><br>
		@HIDDEN-APP<br><br>
	Hides the field only on the form ONLY on the REDCap Mobile App. Field will stay hidden even if branching logic attempts to make it visible.</p>
</div>
</div><div class="subspacediv " id="ss79"><h3 onclick="selectSection(79);window.location.href='#ss79';">Branching Logic</h3>
<div id="q1445" class="faqq">Is it possible to use branching logic to skip an entire section?</div>
<div class="faqa">Branching logic must be applied to each field. It cannot be applied at the form or section level. Section headers will be hidden *only* if all fields in that section are hidden.</div>
<div id="q1451" class="faqq">In Internet Explorer 8, why is the branching logic in a REDCap survey project adversely affected by variable names in which words like return and continue have been used?</div>
<div class="faqa"><p>Words like case, class, continue, new, return, submit, and enum are used in javascript. An error will be returned if branching logic is applied to a field with a variable name in which one or more of these words is present.</p><p>From REDCap v4.3.0 onward, warnings have been added to alert users who use any of the IE-reserved field names such as return.  "New" and "return" have been added as reserved variable names in v4.3.0.  In v4.3.1 the words "continue", "case", "class", and "enum" have been added.  So if the user tries to create a variable name that uses one of those words, REDCap will require him or her to change it.  The words "catch" and "throw" may also cause errors with some versions of Internet explorer.</p></div>
<div id="q1443" class="faqq">Can fields from different EVENTS be used in branching logic (longitudinal only)?</div>
<div class="faqa"><p>Yes, for longitudinal projects (i.e. with multiple events defined), branching logic may utilize fields from other events (i.e. visits, time-points). The branching logic format is somewhat different from the normal format because the unique event name must be specified in the logic for the target event. The unique event name must be prepended (in square brackets) to the beginning of the variable name (in square brackets), i.e. [unique_event_name][variable_name]. Unique event names can be found listed on the project's Define My Event's page on the right-hand side of the events table, in which the unique name is automatically generated from the event name that you have defined.</p><p>For example, if the first event in the project is named "Enrollment", in which the unique event name for it is "enrollment_arm_1", then we can set up the branching logic utilizing the "weight" field from the Enrollment event: [enrollment_arm_1][weight]/[visit_weight] &gt; 1. Thus, presuming that this field exists on a form that is utilized on multiple events, it will always perform the branching logic using the value of weight from the Enrollment event while using the value of visit_weight for the current event the user is on.</p></div>
<div id="q1449" class="faqq">Why does REDCap slow down or freeze and display a message about a javascript problem when I try to use branching logic syntax or Drag-N-Drop Logic builder in a longitudinal project with over 1000 fields?</div>
<div class="faqa"><p>You are encountering a limitation that stems from having a lot of fields especially multiple choice fields in your project.   If a good number of your fields involve multiple choices then the number of choices that the Drag-N-Drop Logic Builder has to load into the pop-up is large. So having a lot of fields with several choices each can slow down the system.  The performance is further affected because REDCap uses javascript (powered by the user's browser) to do the drag-n-drop and also to process the conversion of the advanced syntax to the drag-n-drop method (if you decide to switch methods within the pop-up).</p><p>The slower your computer and the slower your browser (Internet Explorer is the worst, especially versions 6 and 7), than the slower the drag-n-drop method will be.  Chrome is much faster at handling Javascript than other browsers and is recommended.  The only other option is to use the data dictionary for building your branching logic.</p></div>
<div id="q1441" class="faqq">Can fields from different FORMS be used in branching logic?</div>
<div class="faqa">Yes, branching logic may utilize fields either on the current data entry form OR on other forms. The equation format is the same, so no special formatting is required.</div>
<div id="q1435" class="faqq">Is branching logic for checkboxes different?</div>
<div class="faqa"><p>Yes, special formatting is needed for the branching logic syntax in 'checkbox' field types. For checkboxes, simply add the coded numerical value inside () parentheses after the variable name:</p><p><strong>[variablename(code)]</strong></p><p>To check the value of the checkboxes:</p><p>'1' = checked</p><p>'0' = unchecked</p><p>See the examples below, in which the 'race' field has two options coded as '2' (Asian) and '4' (Caucasian):</p><table><tbody><tr><td>[race(2)] = "1"</td><td>display question if Asian is checked</td></tr><tr><td>[race(4)] = "0"</td><td>display question if Caucasian is unchecked</td></tr><tr><td>[height] &gt;= 170 and ([race(2)] = "1" or [race(4)] = "1")</td><td>display question if height is greater than or equal to 170cm and Asian or Caucasian is checked</td></tr></tbody></table></div>
<div id="q1433" class="faqq">What is branching logic?</div>
<div class="faqa"><p>Branching Logic may be employed when fields in the database need to be hidden during certain circumstances. For instance, it may be best to hide fields related to pregnancy if the subject in the database is male. If you wish to make a field visible ONLY when the values of other fields meet certain conditions (and keep it invisible otherwise), you may provide these conditions in the Branching Logic section in the Online Designer (shown by the double green arrow icon), or the Branching Logic column in the Data Dictionary.</p><p>For basic branching, you can simply drag and drop field names as needed in the Branching Logic dialog box in the Online Designer. If your branching logic is more complex, or if you are working in the Data Dictionary, you will create equations using the syntax described below.</p><p>In the equation you must use the project variable names surrounded by <strong>[ ]</strong> brackets. You may use mathematical operators (=,&lt;,&gt;,&lt;=,&gt;=,&lt;&gt;) and Boolean logic (and/or). You may nest within many parenthetical levels for more complex logic.</p><p>You must <strong>ALWAYS</strong> put single or double quotes around the values in the equation UNLESS you are using &gt; or &lt; with numerical values.</p><p>The field for which you are constructing the Branching Logic will ONLY be displayed when its equation has been evaluated as TRUE. Please note that for items that are coded numerically, such as dropdowns and radio buttons, you will need to provide the coded numerical value in the equation (rather than the displayed text label). See the examples below.</p><table><tbody><tr><td>[sex] = "0"</td><td>display question if sex = female; Female is coded as 0, Female</td></tr><tr><td>[sex] = "0" and [given_birth] = "1"</td><td>display question if sex = female and given birth = yes; Yes is coded as 1, Yes</td></tr><tr><td>([height] &gt;= 170 or [weight] &lt; 65) and [sex] = "1"</td><td>display question if (height is greater than or equal to 170 OR weight is less than 65) AND sex = male; Male is coded as 1, Male</td></tr><tr><td>[last_name] &lt;&gt; ""</td><td>display question if last name is not null (aka if last name field has data)</td></tr></tbody></table></div>
<div id="q1439" class="faqq">Can you utilize calculated field functions in branching logic?</div>
<div class="faqa"><p>Yes, see the list of functions that can be used in logic for Report filtering, Survey Queue, Data Quality Module, and Automated Survey Invitations.</p></div>
<div id="q1437" class="faqq">Can you program branching logic using dates?</div>
<div class="faqa"><p>Yes, see the list of functions that can be used in logic for Report filtering, Survey Queue, Data Quality Module, and Automated Survey Invitations.</p></div>
<div id="q1447" class="faqq">My branching logic is not working when I preview my form. Why not?</div>
<div class="faqa">Simply previewing a form within the Online Designer will display all questions. In order to test the functionality of your branching logic (and calculated fields), you must enter new records and enter test data directly into your forms.</div>
<div id="q5701" class="faqq"><p>Is it possible to use branching logic to skip an entire form or forms?</p><h1></h1></div>
<div class="faqa">
	<p><br>
		Branching logic will only hide questions, not entire data collection instruments. If you have a list of data collection instruments (DCIs) in a project (traditional) or event (longitudinal), you will see every form even if you hide all the fields with branching logic on that form. You'll have to click through the forms or "save and go to next form". A work around may be to add a descriptive text (reverse branching logic to show when all fields are hidden) that the form is not applicable to that specific record or just leave the form blank.<br>
	</p><br>
	<p><br>
		If using the Survey Queue for participants entering data, you can hide/display entire surveys.<br>
	</p>
</div>
</div></div><div class="spacediv " id="s55"><div class="subspacediv " id="ss55"><h2 onclick="selectSection(55);window.location.href='#s55';">Data Entry / Collection</h2>
<div id="q1485" class="faqq">In a longitudinal study where the first form is a demographic data collection form is there any way to force the first form to be completed before proceeding to subsequent forms?</div>
<div class="faqa">You can use branching logic to hide the fields on the later forms and add a section header that explains why no fields are present in each form when the branching logic calls for the form to be 'blank'.  The forms that follow the demographic form will still be accessible but fields will be viewable only if a particular field on the demographic form is completed or marked 'Yes'.</div>
<div id="q1483" class="faqq">For calculated fields, sometimes the value pops up when you enter data for the questions and sometimes the value may not appear until you save the form. Is there any reason it's doing this?</div>
<div class="faqa">Depending on which internet browser you are using, sometimes the calc fields are calculated during data entry. However, these are just preliminary calculations. You must click the save button for the system to correctly calculate the expression and commit the data to the database.Use the Data Quality rule H to find and fix all incorrect values for calculated fields in a project.</div>
<div id="q1481" class="faqq">How do I delete all my records at once?</div>
<div class="faqa">In development mode, the Other Functionality tab has a button to erase all data. This is useful when you are iteratively testing your project and want to practice your data entry several times, starting with an empty project each time.In production mode, records must be deleted individually. Because of this limitation, if you truly need to erase all data in production mode, you may want to consider copying your project and using the copied version instead. That copied version would be in development mode and have no records/data. (It would also be totally separate to the original project, ensuring you still had the original data and could quickly reference it in the future.)</div>
<div id="q1479" class="faqq">Is there a way to delete data in a given record for just single instrument or event (not the entire record)?</div>
<div class="faqa">Yes! First, follow the instructions in the section above about deleting an individual record to ensure you have the correct permissions on your user account. Then, open any record or survey response. You will find the delete options underneath the 'save' buttons at the bottom of the page. There are options to erase all this record's data on the current instrument OR on the current event (longitudinal projects ONLY).</div>
<div id="q1475" class="faqq">Do I need to select the record number again each time I change data entry forms?</div>
<div class="faqa">No. To navigate between forms within a given record, select the colored dots indicating form status (i.e. incomplete, unverified, and complete) which appear to the left of the form name when a record is open. Note that moving to a new form by selecting the form status indicator will close the current form without saving entries. In order to save entries, select the “Save and Continue” button located at the bottom of the form before using the form status indicators to move to a new form. Alternatively, you can select the “Save and go to Next Form” button if you wish to move to the next form for the current record.</div>
<div id="q1469" class="faqq">What is the Record Status Dashboard?</div>
<div class="faqa">This is a table listing all existing records/responses and their status for every data collection instrument (and for a longitudinal project, for every event).  When viewing this page, form-level privileges are utilized (i.e. cannot see a form's status if user does not have access to that form), and if the user belongs to a Data Access Group, they will only be able to view the records that belong to their group.Note: Since projects may now have many surveys, REDCap no longer displays the Survey Response Summary on the Project Home page.</div>
<div id="q1477" class="faqq">How do I delete an individual record?</div>
<div class="faqa">
	<p><br>
		Existing records must be deleted by opening each one individually and deleting them. To do so, you must first have permission to delete records.<br>
	</p><br>
	<p><br>
		Go to the User Rights page. (This link is in the Applications section of the project menu.) Open your account, and scroll to the bottom of the screen. There, you’ll find the permission to delete records. Select that option and save your account.<br>
	</p><br>
	<p><br>
		Then, open any record or survey response. You will find the delete options underneath the ‘save’ buttons at the bottom of the page. You can use the 'delete record' button to completely erase all data across all instruments for the given record. <br>
	</p><br>
	<p><br>
		NOTE for surveys: If the project uses surveys, you’ll additionally need the ‘Edit survey responses’ permission. This separate permission is in the Data Entry Rights section of your account, in the upper right of the screen. On the survey response page, you’ll first need to click the ‘Edit survey response’ button at the top of the record before the ‘delete record’ button will be enabled.<br>
	</p>
</div>
<div id="q1473" class="faqq">Can I edit survey responses?</div>
<div class="faqa"><p>Yes, survey responses CAN be edited so long as you have been given user privileges to do so (via the User Rights page). Once you have been given user privileges to edit survey responses, you will see an Edit Response button at the top of the data entry form when viewing the response (the response will be initially read-only). After clicking that button, the response will become editable as normal. </p><p>NOTE: Some institutions running REDCap may choose not to enable this feature for their users, so if a checkbox is not seen next to the survey/form rights for that survey on the User Rights page, then this feature has not been enabled and thus cannot be utilized. Contact your REDCap Administrator.</p></div>
<div id="q1471" class="faqq">How do I enter / view my data?</div>
<div class="faqa"><p>To enter or view individual records, you can navigate to the "<strong>Data Collection</strong>" section on the left menu bar.  Depending on your project type, you will see "Add or View Survey Responses", a listing of your form names, or a "Data Entry" icon.  These options will navigate you to the drop down record lists so you can select or add a new record/response.</p><p>You can also use the "<strong>Data Exports, Reports and Stats</strong>" module under "Applications" to view your data. Create New Reports to search and view your project data in aggregate. </p><ul><li>When you click "View Report", it queries the database in real time and displays the resulting data in table format. Variables are listed in columns and individual records are displayed in rows.</li><li>Clicking the "Stats &amp; Charts" option within Data Exports, Reports and Stats module, displays graphical representations for all numerical and categorical variables and provides links for cleaning notable data (missing, highest, lowest values). </li></ul></div>
</div><div class="subspacediv " id="ss56"><h3 onclick="selectSection(56);window.location.href='#ss56';">Surveys: Anonymous surveys</h3>
<div id="q1487" class="faqq">Can I use the Participant List to collect anonymous survey data from participants?</div>
<div class="faqa">
	<p><br>
		Technically, no. Data is not anonymous when collected using the Participant List; but it can be "coded" and "unidentifiable" to the project admins.<br>
	</p><br>
	<p><br>
		REDCap's user interface has two separate modules for (1) sending emails and tracking responders/non-responders [Participant List] and (2) viewing data/responses. Through the REDCap interface, there is no link between the modules and no connection between the email address entered and the responses collected unless you enter unique values into the "Participant Identifier (optional)" field. The Participant Identifier field links the email address to the survey responses.<br>
	</p><br>
	<p><br>
		To ensure confidentiality of the data, REDCap tracks responses by attributing it to an email address. If the Participant List &gt; Participant Identifier field is not used, the project administrators are not privy to this information. Access to the association between the individual who took the survey and the survey responses is restricted in the database and can only be accessed by authorized privileged users(system engineers, database admins).<br>
	</p><br>
	<p><br>
		<strong>**Important to know: </strong>There is a link “behind the scenes” and REDCap / REDCap support personnel (system engineers, database admins) are really acting as an “Honest Broker”: information is provided to investigators in such a manner that it would not be reasonably possible for the investigator or others to identify the corresponding patients-subjects directly or indirectly. REDCap holds the key to the code.<br>
	</p><br>
	<p><br>
		<strong>** If you truly need Anonymous Data, use the Public Survey Link.</strong><br>
	</p><br>
	<p><br>
		For the Participant List, the identifying emails can be forever stripped from the data with no way for anyone to go back and find out the identity of the individual from whom the data the was obtained. No re-identification is possible if you do the following:<br>
	</p><br>
	<ol><br>
		<li>Export a copy of the REDCap dataset (so you have a copy of the data + date/time stamps if needed for future reference)</li><br>
		<li>EXPORT LIST for the Participant List to excel</li><br>
		<li>REMOVE ALL PARTICIPANTS from the Participant List. This will delete all links between the email addresses and data collected, INCLUDING survey date/time stamps. Date/time entered is still available in the Logging module.</li><br>
	</ol><br>
	<p><br>
		This ensures that identities cannot be reversed engineered in REDCap.<br>
	</p><br>
	<p><br>
		<strong>**If data collection must be anonymous in "real time", then the Participant List should NOT be used.</strong> Use the Public Survey Link to collect anonymous survey data.<br>
	</p><br>
	<p><br>
		It is recommended that you keep access to the Manage Survey Participants tool restricted since a small number of respondents would be easily identifiable from the Participant List and the Add / Edit Records pages.<br>
	</p><br>
	<p><br>
		<strong>Additional guidelines to help you collect unidentifiable coded survey data:</strong><br>
	</p><br>
	<p><br>
		Multiple Surveys: Be mindful that projects with multiple surveys present potential challenges to anonymous data collection.<br>
	</p><br>
	<p><br>
		Only participants that answer the first survey will be able to respond to the follow-up surveys. If you wish to collect additional surveys for the non-responders, you will need to create additional REDCap projects with the follow-up surveys or you may have to open the survey using the link provided and save the survey without data (issue will be required fields).<br>
	</p><br>
	<p><br>
		LACK OF DATA MAY INADVERTENTLY IDENTIFY PARTICIPANTS: If you are using the Participant List to send 3 surveys, a scenario may arise in which a high number of subjects respond to the first 2 surveys and only 1 or 2 subjects respond to the last survey.<br>
	</p><br>
	<p><br>
		As you know, each exported record will contain a subject's response to all of the survey questions. In this scenario, you will need to be aware that the lack of data for the third survey can inadvertently identify a subject's identity and his/her responses to all prior surveys.<br>
	</p><br>
	<p><br>
		For this reason,<br>
	</p><br>
	<p><br>
		1. Do not EXPORT any of the project data until the survey in question is completed and closed.<br>
	</p><br>
	<p><br>
		2. Before exporting survey data:<br>
	</p><br>
	<ul><br>
		<li>Review the number of responses (for each survey in the project) and make a judgment as to whether or not enough responses have been received to ensure that subject identities can remain unidentified. This is particularly critical when using the Participant List, as this list will identify the individuals who have responded. A low count of responses could be problematic. Take care to ONLY export and view data from surveys that have a suitable number of responses. For example, if only one response has been received (and the Participant List identifies that <a href="mailto:jsmith@yahoo.com">jsmith@yahoo.com</a>&lt;<a href="mailto:jsmith@yahoo.com">mailto:jsmith@yahoo.com</a>&gt; has responded), you will know that this single response belongs to that subject.</li><br>
		<li>Only export the data associated with a closed survey (both single and multi-survey projects). Once data has been exported, no further responses should be received or allowed.</li><br>
	</ul><br>
	<p><br>
		Also note: Projects containing data entry forms and surveys cannot be considered anonymous. Manually entered data needs to be identified by the team to be properly associated and linked with survey responses.<br>
	</p>
</div>
</div><div class="subspacediv " id="ss57"><h3 onclick="selectSection(57);window.location.href='#ss57';">Surveys: Invite Participants</h3>
<div id="q1503" class="faqq">What is the Survey Invitation Log?</div>
<div class="faqa">This log list participants who (1) Have been scheduled to receive invitation Or (2) Have received invitation Or (3) Have responded to survey.You can filter to review your participants response statuses.</div>
<div id="q1501" class="faqq">If I'm using the Participant Contact List to email survey invites and our mail server fails, REDCap may still return success messages even when no emails have been sent.  Can the error reporting be improved when sending emails?</div>
<div class="faqa">In general, the error reporting for sending emails probably cannot be improved.  The email sending process is embedded in a chain of events that involves different systems.  The REDCap application is far removed from some of the other systems and therefore cannot always know if a system at the delivery end sent the email.</div>
<div id="q1499" class="faqq">Is there a limit to the time that a participant has to complete a survey once they have clicked on the survey link?</div>
<div class="faqa">There is a time limit of 24 hours per page.  If a participant selects the "!Save&amp;Return" option, their link is active until the project admin closes/de-activates the survey.</div>
<div id="q1497" class="faqq">What is the “Start Over” feature for survey participants invited via Participant List?</div>
<div class="faqa">The survey page allows participants invited via the Participant List to start over and re-take the entire survey if they return to the survey when they did not complete it fully, but the “Start Over” feature is only available if the Save &amp; Return Later feature is disabled or if it is enabled and the participant did not click the Save &amp; Return Later button. .</div>
<div id="q1493" class="faqq">I only get a public link when the first survey instrument is a survey. Where can I find public links for the other surveys in my project?</div>
<div class="faqa">A public link is only possible when the first instrument is a survey. Only that survey can have a public link.All later instruments are considered a continuation of the earlier one(s). Later surveys capture different data, but are completed by the same people. So the later instruments can only ever be distributed via Participant List.If different respondents will complete the other surveys, then a separate project should probably be used for each group of respondents.</div>
<div id="q1495" class="faqq">Can email distribution lists or group email accounts be added to the Participant List to send survey invitations?</div>
<div class="faqa"><p>You should not use REDCap's Participant Email Contact list with group email addresses or distribution lists.  The emailed invitations send only 1 uniquesurvey link per email address; therefore, only the first person in the distribution group who clicks on the email link will be able to complete the survey.</p><p>For group distribution lists, you can:</p><ol><li>Email the general "public" survey link provided at the top of the "Invite Participants" page directly from your email account, or</li><li>Add each individual email address from the distribution list to the Participant Contact list.  You can copy/paste the emails from a list (word or excel) into REDCap.</li></ol><p>The advantages of using REDCap's Participant Contact list and the individual emails is that REDCap will track responders and non-responders.</p><p>You'll be able to email only non-responders if you want to send a reminder.  With the general distribution email, you won't be able to track responses and participants will have the potential to complete the survey more than once.</p></div>
<div id="q1491" class="faqq">How do I manage multiple surveys Participant Contact Lists?</div>
<div class="faqa"><p>For for projects with multiple surveys, there will be one participant list per survey.  You’ll be able to select the survey specific to survey name and event (longitudinal projects).</p><p>Participant List may be used to: </p><ol><li>Send emails to many participants at once </li><li>Send individual survey invites directly from a data entry form</li></ol><p>The Public Survey Link and Participant List have been separated onto different pages within Manage Survey Participants because they each represent a different method for inviting survey participants.</p><p>Note: To be able to add participants directly to the Participant Contact List, the first data collection instrument (DCI) must be enabled a survey. All participants of all surveys must be added to the first survey of the project.  If the first DCI is not a survey, you can add an email address to the first DCI and use the feature "Designate an Email" which will auto-populate the Participant Contact List.</p></div>
<div id="q1489" class="faqq">How do I send out my survey?</div>
<div class="faqa">
	<p><br>
		The most common methods to send out a survey are the Public Link and the Participant List. These methods are on the "Manage Survey Participants" page, which is accessed through the project menu's Data Collection section.</p><p><br>
		<strong>Public Link:</strong>  This is a single survey link for your project which all participants will click on.  This link can be copy and pasted into the body of an email message in your own email client. It can also be posted to web pages. This is the most common method for large, anonymous surveys where you do not need to follow-up with survey respondents.</p><p><br>
		<strong>Participant List:</strong>  This option allows you to send emails through REDCap and thereby track who responds to your survey. It is also possible to identify an individual's survey answers by providing an Identifier for each participant. This is the most common method when you need to know who has responded so far and who hasn't.</p><p><br>
		<strong>Designate an Email Field: </strong> You can capture email addresses for sending invitations to your survey participants by designating a field in your project. If a field is designated for that purpose, then any records in your <br>
	project that have an email address captured for that particular field <br>
	will have that email address show up as the participant's email address in the Participant List (unless an email address has already been entered for that participant in the Participant List directly).</p><p><br>
		Using the designated email address field can be especially valuable when your first data collection instrument is not enabled as a survey while one or more other instruments have been enabled as surveys. Since email addresses can only be entered into the Participant List directly for the first data collection instrument, the designated email field provides another opportunity to capture the email address of survey participants.<br>
		<br><br>
		<strong></strong></p><p><br>
		<strong></strong>NOTE:<strong> </strong>If the participant's email address has already been captured directly in the Participant List, then that email address will supersede the value of the email field here when survey invitations are sent to the participant.</p><p><br>
		<strong>Compose Survey Invite: </strong>This option is available on the Participant List and on survey data entry pages for individual records. This allows you to create and send the actual survey invitations.</p>
</div>
</div><div class="subspacediv " id="ss58"><h3 onclick="selectSection(58);window.location.href='#ss58';">Surveys: Automated Survey Invitations</h3>
<div id="q1521" class="faqq">If I create a timestamp field, including hours, minutes, and days, can I create an automated survey invitation that will detect how many days it has been since the timestamp?</div>
<div class="faqa">It's possible, but if you do this be aware that the server-side (PHP) datediff function always treats the 'today' keyword as being the first second of the day. If your timestamp value is at six pm (18:00:00), then an ASI checking the datediff on the same day as that timestamp will actually return a result of 0.75 days. On the next day it will return 0.25 days, regardless of what time of day it is checked. On succeeding days it will return 1.25, 2.25, 3.25, etc.</div>
<div id="q1519" class="faqq">If a survey has already been completed, will the scheduler still send out survey invitations?</div>
<div class="faqa">There are a variety of reasons why survey invitations might be in the schedule to be sent even though a survey is already completed. The survey invite might have been both manually scheduled and automatically scheduled. The survey invite might have been scheduled but then the URL for the survey sent to the participant directly.Regardless, the scheduler will not send out a survey invitation for an already completed survey.</div>
<div id="q1517" class="faqq">Do automated survey invitations preclude manual survey invitations?</div>
<div class="faqa">Automated survey invitations do not preclude manual survey invitations or vice versa.An automated survey invitation will not be scheduled if an automated survey invitation has previously been scheduled, but if an automated survey invitation's logic is checked and found to be true, a survey invitation will be scheduled regardless of whether or not a survey invitation has been previously scheduled manually.Likewise, if an automated survey invitation has been scheduled, one can still schedule a survey invitation manually.</div>
<div id="q1515" class="faqq">How can I schedule a survey invitation to go out at a specific time?</div>
<div class="faqa">You can use a form of scheduling that allows you to specify next day, next Monday, etc.  However that form of scheduling will not allow you to specify a lapse of a certain number of days.</div>
<div id="q1505" class="faqq">What are Automated Survey Invitations?</div>
<div class="faqa"><ol></ol><ol></ol><p>For any survey in your REDCap project, you may define your conditions for Automated Survey Invitations that will be sent out for a specified survey. This is done on the Online Designer page. Automated survey invitations may be understood as a way to have invitations sent to your survey participants, but rather than sending or scheduling them manually via the Participant List, the invitations can be scheduled to be sent automatically (i.e. without a person sending the invitation) based upon specific conditions, such as if the participant completes another survey in your project or if certain data values for a record are fulfilled.</p><p>Below are some guidelines to keep in mind when creating automated survey invitations:</p><ol><li>The 'today' variable should be used only in conjunction with datediff.  Comparing 'today' to a date is unreliable.</li><li>It's a good practice to set up a field that can be used to explicitly control whether or not any invitations should be scheduled for a record. This allows for logic like the following:<p><strong>datediff([surgery_arm_2][surgery_date], `today`, `d`, true) = 6 and [enrollment_arm_1][prevent_surveys] != `1`</strong></p></li><li>All fields in all forms on all arms are always available to the conditional logic of an ASI rule. If there is no value saved for that field, an empty string is used. </li></ol></div>
<div id="q1507" class="faqq">What mathematical operations can be used in the logic for Automated Survey Invitations?</div>
<div class="faqa"><p>+        Add</p><p>-        Subtract</p><p>*        Multiply</p><p>/        Divide</p></div>
<div id="q1511" class="faqq">How can I use automated survey invitations to send invitations a specific number of days after a date given by a variable?</div>
<div class="faqa"><p>Suppose you want to send a followup survey seven days after a surgery. You could define the condition of an automated survey invitation rule to detect that six days have passed since the surgery date and then schedule the survey invitation to be sent on the next day at noon. By checking for the sixth day instead of the seventh day, you gain the ability to set the specific time to send the invitation and you gain the opportunity to stop the sending of the invitation, if it turns out that you don't really want to send it.</p><p>The condition logic would look like: datediff([surgery_date], 'today','d', true) = 6</p><p>You could, instead, check that one day has passed and then set the invitation to be sent six days later, but you would lose the ability to set the specific time that the invitation is sent.</p></div>
<div id="q1513" class="faqq">When are automated survey invitations sent out?</div>
<div class="faqa"><p>Automated Survey Invitations are survey invitations that are automatically scheduled for immediate or future sending when certain conditions are true.</p><p>Creating an automated survey invitation requires:</p><ol><li>Composing an email message.</li><li>Specifying the conditions that will trigger an email to be scheduled.</li><li>Specifying how to schedule the triggered email (such as: immediately, after a delay, on a specific day).</li></ol><p>NOTE: In previous versions, conditions that used the "today" variable would require extra effort to make sure they were checked every day, but REDCap now detects and checks those conditions daily. The conditions are checked every twelve hours. The specific times they are checked during the day varies from one instance of REDCap to the next and changes over time.</p></div>
</div><div class="subspacediv " id="ss59"><h3 onclick="selectSection(59);window.location.href='#ss59';">Surveys: How to pre-fill survey questions</h3>
<div id="q1523" class="faqq">Can I pre-fill survey questions so that some questions already have values when the survey initially loads?</div>
<div class="faqa">
	<p>Yes, his can be done two different ways as seen below. This only works for the first page if it is a multi-page survey. <em><br></em></p><p><strong>NOTE: These two methods are likely to be only used for public survey links as opposed to using the Participants List. </strong>This is because there is not a real opportunity to modify the survey links sent to participants via the Participants List because REDCap automatically sends them out as-is.</p><p><strong>1) Append values to the survey link:</strong> The first method is for pre-filling survey questions by appending URL parameters to a survey link. The format for adding URL parameters is to add an ampersand (&amp;) to the end of the survey link, followed by the REDCap variable name you wish to pre-fill, followed by an equals sign (=), then followed by the value you wish to pre-fill in that question. </p><p>For example, if the survey URL is <em><a href="https://redcap.vanderbilt.edu/surveys/?s=dA78HM">https://redcap.vanderbilt.edu/surveys/?s=dA78HM</a></em> </p><p>then the URL below would pre-fill "Jon" for the first name question, "Doe" for last name, set the multiple choice field named "gender" to "Male" (whose raw/coded value is "1"), and it would check off options 2 and 3 for the "race" checkbox. <strong><br></strong></p><pre><a href="https://redcap.vanderbilt.edu/surveys/?s=dA78HM&amp;first_name=Jon&amp;last_name=Doe&amp;gender=1&amp;race___2=1&amp;race___3=1">https://redcap.vanderbilt.edu/surveys/?s=dA78HM&amp;first_name=Jon&amp;last_name=Doe&amp;gender=1&amp;race___2=1&amp;race___3=1</a><br>
</pre><p><strong>WARNING: This method is not considered secure for transmitting <br>
	confidential or identifying information (e.g. SSN, name), even when <br>
	using over SSL/HTTPS. </strong>If you wish to pre-fill such information, it is highly recommended to use method 2 below.</p><p><strong></strong></p><p><strong>2) Submit an HTML form to a REDCap survey from another webpage:</strong> The second method is for pre-filling survey questions by posting the values from another webpage using an HTML form. This webpage can be *any* webpage on *any* server. See the example below. The form's "method" must be "post" and its "action" must be the survey link URL. The form's submit button must have the name "__prefill" (its value does not matter). Each question you wish to pre-fill will be represented as a field in the form, in which the field's "name" attribute is the REDCap variable name and its value is the question value you wish to pre-fill on the survey page. The form field may be an input, text area, or select field. (The example below shows them all as hidden input fields, which could presumably have been loaded dynamically, and thus do not need to display their value.) If submitted, the form below would pre-fill "Jon" for the first name question, "Doe" for last name, set the multiple choice field named "gender" to "Male" (whose raw/coded value is "1"), and it would check off options 2 and 3 for the "race" checkbox. In this example, the only thing that would be seen on the webpage is the "Pre-fill Survey" button.</p><pre>&lt;!-- Other webpage content goes here --&gt;<br>
&lt;form method="post" action="https://redcap.vanderbilt.edu/surveys/?s=dA78HM"&gt;<br>
&lt;input type="hidden" name="first_name" value="Jon"&gt;<br>
&lt;input type="hidden" name="last_name" value="Doe"&gt;<br>
&lt;input type="hidden" name="gender" value="1"&gt;<br>
&lt;input type="hidden" name="race___2" value="1"&gt;<br>
&lt;input type="hidden" name="race___3" value="1"&gt;<br>
&lt;input type="submit" name="__prefill" value="Pre-fill Survey"&gt;<br>
&lt;/form&gt; <br>
&lt;!-- Other webpage content goes here --&gt;</pre>
</div>
</div><div class="subspacediv " id="ss60"><h3 onclick="selectSection(60);window.location.href='#ss60';">Double Data Entry</h3>
<div id="q1531" class="faqq">As a double data entry Reviewer, how can I make sure the Data Entry personnel do not modify their records after I create a final merged record?</div>
<div class="faqa">If you do not want data entry personnel to update records after a review and merge, you can enable the User Right &gt; "Lock/Unlock Records" for the Reviewers.  The Reviewers can then lock any records prior to a merge.  The data entry personnel without this right will not be able to make updates to the locked record without first contacting the Reviewer.</div>
<div id="q1529" class="faqq">In a project using the double data entry module, can I make changes in one of the merged records?</div>
<div class="faqa">A record can be merged only once. For example records "AA--1" and "AA--2" merge to create record "AA".After merging, the user in role Data Entry Person One can still make changes and only record "AA--1" will be changed.The person in role Data Entry Person Two can make changes and only record "AA--2" will be changed.A person in role Reviewer can view all three records that can be edited like any record in a database. The reviewer can use the Data Comparison Tool to see discrepancies in the three versions. The reviewer may then access the merged record and add data. What she adds in the "AA" record will not be added to either "AA--1" or "AA--2" unless she opens them and makes the addition. She can see, and make manual changes, but cannot use "merge" again.An alternative is to delete the merged version "AA", let the Data Entry people make changes themselves and then merge the records.</div>
<div id="q1525" class="faqq">What is the Double Data Entry module?</div>
<div class="faqa">As a preventive measure, REDCap prevents users from entering duplicate records. However, some projects may need to enter data twice for each record as a means of ensuring quality data collection by later comparing the records. This can be done using the Double Data Entry Module. When the module is enabled, REDCap collects data differently than normal. It allows you to designate any two project users or roles as "Data Entry Person 1" and "Data Entry Person 2", which is done on the User Rights page. Once designated, either of these two users can begin entering data independently, and they will be allowed to create duplicate records. They will not be able to access each other's data, and only normal users (called Reviewers) will be able to see all three copies of the data. Once each designated data entry person has created an instance of the same record, both instances can then be compared side by side on the Data Comparison Tool page and merged into a third instance.</div>
<div id="q1527" class="faqq">How do you set up Double Data Entry?</div>
<div class="faqa"><p>The Double Data Entry (DDE) module that needs to be enabled by a REDCap administrator prior to any data is collected in the project. This module allows two project users or roles to be set as Data Entry Person 1 and Data Entry Person 2 (using User Rights page), and allows them to create records with the same name and enter data for the same record without seeing one another's data. </p><ul><li>Only one person or role at a time can be set as Data Entry Person 1 or 2. </li><li>All other users are considered Reviewers. </li><li>Reviewers have the ability to merge a record created by Data Entry Person 1 and 2 after viewing differences and adjudicating those differences using the Data Comparison Tool, thus creating a third record in the set.</li></ul><p>It is sometimes recommended to use the Data Access Groups over the actual DDE module to implement a form of double data entry. The advantages of using DAGs include allowing an unlimited number of users to be in a group and enter data, to utilize the Data Import Tool, and to access all Applications pages. Discrepancies between double-entered records can be resolved by a “reviewer” (i.e. someone not in a group) using the Data Comparison Tool. However, two records can ONLY be merged together when using the DDE module. So if it is necessary for a third party "reviewer" to merge the two records into a third record, then in that case the DDE module would be advantageous over using DAGs.</p></div>
</div><div class="subspacediv " id="ss61"><h3 onclick="selectSection(61);window.location.href='#ss61';">Data Resolution Workflow</h3>
<div id="q1539" class="faqq">Q:Are the Field Comments logged?</div>
<div class="faqa">Yes. All comments entered for the Field Comment Log and Data Resolution Workflow are now logged on the Logging page. In previous versions, the project Logging page noted the action performed and the record/event/field, but it did not explicitly display the comment entered.</div>
<div id="q1537" class="faqq">Can I edit the Field Comments?</div>
<div class="faqa">Yes. Field Comments may be edited and deleted. For all existing projects and all new projects created, the ability to edit/delete a field comment will be enabled by default. If users do *not* wish to allow this functionality, they may disable it for the project on the Project Setup &gt; Optional Customizations popup.</div>
<div id="q1535" class="faqq">What is a Field Comment?</div>
<div class="faqa">When the Data Resolution Workflow is not enabled, the field comments, indicated by the balloon icon next to a field, are enabled by default. Any user with data entry rights can create comments. These comments are recorded in the Field Comment Log, which appears in the list of Applications.</div>
<div id="q1533" class="faqq">What is the Data Resolution Workflow?</div>
<div class="faqa">The Data Resolution Workflow, sometimes called a data query, is a process for managing and documenting resolution of data entry issues. This tool can be enabled in the “Additional Customizations” section of the Project Setup tab. A data query can be initiated on a data entry form by clicking the balloon icon next to a field, or in the Data Quality module when discrepancies are found. Individual users must be granted appropriate User Rights to open, respond to, or close data queries. Further instructions for using the Data Resolution Workflow can be found on the “Additional Customizations” section of the Project Setup tab and in the “Resolve Issues” section of the Data Quality module.</div>
</div></div><div class="spacediv " id="s62"><div class="subspacediv " id="ss62"><h2 onclick="selectSection(62);window.location.href='#s62';">Applications</h2>
<div id="q1541" class="faqq">What about data exports, reports and stats?</div>
<div class="faqa">The data export tool, the report builder and the statistics applications have been merged into one application called `Data Exports, Reports, and Stats`. You can now export any report (custom or default) and view the statistics for that report.</div>
</div><div class="subspacediv " id="ss63"><h3 onclick="selectSection(63);window.location.href='#ss63';">Data Exports, Reports, and Stats</h3>
<div id="q1569" class="faqq">When I increase the font size on my data collection instruments using HTML tags it is not reflected when I print a pdf. Is there any way to increase the font size in the pdf?</div>
<div class="faqa">No. The pdf prints in standard format and does not print the formats created with the HTML tags.</div>
<div id="q1579" class="faqq">What algorithm/method is used to calculate the percentiles of numerical fields on this page?</div>
<div class="faqa">The method used for calculating the percentile values is the same algorithm utilized by both R (its default method - type 7) and Microsoft Excel.</div>
<div id="q1577" class="faqq">How can I export the graphs and charts to use in presentations?</div>
<div class="faqa">You can "Print page" link at the top of the page and print to Adobe (tested with Adobe Acrobat Pro). Once you have an Adobe file, right click on the graphs and “save image as”. You can then paste into MS Word and Power Point.You can also “Print Screen” (Alt-Print Screen in Windows or Ctl+Cmd+Shift+4 in Mac) to copy to the clipboard and paste in MS Word and Power Point. The graphs can be manipulated as images.</div>
<div id="q1575" class="faqq">Is there a way to specify variable lengths for different variable types for example when reading in the csv file into the SAS editor?</div>
<div class="faqa">When exporting data, the format statements in REDCap's SAS editor specify that text fields have a length of 500 and numeric fields are set to BEST32.  However once you read the data set into SAS you can run a macro that will specify the "best" length for character variables and numeric variables.</div>
<div id="q1573" class="faqq">How can I ensure that the leading zeros of the id numbers in a database where this data is stored in a text field are retained when the data is exported?</div>
<div class="faqa">Excel will discard the leading zeros if you open your export file in Excel.  The leading zeros will be retained if you open the file in Notepad.  Rather than opening the file directly in Excel you should open the data into Excel and specify that the column with the leading zeros is a text column.</div>
<div id="q1571" class="faqq">My REDCap project contains non-English/non-Latin characters, but when I export, why aren’t the characters rendering correctly?</div>
<div class="faqa">If you’re using MS Excel, it does not render all languages and characters unless multi-language updates are purchased. The use of OpenOffice.org CALC (free download) application enables you to build the data dictionary, save as .csv and upload to REDCap. CALC will ask you for a character set every time you open a .csv file. Choose "unicode (utf-8)" from the options listed. REDCap does not render UTF8 characters to the PDFs.</div>
<div id="q1567" class="faqq">Can I export all my data as PDFs or do I have to download each subject’s PDF individually?</div>
<div class="faqa">You may export data for all records in a project into a single PDF file.  This option is on the Data Export Tool page.  The file will contain the actual page format as you would see it on the data entry page or survey and includes all data for all records for all data collection instruments.</div>
<div id="q1563" class="faqq">Can I export data in Development to practice this function?</div>
<div class="faqa">Yes. It is recommended that you export your test data for review prior to moving your project into Production. In development, all the applications function like they would in Production; however changes in Production cannot be made in real time. So it's best to make sure your database is tested thoroughly, including the data export.</div>
<div id="q1561" class="faqq">What are the dark gray sections of my report?</div>
<div class="faqa">When viewing reports in longitudinal projects, any fields displayed in the report that are not designated for that particular event (i.e., row in the report) will be grayed out to show that the field is not designated. This makes it easier for users to discern if a field's value is not applicable or if it is missing.</div>
<div id="q1559" class="faqq">Why can I order the results three times (e.g. First order by last name, then first name, finally middle name)?</div>
<div class="faqa">This is useful when you are ordering the report with a field that can contain duplicates (last name, date of birth, etcetera). The second and third order layer will allow you to fine-tune your report more.</div>
<div id="q1557" class="faqq">Can I copy my report over to another project?</div>
<div class="faqa">Not if the project already exists. You can copy all reports into a copy of your project as an optional setting during the copying process.</div>
<div id="q1555" class="faqq">Can I include the survey identifier field and survey time stamp fields in my report?</div>
<div class="faqa">Yes. Time stamps and survey id are not included in reports by default. You can enable it in step 2 "Additional fields" of the “Create New Report” tab.</div>
<div id="q1553" class="faqq">Can I restrict access to a custom report?</div>
<div class="faqa">Yes. You can choose who sees the report by selecting “All users” or “Custom user access”. You can customize access based on individual users and data access groups.</div>
<div id="q1551" class="faqq">Can I give access for a report to an user that’s not part of my project?</div>
<div class="faqa">No, people that can access reports need to be part of the project. You can add users in the user rights menu.</div>
<div id="q1549" class="faqq">How can I use the reports to find “blank”, “null”, or “missing” data?</div>
<div class="faqa">If you want to find instances in your data where a field's value is blank/null, you can use the report “Filter”.  Include the variable and leave the value text box blank. Conversely, to find instances where the field has a value (i.e., is non-blank), set the operator as 'not =' with a blank text box.</div>
<div id="q1547" class="faqq">Can I add entire instruments to my report, instead of individual variables?</div>
<div class="faqa">Yes, “Create New Report” tab under Step 2, look to the top right corner for a dropdown menu. Selecting any form from the drop down will add all variables in that form to the report.</div>
<div id="q1543" class="faqq">I just want to export my entire data set. How do I do that?</div>
<div class="faqa">Go to the "Data Exports, Reports, and Stats" application and hit the "Export Data" button in the very first report (A: All data (all records &amp; fields)). Then follow the prompts.</div>
<div id="q1565" class="faqq">When exporting data from redcap into SPSS, will the variable codes that you've defined be automatically imported into SPSS (for ex 1, Female  2, Male)?</div>
<div class="faqa"><p>Yes. REDCap uses the metadata you have defined in your data dictionary to create syntax files for SPSS, SAS, R, and Stata. The Data Export tool includes instructions for linking the exported syntax and data files. Note that SPSS has several variable naming conventions:</p><ul><li>The name MUST begin with a letter.  The remaining characters may be any later, digit, a period or the symbols #, @, _, or $</li><li>Variable names cannot end with a period</li><li>The length of the name cannot exceed 64 bytes (64 characters)</li><li>Spaces and special characters other than the symbols above cannot be used</li><li>No duplicate names are acceptable; each character must be unique</li><li>Reserved keywords cannot be used as variable names (ALL, AND, BY, EQ, GE, GT, LE, LT, NE, NOT, OR, TO, and WITH)</li></ul></div>
<div id="q1545" class="faqq">How do I create a custom report?</div>
<div class="faqa"><p>Go to the “Data Exports, Reports, and Stats” application and hit the “Create New Report” button.Then take the following actions</p><ul><li>Provide a proper name for the report</li><li>Set the User Access</li><li>Select which fields you want to include in your report</li><li>Set up filters to select the appropriate records</li><li>Set up the proper order for your report</li><li>Hit “Save Report”</li></ul><p>You will have successfully create a new report and saved it to the project.</p></div>
</div><div class="subspacediv " id="ss64"><h3 onclick="selectSection(64);window.location.href='#ss64';">Data Import Tool</h3>
<div id="q1591" class="faqq">Why am I getting "IMPORT ERROR" when I do a data import?</div>
<div class="faqa">Check the encoding of the import CSV file - it should be UTF-8. If you are on Windows, Notepad++ is a useful tool to check or change the encoding of a text file.</div>
<div id="q1589" class="faqq">Why does REDCap display an out of memory message and ask me to break up my file into smaller pieces when I try to upload a 700 KB file using the Import Tool?  Will it help to increase the server's memory limit?</div>
<div class="faqa">Memory will always be a limit for the Data Import Tool.  A lot depends on how much data resides in the uploaded CSV file because the Data Import Tool does the validation checking and data processing in memory.  So a 500KB CSV file may be too big to process even though the server memory limit for REDCap might be 256 MB.  A csv file can be pretty small and yet cause a lot of memory to be used if you keep the columns (or rows) for all of the variables, but are only providing data for a few of the variables.  So you'll still have to follow the solution that REDCap gives you.</div>
<div id="q1583" class="faqq">How do I import longitudinal data?</div>
<div class="faqa">The Data Import Tool requires you to use the "redcap_event_name" column when importing data. You must specify the event name in the file using the unique "redcap_event_name".  You can upload multiple event data per subject.The unique "redcap_event_name"s are listed on each project's Define My Events page.You can insert this field after the unique identifier as the second column or you can add it to the end of your import spreadsheet (last column).</div>
<div id="q1581" class="faqq">How do I import data from another source?</div>
<div class="faqa">Data from another source can be imported using the Data Import tool or the API (Application Programming Interface).The Data Import Tool requires that data to be imported is in CSV (comma separated variables) format. The order of the fields or the number of fields being imported does not matter, except that the record identifier (e.g. Subject ID) must be the first field.</div>
<div id="q1587" class="faqq"><p>How do I import form status (Incomplete, Unverified, Complete)?</p></div>
<div class="faqa"><p>Form status can be imported into variables named form_name_complete.  The data import template, available on the Data Import Tool page, will contain the appropriate form status variable name for your project forms.  Form status is imported as dropdown field type coded as</p><p>0 Incomplete</p><p>1  Unverified</p><p>2  Complete</p></div>
<div id="q1585" class="faqq">How do I import data for calculated fields?</div>
<div class="faqa"><p>Data cannot be directly imported into calculated fields. If you are importing data to a field you have set up to calculate a value, follow these steps:</p><ol><li>Temporarily change the field type to text</li><li>Import data</li><li>Change the field type back to a calculated field</li></ol></div>
</div><div class="subspacediv " id="ss65"><h3 onclick="selectSection(65);window.location.href='#ss65';">File Repository</h3>
<div id="q1595" class="faqq">Is there any way to organize files in the file repository, such as a folder tree or section headers?</div>
<div class="faqa">No. The files in the File Repository cannot be sorted alphabetically or otherwise. The table headers are not clickable. The File Repository displays files in descending order by time of upload. Oldest files are at the bottom, while more recent uploads are at the top. If you have uploaded files of different formats (e.g. Word, Excel, PDF), then a dropdown box in the upper right of the table will let you additionally sort/filter the list to show only files of a certain format.</div>
<div id="q1593" class="faqq">What is the File Repository?</div>
<div class="faqa">The File Repository can be used for storing and retrieving project files and documents (ex: protocols, instructions, announcements).  In addition, it stores all data and syntax files when data is export using the Data Export Tool.</div>
</div><div class="subspacediv " id="ss66"><h3 onclick="selectSection(66);window.location.href='#ss66';">User Rights</h3>
<div id="q1599" class="faqq">What are the User Rights that can be granted/restricted?</div>
<div class="faqa"><table><tbody><tr><td><strong>User Right</strong></td><td><strong>Access</strong></td><td><strong>Notes</strong></td><td><strong>Potential to Access Protected Health Info (PHI)?</strong></td></tr><tr><td>Data Entry Rights</td><td>Grants user “No Access”, “Read Only”, “View&amp;Edit”, “Edit Survey Responses” rights to the project’s data collection instruments.</td><td><strong>WARNING:</strong> The data entry rights only pertain to a user's ability to view or edit data on the web page. It has NO effect on what data is included in data exports or downloaded to a device*.</td><td>YES. If access to a form with PHI is “Read Only” or “View&amp;Edit”, user will be able to view PHI.</td></tr><tr><td>Expiration Date</td><td>Automatically terminates project access for the user on date entered.</td></tr><tr><td>Project Design and Setup</td><td>Grants user access to add, update or delete any forms within the project. Also allows user to enable and disable project features and modules.</td><td>This should be allocated only to trained study members and should be limited to a very few number of users per study.</td></tr><tr><td>User Rights</td><td>Grants user access to change the rights and privileges of all users on a particular project, including themselves.</td><td><strong>WARNING:</strong> Granting User Rights privileges gives the user the ability to control other users’ project access. This user should be very trusted and knowledgeable about the project and REDCap. Giving user rights to team members should be a carefully thought out decision. The consequences of poor user rights assignments could be damaging to both the security and integrity of your project. For instance, giving record deletion or project design rights to an unqualified person could result in data loss or database integrity issues.</td><td>YES. User can change own User Rights and grant access to any module where PHI can be viewed or downloaded to a device.</td></tr><tr><td>Data Access Groups</td><td>Grants user access to create and add users to data access groups. User should not assign their self to a data access group or they will lose their access to update other users to data access groups. Therefore, user with this privilege should be able to see all project data regardless of group.</td><td>For multisite studies this allows the ability to place barriers between sites' data (i.e. group A cannot see, export, or edit group B's data).</td></tr><tr><td>Data Exports</td><td>Grants user “No Access”, “De-identified Only”, “Remove all tagged Identifier fields” and “Full Data Set” access to export all or selected data fields to one of the 5 default programs in REDCap (SAS, SPSS, R, Stata, Excel). Default Access: De-Identified; De-identified access shifts all dates even if they are not marked as identifiers. Non-validated text fields and note fields (free text) are also automatically removed from export. "Remove all tagged Identifier fields" ONLY removes fields marked as identifiers and does NOT automatically remove non-validated text fields or field notes and does NOT date shift. In reports and in the API data exports, any fields that have been tagged as "Identifer" fields will be removed from the export file. In the PDF exports, it will include the Identifier field but it will indicated with text [*DATA REMOVED*].</td><td><strong>WARNING:</strong> The "de-identified" and "remove all tagged identifier field" options are contingent upon correctly flagging identifiers in each field. It is advised to mark all PHI fields as identifiers and restrict export access to “de-identified”.</td><td>YES. PHI can be exported and downloaded to a device. Exporting data is NOT linked to Data Entry Rights. User with Full Export Rights can export ALL data from all data collection instruments. Please see “Data Exports, Reports, and Stats” FAQ for additional info.</td></tr><tr><td>Add / Edit Reports</td><td>Grants user access to build reports within the project. If user does not have access to a data collection instrument that the report is pulling data from, those fields will not appear in the report</td><td>For complex querying of data, best results are acquired by exporting data to a statistical package.</td><td>YES. Depending on Data Entry Rights, PHI can be viewed.</td></tr><tr><td>Stats &amp; Charts</td><td>Grants user access to view simple statistics on each field in the project in real time. If user does not have access to a data collection instrument, that instrument will not be listed on the page.</td><td>Outliers can be identified and clicked on which will take you immediately to the record, form and field of the individual with the outlier data.</td><td>YES. Depending on Data Entry Rights, PHI can be viewed.</td></tr><tr><td>Manage Survey Participants</td><td>Grants user access to manage the public survey URLs, participant contact lists, and survey invitation log.</td><td>YES. Email addresses (PHI) may be listed for the participant contact lists and invitation logs. Emails can be downloaded to a device.</td></tr><tr><td>Calendar</td><td>Grants user access to track study progress and allows user to update calendar events, such as mark milestones, enter ad hoc meetings.</td><td>In combination with the scheduling module the calendar tool can be used to add, view and update project records which are due for manipulation.</td><td>YES. PHI can be entered and viewed in the “notes” field. Data entered can be printed to PDF and downloaded to a device.</td></tr><tr><td>Data Import Tool</td><td>Grants user access to download and modify import templates for uploading data directly into the project bypassing data entry forms.</td><td><strong>WARNING:</strong> This will give the user the capability to overwrite existing data. Blank cells in the data import spreadsheet do not overwrite fields with data.</td></tr><tr><td>Data Comparison Tool</td><td>Grants user access to see two selected records side by side for comparison.</td><td>Extremely helpful when using double data entry.</td><td>YES. PHI can be viewed. Data can be printed and downloaded to a device. ALL data discrepancies for all fields in project are displayed and can be downloaded to user with access to this module – NOT linked to Data Entry Rights or Data Export Tool Rights.</td></tr><tr><td>Logging</td><td>Grants user access to view log of all occurrences of data exports, design changes, record creation, updating &amp; deletion, user creation, record locking, and page views. This is the audit trail for the project.</td><td>Useful for audit capability.</td><td>YES. ALL data entered, modified and changed is listed in module, can be viewed and downloaded to a device.</td></tr><tr><td>File Repository</td><td>Grants user access to upload, view, and retrieve project files and documents (ex: protocols, instructions, announcements). In addition, it stores all data and syntax files when data is exported using the Data Export Tool.</td><td><strong>WARNING:</strong> While users with restricted data export rights will not be able to access saved identified exports, they will be able to view any other sensitive information stored in the file repository such as photos or scanned documents. Limit this privilege to those who should have access to PHI.</td><td>YES. Depending on Data Export Tool rights, PHI can be downloaded to a device.</td></tr><tr><td>Data Quality</td><td>Grants user access to find data discrepancies or errors in project data by allowing user to create &amp; edit rules; and execute data quality rules. If user does not have access to a data collection instrument that the query is referencing, access will be denied for query results.</td><td>YES. Depending on Data Entry Rights, PHI can be viewed.</td></tr><tr><td>Create Records</td><td>Grants user access to add record and data to database.</td><td>Basic tool and need of data entry personnel.</td></tr><tr><td>Rename Records</td><td>Grants user access to change key id of record.</td><td><strong>WARNING:</strong> Should only be given to trained staff - can cause problems in data integrity.</td></tr><tr><td>Delete Records</td><td>Grants user access to remove an entire record.</td><td><strong>WARNING:</strong> Records deleted are records lost. Few, if any, team members should have this right.</td></tr><tr><td>Record Locking Customization</td><td>Grants user access to customize record locking text.</td><td>Will only be applicable to users with Lock/Unlock rights. Sometimes used for regulatory projects to provide “meaning” to the locking action.</td></tr><tr><td>Lock/Unlock Records</td><td>Grants user access to lock/unlock a record from editing. Users without this right will not be able to edit a locked record. User will need “Read Only” or “View&amp;Edit” to lock/unlock a data collection instrument.</td><td>A good tool for a staff member who has verified the integrity of a record to ensure that the data will not be manipulated further. Works best if few team members have this right.</td><td>Yes. Depending on Data Entry Rights, PHI can be viewed.</td></tr></tbody></table><p><strong>*Please Note:</strong> REDCap is a web-based system. Once data is downloaded from REDCap to a device (ex: computer, laptop, mobile device), the user is responsible for that data. If the data being downloaded is protected health information (PHI), the user must be trained and knowledgeable as to which devices are secure and in compliance with your institution’s standards (ex: HIPAA) for securing PHI.</p></div>
<div id="q1605" class="faqq">How can I differentiate between the Data Access Groups  and User Rights applications since both control the user’s access to data?</div>
<div class="faqa">The User Rights page can be used to determine the roles that a user can play within a REDCap database.  The Data Access group on the other hand determines the data visibility of a user within a REDCap database.The following example will illustrate the distinction that was made above.  Let's say that users 1 and 2 have identical data entry roles.  In this situation the Create and Edit Record rights would be assigned to both users.  However a particular project may require that they should have the ability to perform data entries on the same set of forms without seeing each other’s entries.  This can be done by assigning User1 into the access group1 and User2 to the access group2.</div>
<div id="q1603" class="faqq">Who can unlock a record?</div>
<div class="faqa">Any user with Locking/Unlocking privileges can unlock a record, regardless of who originally locked the record.</div>
<div id="q1601" class="faqq">Can I restrict a user from viewing certain fields?</div>
<div class="faqa">To restrict a user from viewing sensitive fields, you must group all of the sensitive fields on one form and set the user’s data entry rights to “None” for that form. This will prevent the user from viewing the entire form. You cannot selectively prevent a user from viewing certain fields within a form.</div>
<div id="q1597" class="faqq">How can I give someone access to my project?</div>
<div class="faqa">If you have rights to the User Rights application, add a new user by entering their user name in the “New User name” text box and hit the Tab key. Assign permissions and save changes.</div>
</div><div class="subspacediv " id="ss67"><h3 onclick="selectSection(67);window.location.href='#ss67';">Data Access Groups</h3>
<div id="q1613" class="faqq">Is there a way of separating data collected by various users so that a normal user can see only the records that he or she has completed?</div>
<div class="faqa">You can use Data Access Groups and assign each user to a specific group.  This will isolate recordsto specific groups.  Anyone not assigned to a group can see all records.</div>
<div id="q1611" class="faqq">How do you assign specific subjects to a Data Access group?</div>
<div class="faqa">If you have User Rights to the Data Access Group (DAG) tool, then for every record at the top of the forms, you should see a drop down list that says "Assign this record to a Data Access Group". Here you can add the record to a DAG.You can assign/re-assign records to Data Access Groups via the Data Import Tool or API data import. For projects containing Data Access Groups, the Data Import Tool and API data import allow users who are *not* in a DAG to assign or re-assign records to DAGs using a field named "redcap_data_access_group" in their import data. For this field, one must specify the unique group name for a given record in order to assign/re-assign that record.The unique group names for DAGs are listed on each project's Data Access Groups page and API page.</div>
<div id="q1609" class="faqq">Can I export a list of all subjects and their assigned Data Access group?</div>
<div class="faqa">Yes, you can export Data Access Group names. For projects containing Data Access Groups, both the Data Export Tool and API data export now automatically export the unique group name in the CSV Raw data file, and they export the Data Access Group label in the CSV Labels data file. The unique group names for DAGs are listed on each project's Data Access Groups page and API page.NOTE: The DAG name will only be exported if the current user is *not* in a DAG. And as it was previously, if the user is in a DAG, it is still true that it will export *only* the records that belong to that user's DAG.</div>
<div id="q1607" class="faqq">What are Data Access Groups?</div>
<div class="faqa">Data Access Groups restrict viewing of data within a database. A typical use of Data Access Groups is a multi-site study where users at each site should only be able to view data from their site but not any other sites. Users at each site are assigned to a group, and will only be able to see records created by users within their group.</div>
</div><div class="subspacediv " id="ss68"><h3 onclick="selectSection(68);window.location.href='#ss68';">Data Quality Module</h3>
<div id="q1627" class="faqq">What’s the difference between running a Data Quality Rule and the real time execution of a Data Quality rule?</div>
<div class="faqa">A Data Quality rule run manually in the Data Quality module will evaluate all the records in the project and show you the number of records that match the criteria of the rule. A Data Quality rule that is run through real time execution will only look at the record that the user is currently working on and is run automatically when the user saves the form.</div>
<div id="q1625" class="faqq">Does real time execution work for survey participants?</div>
<div class="faqa">No, real time execution is not enabled for surveys. Real time execution is only available in data entry forms.</div>
<div id="q1623" class="faqq">How does the real time execution work?</div>
<div class="faqa">When real time execution has been enabled, the rule will be run every time a REDCap user saves a form. If the rule finds a discrepancy, it will generate a popup, notifying the user. The user can then take the appropriate action.</div>
<div id="q1621" class="faqq">How do I set-up real time execution of a Data Quality rule?</div>
<div class="faqa">Each custom Data Quality rule has a checkbox in the column labeled “Real Time Execution”. Checking this box will enable the real time execution of the rule in this project for all forms.</div>
<div id="q1619" class="faqq">I ran my custom Data Quality rule and it came up with zero results. What did I do wrong?</div>
<div class="faqa">This means that none of your records match the criteria of your custom rule. This usually means that you have no data integrity issues, but may also mean that the criteria you’ve entered are logically impossible. (e.g. Having multiple options of a radio button variable be true). If the latter is the case, you will have to rework your criteria.</div>
<div id="q1617" class="faqq">Can I use the same syntax for a custom Data Quality rule as I would use when constructing branching logic?</div>
<div class="faqa">Yes, you can use the same syntax as you would use for branching logic.</div>
<div id="q1631" class="faqq"><p>What functions can be used in Data Quality custom rules?</p></div>
<div class="faqa">The Data Quality module can perform many advanced functions for custom rules that users create. For a complete list with explanations and examples for each, see List of functions for logic in Report filtering, Survey Queue, Data Quality Module, and Automated Survey Invitations.</div>
<div id="q1629" class="faqq">What mathematical operations can be used in the logic for Data Quality rules?</div>
<div class="faqa"><p>+        Add</p><p>-        Subtract</p><p>*        Multiply</p><p>/        Divide</p></div>
<div id="q1615" class="faqq">What is the Data Quality Module?</div>
<div class="faqa"><p>The Data Quality module allows you to find discrepancies in your project data. You can create your own custom rules that REDCap will execute to determine if a specific data value is discrepant or not. Your custom rules can include mathematical operations and also advanced functions (listed below) to provide you with a great amount of power for validating your project data. You can also activate the real time execution of your custom rules to continually ensure the data integrity of your project. </p><p>Note: Although setting up a Data Quality custom rule may at times be very similar to constructing an equation for a calculated field, calc fields will ALWAYS have to result in a number, whereas the Data Quality custom rule must ALWAYS result with a TRUE or FALSE condition and NEVER a value.</p></div>
</div><div class="subspacediv " id="ss69"><h3 onclick="selectSection(69);window.location.href='#ss69';">Functions for logic in Report filtering, Survey Queue, Data Quality, and ASIs</h3>
<div id="q1741" class="faqq"><p>List of functions that can be used in logic for Report filtering, Survey Queue, Data Quality Module, and Automated Survey Invitations</p></div>
<div class="faqa"><p>REDCap logic can be used in a variety of places, such as Report filtering, Survey Queue, Data Quality Module, and Automated Survey Invitations. Advanced functions can be used in the logic. A complete list of ALL available functions is listed below. (NOTE: These functions are very similar - and in some cases identical - to functions that can be used for calculated fields and branching logic.)</p><table><tbody><tr><td><strong>Function</strong></td><td><strong>Name/Type of function</strong></td><td><strong>Notes / examples</strong></td></tr><tr><td>if (CONDITION, VALUE if condition is TRUE, VALUE if condition is FALSE)</td><td><strong>If/Then/Else conditional logic</strong></td><td>Return a value based upon a condition. If CONDITION evaluates as a true statement, then it returns the first VALUE, and if false, it returns the second VALUE. E.g. if([weight] &gt; 100, 44, 11) will return 44 if "weight" is greater than 100, otherwise it will return 11.</td></tr><tr><td>datediff ([date1], [date2], "units", returnSignedValue)</td><td><strong>Datediff</strong></td><td>Calculate the difference between two dates or datetimes. Options for "units": "y" (years, 1 year = 365.2425 days), "M" (months, 1 month = 30.44 days), "d" (days), "h" (hours), "m" (minutes), "s" (seconds). The parameter "returnSignedValue" must be either TRUE or FALSE and denotes whether you want the returned result to be either signed (have a minus in front if negative) or unsigned (absolute value), in which the default value is FALSE, which returns the absolute value of the difference. For example, if [date1] is larger than [date2], then the result will be negative if returnSignedValue is set to TRUE. If returnSignedValue is not set or is set to FALSE, then the result will ALWAYS be a positive number. If returnSignedValue is set to FALSE or not set, then the order of the dates in the equation does not matter because the resulting value will always be positive (although the + sign is not displayed but implied). NOTE: This datediff function differs slightly from the datediff function used in calculated fields because it does NOT have a "dateformat" parameter. Calc fields require that extra parameter, but in this datediff it is implied. However, if the "dateformat" parameter is accidentally used, it will not cause an error but will simply ignore it. See more info and examples below.</td></tr><tr><td>round (number,decimal places)</td><td><strong>Round</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round 14.384 to one decimal place: round(14.384,1) will yield 14.4</td></tr><tr><td>roundup (number,decimal places)</td><td><strong>Round Up</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round up 14.384 to one decimal place: roundup(14.384,1) will yield 14.4</td></tr><tr><td>rounddown (number,decimal places)</td><td><strong>Round Down</strong></td><td>If the "decimal places" parameter is not provided, it defaults to 0. E.g. To round down 14.384 to one decimal place: rounddown(14.384,1) will yield 14.3</td></tr><tr><td>sqrt (number)</td><td><strong>Square Root</strong></td><td>E.g. sqrt([height]) or sqrt(([value1]*34)/98.3)</td></tr><tr><td>(number)^(exponent)</td><td><strong>Exponents</strong></td><td>Use caret ^ character and place both the number and its exponent inside parentheses. NOTE: The surrounding parentheses are VERY important, as it wil not function correctly without them. For example, (4)^(3) or ([weight]+43)^(2)</td></tr><tr><td>abs (number)</td><td><strong>Absolute Value</strong></td><td>Returns the absolute value (i.e. the magnitude of a real number without regard to its sign). E.g. abs(-7.1) will return 7.1 and abs(45) will return 45.</td></tr><tr><td>min (number,number,...)</td><td><strong>Minimum</strong></td><td>Returns the minimum value of a set of values in the format min([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the lowest numerical value. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>max (number,number,...)</td><td><strong>Maximum</strong></td><td>Returns the maximum value of a set of values in the format max([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the highest numerical value. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>mean (number,number,...)</td><td><strong>Mean</strong></td><td>Returns the mean (i.e. average) value of a set of values in the format mean([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the mean value computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>median (number,number,...)</td><td><strong>Median</strong></td><td>Returns the median value of a set of values in the format median([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the median value computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>sum (number,number,...)</td><td><strong>Sum</strong></td><td>Returns the sum total of a set of values in the format sum([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the sum total computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>stdev (number,number,...)</td><td><strong>Standard Deviation</strong></td><td>Returns the standard deviation of a set of values in the format stdev([num1],[num2],[num3],...). NOTE: All blank values will be ignored and thus will only return the standard deviation computed from all numerical, non-blank values. There is no limit to the amount of numbers used in this function.</td></tr><tr><td>log (number, base)</td><td><strong>Logarithm</strong></td><td>Returns the logarithm of the number provided for a specified base (e.g. base 10, base "e"). If base is not provided or is not numeric, it defaults to base "e" (natural log).</td></tr><tr><td>isnumber (value)</td><td><strong>Is value a number?</strong></td><td>Returns a boolean (true or false) for if the value is an integer OR floating point decimal number.</td></tr><tr><td>isinteger (value)</td><td><strong>Is value an integer?</strong></td><td>Returns a boolean (true or false) for if the value is an integer (whole number without decimals).</td></tr><tr><td>contains (haystack, needle)</td><td><strong>Does text CONTAIN another text string?</strong></td><td>Returns a boolean (true or false) for if "needle" exists inside (is a substring of) the text string "haystack". Is case insensitive. E.g. contains("Rob Taylor", "TAYLOR") will return as TRUE and contains("Rob Taylor", "paul") returns FALSE. NOTE: This function will *not* work for calculated fields but *will* work in all other places (Data Quality, report filters, Survey Queue, etc.).</td></tr><tr><td>not_contain (haystack, needle)</td><td><strong>Does text NOT CONTAIN another text string?</strong></td><td>The opposite of contains(). Returns a boolean (true or false) for if "needle" DOES NOT exist inside (is a substring of) the text string "haystack". Is case insensitive. E.g. not_contain("Rob Taylor", "TAYLOR") will return as FALSE and not_contain("Rob Taylor", "paul") returns TRUE. NOTE: This function will *not* work for calculated fields but *will* work in all other places (Data Quality, report filters, Survey Queue, etc.).</td></tr><tr><td>starts_with (haystack, needle)</td><td><strong>Does text START WITH another text string?</strong></td><td>Returns a boolean (true or false) if the text string "haystack" begins with the text string "needle". Is case insensitive. E.g. starts_with("Rob Taylor", "rob") will return as TRUE and starts_with("Rob Taylor", "Tay") returns FALSE. NOTE: This function will *not* work for calculated fields but *will* work in all other places (Data Quality, report filters, Survey Queue, etc.).</td></tr><tr><td>ends_with (haystack, needle)</td><td><strong>Does text END WITH another text string?</strong></td><td>Returns a boolean (true or false) if the text string "haystack" ends with the text string "needle". Is case insensitive. E.g. ends_with("Rob Taylor", "Lor") will return as TRUE and ends_with("Rob Taylor", "Tay") returns FALSE. NOTE: This function will *not* work for calculated fields but *will* work in all other places (Data Quality, report filters, Survey Queue, etc.).</td></tr></tbody></table></div>
<div id="q1635" class="faqq">Can I use conditional IF statements in the logic?</div>
<div class="faqa"><p>Yes. You may use IF statements (i.e. IF/THEN/ELSE statements) by using the function <strong>if (CONDITION, value if condition is TRUE, value if condition is FALSE)</strong></p><p>This construction is similar to IF statements in Microsoft Excel. Provide the condition first (e.g. [weight]=4), then give the resulting value if it is true, and lastly give the resulting value if the condition is false. For example:</p><p><strong>if([weight] &gt; 100, 44, 11) &lt; [other_field]</strong></p><p>In this example, if the value of the field 'weight' is greater than 100, then it will give a value of 44, but if 'weight' is less than or equal to 100, it will give 11 as the result.</p><p>IF statements may be used inside other IF statements (“nested”). Other advanced functions (described above) may also be used inside IF statements.</p><strong>Datediff examples:</strong><table><tbody><tr><td><strong>datediff([dob], [date_enrolled], "d")</strong></td><td>Yields the number of days between the dates for the date_enrolled and dob fields</td></tr><tr><td><strong>datediff([dob], "today", "d")</strong></td><td>Yields the number of days between today's date and the dob field</td></tr><tr><td><strong>datediff([dob], [date_enrolled], "h", true)</strong></td><td>Yields the number of hours between the dates for the date_enrolled and dob fields. Because returnSignedValue is set to true, the value will be negative if the dob field value is more recent than date_enrolled.</td></tr></tbody></table></div>
<div id="q1645" class="faqq">Can I use the same format of the datediff function that is used for calculated fields, which requires the dateFormat ("ymd", "mdy", or "dmy") as the fourth parameter?</div>
<div class="faqa">Yes, you can use the calculated field version of the datediff function. If the fourth parameter of the datediff function is "ymd", "mdy", or "dmy", it will ignore it (because it is not needed) and will then assume the fifth parameter (if provided) to instead be the returnSignedValue.</div>
<div id="q1643" class="faqq">Can I base my datediff function off of today's date?</div>
<div class="faqa">Yes, for example, you can indicate "age" as: rounddown(datediff("today",[dob],"y")). NOTE: The "today" variable CAN be used with date, datetime, and datetime_seconds fields, but NOT with time fields. (This is different from datediff in calc fields, in which the "today" variable can ONLY be used with date fields and NOT with time, datetime, or datetime_seconds fields.)</div>
<div id="q1641" class="faqq">Can a date field be used in the datediff function with a datetime or datetime_seconds field?</div>
<div class="faqa">Yes. If a date field is used with a datetime or datetime_seconds field, it will calculate the difference by assuming that the time for the date field is 00:00 or 00:00:00, respectively. Consequently, this also means that, for example, an MDY-formatted DATE field can be used inside a datediff function with a YMD-formatted DATETIME field.</div>
<div id="q1639" class="faqq">Do the two date fields used in the datediff function both have to be in the same date format (YMD, MDY, DMY)?</div>
<div class="faqa">No, they do not. Thus, an MDY-formatted date field can be used inside a datediff function with a YMD-formatted date field, and so on.</div>
</div></div><div class="spacediv " id="s70"><div class="subspacediv " id="ss70"><h2 onclick="selectSection(70);window.location.href='#s70';">Making Production Changes</h2>
<div id="q1663" class="faqq">Are the numbers of the remaining events reordered if I delete some of the events in an ongoing longitudinal project?</div>
<div class="faqa">The original numbering is retained for the remaining events.</div>
<div id="q1655" class="faqq">For radiobutton, checkbox and dropdown fields, can I modify / re-order my response options?</div>
<div class="faqa">
	<p>Modifying / recoding field choices does not change the data saved to the database, it only updates the labels. This will change the meaning of the data already entered and you will have to re-enter responses for those records to ensure accuracy. REDCap will flag this as:</p><p>*Possible label mismatch<br>
	</p><p>The best thing to do when making field choice changes for radiobuttons, checkboxes or dropdowns is to leave the current response choices as is and start with the next available code. The coded choices do not have to be in order, so you can insert/list choices as you want them displayed.</p><p>For example, if your current codes are:</p><p>1, red | 2, yellow | 3, blue</p><p>and you want to add "green", "orange" and re-order alphabetically, <strong>DO NOT</strong> update to:</p><p>1, blue | 2, green | 3, orange | 4, red | 5, yellow</p><p>If you re-code like this, after the changes are committed any options selected for "1, red" will change to "1, blue"; "2, yellow" to "2, green"; "3, blue" to "3, orange".</p><p>That will completely change the meaning of the data entered. Instead you will want to update to:</p><p>3, blue | 4, green | 5, orange | 1, red | 2, yellow</p>
</div>
<div id="q1661" class="faqq">If I delete events from an ongoing longitudinal project is the data that is unconnected with these events affected in any way?</div>
<div class="faqa">In general you can assume that only the data that is tied to the deleted events is affected and that there will be no adverse impact on the data that has been entered for the remaining events.  However there could be an impact on this data if you are using branching logic or calculations across events.</div>
<div id="q1659" class="faqq">What happens to the data in an ongoing longitudinal project if I delete some of the events?</div>
<div class="faqa">The data which was tied to the deleted events will not be erased.  It remains in the system but in “orphaned” form.</div>
<div id="q1657" class="faqq">Does the project go offline until the changes are approved? Can new surveys and records still be added to the project?</div>
<div class="faqa">The project does not go offline during the change request process.  All the functionality remains the same so you can continue adding and updating records as needed while the changes are pending.</div>
<div id="q1653" class="faqq">For radiobutton, checkbox and dropdown fields, can I delete response options?</div>
<div class="faqa">Deleting radiobutton or dropdown choices does not change the data saved to the database, but it deletes the ability to select that option.Deleting a checkbox option deletes the data saved for that option (0=unchecked, 1=checked), and it deletes the ability to select that option.REDCap will flag this as: *Data WILL be lost</div>
<div id="q1651" class="faqq">For radiobutton, checkbox and dropdown fields, can I add response options without impacting my data?</div>
<div class="faqa">Yes. Adding new choices has no data impact. New choices will be added and display on all records.</div>
<div id="q1647" class="faqq">How do I make changes after I have moved my project to Production?</div>
<div class="faqa"><p>To make changes after you have moved your project to Production, first download the current Data Dictionary so that you can revert to the current version, if necessary, if something goes wrong with making changes. Then, select “Enter Draft Mode” on the Online Designer or Data Dictionary page. After making your changes, you can review them by clicking on "view a detailed summary of all drafted changes" hyperlink at the top of the page.</p><p>REDCap will flag any changes that may negatively impact your data with the following critical warnings in red: </p><p style="margin-left: 20px;">*Possible label mismatch </p><p style="margin-left: 20px;">*Possible data loss </p><p style="margin-left: 20px;">*Data WILL be lost</p><p>After making and reviewing changes, you can click “Submit Changes for Review.” The REDCap Administrator will review your changes to make sure there is nothing that could negatively impact data you’ve already collected. If anything is questionable or flagged as critical, you may receive an email from the Administrator with this information to confirm that you really want to make the change.</p><p>Certain changes to the structure of the database, such as deleting events in a longitudinal project can only be done by the REDCap Administrator.</p></div>
<div id="q1649" class="faqq">What are the risks of modifying a database that is already in Production?</div>
<div class="faqa">
	<p><br>
		Altering a database that is in Production can cause data loss and challenges to your data analysis. </p><p>If a Production database must be modified, follow these rules to protect your data:</p><ul><br>
		<br>
	<li>Do not change existing variable names, or data stored for those variables will be lost. To restore data that has been lost in this way, revert to previous variable name(s).</li>	<br>
	<li>Do not change existing form names via a data dictionary upload, or form completeness data will be lost. Form names may be changed within the Online Designer without data loss.</li>	<br>
	<li>Do not modify the codes and response options for existing dropdown, radio, or checkbox variables; or existing data will be lost or confused. </li></ul><p>It is acceptable to add choices to a dropdown, radio, or checkbox field; however adding an option or even an entire field may present other analytical challenges. For example, if a response option is added, it is added to all instruments for all records. For records and/or study participants who have already completed the instrument, that option was not present at the time and not available for selection. Their results may not accurately reflect their situation given the updated version of the instrument/survey. One must either consider their results in light of the instrument contents at the time of data capture or one must be careful to avoid making conclusions which would be affected by the change to the instrument.</p><p>Versioning your instruments and tracking changes over time is recommended. Use the Project Revision History to confirm changes and revisions.</p>
</div>
</div></div><div class="spacediv " id="s71"><div class="subspacediv " id="ss71"><h2 onclick="selectSection(71);window.location.href='#s71';">Optional Modules and Services</h2>
<div id="q1963" class="faqq"><p>Can I send survey invites via text message?</p></div>
<div class="faqa">
	<p><br>
		REDCap has the capability to make voice calls and send SMS text messages to survey respondents by using a third-party web service named Twilio (www.twilio.com). In this way, you could invite a participant to take a survey by sending them an SMS message or by calling them on their phone. There are many different options available for how you can invite participants and how they can take your surveys, either as a voice call survey or as an SMS conversation.<br>
	</p><br>
	<p><br>
		If you do not see the option to enable “Twilio SMS and Voice Call services for surveys” on the Project Setup page &gt; Enable optional modules and customizations, contact your local REDCap Administrator.<br>
	</p><br>
	<p><br>
		For those not using Twilio, there are many providers that let you convert an email into an SMS. You have to register your email address with them for billing, then you construct your messages using a particular pattern, e.g.<br>
	</p><br>
	<p><br>
		To: &lt;recipient's mobile number&gt;@provider.com<br><br>
		Body: The message text<br>
	</p><br>
	<p><br>
		This mechanism would work fine from within REDCap - even for automated <br>
	invitations - although the built-in text containing the survey link may not be particularly nice in an SMS. Contact your REDCap Administrator who may be willing to adjust the language file.<br>
	</p>
</div>
<div id="q1665" class="faqq">How to activate Modules and Services</div>
<div class="faqa">These modules and services must be enabled system-wide for your REDCap instance.  If you do not have access to these modules or services, contact your local REDCap Administrator.</div>
</div><div class="subspacediv " id="ss72"><h3 onclick="selectSection(72);window.location.href='#ss72';">API / Data Entry Trigger</h3>
<div id="q1667" class="faqq">What is the REDCap API (Application Programming Interface)?</div>
<div class="faqa">The REDCap API is an interface that allows external applications to connect to REDCap remotely, and is used for programmatically retrieving or modifying data or settings within REDCap, such as performing automated data imports/exports from a specified REDCap project.  More information about the API can be found on the Project Setup &gt; Other Functionality page.  For more information on the API, contact your REDCap Administrator.</div>
<div id="q5445" class="faqq"><p>What is an easy way to get started with the API?</p></div>
<div class="faqa"><p>The first step in accessing the API for any project is to check if you have the appropriate user rights in the project in order to use the API. </p><p>Secondly, you will need to request an API token. This API token will be linked to your user ID and to that specific project &amp; and your respective user rights for that project.  Please note: you will need to request a different API token for each project.</p><p>You will need that API token in each API call, because REDCap uses that token to authenticate each API call.</p><p>While you wait for your API token to be approved, we recommend that you check out the API documentation page in your REDCap installation. The link to the API documentation page can be found in the API application in each project.</p><p>Once you have your API token, you can utilize another tool called the API playground to learn how to use the REDCap API.</p><p>The playground will allow you to "test drive" each API method and tweak the various options for each API method. You can run the method in your browser to see what type of response you'll get.</p><p>The API playground will also supply you with the code (including your API token &amp; server URL) for that specific API method in the following languages:</p><ul><li>PHP</li><li>Perl</li><li>Python</li><li>Ruby</li><li>Java</li><li>R</li><li>cURL</li></ul><p>You can copy and paste your chosen language code into your preferred scripting tool and run it there. <br>We recommend the R program for demo purposes: it's free, light weight and will run on both Windows and Mac environments.</p><p>Another nice tool to "test" the API from your local computer is POSTMAN - a Chrome add-in which allows you to test and save API queries from your local computer.</p></div>
<div id="q1669" class="faqq">What is the Data Entry Trigger?</div>
<div class="faqa">
	<p><br>
		The Data Entry Trigger is an advanced feature. It provides a way for REDCap to trigger a call to a remote web address (URL), in which it will send a HTTP Post request to the specified URL whenever *any* record or survey response has been created or modified on *any* data collection instrument or survey in this project (it is *not* triggered by data imports but only by normal data entry on surveys and data entry forms). Its main purpose is for notifying other remote systems outside REDCap at the very moment a record/response is created or modified, whose purpose may be to trigger some kind of action by the remote website, such as making a call to the REDCap API.</p><p><br>
		For example, if you wish to log the activity of records being modified over time by a remote system outside REDCap, you can use this to do so. Another use case might be if you're using the API data export to keep another system's data in sync with data in a REDCap project, in which the Data Entry Trigger would allow you to keep them exactly in sync by notifying your triggered script to pull any new data from at the moment it is saved in REDCap (this might be more optimal and accurate than running a cron job to pull the data every so often from REDCap).</p><p><br>
		DETAILS: In the HTTP Post request, the following parameters will be sent by REDCap in order to provide a context for the record that has just been created/modified:</p><ul><br>
		<br>
	<li>project_id - The unique ID number of the REDCap project (i.e. the 'pid' value found in the URL when accessing the project in REDCap).</li>	<br>
	<li>instrument - The unique name of the current data collection instrument (all your project's unique instrument names can be found in column B in the data dictionary).</li>	<br>
	<li>record - The name of the record being created or modified, which is the record's value for the project's first field.</li>	<br>
	<li>redcap_event_name - The unique event name of the event for which the record was modified (for longitudinal projects only).</li>	<br>
	<li>redcap_data_access_group - The unique group name of the Data Access Group to which the record belongs (if the record belongs to a group).</li>	<br>
	<li>[instrument]_complete - The status of the record for this particular data collection instrument, in which the value will be 0, 1, or 2. For data entry forms, 0=Incomplete, 1=Unverified, 2=Complete. For surveys, 0=partial survey response and 2=completed survey response. This parameter's name will be the variable name of this particular instrument's status field, which is the name of the instrument + '_complete'.</li></ul><p>NOTE: If the names of your records (i.e. the values of your first field) are considered identifiers (e.g. SSN, MRN, name), for security reasons, it is highly recommended that you use an encrypted connection (i.e. SSL/HTTPS) for the URL you provide for the Data Entry Trigger.</p>
</div>
<div id="q1671" class="faqq">What are the situations that trigger DET (Data Entry Trigger), ASI (Automated Survey Invitations) and server side calculations?</div>
<div class="faqa">
	<p><br>
		The situations that trigger DET, ASI and server side calculations are shown below in table format:<br>
	</p><br>
	<br><br><table>
	
	<tbody><tr>
		<td><br>
			Functionality<br>
		</td>
		<td><br>
			Triggered by conditions listed below<br>
		</td>
	</tr>
	<tr>
		<td><br>
			DET<br>
		</td>
		<td><br>
			Form Save<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Survey Submit (next page, prev page, missing required fields, and complete)<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Essentially any time a save button is clicked on a survey or form<br>
		</td>
	</tr>
	<tr>
		<td><br>
			ASI<br>
		</td>
		<td><br>
			Form Save<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Survey Submit (next page, prev page, Missing required fields, and complete)<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			API Import (records import and file import)<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Data Import Tool<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			12-hour cron job (But only for ASIs that have datediff() with "today" in their conditional logic)<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Plugin/hook calling REDCap::saveData()<br>
		</td>
	</tr>
	<tr>
		<td><br>
			Server side calculation<br>
		</td>
		<td><br>
			Form save--only if calculated field that is triggered exists on another instrument or event<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Survey submit (next page, prev page, missing required fields, and complete--only if calculated field that is triggered exists on another instrument or event<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			API Import (records import and file import)<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Data Import Tool<br>
		</td>
	</tr>
	<tr>
		<td><br>
		</td>
		<td><br>
			Plugin/hook calling REDCap::saveData()<br>
		</td>
	</tr>
	
	</tbody></table>
</div>
</div><div class="subspacediv " id="ss73"><h3 onclick="selectSection(73);window.location.href='#ss73';">Mobile App for iOS and Android</h3>
<div id="q1712" class="faqq"><p>What devices are supported in the REDCap Mobile App? How do I get it?</p></div>
<div class="faqa"><p>Apple (iOS), Android, and (probably) coming soon, the Kindle Fire.<br><br>It is available via the Apple App Store, the Google Play store, and possibly a custom REDCap store.</p></div>
<div id="q1727" class="faqq"></div>
<div id="q1749" class="faqq"></div>
<div id="q1745" class="faqq"></div>
<div id="q1742" class="faqq"></div>
<div id="q1731" class="faqq"></div>
<div id="q1725" class="faqq"></div>
<div id="q1716" class="faqq"></div>
<div id="q1687" class="faqq"> Can we share one device and have multiple users access the app?</div>
<div class="faqa">Yes, you can add multiple users to the app installed on a single device in the Add &amp; Manage Users section. Each user will have a unique PIN for access.  However, each app user maintains unique project copies on the device (not shared). An app user will collect data separately from anyone else even if on same device, same project. Data is consolidated when it is synced to the online server.</div>
<div id="q1685" class="faqq">Why can’t I create new projects on the app?</div>
<div class="faqa">New project creation is not possible in the REDCap Mobile App itself. The app’s purpose is to collect data offline that will later be added to an existing project on the “online” web based REDCap application. The project’s data collection instruments must be created and managed within the “online” instance.</div>
<div id="q1683" class="faqq">What is the remote lockout feature?</div>
<div class="faqa">Remote lockout: If a user sets up a REDCap project on the mobile app, and then another user revokes their "REDCap Mobile App" user privileges on the User Rights page in that project, then it will prevent them from accessing it on their mobile device by locking them out of that particular project. In this way, you may perform "remote lockout" to further protect data stored on mobile devices. Additionally, a user can revoke/delete their API token for the project, which will also cause a remote lockout, although the lockout will be permanent and will cause all data currently stored in the app to be lost.</div>
<div id="q1679" class="faqq">What is the User Right: "Allow user to download data for all records to the app?" ?</div>
<div class="faqa">There is an additional user privilege "Allow user to download data for all records to the app?" that specifically governs whether or not the user is allowed to download records from the server to the app. This may be done to prevent users from unwittingly (or wittingly) downloading lots of sensitive data to their mobile device. If a user is given this privilege, then when they initialize the project in the app and the project contains at least one record, then the app will prompt the user to choose if they wish to download all the records to the app or not.</div>
<div id="q1677" class="faqq">How can I access the Mobile App?</div>
<div class="faqa">Before users can use the mobile app for a project, they must first be given "Mobile App" User Right. This module must be enabled system-wide for your REDCap instance.  If you do not have access to the module in the "User Rights" module, contact your local REDCap Administrator. Once you have rights you'll be able to see the "REDCap Mobile App" link on the project's left-hand menu and then be able to access that page, which will provide links to download the Android and iOS app and instructions for initializing that project in the app on their mobile device. Note: When a user creates a new project, they will automatically be given "Mobile App" privileges by default.</div>
<div id="q1675" class="faqq"> Can this app be used to collect data directly from participants?</div>
<div class="faqa">The Mobile App is for REDCap users to access an offline version of their projects and enter data in areas of low/no internet connection. A REDCap login is required to use the app.  The app therefore cannot be downloaded by participants, to their own personal devices.However, REDCap users can secure instruments on their own devices and let a participant use it temporarily, for direct data collection. In this way, participants only have the option to enter data to that instrument (and not use the rest of the app).</div>
<div id="q5094" class="faqq"><p>What should I do if I can't find anywhere nearby in my rural setting to sync the mobile app?</p></div>
<div class="faqa"><p>1. Get online.</p><p>2. Contact <a href="http://opensignal.com/">http://opensignal.com/</a></p><p>3. Download their app.</p><p>4. Next time you struggle, check out the maps in their app.</p></div>
<div id="q2397" class="faqq"><p>Can I use the randomization module with the mobile app?</p></div>
<div class="faqa">
	<p><br>
		The Mobile App does not support the Randomization Module and will not display the “randomize” button on a project instrument. The Mobile App is used for "offline" data collection, so it cannot assume access to REDCap’s ‘online’ server where the project's randomization table is stored and accessed in real-time to make assignments.<br>
	</p>
</div>
<div id="q1762" class="faqq"><p>How should a mobile app user report a bug?</p></div>
<div class="faqa"><ol><li>Go to the main menu on the app.</li><li>Tap Report a Bug.</li><li>Fill out the Bug Report.</li><li>Await a response within 1-2 business days.</li></ol></div>
<div id="q1192" class="faqq">What is the best design practice for the REDCap Mobile App?</div>
<div class="faqa">
	<p>There are several factors to consider when designing a project which <br>
	will use the REDCap Mobile App, including but not limited to:<br>
	</p><ul><li>Who will install and initialize the REDCap App on the mobile devices</li><li>Who will initialize the user account(s) and create and manage user tokens for the accounts</li><li>Will each device be tied to a single user or will multiple users access a given device.</li><li>What data (if any) can be downloaded to the device.</li><li>Who is responsible for ensuring that the project metadata is kept up to date on the device</li><li>Who is responsible for ensuring that project data is uploaded (downloaded) at appropriate intervals</li><li>What PIN management techniques will be specified and used.</li></ul>
</div>
<div id="q1718" class="faqq"><p>I am having trouble with the Mobile App. What do I do?</p></div>
<div class="faqa">
	<ol><br>
	 <li>Login as your usual app user, except add a 00 to the end of your PIN. This will make the 6-digit PIN 8 digits long.</li><br>
	 <li>Go to the page that has the error. Reproduce the error.</li><br>
	 <li>Tap "Send Diagnostic Info" at the bottom of the screen. This will send an email to the redcap app folks.</li><br>
	 <li>Send a plain-text, narrative description of your error to <a href="mailto:redcapapp@vanderbilt.edu">redcapapp@vanderbilt.edu</a>. You can use the Report a Bug feature on the main menu to do this via the app, or you can use normal email if you want as well.</li><br>
	</ol>
</div>
<div id="q1681" class="faqq">How does data sync between the app and the REDCap server?</div>
<div class="faqa">
	<p><br>
		When the user has collected some data in the app and wishes to send the data back to the server, they will go to the "Send data to server" page in the app.<br>
	</p><br>
	<p><br>
		First, the metadata/data dictionary is checked for any <br>
	project changes (e.g., deleted field names, modified labels, multiple choice options, etc.)<br>
	</p><br>
	<ul><br>
		<li>If there are major changes, the user will be prompted that the upload will not proceed. </li><br>
		<li>If there are no changes or minor changes, the process will proceed.</li><br>
	</ul><br>
	<p><br>
		Next, records are sent, one at a time.<br>
	</p><br>
	<ul><br>
		<li>For new records:</li><br>
	</ul><br>
	<p style="margin-left: 20px;"><br>
		If new record id's are needed, they are assigned values for auto-numbered projects.<br>
	</p><br>
	<ul><br>
		<li>For existing records:</li><br>
	</ul><br>
	<p style="margin-left: 20px;"><br>
		Modifications to existing records are adjudicated, one record at a time. They can be reassigned to a new record id or merged with an existing record.<br>
	</p><br>
	<p style="margin-left: 20px;"><br>
		There are three categories: overlooked values (values on the device are the same), device-only modifications (in yellow), and device-and-server-modified values (in pink/red). The user is allowed to inspect them at the record- and field-level, and then send to the server after review.<br>
	</p><br>
	<p style="margin-left: 20px;"><br>
		For instance, if the project uses record auto-numbering, and a record already exists on the server with the same record name, then it will let the user know that it will rename the record accordingly during the sync process in order to prevent any overwriting of the record already on the server.<br>
	</p><br>
	<p style="margin-left: 20px;"><br>
	</p><br>
	<p><br>
		If there are any possible issues that might arise when sending the data <br>
	to the server, the app will prompt the user to make a decision before sending the data. There are many different scenarios that can occur in which a user might be prompted to make a decision, and the app is fully capable of providing the user with just the right amount of guidance so that they feel confident sending their data to the server with no issues.<br>
	</p>
</div>
<div id="q1673" class="faqq">What is the REDCap Mobile App?</div>
<div class="faqa">
	<p>The REDCap Mobile App is an app that is installed on a tablet or mobile device so that data can be collected offline on that device. Data collected offline is later synced (i.e. uploaded) back to an online REDCap project.</p><p>Once a user is given 'REDCap Mobile App' privileges in a project, they can navigate to the Mobile App page on the left-hand menu and set up the project inside the app on their device. Once the project is set up on the device, the user can collect data (which is stored locally on the device). Users can later sync (i.e. upload) that data back to their project when they have a reliable internet connection.</p><p>The app is therefore most useful when data collection will be performed where there is unreliable or no internet service (e.g., no WiFi or cellular service).</p><p><strong>Additional Documentation:</strong></p><ul><br>
	<li>Download iOS app: <a href="https://itunes.apple.com/us/app/redcap-mobile-app/id972760478">https://itunes.apple.com/us/app/redcap-mobile-app/id972760478</a></li><li>Download Android app: <a href="https://play.google.com/store/apps/details?id=edu.vanderbilt.redcap">https://play.google.com/store/apps/details?id=edu.vanderbilt.redcap</a></li><li>About the REDCap Mobile App (PDF): <a href="https://projectredcap.org/about.pdf">https://projectredcap.org/about.pdf</a></li><li>Security in the REDCap Mobile App (PDF): <a href="https://projectredcap.org/security.pdf">https://projectredcap.org/security.pdf</a></li></ul>
</div>
<div id="q1747" class="faqq"><p>What security documentation is available for the Mobile App?</p></div>
<div class="faqa"><p><a href="https://projectredcap.org/security.pdf">https://projectredcap.org/security.pdf</a></p></div>
</div><div class="subspacediv " id="ss74"><h3 onclick="selectSection(74);window.location.href='#ss74';">Randomization Module</h3>
<div id="q1691" class="faqq">If a randomized record is deleted, does the randomization module know to “re-use” the cell of the allocation table that had been used for that deleted record, or is that cell gone forever?</div>
<div class="faqa">If a randomized record is deleted (regardless of whether it was the first, last, or some other record to be randomized), then its allocation will be freed up and available for another record in the future.</div>
<div id="q1689" class="faqq">Is it possible to allow the randomization field to display on a form utilized in both (multiple) arms of a longitudinal project? It appears as though you can only choose 1 arm for which the randomization field displays.</div>
<div class="faqa"><p>It is designed so that the randomization field is enabled for randomization on *only* one event for a record (that includes all arms).  A work around (depending on your project's use case) could be:</p><p>Create one "arm" that is for pre-randomization.  The arm could include the eligibility, demographics forms, etc. up to the form on which the participant should be randomized.  After randomization, the participant can be added into one of the actual study arms.</p><p>You can add a record to multiple arms, but you can only schedule events in one arm.  This design may be a limitation if you are using the scheduling module.</p></div>
</div><div class="subspacediv " id="ss75"><h3 onclick="selectSection(75);window.location.href='#ss75';">Shared Library</h3>
<div id="q1697" class="faqq">How are updates to the instruments that have been shared handled?  Is there any versioning?</div>
<div class="faqa">New versions will not replace old versions, but if more than one version is submitted it will be annotated.</div>
<div id="q1695" class="faqq">If one of our users uploads an instrument and accidentally shares it with the consortium, instead of just their institution, how can the instrument be updated to only be shared within the institution?</div>
<div class="faqa">The submitter can choose Share the instrument again and will be given an option to delete the instrument or resubmit.  The submitter can then resubmit/share again and choose the correct option.</div>
<div id="q1693" class="faqq"> Once uploaded, is an instrument immediately available for download either for the consortium or the institution depending on the sharing selection or is it reviewed by REDLOC before being available?</div>
<div class="faqa">An initial review is done and a confirmation obtained from the submitter that they do want to share the instrument in the library.  A REDCap Administrator then approves the submission prior to its being added to the library.  The instrument is taken to REDLOC for review only if there are issues that the committee needs to discuss.</div>
<div id="q1701" class="faqq">When I attempt to download forms from the REDCap shared library I get the following error message. What is the problem?</div>
<div class="faqa"><p>ERROR: Could not find XML document. </p><p>This likely occurred from an error communicating with the REDCap Shared Library server at  <a href="https://redcap.vanderbilt.edu/consortium/library/">https://redcap.vanderbilt.edu/consortium/library/</a></p><p>The import of the instrument from the REDCap Shared Library did not complete successfully.</p><p>Some institutions are not allowed to utilize the library, or there may be a connection issue.  Check with your REDCap Administrator and IT staff to verify that the connection between your REDCap server and the Vanderbilt server is working.  It could be purposely or accidently blocked by a firewall or problems with proxy settings in the REDCap Control Panel.</p></div>
<div id="q1699" class="faqq">How do I add an instrument from the Shared Library into my project?</div>
<div class="faqa"><ol><li>Go to the Online Designer. </li><li>Choose Import a new instrument from the official REDCap Shared Library. </li><li>Do a Keyword search for the subject or instrument title. </li><li>Choose Import into my REDCap project. </li><li>Read and agree to the license agreement. </li><li> Click Add the imported instrument with the name “Instrument”. </li><li>Choose Return to previous page and the instrument will be at the bottom of your instrument list.</li></ol></div>
</div></div></div>
</div>