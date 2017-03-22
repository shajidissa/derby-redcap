<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


/**
 * Messaging Class
 */
class Messaging
{

  public static function getConversationMembersSql($thread_id){
    $sql = "select u.username, u.ui_id
    from redcap_messages m
    left join redcap_user_information u
    on u.ui_id = m.author_user_id
    where m.thread_id = '".prep($thread_id)."'
    group by m.author_user_id";
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q))
    {
      $conversation_member[$row['username']] = $row;
    }

    $members = '';
    foreach ($conversation_member as $member) {
      $members .= 'u.username != "'.$member['username'].'" and ';
    }

    return $members = substr($members,0,-4);
  }

  public static function getProjectMembersSql($pid){
    $sql = "select u.username, u.ui_id, u.user_firstname from redcap_user_information u
    left join redcap_user_rights r on u.username = r.username
    where (u.username = r.username and project_id = '".prep($pid)."')
    group by u.username
    order by u.username ASC";
    $q = db_query($sql);

    while ($row = db_fetch_assoc($q))
    {
      $project_member[$row['username']] = $row;
    }

    $members = '';
    foreach ($project_member as $member) {
      $members .= 'u.username != "'.$member['username'].'" and ';
    }

    return $members = substr($members,0,-4);
  }

  public static function renderHeaderIcon($page){
  	global $lang;
  	// $html = "";

  	$html = "<div class='notifications-icon-container'>
      ".RCView::img(array('src'=>'notifications_balloons.png','class'=>'header-notifications-icon'))."
      <span class='badge new-message-total-badge'>!</span>
    </div>";
    // <span class='new-alert $page'>!</span> //was at line 19

    return $html;
  }

  public static function renderMessageCenter(){
  	global $lang;

  	$html = "<div class='message-center-container lollo' data_open='0'>
      ".RCView::img(array('src'=>'gear-white.png','class'=>'messaging-settings-button'))."
      <div class='message-center-header'>REDCap Message Center</div>
      <div class='message-center-notifications-container mc-section-container'></div>
      <div class='message-center-channels-container mc-section-container'></div>
      <div class='message-center-messages-container'>
        <div class='action-icons-wrapper'></div>
        <p class='channel-members-count'>Members: </p>
        <div class='channel-members-username'></div>
        <div class='msgs-wrapper' data-thread_id=''></div>
      </div>
    </div>";

    return $html;

  }

}
