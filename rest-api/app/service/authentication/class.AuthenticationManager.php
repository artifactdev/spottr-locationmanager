<?php

use FlorianWolters\Component\Core\StringUtils;
/**
 * It is responsible to inject autoamtically service classes into controller classes.
 * This InjectionService class is a singleton class.
 *
 * @package MJ-REST api core
 * @subpackage service
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AuthenticationManager
{

    /**
     * @autowired - UserManager
     *
     * @var UserManager
     */
    public $userManager;

    /**
     * Makes a login with the given credentials.
     * If the credential does not match with an user in the system, an AuthenticationException will be thrown.
     *
     * @param string $email
     *            Email to login with.
     * @param string $password
     *            Password of the user.
     * @return AuthenticationInfo
     *
     * @throws AuthenticationException An AuthenticationException will be thrown, if the credentials does not match.
     */
    public function loginWithEmailAndPassword($email, $password)
    {
        if (StringUtils::isBlank($email) || StringUtils::isBlank($password)) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_USERNAME_OR_PASSWORD_WRONG);
        }

        try {
            $password = md5($password);
            $user = $this->userManager->findUserByEmailAndPassword($email, $password);
        } catch (UserException $ex) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_USERNAME_OR_PASSWORD_WRONG);
        }

        $secContextHolder = SecurityContextHolder::getInstance();
        $secContextHolder->updateSecurityContext($user->id);
        return $secContextHolder->getSecurityContext()->authenticationInfo;
    }

    /**
     * Checks if the current logged in user is part of the given role.
     *
     * @param string $roleId
     *            Role Id to check.
     * @return boolean
     */
    public function hasUserRole($roleId)
    {
        $secContextHolder = SecurityContextHolder::getInstance();
        $authInfo = $currentLoggedInUserId = $secContextHolder->getSecurityContext()->authenticationInfo;

        if ($authInfo == null || StringUtils::isBlank($authInfo->userUUId)) {
            return false;
        }

        try {
            $user = $this->userManager->findUser($authInfo->userUUId);
            if (! in_array($roleId, $user->roles)) {
                return false;
            }
        } catch (UserException $ex) {
            return false;
        }
        return true;
    }

    /**
     * Checks if the current logged in user is part of the given role.
     * If not, an exception will be thrown.
     *
     * @param string $roleId
     *            Role id ti check.
     * @throws AuthenticationException
     */
    public function checkRolePermission($roleId)
    {
        if (! $this->hasUserRole($roleId)) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
        }
    }

    /**
     * Return the current users id of the logged in user.
     *
     * @return string Id of the current user.
     * @throws AuthenticationException If not logged in.
     */
    public function getCurrentUserId()
    {
        $secContextHolder = SecurityContextHolder::getInstance();
        $authInfo = $currentLoggedInUserId = $secContextHolder->getSecurityContext()->authenticationInfo;

        if ($authInfo == null || StringUtils::isBlank($authInfo->userUUId)) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
        }
        return $authInfo->userUUId;
    }
}