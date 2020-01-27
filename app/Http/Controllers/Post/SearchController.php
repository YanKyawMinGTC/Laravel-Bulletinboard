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
                $posts = Post::where('title', 'like', '%' . $q . '%')
                    ->orwhere('description', 'like', '%' . $q . '%')
                    ->orWhereHas('user', function ($query) use ($q) {
                        $query->where('name', 'like', '%' . $q . '%');
                    })
                    ->latest()
                    ->paginate(10)
                    ->withPath('?search=' . $q);
                if (count($posts) > 0) {
                    return view('post/post_list')->with("posts", $posts)->withQuery($q);
                } else {
                    return view('post/post_list')->withQuery($q)->withMessage("No Search Details found. Try to search again !");
                }
            } elseif ($user_type == 1) {
                $user = Post::where('create_user_id', 'LIKE', '%' . $user_id . '%')->where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->paginate(20);
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