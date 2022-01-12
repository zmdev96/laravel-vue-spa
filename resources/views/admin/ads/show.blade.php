@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Post Show</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="show-content">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Title:</label>
                        <span>{{ $ad->title }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Category:</label>
                        <span>{{ $ad->category->name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Address:</label>
                        <span>{{ $ad->address }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Description:</label>
                        <span>{{ $ad->description }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Posted By:</label>
                        <span>{{ $ad->user->first_name }} {{ $ad->user->last_name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Posted at</label>
                        <span>{{ $ad->created_at->format('y/m/d') }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Updated at</label>
                        <span>{{ $ad->updated_at->format('y/m/d') }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Approved at:</label>
                        <span>{{ date('Y/m/d' , strtotime($ad->approved_at)) }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Approved By:</label>
                        <span>{{ $ad->approved_by()->first()->first_name }} {{ $ad->approved_by()->first()->last_name }}</span>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Status:</label>
                        <span>{{ $ad->status }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Purchase type:</label>
                        <span>{{ $ad->purchase_type }}</span>
                      </div>
                      <div class="col-md-3">
                        <div class="row">
                          <div class="col-md-6">
                            <label>Price:</label>
                            <span>{{ $ad->price }}</span>
                          </div>
                          <div class="col-md-6">
                            <label>Views:</label>
                            <span>{{ $ad->views }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label >Image:</label>
                        <img src="{{\Storage::url($ad->image)}}" alt="" id="Image" class="img-responsive " width="300" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <label >Content:</label>
                        <p>{!! $ad->content !!}</p>
                        <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <a href="{{route('admin.ads.edit', $ad->id)}}" class="btn btn-success"><i  class="fas fa-edit fa-fw" ></i>Edit</a>

                        <a href="{{route('admin.ads.index')}}" class="btn btn-danger"><i  class="fas fa-times fa-fw" ></i>Back</a>
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
