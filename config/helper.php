<?php
/*
|------------------------------------------------
| Auth Guard Function
|------------------------------------------------
| Abbrevitation the Auth::guard
| admin: Auth::guard('admin')
| web: Auth::guard('web')
*/
if (!function_exists('admin')) {
  function admin(){
    return Auth::guard('admin');
  }
}

if (!function_exists('web')) {
  function web(){
    return Auth::guard('web');
  }
}

/*
|------------------------------------------------
| Settings
|------------------------------------------------
*/
if (!function_exists('settings')) {
  function settings(){
    return \App\Models\Setting::orderBy('id', 'desc')->first();
  }
}

/*
|------------------------------------------------
| Add Active class fro Links
|------------------------------------------------
*/
if (!function_exists('activeLink')) {
  function activeLink($route){
    if (\Route::currentRouteName()) {
      if (\Route::currentRouteName() == $route) {
        return 'active';
      }
    }

  }
}
