<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // ↓指定したカラムに対してのみ、 createやupdateなどが可能
    protected $fillable = [
        'post'
    ];
}
