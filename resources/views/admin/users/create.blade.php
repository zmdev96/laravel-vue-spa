@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Users Create</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-row">
                        <div class="form-group col-md-4 {{ $errors->has('username') ? ' has-error' : '' }}">
                          <label for="Username">Username:</label>
                          <input type="text" name="username" class="form-control" id="Username" value="{{old('username')}}">
                          @if ($errors->has('username'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <label for="First_name">First name:</label>
                          <input type="text" name="first_name" class="form-control" id="First_name" value="{{old('first_name')}}">
                          @if ($errors->has('first_name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('first_name') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <label for="last_name">Last name:</label>
                          <input type="text" name="last_name" class="form-control" id="last_name" value="{{old('last_name')}}">
                          @if ($errors->has('last_name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('last_name') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4 {{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="Password">Password:</label>
                          <input type="password" name="password" class="form-control" id="Password" value="{{old('password')}}">
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('re-password') ? ' has-error' : '' }}">
                          <label for="RE_password">Re-password:</label>
                          <input type="password" name="re-password" class="form-control" id="RE_password" value="{{old('re-password')}}">
                          @if ($errors->has('re-password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('re-password') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="Email">E-Mail:</label>
                          <input type="email" name="email" class="form-control" id="Email" value="{{old('email')}}">
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4 {{ $errors->has('city') ? ' has-error' : '' }}">
                          <label for="City">City:</label>
                          <input type="text" name="city" class="form-control" id="City" value="{{old('city')}}">
                          @if ($errors->has('city'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('city') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="Address">Address:</label>
                          <input type="text" name="address" class="form-control" id="Address" value="{{old('address')}}">
                          @if ($errors->has('address'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('address') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('phone') ? ' has-error' : '' }}">
                          <label for="Phone">Phone:</label>
                          <input type="text" name="phone" class="form-control" id="Phone" value="{{old('phone')}}">
                          @if ($errors->has('phone'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4 {{ $errors->has('birth_year') ? ' has-error' : '' }}">
                          <label for="Birth_year">Date of Birth:</label>
                          <input type="date" name="birth_year" class="form-control" id="Birth_year" value="{{old('birth_year')}}">
                          @if ($errors->has('birth_year'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('birth_year') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('user_group') ? ' has-error' : '' }}">
                          <label for="UserGroup">User Group:</label>
                          <select name="user_group" class="form-control" id="UserGroup">
                            <option value="" selected >Choose Group</option>
                            @foreach ($usersgroups as $group)
                              <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('user_group'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('user_group') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('image') ? ' has-error' : '' }}">
                          <label for="Image">Image:</label>
                          <input type="file" name="image" class="form-control" id="Image" value="{{old('image')}}">
                          @if ($errors->has('image'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('image') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('about') ? ' has-error' : '' }}">
                          <label for="About">About:</label>
                          <textarea name="about" class="form-control" id="About" rows="4" cols="50">{{old('about')}}</textarea>
                          @if ($errors->has('about'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('about') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-plus fa-fw" ></i>Create</button>
                      <a href="{{route('admin.users.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
