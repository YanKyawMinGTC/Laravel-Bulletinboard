<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $VData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/', 'confirmed'],
            'type' => ['required'],
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle File Upload
        if ($request->hasFile('profile')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
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
        } else {
            dd("Profile not found");
        }
        $user = User::create([
            'name' => $VData['name'],
            'email' => $VData['email'],
            'password' => Hash::make($VData['password']),
            'type' => $VData['type'],
            'phone' => $request['phone'],
            'dob' => $request['dob'],
            'address' => $request['address'],
            'profile' => $fileNameToStore,
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
        $user = User::find($id);
        if (auth()->user()->type == 1 || auth()->user()->type == 0) {
            return view("user.update_user")->with('users', $user);
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
        $VData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'type' => ['required'],
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
// Handle File Upload
        if ($request->hasFile('profile')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            // Get just filename
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
        } else {
            dd("Profile not found");
        }
        $user = User::find($id);
        $user->name = $VData['name'];
        $user->email = $VData['email'];
        $user->type = $VData['type'];
        $user->profile = $fileNameToStore;
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->dob = $request['dob'];
        $user->updated_user_id = auth()->user()->id;
        $user->updated_at = now();
        $user->save();
        return route('users.show', auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = User::findOrFail($id);
        $user_id->delete();
        return redirect()->route("users.index");
    }
    public function change_password($id)
    {
        dd($id);
        $user = User::find($id);
        return view("user.change_password");
    }
}