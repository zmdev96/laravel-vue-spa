<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('child')->get();
        return view('admin.categories.index', ['title' => 'Categories Manage' , 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.categories.create', ['title' => 'Categories| Create']);
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
          'name'      => 'required|string|between:3,36|unique:categories',

        ],[],[
          'name'      => 'Category Name',
        ]);

        $category = new Category;
        $category->name = request('name');
        if ($category->save()) {
          return redirect(route('admin.categories.index'))->with(['status' => 'success' , 'message' => 'Category created successfuly']);
        }else {
          return redirect(route('admin.categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        $category = Category::find($id);
        if ($category) {
          return view('admin.categories.edit', ['title' => 'Categories| Edit', 'category' => $category]);
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
          'name'      => 'required|string|between:3,36|unique:categories,name,' . $id,
          'status'    => 'required',

        ],[],[
          'name'      => 'Category Name',
          'status'    => 'Status',
        ]);

        $category = Category::find($id);
        $category->name = request('name');
        $category->status = request('status');
        if ($category->save()) {
          return redirect(route('admin.categories.index'))->with(['status' => 'success' , 'message' => 'Category updated successfuly']);
        }else {
          return redirect(route('admin.categories.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        $category = Category::with('child')->find($id)->delete();
        if ($category) {
           return redirect()->back()->with(['status' => 'success' ,'message' => 'Category deleted successfuly']);
        }else {
           return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
        }
    }
}
