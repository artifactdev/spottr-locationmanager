<?php

use FlorianWolters\Component\Core\StringUtils;
/**
 * All rights reserved - (c) 2013 Markus Jahn
 * mail: markus-jahn@gmx.net
 */
class UserController
{

    /**
     * @Autowired - UserManager
     *
     * @var UserManager
     *
     */
    public $userManager;

    /**
     * @Autowired - AuthenticationManager
     *
     * @var AuthenticationManager
     *
     */
    public $authenticationManager;

    /**
     * Controller method to get all users.
     *
     * @return Collection List with users.
     */
    public function listUsers()
    {
        $this->authenticationManager->checkRolePermission(UserRole::ADMINISTRATOR);

        return $this->userManager->findUsers();
    }

    /**
     * Controller method to update an user.
     *
     * @param string $id
     *            Id of the affected User.
     * @return User The updated User.
     * @throws UserException
     */
    public function updateUser($id)
    {
        $this->authenticationManager->checkRolePermission(UserRole::ADMINISTRATOR);

        if (StringUtils::isBlank($id)) {
            throw new UserException(UserErrorType::THROW_USER_NOT_FOUND);
        }

        /**
         *
         * @var $user User
         */
        $user = HTTPRequestHelper::getParamAsModel(new User());
        $user->id = $id;
        $this->validateUser($user);

        return $this->userManager->updateUser($user);
    }

    /**
     * Controller method to create a new user.
     *
     * @return User Created User object.
     * @throws UserException
     */
    public function createUser()
    {
        $this->authenticationManager->checkRolePermission(UserRole::ADMINISTRATOR);

        /**
         *
         * @var $user User
         */
        $user = HTTPRequestHelper::getParamAsModel(new User());
        $this->validateUser($user);

        return $this->userManager->createUser($user);
    }

    /**
     * Controller method to deletes an user.
     *
     * @return boolean
     */
    public function deleteUser($id)
    {
        $this->authenticationManager->checkRolePermission(UserRole::ADMINISTRATOR);

        return $this->userManager->deleteUser($id);
    }

    /**
     * Controller method to get an user.
     *
     * @return User
     */
    public function findUser($id)
    {
        if ($this->authenticationManager->hasUserRole(UserRole::ADMINISTRATOR)) {
            return $this->userManager->findUser($id);
        }

        return $this->userManager->findUser($this->authenticationManager->getCurrentUserId());
    }

    /**
     * Validated the user data.
     *
     * @param User $user
     *            User to validate.
     * @throws UserException
     */
    private function validateUser(User $user)
    {
        ValidationUtils::validate($user);
    }
}