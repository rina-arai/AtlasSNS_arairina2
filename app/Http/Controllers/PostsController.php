<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }



    // indexページ表示
    public function index(){
        $user = Auth::user();
        // $following_idは配列の形でないと、$postsでwhereInが使えない
        $following_id = $user->follows()->pluck('followed_id');
        // []で配列の宣言
        $following_id[] = $user->id; // ログインユーザー自身の投稿も含める場合はこの行を追加
        // user_id=$following_idのpostsテーブルの値を取得して新しい順に並べる
        // Where句に複数の値を指定したい(whereIn),getメソッドを使うと対象になった複数のデータを取得
        $posts = Post::whereIn('user_id', $following_id)->latest()->get();
        // フォロー数
        $following_count = $user->follows()->pluck('following_id');
        // フォロワー数
        $followed_count = $user->followUsers()->pluck('followed_id');
        return view('posts.index',['user'=>$user,'posts'=>$posts,'following_count'=>$following_count,'followed_count'=>$followed_count,]);
    }





    // 投稿内容の登録処理！！！
    public function create(NewPostRequest $request)
    {
        $post = $request->input('newPost');
        Post::create(['post' => $post,'user_id' => auth()->user()->id]);
        return redirect('posts/index');
    }




    // 投稿内容の編集処理！！！
    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->update([
            "post" => $request->post,
        ]);
        return redirect("posts/index");
    }




    // 投稿内容の削除処理！！！
    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete(["post" => $request->post,]);
        return redirect("posts/index");
    }

}
