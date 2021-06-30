<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $guarded = array('id');

    public static $rules = array (
        "title" => "required",
        "reward_point" => "required",
    );
    
    public function user() 
    {
        return $this->belongTo('App\User');
    }
    
}
