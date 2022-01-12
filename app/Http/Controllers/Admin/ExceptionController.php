<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{


  public function notfound()
  {
    return view('exception.notfound', ['title' => 'Page Not Found']);
  }

  public function accessdiened()
  {
    return view('exception.accessdiened', ['title' => 'Accessdiened']);

  }

}
