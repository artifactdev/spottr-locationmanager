<?php

/**
 * This model interface describes the needed methods for models, which works with the @see DatabaseUtils.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
interface DatabaseModel
{

    /**
     * This method wraps the result a database row result to the model.
     *
     * @param array $dbRow
     *            Single Dataset row from the database.
     */
    public function wrapDBResult($dbRow);

    /**
     * This method wraps the object content to an array for an sql query.
     *
     * @return array that is made up of a uppercased fieldnames as placeholders for the sql query in the key and as
     *         value the fieldvalue.
     */
    public function wrapModelToDatabase();
}