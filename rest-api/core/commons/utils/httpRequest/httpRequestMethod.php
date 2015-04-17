<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * Enumeration class which provides all kinds of HTTP Request methods.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class HttpRequestMethod
{

    /**
     * HTTP request method POST.
     *
     * @var string
     */
    const POST = "post";

    /**
     * HTTP request method GET.
     *
     * @var string
     */
    const GET = "get";

    /**
     * HTTP request method PUT.
     *
     * @var string
     */
    const PUT = "put";

    /**
     * HTTP request method DELETE.
     *
     * @var string
     */
    const DELETE = "delete";

    /**
     * HTTP request method TRACE.
     *
     * @var string
     */
    const TRACE = "trace";

    /**
     * HTTP request method OPTIONS.
     *
     * @var string
     */
    const OPTIONS = "options";

    /**
     * Return the HTTPRequestMethod name, if the given value exists.
     * If not exists an empty string will be returned.
     *
     * @param string $value
     *            Value to find.
     * @return string.
     */
    public static function getName($value)
    {
        $className = get_called_class();
        $class = new ReflectionClass($className);
        $items = $class->getConstants();

        foreach ($items as $item) {
            if (StringUtils::equalsIgnoreCase($item, $value)) {
                return $item;
            }
        }
        return "";
    }
}