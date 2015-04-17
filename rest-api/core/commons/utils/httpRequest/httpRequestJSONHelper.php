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
class HTTPRequestJSONHelper
{

    /**
     * Request Payload decoded.
     *
     * @var stdClass
     */
    private static $jsonPayload = null;

    /**
     * Returns the request parameter value of the given parameter name.
     *
     * @param string $parameterName
     *            Name of the requestparameter.
     * @param string $default
     *            Defaultvalue if the value parameter is not found.
     * @param string $parameterPrefix
     *            Name of the object, which contains the modeldata.
     * @return string
     */
    public static function getRequestParam($parameterName, $default = "", $parameterPrefix = "")
    {
        if (HTTPRequestJSONHelper::$jsonPayload === null) {

            $jsonString = file_get_contents('php://input');
            if (StringUtils::isBlank($jsonString)) {
                return $default;
            }
            HTTPRequestJSONHelper::$jsonPayload = json_decode($jsonString);
            if (HTTPRequestJSONHelper::$jsonPayload === null) {
                throw new InvalidArgException("payload", "Der übergebene Payload ist falsch formatiert. Erwartet ist ein JSON-Format.");
            }
        }

        $vars = get_object_vars(HTTPRequestJSONHelper::$jsonPayload);
        if (! StringUtils::isBlank($parameterPrefix)) {
            $subObject = ArrayUtils::getField($vars, $parameterPrefix, null, true);
            $vars = get_object_vars($subObject);
        }

        return ArrayUtils::getField($vars, $parameterName, $default, true);
    }
}