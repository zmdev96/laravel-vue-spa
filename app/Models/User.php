<?php

namespace App\Models;

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

    /**
     * Users Relationships.
     * [1] Users groups
     * [2] Users profiles
     * [3] Users Posts

     * @var array
     */

     // users groups
     public function group()
     {
       return $this->hasOne('App\Models\UsersGroup' , 'id', 'users_group_id');
     }

     // users profiles
     public function profile()
     {
       return $this->hasOne('App\Models\UsersProfile');
     }

     // users profiles
     public function posts()
     {
       return $this->hasMany('App\Models\Post');
     }
}
