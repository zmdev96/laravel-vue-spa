<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    /**
     * The name of Table.
     *
     * @var string
     */
    protected $table = 'users_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'city', 'address','phone','birth_year','about', 'image',
    ];
}
