<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }



    // フォローリスト
    public function followList(){
        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $users = User::find($following_id);
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();
        $user = Auth::user();
        // フォロー数
        $following_count = $user->follows()->pluck('following_id');
        // フォロワー数
        $followed_count = $user->followUsers()->pluck('followed_id');
        return view('follows.follow_list',['following_id'=>$following_id,'users'=>$users,'posts'=>$posts,'following_count'=>$following_count,'followed_count'=>$followed_count,]);
    }




// フォロワーーリスト
    public function followerList(){
        // フォローしているユーザーのidを取得
        $followed_id = Auth::user()->followUsers()->pluck('following_id');
        $users = User::find($followed_id);
        $posts = Post::query()->whereIn('user_id', Auth::user()->followUsers()->pluck('following_id'))->latest()->get();
        // フォロー数
        $following_count = Auth::user()->follows()->pluck('following_id');
        // フォロワー数
        $followed_count = Auth::user()->followUsers()->pluck('followed_id');
        return view('follows.follower_list',['followed_id'=>$followed_id,'users'=>$users,'posts'=>$posts,'following_count'=>$following_count,'followed_count'=>$followed_count,]);
    }




    // フォロー
    public function follow(Request $request,$followed_id) {
        $user = Auth::user();
        $users = User::get();
        $follow = Follow::create([
            // フォローするのは自分なので,認証ユーザー＝フォローユーザー
            'following_id' => \Auth::user()->id,
            // 暗黙の結合などを使ってフォローされる相手のIDを$user->idで取得できるように
            'followed_id' => $followed_id,
            // ↑上記２つを使ってインスタンスを生成
        ]);
        return back();
    }




    // フォロー解除
    public function unfollow(Request $request,$followed_id) {
        // 削除するユーザーのidを取得
        $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $followed_id)->first();
        $follow->delete();
        $user = Auth::user();
        $users = User::get();
        return back();
    }


}
