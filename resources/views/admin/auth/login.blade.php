@include('admin.layouts.header')

<div class="login">
  <div class="container-login text-center">
    <div class="wrap-login">
      <h2 class="logo-name">Amal Blog </h2>
      <form class="login-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <span class="login-form-title">Login</span>
        @if (session()->has('invalid-login'))
          <div class="alert alert-danger">{{session()->get('invalid-login')}}</div>
        @endif
        <div class="">
          <input type="text" name="email" class="form-control" placeholder="Username or Email">
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="">
          <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off">
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <input type="submit"  value="Login"  class=" btn btn-default" >
      </form>
    </div>
  </div>
</div>
<script src="/assets/admin/vendor/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $(window).focus(function() {
  location.reload();
  });
</script>
