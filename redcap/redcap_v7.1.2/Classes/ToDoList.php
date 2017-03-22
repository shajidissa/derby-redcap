<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


/**
 * ToDoList Class
 */
class ToDoList
{

  public static function insertAction($ui_id, $request_to, $todo_type, $action_url, $project_id=null){
	// Add to table
    $sql = "insert into redcap_todo_list (request_from, request_to, todo_type, action_url, request_time, status, project_id) values
        ('".prep($ui_id)."', '".prep($request_to)."', '".prep($todo_type)."',
        '".prep($action_url)."', '".NOW."', 'pending', ".checkNull($project_id).")";
    db_query($sql);
	$request_id = db_insert_id();
	// Append request_id to end of action URL after insert to keep as a reference during admin processing
	$sql = "update redcap_todo_list set action_url = concat(action_url, '&request_id=$request_id') where request_id = $request_id";
    db_query($sql);
	// Return request_id
	return $request_id;
  }

  public static function retrieveToDoListByStatus($status, $sort, $direction){
    $sql = "select t.*, (select p.app_title from redcap_projects p where p.project_id = t.project_id) as app_title,
			u.username, u.user_email, concat(u.user_firstname, ' ', u.user_lastname) as full_name
			from redcap_todo_list t, redcap_user_information u
			where t.request_from = u.ui_id and t.status = '".prep($status)."'
			order by ".prep($sort)." ".$direction;
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q))
		{
			$result[$row['request_id']] = $row;
		}

    return $result;
  }

  public static function retrieveArchivedToDoList($sort, $start_from, $per_page, $direction){
    $sql = "select t.*, (select p.app_title from redcap_projects p where p.project_id = t.project_id) as app_title,
			u.username, u.user_email, concat(u.user_firstname, ' ', u.user_lastname) as full_name, u2.username as processed_by
			from redcap_user_information u, redcap_todo_list t
			left join redcap_user_information u2 on t.request_completion_userid = u2.ui_id
			where t.request_from = u.ui_id and (t.status = 'archived' or t.status = 'completed')
			order by ".prep($sort)." ".$direction." limit ".$start_from.", ".$per_page."";
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q))
		{
			$result[$row['request_id']] = $row;
		}

    return $result;
  }

  public static function getTotalNumberArchivedRequests(){
    $sql = "select count(1) from redcap_todo_list where status = 'archived' or status = 'completed'";
    $q = db_query($sql);
	return db_result($q, 0);
  }

  public static function getTotalNumberRequestsByStatus($status){
    $sql = "select count(1) from redcap_todo_list where status = '".$status."'";
    $q = db_query($sql);
	return db_result($q, 0);
  }

  public static function checkIfRequestExist($pid, $ui_id, $todo_type){
    $sql = "select count(1) from redcap_todo_list where status = 'pending' and request_from = '".prep($ui_id)."' and project_id = '".prep($pid)."' and todo_type = '".prep($todo_type)."' ";
    $q = db_query($sql);
	return db_result($q, 0);
  }

  public static function getProjectTitle($project_id){
    $sql = "select app_title from redcap_projects where project_id = '".prep($project_id)."' limit 1";
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q)) {
      $projectTitle = $row['app_title'];
    }

    return $projectTitle;

  }

  public static function updateTodoStatus($project_id, $todo_type, $status, $requestor_uiid=null){
	$userInfo = User::getUserInfo(USERID);
    $sql = "update redcap_todo_list set status='".prep($status)."', request_completion_time='".NOW."',
			request_completion_userid = {$userInfo['ui_id']}
			where project_id = '" . prep($project_id) ."' and todo_type = '".prep($todo_type)."' and status != 'archived'";
	if ($requestor_uiid !== null) {
		$sql .= " and request_from = $requestor_uiid";
	}
    $q = db_query($sql);
  }

  public static function updateTodoStatusNewProject($request_id, $new_project_id){
	$userInfo = User::getUserInfo(USERID);
    $sql = "update redcap_todo_list set status='completed', project_id='".$new_project_id."', request_completion_time='".NOW."',
			request_completion_userid = {$userInfo['ui_id']}
			where request_id = '" . prep($request_id) ."' ";
    $q = db_query($sql);
  }

	// Get label for each status of a todo list item
	public static function getStatusLabel($status){
		global $lang;
		if ($status == 'copy project') {
			return $lang['control_center_4548'];
		} elseif ($status == 'draft changes') {
			return $lang['control_center_4549'];
		} elseif ($status == 'new project') {
			return $lang['control_center_4550'];
		} elseif ($status == 'move to prod') {
			return $lang['control_center_4552'];
		} elseif ($status == 'delete project') {
			return $lang['control_center_4551'];
		} elseif ($status == 'token access') {
			return $lang['control_center_251'];
		} else {
			return $status;
		}
	}

  public static function csvDownload(){
    $sql = "select t.request_id as request_number, t.todo_type as request_type, t.request_time, t.status,
			u.username, concat(u.user_firstname, ' ', u.user_lastname) as user_full_name, u.user_email,
			t.request_completion_time, u2.username as processed_by ,
			(select p.app_title from redcap_projects p where p.project_id = t.project_id) as project_title, t.project_id, t.action_url
			from redcap_user_information u, redcap_todo_list t
			left join redcap_user_information u2 on t.request_completion_userid = u2.ui_id
			where t.request_from = u.ui_id
			order by t.request_id desc";
	$q = db_query($sql);
    while ($row = db_fetch_assoc($q))
		{
			$row['request_type'] = self::getStatusLabel($row['request_type']);
			$result[$row['request_number']] = $row;
		}

    $content = arrayToCsv($result);

	// Log this event
	Logging::logEvent($sql, "redcap_todo_list", "MANAGE", "", "", "Download the To-Do List");

    return $content;
  }

  // Check if a comment exists for this todo
	public static function assignCommentClass($id){
    $sql = "select comment from redcap_todo_list where request_id = '".prep($id)."' limit 1";
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q)) {
      $comment = $row['comment'];
    }

    if($comment != NULL){
      $class = 'comment-show';
    }else{
      $class = 'comment-hide';
    }

    return $class;
	}

  public static function renderList($list, $class){
	global $lang;
	$html = "";
	if (!empty($list)) {
	  $html .= '<div class="'.$class.'-container">';
	  foreach ($list as $raw) {
		$status = $raw['status'];
		$requestType = $raw['todo_type'];
		$full_name = $raw['full_name'];
    $comment = ($raw['comment'] != NULL ? $raw['comment'] : 'None');
    if (strlen($comment) > 60) {
      $comment_short = substr($comment, 0, 60).'...';
    }else{
      $comment_short = $comment;
    }
		if($requestType == 'new project' || $requestType == 'draft changes' || $requestType == 'copy project'){
		  $overlay = 0;
		}else{
		  $overlay = 1;
		}
		//logic to handle button behaviour
		switch ($status) {
		  case 'pending':
		  $showProcessBtn = 'show';
		  $showIgnoreBtn = 'show';
		  $showDeleteBtn = 'show';
		  $ignoreDataStatus = 'low-priority';
		  $ignoreTooltip = $lang['control_center_4542'];
		  $ignoreIcon = 'arrow_down.png';
		  $statusClass = 'hide';
		  $completionTimeText = $lang['control_center_4544'];
		  break;
		  case 'completed':
		  $showProcessBtn = 'hide';
		  $showIgnoreBtn = 'hide';
		  $showDeleteBtn = 'hide';
		  $ignoreDataStatus = 'complete';
		  $ignoreTooltip = '';
		  $ignoreIcon = 'arrow_down.png';
		  $statusClass = 'show';
		  $completionTimeText = DateTimeRC::format_ts_from_ymd($raw['request_completion_time']);
		  break;
		  case 'low-priority':
		  $showProcessBtn = 'show';
		  $showIgnoreBtn = 'show';
		  $showDeleteBtn = 'show';
		  $ignoreDataStatus = 'pending';
		  $ignoreTooltip = $lang['control_center_4543'];
		  $ignoreIcon = 'arrow_up2.png';
		  $statusClass = 'hide';
		  $completionTimeText = $lang['control_center_4544'];
		  break;
		  case 'archived':
		  $showProcessBtn = 'hide';
		  $showIgnoreBtn = 'hide';
		  $showDeleteBtn = 'hide';
		  $ignoreDataStatus = 'archived';
		  $ignoreTooltip = $lang['control_center_4542'];
		  $ignoreIcon = 'arrow_up2.png';
		  $statusClass = 'show';
		  $completionTimeText = $lang['control_center_4544'];
		  break;
		}
		//logic to handle row colors
		switch ($requestType) {
		  case 'delete project':
			  $color = 'rgba(255,60,60,.3)';
			  break;
		  case 'move to prod':
			  $color = 'rgba(100,100,255,.3)';
			  break;
		case 'draft changes':
			$color = 'rgba(100,255,255,.3)';
			break;
		case 'new project':
			$color = 'rgba(100,255,100,.3)';
			break;
		case 'copy project':
			$color = 'rgba(230,255,100,.3)';
			break;
		case 'token access':
			$color = 'rgba(205,100,200,.3)';
			break;
		  default:
			  $color = 'cadetblue';
		}
		$html .= '<div class="request-container" style="background-color:'.$color.'" data-id="'.$raw['request_from'].'" data-project-id="'.$raw['project_id'].'">
				<p class="todo-item req-num">'.$raw['request_id'].'</p>
				<p class="todo-item type">'.self::getStatusLabel($requestType).'</p>
				<p class="todo-item request-time">'.DateTimeRC::format_ts_from_ymd($raw['request_time']).'</p>
				<a href="mailto:'.$raw['user_email'].'" class="todo-item name username-mailto wrap" data-tooltip="'.cleanHtml2($lang['control_center_4553']).' '.$raw['username'].'">'.$raw['username'].' ('.$full_name.')</a>
				<p class="todo-item status '.$statusClass.'">'.$status.'</p>
        <div class="more-info-container">
        <a class="todo-more-info project-title" '.(isset($raw['app_title']) ? '' : 'style="visibility:hidden;"' ).' href="'.APP_PATH_WEBROOT.'index.php?pid='.$raw['project_id'].'" target="_blank">'.$lang['create_project_01'].' "<u style="color:#000066;">'.strip_tags($raw['app_title']).'</u>"</a>
        <p class="todo-more-info todo-comment" data-comment="'.htmlspecialchars($comment, ENT_QUOTES).'" data-id="'.$raw['request_id'].'">'.$lang['control_center_4559'].' "<i>'.$comment_short.'</i>"</p>
        <p class="todo-more-info">'.$lang['control_center_4554'].' '.$completionTimeText.'</p>'.
				(!isset($raw['processed_by']) ? '' :
					'<p class="todo-more-info">'.$lang['control_center_4556'].' '.$raw['processed_by'].'</p>'
				).
        '</div>
        <div class="buttons-wrapper '.$status.'" data-id="'.$raw['request_id'].'">
					<button type="button" class="process-request-btn action-btn '.$showProcessBtn.'" data-src="'.$raw['action_url'].'" data-overlay="'.$overlay.'" data-tooltip="process request" data-req-type="'.cleanHtml2(self::getStatusLabel($requestType)).'" data-req-by="'.$raw['username'].'" data-req-num="'.$raw['request_id'].'">'.RCView::img(array('src'=>'tick.png')).'</button>
					<button type="button" class="action-btn expand-btn" data-tooltip="get more information">'.RCView::img(array('src'=>'information_frame.png')).'</button>
          <button type="button" class="action-btn comment-btn" data-tooltip="add or edit a comment">'.RCView::img(array('src'=>'document_edit.png')).'</button>
					<button type="button" class="action-btn ignore-btn '.$showIgnoreBtn.'" data-status="'.$ignoreDataStatus.'" data-tooltip="'.$ignoreTooltip.'">'.RCView::img(array('src'=>$ignoreIcon)).'</button>
					<button type="button" class="action-btn delete-btn '.$showDeleteBtn.'" data-tooltip="archive request notification">'.RCView::img(array('src'=>'bin_closed.png')).'</button>
					<input class="checkbox" type="checkbox" value="'.$raw['request_id'].'">
				</div>
        <div class="'.self::assignCommentClass($raw['request_id']).'">'.RCView::img(array('src'=>'balloon_left.png', 'data-id'=>$raw['request_id'], 'data-tooltip'=>'comment available', 'class'=>'balloon-icon')).'</div>
			  </div>';
	  }
	  $html .= '</div>';//end of container
	} else {
		// None to display
		$html .= '<div class="request-container" style="background-color:#eee;color:#888;"><div style="padding:7px 5px 3px;">'.$lang['control_center_4545'].'</div></div>';
	}
	return $html;
  }

}
