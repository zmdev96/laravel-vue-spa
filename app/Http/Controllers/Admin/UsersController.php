<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersProfile;
use App\Models\UsersGroup;
use Storage;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::with(['group', 'profile'])->get();
      return view('admin.users.index', ['title' => 'Users Manage', 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usersgroups = UsersGroup::all();
        return view('admin.users.create', ['title' => 'Users| Create', 'usersgroups' => $usersgroups]);
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
          'username'      => 'required|alpha_dash|between:6,24|unique:users',
          'first_name'    => 'required|string|between:3,24',
          'last_name'     => 'required|string|between:3,24',
          'password'      => 'required|string|between:8,24|required_with:re-password|same:re-password',
          're-password'   => 'required|string|between:8,24',
          'email'         => 'required|email|between:10,60|unique:users',
          'city'          => 'required|string|between:3,24',
          'address'       => 'required|string|between:8,36',
          'phone'         => 'required|string|max:10',
          'birth_year'    => 'required|date|before:2010-01-01',
          'user_group'    => 'required',
          'image'         => 'sometimes|nullable|image|mimes:jpg,png,jpeg',
          'about'         => 'required|string|between:12,255',


        ],[],[
          'username'    => 'Username',
          'first_name'  => 'First name',
          'last_name'   => 'Last name',
          'password'    => 'Password',
          're-password' => 'Re-password',
          'email'       => 'E-Mail',
          'city'        => 'City',
          'address'     => 'Address',
          'phone'       => 'Phone',
          'birth_year'  => 'Date of Birth',
          'user_group'  => 'User Group',
          'image'       => 'Image',
          'about'       => 'About'
        ]);

        $user = new User;
        $user->username   = request('username');
        $user->first_name = request('first_name');
        $user->last_name  = request('last_name');
        $user->password   = bcrypt(request('password'));
        $user->email      = request('email');
        $user->users_group_id = request('user_group');
        if ($user->save()) {
            $user_Profile = new UsersProfile;
            $user_Profile->user_id = $user->id;
            $user_Profile->city = request('city');
            $user_Profile->address = request('address');
            $user_Profile->phone = request('phone');
            $user_Profile->birth_year = request('birth_year');
            if (request()->hasFile('image')) {
                $user_Profile->image = $request->file('image')->store('images/users');
            }
            $user_Profile->about = request('about');
            if ($user_Profile->save()) {
              return redirect(route('admin.users.index'))->with(['status' => 'success' , 'message' => 'User  created successfuly']);
            }else {
              return redirect(route('admin.users.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
            }
        }else {
            return redirect(route('admin.users.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        $user = User::with(['group', 'profile', 'posts'])->findOrFail($id);
        if ($user) {
          return view('admin.users.show', ['title' => 'Users| Show' , 'user' => $user]);
        }else {
          return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('profile')->findOrFail($id);
        $usersgroups = UsersGroup::all();

        if ($user) {
          return view('admin.users.edit', ['title' => 'Users| Edit' , 'user' => $user, 'usersgroups' => $usersgroups ]);
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
        'username'      => 'required|alpha_dash|between:6,24|unique:users,username,' . $id,
        'first_name'    => 'required|string|between:3,24',
        'last_name'     => 'required|string|between:3,24',
        'email'         => 'required|email|between:10,60||unique:users,email,' . $id,
        'city'          => 'required|string|between:3,24',
        'address'       => 'required|string|between:8,36',
        'phone'         => 'required|string|max:10',
        'birth_year'    => 'required|date|before:2010-01-01',
        'user_group'    => 'required',
        'image'         => 'sometimes|nullable|image|mimes:jpg,png,jpeg',
        'about'         => 'required|string|between:12,255',


      ],[],[
        'username'    => 'Username',
        'first_name'  => 'First name',
        'last_name'   => 'Last name',
        'email'       => 'E-Mail',
        'city'        => 'City',
        'address'     => 'Address',
        'phone'       => 'Phone',
        'birth_year'  => 'Date of Birth',
        'user_group'  => 'User Group',
        'image'       => 'Image',
        'about'       => 'About'
      ]);

      $user = User::with('profile')->find($id);
      $user->username   = request('username');
      $user->first_name = request('first_name');
      $user->last_name  = request('last_name');
      $user->email      = request('email');
      $user->users_group_id = request('user_group');
      $user->profile->city = request('city');
      $user->profile->address = request('address');
      $user->profile->phone = request('phone');
      $user->profile->birth_year = request('birth_year');
      $user->profile->about = request('about');
      if (request()->hasFile('image')) {
          $user->profile->image !== null ? Storage::delete($user->profile->image) : '';
          $user->profile->image = $request->file('image')->store('images/users');
      }
      if ($user->save()) {
        $user->profile->save();
        return redirect(route('admin.users.index'))->with(['status' => 'success' , 'message' => 'User  updated successfuly']);
      }else {
          return redirect(route('admin.users.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
        // delete the user image in the first
        $user = User::with('profile')->find($id);
        $user->profile->image !== null ? Storage::delete($user->profile->image) : '';
        if ($user->delete()) {
           $user->profile->delete();
           return redirect()->back()->with(['status' => 'success' ,'message' => 'User deleted successfuly']);
        }else {
           return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
        }
    }
}
