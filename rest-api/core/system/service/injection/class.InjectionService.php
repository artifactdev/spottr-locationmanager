<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * This InjectionService class is a singleton class.
 * It is responsible to inject autoamtically service classes into controller classes.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class InjectionService
{

    /**
     * Singleton instance.
     *
     * @var InjectionService
     */
    private static $instance = null;

    /**
     * List of autowired objects.
     *
     * @var array
     */
    public $autoWireObjects = array();

    /**
     * Hidden constructor.
     */
    private function __construct()
    {}

    /**
     * Returns singleton instance of InjectionService.
     *
     * @return InjectionService
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Adds tehe given object to the list of autowiring object.
     * Optional you can set an different componentname.
     *
     * @param Object $object
     *            Object to autowire.
     * @param String $componentName
     *            Optionally componentname for the autowiring.
     * @return void
     */
    public function addAutowireObject($object, $componentName = "")
    {
        if ($object == null) {
            throw new RuntimeException("Autowire object must be not null.");
        }

        if (StringUtils::isBlank($componentName)) {
            $componentName = get_class($object);
        }

        if (count($this->autoWireObjects) == 0) {
            $this->autoWireObjects[$componentName] = $object;
            return;
        }

        foreach ($this->autoWireObjects as $key => $value) {
            if ($key == $componentName) {
                throw new RuntimeException("Can't add to autowire object with the same name: " . $componentName);
            }
        }
        $this->autoWireObjects[$componentName] = $object;
    }

    /**
     * Autowired all known Managers into the given instance.
     *
     * @param Controller $instance
     *            Any kind of controller, in which the managers will e injected.
     * @return void
     */
    public function autowire($instance)
    {
        $classVariables = get_class_vars(get_class($instance));
        foreach ($classVariables as $key => $value) {
            $autowireObject = $this->getAutowireObjectByName($key);
            if ($autowireObject != null) {
                $instance->$key = $autowireObject;
            }
        }
    }

    /**
     * Finds a autowire object in the list of objects.
     * If no object was found, null will be returned.
     *
     * @param String $name
     *            Name of the component to find.
     * @return stdClass
     */
    private function getAutowireObjectByName($name)
    {
        foreach ($this->autoWireObjects as $key => $value) {
            if (StringUtils::equalsIgnoreCase($key, $name)) {
                return $value;
            }
        }
        return null;
    }

    /**
     * Finds all autowireObjects.
     *
     * @return void
     */
    public function findAutowireObjects()
    {
        $this->importExceptions();
        $this->findAutowireModels();
        $this->findAutowireServices();
        $this->findAutowireConverters();

        $this->autowireServices();
    }

    /**
     * Starts the autowiring of Service instances.
     */
    private function autowireServices()
    {
        foreach ($this->autoWireObjects as $autowireObject) {
            $this->autowire($autowireObject);
        }
    }

    /**
     * Finds all service classes for autowiring.
     *
     * @return void
     */
    private function findAutowireServices()
    {
        $appManagers = ClassLoader::loadClasses(CONF_FS_APP_SERVICE, "class", "Manager");
        $serviceManagers = ClassLoader::loadClasses(CONF_FS_CORE_SERVICE, "class", "Manager");
        $managers = array_merge($appManagers, $serviceManagers);

        foreach ($managers as $manager) {
            $instance = new $manager();
            $this->addAutowireObject($instance, $manager);
        }
    }

    /**
     * Finds all service converts for autowiring.
     *
     * @return void
     */
    private function findAutowireConverters()
    {
        $converters = ClassLoader::loadClasses(CONF_FS_APP_SERVICE, "class", "Converter");
        foreach ($converters as $converter) {
            $instance = new $converter();
            $this->addAutowireObject($instance, $converter);
        }
    }

    /**
     * Finds all model classes for including.
     *
     * @return void
     */
    private function findAutowireModels()
    {
        ClassLoader::loadClasses(CONF_FS_CORE_MODELS, "enum");
        ClassLoader::loadClasses(CONF_FS_APP_MODELS, "enum");

        ClassLoader::loadClasses(CONF_FS_CORE_MODELS, "model");
        ClassLoader::loadClasses(CONF_FS_APP_MODELS, "model");
    }

    /**
     * Finds all exceptions to include.
     *
     * @return void
     */
    private function importExceptions()
    {
        ClassLoader::loadClasses(CONF_FS_CORE_EXCEPTIONS, "class", "Exception");
        ClassLoader::loadClasses(CONF_FS_CORE_SERVICE, "class", "Exception");
        ClassLoader::loadClasses(CONF_FS_APP_SERVICE, "class", "Exception");
    }
}

InjectionService::getInstance()->findAutowireObjects();
