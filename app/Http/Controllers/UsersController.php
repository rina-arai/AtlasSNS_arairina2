<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProRequest;
use App\Post;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    public function profile(Request $request){
        $user = Auth::user();
        // フォロー数
        $following_count = $user->follows()->pluck('following_id');
        // フォロワー数
        $followed_count = $user->followUsers()->pluck('followed_id');

        // 対象ユーザーのidを取得
        $users = User::find($request->id);
        // 対象ユーザーの投稿を取得 whereIn句は複数のデータを取得
        // Postモデルのデータベースの中で、user_idカラムが、$usersになっているデータを更新時間順に全て取得。
        // これを、変数$postsの中に格納する
        $posts = Post::whereIn('user_id', $users)->latest()->get();
        return view('/users/profile',['user'=>$user,'users'=>$users,'posts'=>$posts,'following_count'=>$following_count,'followed_count'=>$followed_count,]);
    }

    // プロフィール編集
    public function profileUpdate(ProRequest $request)
    {
        $user = Auth::user();

        $update = [
        'username' => $request->input('username'),
        'mail' => $request->input('mail'),
        'bio' => $request->input('bio'),
    ];

    // パスワードが入力された場合のみ更新
    // filled() 指定したキーの有無 && 値が入力されているか、キーが存在しており、かつ値が入力されていたらtrue。
    if ($request->filled('password')) {
       // $update配列に'password'というキーに対して、バリデーションを実装
        // $変数[''] = ;←連想配列における要素の追加や更新を 行うためのコード
        $update['password'] = bcrypt($request->input('password'));
    }

    // 画像が入力された場合のみ更新
    // filled() 指定したキーの有無 && 値が入力されているか、キーが存在しており、かつ値が入力されていたらtrue。
    if ($request->filled('image')) {
       // $update配列に'images'というキーに対して、バリデーションを実装
        // $変数[''] = ;←連想配列における要素の追加や更新を 行うためのコード
        $file = $request->file('image')->store('public')->getClientOriginalName();
        $path = Storage::url($file); // 画像のパスを生成
        $update['images'] = $path;
    }

    // まとめてupdate関数
    $user->update($update);

    return redirect('posts/index');
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

        // return view('/users/profile',['user'=>$user,'users'=>$users]);
        return back();
    }

    // フォロー解除
    public function unfollow(Request $request,$followed_id) {
        // 削除するユーザーのidを取得
        $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $followed_id)->first();
        $follow->delete();

        $user = Auth::user();
        $users = User::get();
        // return view('/users/profile',['user'=>$user,'users'=>$users]);
        return back();
    }

    // 検索機能の実行
    public function search(Request $request){

        $user = Auth::user();
        // フォロー数
        $following_count = $user->follows()->pluck('following_id');
        // フォロワー数
        $followed_count = $user->followUsers()->pluck('followed_id');

        // 検索フォームで入力された値を取得する
        $keyword = $request->input('users');
        // dump($keyword);

        // データベースに問い合わせ
            if (!empty($keyword)) {
                // dd($keyword);
            $query = User::query();
            $query->where('username', 'LIKE', "%{$keyword}%");
            $users = $query->get();
            return view('/users/search',['users'=>$users,'user'=>$user,'keyword'=>$keyword,'following_count'=>$following_count,'followed_count'=>$followed_count]);
            }
            else{
                $users = User::get();
          return view('/users/search',['users'=>$users,'user'=>$user,'keyword'=>$keyword,'following_count'=>$following_count,'followed_count'=>$followed_count]
          );
        }
    }




}
