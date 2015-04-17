<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The ArrayUtils class provides some static methods, whichs makes the handling of the array usage much easier.
 * With the existing methods you can get array fields much easier.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class ArrayUtils
{

    /**
     * This static method returns the value of the given key in the given array.
     * If no item of the given key exists in the array, the default value will be returned.
     *
     * @param array $array
     *            Array to get the value from.
     * @param string|int $key
     *            Fieldname or index which should be found in the array.
     * @param string $default
     *            Value which will be returned, if the array does not contain the key.
     *
     * @return string|Ambigous <string, mixed> Value of the array, or default-value.
     */
    public static function getField($array, $key, $default = "", $ignoreCase = false)
    {
        if (! isset($array) || !is_array($array) || ! isset($key) || (! array_key_exists($key, $array) && ! $ignoreCase)) {
            return $default;
        }

        if (!$ignoreCase) {
            return ! isset($array[$key]) ? $default : $array[$key];
        }

        foreach ($array as $arrKey => $arrValue) {
            if (StringUtils::equalsIgnoreCase($key, $arrKey)) {
                return $arrValue;
            }
        }
        return $default;
    }

    /**
     * This static method creates an empty array field.
     *
     * @return array Empty array.
     */
    public static function emptyArray()
    {
        return array();
    }
}
