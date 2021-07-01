<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{
    public function DaysLeft()
    {
      return Carbon::now('Asia/Tokyo')->subDays(1)->addSeconds(1)->diffInDays($this->period);
    }
 
    protected $guarded = array('id');
    
    public static $rules = array(
      'title' => 'required',
      'period' => 'required',
      'user_point' => 'required',
      'death_point' => 'required',
    );

    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
