<?php
/**
 * This model represents a list view.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class Collection extends AbstractModel
{

    /**
     * List with the items
     *
     * @var array
     */
    public $items = array();

    /**
     * Number of all items.
     *
     * @var int
     */
    public $numberOfItems = 0;

}