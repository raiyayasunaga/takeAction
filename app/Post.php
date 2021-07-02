<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{

    protected $casts = [
      'period' => 'datetime'
    ];

    // phpは全てが
 
    protected $guarded = array('id');
    
    public static $rules = array(
      'title' => 'required | string | min: 10',
      'period' => 'required',
      'user_point' => 'required',
      'death_point' => 'required',
    );

    public function user()
    {
      return $this->belongsTo('App\User');
    }

  public function getRemainingHours(){
      $time = $this->period->diffInHours($this->created_at);
      return $time;
  }

}
