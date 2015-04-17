<?php
/**
 * This file includes all message-codes, and there transfered message in the german language.
 *
 * @package MJ-REST api core
 * @subpackage lang
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
define('LANG_ERROR_AUTHENTICATION_DEFAULT', 'Sie haben keinen Zugriff auf die ausgeführte Aktion.');
define('LANG_ERROR_AUTHENTICATION_ACCESS_DENIED', 'Sie haben keinen Zugriff auf die ausgeführte Aktion.');
define('LANG_ERROR_AUTHENTICATION_USERNAME_OR_PASSWORD_WRONG', 'Der Nutzername oder das Passwort ist falsch.');

define('LANG_ERROR_REST_ROUTE_URL_MUST_BE_SET', "URL for RestRouteService must be set!");
define('LANG_ERROR_REST_ROUTE_CLASSNAME_MUST_BE_SET', "Class name for RestRouteService must be set!");
define('LANG_ERROR_METHODNAME_MUST_BE_SET', "Methode name for RestRouteService must be set!");
define('LANG_ERROR_REST_ROUTE_URL_ALREADY_EXISTS', "The given URL exists already. : ");
define('LANG_ERROR_REST_ROUTE_DEFAULT', "Es ist ein Fehler beim im RoutingService aufgetreten.");
define('LANG_ERROR_REST_ROUTE_URL_NOT_FOUND', "No Route Found for: ");

define('LANG_CORE_SYSTEM_VALIDATION_GENERAL', "Die Eingabe ist nicht gültig.");
define('LANG_CORE_SYSTEM_INVALID_ARGUMENT_GENERAL', "Ungültiger Wert.");

define('LANG_APP_USER_ERROR_DEFAULT', 'Mit dem Nutzer stimmt was nicht.');
define('LANG_APP_USER_ERROR_USER_NOT_FOUND', 'Der angefragte Benutzer konnte nicht gefunden werden.');
define('LANG_APP_USER_ERROR_EMAIL_ADDRESS_ALREADY_EXISTS', 'Die angegebene Email-Adresse existiert bereits im System.');
define('LANG_APP_USER_ERROR_USERROLE_NOT_EXISTS', 'Die angegebene Benutzerrolle existiert nicht.');
define('LANG_APP_USER_ERROR_PERMISSION_DENIED', 'Die ausgeführte Aktion, ist für diesen Nutzer nicht freigeschalten.');
