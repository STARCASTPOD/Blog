<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    // Relationship with user table
    public function userdetails(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // public function details(){
    //     return $this->hasOne('App\User', 'user_id');
    // }
}
