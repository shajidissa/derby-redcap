<?php

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Display the project header
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

// Your HTML page content goes here
?>
<style type="text/css">
table.ReportTableWithBorder {
	border-right:1px solid black;
	border-bottom:1px solid black;
}
table.ReportTableWithBorder th, table.ReportTableWithBorder td {
	border-top: 1px solid black;
	border-left: 1px solid black;
	padding: 4px 5px;
}
table.ReportTableWithBorder th { font-weight:bold;  }
td.vwrap {word-wrap:break-word;word-break:break-all;}
@media print {
	#sub-nav { display: none; }
}
</style>
<?php

// TABS
include APP_PATH_DOCROOT . "ProjectSetup/tabs.php";

// Place all html in variables
$html = $table = "";

// Instructions
$html .= RCView::p(array('class'=>'hide_in_print', 'style'=>'margin:10px 0 20px;max-width:700px;'),
			$lang['design_483']
		 );

// PRINT PAGE button, today's date, and page header
$html .= RCView::table(array('cellspacing'=>0, 'style'=>'width:99%;table-layout:fixed;margin:10px 0 20px;'),
			RCView::tr(array(),
				RCView::td(array('style'=>'width:150px;'),
					RCView::button(array('class'=>'jqbuttonmed invisible_in_print', 'onclick'=>'window.print();'),
						RCView::img(array('src'=>'printer.png')) .
						$lang['graphical_view_15']
					)
				) .
				RCView::td(array('style'=>'text-align:center;font-size:18px;font-weight:bold;'),
					RCView::img(array('src'=>'codebook.png')) .
					$lang['global_116']
				) .
				RCView::td(array('style'=>'text-align:right;width:130px;color:#666;'),
					RCView::span(array('class'=>'visible_in_print_only'),
						DateTimeRC::format_ts_from_ymd(NOW)
					)
				)
			)
		);

// Determine if we will allow navigation to Online Designer via pencil icon
$allow_edit = ($user_rights['design'] && ($status == '0' || ($status == '1' && $draft_mode == '1')));
$th_edit = $allow_edit ? RCView::th(array('style'=>'text-align:center;background-color:#ddd;width:28px;'), '') : '';

// Table headers
$table .= RCView::tr(array(),
			$th_edit .
			RCView::th(array('style'=>'text-align:center;background-color:#ddd;width:4%;'), '#') .
			RCView::th(array('style'=>'background-color:#ddd;width:20%;'), $lang['design_484']) .
			RCView::th(array('style'=>'background-color:#ddd;'), $lang['global_40'] . RCView::div(array('style'=>'color:#666;font-size:11px;'), "<i>{$lang['database_mods_69']}</i>")) .
			RCView::th(array('style'=>'background-color:#ddd;width:35%;'), $lang['design_494'])
		);

foreach ($Proj->metadata as $attr)
{
	$print_label = "";
	$mc_choices_array = ($attr['element_enum'] == '') ? array() : parseEnum($attr['element_enum']);
	$this_element_label = nl2br(strip_tags(label_decode($attr['element_label'])));
	$print_field_name =  $attr['field_name'] ;
	if ($attr['branching_logic'] != "" ) {
		$print_field_name .= RCView::div(array('style'=>'margin-top:10px;'),
								RCView::div(array('style'=>'color:#777;margin-right:5px;'), $lang['design_485']) .
								$attr['branching_logic']
							 );
	}
	if ($attr['element_preceding_header'] != "") {
		$print_label .= RCView::div(array('style'=>'margin-bottom:6px;font-size:11px;'),
							$lang['global_127'] . "<i style='color:#666;'>" . RCView::escape(strip_tags(label_decode($attr['element_preceding_header']))) . "</i>"
						);
	}
	$print_label .= $this_element_label ;
	if ($attr['element_note'] != "") {
		$print_label .= RCView::div(array('style'=>'color:#666;font-size:11px;'),
							"<i>" . RCView::escape(strip_tags(label_decode($attr['element_note']))) . "</i>"
						);
	}
	if ($attr['element_type'] == 'select') $attr['element_type'] = 'dropdown';
	elseif ($attr['element_type'] == 'textarea') $attr['element_type'] = 'notes';
	$print_type = $attr['element_type'];
	if ($attr['element_validation_type'] != "" ) {
		if ($attr['element_validation_type'] == 'int') $attr['element_validation_type'] = 'integer';
		elseif ($attr['element_validation_type'] == 'float') $attr['element_validation_type'] = 'number';
		elseif (in_array($attr['element_validation_type'], array('date', 'datetime', 'datetime_seconds'))) $attr['element_validation_type'] .= '_ymd';
		$print_type .= " (" . $attr['element_validation_type'];
		if ($attr['element_validation_min'] != "" ) {
			$print_type .= ", {$lang['design_486']} " . $attr['element_validation_min'];
		}
		if ($attr['element_validation_max'] != "" ) {
			$print_type .= ", {$lang['design_487']} " . $attr['element_validation_max'];
		}
		$print_type .= ")";
	}
	if ($attr['element_type'] == 'radio' && $attr['grid_name'] != '') {
		$print_type .= " ({$lang['design_502']}";
		if ($attr['grid_rank'] == '1') {
			$print_type .= " {$lang['design_503']}";
		}
		$print_type .= ")";
	}
	if ($attr['field_req'] == '1') { $print_type .= ", Required"; }
	if ($attr['field_phi'] == '1') { $print_type .= ", Identifier"; }
	if ($attr['element_enum'] != "") {
		if ($attr['element_type'] == 'slider' ) {
			$print_type .= "<br />{$lang['design_488']} " . implode(", ", Form::parseSliderLabels($attr['element_enum']));
		} elseif ($attr['element_type'] == 'calc') {
			$print_type .= "<br />{$lang['design_489']} " . $attr['element_enum'];
		} elseif ( $attr['element_type'] == 'sql' ) {
			$print_type .= '<table border="0" cellpadding="2" cellspacing="0" class="ReportTableWithBorder"><tr><td>' . $attr['element_enum'] . '</td></tr></table>';
		} else {
			$print_type .= '<table border="0" cellpadding="2" cellspacing="0" class="ReportTableWithBorder">';
			foreach ($mc_choices_array as $val=>$label) {
				$print_type .= '<tr valign="top">';
				if ($attr['element_type'] == 'checkbox' ) {
					$print_type .= '<td>' . $val . '</td>';
					$val = (Project::getExtendedCheckboxCodeFormatted($val));
					$print_type .= '<td>' . $attr['field_name'] . '___' . $val . '</td>';
				} else {
					$print_type .= '<td>' . $val . '</td>';
				}
				$print_type .= '<td>' . RCView::escape(strip_tags(label_decode($label))) . '</td>';
				$print_type .= '</tr>';
			}
			$print_type .= '</table>';
		}
	}
	if ($attr['custom_alignment'] != "") {
		$print_type .= "<br />{$lang['design_490']} " . $attr['custom_alignment'];
	}
	if ($attr['question_num'] != "") {
		$print_type .= "<br />{$lang['design_491']} " . RCView::escape($attr['question_num']);
	}
	if ($attr['misc'] != "") {
		$print_type .= "<br />{$lang['design_527']}{$lang['colon']} " . RCView::escape($attr['misc']);
	}
	if ($attr['stop_actions'] != "") {
		// Make sure that all stop actions still exist as a valid choice and remove any that are invalid
		$stop_actions_array = array();
		foreach (explode(",", $attr['stop_actions']) as $code) {
			if (isset($mc_choices_array[$code])) {
				$stop_actions_array[] = $code;
			}
		}
		// Display stop action choices
		if (!empty($stop_actions_array)) {
			$print_type .= "<br />{$lang['design_492']} " . implode(", ", $stop_actions_array);
		}
	}
	// Instrument name, if there is one
	if ($attr['form_menu_description'] != "") {
		$colspan = $allow_edit ? 5 : 4;
		$table .= RCView::tr(array(),
					RCView::td(array('colspan'=>$colspan, 'style'=>'color:#444;background-color:#cccccc;padding:8px 10px;'),
						$lang['design_493'] .
						RCView::span(array('style'=>'font-size:120%;font-weight:bold;margin-left:7px;color:#000;'),
							$attr['form_menu_description']
						) .
						RCView::span(array('style'=>'margin-left:10px;color:#444;'),
							"(". $attr['form_name'].")"
						)
					)
				);
	}
	// Print the preceding header above the field, if there is one
	if (isset($this_element_preceding_header) && $this_element_preceding_header != "") {
		$table .= RCView::tr(array('valign'=>'top'),
					RCView::td(array('colspan'=>'2'), '') .
					RCView::td(array('colspan'=>'2'),
						nl2br(RCView::escape(strip_tags(label_decode($attr['element_preceding_header']))))
					)
				  );
	}

	// Skip "complete" fields and users without design rights
	$td_edit = "";
	if ($allow_edit) {
		$edit_field = "&nbsp;";
		$edit_branch = "";
		// Make sure field is editable
		if ($attr['field_name'] != $attr['form_name'] . '_complete' &&
			(($status == '0' && isset($Proj->metadata[$attr['field_name']])) || ($status == '1' && isset($Proj->metadata_temp[$attr['field_name']]))))
		{
			switch( $attr['element_type'] )
			{
				case 'dropdown':
					$et = 'select';
					break;
				case 'notes':
					$et = 'textarea';
					break;
				default:
					$et = $attr['element_type'];
			}
			$matrix = $attr['grid_name'] == '' ? '' : '&matrix=1';
			$edit_field = RCView::a(array('class'=>'hide_in_print', 'href'=>APP_PATH_WEBROOT.'Design/online_designer.php?pid=' . $project_id . '&page=' . $attr['form_name'] .
							'&field=' . $attr['field_name'] . $matrix),
							RCView::img(array('src'=>'pencil.png', 'title'=>$lang['design_616']))
						);
			if ($attr['field_name'] != $table_pk) {
				$edit_branch = RCView::a(array('class'=>'hide_in_print', 'href'=>APP_PATH_WEBROOT.'Design/online_designer.php?pid=' . $project_id . '&page=' . $attr['form_name'] .
								'&field=' . $attr['field_name'] . '&branching=1'),
								RCView::img(array('src'=>'arrow_branch_side.png', 'title'=>$lang['design_619']))
							);
			}
		}
		$td_edit = 	RCView::td(array('style'=>'text-align:center;width:28px;'),
						$edit_field .
						RCView::div(array('style'=>'margin-top:5px;'), $edit_branch)
					);

	}

	// Print the information about the field
	$table .= RCView::tr(array('valign'=>'top'),
				$td_edit .
				RCView::td(array('style'=>'text-align:center;'), $attr['field_order']) .
				RCView::td(array('class'=>'vwrap'), $print_field_name) .
				RCView::td(array(), $print_label) .
				RCView::td(array(), $print_type)
			);
}

$html .= RCView::table(array('style'=>'width:99%;table-layout:fixed;', 'class'=>'ReportTableWithBorder'), $table);

// Output html
print $html;

// Display the project footer
require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
