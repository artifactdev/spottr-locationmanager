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
     * Companyname of the user.
     *
     * @var string
     */
    public $companyName = "";

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
}