<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * This is the abstract exception is the root exception, from which all other exception must extend.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
abstract class AbstractException extends Exception {

    /**
     * Message of the error.
     *
     * @var string
     */
    public $errorMessage;

    /**
     * List of the error fields.
     *
     * @var array
     */
    public $errorFields;

    /**
     * Type of the error.
     *
     * @var AbstractExceptionErrorType
     */
    public $errorType = AbstractExceptionErrorType::THROW_DEFAULT;

    /**
     * Default constructor for an exception instanizating.
     *
     * @param int $errorType
     *            Type of the error
     * @param string $message
     *            Error message.
     * @param string $errorFields
     *            List of the error field.
     */
    function __construct($errorType, $message = "", $errorFields = "") {
        $this -> errorType = $errorType;
        $this -> errorMessage = $message;
        $this -> errorFields = StringUtils::isBlank($errorFields) ? ArrayUtils::emptyArray() : $errorFields;
        parent::__construct($message, 0);
    }
}

/**
 * Enumeration which contains all error type of a default error.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class AbstractExceptionErrorType {

    /**
     * Default, unspecific error.
     *
     * @var int
     */
    const THROW_DEFAULT = 9999;
}
