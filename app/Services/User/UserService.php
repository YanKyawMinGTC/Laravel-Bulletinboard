<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get User List
     * @param Object
     * @return $userList
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }
    public function store($auth_id, $user_new)
    {
        return $this->userDao->store($auth_id, $user_new);
    }
    public function edit($id)
    {
        return $this->userDao->edit($id);
    }
    public function update($user_update)
    {
        return $this->userDao->update($user_update);
    }
    public function delete($id)
    {
        return $this->userDao->delete($id);
    }
    public function changePassword($user_new_pass)
    {
        return $this->userDao->changePassword($user_new_pass);
    }
    public function searchUser($name, $email, $created_from, $created_to)
    {
        return $this->userDao->searchUser($name, $email, $created_from, $created_to);
    }

}