<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Auth;
use Hash;

class UserDao implements UserDaoInterface
{
    /**
     * Get Operator List
     * @param Object
     * @return $operatorList
     */
    public function getUserList()
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
            'user_table1.name as created_user_name',
            'user_table2.name as updated_user_name'
        )
            ->join('users as user_table1', 'user_table1.id', 'users.create_user_id')
            ->join('users as user_table2', 'user_table2.id', 'users.updated_user_id')
            ->orderBy('users.updated_at', 'DESC')
            ->paginate(10);
        return $users;
    }
    public function store($auth_id, $user_new)
    {
        $user = User::create([
            'name' => $user_new['name'],
            'email' => $user_new['email'],
            'password' => Hash::make($user_new['password']),
            'phone' => $user_new['phone'],
            'type' => $user_new['type'],
            'dob' => $user_new['dob'],
            'address' => $user_new['address'],
            'profile' => $user_new['profile'],
            'create_user_id' => $auth_id,
            'updated_user_id' => $auth_id,
        ]);
        $user->save();
        return $user;
    }
    public function edit($id)
    {
        $user = User::find($id);
        return $user;
    }
    public function update($user_update)
    {
        $user = User::find($user_update['id']);
        $user->name = $user_update['name'];
        $user->email = $user_update['email'];
        $user->type = $user_update['type'];
        $user->profile = $user_update['profile'];
        $user->phone = $user_update['phone'];
        $user->address = $user_update['address'];
        $user->dob = $user_update['dob'];
        $user->updated_user_id = auth()->user()->id;
        $user->updated_at = now();
        $user->save();

        return $user;
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_user_id = auth()->user()->id;
        $user->save();
        $user->delete();
        return $user;
    }
    public function changePassword($user_new_pass)
    {
        $user = Auth::user();
        $user->password = bcrypt($user_new_pass);
        $user->updated_user_id = Auth::user()->id;
        $user->updated_at = now();
        $user->save();
    }
    public function searchUser($name, $email, $created_from, $created_to)
    {
        $search_value = User::
            when($name, function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        })
            ->when($email, function ($query) use ($email) {
                $query->orWhere('email', 'like', '%' . $email . '%');
            })
            ->when($created_from, function ($query) use ($created_from) {
                $query->orWhere('created_at', '>=', $created_from);
            })
            ->when($created_to, function ($query) use ($created_to) {
                $query->orWhere('created_at', '<=', $created_to);
            })->paginate(10);
        return $search_value;
    }
}
