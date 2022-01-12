<!doctype html>
<html lang="en">

<head>
  <title>{{ !empty($title) ? $title : 'Amal Blog' }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

  <link rel="stylesheet" href="/assets/front/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/front/css/animate.css">
  <link rel="stylesheet" href="/assets/front/css/owl.carousel.min.css">

  <link rel="stylesheet" href="/assets/front/fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/assets/front/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/front/fonts/flaticon/font/flaticon.css">
  @yield('css')

  <!-- Theme Style -->
  <link rel="stylesheet" href="/assets/front/css/style.css">
  <link rel="stylesheet" href="/assets/front/css/main.css">

</head>

<body>


  <div class="wrap">

    <header role="banner">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-12  col-md-9 search-top">
              <!-- <a href="#"><span class="fa fa-search"></span></a> -->
              <form action="#" class="search-top-form">
                <span class="icon fa fa-search"></span>
                <input type="text" id="s" placeholder="Type keyword to search...">
              </form>
            </div>
            <div class="col-3 info text-right d-none d-md-block">

              @guest('web')
              <a href="{{route('login')}}" class="btn btn-top-c"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</a>
              <a href="{{route('register')}}" class="btn btn-top-c"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i>Register</a>
              @else
              <div class="user-dropdown">
                <a href="#" class="dropdown-toggle-c btn btn-user-c">

                  {{ Auth::guard('web')->user()->username }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu-c">
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </div>
              @endguest
            </div>
          </div>
        </div>
      </div>


      <div class="container logo-wrap">
        <div class="row ">
          <div class="col-12 text-right">
            <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
            @guest('web')
            <a href="{{route('login')}}" class="btn btn-top-c d-md-none"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</a>
            <a href="{{route('register')}}" class="btn btn-top-c d-md-none"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i>Register</a>
            @else
            <div class="user-dropdown d-md-none">
              <a href="#" class="dropdown-toggle-c btn btn-user-c">
                {{ Auth::guard('web')->user()->username }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu-c">
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </div>
            @endguest
          </div>
        </div>
      </div>
