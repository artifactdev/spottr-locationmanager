<?php

/**
 * The AuthenticationException represents errors of authentcation level.
 *
 * @package MJ-REST api core
 * @subpackage service
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AuthenticationException extends AbstractException
{

    /**
     * Default constructor.
     *
     * @param AuthenticationErrorType $type
     *            Type of the occured error.
     */
    public function __construct($type)
    {
        $message = LANG_ERROR_AUTHENTICATION_DEFAULT;
        if ($type == AuthenticationErrorType::THROW_ACCESS_DENIED) {
            $message = LANG_ERROR_AUTHENTICATION_ACCESS_DENIED;
        } else
            if ($type == AuthenticationErrorType::THROW_USERNAME_OR_PASSWORD_WRONG) {
                $message = LANG_ERROR_AUTHENTICATION_USERNAME_OR_PASSWORD_WRONG;
            }
        parent::__construct($type, $message);
    }
}

/**
 * The AuthenticationErrorType represents error type of the AuthenticationException.
 *
 * @package MJ-REST api core
 * @subpackage service
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AuthenticationErrorType
{

    /**
     * Default, unspecific error.
     *
     * @var int
     */
    const THROW_DEFAULT = 2099;

    /**
     * Access denied error.
     *
     * @var int
     */
    const THROW_ACCESS_DENIED = 2001;

    /**
     * Username or password wrong
     *
     * @var int
     */
    const THROW_USERNAME_OR_PASSWORD_WRONG = 2002;

    /**
     * User is still not verified.
     *
     * @var int
     */
    const THROW_USER_NOT_VERIFIED = 2003;
}

?>