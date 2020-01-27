<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post_search(Request $request)
    {

        $q = trim($request['search_keyword']);
        $user_type = auth()->user()->type;
        $user_id = auth()->user()->id;
        if ($q == "") {
            return view('post/post_list')->withQuery($q)->withMessage("Please...enter your title, description or Posted User !");
        } else {
            if ($user_type == 0) {
                $post = User::join('posts', 'posts.create_user_id', 'users.id')
                    ->where('users.name', $q)
                    ->pluck('posts.create_user_id')->first();
                $posts = Post::where('title', 'like', '%' . $q . '%')
                    ->orwhere('description', 'like', '%' . $q . '%')
                    ->orwhere('create_user_id', 'like', '%' . $post . '%')
                    ->paginate(100)
                    ->withPath('?search=' . $q);
                if (count($posts) > 0) {
                    return view('post/post_list')->with("posts", $posts)->withQuery($q);
                } else {
                    return view('post/post_list')->withQuery($q)->withMessage("No Search Details found. Try to search again !");
                }
            } elseif ($user_type == 1) {
                $user = Post::where('id', 'LIKE', '%' . $user_id . '%')->where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->paginate(10);
                if (count($user) > 0) {
                    return view('post/post_list')->with("posts", $user)->withQuery($q);
                } else {
                    return view('post/post_list')->withQuery($q)->withMessage("No Search Details found. Try to search again !");
                }

            }
        }
    }
    public function user_search(Request $request)
    {
        $q = trim($request['search_keyword']);

        $name = $request->name;
        $email = $request->email;
        $created_from = $request->created_from;
        $created_to = $request->created_to;
        if ($q == "") {
            return view('user/user_list')->withQuery($q)->withMessage("Please...enter your name or email !");
        } else {
            $Game = User::query();

            if ($name) {
                $Game->where('name', 'like', '%' . $name . '%');
            }
            if ($email) {
                $Game->where('email', 'like', '%' . $email . '%');
            }
            if (count($user) > 0) {
                return view('user/user_list')->with("users", $user)->withQuery($q);
            } else {
                return view('user/user_list')->withQuery($q)->withMessage("No Search Details found. Try to search again !");
            }
        }

    }
}
