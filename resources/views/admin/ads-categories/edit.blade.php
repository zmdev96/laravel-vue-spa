@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Ads Categories Edit</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.ads-categories.update', $ads_category->id)}}" method="post">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Ads Category Name:</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{old('name', $ads_category->name)}}">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('route') ? ' has-error' : '' }}">
                          <label for="route">Ads Category Status:</label>
                          <select class="form-control" name="status">
                            <option {{ $ads_category->status == 'disabled' ? 'selected': ''  }} value="disabled">Disabled</option>
                            <option {{ $ads_category->status == 'enabled' ? 'selected': ''  }} value="enabled">Enabled</option>
                          </select>
                          @if ($errors->has('route'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('route') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                      <a href="{{route('admin.ads-categories.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
