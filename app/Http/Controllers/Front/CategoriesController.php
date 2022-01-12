<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

class CategoriesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $categories = Category::with('child.posts')->where('status', 'enabled')->get();
      return response()->json(['status' => true, 'categories' => $categories]);
  }

  /**
   * Display All Category child Posts.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function singel($cat)
  {
    $category = Category::with([
      'child.posts.user.profile',
      'child.posts.member.profile',
      'child.posts.comments'
      ])->where('id', $cat)->first();
    //dd($category);
    if ($category) {
      return response()->json(['status' => true, 'category' => $category]);
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
