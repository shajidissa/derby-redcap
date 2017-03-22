<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

/**
 * LOCKING
 */
class Locking
{
	// Array of record-event-fields that are locked in a project
	public $locked = array();

	// Get array of all record-event-fields that are locked in a project, and add to $locked array
	public function findLocked($Proj, $records=array(), $fields=array(), $events=array())
	{
		// Build SQL
		$project_id = $Proj->project_id;
		if (!is_array($records)) $records = array($records);
		$recordSql = empty($records) ? "" : "and l.record in (".prep_implode($records).")";
		if (!is_array($fields)) $fields = array($fields);
		$fieldSql = empty($fields) ? "" : "and m.field_name in (".prep_implode($fields).")";
		if (!is_array($events)) $events = array($events);
		$eventSql = empty($events) ? "" : "and l.event_id in (".prep_implode($events).")";
		## LOCKING CHECK: Get all forms that are locked for the uploaded records
		$sql = "select l.record, l.event_id, l.instance, m.field_name, m.element_type, m.element_enum
				from redcap_locking_data l, redcap_metadata m
				where m.project_id = $project_id $recordSql $eventSql $fieldSql
				and l.project_id = m.project_id and m.form_name = l.form_name";
		$locked = array();
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q))
		{
			if ($row['element_type'] == 'checkbox') {
				foreach (array_keys(parseEnum($row['element_enum'])) as $this_code) {
					$chkbox_field_name = $row['field_name'] . "___" . Project::getExtendedCheckboxCodeFormatted($this_code);
					$this->locked[$row['record']][$row['event_id']][$row['instance']][$chkbox_field_name] = "";
				}
			} else {
				$this->locked[$row['record']][$row['event_id']][$row['instance']][$row['field_name']] = "";
			}
		}
	}

}
