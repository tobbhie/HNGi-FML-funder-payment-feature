<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;




class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = [
        'blocked_until'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isBlocked'=>'integer',
    ];


    //Email Verification Notification
    public function request()
    {
        return $this->hasMany('App\Request');
    }

    public function verification()
    {
        return $this->hasOne('App\Verification');
    }
    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

}
