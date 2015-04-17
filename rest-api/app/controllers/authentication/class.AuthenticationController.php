<?php

/**
 * This InjectionService class is a singleton class.
 * It is responsible to inject autoamtically service classes into controller classes.
 *
 * @package MJ-REST api core
 * @subpackage controllers
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AuthenticationController
{

    /**
     * @Autowired - AuthenticationManager
     * @var AuthenticationManager
     */
    public $authenticationManager;

    /**
     * Controller method to authenticate a user.
     * @return AuthenticationInfo
     */
    public function authenticate()
    {
        $email = HTTPRequestHelper::getRequestParam('email');
        $password = HTTPRequestHelper::getRequestParam('password');

        $authInfo = $this->authenticationManager->loginWithEmailAndPassword($email, $password);
        return $authInfo;
    }
}
