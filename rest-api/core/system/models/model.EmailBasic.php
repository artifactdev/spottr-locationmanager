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
class EmailBasic
{

    /**
     * Emailaddress object of the sender.
     *
     * @var EmailAddress
     */
    public $sender;

    /**
     * List of recipients of this email.
     *
     * @var array of EmailAddress
     */
    public $recipients = array();

    /**
     * List of CC recipients of this email.
     *
     * @var array of EmailAddress
     */
    public $recipientsCC = array();

    /**
     * List of BCC recipients of this email.
     *
     * @var array of EmailAddress
     */
    public $recipientsBCC = array();

    /**
     * Subject of the email.
     *
     * @var string
     */
    public $subject = "";

    /**
     * HTML body.
     *
     * @var string
     */
    public $bodyHTML = "";

    /**
     * Alternative body of the email.
     *
     * @var string
     */
    public $bodyAlt = "";
}