<?php

/**
 * This is a model class, which contains all settings for the routing.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class RestRouteItem
{

    /**
     * Url.
     *
     * @var string
     */
    public $url;

    /**
     * Request method.
     * See also @link HttpRequestMethod.
     *
     * @var string
     */
    public $requestMethod;

    /**
     * The fully class name of the controller class to which shall be mapped.
     *
     * @var string
     */
    public $className;

    /**
     * The fully name of the method, which shall be called.
     *
     * @var string
     */
    public $methodName;

    /**
     * Says, if the url need an authentication check.
     *
     * @var boolean
     */
    public $needAuthentication;
}
