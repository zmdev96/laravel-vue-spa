@extends('front.layouts.app')

@section('content')
<div class="container front-register">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="row py-2">
                          <div class="col {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="First_name" class="">First name</label>
                            <input id="First_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autofocus>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="col {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="Last_name" class="">Last name </label>
                            <input id="Last_name" type="text" class="form-control" name="last_name"  value="{{ old('last_name') }}">
                              @if ($errors->has('last_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="row py-2">
                          <div class="col {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="row py-2">
                          <div class="col {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="">Password</label>
                            <input id="password" type="password" class="form-control" name="password" >
                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                          <div class="col {{ $errors->has('re_password') ? ' has-error' : '' }}">
                            <label for="re_password" class="">Password</label>
                            <input id="re_password" type="password" class="form-control" name="re_password" >
                              @if ($errors->has('re_password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('re_password') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="birthday">
                          <label for="" class="birthday-lable">Birthday</label>
                          <div class="row">
                            <div class="col {{ $errors->has('b_day') ? ' has-error' : '' }}">
                              <select id="dobday" name="b_day" class="form-control"></select>
                            </div>
                            <div class="col {{ $errors->has('b_month') ? ' has-error' : '' }}">
                              <select id="dobmonth" name="b_month" class="form-control"></select>
                            </div>
                            <div class="col {{ $errors->has('b_year') ? ' has-error' : '' }}">
                              <select id="dobyear" name="b_year" class="form-control"></select>
                            </div>
                          </div>
                          @if ($errors->has('b_day'))
                            <span class="help-block">
                                <strong>{{ $errors->first('b_day') }}</strong>
                            </span>
                          @endif
                          @if ($errors->has('b_month'))
                            <span class="help-block">
                                <strong>{{ $errors->first('b_month') }}</strong>
                            </span>
                          @endif
                          @if ($errors->has('b_year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('b_year') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="row py-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  @section('js')
    <script src="/assets/front/vendor/birthday_selector/dobpicker.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $.dobPicker({
        // Selectopr IDs
        daySelector:'#dobday',
        monthSelector:'#dobmonth',
        yearSelector:'#dobyear',
        // Default option values
        dayDefault:'Day',
        monthDefault:'Month',
        yearDefault:'Year',
        // Minimum age
        minimumAge: 16,
        // Maximum age
        maximumAge: 100

      });
    });

    </script>
  @endsection
@endsection
