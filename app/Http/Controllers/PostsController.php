<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Http\Requests\UpdatePostRequest;
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
        $post = Post::get();
        $user = Auth::user();
        return view('posts.index',['post'=>$post],['user'=>$user]);
    }



    // 投稿内容の登録処理！！！
    public function create(NewPostRequest $request)
    {
        $post = $request->input('newPost');
        // $post->user_id = auth()->user()->id;
        Post::create(['post' => $post,'user_id' => auth()->user()->id]);
        return redirect('posts/index');
    }

    // 投稿内容の編集処理！！！(バリデーションまだ)
    public function update(UpdatePostRequest $request)
{
    $post = Post::find($request->id);
    $post->update([
        "post" => $request->post,
    ]);

    return redirect("posts/index");
}

// 投稿内容の削除処理！！！要確認\DB::table
public function delete(Request $request)
    {
        // dd(123);
        $post = Post::find($request->id);
        // \DB::table('posts')
        // ->where('id', $id)
        $post->delete(["post" => $request->post,]);
        return redirect("posts/index");

    }

}
