<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
  /**
   * The name of table.
   *
   * @var string
   */
  protected $table = 'email_verifications';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'member_id', 'token', 'created_at',
  ];

  /**
   * Email Relationships.
   * [1] member
   * @var array
   */

   // Users
   public function member()
   {
     return $this->belongsTo('App\Models\Member');
   }
}
