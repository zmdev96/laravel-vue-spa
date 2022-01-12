<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\UsersGroup;
use App\Models\Privilege;
use App\Models\GroupPrivilege;


class UsersGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usersgroups = UsersGroup::all();
      return view('admin.usersgroups.index', ['title' => 'Users groups', 'usersgroups' => $usersgroups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $privileges = Privilege::all();
      return view('admin.usersgroups.create', ['title' => 'Users groups| Create', 'privileges' => $privileges]);
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
        'name'  => 'required|string|between:6,36|unique:users_groups',
      ],[],[
        'name'  => 'Group Name',
      ]);

      $group = new UsersGroup;
      $group->name  = request('name');
      if ($group->save()) {
        if (request('privi') !== null && is_array(request('privi'))) {
          foreach (request('privi') as $privi) {
            $group_privi = new GroupPrivilege;
            $group_privi->users_group_id = $group->id;
            $group_privi->privilege_id   = $privi;
            $group_privi->save();
          }
        }
        return redirect(route('admin.usersgroups.index'))->with(['status' => 'success' , 'message' => 'Users Group created successfuly']);
      }else {
        return redirect(route('admin.usersgroups.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $group = UsersGroup::find($id);
      $privileges = Privilege::all();
      if ($group) {
        $group_privi = GroupPrivilege::select('privilege_id')->where('users_group_id', $id )->get();
        $extractedPriviId = [];
        if (false !== $group_privi) {
          foreach ($group_privi as $privi) {
            $extractedPriviId[] = $privi->privilege_id;
          }
        }
        return view('admin.usersgroups.edit', [
              'title' => 'Users Groups| Edit',
              'usersgroup' => $group,
              'privileges' => $privileges,
              'group_privi' => $extractedPriviId
            ]);
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
      // Get the currnet privileges for the usersgroup
      $group_privi = GroupPrivilege::select('privilege_id')->where('users_group_id', $id )->get();
      $extractedPriviId = [];
      if (false !== $group_privi) {
        foreach ($group_privi as $privi) {
          $extractedPriviId[] = $privi->privilege_id;
        }
      }

      // Request Validations
      $this->validate(request(), [
        'name'  => 'required|string|between:6,36|unique:users_groups,name,'. $id,
      ],[],[
        'name'  => 'Group Name',
      ]);
      // Get the deleted and added Privileges from request depended on the table
      if (request('privi') !== null && is_array(request('privi'))) {
        $deletedPrivi = array_diff($extractedPriviId, request('privi'));
        $addedPrivi   = array_diff(request('privi'), $extractedPriviId);

      }

      $group = UsersGroup::where('id', $id)->update([
        'name'  => request('name'),
      ]);
      if ($group) {
        // Delete the old privileges
        foreach ($deletedPrivi as $privi) {
          GroupPrivilege::where('privilege_id', $privi )->delete();
        }
        // Add the new privileges
        foreach ($addedPrivi as $privi) {
          $added = new GroupPrivilege;
          $added->users_group_id = $id;
          $added->privilege_id = $privi;
          $added->save();
        }
        return redirect(route('admin.usersgroups.index'))->with(['status' => 'success' , 'message' => 'Users Group updated successfuly']);
      }else {
        return redirect(route('admin.usersgroups.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $deleted_id = UsersGroup::find($id)->delete();
      if ($deleted_id) {
        // delete the GroupPrivilege from the onther table
        $group_privi = GroupPrivilege::where('users_group_id', $id )->get();
        foreach ($group_privi as $privi){
          GroupPrivilege::where('users_group_id', $id )->delete();
        }
         return redirect()->back()->with(['status' => 'success' ,'message' => 'Users Group deleted successfuly']);
      }else {
         return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }
}
