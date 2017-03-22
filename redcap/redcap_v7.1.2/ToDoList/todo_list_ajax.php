<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/
require_once dirname(dirname(__FILE__)) . '/Config/init_global.php';

if (isset($_POST['action'])) 
{
	if (SUPER_USER) 
	{
	  if ($_POST['action'] == 'update-token' && isset($_POST['project_id'])) {
		//update todo status
		$project_id = (int)$_POST['project_id'];
		$sql = "update redcap_todo_list set status='completed', request_completion_time='".NOW."' where (project_id = '" . prep($project_id) ."' and todo_type='token access')";
		$q = db_query($sql);
		echo '1';
	  }elseif($_POST['action'] == 'delete-todo'){
		$id = $_POST['id'];
		$sql = "delete from  redcap_todo_list where request_id = '" . prep($id) ."' ";
		$q = db_query($sql);
		echo '1';
	  }elseif($_POST['action'] == 'ignore-todo'){
		$id = $_POST['id'];
		$status = $_POST['status'];
		$sql = "update redcap_todo_list set status='".prep($status)."' where request_id = '" . prep($id) ."' ";
		$q = db_query($sql);
		echo '1';
	  }elseif($_POST['action'] == 'archive-todo'){
		$id = $_POST['id'];
		$status = $_POST['status'];
		$sql = "update redcap_todo_list set status='".prep($status)."' where request_id = '" . prep($id) ."' ";
		$q = db_query($sql);
		echo '1';
		// Log this event
		Logging::logEvent($sql, "redcap_todo_list", "MANAGE", $id, "request_id = '" . prep($id) ."'", "Archive a request in the To-Do List");
	  }elseif($_POST['action'] == 'toggle-notifications'){
		$checked = ($_POST['checked'] == 'true' ? 1 : 0);
		// print $checked;
		$sql = "update redcap_config set value='".prep($checked)."' where field_name='send_emails_admin_tasks' ";
		$q = db_query($sql);
		echo '1';
		// Log this event
		$descrip = $checked ? "Enable email notifications for administrators" : "Disable email notifications for administrators";
		Logging::logEvent($sql, "redcap_config", "MANAGE", 'send_emails_admin_tasks', "field_name='send_emails_admin_tasks'", $descrip);
		}elseif($_POST['action'] == 'write-comment'){
		$id = $_POST['id'];
		$comment = $_POST['comment'];
		$sql = "update redcap_todo_list set comment='".prep($comment)."' where request_id = '".prep($id)."' ";
		$q = db_query($sql);
		echo '1';
	  }
	}
	
	// Not required to be a super user
	elseif ($_POST['action'] == 'delete-request'){
		$pid = $_POST['pid'];
		$ui_id = $_POST['ui_id'];
		$req_type = $_POST['req_type'];
		$sql = "delete from redcap_todo_list where project_id = '".prep($pid)."' and todo_type = '".prep($req_type)."' and request_from = '".prep($ui_id)."' ";
		$q = db_query($sql);
		echo '1';
	}

}
