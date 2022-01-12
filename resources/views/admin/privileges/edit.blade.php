@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Privileges Edit</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.privileges.update', $privilege->id)}}" method="post">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Privileges Name:</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{old('name', $privilege->name)}}">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('route') ? ' has-error' : '' }}">
                          <label for="route">Privileges Route:</label>
                          <input type="text" name="route" class="form-control" id="route" value="{{old('route', $privilege->route)}}">
                          @if ($errors->has('route'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('route') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('about') ? ' has-error' : '' }}">
                          <label for="route">About:</label>
                          <textarea name="about" class="form-control" rows="8" style="width:100%">{{old('about', $privilege->about)}}</textarea>
                          @if ($errors->has('about'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('about') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                      <a href="{{route('admin.privileges.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
