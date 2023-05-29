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

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
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

        return view('/users/search',['users'=>$users,'user'=>$user,]);
    }

    // フォロー解除
    public function unfollow(Request $request,$followed_id) {
        // 削除するユーザーのidを取得
        $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $followed_id)->first();
        $follow->delete();

        $user = Auth::user();
        $users = User::get();
        return view('/users/search',['users'=>$users,'user'=>$user,]);
    }


}
