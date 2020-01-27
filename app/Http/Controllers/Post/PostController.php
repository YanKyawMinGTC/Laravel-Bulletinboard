<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 1) {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $user_post = $user->post()->get();
            if (count($user_post) > 0) {
                return view('post.post_list')->with('posts', $user_post);
            } elseif (count($user_post) == 0) {
                return view('post.post_list')->withMessage("No Post Found");
            }
        } elseif (auth()->user()->type == 0) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(100);
            if (count($posts) > 0) {
                return view('post.post_list')->with('posts', $posts);
            } elseif (count($posts) == 0) {
                return view('post.post_list')->withMessage("No Post Found");
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create")
            ->with("user", $user);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Post::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'created_at' => now(),
            "create_user_id" => auth()->user()->id,
            "updated_user_id" => auth()->user()->id,
        ]);
        $user->save();
        return redirect('/posts');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.post_detail')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (auth()->user()->type == 0) {
            if (auth()->user()->id !== $post->create_user_id) {
                return redirect('/posts')->with('error', 'Unauthorized Page');
            } else {
                return view("post.update_post")->with('post', $post);
            }
        } else {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->updated_user_id = auth()->user()->id;
        $post->updated_at = now();
        $post->save();
        return redirect()->route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_id = Post::findOrFail($id);
        $post_id->deleted_user_id = auth()->user()->id;
        $post_id->save();
        $post_id->delete();
        return redirect()->route("posts.index");
    }


    public function confirm_create(Request $request)
    {
        $VData = $request->validate([
            "title" => "required|min:4|max:255|unique:posts",
            "description" => "required|min:3|max:255",
        ]);
            return view('post.create_post_confirm')->with("posts",$VData);
    }
    public function confirm_update(Request $request)
    {
        $post_id=$request['id'];
        $validate_post = $request->validate([
            "title" => "required|min:4|max:255|unique:posts",
            "description" => "required|min:3|max:255",
            "status"=>""
        ]);
            return view('post.update_post_confirm')->with("posts",$validate_post)->with("post_id",$post_id);
    }

}