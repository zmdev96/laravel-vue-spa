@extends('admin.layouts.app')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid">

  <!-- 404 Error Text -->
  <div class="text-center">
    <div class="error mx-auto" data-text="403">403</div>
    <p class="lead text-gray-800 mb-5">Accessdiened</p>
    <p class="text-gray-500 mb-0">You don't have Permission to access this Page...</p>
    <a href="{{route('admin.home')}}">&larr; Back to Dashboard</a>
  </div>

</div>
  <!-- End Page Content -->
@endsection
