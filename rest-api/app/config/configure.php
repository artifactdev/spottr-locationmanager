<?php
/**
 * This php file contains all application configuration values.
 *
 * @subpackage config
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2015
 */

/**
 * ***********************************************************
 * Database configuration.
 */
define("CONF_DATABASE_SERVER", "localhost:8889");
define("CONF_DATABASE_USERNAME", "root");
define("CONF_DATABASE_PASSWORD", "root");
define("CONF_DATABASE_SCHEMA", "spottr");

define("CONF_FS_MEDIA_LOCATIONS", CONF_FS_ROOT . "media/locations/");
define("CONF_FS_MEDIA_LOCATIONS_ORG", CONF_FS_MEDIA_LOCATIONS . "org/");
define("CONF_FS_MEDIA_LOCATIONS_THUMB", CONF_FS_MEDIA_LOCATIONS . "thumb/");

/**
 * ***********************************************************
 * Application configuration values.
 */
define("REGEXP_APPLICATION_USER_PASSWORD_RULES", "/^(.){8,200}$/");
define("REGEXP_APPLICATION_USER_EMAIL", '/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i');
