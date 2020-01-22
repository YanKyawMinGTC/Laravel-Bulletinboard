<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\AuthDaoInterface;
use App\Contracts\Services\Post\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    private $authDao;

    /**
     * Class Constructor
     * @param AuthDaoInterface
     * @return
     */
    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }
}