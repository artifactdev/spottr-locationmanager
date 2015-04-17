<?php

/**
 * The InvalidArg will be thrown, if an argument is made up of the wrong type.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class InvalidArgException extends AbstractException
{

    /**
     * Default constructor, that contains the validation errors.
     *
     * @param string $argumentName
     *            Name of the argument which failed.
     * @param string $expectedValue
     *            Expected parameter value.
     */
    function __construct($argumentName, $expectedValue)
    {
        $result = array(
            $argumentName => $expectedValue
        );
        parent::__construct(9997, LANG_CORE_SYSTEM_INVALID_ARGUMENT_GENERAL, $result);
    }
}