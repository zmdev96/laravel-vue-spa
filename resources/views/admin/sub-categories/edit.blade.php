@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Sub Categories Edit</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.sub-categories.update', $sub->id)}}" method="post">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Sub Category Name:</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{old('name' , $sub->name)}}">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('cat_id') ? ' has-error' : '' }}">
                          <label for="name">Category:</label>
                          <select class="form-control" name="cat_id">
                            @foreach ($categories as $cat)
                              <option value="{{$cat->id}}" {{$cat->id == $sub->category_id ? 'selected' : ''}} >{{$cat->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('cat_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('cat_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                      <a href="{{route('admin.sub-categories.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
