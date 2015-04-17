<?php
/**
 * The ValidationException will be thrown, if a validation failure happend. It contains all needful information of the validation failure.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class ValidationException extends AbstractException
{

    /**
     * Default constructor, that contains the validation errors.
     * @param unknown $validationErrors
     */
    function __construct($validationErrors)
    {
        parent::__construct(9998, LANG_CORE_SYSTEM_VALIDATION_GENERAL, $validationErrors);
    }
}