<?php

/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class UserException extends AbstractException
{

    /**
     * Default constructor.
     *
     * @param UserErrorType $type
     *            Type of the occured error.
     */
    public function __construct($type)
    {
        $message = LANG_APP_USER_ERROR_DEFAULT;
        if ($type == UserErrorType::THROW_EMAIL_ADDRESS_ALREADY_EXISTS) {
            $message = LANG_APP_USER_ERROR_EMAIL_ADDRESS_ALREADY_EXISTS;
        } elseif ($type == UserErrorType::THROW_PERMISSION_DENIED) {
            $message = LANG_APP_USER_ERROR_PERMISSION_DENIED;
        } elseif ($type == UserErrorType::THROW_USER_NOT_FOUND) {
            $message = LANG_APP_USER_ERROR_USER_NOT_FOUND;
        } elseif ($type == UserErrorType::THROW_USERROLE_NOT_EXISTS) {
            $message = LANG_APP_USER_ERROR_USERROLE_NOT_EXISTS;
        }

        parent::__construct($type, $message);
    }
}

/**
 * The UserErrorType represents error type of the UserException.
 *
 * @package Fairdesk
 * @subpackage service
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2015, fairnet medienagentur
 */
class UserErrorType
{

    /**
     * Default, unspecific error.
     *
     * @var int
     */
    const THROW_DEFAULT = 3099;

    /**
     * User not exists.
     *
     * @var int
     */
    const THROW_USER_NOT_FOUND = 3001;

    /**
     * Email address already exists.
     *
     * @var int
     */
    const THROW_EMAIL_ADDRESS_ALREADY_EXISTS = 3002;

    /**
     * Role not exists.
     *
     * @var int
     */
    const THROW_USERROLE_NOT_EXISTS = 3003;

    /**
     * User permission that is denied.
     *
     * @var int
     */
    const THROW_PERMISSION_DENIED = 3004;
}
