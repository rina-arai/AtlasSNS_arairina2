<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view('users.profile');
    }
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
