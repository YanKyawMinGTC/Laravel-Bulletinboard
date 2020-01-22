<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request['search_keyword']);
        $user = Post::where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->paginate(10);
        if (count($user) > 0) {
            return view('post/post_list')->with("posts", $user)->withQuery($q);
        } else {
            return view('post/post_list')->withQuery($q)->withMessage("No Search Details found. Try to search again !");
        }
    }
}