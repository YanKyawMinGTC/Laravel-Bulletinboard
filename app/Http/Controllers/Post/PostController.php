<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Export\ExportExcel;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Services\Post\PostService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{

    private $postService;

    public function __construct(PostServiceInterface $post)
    {
        $this->middleware('auth');
        $this->postService = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = auth()->user()->id;
        $user_type = auth()->user()->type;
        $posts = $this->postService->getPost($auth_id, $user_type);
        // dd($posts);
        if (count($posts) > 0) {
            // dd("post has");
            return view('post.postList')->with('posts', $posts);
        } elseif (count($posts) == 0) {
            // dd("hello ");
            return view('post.postList')->withMessage("No Post Found");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $VData = $request->validate([
            "title" => "required|min:4|max:255|unique:posts",
            "description" => "required|min:3|max:255",
        ]);
        return view('post.createPostConfirm')->with("posts", $VData);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_id = auth()->user()->id;
        $post_new = new Post;
        $post_new->title = $request['title'];
        $post_new->description = $request['description'];
        $post = $this->postService->store($auth_id, $post_new);
        return redirect('/posts');
    }
    /**
     * Display the specified resource.
     * post detail show
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->edit($id);
        if (auth()->user()->id !== $post->create_user_id) {
            return redirect('/posts')->with('success', 'Posted User is no allowed!');
        } else {
            return view("post.updatePost")->with('post', $post);
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
        $post_update = new Post;
        $post_update->id = $id;
        $post_update->title = $request['title'];
        $post_update->description = $request['description'];
        if ($request['status'] == null) {
            $post_update->status = 0;
        } else {
            $post_update->status = 1;

        }
        $post = $this->postService->update($post_update);
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
        $post = $this->postService->delete($id);
        return redirect()->route("posts.index");
    }

    public function confirm_create(Request $request)
    {
        $VData = $request->validate([
            "title" => "required|min:4|max:255|unique:posts",
            "description" => "required|min:3|max:255",
        ]);
        return view('post.createPostConfirm')->with("posts", $VData);
    }
    public function confirm_update(Request $request)
    {
        $post_id = $request['id'];
        $validate_post = $request->validate([
            "title" => "required|min:4|max:255|unique:posts",
            "description" => "required|min:3|max:255",
            "status" => "",
        ]);
        return view('post.updatePostConfirm')->with("posts", $validate_post)->with("post_id", $post_id);
    }
    public function import(Request $request)
    {
        $auth_id = auth()->user()->id;
        $VData = $request->validate([
            'file' => 'required|max:2048',
        ]);
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();

        if ($extension != 'csv') {
            return redirect()->back()->withInvalid('The file must be a file of type: csv.');
        }
        $fileName = $file->getClientOriginalName();
        $save_path = public_path('/upload/' . $auth_id . '/');
        $file->move($save_path, $fileName);
        $filepath = public_path() . '/upload/' . $auth_id . '/' . $fileName;
        $import_csv_file = $this->postService->import($auth_id, $filepath);
        return redirect()->intended('posts')->withSuccess('Csv file upload successfully.');
    }
    public function export()
    {
        return Excel::download(new ExportExcel, 'posts.xlsx');
    }
    public function search(Request $request)
    {
        $search_keyword = trim($request['search_keyword']);
        $user_type = auth()->user()->type;
        $user_id = auth()->user()->id;
        if ($search_keyword == "") {
            return view('post/postList')->withQuery($search_keyword)->withMessage("Please...enter your title, description or Posted User !");
        } else {
            $posts = $this->postService->searchPost($search_keyword, $user_type, $user_id);
            if (count($posts) > 0) {
                return view('post/postList')->with("posts", $posts)->withQuery($search_keyword);
            } else {
                return view('post/postList')->withQuery($search_keyword)->withMessage("No Search Details found. Try to search again !");
            }
        }
    }

}