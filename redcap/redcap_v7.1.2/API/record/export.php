<?php
		$query = "select r.record, r.completion_time, p.participant_identifier, s.form_name, p.event_id
			$timestamp_identifiers[$row['record']][$row['event_id']][$row['form_name']] = array('ts'=>$row['completion_time'], 'id'=>$row['participant_identifier']);
	if ($type == 'eav')