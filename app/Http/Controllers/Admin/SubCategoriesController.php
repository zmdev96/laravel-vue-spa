<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\SubCategory;


class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sub_categories = SubCategory::with('parent')->get();
      return view('admin.sub-categories.index', ['title' => 'Sub Categories Manage' , 'sub_categories' => $sub_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      return view('admin.sub-categories.create', ['title' => 'Sub Categories| Create' , 'categories' => $categories]);

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
        'name'      => 'required|string|between:3,36|unique:sub_categories',
        'cat_id'    => 'required|numeric',

      ],[],[
        'name'      => 'Sub Category Name',
        'cat_id'    => 'Category',

      ]);

      $sub = new SubCategory;
      $sub->name = request('name');
      $sub->category_id = request('cat_id');
      if ($sub->save()) {
        return redirect(route('admin.sub-categories.index'))->with(['status' => 'success' , 'message' => 'Sub Category created successfuly']);
      }else {
        return redirect(route('admin.sub-categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        $sub = SubCategory::find($id);
        if ($sub) {
          $categories = Category::all();
          return view('admin.sub-categories.edit', ['title' => 'Sub Categories| Edit', 'sub' => $sub, 'categories' => $categories]);
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
        'name'      => 'required|string|between:3,36|unique:sub_categories,name,' . $id,
        'cat_id'    => 'required|numeric',

      ],[],[
        'name'      => 'Sub Category Name',
        'cat_id'    => 'Category',

      ]);

      $sub =  SubCategory::find($id);
      $sub->name = request('name');
      $sub->category_id = request('cat_id');
      if ($sub->save()) {
        return redirect(route('admin.sub-categories.index'))->with(['status' => 'success' , 'message' => 'Sub Category updated successfuly']);
      }else {
        return redirect(route('admin.sub-categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        $sub = SubCategory::find($id)->delete();
        if ($sub) {
           return redirect()->back()->with(['status' => 'success' ,'message' => 'Sub Category deleted successfuly']);
        }else {
           return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
        }
    }
}
