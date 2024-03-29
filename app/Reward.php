<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Reward extends Model
{

    protected $guarded = array('id');

    public static $rules = array (
        "title" => "required | string | min: 5 ",
        "reward_point" => "integer",
    );

    protected $casts = [
        'time' => 'datetime',
    ];
    
    public function getRemainingdisplay(){
        return ($this->created_at)->diffInHours($this->time);
      }
    
}
