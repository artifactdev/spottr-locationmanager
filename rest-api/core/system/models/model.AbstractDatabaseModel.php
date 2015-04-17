<?php

/**
 * This model implements the database interface of a model abstractly.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
abstract class AbstractDatabaseModel implements DatabaseModel
{
    /**
     * {@inheritdoc}
     */
    public function wrapModelToDatabase()
    {
        $result = array();

        $classVariables = get_class_vars(get_class($this));
        foreach ($classVariables as $key => $value) {
            $result[strtoupper($key)] = $this->$key;
        }
        return $result;
    }
}