<?php
// Prevent view from being called directly
require_once dirname(dirname(__FILE__)) . '/Config/init_functions.php';
System::init();
// Set tab active status
$activeClass = ' class="active"';
$tabHomeActive = (!isset($_GET['action']) && !isset($_GET['route']) && strpos(PAGE_FULL, '/index.php') !== false && strpos(PAGE_FULL, 'ControlCenter/') === false && strpos(PAGE_FULL, 'ToDoList/') === false) ? $activeClass : "";
$tabMyProjectsActive = (isset($_GET['action']) && $_GET['action'] == 'myprojects') ? $activeClass : "";
$tabNewProjectActive = (isset($_GET['action']) && $_GET['action'] == 'create') ? $activeClass : "";
$tabTrainingActive = (isset($_GET['action']) && $_GET['action'] == 'training') ? $activeClass : "";
if (SUPER_USER || ACCOUNT_MANAGER) {
	$tabTrainingActive = ($tabTrainingActive == $activeClass) ? ' class="active hidden-sm"' : ' class="hidden-sm"';
}
$tabHelpActive = (isset($_GET['action']) && $_GET['action'] == 'help') ? $activeClass : "";
$tabSendItActive = (PAGE == 'SendItController:upload') ? $activeClass : "";
$tabControlCenterActive = (strpos(PAGE, 'ControlCenter/') !== false || strpos(PAGE, 'ToDoList/') !== false) ? $activeClass : "";
$controlCenterDefaultPage = ACCOUNT_MANAGER ? "ControlCenter/view_users.php" : "ControlCenter/index.php";
$tabUserProfileActive = (PAGE == 'Profile/user_profile.php') ? " active" : "";

// IE8 workaround for Bootstrap topnav bar
if ($isIE && vIE() < 9) {
?>
<style type="text/css">
#redcap-home-navbar-collapse { display:inline-block;border-top:0; }
#redcap-home-navbar-collapse ul, #redcap-home-navbar-collapse li { display:inline-block; }
#redcap-home-navbar-collapse ul.navbar-right { margin-left:20px; }
.navbar-header { display:inline-block;margin-right:0 !important; }
.hideIE8 { display: none; }
#pagecontent { margin-top: 100px; }
</style>
<?php } ?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="hideIE8 navbar-toggle collapsed" data-toggle="collapse" data-target="#redcap-home-navbar-collapse" aria-expanded="false">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="padding:8px 15px 0 10px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>"><img alt="REDCap" style="width:120px;height:36px;" src="<?php echo APP_PATH_IMAGES ?>redcap-logo-medium.png"></a>
    </div>

    <div class="collapse navbar-collapse" id="redcap-home-navbar-collapse">
      <ul class="nav navbar-nav">
        <li<?php print $tabHomeActive ?>><a style="color:#333;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php"><?php print $lang['home_21'] ?></a></li>
        <li<?php print $tabMyProjectsActive ?>><a style="color:#000;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php?action=myprojects"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php print $lang['home_22'] ?></a></li>
        <?php if (isset($GLOBALS['allow_create_db']) && $GLOBALS['allow_create_db']) { ?><li<?php print $tabNewProjectActive ?>><a style="color:#008000;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php?action=create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php print $lang['home_61'] ?></a></li><?php } ?>
        <li<?php print $tabHelpActive ?>><a style="color:#3E72A8;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php?action=help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php print $lang['bottom_27'] ?></a></li>
		<li<?php print $tabTrainingActive ?>><a style="color:#725627;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php?action=training"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> <?php print $lang['home_62'] ?></a></li>
        <?php if ($GLOBALS['sendit_enabled'] == '1' || $GLOBALS['sendit_enabled'] == '2') { ?> <li<?php print $tabSendItActive ?> class="hidden-sm"><a style="color:#660303;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT ?>index.php?route=SendItController:upload"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php print $lang['home_26'] ?></a></li><?php } ?>
        <?php if (SUPER_USER || ACCOUNT_MANAGER) { ?><li<?php print $tabControlCenterActive ?>><a style="color:#000;padding:15px 8px;" href="<?php print APP_PATH_WEBROOT . $controlCenterDefaultPage ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php print $lang['global_07'] ?></a></li><?php } ?>
      </ul>
	  
	  <ul class="nav navbar-nav navbar-right">
        <li class="hidden-xs nohighlighthover<?php if (SUPER_USER || ACCOUNT_MANAGER) print " loggedInUsername"; ?>"><a href="#" style='cursor:default;color:#000;padding:10px 10px;font-size:11px;line-height:14px;'><?php print (defined('USERID') ? $lang['bottom_01'].RCView::br().RCView::b(USERID) : ''); ?></a></li>
        <li class="hidden-sm<?php print $tabUserProfileActive ?>"><a style='color:#3c5ca3;padding:15px 8px;' href="<?php echo APP_PATH_WEBROOT ?>Profile/user_profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $lang['config_functions_50'] ?></a></li>
        <li class="hidden-sm"><a style="color:#555;padding:15px 8px;" href="<?php echo PAGE_FULL . (($_SERVER['QUERY_STRING'] == "") ? "?" : "?" . $_SERVER['QUERY_STRING'] . "&") ?>logout=1"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> <?php echo $lang['bottom_02'] ?><span class="hideIE8 hidden-sm hidden-md hidden-lg" style="margin-left:20px;"><?php print (defined('USERID') ? "(".$lang['bottom_01'].RCView::SP.RCView::b(USERID).")" : ''); ?></span></a></li>
		<li class="hideIE8 dropdown hidden-xs hidden-md hidden-lg">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $lang['global_134'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<?php if (SUPER_USER || ACCOUNT_MANAGER) { ?><li><a style="color:#725627;padding:5px 20px;" href="<?php print APP_PATH_WEBROOT_PARENT ?>index.php?action=training"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> <?php print $lang['home_62'] ?></a></li><?php } ?>
			<?php if ($GLOBALS['sendit_enabled'] == '1' || $GLOBALS['sendit_enabled'] == '2') { ?> <li<?php print $tabSendItActive ?>><a style="color:#660303;padding:5px 20px;" href="<?php print APP_PATH_WEBROOT ?>index.php?route=SendItController:upload"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <?php print $lang['home_26'] ?></a></li><?php } ?>
			<li><a style='color:#3c5ca3;padding:5px 20px;' href="<?php echo APP_PATH_WEBROOT ?>Profile/user_profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $lang['config_functions_50'] ?></a></li>
			<li role="separator" class="divider"></li>
            <li><a style="color:#555;padding:0px 20px 5px;" href="<?php echo PAGE_FULL . (($_SERVER['QUERY_STRING'] == "") ? "?" : "?" . $_SERVER['QUERY_STRING'] . "&") ?>logout=1"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> <?php echo $lang['bottom_02'] ?><span class="hidden-sm hidden-md hidden-lg" style="margin-left:20px;"><?php print (defined('USERID') ? "(".$lang['bottom_01'].RCView::SP.RCView::b(USERID).")" : ''); ?></span></a></li>
          </ul>
        </li>
	  </ul>
    </div>
    
  </div>
</nav>