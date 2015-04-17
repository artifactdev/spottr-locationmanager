<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The RestRouteService class is the main class, whichs routes a http request to a configured controller class.
 * It also injects autowired services to the controller and checks the authentication level.
 *
 * @package       MJ-REST api core
 * @subpackage    system
 * @version       0.9.0
 * @author        Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class RestRouteService
{

    /**
     * List of all configured request routes.
     *
     * @var array
     */
    private $routes = array();

    /**
     * Application path of the application.
     *
     * @var string
     */
    private $applicationPath;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->loadConfiguration();
    }

    /**
     * Loads the configured routes from the rest-configuration.xml in the app configurations folder.
     */
    private function loadConfiguration()
    {
        $configFile = CONF_FS_APP_CONFIGURATION . "rest-configure.xml";
        if (!file_exists($configFile)) {
            throw new RestRouteException(RestRouteErrorType::THROW_NO_ROUTE_AVAILABLE);
        }
        $xml = simplexml_load_file($configFile);

        $routes = $xml->routes;
        if (count($routes) < 1) {
            throw new RestRouteException(RestRouteErrorType::THROW_NO_ROUTE_AVAILABLE);
        }

        $this->applicationPath = (string)$xml->application_path;
        define("CONF_MJREST_APP_URL", (string)$xml->host); // TODO wird das gebraucht?

        foreach ($routes->route as $route) {
            $secure = true;
            if (!isset($route->secure) || StringUtils::equalsIgnoreCase($route->secure, "false")) {
                $secure = false;
            }
            $url = (string)$route->url;
            $controller = (string)$route->controller;
            $method = (string)$route->controller_method;
            $httpMethod = HttpRequestMethod::getName($route->http_method);

            $this->addRoute($url, $httpMethod, $controller, $method, $secure);
        }
    }

    /**
     * Adds a new route configuration to the context.
     *
     * @param String            $url
     *            Completly url to add in the context. Can contain any placeholders.
     * @param HttpRequestMethod $requestMethod
     *            Requestmethod of the call. See HttpRequestMethod. Fir example post or get.
     * @param String            $className
     *            Name of the listener controller class. Don't forget to require the affected classfile before.
     * @param String            $methodName
     *            Name of the listener controller method of the controller class.
     *
     * @return void
     */
    private function addRoute($url, $requestMethod, $className, $methodName, $needAuthentication = true)
    {
        $this->checkValues($url, $className, $methodName);
        $this->checkUrl($url, $requestMethod);

        $routeItem = new RestRouteItem();
        $routeItem->url = $url;
        $routeItem->className = $className;
        $routeItem->methodName = $methodName;
        $routeItem->requestMethod = $requestMethod;
        $routeItem->needAuthentication = $needAuthentication;

        $this->routes[] = $routeItem;
    }

    /**
     * Checks all values of correct content.
     *
     * @param String $url
     *            Url to check.
     * @param String $className
     *            Classname of the listener controller class to check.
     * @param String $methodName
     *            Methodname of the listener controller class to check.
     *
     * @return void
     * @throws RestRouteException An RestRouteException will be thrown, if one of the given values does not equal with
     *         the rules.
     */
    private function checkValues($url, $className, $methodName)
    {
        if (empty($url)) {
            throw new RestRouteException(RestRouteErrorType::THROW_EMPTY_VALUE, LANG_ERROR_REST_ROUTE_URL_MUST_BE_SET);
        }

        if (empty($className)) {
            throw new RestRouteException(RestRouteErrorType::THROW_EMPTY_VALUE,
                LANG_ERROR_REST_ROUTE_CLASSNAME_MUST_BE_SET, $url);
        }

        if (empty($methodName)) {
            throw new RestRouteException(RestRouteErrorType::THROW_EMPTY_VALUE, LANG_ERROR_METHODNAME_MUST_BE_SET, $url);
        }
    }

    /**
     * Checks whether the url already exists in the current context.
     *
     * @param String $url
     *            Url to check whether it alredy exists in the current context.
     * @param string $requestMethod
     *            Requestmethod of the new config value.
     *
     * @return void
     * @throws RestRouteException An RestRouteException will be thrown, if the url with the HttpRequestMethod already
     *         exists.
     */
    private function checkUrl($url, $requestMethod)
    {
        foreach ($this->routes as $route) {
            if ($route->url == $url && $route->requestMethod == strtolower($requestMethod)) {
                throw new RestRouteException(RestRouteErrorType::THROW_URL_EXISTS,
                    LANG_ERROR_REST_ROUTE_URL_ALREADY_EXISTS, $url, $requestMethod);
            }
        }
    }

    /**
     * Routes an incoming request to a configured controller class and method.
     * Whether a equal configuration can not be found, an RestRouteException will be thrown.
     *
     * @param String $path
     *            Requested application path of the url.
     * @param string $requestMethod
     *            Requested method of the current request.
     *
     * @return void
     * @throws RestRouteException Whether a equal configuration can not be found, an RestRouteException will be thrown.
     */
    public function route($path, $requestMethod = HttpRequestMethod::GET)
    {
        $currentPath = str_replace($this->applicationPath, '', $path);

        if (StringUtils::indexOf($currentPath, "?") > 0) {
            $currentPath = substr($currentPath, 0, strpos($currentPath, "?"));
        }
        $currentPathParts = explode("/", $currentPath);
        foreach ($this->routes as $route) {

            if ($route->requestMethod != strtolower($requestMethod)) {
                continue;
            }
            $urlParameters = $this->matchesRouteItemAndCurrentPath($route, $currentPathParts);
            if ($urlParameters !== false) {
                $this->redirectRequest($route, $urlParameters);
                return;
            }
        }
        throw new RestRouteException(RestRouteErrorType::THROW_NO_ROUTE_AVAILABLE, LANG_ERROR_REST_ROUTE_URL_NOT_FOUND, $path, $requestMethod);
    }

    /**
     * Checks, whether the given RoutItem matchen with the current called url path.
     * If both matches, and array with the url parameters will be returned.
     *
     * @param RestRouteItem $routeItem
     *            RouteItem to check with the url.
     * @param array         $currentPathParts
     *            Current url path items.
     *
     * @return bool|array
     */
    private function matchesRouteItemAndCurrentPath(RestRouteItem $routeItem, $currentPathParts)
    {
        $routePathParts = explode("/", $routeItem->url);
        if (count($currentPathParts) != count($routePathParts)) {
            return false;
        }

        $urlParameters = array();

        foreach ($currentPathParts as $key => $currentPathPart) {
            $routePathPart = $routePathParts[$key];

            if (StringUtils::startsWith($routePathPart, "{")) {
                $parameterKey = substr($routePathPart, 2, strlen($routePathPart) - 3);
                $urlParameters[$parameterKey] = $currentPathPart;
            } elseif ($routePathPart != $currentPathPart) {
                return false;
            }
        }
        return $urlParameters;
    }

    /**
     * Redirects the given route to the configured Controller and method.
     *
     * @param RestRouteItem $route
     *            RouteItem.
     *
     * @return void
     */
    private function redirectRequest($route, $urlParameters = array())
    {
        try {
            $this->checkAuthenticationOfRequest($route);

            $this->importControllerClass($route->className);
            $instance = new $route->className();
            InjectionService::getInstance()->autowire($instance);

            $reflectionMethod = new ReflectionMethod($route->className, $route->methodName);
            $methodParameters = $reflectionMethod->getParameters();

            $methodArgs = array();
            foreach ($methodParameters as $methodParameter) {
                if (array_key_exists($methodParameter->name, $urlParameters)) {
                    $methodArgs[$methodParameter->name] = $urlParameters[$methodParameter->name];
                } else {
                    $methodArgs[$methodParameter->name] = null;
                }
            }

            HTTPResponseHelper::setContentType("application/json"); // TODO
            $object = $reflectionMethod->invokeArgs($instance, $methodArgs);
            echo json_encode($object); // TODO muss generisch sein!
        } catch (AbstractException $exception) {

            if ($exception instanceof AuthenticationException) {
                HTTPResponseHelper::setHttpStatusCode(403);
            }
            HTTPResponseHelper::setHttpStatusCode(400);
            HTTPResponseHelper::setContentType("application/json");
            echo json_encode($exception);
        }
    }

    /**
     * Imports the given controller class.
     *
     * @param string $controllerName
     *            Controllerclass to include.
     *
     * @throws RestRouteException If no class was found.
     */
    private function importControllerClass($controllerName)
    {
        $classFileName = "class." . $controllerName . ".php";
        $classPath = $this->getClassPath(CONF_FS_APP_CONTROLLERS, $classFileName);

        if (!$classPath) {
            throw new RestRouteException(RestRouteErrorType::THROW_NO_ROUTE_AVAILABLE);
        }
        require_once $classPath;
    }

    /**
     * Find the classpath of a given class in a given directory structure, by searching recursive in subdirectories.
     * If no class was found, false will be returned.
     *
     * @param string $directory
     *            Directoryname in which you want to search the classfile.
     * @param string $classFileName
     *            Classfilename to search.
     *
     * @return boolean|string False, if no classfile was found, otherwise the classpath.
     */
    private function getClassPath($directory, $classFileName)
    {
        // iterate over the include dir
        $dir = new RecursiveDirectoryIterator($directory);
        foreach (new RecursiveIteratorIterator($dir) as $file) {
            $fileName = $file->getFileName();

            if (StringUtils::equal($classFileName, $fileName)) {
                return $file->getPathname();
            }
        }
        return false;
    }

    /**
     * Checks whether the user need an authentication, and checks in this case the authentication object.
     *
     * @param RestRouteItem $route
     *            Route item.
     *
     * @return void
     */
    private function checkAuthenticationOfRequest($route)
    {
        if ($route->needAuthentication) {
            $contextHolder = SecurityContextHolder::getInstance();
            $contextHolder->verifyAuthenticationInfoFromRequest();
            $context = $contextHolder->getSecurityContext();
            if (!$context->isLoggedIn) {
                throw new AuthenticationException(AuthenticationErrorType::THROW_ACCESS_DENIED);
            }
        }
    }
}