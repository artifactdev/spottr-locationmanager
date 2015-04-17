<?php

/**
 * This model represents the authentication data.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AuthenticationInfo
{

    /**
     * Id of the current user.
     *
     * @var string
     */
    public $userUUId = "";

    /**
     * Signatur hash of the current user.
     *
     * @var string
     */
    public $signature = "";

    /**
     * Wraps the data from a json object to this object values.
     *
     * @return AuthenticationInfo
     */
    public function wrapJSONDecode($value)
    {
        $this->userUUId = isset($value->userUUId) ? $value->userUUId : "";
        $this->signature = isset($value->signature) ? $value->signature : "";

        return $this;
    }
}

?>