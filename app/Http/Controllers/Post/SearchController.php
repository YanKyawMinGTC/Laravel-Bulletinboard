<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Services\Post\PostService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $post)
    {
        $this->postService = $post;
    }
    public function post_search(Request $request)
    {
        $search_keyword = trim($request['search_keyword']);
        $user_type = auth()->user()->type;
        $user_id = auth()->user()->id;
        if ($search_keyword == "") {
            return view('post/post_list')->withQuery($search_keyword)->withMessage("Please...enter your title, description or Posted User !");
        } else {
            $posts = $this->postService->searchPost($search_keyword, $user_type, $user_id);
            if (count($posts) > 0) {
                return view('post/post_list')->with("posts", $posts)->withQuery($search_keyword);
            } else {
                return view('post/post_list')->withQuery($search_keyword)->withMessage("No Search Details found. Try to search again !");
            }
        }
    }
    public function user_search(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $created_from = $request->created_from;
        $created_to = $request->created_to;
        if ($name == "" && $email == "" && $created_from == "" && $created_to == "") {
            return view('user/user_list')->withQuery($name)->withMessage("Enter Search Key");
        } else {
            if (request()->ajax()) {
                if (!empty($request->created_from)) {
                    $data = User::select('tbl_order')
                        ->whereBetween('order_date', array($request->created_from, $request->created_from))
                        ->get();
                } else {
                    $data = DB::table('tbl_order')
                        ->get();
                }
                return datatables()->of($data)->make(true);
            }
            return view('daterange');

        }

    }
}
