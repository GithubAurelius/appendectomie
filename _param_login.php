<?php
session_start();
// ini_set('session.cookie_httponly', 1);
// ini_set('ssession.cookie_secure', 1);
// ini_set('session.use_only_cookies', 1);
// ini_set('session.gc_probability', 1);
// ini_set('session.gc_divisor', 100);
// session_regenerate_id();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$_SESSION = [];
$_SESSION['debug'] = 1;
$_SESSION = parse_ini_file("/mainData/mdueffelmeyer/MIQ_projects/appendectomie/appendectomie.ini"); // CONFIG
require_once $_SESSION['INI-PATH'];
require_once MIQ_ROOT . "modules/patches/update_db.php";
require_once MIQ_ROOT_PHP . "login_base.php";