<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//ログアウト中のページ
// Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

// ログアウト
Route::get('/logout', 'Auth\LoginController@logout');

// 新規登録について
// Route::post('/register/create', 'Auth\RegisterController@register');
 Route::post('/register/create', 'Auth\RegisterController@postValidates');

// 登録完了後の画面表示
Route::get('/added', 'Auth\RegisterController@added');




// posts
Route::prefix('posts')->group(function() {
    //ログイン中のページ
    Route::get('/index','PostsController@index');

    // 新規投稿について
    Route::post('/create','PostsController@create');

    // 投稿の編集について
    Route::put('/update','PostsController@update');

    // 投稿の削除について
    Route::get('/{id}/delete','PostsController@delete');
});



// users
Route::prefix('users')->group(function() {
    // プロフィールページ表示
    Route::get('/{id}/profile','UsersController@profile');

    // プロフィール更新
    Route::post('/profile/update','UsersController@profileUpdate');

    // users/profile{followed_id}
    Route::prefix('profile{followed_id}')->group(function() {
        // プロフィールページ フォロー/フォロー解除を追加
        Route::post('/follow', 'UsersController@follow')->name('follow_p');
        Route::DELETE('/unfollow', 'UsersController@unfollow')->name('unfollow_p');
    });

    // 検索ページ表示
    Route::get('/search','UsersController@search');

    // users/search{followed_id}
    Route::prefix('search{followed_id}')->group(function() {
        // フォロー/フォロー解除を追加
        Route::post('/follow', 'FollowsController@follow')->name('follow');
        Route::DELETE('/unfollow', 'FollowsController@unfollow')->name('unfollow');
    });

});


// users
Route::prefix('follows')->group(function() {
    // フォロー/フォロワーリストの表示
    Route::get('/follow_list','FollowsController@followList');
    Route::get('/follower_list','FollowsController@followerList');
});
