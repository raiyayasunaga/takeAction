<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use Notifiable;
    use HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // hasMany()配列→複数
    // belongTo()単数
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function rewardrecords()
    {
        return $this->hasMany('App\Rewardrecord');
    }

    public function photos()
    {
        return $this->hasMany('App\VerifiedPhoto');
    }

    // メッセージ
    public function messages()
    {
    return $this->hasMany('App\Message');
    }
}
