<?php
use FlorianWolters\Component\Core\StringUtils;
use FlorianWolters\Component\Core\RandomStringUtils;

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
            "INSERT INTO `locations` (`category`, `title`, `latitude`, `longitude`, `rating`, `date_created`, `gallery`, `aperture`, `focal`, `iso`, `type`) VALUES
            ('{CATEGORY}', '{TITLE}', '{LATITUDE}', '{LONGITUDE}', '{RATING}', '" .
                 date("Y-m-d") . "', '', '{APERTURE}', '{FOCAL}', '{ISO}', '{TYPE}');", $location->wrapModelToDatabase());
        $lastId = DatabaseUtils::insertId();
        return $this->findLocation($lastId);
    }

    /**
     * Updates the given location in the database.
     *
     * @param Location $location
     */
    public function updateLocation(Location $location)
    {
        DatabaseUtils::query(
            "UPDATE `locations` SET
                `category` = '{CATEGORY}',
                `title` = '{TITLE}',
                `rating` = '{RATING}',
                `gallery` = '{GALLERY}',
                `aperture` = '{APERTURE}',
                `focal` = '{FOCAL}',
                `iso` = '{ISO}',
                `type` = '{TYPE}' WHERE `id`='{ID}';", $location->wrapModelToDatabase());
        return $this->findLocation($location->id);
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
        $location = $this->findLocation($id);
        
        DatabaseUtils::query("DELETE FROM `locations` WHERE `id` = {ID}", array(
            "ID" => $id
        ));
        
        if (StringUtils::isNotBlank($location->gallery)) {
            unlink(CONF_FS_MEDIA_LOCATIONS . $location->gallery);
        }
        return true;
    }

    /**
     *
     * @param int $locationId
     * @param string $attachment
     *            File name of the temporary saved attachment.
     * @return boolean.
     */
    public function addImage($locationId, $file)
    {
        $location = $this->findLocation($locationId);
        if (StringUtils::isNotBlank($location->gallery)) {
            unlink(CONF_FS_MEDIA_LOCATIONS . $location->gallery);
        }
        $fileName = $this->getRandomFileName($file);
        
        if (rename(CONF_FS_TMP . $file, CONF_FS_MEDIA_LOCATIONS . $fileName)) {
            $location->gallery = $fileName;
            $this->updateLocation($location);
        }
        unlink(CONF_FS_TMP . $file);
        return true;
    }
    
    /**
     *
     * @param string $filePath
     * @return string
     */
    private function getRandomFileName($filePath) {
        $fileType = substr($filePath, strrpos($filePath, "."), strlen($filePath));
        $randomPath = rand(100);
        $fileName = md5($filePath . $randomPath) . $fileType;
        
        if (file_exists(CONF_FS_MEDIA_LOCATIONS . $fileName)) {
            return $this->getRandomFileName($filePath);
        }
        return $fileName;
    }
}