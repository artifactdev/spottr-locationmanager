<?php
use FlorianWolters\Component\Core\StringUtils;

/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class Location extends AbstractDatabaseModel
{

    public $id = "";

    public $category = "";

    public $title = "";

    public $latitude = "";

    public $longitude = "";

    public $rating = - 1;

    public $gallery = "";

    public $dateCreated = "";

    public $aperture = 0;

    public $focal = 0;

    public $iso = 0;

    public $type = "";

    public function isValidCategory()
    {
        if (StringUtils::length($this->category) <= 255) {
            return true;
        }
        return TranslationUtils::translate("Der Kategoriename darf maximal 255 Zeichen lang sein.");
    }

    public function isValidTitle()
    {
        if (StringUtils::length($this->title) <= 255) {
            return true;
        }
        return TranslationUtils::translate("Der Titel darf maximal 255 Zeichen lang sein.");
    }

    public function isValidLatitude()
    {
        if (StringUtils::length($this->latitude) <= 60) {
            return true;
        }
        return TranslationUtils::translate("Die Latitude darf maximal 60 Zeichen lang sein.");
    }

    public function isValidLongitude()
    {
        if (StringUtils::length($this->longitude) <= 60) {
            return true;
        }
        return TranslationUtils::translate("Die Longitude darf maximal 60 Zeichen lang sein.");
    }

    public function isValidRating()
    {
        $this->rating = StringUtils::isBlank($this->rating) ? 0 : $this->rating;
        if ($this->isInteger($this->rating)) {
            return true;
        }
        return TranslationUtils::translate("Das Rating muss numerisch sein.");
    }

    public function isValidAperture()
    {
        $this->aperture = StringUtils::isBlank($this->aperture) ? 0 : $this->aperture;
        if ($this->isInteger($this->aperture)) {
            return true;
        }
        return TranslationUtils::translate("Die Aperture muss numerisch sein.");
    }

    public function isValidFocal()
    {
        $this->focal = StringUtils::isBlank($this->focal) ? 0 : $this->focal;
        if ($this->isInteger($this->focal)) {
            return true;
        }
        return TranslationUtils::translate("Das Focal muss numerisch sein.");
    }

    public function isValidIso()
    {
        $this->iso = StringUtils::isBlank($this->iso) ? 0 : $this->iso;
        if ($this->isInteger($this->iso)) {
            return true;
        }
        return TranslationUtils::translate("Die ISO muss numerisch sein.");
    }

    public function isValidType()
    {
        if (StringUtils::length($this->type) <= 255) {
            return true;
        }
        return TranslationUtils::translate("Der Typ darf maximal 255 Zeichen lang sein.");
    }

    /**
     * (non-PHPdoc)
     *
     * @see DatabaseModel::wrapDBResult()
     */
    public function wrapDBResult($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->category = $dbRow['category'];
        $this->title = $dbRow['title'];
        $this->latitude = $dbRow['latitude'];
        $this->longitude = $dbRow['longitude'];
        $this->rating = $dbRow['rating'];
        
        if (StringUtils::isNotBlank($dbRow['gallery'])) {
            $this->gallery = "rest-api/media/locations/" . $dbRow['gallery'];
        }
        
        $this->date = $dbRow['date_created'];
        $this->aperture = $dbRow['aperture'];
        $this->focal = $dbRow['focal'];
        $this->iso = $dbRow['iso'];
        $this->type = $dbRow['type'];
    }

    private function isInteger($input)
    {
        return (ctype_digit(strval($input)));
    }
}
