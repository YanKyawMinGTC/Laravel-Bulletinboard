<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use App\Models\User;

class PostDao implements PostDaoInterface
{
    // getting Post list

    public function getPost($auth_id, $user_type)
    {
        if ($user_type == 1) {
            $user = User::find($auth_id);
            $posts = $user->post()->Orderby("created_at", "DESC")->paginate(10);

        } elseif ($user_type == 0) {
            $posts = Post::Orderby("created_at", "DESC")->paginate(10);
        }
        return $posts;
    }
    public function store($auth_id, $post_new)
    {
        $post = Post::create([
            'title' => $post_new['title'],
            'description' => $post_new['description'],
            'created_at' => now(),
            "create_user_id" => $auth_id,
            "updated_user_id" => $auth_id,
        ]);
        $post->save();
        return $post;
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return $post;
    }
    public function update($post_update)
    {
        $post = Post::find($post_update['id']);
        $post->title = $post_update['title'];
        $post->description = $post_update['description'];
        $post->status = $post_update['status'];
        $post->updated_user_id = auth()->user()->id;
        $post->updated_at = now();
        $post->save();
        return $post;
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->deleted_user_id = auth()->user()->id;
        $post->save();
        $post->delete();
        return $post;
    }
    /**
     * Import csf file
     * @param Object
     * @return $posts
     */
    public function import($auth_id, $filepath)
    {
        if (($handle = fopen($filepath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $post = new Post;
                $post->title = $data[0];
                $post->description = $data[1];
                $post->create_user_id = $auth_id;
                $post->updated_user_id = $auth_id;
                $post->save();
            }
            fclose($handle);
        }
        return back();
    }
    public function searchPost($search_keyword, $user_type, $user_id)
    {
        if ($user_type == 0) {
            $posts = Post::where('title', 'like', '%' . $search_keyword . '%')
                ->orwhere('description', 'like', '%' . $search_keyword . '%')
                ->orWhereHas('user', function ($query) use ($search_keyword) {
                    $query->where('name', 'like', '%' . $search_keyword . '%');
                })
                ->latest()

                ->withPath('?search=' . $search_keyword);
            return $posts;
        } elseif ($user_type == 1) {
            $user = Post::where('create_user_id', 'LIKE', '%' . $user_id . '%')->where('title', 'LIKE', '%' . $search_keyword . '%')->orWhere('description', 'LIKE', '%' . $search_keyword . '%')->paginate(20);
            return $posts;
        }

    }
}
