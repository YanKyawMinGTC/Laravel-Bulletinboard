<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postDao;

    /**
     * Class Constructor
     * @param PostDaoInterface
     * @return
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }
    /**
     * Get Posts List
     * @param Object
     * @return $posts
     */
    public function getPost($auth_id, $user_type)
    {
        return $this->postDao->getPost($auth_id, $user_type);
    }
    public function store($auth_id, $post_new)
    {
        return $this->postDao->store($auth_id, $post_new);
    }
    public function edit($id)
    {
        return $this->postDao->edit($id);
    }
    public function update($post_update)
    {
        return $this->postDao->update($post_update);
    }
    public function delete($id)
    {
        return $this->postDao->delete($id);
    }
    public function import($auth_id, $filepath)
    {
        return $this->postDao->import($auth_id, $filepath);
    }
    public function searchPost($search_keyword, $user_type, $user_id)
    {
        return $this->postDao->searchPost($search_keyword, $user_type, $user_id);
    }

}
