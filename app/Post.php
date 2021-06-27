<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getRemainingTimeUntilDeadline(){
        return $this->period - today;
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
