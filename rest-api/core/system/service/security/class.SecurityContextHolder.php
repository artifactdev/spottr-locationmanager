<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The security context holder holds the security context of the current users request.
 * It gets the contexts from the http headers cookie.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class SecurityContextHolder
{

    /**
     * Singleton instance.
     *
     * @var SecurityContextHolder
     */
    private static $instance = null;

    /**
     * Stored security context.
     *
     * @var SecurityContext
     */
    private $securityContext = null;

    /**
     * Hidden constructor, that creates the context.
     */
    private function __construct()
    {
        $this->securityContext = new SecurityContext();
    }

    /**
     * Returns singleton instance of SecurityContextHolder.
     *
     * @return SecurityContextHolder
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Returns the current SecurityContext.
     *
     * @return SecurityContext
     */
    public function getSecurityContext()
    {
        return $this->securityContext;
    }

    /**
     * Checks whether the content of the AuthInfo is valid.
     *
     * @param AuthInfo $authInfo
     *            AuthInfo to validate.
     * @return void
     * @throws AuthenticationException If the user has no access.
     */
    public function verifyAuthenticationInfoFromRequest()
    {
        $authInfo = $this->getAuthInfo();

        if ($authInfo == null || ! ($authInfo instanceof AuthenticationInfo)) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
        }

        if (StringUtils::isBlank($authInfo->userUUId) || StringUtils::isBlank($authInfo->signature)) {
            throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
        }

        if ($authInfo->signature == md5($authInfo->userUUId . CONF_AUTHENTICATION_INFO_SALT)) {
            $this->securityContext->authenticationInfo = $authInfo;
            $this->securityContext->isLoggedIn = true;
            return;
        }

        throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
    }

    /**
     * Finds the authentication info object in the header or optionally in the cookie.
     * @return AuthenticationInfo or null
     */
    private function getAuthInfo() {
        $authInfo = HTTPRequestHelper::getHeaderParam(REQ_PARAM_AUTH_INFO, "AuthenticationInfo");
        if ($authInfo == null) {
            $authInfo = HTTPRequestHelper::getCookieParam(REQ_PARAM_AUTH_INFO, "AuthenticationInfo");
        }
        return $authInfo;
    }

    /**
     * Updates the Securitycontext.
     *
     * @param String $userUUId
     *            Id of user.
     * @return void
     */
    public function updateSecurityContext($userUUId)
    {
        $newAuthInfo = new AuthenticationInfo();
        $newAuthInfo->userUUId = $userUUId;
        $newAuthInfo->signature = md5($userUUId . CONF_AUTHENTICATION_INFO_SALT);
        $this->securityContext->isLoggedIn = true;
        $this->securityContext->authenticationInfo = $newAuthInfo;
    }

    /**
     * Destroys a the current Securitycontext.
     *
     * @return void
     */
    public function destroySecurityContext()
    {
        $this->securityContext = new SecurityContext();
    }
}