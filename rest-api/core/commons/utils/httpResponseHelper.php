<?php

/**
 * The HTTPResponseHelper class provides several methods to work with the response.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class HTTPResponseHelper
{

    /**
     * Sets the given HTTP Status code to the header in the response.
     *
     * @param int $statusCode
     *            HTTP Status code.
     */
    public static function setHttpStatusCode($statusCode)
    {
        if (function_exists("http_response_code")) {
            http_response_code($statusCode);
            return;
        }

        header("HTTP/1.1 $statusCode", TRUE, $statusCode);
    }

    /**
     * Sets the given header to the response.
     *
     * @param string $name
     *            Name of the header parameter.
     * @param string $value
     *            Value of the header parameter.
     */
    public static function setHeader($name, $value)
    {
        header($name . ": " . $value);
    }

    /**
 * Sets the content-type of the response.
 *
 * @param string $value
 *            Content-Type
 */
    public static function setContentType($value)
    {
        self::setHeader("Content-Type", $value . " charset=utf-8");
    }
}

