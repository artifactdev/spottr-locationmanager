<?php
use FlorianWolters\Component\Core\StringUtils;

/**
 * The HTTPRequestHelper class provides every kind of methods that you need to get request parameters.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class HTTPRequestHelper
{

    /**
     * Returns the request parameter value of the given parameter name.
     *
     * @param string $parameterName
     *            Name of the requestparameter.
     * @param string $default
     *            Defaultvalue if the value parameter is not found.
     * @param string $parameterPrefix
     *            Name of the parameter prefix in a multiform request. e.q. <subParam>_name.
     *            In Case of JSON it is the name of the rootobject, which contains the modeldata.
     * @return string
     */
    public static function getRequestParam($parameterName, $default = "", $parameterPrefix = "")
    {
        $requestedContentType = HTTPRequestHelper::getHeaderParam("content-type");
        if (StringUtils::indexOf($requestedContentType, "application/json") >= 0) { // TODO
            return HTTPRequestJSONHelper::getRequestParam($parameterName, $default, $parameterPrefix);
        }
        return HTTPRequestMultiformHelper::getRequestParam($parameterName, $default, $parameterPrefix);
    }

    /**
     * Search the given parameter name in the request header data and returns it.
     * If the value is a JSON object, the object will be decoded and returned.
     * If additionally a classname is given, an object of this class will be created and the parsed header data
     * will be set on this object.
     *
     * @param string $parameterName
     *            Name of the header parameter.
     * @param string $className
     *            Name of the class to create an object. If not set, the plain header value will be returned.
     * @return string|stdClass Value of the Header. If Json, then decoded as stdClass.
     */
    public static function getHeaderParam($parameterName, $className = "")
    {
        $headers = getallheaders();
        if ($headers === false || ! is_array($headers)) {
            return null;
        }
        
        $value = "";
        $found = false;
        foreach ($headers as $headerKey => $headerValue) {
            if (StringUtils::equalsIgnoreCase($parameterName, $headerKey)) {
                $value = $headerValue;
                $found = true;
                break;
            }
        }
        
        if (! $found) {
            return null;
        }
        
        if (StringUtils::startsWith($value, "{") && StringUtils::endsWith($value, "}")) {
            $result = json_decode($value);
        } else {
            $result = $value;
        }
        
        if (! StringUtils::isBlank($className)) {
            $instance = new $className();
            $result = $instance->wrapJSONDecode($result);
        }
        return $result;
    }

    /**
     * Search the given parameter name in the request cookie data and returns it.
     * If the value is a JSON object, the object will be decoded and returned.
     * If additionally a classname is given, an object of this class will be created and the parsed header data
     * will be set on this object.
     *
     * @param string $parameterName
     *            Name of the header parameter.
     * @param string $className
     *            Name of the class to create an object. If not set, the plain header value will be returned.
     * @return string|stdClass Value of the Header. If Json, then decoded as stdClass.
     */
    public static function getCookieParam($parameterName, $className = "")
    {
        if (! isset($_COOKIE) || ! array_key_exists($parameterName, $_COOKIE)) {
            return null;
        }
        
        $value = $_COOKIE[$parameterName];
        if (! isset($value)) {
            return null;
        }
        
        if (StringUtils::startsWith($value, "{") && StringUtils::endsWith($value, "}")) {
            $result = json_decode($value);
        } else {
            $result = $value;
        }
        
        if (! StringUtils::isBlank($className)) {
            $instance = new $className();
            $result = $instance->wrapJSONDecode($result);
        }
        return $result;
    }

    /**
     * Instanciate an object of the given classname, and fills the classattribute with the values from the request.
     * If no value was found for an attribute, the attribute gets the value null.
     *
     * @param object $modelClass
     *            Classinstance, on which the request parameters should be filled in.
     * @param string $parameterPrefix
     *            Name of the parameter prefix in a multiform request. e.q. <subParam>_name.
     *            In Case of JSON it is the name of the rootobject, which contains the modeldata.
     * @return object of the given modelClassName
     */
    public static function getParamAsModel($modelClass = null, $parameterPrefix = "")
    {
        if ($modelClass == null) {
            return null;
        }
        $modelClassName = get_class($modelClass);
        $attributes = get_class_vars($modelClassName);
        
        if (count($attributes) == 0) {
            return $modelClass;
        }
        foreach ($attributes as $attributeKey => $attributeVal) {
            $value = HTTPRequestHelper::getRequestParam($attributeKey, "", $parameterPrefix);
            if (StringUtils::isBlank($value) && ! is_numeric($value)) {
                $modelClass->$attributeKey = "";
            } else {
                $modelClass->$attributeKey = $value;
            }
        }
        
        return $modelClass;
    }

    /**
     * Uploads all files from the Post payload to the tmp folder, and returns the list of file names.
     *
     * @return array List of uploaded files.
     */
    public static function getUploadedFiles()
    {
        $files = array();
        foreach ($_FILES as $parameter => $file) {
            $newFileName = date("Y-m-d_H-i-s") . "_" . $file['name'];
            if (! move_uploaded_file($file['tmp_name'], self::getDir(CONF_FS_TMP) . $newFileName)) {
                continue;
            }
            $files[] = $newFileName;
        }
        return $files;
    }

    /**
     *
     * @param unknown $dirPath
     */
    private static function getDir($dirPath)
    {
        if (StringUtils::isBlank($dirPath)) {
            return "";
        }
        
        if (file_exists($dirPath)) {
            return $dirPath;
        }
        mkdir($dirPath, 0755, true);
        return $dirPath;
    }
}

