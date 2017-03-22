<?php

class Event
{
	// Save form-event mapping to a given project
	// Return array with count of events added and array of errors, if any
	public static function saveEventMapping($project_id, $data)
	{
		global $lang;

		$count = 0;
		$errors = array();

		// Instantiate Project because we'll need it below
		$Proj = new Project($project_id);

		// Check structure (skip for ODM project creation)
		if (!defined("CREATE_PROJECT_ODM") && (empty($data) || !isset($data[0]['form']) || !isset($data[0]['unique_event_name']) || !isset($data[0]['arm_num']))) {
			$msg = $errors[] = $lang['design_641'] . " arm_num,unique_event_name,form";
			if (defined("API")) {
				die(RestUtility::sendResponse(400, $msg));
			} else {
				return array($count, $errors);
			}
		} else {
			// Error checking
			foreach ($data as $e)
			{
				if (!is_numeric($e['arm_num']) || $e['arm_num'] < 0) {
					$errors[] = "{$lang['design_636']} \"{$e['arm_num']}\" {$lang['design_639']}";
				}
				elseif (!Arm::getArm($project_id, $e['arm_num'])) {
					$errors[] = "{$lang['design_644']} \"{$e['arm_num']}\" {$lang['design_643']}";
				}
				if (!$Proj->getEventIdUsingUniqueEventName($e['unique_event_name'])) {
					$errors[] = "{$lang['design_642']} \"{$e['unique_event_name']}\" {$lang['design_643']}";
				}
				if (!isset($Proj->forms[$e['form']])) {
					$errors[] = "{$lang['design_653']} \"{$e['form']}\" {$lang['design_643']}";
				}
			}
			if (empty($errors))
			{
				// Set new mappings
				$Proj->clearEventForms();
				return array($Proj->addEventForms($data), $errors);
			}
			else
			{
				if (defined("API")) {
					die(RestUtility::sendResponse(400, implode("\n", $errors)));
				} else {
					return array($count, $errors);
				}
			}
		}
	}


	// Add new events to a given project (with option to delete all)
	// Return array with count of events added and array of errors, if any
	public static function addEvents($project_id, $data, $override=false)
	{
		global $lang;

		if($override)
		{
			Event::deleteAll($project_id);
		}

		$count = 0;
		$day_offset = 0;
		$errors = array();

		// Check for basic attributes needed
		if (empty($data) || !isset($data[0]['event_name']) || !isset($data[0]['arm_num'])) {
			$msg = $errors[] = $lang['design_641'] . " event_name,arm_num" . ($override ? "" : ",unique_event_name");
			if (defined("API")) {
				die(RestUtility::sendResponse(400, $msg));
			} else {
				return array($count, $errors);
			}
		}

		foreach($data as $e)
		{
			$day_offset++;

			// Set defaults
			if (!isset($e['day_offset'])) $e['day_offset'] = $day_offset;
			if (!isset($e['offset_min'])) $e['offset_min'] = 0;
			if (!isset($e['offset_max'])) $e['offset_max'] = 0;

			// Error checking
			if (!is_numeric($e['arm_num']) || $e['arm_num'] < 0) {
				$errors[] = "{$lang['design_636']} \"{$e['arm_num']}\" {$lang['design_639']}";
				continue;
			}
			if (!Arm::getArm($project_id, $e['arm_num'])) {
				$errors[] = "{$lang['design_644']} \"{$e['arm_num']}\" {$lang['design_643']}";
				continue;
			}
			if (!is_numeric($e['day_offset'])) {
				$errors[] = "{$lang['design_645']} \"{$e['day_offset']}\" {$lang['design_646']}";
				continue;
			}
			if (!is_numeric($e['offset_min']) || $e['offset_min'] < 0) {
				$errors[] = "{$lang['design_647']} \"{$e['offset_min']}\" {$lang['design_639']}";
				continue;
			}
			if (!is_numeric($e['offset_max']) || $e['offset_max'] < 0) {
				$errors[] = "{$lang['design_648']} \"{$e['offset_max']}\" {$lang['design_639']}";
				continue;
			}
			if (strlen($e['event_name']) > 30) {
				$errors[] = "{$lang['design_649']} \"{$e['event_name']}\" {$lang['design_650']}";
				continue;
			}

			if(!$override)
			{
				$Proj = new Project($project_id);
				$id = $Proj->getEventIdUsingUniqueEventName($e['unique_event_name']);

				if($id)
				{
					Event::update($id, $e);
					++$count;
					continue;
				}
			}

			Event::create($project_id, $e);
			++$count;
		}

		// Return count and array of errors
		return array($count, $errors);
	}


	public static function deleteAll($project_id)
	{
		$project_id = (int)$project_id;
		$ids = Arm::IDs($project_id);
		$count = 0;

		foreach($ids as $arm_id)
		{
			$sql = "
				DELETE FROM redcap_events_metadata
				WHERE arm_id = $arm_id
			";

			$q = db_query($sql);
			if($q && $q !== false)
			{
				$count += db_affected_rows();
			}
		}

		return $count;
	}

	public static function delete($event_id)
	{
		$event_id = (int)$event_id;

		$sql = "
			DELETE FROM redcap_events_metadata
			WHERE event_id = $event_id
			LIMIT 1
		";

		$q = db_query($sql);
		if($q && $q !== false)
		{
			return db_affected_rows();
		}
		return 0;
	}

	public static function create($projectId, $event)
	{
		$projectId = (int)$projectId;
		$arm = Arm::getArm($projectId, $event['arm_num']);
		if(!$arm) return false;

		$arm_id = (int)$arm['arm_id'];
		$day_offset = (int)$event['day_offset'];
		$offset_min = (int)$event['offset_min'];
		$offset_max = (int)$event['offset_max'];
		$descrip = prep($event['event_name']);
		$custom_event_label = prep($event['custom_event_label']);

		$sql = "
			INSERT INTO redcap_events_metadata (
				arm_id, day_offset, offset_min, offset_max, descrip, custom_event_label
			) VALUES (
				$arm_id, $day_offset, $offset_min, $offset_max, '$descrip', '$custom_event_label'
			)
		";

		$q = db_query($sql);
		return ($q && $q !== false);
	}

	public static function update($event_id, $event)
	{
		$event_id = (int)$event_id;
		$day_offset = (int)$event['day_offset'];
		$offset_min = (int)$event['offset_min'];
		$offset_max = (int)$event['offset_max'];
		$descrip = prep($event['event_name']);
		$custom_event_label = prep($event['custom_event_label']);

		$sql = "
			UPDATE redcap_events_metadata
			SET
				descrip = '$descrip',
				day_offset = $day_offset,
				offset_min = $offset_min,
				offset_max = $offset_max,
				custom_event_label = '$custom_event_label'
			WHERE event_id = $event_id
			LIMIT 1
		";

		$q = db_query($sql);
		return ($q && $q !== false);
	}

	public static function getByProjArmNumEventName($projectId, $arm_num, $event_name)
	{
		$projectId = (int)$projectId;
		$arm = Arm::getArm($projectId, $arm_num);
		if(!$arm) return null;

		$arm_id = (int)$arm['arm_id'];
		$descrip = prep($event_name);

		$sql = "
			SELECT *
			FROM redcap_events_metadata
			WHERE arm_id = $arm_id
			AND descrip = '$descrip'
		";

		$q = db_query($sql);

		if($q && $q !== false)
		{
			$array = db_fetch_assoc($q);
			return $array;
		}

		return null;
	}

	public static function getEventsByProject($projectId)
	{
		$eventList = array();

		$sql = "SELECT *
				FROM redcap_events_metadata rem
					JOIN redcap_events_arms rea ON rem.arm_id = rea.arm_id
				WHERE project_id = $projectId";
		$events = db_query($sql);

		while ($row = db_fetch_array($events))
		{
			$eventList[$row['event_id']] = $row['descrip'];
		}

		return $eventList;
	}

	public static function getEventIdByName($projectId, $name)
	{
		$idList = getEventIdByKey($projectId, array($name));
		$id = (count($idList) > 0) ? $idList[0] : 0;

		return $id;
	}

	public static function getUniqueKeys($projectId)
	{
		global $Proj;
		if (empty($Proj)) {
			$Proj2 = new Project($projectId);
			return $Proj2->getUniqueEventNames();
		} else {
			return $Proj->getUniqueEventNames();
		}
	}

	public static function getEventNameById($projectId, $id)
	{
		$uniqueKeys = array_flip(Event::getUniqueKeys($projectId));

		$name = array_search($id, $uniqueKeys);

		return $name;
	}

	public static function getEventIdByKey($projectId, $keys)
	{
		$uniqueKeys = Event::getUniqueKeys($projectId);
		$idList = array();

		foreach($keys as $key)
		{
			$idList[] = array_search($key, $uniqueKeys);
		}

		return $idList;
	}
}
