<?php
use FlorianWolters\Component\Core\StringUtils;
/**
 * All rights reserved - (c) 2013 Markus Jahn
 *
 * mail: markus-jahn@gmx.net
 */
class User extends AbstractDatabaseModel
{

    /**
     * Unique Identification number of the user.
     *
     * @var string
     */
    public $id = "";

    /**
     * Firstname of the user.
     *
     * @var string
     */
    public $firstName = "";

    /**
     * Lastname of the user.
     *
     * @var string
     */
    public $lastName = "";

    /**
     * Addressname of the user.
     *
     * @var string
     */
    public $searchAddress = "";

    /**
     * Longitude of users home.
     *
     * @var string
     */
    public $longitude = "";

    /**
     * Latitude of users home.
     *
     * @var string
     */
    public $latitude = "";

    /**
     * Emailaddress of the user.
     *
     * @var string
     */
    public $email = "";

    /**
     * Password of the user.
     *
     * @var string
     */
    public $password = "";

    /**
     * Roles of the user.
     *
     * @var array
     */
    public $roles = array();

    /**
     *
     * @see AbstractDatabaseModel
     */
    public function wrapDBResult($dbRow)
    {
        $this->companyName = $dbRow['company_name'];
        $this->firstName = $dbRow['first_name'];
        $this->lastName = $dbRow['last_name'];
        $this->email = $dbRow['email'];
        $this->searchAddress= $dbRow['search_address'];
        $this->longitude = $dbRow['longitude'];
        $this->latitude = $dbRow['latitude'];
        $this->id = $dbRow['uuid'];
        return $this;
    }

    /**
     *
     * @see AbstractDatabaseModel
     */
    public function wrapModelToDatabase()
    {
        $result = parent::wrapModelToDatabase();
        $result["PASSWORD"] = md5($this->password);
        return $result;
    }

    /**
     * Validates the firstname.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidFirstName()
    {
        $name = $this->firstName;
        $length = StringUtils::length($name);
        if (! StringUtils::isBlank($name) && $length > 1 && $length < 255) {
            return true;
        }

        return TranslationUtils::translate("The first name must have a length of 1-255 characters.");
    }

    /**
     * Validates the lastname.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidLastName()
    {
        $name = $this->lastName;
        $length = StringUtils::length($name);
        if (! StringUtils::isBlank($name) && $length > 1 && $length < 255) {
            return true;
        }

        return TranslationUtils::translate("The last name must have a length of 1-255 characters.");
    }

    /**
     * Validates the firstname.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidCompanyName()
    {
        $name = $this->companyName;
        if (StringUtils::isBlank($name)) {
            return true;
        }
        $length = StringUtils::length($name);
        if ($length < 255) {
            return true;
        }

        return TranslationUtils::translate("The company name must have a length of 0-255 characters.");
    }

    /**
     * Validates the Email address.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidEmail()
    {
        if (!StringUtils::isBlank($this->id)) {
            return true;
        }
        if (StringUtils::isBlank($this->email)) {
            return TranslationUtils::translate("The email address must be not empty.");
        }

        if (preg_match(REGEXP_APPLICATION_USER_EMAIL, $this->email)) {
            return true;
        }
        return TranslationUtils::translate("The email address is not valid.");
    }

    /**
     * Validates the roles.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidRoles()
    {
        $roles = $this->roles;
        if (isset($roles) && is_array($roles) && count($roles) > 0) {
            return true;
        }

        return TranslationUtils::translate("At least one role must be set.");
    }

    /**
     * Validates the password of the user.
     *
     * @return boolean|string true or errormessage
     */
    public function isValidPassword()
    {
        if (! StringUtils::isBlank($this->id) && StringUtils::isBlank($this->password)) {
            return true;
        }

        if (preg_match(REGEXP_APPLICATION_USER_PASSWORD_RULES, $this->password)) {
            return true;
        }

        return TranslationUtils::translate("The password must have a length of 8-255 characters.");
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

    public function isValidSearchAddress()
    {
        if (StringUtils::length($this->searchAddress) <= 200) {
            return true;
        }
        return TranslationUtils::translate("Die Suchaddress darf maximal 200 Zeichen lang sein.");
    }
}