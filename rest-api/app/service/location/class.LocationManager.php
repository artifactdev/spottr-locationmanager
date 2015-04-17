<?php
use FlorianWolters\Component\Core\StringUtils;

/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class LocationManager
{

    /**
     * Creates a new Location in the database
     *
     * @param Location $location
     */
    public function createLocation(Location $location)
    {
        DatabaseUtils::query(
            "INSERT INTO `locations` (`category`, `title`, `latitude`, `longitude`, `rating`, `gallery`, `date_created`, `aperture`, `focal`, `iso`, `type`) VALUES
            ('{CATEGORY}', '{TITLE}', '{LATITUDE}', '{LONGITUDE}', '{RATING}', '{GALLERY}', '" . date("Y-m-d") .
                 "', '{APERTURE}', '{FOCAL}', '{ISO}', '{TYPE}');", $location->wrapModelToDatabase());
        $lastId = DatabaseUtils::insertId();
        return $this->findLocation($lastId);
    }

    /**
     * Finds all locations from the database.
     *
     * @return array
     */
    public function findLocations()
    {
        return DatabaseUtils::fetchResultList("SELECT * FROM `locations`", "Location");
    }

    /**
     * Finds a specified location from the database.
     *
     * @param int $id
     * @return Location
     */
    public function findLocation($id)
    {
        return DatabaseUtils::fetchResult("SELECT * FROM `locations` WHERE `id` = '{ID}'", new Location(),
            array(
                "ID" => $id
            ));
    }

    /**
     * Deletes the given location from the database.
     *
     * @param int $id
     */
    public function deleteLocation($id)
    {
        if (StringUtils::isBlank($id)) {
            return true;
        }
        DatabaseUtils::query("DELETE FROM `locations` WHERE `id` = {ID}", array(
            "ID" => $id
        ));
        return true;
    }
}