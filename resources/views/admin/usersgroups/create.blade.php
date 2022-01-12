@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Privileges Create</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.usersgroups.store')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Group Name:</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="privileges-list">
                        @if (false !== $privileges) @foreach ($privileges as $privi)
                          <div class="singel-privi">
                            <input type="checkbox" name="privi[]" value="{{$privi->id}}" id="{{$privi->id}}">
                            <label for="{{$privi->id}}">{{$privi->name}}</label>
                          </div>
                        @endforeach  @endif

                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-plus fa-fw" ></i>Create</button>
                      <a href="{{route('admin.usersgroups.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->

@endsection
