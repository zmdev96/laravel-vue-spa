<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Privilege;

class PrivilegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $privileges = Privilege::orderBy('id', 'desc')->get();

      return view('admin.privileges.index', ['title' => 'Privileges Manage', 'privileges' => $privileges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.privileges.create', ['title' => 'Privileges| Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      $this->validate(request(), [
        'name'  => 'required|string|between:8,36|unique:privileges',
        'route' => 'required|string|between:8,36|unique:privileges',
        'about' => 'nullable|between:8,255',
      ],[],[
        'name'  => 'Privilege Name',
        'route' => 'Privilege Route',
        'about' => 'About',
      ]);

      $privilege = new Privilege;
      $privilege->name  = request('name');
      $privilege->route = request('route');
      $privilege->about = request('about');
      if ($privilege->save()) {
        return redirect(route('admin.privileges.index'))->with(['status' => 'success' , 'message' => 'Privilege created successfuly']);
      }else {
        return redirect(route('admin.privileges.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $privilege = Privilege::find($id);
      if ($privilege) {
        return view('admin.privileges.edit', ['title' => 'Privileges| Edit' , 'privilege' => $privilege ]);
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
        'name'  => 'required|string|between:8,36|unique:privileges,name,' . $id,
        'route' => 'required|string|between:8,36|unique:privileges,route,' . $id,
        'about' => 'nullable|between:8,255',
      ],[],[
        'name'  => 'Privilege Name',
        'route' => 'Privilege Route',
        'about' => 'About',
      ]);

      $privilege = Privilege::where('id', $id)->update([
        'name'  => request('name'),
        'route' => request('route'),
        'about' => request('about'),
      ]);
      if ($privilege) {
        return redirect(route('admin.privileges.index'))->with(['status' => 'success' , 'message' => 'Privilege updated successfuly']);
      }else {
        return redirect(route('admin.privileges.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
       $deleted_id = Privilege::find($id)->delete();
       if ($deleted_id) {
          return redirect()->back()->with(['status' => 'success' ,'message' => 'Privilege deleted successfuly']);
       }else {
          return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
       }
    }
}
