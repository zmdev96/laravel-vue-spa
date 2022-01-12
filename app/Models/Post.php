<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The name of table.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'sub_category_id', 'user_id', 'member_id', 'views', 'content', 'image', 'status'
    ];

    /**
     * Posts Relationships.
     * [1] user
     * [2] sub category
     * [3] approved_by
     * [4] comments
     * @var array
     */

     // Users
     public function user()
     {
       return $this->belongsTo('App\Models\User', 'user_id', 'id');
     }

     // Members
     public function member()
     {
       return $this->belongsTo('App\Models\Member', 'member_id', 'id');
     }

     // Sub Category
     public function sub()
     {
       return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
     }

     // Approved By
     public function approved_by()
     {
       return $this->belongsTo('App\Models\User', 'approved_by', 'id');
     }

     // Approved By
     public function comments()
     {
       return $this->hasMany('App\Models\PostComment', 'post_id', 'id');
     }

}
