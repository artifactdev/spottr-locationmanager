<?php
/**
 * The Restfacade Entry Point
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

ini_set('display_errors', '1');
ini_set('error_reporting', E_ERROR);

ini_set('max_execution_time','600000');
ini_set('memory_limit','2048M');
setlocale(LC_TIME, 'de_DE.utf8');

if (! ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}

// Import system configuration
require_once dirname(__FILE__) . '/app/config/configure.php';
require_once dirname(__FILE__) . '/core/config/configure.php';

require_once CONF_FS_CORE_SYSTEM . "class.RestFacade.php";

$facade = new RestFacade();
$facade->run();