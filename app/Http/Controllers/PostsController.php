<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $list = Post::get();
        return view('posts.index',['list'=>$list]);
    }

    // 投稿内容の登録処理！！！
    public function create(NewPostRequest $request)
    {
        $post = $request->input('newPost');
        // $post->user_id = auth()->user()->id;
        Post::create(['post' => $post,'user_id' => auth()->user()->id]);
        return redirect('posts/index');
    }

}
