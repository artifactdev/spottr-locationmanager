<?php
use FlorianWolters\Component\Core\StringUtils;
/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class UserManager
{

    /**
     * List with all existing Roles.
     *
     * @var array
     */
    private $roles = array();

    /**
     * Default Constrcutor.
     */
    public function __construct()
    {
        $this->loadRoles();
    }

    /**
     * Loads all existing Roles from the database.
     */
    private function loadRoles()
    {
        $dbResult = DatabaseUtils::query("SELECT * FROM `roles` WHERE 1");
        while ($row = mysql_fetch_array($dbResult)) {
            $this->roles[$row['uuid']] = $row['name'];
        }
    }

    /**
     * Creates an user if not exists.
     *
     * @param User $user
     *            The user to create.
     * @return User the created User.
     * @throws UserException
     */
    public function createUser(User $user)
    {
        if ($user == null) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        if ($this->existsEmailAddress($user->email)) {
            throw new UserException(UserErrorType::THROW_EMAIL_ADDRESS_ALREADY_EXISTS);
        }

        $sqlArgs = $user->wrapModelToDatabase();
        DatabaseUtils::query(
            "INSERT INTO `users` (`email`, `password`, `first_name`, `last_name`, `search_address`, `longitude`, `latitude`) VALUES ('{EMAIL}', '{PASSWORD}', '{FIRSTNAME}', '{LASTNAME}', '{SEARCHADDRESS}', '{LONGITUDE}', '{LATITUDE}')",
            $sqlArgs);

        $userId = DatabaseUtils::insertId();
        $user->id = $userId;
        $this->assignRoles($user);

        return $this->findUser($user->id);
    }

    /**
     * Checks if the given roleId exists.
     *
     * @param string $roleId
     *            Id of a role to check
     * @return boolean
     */
    public function existsRole($roleId)
    {
        if (StringUtils::isBlank($roleId)) {
            return false;
        }
        return key_exists($roleId, $this->roles);
    }

    /**
     * Removes all roles from the given user.
     *
     * @param string $userId
     *            Id of the User from which all role should be removed.
     */
    private function removeAllRolesFromUser($userId)
    {
        $sqlArgs = array(
            "ID" => $userId
        );
        DatabaseUtils::query("DELETE FROM `roles_to_users` WHERE `user_uuid` = {ID}", $sqlArgs);
    }

    /**
     * Check whether the email address exists already.
     *
     * @param string $email
     *            Email address to check.
     * @return boolean Exists email address.
     */
    private function existsEmailAddress($email)
    {
        $sqlArgs = array(
            "EMAIL" => $email
        );
        $numberOfItems = DatabaseUtils::numRows("SELECT * FROM `users` WHERE `email` LIKE '{EMAIL}'", $sqlArgs);
        return $numberOfItems > 0;
    }

    /**
     * Deletes an user.
     *
     * @param string $userId
     *            Id of the user to delete.
     * @return boolean.
     */
    public function deleteUser($userId)
    {
        if (StringUtils::isBlank($userId)) {
            return true;
        }

        $secContextHolder = SecurityContextHolder::getInstance();
        $currentLoggedInUserId = $secContextHolder->getSecurityContext()->authenticationInfo->userUUId;
        if ($currentLoggedInUserId == $userId) {
            throw new UserException(UserErrorType::THROW_PERMISSION_DENIED);
        }

        $sqlArgs = array(
            "ID" => $userId
        );
        $this->removeAllRolesFromUser($userId);
        DatabaseUtils::query("DELETE FROM `users` WHERE `uuid` = {ID}", $sqlArgs);

        return true;
    }

    /**
     * Updates an user.
     *
     * @param User $user
     *            User to update.
     * @return User updated User Object.
     * @throws UserException
     */
    public function updateUser($user)
    {
        if ($user == null) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }
        // check if user exists
        $this->findUser($user->id);

        $sqlArgs = $user->wrapModelToDatabase();

        $query = "UPDATE `users` SET `first_name` = '{FIRSTNAME}', `last_name`  = '{LASTNAME}', `search_address` = '{SEARCHADDRESS}', `longitude` = '{LONGITUDE}', `latitude` = '{LATITUDE}'";
        if (! StringUtils::isBlank($user->password)) {
            $query .= ", `password` = '{PASSWORD}' ";
        }
        $query .= " WHERE `uuid` = {ID}";

        DatabaseUtils::query($query, $sqlArgs);

        $this->assignRoles($user);
        return $this->findUser($user->id);
    }

    /**
     * Finds an user by its id.
     *
     * @param string $userId
     *            Unique identification number of the user.
     * @return User The fully filled user object.
     * @throws UserException If no user exists with the given id.
     */
    public function findUser($userId)
    {
        if (StringUtils::isBlank($userId)) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        $user = DatabaseUtils::fetchResult("SELECT * FROM `users` WHERE `uuid` = {ID}", new User(),
            array(
                "ID" => $userId
            ));

        if ($user == null) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        $this->loadRolesOfUser($user);
        return $user;
    }

    /**
     * Finds an user by its email address.
     *
     * @param string $email
     *            Email address of the user.
     * @param string $password
     *            Password of the user.
     * @return User The fully filled user object.
     * @throws UserException If no user exists with the given id.
     */
    public function findUserByEmailAndPassword($email, $password)
    {
        if (StringUtils::isBlank($email) || StringUtils::isBlank($password)) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        $user = DatabaseUtils::fetchResult("SELECT * FROM `users` WHERE `email` LIKE '{EMAIL}' AND `password` LIKE '{PASSWORD}'", new User(),
            array(
                "EMAIL" => $email,
                "PASSWORD" => $password
            ));

        if ($user == null) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        $this->loadRolesOfUser($user);
        return $user;
    }

    /**
     * Loads the roles of an user.
     * @param User $user User to load the roles for.
     */
    private function loadRolesOfUser($user) {
        $sql = "SELECT `r`.`uuid` FROM `roles_to_users` `rtu` LEFT JOIN `roles` `r` ON `r`.`uuid` = `rtu`.`role_uuid` WHERE `rtu`.`user_uuid` = {ID}";
        $dbResult = DatabaseUtils::query($sql, array("ID" => $user->id));
        while($row = mysql_fetch_array($dbResult)) {
            $user->roles[] = $row['uuid'];
        }
    }

    /**
     * Find all existing users.
     *
     * @return Collection List of all users.
     */
    public function findUsers()
    {
        $users = DatabaseUtils::fetchResultList("SELECT * FROM `users` WHERE 1", "User");

        foreach ($users->items as $user) {
            $this->loadRolesOfUser($user);
        }
        $users->numberOfItems = count($users->items);

        return $users;
    }

    /**
     * Returns all existing roles.
     *
     * @return array List of all existing roles.
     */
    public function getAllRoles()
    {
        return $this->roles;
    }
    
    /**
     * This method assign all setted roles of the given user object to the user.
     * Not given roles will be removed.
     *
     * @param User $user
     *            User object, of which the roles should be setted.
     * @throws UserException
     */
    private function assignRoles($user)
    {
        if (! is_array($user->roles) || count($user->roles) == 0) {
            return;
        }
    
        $userId = $user->id;
        $this->removeAllRolesFromUser($userId);
    
        foreach ($user->roles as $role) {
            if (! $this->existsRole($role)) {
                throw new UserException(UserErrorType::THROW_USERROLE_NOT_EXISTS);
            }
            $sqlArgs = array(
                "USER_ID" => $userId,
                "ROLE_ID" => $role
            );
    
            $sql = "INSERT INTO `roles_to_users` (`user_uuid`, `role_uuid`) VALUES ('{USER_ID}', '{ROLE_ID}')";
            DatabaseUtils::query($sql, $sqlArgs);
        }
    }
    
}
