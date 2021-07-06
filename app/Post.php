<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{

    protected $casts = [
      'period' => 'datetime',
      'start_date' => 'datetime',
      'end_date' => 'datetime'
    ];

    // phpは全てが
 
    protected $guarded = array('id');
    
    public static $rules = array(
      'title' => 'required | string | min: 5',
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
  // 時間で24でわるメソッドを使う
  // end_dateが0から上がらない終わる処理、現時点では０になるのは一瞬
  // また今日と比べてあと何時間で目標がスタートするのかのstar_dateから現在時刻の差分だけを表示させる処理

  // 始める日のメソッド
  public function getstart()
  {
    $time = Carbon::now()->diffInHours($this->start_date, false);
    if ($time <= 0) {
      $time = 0;
    }
    return $time;
    // $now = Carbon::now();
    // if( $now->diffInHours( $this->start_date, false ) == 0 ){ // 第2引数をfalseにすると差がマイナスで返る 省略すると絶対値
    //   return $now->$diffInHours($this->start_date);
    // }
  }

  // 終わる日のメソッド
  public function getendHours()
  {
    $time = Carbon::now()->diffInHours($this->end_date, false);
    if ($time <= 0) {
      $time = 0;
    }
    // ％はあまりを求めてくれる。
    $hour = $time % 24;
    return $hour . '時間';
  }

  public function getendDays()
  {
    $time = Carbon::now()->diffInHours($this->end_date, false);
    if ($time <= 0) {
      $time = 0;
    }
    // 0で消されるというロジックを組み替える
    $day = floor($time / 24);

    return $day . '日';
  }

//  24時間＝1にするメソッド
  public function rozic()
  {
    $diff = ($this->start_date)->diffInHours($this->end_date);
    $hours = $diff->hours;
    $hours = $hours + ($diff->$day*24);
    return $hours;
  }

}
