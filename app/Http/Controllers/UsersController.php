<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        return view('users.profile');
    }

    // 検索ページへ
    public function search(){
        return view('users.search');
    }

// 検索
public function searchForm(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('users.search', compact('posts', 'keyword'));

}

}
