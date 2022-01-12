<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
  /**
   * The name of table.
   *
   * @var string
   */
  protected $table = 'ads';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'description', 'ads_category_id', 'user_id', 'member_id', 'views', 'content', 'image', 'status'
  ];

  /**
   * Categories Relationships.
   * [1] user
   * [2] sub category
   * [3] approved_by
   * @var array
   */

   // Users
   public function user()
   {
     return $this->belongsTo('App\Models\User', 'user_id', 'id');
   }

   public function member()
   {
     return $this->belongsTo('App\Models\Member', 'member_id', 'id');
   }

   // Sub Category
   public function category()
   {
     return $this->belongsTo('App\Models\AdsCategory', 'ads_category_id', 'id');
   }

   // Approved By
   public function approved_by()
   {
     return $this->belongsTo('App\Models\User', 'approved_by', 'id');
   }
}
