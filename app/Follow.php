<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $fillable = [
        'id', 'following_id', 'followed_id'
    ];


}
