<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function getPostsByUser()
    {
        $posts = Post::query()
            ->select(['id','title','content','active','user_id'])
            ->with('user:id,name')
            ->simplePaginate();
        return view('home', compact('posts'));
    }

    public function getUsers()
    {
        $posts = Users::query()
//            ->join('posts','users.id','=','posts.user_id')
//            ->select(['users.id','users.name','posts.id','posts.title','posts.content','posts.active'])
            ->select(['id','name'])
            ->with('posts:id,title,content,active')
            ->simplePaginate();
        return view('home', compact('posts'));
    }
}
