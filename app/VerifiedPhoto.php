<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifiedPhoto extends Model
{
    protected $fillable = ['photo_id'];

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
