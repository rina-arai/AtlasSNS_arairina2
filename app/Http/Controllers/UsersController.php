<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UsersController extends Controller
{
    //

/**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    // プロフィールページへ
    public function profile(){
        $user = Auth::user();
        return view('/users/profile',['user'=>$user]);
    }

    // 検索機能の実行
    public function search(Request $request){

        $user = Auth::user();

        // 検索フォームで入力された値を取得する
        $keyword = $request->input('users');
        dump($keyword);

        // データベースに問い合わせ
            if (!empty($keyword)) {
                dd($keyword);
            $query = User::query();
            $query->where('username', 'LIKE', "%{$keyword}%");
            $users = $query->get();
            return view('/users/search',['users'=>$users,'user'=>$user,'keyword'=>$keyword]);
            }
            else{
                $users = User::get();
          return view('/users/search',['users'=>$users,'user'=>$user,'keyword'=>$keyword]
          );
        }
    }




}
