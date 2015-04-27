<?php

/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class LocationException extends AbstractException
{

    /**
     * Default constructor.
     *
     * @param UserErrorType $type
     *            Type of the occured error.
     */
    public function __construct($type)
    {
        $message = LANG_APP_LOCATION_ERROR_DEFAULT;
        if ($type == LocationErrorType::THROW_LOCATION_NOT_FOUND) {
            $message = LANG_APP_LOCATION_NOT_FOUND;
        }
        parent::__construct($type, $message);
    }
}

/**
 * The LocationErrorType represents error type of the LocationException.
 *
 * @package Fairdesk
 * @subpackage service
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2015, fairnet medienagentur
 */
class LocationErrorType
{

    /**
     * Default, unspecific error.
     *
     * @var int
     */
    const THROW_DEFAULT = 5099;

    /**
     * Location not exists.
     *
     * @var int
     */
    const THROW_LOCATION_NOT_FOUND = 5001;
}
