<?php

/*
	This is the main include file.
	It is only used in index.php and keeps it much cleaner.
*/

require_once __SITE_PATH . "/config/config.php";
require_once __SITE_PATH . "/config/connect.php";
require_once __SITE_PATH . "/config/helpers.php";
require_once __SITE_PATH . "/config/db_helpers.php";
require_once __SITE_PATH . "/config/sessions.php";
include __SITE_PATH . "/app/controllers/base.controller.php";

Session::init();
// This will allow the browser to cache the pages of the store.
/*
header('Cache-Control: max-age=3600, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+3600)." GMT");
*/
?>