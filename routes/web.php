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
Route::get('/users/profile','UsersController@profile');

// 検索ページ表示
Route::get('/users/search','UsersController@search');



Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');
