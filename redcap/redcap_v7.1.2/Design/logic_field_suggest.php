<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/
require_once "../../redcap_connect.php";

print logicSearchResults($_POST['location'], $_POST['word'], $_POST['draft_mode']);
