<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // ↓指定したカラムに対してのみ、 createやupdateなどが可能
    protected $fillable = [
        'post','user_id','images'
    ];

    // postコントローラーでUserテーブルを取得
    public function user(){
        return $this->belongsTo('App\User');
      }

}
