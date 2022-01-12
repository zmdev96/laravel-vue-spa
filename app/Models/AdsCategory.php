<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsCategory extends Model
{
  /**
   * The name of table.
   *
   * @var string
   */
  protected $table = 'ads_categories';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'name', 'status',
  ];

  /**
   * Categories Relationships.
   * [1] Child
   * @var array
   */

   // Child
   public function child()
   {
     return $this->hasMany('App\Models\Ad');
   }
   // Child Count
   public function childCount()
   {
     return $this->hasMany('App\Models\Ad');
   }
}
