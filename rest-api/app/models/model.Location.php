<?php

use FlorianWolters\Component\Core\StringUtils;

/**
 * All rights reserved - (c) 2013 Markus Jahn
 *
 * mail: markus-jahn@gmx.net
 */
class Location extends AbstractDatabaseModel
{
    public $id = "";
    public $category = "";
    public $title = "";
    public $latitude = "";
    public $longitude = "";
    public $rating = -1;
    public $gallery = "";
    public $dateCreated = "";
    public $aperture;
    public $focal;
    public $iso;
    public $type;

    
//     public function isValidShutterSpeed()
//     {
//         if (is_numeric($this->shutterSpeed) && $this->shutterSpeed > 0) {
//             return true;
//         }
//         return TranslationUtils::translate("Die Auslösegeschwindigkeit muss ein numerischer Wert, größer 0 sein.");
//     }

    /**
     * (non-PHPdoc)
     * @see DatabaseModel::wrapDBResult()
     */
    public function wrapDBResult($dbRow) {
        $this->id = $dbRow['id'];
        $this->category = $dbRow['category'];
        $this->title = $dbRow['title'];
        $this->latitude = $dbRow['latitude'];
        $this->longitude = $dbRow['longitude'];
        $this->rating = $dbRow['rating'];
        $this->gallery = $dbRow['gallery'];
        $this->dateCreated = $dbRow['date_created'];
        $this->aperture = $dbRow['aperture'];
        $this->focal = $dbRow['focal'];
        $this->iso = $dbRow['iso'];
        $this->type = $dbRow['type'];
    }
    
}
