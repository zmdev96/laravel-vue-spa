<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /**
     * The name of table.
     *
     * @var string
     */
    protected $table = 'sub_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'status',
    ];

    /**
     * Categories Relationships.
     * [1] Child
     * @var array
     */

     // Child
     public function parent()
     {
       return $this->belongsTo('App\Models\Category' , 'category_id', 'id');
     }

     // Child
     public function posts()
     {
       return $this->hasMany('App\Models\Post' , 'sub_category_id', 'id');
     }
}
