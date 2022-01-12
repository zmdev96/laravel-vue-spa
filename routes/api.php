<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Front\Auth', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');
    Route::post('refresh', 'LoginController@refresh');
    Route::post('me', 'LoginController@me');
});

Route::group(['middleware' => 'guest:api', 'prefix' => 'auth'], function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});


Route::group(['namespace' => 'Front'], function ($router) {
    Route::get('general/categories', 'GeneralController@categories');
    Route::get('general/acategories', 'GeneralController@acategories');
    Route::get('general/popular_posts', 'GeneralController@popularPosts');

    Route::post('general/ckeditor/upload', 'GeneralController@CKEditor');
    Route::post('general/ckeditor/ads/upload', 'GeneralController@CKEditorAds');

    Route::get('home/posts', 'HomeController@posts');
    //Posts Routes
    Route::get('posts', 'PostsController@index');
    Route::get('posts/show/{id}', 'PostsController@show');
    Route::get('posts/comments/{id}', 'PostsController@comments');
    Route::post('posts/comments/create', 'PostsController@storeComment');

    //Categories Routes
    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/singel/{id}', 'CategoriesController@singel');
    Route::get('categories/sub/{id}', 'CategoriesController@sub');

    //Categories Routes
    Route::get('ads_categories', 'AdsCategoriesController@index');
    Route::get('ads_categories/singel/{id}', 'AdsCategoriesController@singel');

    //Categories Routes
    Route::get('ads', 'AdsController@index');
    Route::get('ads/show/{id}', 'AdsController@show');


    // Member Settings Routes
    Route::post('settings/account', 'MembersettingsContoller@account');
    Route::post('settings/general', 'MembersettingsContoller@general');
    Route::post('settings/imageUpload', 'MembersettingsContoller@imageUpload');
    Route::post('settings/security', 'MembersettingsContoller@security');
    // Member Posts Profile Routes
    Route::get('profile/posts/{id}', 'MemberprofileContoller@index');
    Route::post('profile/posts/create', 'MemberprofileContoller@create');
    Route::post('profile/posts/store', 'MemberprofileContoller@store');
    Route::get('profile/posts/show/{id}', 'MemberprofileContoller@show');
    Route::post('profile/posts/image/create', 'MemberprofileContoller@imageUpload');
    Route::get('profile/posts/edit/{id}', 'MemberprofileContoller@edit');
    Route::post('profile/posts/update', 'MemberprofileContoller@update');
    Route::post('profile/posts/image/update', 'MemberprofileContoller@imageUpdate');
    Route::post('profile/posts/delete', 'MemberprofileContoller@destroy');
    // Member Ads Profile Routes
    Route::get('profile/ads/{id}', 'MemberprofileContoller@adsIndex');
    Route::post('profile/ads/create', 'MemberprofileContoller@adsCreate');
    Route::post('profile/ads/store', 'MemberprofileContoller@adsStore');
    Route::post('profile/ads/image/create', 'MemberprofileContoller@adsImageUpload');
    Route::get('profile/ads/edit/{id}', 'MemberprofileContoller@adsEdit');
    Route::post('profile/ads/update', 'MemberprofileContoller@adsUpdate');
    Route::get('profile/ads/show/{id}', 'MemberprofileContoller@adsShow');
    Route::post('profile/ads/delete', 'MemberprofileContoller@adsDestroy');

});
