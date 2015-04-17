<?php

/**
 * The RestFacade is the first entry point of the REST interface.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class RestFacade
{

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->loadCoreLibs();
        $this->loadCommonUtils();
        $this->initializeLanguage();
        $this->initializeApplication();
    }

    /**
     * Initializes the Logging.
     */
    private function loadCoreLibs()
    {
            // Loads Logging
        require_once CONF_FS_CORE_LIBS . 'apache-log4php/src/main/php/Logger.php';
        $fileNameLogConfig = 'log4php.xml';

        if (file_exists(CONF_FS_APP_CONFIGURATION . $fileNameLogConfig)) {
            Logger::configure(CONF_FS_APP_CONFIGURATION . $fileNameLogConfig);
        } else {
            Logger::configure(CONF_FS_CORE_CONFIGURATION . 'log4php.xml');
        }

        // Loads StringUtils
        require_once CONF_FS_CORE_LIBS . 'PHP-Component-Core-StringUtils/src/main/php/StringUtils.php';
        //require_once CONF_FS_CORE_COMMONS . 'utils/stringUtils.php';

        // Loads the classloader
        require_once CONF_FS_CORE_SERVICE . 'classLoader/class.classLoader.php';
    }

    /**
     * Loads all common Utils classes.
     */
    private function loadCommonUtils()
    {
        ClassLoader::loadClasses(CONF_FS_CORE_COMMONS);
        ClassLoader::loadClasses(CONF_FS_APP_COMMONS);
    }

    /**
     * Loads all common Utils classes.
     */
    private function initializeLanguage()
    {
        // Language initialization.
        // TODO abhängig vom header value die jeweilige sprache laden, wenn vorhanden
        require_once CONF_FS_LANG . '/de/messages.php';
    }

    /**
     * Includes and initializes the application.
     */
    private function initializeApplication()
    {
        // Magically injection initialization.
        require_once CONF_FS_CORE_SERVICE . 'injection/class.InjectionService.php';

        // RestRoute configuration.
        require_once CONF_FS_CORE_SERVICE . 'restRouteService/class.RestRouteService.php';
        require_once CONF_FS_CORE_SERVICE . 'security/class.SecurityContextHolder.php';
    }

    /**
     * Start facade.
     * This function starts the routing. It is the general entry point of the application
     */
    public function run()
    {
        try {
            $routeService = new RestRouteService();
            $routeService->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

        } catch (RestRouteException $ex) {
            if ($ex->errorType == RestRouteErrorType::THROW_NO_ROUTE_AVAILABLE) {
                // TODO kein echo sondern json oder so
                HTTPResponseHelper::setHttpStatusCode(404);
                echo "Page not Found.";
            } else {
                // TODO kein echo sondern json oder so
                HTTPResponseHelper::setHttpStatusCode(500);
                echo $ex->errorMessage;
            }
        }
    }
}