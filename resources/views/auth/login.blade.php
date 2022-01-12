@extends('front.layouts.app')

@section('content')
  <div class="container">
    <div class="front-login py-3 pt-3">
      <div class="row align-items-center">

          @if (session()->has('is_verified'))
            <div class="col-8 offset-md-2">
              <div class="alert alert-success text-center">
              {{session()->get('is_verified')}}
              <?php
                if (!Auth::guard('web')->check()) {
                  session()->forget('is_verified');
                }
               ?>
              </div>
            </div>
           @endif

        <div class="col-12 form-content">
          <form class="form-horizontal" method="post" action="{{ route('login') }}">

              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="col-md-12 control-label">E-Mail Address or Username</label>

                  <div class="col-md-12">
                      <input id="email" type="text" class="form-control" name="email" value="{{ session()->has('email')? session()->get('email') : old('email') }}"  autofocus>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-12 control-label">Password</label>

                  <div class="col-md-12">
                      <input id="password" type="password" class="form-control" name="password" >

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-12 col-md-offset-4">
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                          </label>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                    <a class="pt-2" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    <a class="" href="{{ route('register') }}">
                        You don't have an account? Register Now
                    </a>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
