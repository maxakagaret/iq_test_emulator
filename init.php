<?php
/*====================================================*\
|| ################################################## ||
|| # IQ TEST EMULATOR                               # ||
|| # Initialization                                 # ||
|| # ---------------------------------------------- # ||
|| ################################################## ||
\*====================================================*/
// error_reporting(E_ALL^E_NOTICE);
if (!file_exists('include/config.php')) die('[init.php] config.php not exist');
require_once 'include/config.php';
session_start();

define('FULL_SITE_DOMAIN', 'localhost');
define('APP_PATH', dirname(__file__) . DIRECTORY_SEPARATOR);

if (isset($_SERVER['SCRIPT_NAME'])) {
    $app_main_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    define('_APP_MAIN_DIR', $app_main_dir);
} 
else {
    die('[init.php] Cannot determine APP_MAIN_DIR, please set manual and comment this line');
}

define('BASE_URL', 'http://' . FULL_SITE_DOMAIN . _APP_MAIN_DIR . '/');

if (!file_exists('helpers/class.db.php')) die('[init.php] db class not exist');
require_once 'helpers/class.db.php';

if (!file_exists('helpers/class.helper.php')) die('[init.php] helper class not exist');
require_once 'helpers/class.helper.php';

$MaxDB=new SecureMySQLI(IQDB_HOST,IQDB_DBTYPE,IQDB_NAME,IQDB_USER,IQDB_PASS);

?>