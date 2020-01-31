<?php

namespace App\Models;

use App\Models\Post;
// use App\Notifications\UserResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'phone', 'dob', 'address', 'profile', 'create_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at',
    ];
    protected $date = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function post()
    {
        return $this->hasMany(Post::class, 'create_user_id');
    }
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new UserResetPassword($token));
    // }

}