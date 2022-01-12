<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
  /**
   * The table name.
   *
   * @var string
   */
    protected $table = 'post_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'member_id', 'comment',
    ];

    /**
     * Posts Relationships.
     * [1] post
     * [2] post
     * @var array
     */

     public function post()
     {
       return $this->belongsTo('App\Models\Post', 'post_id', 'id');
     }

     public function member()
     {
       return $this->belongsTo('App\Models\Member');
     }
}
