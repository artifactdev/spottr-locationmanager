<?php

/**
 * This class represents a model class, in which all confiruations of an email to send are stored.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class EmailAddress
{

    /**
     * The email address.
     *
     * @var string
     */
    public $emailAddress = "";

    /**
     * The email address alias. The pseudonym diplayed name.
     *
     * @var string
     */
    public $emailAlias = "";

    /**
     * Default constructor, which can optionally set the values.
     * @param string $address Email address.
     * @param string $alias Email address alias.
     */
    public function __construct($address = "", $alias = "") {
        $this->emailAddress = $address;
        $this->emailAlias = $alias;
    }
}