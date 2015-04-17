<?php

/**
 * The StringUtils class provides some very important functions to make the work with string much easier.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 * @deprecated Use Wolter String Utils instead!
 */
class StringUtilsMJ
{

    /**
     * Checks whether the given string starts the the needle.
     *
     * @param string $haystack
     *            String to check whether it starts with the needle.
     * @param string $needle
     *            String that is the startswith definition.
     * @return boolean
     */
    public static function startsWith($haystack, $needle)
    {
        if (! is_string($haystack) || ! is_string($needle)) {
            false;
        }
        return ! strncmp($haystack, $needle, strlen($needle));
    }

    /**
     * Checks whether the given string ends the the needle.
     *
     * @param string $haystack
     *            String to check whether it ends with the needle.
     * @param string $needle
     *            String that is the endswith definition.
     * @return boolean
     */
    public static function endsWith($haystack, $needle)
    {
        if (! is_string($haystack) || ! is_string($needle)) {
            false;
        }

        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, - $length) === $needle);
    }

    /**
     * Checks if the given string is empty.
     * For example: <br>
     * "" = true<br>
     * " " = false
     *
     * @param string $string
     *            String to check.
     * @return boolean
     */
    public static function isEmpty($string)
    {
        if (! is_string($string)) {
            return false;
        }
        return empty($string);
    }

    /**
     * Checks if the given string is empty.
     * For example: <br>
     * "" = true<br>
     * " " = true<br>
     * " asasd" = true<br>
     * " asdasdasd " = true
     *
     * @param string $string
     *            String to check.
     * @return boolean
     */
    public static function isBlank($string)
    {
        if (! is_string($string)) {
            return false;
        }
        $string = trim($string);
        return empty($string);
    }

    /**
     * Returns a converted string that can be used for sql statements.
     * All devil signs are removed or escaped.
     *
     * @param string $string
     *            String to prepare for a sql statement.
     * @return string An escaped string to add in the database.
     */
    public static function prepareForDatabase($string)
    {
        if (is_bool($string)) {
            return $string ? 1 : 0;
        }
        if (is_object($string)) {
            return "";
        }
        $result = str_replace("\"", "'", $string);
        $result = str_replace("'", "&quot;", $result);
        return $result;
    }

    /**
     * Checks whether the given string, has a length in the range from min an max.
     *
     * @param string $string
     *            String for the length check.
     * @param int $min
     *            Number of the minimum length of the string.
     * @param int $max
     *            Number of the maximum length of the string.
     * @return boolean
     */
    public static function hasLengthOf($string, $min = 0, $max = 255)
    {
        $length = strlen($string);
        return ($length >= $min && $length <= $max);
    }

    /**
     * Encrypts the given string via md5.
     *
     * @param string $string
     *            String to encrypt.
     * @return string md5 hashed string.
     */
    public static function encrypt($string)
    {
        return md5($string);
    }

    /**
     * Checks whether the given source string, contains the contained string.
     *
     * @param string $sourceString
     *            String in which the contained string will be searched.
     * @param string $containedString
     *            String which should be checked, whether it is contained in the source.
     * @return boolean
     */
    public static function contains($sourceString, $containedString)
    {
        if (strpos($sourceString, $containedString) === false) {
            return false;
        }
        return true;
    }

    /**
     * Equals the both given strings, whether they are equal or not.
     *
     * @param string $string1
     *            String one.
     * @param string $string2
     *            String two.
     * @return boolean
     */
    public static function equal($string1, $string2)
    {
        if (! isset($string1) || ! isset($string2)) {
            return false;
        }
        return $string1 == $string2;
    }

    /**
     * Equals the both given strings, whether they are equal or not. The strings will be equaled without case check.
     *
     * @param string $string1
     *            String one.
     * @param string $string2
     *            String two.
     * @return boolean
     */
    public static function equalsIgnoreCase($string1, $string2)
    {
        if (! isset($string1) || ! isset($string2)) {
            return false;
        }
        $string1 = strtolower($string1);
        $string2 = strtolower($string2);
        return $string1 == $string2;
    }

    /**
     * Converts a camel case string to an underscored string.
     *
     * @param string $string
     *            String to convert.
     * @return string
     */
    public static function convertCamelCaseToUnderScore($string)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}