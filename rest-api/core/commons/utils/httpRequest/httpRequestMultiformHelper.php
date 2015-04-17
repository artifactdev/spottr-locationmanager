<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The HTTPRequestHelper class provides every kind of methods that you need to get request parameters.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class HTTPRequestMultiformHelper
{

    /**
     * Returns the request parameter value of the given parameter name.
     *
     * @param string $parameterName
     *            Name of the requestparameter.
     * @param string $default
     *            Defaultvalue if the value parameter is not found.
     * @param string $parameterPrefix
     *            Name of the parameter prefix in a multiform request. e.q. <subParam>_name.
     * @return string
     */
    public static function getRequestParam($parameterName, $default = "", $parameterPrefix = "")
    {
        $parameterPrefix = StringUtils::isBlank($parameterPrefix) ? "" : $parameterPrefix . "_";
        $parameterName = $parameterPrefix . $parameterName;

        $value = HTTPRequestMultiformHelper::getPOSTParam($parameterName);

        if ($value != null) {
            return $value;
        }

        $value = HTTPRequestMultiformHelper::getPUTParam($parameterName);
        if ($value != null) {
            return $value;
        }

        $value = HTTPRequestMultiformHelper::getGETParam($parameterName);
        if ($value != null) {
            return $value;
        }

        return $default;
    }

    /**
     * Data of a PUT reqeust.
     */
    private static $_PUT;

    /**
     * Returns the POST value of the given parameter.
     *
     * @param String $parameterName
     *            Name of the parameter.
     * @return Value of the parameter or null, if no parameter was found.
     */
    private static function getPOSTParam($parameterName)
    {
        if (isset($_POST) && isset($_POST[$parameterName])) {
            return $_POST[$parameterName];
        }
        return null;
    }

    /**
     * Returns the PUT value of the given parameter.
     *
     * @param string $parameterName
     *            Name of the parameter.
     * @return string Value of the parameter or null, if no parameter was found.
     */
    private static function getPUTParam($parameterName)
    {
        if (! isset(HTTPRequestMultiformHelper::$_PUT)) {
            parse_str(file_get_contents("php://input"), HTTPRequestMultiformHelper::$_PUT);
        }
        if (isset(HTTPRequestMultiformHelper::$_PUT) && isset(HTTPRequestMultiformHelper::$_PUT[$parameterName])) {
            return HTTPRequestMultiformHelper::$_PUT[$parameterName];
        }
        return null;
    }

    /**
     * Returns the GET value of the given parameter.
     *
     * @param string $parameterName
     *            Name of the parameter.
     * @return string Value of the parameter or null, if no parameter was found.
     */
    private static function getGETParam($parameterName)
    {
        if (isset($_GET) && isset($_GET[$parameterName])) {
            return $_GET[$parameterName];
        }
        return null;
    }
}

