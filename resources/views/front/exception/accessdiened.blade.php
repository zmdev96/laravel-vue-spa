@extends('front.layouts.app')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

  <!-- 404 Error Text -->
  	<div id="notfound">
  		<div class="notfound">
  			<div class="notfound-404"></div>
  			<h1>403</h1>
  			<h2>Oops! Access Diened</h2>
  			<p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
  			<a href="{{route('front.home')}}">Back to homepage</a>
  		</div>
  	</div>

</div>
  <!-- End Page Content -->
@endsection
