<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rewardrecord extends Model
{
    // ちょっとよく分からないからsub
    public function RewardPeriod()
    {
      return Carbon::now()->subDays(2)->diffInDays($this->reward_period);
    } 

    protected $guarded = array('id');


    public function user()
    {
        return $this->belongTo('App\User');
    }

}
