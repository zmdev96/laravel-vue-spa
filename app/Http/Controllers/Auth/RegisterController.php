<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Models\MembersProfile;
use App\Models\EmailVerification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('emailVerivication');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data = Validator::make($data, [
            'first_name'  => 'required|string|between:3,24',
            'last_name'   => 'required|string|between:3,24',
            'email'       => 'required|string|email|max:255|unique:users',
            'password'    => 'required|string|between:6,24|required_with:re_password|same:re_password',
            're_password' => 'required|string|between:6,24',
            'b_day'       => 'required|numeric',
            'b_month'     => 'required|numeric',
            'b_year'      => 'required|numeric',
        ]);
        return $data;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Member
     */
    protected function create(array $data)
    {
        $member =  Member::create([
            'username' => lcfirst($data['first_name']) . '_' . lcfirst($data['last_name']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $member_profile = MembersProfile::create([
          'member_id' => $member->id,
          'birth_year' => request('b_year').'-'.request('b_month').'-'.request('b_day') ,
        ]);
        return $member;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
      $token = str_random(40);
      $verification = new EmailVerification;
      $verification->member_id = $user->id;
      $verification->token = $token;
      if ($verification->save()) {
        //$web_url = url
        $data = array('url' => url('/email/verivication/'.$token.''), 'name' => $user->first_name);
        Mail::to($user->email)->send(new \App\Mail\EmailVerification($data));
        return response()->json(['status' => true, 'data' => $user]);
      }

    }

    /**
     * Verifiyd the email address.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return mixed
     */
    public function emailVerivication($token)
    {
      $member = EmailVerification::with('member')->where('token', $token)->first();
      if ($member) {
        $member->member->is_verified = 'true';
        if ($member->save()) {
          $member->delete();
          session()->put('is_verified','Thanks for verivication your E-Mail');
          return redirect(route('login'))->with([
             'registr_action' => 'true',
             'email' => $member->member->email,
           ]);
        }
      }else {
        session()->put('is_verified','Your E-Mail is already verified');
        return redirect(route('login'))->with([
           'registr_action' => 'true',
         ]);
      }
    }
}
