<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersProfile extends Model
{
  /**
   * The name of Table.
   *
   * @var string
   */
  protected $table = 'members_profiles';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'member_id', 'birth_year',
  ];

  public function getImageAttribute()
  {
      return $this->attributes['image'] == null ? 'images/defualts-images/avatar.png' : $this->attributes['image'];
  }
}
