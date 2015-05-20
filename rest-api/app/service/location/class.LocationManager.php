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
            "INSERT INTO `locations` (`category`, `title`, `latitude`, `longitude`, `rating`, `date_created`, `gallery`, `aperture`, `focal`, `iso`,`note`, `type`) VALUES
            ('{CATEGORY}', '{TITLE}', '{LATITUDE}', '{LONGITUDE}', '{RATING}', '" . date("Y-m-d") .
                 "', '', '{APERTURE}', '{FOCAL}', '{ISO}', '{NOTE}', '{TYPE}');", $location->wrapModelToDatabase());
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
                `date_created` = '" . date("Y-m-d") . "',
                `gallery` = '{GALLERY}',
                `aperture` = '{APERTURE}',
                `focal` = '{FOCAL}',
                `iso` = '{ISO}',
                `note` = '{NOTE}',
                `type` = '{TYPE}' WHERE `id`='{ID}';",
            $location->wrapModelToDatabase());
        return $this->findLocation($location->id);
    }

    /**
     * Finds all locations from the database.
     *
     * @return array
     */
    public function findLocations()
    {
        $locations = DatabaseUtils::fetchResultList("SELECT * FROM `locations` WHERE 1", "Location");
        $locations->numberOfItems = count($locations->items);
        return $locations;
        
    }

    /**
     * Finds a specified location from the database.
     *
     * @param int $id
     * @return Location
     */
    public function findLocation($id)
    {
        $location = DatabaseUtils::fetchResult("SELECT * FROM `locations` WHERE `id` = '{ID}'", new Location(),
            array(
                "ID" => $id
            ));
        if ($location == null) {
            throw new LocationException(LocationErrorType::THROW_LOCATION_NOT_FOUND);
        }
        return $location;
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
        $fileName = $this->uploadImage($file);
        if (StringUtils::isNotBlank($fileName)) {
            $location->gallery = $fileName;
            $this->updateLocation($location);
        }
        //unlink(CONF_FS_TMP . $file);
        return true;
    }

    /**
     *
     * @param  string $file Name of the file to upload.
     * @return string uploaded filename.
     */
    private function uploadImage($file) {
        $newFileName = $this->getRandomFileName($file);
        
        $sourceFile = $this->getDir(CONF_FS_TMP) . $file;
        $this->createThumbnail($sourceFile, $newFileName);
        $this->createLargeImage($sourceFile, $newFileName);
        
        return $newFileName;
    }
    
    private function createThumbnail($sourceFileName, $destinationFileName) {
        list($width, $height, $newWidth, $newHeight) = $this->getNewImageSize($sourceFileName, 150, 150);
        
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        $source = imagecreatefromjpeg($sourceFileName);

        imagesetinterpolation($thumb, IMG_SINC);
        
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        $imgFolder = $this->getDir(CONF_FS_MEDIA_LOCATIONS_THUMB);
        imagejpeg($thumb, $imgFolder . $destinationFileName);
    }
    
    /**
     * Calculates the new image size.
     * @param string $sourceFileName Path of the source file.
     * @param int $maxWidth Max width.
     * @param int $maxHeight Max height.
     * @return multitype:unknown Ambigous <number, unknown> multitype:
     */
    private function getNewImageSize($sourceFileName, $maxWidth, $maxHeight) {
        list($width, $height) = getimagesize($sourceFileName);
        
        $maxWidth = $width > $maxWidth ? $maxWidth : $width;
        $maxHeight= $height > $maxHeight? $maxHeight: $height;
        
        if ($width > $height) {
            $newWidth = $maxWidth;
            $newHeight = $newWidth * $height / $width;
        } else {
            $newHeight = $maxHeight;
            $newWidth = $newHeight * $width / $height;
        }

        return array($width, $height, $newWidth, $newHeight);
    }

    private function createLargeImage($sourceFileName, $destinationFileName) {
        list($width, $height, $newWidth, $newHeight) = $this->getNewImageSize($sourceFileName, 560, 560);
        
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        $source = imagecreatefromjpeg($sourceFileName);

        imagesetinterpolation($thumb, IMG_SINC);
        
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        $imgFolder = $this->getDir(CONF_FS_MEDIA_LOCATIONS_ORG);
        imagejpeg($thumb, $imgFolder . $destinationFileName);
    }

    /**
     *
     * @param string $filePath
     * @return string
     */
    private function getRandomFileName($filePath)
    {
        $fileType = substr($filePath, strrpos($filePath, "."), strlen($filePath));
        $randomPath = rand(100);
        $fileName = md5($filePath . $randomPath) . $fileType;
        
        if (file_exists(CONF_FS_MEDIA_LOCATIONS_ORG . $fileName)) {
            return $this->getRandomFileName($fileName);
        }
        return $fileName;
    }
    
    /**
     *
     * @param string $dirPath
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