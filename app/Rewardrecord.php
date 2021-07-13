<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rewardrecord extends Model
{    

    protected $casts = [
      'reward_period' => 'datetime'
    ];

    public function getRemainingTime(){
      return $this->reward_period->diffInHours(Carbon::now());
    }

    protected $guarded = array('id');

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function getRemaindingDays()
    {
      return Carbon::now()->subDays($this->time)->diffInHours($this->created_at);
    }

}
