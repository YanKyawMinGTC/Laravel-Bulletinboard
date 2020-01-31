<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $user)
    {
        $this->middleware('auth');
        $this->userService = $user;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 0) {
            $users = $this->userService->getUserList();
            if (count($users) > 0) {
                return view('user.userList', compact('users'));
            } elseif (count($users) == 0) {
                return view('user.userList')->withMessage("No Users Found");
            }
        } else {
            return redirect('/posts');
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
        if ($request['type'] == 'Admin') {
            $request['type'] = "0";
        } else {
            $request['type'] = "1";
        }
        $auth_id = auth()->user()->id;
        $user_new = new User;
        $user_new->name = $request['name'];
        $user_new->email = $request['email'];
        $user_new->password = Hash::make($request['password']);
        $user_new->phone = $request['phone'];
        $user_new->type = $request['type'];
        $user_new->dob = $request['dob'];
        $user_new->address = $request['address'];
        $user_new->profile = $request['profile'];
        $user_new->create_user_id = auth()->user()->id;
        $user = $this->userService->store($auth_id, $user_new);
        return redirect('/users');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.userProfile')->with('user_prof', $user);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = $this->userService->edit($id);
            return view("user.updateUser")->with('users', $user);
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
        if ($request['type'] == 'Admin') {
            $request['type'] = "0";
        } else {
            $request['type'] = "1";
        }
        $user_update = new User;
        $user_update->id = $id;
        $user_update->name = $request['name'];
        $user_update->email = $request['email'];
        $user_update->type = $request['type'];
        $user_update->profile = $request['profile'];
        $user_update->phone = $request['phone'];
        $user_update->address = $request['address'];
        $user_update->dob = $request['dob'];
        $user = $this->userService->update($user_update);
        return redirect()->route('users.show', auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id < $id || auth()->user()->id != $id) {
            $user = $this->userService->delete($id);
            return redirect()->route("users.index");
        } else {
            return redirect()->route("users.index");
        }
    }
    public function confirm_create(Request $request)
    {
        $VData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/', 'confirmed'],
            'type' => ['required'],
            'phone' => [],
            'dob' => [],
            'address' => [],
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle File Upload
        if ($request->hasFile('profile')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
            // dd($filenameWithExt);
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = strtolower($filename . '_' . date('Y_m_d') . '.' . $extension);
            $user_id = User::latest()->first()->id + 1;
            $img_dir = 'profile_img/' . $user_id . "/image";
            if (!file_exists($img_dir)) {
                File::makeDirectory($img_dir, $mode = 0777, true, true);
                $request->file('profile')->move($img_dir, $fileNameToStore);
            } else {
                $request->file('profile')->move($img_dir, $fileNameToStore);
            }
            return view('user.createUserConfirm')->with("user_detail", $VData)->with("user_id", $user_id)->with("file_name", $fileNameToStore);
        } else {
            dd("Profile not found");
        }
    }
    public function confirm_update(Request $request)
    {
        $validate_user = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'type' => ['required'],
            'phone' => [],
            'dob' => [],
            'address' => [],
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle File Upload
        if ($request->hasFile('profile')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
            // dd($filenameWithExt);
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = strtolower($filename . '_' . date('Y_m_d') . '.' . $extension);

            $user_id = auth()->user()->id;
            $img_dir = 'profile_img/' . $user_id . "/image";
            if (!file_exists($img_dir)) {
                File::makeDirectory($img_dir, $mode = 0777, true, true);
                $request->file('profile')->move($img_dir, $fileNameToStore);
            } else {
                $request->file('profile')->move($img_dir, $fileNameToStore);
            }
            return view('user.updateUserConfirm')->with("user_detail", $validate_user)->with("user_id", $user_id)->with("file_name", $fileNameToStore);
        } else {
            dd("Profile not found");
        }
    }
    public function showchangePass($id)
    {
        if(auth()->user()->id == $id){
            return view('user.changePassword');
        }else{
           return redirect('/posts')->with('changePass-notallowed','Change Password not supported for another user!');

        }
    }
    public function changePass(Request $request)
    {
        if (!(Hash::check($request->get("old_password"), Auth::user()->password))) {
            return back()->with('pass-notmatch', "Your Old Password doesn't match");
        }
        $request->validate([
    "old_password" => ['required'],
    "new_password" => ['required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/'],
     'new_confirm_password' => ['same:new_password'],
]);
        if (strcmp($request->get("old_password"), $request->get("new_password")) == 0) {
            return back()->with('pass-same', "Your current Password cannot be the same with the new password");
        }
        $user_new_pass = $request['new_password'];
        $user = $this->userService->changePassword($user_new_pass);
        return redirect('/posts')->withSuccess("Password changed successfully");
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $created_from = $request->created_from;
        $created_to = $request->created_to;
        if ($name == "" && $email == "" && $created_from == "" && $created_to == "") {
            return view('user/userList')->withQuery($name)->withMessage("Enter Search Key");
        } else {
            $search_value = $this->userService->searchUser($name, $email, $created_from, $created_to);
            return view('user/userList')->with("users", $search_value)->withQuery($name);
        }
    }
}