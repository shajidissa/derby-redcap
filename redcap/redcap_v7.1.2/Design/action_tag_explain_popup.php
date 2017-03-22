<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Must be accessed via POST AJAX
if (!$isAjax || $_SERVER['REQUEST_METHOD'] != 'POST') exit;

// Build list of all action tags
$action_tag_descriptions = "";
foreach (Form::getActionTags() as $tag=>$description) {
	$action_tag_descriptions .=
		RCView::tr(array(),
			RCView::td(array('class'=>'nowrap', 'style'=>'text-align:center;background-color:#f5f5f5;color:#912B2B;padding:7px 15px 7px 12px;font-weight:bold;border:1px solid #ccc;border-bottom:0;border-right:0;'),
				RCView::button(array('class'=>'jqbuttonmed', 'style'=>'color:#222;', 'onclick'=>"$('#field_annotation').val(trim('".cleanHtml($tag)." '+$('#field_annotation').val())); highlightTableRowOb($(this).parentsUntil('tr').parent(),2500);"), $lang['design_171'])
			) .
			RCView::td(array('class'=>'nowrap', 'style'=>'background-color:#f5f5f5;color:#912B2B;padding:7px;font-weight:bold;border:1px solid #ccc;border-bottom:0;border-left:0;border-right:0;'),
				$tag
			) .
			RCView::td(array('style'=>'background-color:#f5f5f5;padding:7px;border:1px solid #ccc;border-bottom:0;border-left:0;'),
				$description
			)
		);
}

// Content
$content  = RCView::div(array('style'=>''),
				$lang['design_607']
			) .
			RCView::div(array('style'=>'margin:10px 0;'),
				$lang['design_615']
			) .
			RCView::div(array('style'=>'margin:10px 0 5px;'),
				RCView::b($lang['design_608']) .
				RCView::table(array('style'=>'margin-top:1px;width:100%;border-bottom:1px solid #ccc;line-height:13px;'),
					$action_tag_descriptions
				)
			);

// Return JSON
print json_encode(array('content'=>$content, 'title'=>$lang['design_606']));