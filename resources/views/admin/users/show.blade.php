@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">User Show</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="show-content">
                    <div class="row">
                      <div class="col-md-3">
                        <label>Username:</label>
                        <span>{{ $user->username }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>First name:</label>
                        <span>{{ $user->first_name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Last name:</label>
                        <span>{{ $user->last_name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>E-Mail:</label>
                        <span>{{ $user->email }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>User Group:</label>
                        <span>{{ $user->group->name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>City:</label>
                        <span>{{ $user->profile->city }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Address:</label>
                        <span>{{ $user->profile->address }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Phone:</label>
                        <span>{{ $user->profile->phone }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Date of Birth:</label>
                        <span>{{ $user->profile->birth_year }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Created at</label>
                        <span>{{ $user->created_at->format('y/m/d')}}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Updated at:</label>
                        <span>{{ $user->updated_at->format('y/m/d')}}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Last Login:</label>
                        <span>{{ $user->last_login }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label >Total Posts:</label>
                        <span>{{ count($user->posts) }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label >Image:</label>
                        <img src="{{\Storage::url($user->profile->image)}}" alt="" id="Image" class="img-responsive " width="300" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label >About:</label>
                        <p>{!! $user->profile->about!!}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-success"><i  class="fas fa-edit fa-fw" ></i>Edit</a>

                        <a href="{{route('admin.users.index')}}" class="btn btn-danger"><i  class="fas fa-times fa-fw" ></i>Back</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->
  @section('content_js')

  @endsection
@endsection
