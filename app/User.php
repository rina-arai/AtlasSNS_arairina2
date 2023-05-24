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


    // フォロー機能のリレーション
    public function following()
    {
        return $this->belongsToMany(User::class, 'id', 'followed_id', 'following_id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'id', 'following_id', 'followed_id');
    }

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->following()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->following()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->following()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followed()->where('following_id', $user_id)->first(['id']);
    }

}
