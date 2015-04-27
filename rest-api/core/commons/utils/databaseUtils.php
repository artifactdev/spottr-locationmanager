<?php
require_once CONF_FS_CORE_MODELS . "interface.DatabaseModel.php";

use FlorianWolters\Component\Core\StringUtils;

/**
 * The ArrayUtils class provides some static methods, whichs makes the handling of the array usage much easier.
 * With the existing methods you can get array fields much easier.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class DatabaseUtils
{

    /**
     * Singleton object instance.
     *
     * @var DatabaseUtils
     */
    private static $instance = null;

    /**
     * Resource a MySQL link identifier on success or false on failure.
     *
     * @var Resource
     */
    private $databaseLink = null;

    /**
     * Returns singleton instance of DatabaseUtils.
     *
     * @return DatabaseUtils
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Opens the database connection an returns the resource.
     *
     * @return Resource a MySQL link identifier on success or false on failure.
     */
    public function getDatabaseConnection()
    {
        if ($this->databaseLink != null) {
            return $this->databaseLink;
        }
        $this->databaseLink = @mysql_connect(CONF_DATABASE_SERVER, CONF_DATABASE_USERNAME, CONF_DATABASE_PASSWORD);
        @mysql_select_db(CONF_DATABASE_SCHEMA, $this->databaseLink);
        return $this->databaseLink;
    }

    /**
     * Executes an SQL-Query.
     *
     * @param string $sqlQuery
     *            SQL Query to execute.
     * @param array $arguments
     *            List of Arugments in the Query.
     * @return @link http://www.php.net/manual/en/function.mysql-query.php
     */
    public static function query($sqlQuery, $arguments = null)
    {
        $link = DatabaseUtils::getInstance()->getDatabaseConnection();
        $sql = $sqlQuery;

        if ($arguments != null && count($arguments) > 0) {
            foreach ($arguments as $key => $arg) {
                if (is_array($arg)) {
                    continue;
                }
                //$item = StringUtils::prepareForDatabase($arg); // TODO
                $item = $arg;
                $sql = str_replace('{' . $key . '}', $item, $sql);
            }
        }
        
        if (defined("CONF_DATABASE_LOG_QUERIES") && CONF_DATABASE_LOG_QUERIES) {
            $logger = Logger::getLogger("database");
            $logger->info($sql);
        }
        $result = @mysql_query($sql, $link);
        if ($result === false) {
            // TODO Fehler loggen
        }
        return $result;
    }

    /**
     * Executes the given SQL-Query and returns the number of results.
     *
     * @param string $sqlQuery
     *            SQL Query to execute.
     * @param array $arguments
     *            List of Arugments in the Query.
     * @return number
     */
    public static function numRows($sqlQuery, $arguments = null)
    {
        $result = DatabaseUtils::query($sqlQuery, $arguments);
        if ($result === false) {
            return 0;
        }
        $number = @mysql_num_rows($result);
        return is_numeric($number) ? $number : 0;
    }

    /**
     * Executes the given SQL-Query and returns the single result, mapped on an object of the given class.
     *
     * @param string $sqlQuery
     *            SQL Query to execute.
     * @param string $class
     *            Class, on which the results should be mapped to.
     * @param array $arguments
     *            List of Arugments in the Query.
     * @return object of the type of the classname
     */
    public static function fetchResult($sqlQuery, $class, $sqlArguments = null)
    {
        if ($class == null) {
            return false;
        }

        $dbResult = DatabaseUtils::query($sqlQuery, $sqlArguments);
        if ($dbResult === false) {
            return false;
        }
        $row = @mysql_fetch_array($dbResult);
        if ($row === false) {
            return false;
        }
        $class->wrapDBResult($row);
        return $class;
    }

    /**
     * Executes the given SQL-Query and returns the list result.
     * The items are objects of the given class type.
     *
     * @param string $sqlQuery
     *            SQL Query to execute.
     * @param string $className
     *            Name of the class, on which the results should be mapped to.
     * @param Collection $arguments
     *            List of Arugments in the Query.
     * @return object of the type of the classname
     */
    public static function fetchResultList($sqlQuery, $className, $sqlArguments = null)
    {
        $dbResult = DatabaseUtils::query($sqlQuery, $sqlArguments);
        $result = new Collection();

        while ($row = @mysql_fetch_array($dbResult)) {
            $resultItem = new $className();
            $resultItem->wrapDBResult($row);
            $result->items[] = $resultItem;
        }
        return $result;
    }

    /**
     * Returns the id of the last created database entry.
     *
     * @return number
     */
    public static function insertId()
    {
        $link = DatabaseUtils::getInstance()->getDatabaseConnection();
        return @mysql_insert_id($link);
    }
}
?>