<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * The ValidationUtils class provides some methods to validate values.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class ValidationUtils
{
    /**
     * Starts the validation of the given object. This method calls each validation-method of the given object.
     *
     * @param object $toValidate Object to validate.
     * @throws ValidationException If any validation errors occur.
     */
    public static function validate($toValidate) {

        if (!isset($toValidate) || !is_object($toValidate)) {
            return;
        }

        $className = get_class($toValidate);
        $methods = get_class_methods($className);
        if ($methods == null || count($methods) == 0) {
            return;
        }

        $validationErrors = array();
        foreach ($methods as $method) {
            if (!StringUtils::startsWith($method, "isValid")) {
                continue;
            }

            $result = $toValidate->$method();
            if (isset($result) && $result === true) {
                continue;
            }

            $valueKey = substr($method, strlen("isValid"));
            $valueKey[0] = strtolower($valueKey[0]);

            $validationErrors[] = array("field" => $valueKey, "message" => $result);
        }

        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }
    }
}