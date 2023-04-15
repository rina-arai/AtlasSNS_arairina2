<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }

    // 投稿内容の登録処理
    public function create(Request $request)
    {
        $post = $request->input('newPost');
        Post::create(['post' => $post]);
        return redirect('posts.index');
    }

}
