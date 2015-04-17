<?php

/**
 * The Enumeration class is the root class which describes an enumeration and provides some basically methods of an
 * enumeration.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
abstract class Enumeration
{

    /**
     * Checks if the given Name exists in the enumeration.
     *
     * @param string $name
     *            Name to check.
     * @return boolean
     */
    public static function existsName($name)
    {
        $className = get_called_class();
        $class = new ReflectionClass($className);
        $items = $class->getConstants();

        foreach ($items as $item) {
            if ($item == $name) {
                return true;
            }
        }
        return false;
    }
}