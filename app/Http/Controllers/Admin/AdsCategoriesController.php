<?php

namespace App\Http\Controllers\Admin;

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
        $ads_categories = AdsCategory::all();
        return view('admin.ads-categories.index', ['title' => 'Ads Categories Manage', 'ads_categories' => $ads_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.ads-categories.create', ['title' => 'Ads Categories| Create']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
          'name'      => 'required|string|between:3,36|unique:ads_categories',

        ],[],[
          'name'      => 'Ads Category Name',
        ]);

        $ads_category = new AdsCategory;
        $ads_category->name = request('name');
        if ($ads_category->save()) {
          return redirect(route('admin.ads-categories.index'))->with(['status' => 'success' , 'message' => 'Ads Category created successfuly']);
        }else {
          return redirect(route('admin.ads-categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ads_category = AdsCategory::find($id);
        if ($ads_category) {
          return view('admin.ads-categories.edit', ['title' => 'Ads Categories| Edit', 'ads_category' => $ads_category]);
        }else {
          return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate(request(), [
        'name'      => 'required|string|between:3,36|unique:ads_categories,name,' . $id,
        'status'    => 'required',

      ],[],[
        'name'      => 'Ads Category Name',
        'status'    => 'Status',
      ]);

      $ads_category = AdsCategory::find($id);
      $ads_category->name = request('name');
      $ads_category->status = request('status');
      if ($ads_category->save()) {
        return redirect(route('admin.ads-categories.index'))->with(['status' => 'success' , 'message' => 'Ads Category updated successfuly']);
      }else {
        return redirect(route('admin.ads-categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ads_category = AdsCategory::find($id)->delete();
      if ($ads_category) {
         return redirect()->back()->with(['status' => 'success' ,'message' => 'Ads Category deleted successfuly']);
      }else {
         return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }
}
