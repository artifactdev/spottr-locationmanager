<?php
/**
 * This php file contains all system basic configuration values.
 *
 * @package MJ-REST api core
 * @subpackage config
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
putenv('LANG=de_DE.UTF-8');

/**
 * ***********************************************************
 * Filesystem path configuration.
 */
define("CONF_FS_ROOT", dirname(__FILE__) . "/../../");
define("CONF_FS_CORE", CONF_FS_ROOT . "core/");
define("CONF_FS_APP", CONF_FS_ROOT . "app/");
define("CONF_FS_LANG", CONF_FS_ROOT . "lang/");
define("CONF_FS_LIBS", CONF_FS_ROOT . "libs/");
define("CONF_FS_TMP", CONF_FS_ROOT . "tmp/");

define("CONF_FS_CORE_SYSTEM", CONF_FS_CORE . "system/");
define("CONF_FS_CORE_COMMONS", CONF_FS_CORE . "commons/");
define("CONF_FS_CORE_CONFIGURATION", CONF_FS_CORE . "config/");
define("CONF_FS_CORE_EXCEPTIONS", CONF_FS_CORE_SYSTEM . "exceptions/");
define("CONF_FS_CORE_LIBS", CONF_FS_CORE . "libs/");
define("CONF_FS_CORE_MODELS", CONF_FS_CORE_SYSTEM . "models/");
define("CONF_FS_CORE_SERVICE", CONF_FS_CORE_SYSTEM . "service/");

define("CONF_FS_APP_COMMONS", CONF_FS_APP . "commons/");
define("CONF_FS_APP_CONFIGURATION", CONF_FS_APP . "config/");
define("CONF_FS_APP_CONTROLLERS", CONF_FS_APP . "controllers/");
define("CONF_FS_APP_LIBS", CONF_FS_APP . "libs/");
define("CONF_FS_APP_MODELS", CONF_FS_APP . "models/");
define("CONF_FS_APP_SERVICE", CONF_FS_APP . "service/");

/**
 * ***********************************************************
 * Configuration values.
 */
define("CONF_AUTHENTICATION_INFO_SALT", "einEimerSalz");

/**
 * ***********************************************************
 * Request Parameter.
 */
define("REQ_PARAM_AUTH_INFO", "X-MJRestApi-AuthInfo");

