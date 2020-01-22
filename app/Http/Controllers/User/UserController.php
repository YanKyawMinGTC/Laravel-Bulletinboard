<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(100);

        return view("user.user_list")->with('users', $users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.create")
            ->with("user", $user);

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
        // dd($user);
        if (auth()->user()->type == 1) {
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
            "name" => 'required|min:4|max:255|unique:users',
            'email' => 'required|min:3|email|',
            'profile' => 'required|min:3|max:255',
        ]);
        $user = User::find($id);
        $user->name = $VData['name'];
        $user->email = $VData['email'];
        $user->profile = $VData['profile'];
        $user->type = $VData['type'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->dob = $request['dob'];
        $user->updated_user_id = auth()->user()->id;
        $user->updated_at = now();
        $user->save();
        return redirect()->route("users.index");

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
}