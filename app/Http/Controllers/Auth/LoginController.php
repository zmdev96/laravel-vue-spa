<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3; // Amount of bad attempts user can make
    protected $decayMinutes = 1; // Time for which user is going to be blocked in seconds


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function get_admin_form()
    {
        return view('admin.auth.login');
    }


/*

*/


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


        /**
         * Validate the user login request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return void
         */
        protected function validateLogin(Request $request)
        {
            $this->validate($request, [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }

        /**
         * Attempt to log the user into the application.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return bool
         */
        protected function attemptLogin(Request $request)
        {
            return $this->guard()->attempt(
                $this->credentials($request), $request->filled('remember')
            );
        }

        /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array
         */
        protected function credentials(Request $request)
        {
            return array($this->authType($request) => request($this->username()) , 'password' => $request->password);
        }

        /**
         * Send the response after the user was authenticated.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        protected function sendLoginResponse(Request $request)
        {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);
            return $this->authenticated($request, $this->guard()->user())
                    ?: redirect()->intended($this->redirectToPath());
        }

        /**
         * Get the failed login response instance.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Symfony\Component\HttpFoundation\Response
         *
         * @throws ValidationException
         */
        protected function sendFailedLoginResponse(Request $request)
        {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }

        /**
         * The user has been authenticated.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  mixed  $user
         * @return mixed
         */
        protected function authenticated(Request $request, $user)
        {
            //
        }

        /**
         * Get the login username to be used by the controller.
         *
         * @return string
         */
        public function username()
        {
            return 'email';
        }

        /**
         * Get the culomn authentication type.
         *
         * @return string
         */
        public function authType(Request $request)
        {
          $email = $request->email;
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $type = 'email';
          }else {
            $type = 'username';
          }
          return $type;
        }

        /**
         * Get the guard to be used during authentication.
         *
         * @return \Illuminate\Contracts\Auth\StatefulGuard
         */
        protected function guard()
        {
            $prev_url = explode($_SERVER['HTTP_HOST'], \Session::get('_previous.url'));
            switch (end($prev_url)) {
              case '/app-admin/login':
                $guard = 'admin';
                break;
              default:
                $guard = 'web';
                break;
            }

            return auth()->guard($guard);
        }

        /**
         * Get the guard to be used during authentication.
         *
         * @return \Illuminate\Contracts\Auth\StatefulGuard
         */
        protected function redirectToPath()
        {
            $prev_url = explode($_SERVER['HTTP_HOST'], \Session::get('_previous.url'));
            switch (end($prev_url)) {
              case '/app-admin/login':
                $url = '/app-admin';
                break;
              default:
                $url = '/';
                break;
            }

            return $url;
        }
}
