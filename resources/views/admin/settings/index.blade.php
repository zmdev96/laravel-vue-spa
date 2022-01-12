@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Settings</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              @if (session()->has('message'))
                <div class="status-message alert alert-{{session()->get('status')}}">{{session()->get('message')}}</div>
              @endif
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Website Name:</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{old('name', settings()->name)}}">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="Email">Website E-Mail:</label>
                          <input type="email" name="email" class="form-control" id="Email" value="{{old('email', settings()->email)}}">
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('logo') ? ' has-error' : '' }}">
                          <label for="Logo">Website Logo:</label>
                          <input type="file" name="logo" class="form-control" id="Logo" value="{{old('logo')}}">
                          @if ($errors->has('logo'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('logo') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('icon') ? ' has-error' : '' }}">
                          <label for="Icon">Website Icon:</label>
                          <input type="file" name="icon" class="form-control" id="Icon" value="{{old('icon')}}">
                          @if ($errors->has('icon'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('icon') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('desc') ? ' has-error' : '' }}">
                          <label for="Desc">Website description:</label>
                          <textarea name="desc" class="form-control" rows="5" style="width:100%">{{old('desc', settings()->desc)}}</textarea>
                          @if ($errors->has('desc'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('desc') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
