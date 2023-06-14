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

//ログイン中のページ
Route::get('/posts/index','PostsController@index');

// 新規投稿について
Route::post('/posts/create','PostsController@create');

// 投稿の編集について
Route::put('/posts/update','PostsController@update');

// 投稿の削除について
Route::get('/posts/{id}/delete','PostsController@delete');

// プロフィールページ表示
Route::get('/users/{id}/profile','UsersController@profile');

// プロフィール更新
Route::post('/users/profile/update','UsersController@profileUpdate');

// プロフィールページ フォロー/フォロー解除を追加
Route::post('/users/profile{followed_id}/follow', 'UsersController@follow')->name('follow_p');
Route::DELETE('/users/profile{followed_id}/unfollow', 'UsersController@unfollow')->name('unfollow_p');

// 検索ページ表示
Route::get('/users/search','UsersController@search');

// フォロー/フォロー解除を追加
Route::post('/users/search{followed_id}/follow', 'FollowsController@follow')->name('follow');
Route::DELETE('/users/search{followed_id}/unfollow', 'FollowsController@unfollow')->name('unfollow');

// フォロー/フォロワーリストの表示
Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
