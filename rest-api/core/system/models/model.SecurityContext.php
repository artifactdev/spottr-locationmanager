<?php

/**
 * This class represents a model class, in which the SecurityContext is stored.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class SecurityContext
{

    /**
     * Flag if the user is logged in.
     *
     * @var boolean
     */
    public $isLoggedIn = false;

    /**
     * Authentication informations.
     *
     * @var AuthenticationInfo
     */
    public $authenticationInfo = null;
}