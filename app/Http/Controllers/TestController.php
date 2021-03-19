<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function getPostsByUser()
    {

        $posts = Post::query()
            ->select(['id','title','content','active','user_id'])
            ->with('user:id,name')
//            ->latest('created_at')
            ->simplePaginate();
//        dd($posts);
        return view('home', compact('posts'));
    }
}
