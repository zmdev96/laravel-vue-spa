<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersGroup extends Model
{

  /**
   * The name of Table.
   *
   * @var string
   */
  protected $table = 'users_groups';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'name', 'about',
  ];
}
