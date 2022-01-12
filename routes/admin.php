<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider with a group which
| contains the "web" middleware group. Now create something great!
| and the prefix is /app-admin
|
*/

Auth::routes();

// Auth Routes [Multiauth]
Route::get('/app-admin/login', 'Auth\LoginController@get_admin_form')->name('admin.login');
Route::post('/app-admin/login', 'Auth\LoginController@login');


Route::group(['prefix' => '/app-admin', 'namespace' => 'Admin', 'as' => 'admin.'], function (){

  // Set the Guard to admin
  Config::set('auth.defaults.guard', 'admin');

  Route::group(['middleware' => 'auth:admin'], function (){
    // Logout Route
    Route::any('logout', function () {
      Auth::guard('admin')->logout();
      return redirect('/app-admin/login');
    })->name('logout');

    // Home Routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index');
    //Route::get('notfound', 'ExceptionController@notfound')->name('notfound');
    //Route::get('accessdiened', 'ExceptionController@accessdiened')->name('accessdiened');



    // Binded Routes with hasAccess
    //Route::group(['middleware' => 'hasAccess'], function (){
    //});

    // Users Routes
    Route::resource('users', 'UsersController');
    Route::resource('usersgroups', 'UsersGroupsController');
    Route::resource('privileges', 'PrivilegesController');
    // Settings Routes
    Route::get('settings', 'SettingsController@index')->name('settings.index');
    Route::post('settings', 'SettingsController@update')->name('settings.update');
    // Categories And SubCategories Routes
    Route::resource('categories', 'CategoriesController');
    Route::resource('sub-categories', 'SubCategoriesController');
    // Posts Route
    Route::get('posts/{id}/approve', 'PostsController@approve')->name('posts.approve');
    Route::resource('posts', 'PostsController');
    // Ads Categories Routes
    Route::resource('ads-categories', 'AdsCategoriesController');
    // Ads Routes
    Route::get('ads/{id}/approve', 'AdsController@approve')->name('ads.approve');
    Route::resource('ads', 'AdsController');

    // Filemanager Routes
    Route::get('filemanager', 'FilemanagerController@index')->name('filemanager.index');
    Route::post('filemanager/upload', 'FilemanagerController@blog_upload')->name('filemanager.upload');
    Route::post('filemanager/ads_upload', 'FilemanagerController@ads_upload')->name('filemanager.ads_upload');


  });

});
