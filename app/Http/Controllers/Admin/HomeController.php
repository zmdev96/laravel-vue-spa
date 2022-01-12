<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{


  public function index()
  {
    return view('admin.home.index', ['title' => 'Home']);
  }


}
