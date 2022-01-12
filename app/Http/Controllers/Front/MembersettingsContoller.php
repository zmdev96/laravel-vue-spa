<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\MembersProfile;
use Storage;
class MembersettingsContoller extends Controller
{
    /**
         * Create a new AuthController instance.
         *
         * @return void
         */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['imageUpload']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $id = request('id');
        $this->validate(request(), [
            'username'      => 'required|alpha_dash|between:6,24|unique:users,username,' . $id,
            'first_name'    => 'required|string|between:3,24',
            'last_name'     => 'required|string|between:3,24',
            'email'         => 'required|email|between:10,60||unique:users,email,' . $id,
          ], [], [
            'username'    => 'Username',
            'first_name'  => 'First name',
            'last_name'   => 'Last name',
            'email'       => 'E-Mail',
          ]);

        $member = Member::find($id);
        $member->username   = request('username');
        $member->first_name = request('first_name');
        $member->last_name  = request('last_name');
        $member->email      = request('email');
        if ($member->save()) {
            return response()->json(['status' => true, 'message' => 'Account updated successfuly']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
    }


    /**
     * Update the General Profile data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        $id = request('id');
        $this->validate(request(), [
                'city'          => 'required|string|between:3,24',
                'address'       => 'required|string|between:8,36',
                'phone'         => 'required|string|max:15',
                'birth_year'    => 'required|date|before:2010-01-01',
                'about'         => 'required|string|between:12,255',
              ], [], [
                'city'        => 'City',
                'address'     => 'Address',
                'phone'       => 'Phone',
                'birth_year'  => 'Date of Birth',
                'about'       => 'About'
              ]);

        $member = MembersProfile::where('member_id', $id)->first();
        $member->city   = request('city');
        $member->address = request('address');
        $member->phone  = request('phone');
        $member->birth_year      = request('birth_year');
        $member->about  = request('about');
        if ($member->save()) {
            return response()->json(['status' => true, 'message' => 'Account updated successfuly']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
    }
    /**
     * Update the General Profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageUpload(Request $request)
    {
      $this->validate(request(), [
              'image'         => 'sometimes|nullable|image|mimes:jpg,png,jpeg',
            ], [], [
              'image'       => 'Image',
            ]);
        $member = MembersProfile::where('member_id', request('id'))->first();
        if (request()->hasFile('image')) {
            $member->image !== null ? Storage::delete($member->image) : '';
            $member->image = request()->file('image')->store('images/members');
            if ($member->save()) {
                return response()->json(['status' => true, 'message' => 'Account updated successfuly']);
            } else {
                return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
    }
    /**
     * Update the security Profile data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function security()
    {
        $this->validate(request(), [
              'current_password'    => 'required|string|between:6,24',
              'password'            => 'required|string|between:6,24|required_with:confirm_password|same:confirm_password|different:current_password',
              'confirm_password'    => 'required|string|between:6,24',
            ], [], [
              'current_password'    => 'Current Password',
              'password'            => 'Password',
              'confirm_password'    => 'confirmation Password',

            ]);

        $id = request('id');
        $member = Member::find($id);

        if (\Hash::check(request('current_password'), $member->password)) {
            $member->password = bcrypt(request('password'));
            if ($member->save()) {
                return response()->json(['status' => true, 'message' => 'Account updated successfuly']);
            } else {
                return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'The Current Password dont match'], 422);
        }
    }
}
