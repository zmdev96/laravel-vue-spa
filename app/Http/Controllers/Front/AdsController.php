<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ad;


class AdsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $ads = Ad::with(['user.profile', 'member.profile', 'category'])->where('status', 'published')->get();
      return response()->json(['status' => true, 'ads' => $ads]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $ad = Ad::with(['user.profile', 'member.profile', 'category'])->find($id);
    if ($ad && $ad->status == 'published') {
      return response()->json(['status' => true, 'ad' => $ad]);
    }

  }


}
