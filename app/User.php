<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    public function posts(){
        return $this->hasMany('App\Post');
    }
    // public function posts(){
    //     return $this->hasMany('App\Post');
    // }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function details(){
        return $this->hasOne('App\UserDetails', 'user_id');
    }
}
