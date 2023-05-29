<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'username', 'mail', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // usersテーブルのデータをクエリで引き出す際に、関連する投稿も出せるよう
    // 投稿者は複数の投稿をもつ
    public function posts(){
        return $this->hasMany('App\Post');
    }

// 第一引数には使用するモデル
// 第二引数には使用するテーブル名
// 第三引数にはリレーションを定義しているモデルの外部キー名(取得したい情報)自分のid
// 第四引数には結合するモデルの外部キー名(あまりもの)
    // フォロワー→フォロー(自分のことをフォローしているユーザーを探す)
    public function followUsers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    // フォロー→フォロワー(自分がフォローしているユーザーを探す)
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followUsers()->where('following_id', $user_id)->first(['follows.id']);
    }

}
