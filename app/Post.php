<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // ↓指定したカラムに対してのみ、 createやupdateなどが可能
    protected $fillable = [
        'post','user_id','image'
    ];

    // postコントローラーでUserテーブルを取得
    // 投稿は一つの投稿者に従属する
    public function user(){
        return $this->belongsTo('App\User');
    }

}
