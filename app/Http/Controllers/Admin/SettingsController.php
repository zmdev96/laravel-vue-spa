<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Models\Setting;
class SettingsController extends Controller
{
    /**
     * Display a listing of the Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.settings.index', ['title' => 'Settings']);
    }

    /**
     * Update the specified Settings in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update()
     {
       $this->validate(request(), [
         'name'      => 'required|alpha_dash|between:3,24',
         'email'     => 'required|email|between:10,60',
         'logo'      => 'sometimes|nullable|image|mimes:jpg,png,jpeg',
         'icon'      => 'sometimes|nullable|image|mimes:jpg,png,jpeg,icon',
         'desc'      => 'required|string|between:10,255',
       ],[],[
         'name'      => 'Name',
         'email'     => 'E-Mail',
         'logo'      => 'Logo',
         'icon'      => 'Icon',
         'desc'      => 'Description',
       ]);

       $settings = Setting::orderBy('id', 'desc')->first();
       $settings->name  = request('name');
       $settings->email = request('email');
       $settings->desc = request('desc');
       if (request()->hasFile('logo')) {
           $settings->logo !== null ? Storage::delete($settings->logo) : '';
           $settings->logo = request()->file('logo')->store('images/settings');
       }
       if (request()->hasFile('icon')) {
           $settings->icon !== null ? Storage::delete($settings->icon) : '';
           $settings->icon = request()->file('icon')->store('images/settings');
       }
       if ($settings->save()) {
         return redirect(route('admin.settings.index'))->with(['status' => 'success' , 'message' => 'Settings updated successfuly']);
       }else {
         return redirect(route('admin.settings.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
       }
     }
}
