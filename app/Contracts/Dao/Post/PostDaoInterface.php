<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    //get post list
    public function getPost($auth_id, $user_type);
    //get create post
    public function store($auth_id, $post_new);
}