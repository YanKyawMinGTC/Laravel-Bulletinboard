<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'status', 'create_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at'];

    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $date = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }
}
