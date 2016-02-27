<?php

error_reporting(E_ALL ^ E_NOTICE);
//set prefix for sessions
define('SESSION_PREFIX','brp_');

/*=========== Database Configuraiton ==========*/

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'mvc';


/*=========== Website Configuration ==========*/

$defaultTitle = 'MVC - Content management system';
$defaultFooter = date('Y').' &copy; localhost';

?>