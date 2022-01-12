<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function posts()
  {
      $posts = Post::with(['user.profile', 'member.profile', 'sub.parent', 'comments.member'])->where('status', 'published')->get();
      return response()->json(['status' => true, 'posts' => $posts]);
  }
}
