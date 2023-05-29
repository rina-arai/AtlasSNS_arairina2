<?php

namespace App;
use Illuminate\Foundation\Auth\Follow as Authenticatable;
use Illuminate\Database\Eloquent\Model;

// Followモデルは正しくModelを継承
class Follow extends Model
{
    protected $fillable = ['following_id', 'followed_id'];

    protected $table = 'follows';

}
