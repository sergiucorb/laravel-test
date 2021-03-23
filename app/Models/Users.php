<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'users';


    public function posts(){
        return $this->hasMany(Post::class,'user_id');
    }


}
