<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * This is the exception implementation of a route mapping error.
 *
 * @package       MJ-REST api core
 * @subpackage    system
 * @version       0.9.0
 * @author        Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class RestRouteException extends AbstractException
{
    /**
     * Specific constructor.
     *
     * @param RestRouteErrorType $errorType     Type of the happened error.
     * @param string             $message       Error Message.
     * @param string             $url           Called url.
     * @param string             $requestMethod Called request method.
     */
    public function __construct($errorType, $message = LANG_ERROR_REST_ROUTE_DEFAULT, $url = "", $requestMethod = "")
    {
        $this->logException($message, $url, $requestMethod);
        parent::__construct($errorType, $message);
    }

    /**
     * Logs the Exception in the system log, to get more information about the error.
     *
     * @param string $message       Error Message.
     * @param string $url           Called url.
     * @param string $requestMethod Called request method.
     */
    private function logException($message, $url, $requestMethod)
    {
        $logger = Logger::getLogger("system");
        $logger->error($message);
        if (StringUtils::isNotBlank($url)) {
            $logger->error("Url:" . $url);
        }
        if (StringUtils::isNotBlank($requestMethod)) {
            $logger->error("Reqeust Mehtod:" . $requestMethod);
        }
    }
}

/**
 * Enumeration which contains all error type of a routing error.
 *
 * @package       MJ-REST api core
 * @subpackage    system
 * @version       0.9.0
 * @author        Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class RestRouteErrorType
{

    /**
     * Default, unspecific error.
     *
     * @var int
     */
    const THROW_DEFAULT = 1099;

    /**
     * Empty value.
     *
     * @var int
     */
    const THROW_EMPTY_VALUE = 1001;

    /**
     * The url does not exist.
     *
     * @var int
     */
    const THROW_URL_EXISTS = 1002;

    /**
     * There exists no mapping for the given url.
     *
     * @var int
     */
    const THROW_NO_ROUTE_AVAILABLE = 1003;
}