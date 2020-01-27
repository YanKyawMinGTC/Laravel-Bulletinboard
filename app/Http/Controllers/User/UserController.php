<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends Controller
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
    public function index_old()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(100);
        return view("user.user_list")->with('users', $users);
    }
    public function index()
    {
        $users = User::select(
            'users.name',
            'users.email',
            'users.phone',
            'users.dob',
            'users.address',
            'users.created_at',
            'users.updated_at',
            'users.id',
            'u1.name as created_user_name')
            ->join('users as u1', 'u1.id', 'users.create_user_id')
            ->orderBy('users.updated_at', 'DESC')
            ->paginate(50);
        return view("user.user_list")->with('users', $users);
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
        if($request['type']=='Admin'){
            $request['type'] = "0";
        }else{
            $request['type'] = "1";
        }
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'type' => $request['type'],
            'dob' => $request['dob'],
            'address' => $request['address'],
            'profile' =>$request['profile'],
            'create_user_id' => auth()->user()->id,
            'updated_user_id' => auth()->user()->id,
        ]);
        $user->save();
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
        $user_profile = User::find($id);
        return view('user.user_profile')->with('user_prof', $user_profile);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->id==$id){
            $user = User::find($id);
                return view("user.update_user")->with('users', $user);
        }else{
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
        if($request['type']=='Admin'){
            $request['type'] = "0";
        }else{
            $request['type'] = "1";
        }
        $user_update = User::find($id);
        $user_update->name = $request['name'];
        $user_update->email = $request['email'];
        $user_update->type = $request['type'];
        $user_update->profile = $request['profile'];
        $user_update->phone = $request['phone'];
        $user_update->address = $request['address'];
        $user_update->dob = $request['dob'];
        $user_update->updated_user_id = auth()->user()->id;
        $user_update->updated_at = now();
        $user_update->save();
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
        if(auth()->user()->id < $id || auth()->user()->id != $id ){
            $user_id = User::findOrFail($id);
            $user_id->deleted_user_id = auth()->user()->id;
            $user_id->save();
            $user_id->delete();
            return redirect()->route("users.index");
        }else{
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
            'phone'=>[],
            'dob'=>[],
            'address'=>[],
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
            return view('user.create_user_confirm')->with("user_detail",$VData)->with("user_id",$user_id)->with("file_name",$fileNameToStore);
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
            'phone'=>[],
            'dob'=>[],
            'address'=>[],
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

            $user_id = User::latest()->first()->id;
            $img_dir = 'profile_img/' . $user_id . "/image";
            if (!file_exists($img_dir)) {
                File::makeDirectory($img_dir, $mode = 0777, true, true);
                $request->file('profile')->move($img_dir, $fileNameToStore);
            } else {
                $request->file('profile')->move($img_dir, $fileNameToStore);
            }
            return view('user.update_user_confirm')->with("user_detail",$validate_user)->with("user_id",$user_id)->with("file_name",$fileNameToStore);
        } else {
            dd("Profile not found");
        }
    }
    public function change_pass(Request $request)
    {
        if(!(Hash::check($request->get("old_password"),Auth::user()->password))){
            return back()->with('error',"Your current Password doesn't match");
        }
        if(strcmp($request->get("old_password"),$request->get("new_password")) == 0){
            return back()->with('error',"Your current Password cannot be the same with the new password");
        }
        // dd($request);
        $request->validate([
            "old_password"=>['required'],
            "new_password"=>['required','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/', 'confirmed']
        ]);
        $user= Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->with("message","Password changed successfully");
    }
}