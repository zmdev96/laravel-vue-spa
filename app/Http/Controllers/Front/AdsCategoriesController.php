<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdsCategory;

class AdsCategoriesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $categories = AdsCategory::with(['child' => function($q){
        $q->where('status', 'published');
      }])->where('status', 'enabled')->get();
      return response()->json(['status' => true, 'ads_categories' => $categories]);
  }

  /**
   * Display All Category child Posts.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function singel($cat)
  {
    $category = AdsCategory::with([
      'child.user.profile',
      'child.member.profile',
      ])->where('id', $cat)->first();
    //dd($category);
    if ($category) {
      return response()->json(['status' => true, 'ads_category' => $category]);
    }else {
      return response()->json(['status' => false]);
    }
  }

  /**
   * Display All Category child Posts.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function sub($sub)
  {
    $sub_category = SubCategory::with(['posts.user.profile', 'posts.member.profile', 'posts.comments', 'parent'])->where('id', $sub)->first();
    //dd($sub_category);
    if ($sub_category) {
      return response()->json(['status' => true, 'sub' => $sub_category]);
    }else {
      return response()->json(['status' => false]);
    }
  }
}
