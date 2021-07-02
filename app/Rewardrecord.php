<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rewardrecord extends Model
{    

    protected $casts = [
      'reward_period' => 'datetime'
    ];
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function getRemaindingDays()
    {
      return Carbon::now()->subDays(1)->diffInHours($this->created_at);
    }

}
