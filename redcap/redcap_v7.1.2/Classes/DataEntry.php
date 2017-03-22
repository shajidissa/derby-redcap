<?php

/**
 * DataEntry
 * This class is used for processes related to general data entry.
 */
class DataEntry
{
	// Set maximum number of records before the record selection drop-downs disappear on Data Entry Forms
	public static $maxNumRecordsHideDropdowns = 25000;
	
	// Return HTML for rendering the button-icons for collapsing tables on Record Home page (maybe elsewhere)
	public static function renderCollapseTableIcon($project_id, $tableid)
	{
		global $lang;
		// Get current collapsed state
		$collapsed = UIState::isTableCollapsed($project_id, $tableid);
		$collapsed_attr = $collapsed ? '1' : '0';
		$collapsed_class = $collapsed ? 'btn-primary' : 'opacity50';
		// Return button-icon html
		return "<button targetid='$tableid' collapsed='$collapsed_attr' class='btn btn-defaultrc $collapsed_class btn-xs btn-table-collapse' title='".cleanHtml($lang['grid_48'])."'>
					<img src='".APP_PATH_IMAGES."arrow_state_grey_expanded_sm.png'>
				</button>";
	}
	
	// Return HTML for rendering the button-icons for collapsing event columns on Record Home page
	public static function renderCollapseEventColumnIcon($project_id, $eventid)
	{
		global $lang;
		// Get current collapsed state
		$collapsed = UIState::isEventColumnCollapsed($project_id, $eventid);
		$collapsed_attr = $collapsed ? '1' : '0';
		$collapsed_class = $collapsed ? 'btn-warning' : 'opacity50';
		$glyphicon_class = $collapsed ? 'glyphicon-forward' : 'glyphicon-backward';
		// Return button-icon html
		return "<button targetid='$eventid' collapsed='$collapsed_attr' class='btn btn-defaultrc $collapsed_class btn-xs btn-event-collapse' title='".cleanHtml($lang['grid_49'])."'>
					<span class='glyphicon $glyphicon_class'></span>
				</button>";
	}
	
	// Return array of settings for Custom Record Status Dashboard using the rd_id
	public static function getRecordDashboardSettings($rd_id=null)
	{
		global $lang, $longitudinal;
		// Validate rd_id
		$rd_id = (int)$rd_id;
		// Set default dashboard settings
		$dashboard = getTableColumns('redcap_record_dashboards');
		// Always force group_by event if classic project
		if (!$longitudinal) $dashboard['group_by'] = 'event';
		// If we're showing the default dashboard, then return default array
		if (empty($rd_id)) return $dashboard;
		// Get the dashboard
		$sql = "select * from redcap_record_dashboards where rd_id = $rd_id and project_id = ".PROJECT_ID;
		$q = db_query($sql);
		if (!$q || !db_num_rows($q)) return $dashboard;
		return db_fetch_assoc($q);		
	}
	
	// Return array as list of all Custom Record Status Dashboards for this project (including the default)
	public static function getRecordDashboardsList()
	{
		global $lang;
		// Set default dashboard settings
		$dashboard = array(''=>$lang['data_entry_333']);
		// Get the dashboard
		$sql = "select rd_id, title from redcap_record_dashboards where project_id = ".PROJECT_ID." order by title";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$dashboard[$row['rd_id']] = strip_tags($row['title']);
		}
		return $dashboard;
	}
	
	
	// Generate the code to edit the filter
	public static function createRecordDashboardBox($config) 
	{
		global $Proj, $user_rights;
		
		$filter_logic = $config['filter'];
		
		// Arms Options
		$arms_select = false;
		if ($Proj->multiple_arms) {
			$arms_records = Records::getRecordListPerArm();
			$arms_options = array();
			foreach ($Proj->events as $arm_num => $arm_detail) {
				$arm_label = $arm_detail['name'] . (isset($arms_records[$arm_num]) ? " - " . count($arms_records[$arm_num]) . " records" : " - 0 records");
				$arms_options[$arm_num] = $arm_label;
			}
			$arms_select = RCView::select(array(
				'id'=>'arm_num','class'=>'x-form-text x-form-field',
				'onchange'=>'refreshDashboard();'),
				$arms_options, $config['arm']);
		}
		
		// Make the Config box (initially not displayed)
		$html =	RCView::div(array('id'=>'configbox', 'class'=>'chklist trigger', 'style'=>"max-width:775px;display:none;"),
			RCView::div(array('class'=>'chklisthdr', 'style'=>'font-size:13px;color:#393733;margin-bottom:5px;'), 				
				RCView::img(array('src'=>'gear.png', 'class'=>'imgfix'))." Configuration Options:"
			).	
			RCView::p(array(),"Configuration options are only available to users with design rights.  Permissions to each saved dashboard can be edited under the 'Add Edit Bookmarks' section.").
			RCView::table(array('class'=>'tbi', 'style'=>'width:100%'),
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Dashboard Title:</label>").
					RCView::td(array('class'=>'td2'),
						RCView::input(array(
							'id'=>'dashboard_title', 
							'class'=>'x-form-text x-form-field',
							'style'=>'font-size:14px;font-weight:bold;width:608px;',
							'name'=>'dashboard_title',
							'value'=>htmlentities($config['title'],ENT_QUOTES))
						).
						RCView::input(array(
							'id'=>'ext_id', 
							'type'=>'hidden',
							'name'=>'ext_id',
							'value'=>$config['ext_id'])
						)
					)
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Description / Instructions:</label>").
					RCView::td(array('class'=>'td2'),
						RCView::textarea(array(
							'class'=>'x-form-text x-form-field',
							'style'=>'width:608px;height:30px;',
							'id'=>'dashboard_description'), 
						htmlentities($config['description'],ENT_QUOTES))
					)
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Group By (Form/Event):</label>").
					RCView::td(array('class'=>'td2'),
					 	RCView::textarea(array(
							'class'=>'x-form-text x-form-field code',
							'style'=>'width:608px;',
							'id'=>'record_label',
							'onchange'=>""), $record_label)
					)
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Sort By(???)</label>").
					RCView::td(array('class'=>'td2'),
					 	RCView::textarea(array(
							'class'=>'x-form-text x-form-field code',
							'style'=>'width:608px;',
							'id'=>'record_label',
							'onchange'=>""), $record_label)
					)
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Filter Logic:</label>").
					RCView::td(array('class'=>'td2'),
					 	RCView::textarea(array(
							'class'=>'x-form-text x-form-field code',
							'style'=>'width:608px;',
							'id'=>'filter_logic',
							'onchange'=>"javascript:testFilter()"), $filter_logic)
					)
				).
				($arms_select ? RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "<label>Arm:</label>").
					RCView::td(array('class'=>'td2'),
						$arms_select
					)
				) : '').
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "Excluded Forms:").
					RCView::td(array('class'=>'td2'),
					 	RCView::div(array('class'=>'x-form-text  x-form-field','style'=>'font-weight:normal','onclick'=>'toggleExcludeForms()'),
							RCView::img(array('src'=>'pencil_small2.png')).
							RCView::input(array('id'=>'excluded_forms',
								'style'=>'border:none; background-color: transparent; width: 580px;',
								'value'=> $config['excluded_forms'],'disabled'=>'disabled')
							)
						).
						''//self::renderExcludeForms($config)
					)
				).
				( REDCap::isLongitudinal() ?
					RCView::tr(array(),
						RCView::td(array('class'=>'td1'), "Excluded Events:").
						RCView::td(array('class'=>'td2'),
						 	RCView::div(array('class'=>'x-form-text  x-form-field','style'=>'font-weight:normal;','onclick'=>'toggleExcludeEvents()'),
								RCView::img(array('src'=>'pencil_small2.png')).
								RCView::input(array('id'=>'excluded_events',
									'style'=>'border:none; background-color: transparent; width: 580px;',
									'value'=> $config['excluded_events'],'disabled'=>'disabled')
								)
							).
							''//self::renderExcludeEvents($config)
						)
					) : ''
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "Header Orientation").
					RCView::td(array('class'=>'td2'),
						RCView::select(array(
							'id'=>'vertical_header','class'=>'x-form-text x-form-field',
							'onchange'=>"refreshDashboard();"),
							array('0'=>'Horizontal (default)','1'=>'Vertical'), $config['vertical_header']
						)
					)
				).
				RCView::tr(array(),
					RCView::td(array('class'=>'td1'), "").
					RCView::td(array('class'=>'td2'),
						RCView::button(array('id'=>'btn_refresh', 'class'=>'jqbuttonmed ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only','onclick'=>'refreshDashboard()', 'style'=>'margin-top: 5px;'), 'Refresh Dashboard').
						RCView::button(array('id'=>'btn_save', 'class'=>'jqbuttonmed ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only','onclick'=>'saveDashboard()', 'style'=>'margin-top: 5px;' . (empty($config['ext_id']) ? 'display:none;' : '')), 'Save Dashboard').
						RCView::button(array('id'=>'btn_save_new', 'class'=>'jqbuttonmed ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only','onclick'=>'saveNewDashboard()', 'style'=>'margin-top: 5px;'), 'Save New Dashboard').
						RCView::button(array('id'=>'btn_delete', 'class'=>'jqbuttonmed ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only','onclick'=>'deleteDashboard()', 'style'=>'margin-top: 5px;' . (empty($config['ext_id']) ? 'display:none;' : '')), 'Delete Dashboard')
					)
				)
			)
		);
		return $html;
	}
}