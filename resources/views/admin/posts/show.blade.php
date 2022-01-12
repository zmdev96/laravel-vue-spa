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
                        <span>{{ $post->title }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Category:</label>
                        <span>{{ $parent->name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Sub Category:</label>
                        <span>{{ $post->sub->name }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Description:</label>
                        <span>{{ $post->description }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Posted By:</label>
                        <span>{{ $post->user()->first() !== null ? $post->user()->first()->first_name .' '. $post->user()->first()->last_name .' (Admin)': $post->member()->first()->first_name .' '. $post->member()->first()->last_name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Posted at</label>
                        <span>{{ $post->created_at }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Approved at:</label>
                        <span>{{ $post->approved_at }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Approved By:</label>
                        <span>{{ $post->approved_by()->first()->first_name }} {{ $post->approved_by()->first()->last_name }}</span>
                      </div>
                      <div class="col-md-3">
                        <label>Views:</label>
                        <span>{{ $post->views }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Status:</label>
                        <span>{{ $post->status }}</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label >Image:</label>
                        <img src="{{\Storage::url($post->image)}}" alt="" id="Image" class="img-responsive " width="300" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10">
                        <label >Content:</label>
                        <p>{!! $post->content !!}</p>
                        <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-success"><i  class="fas fa-edit fa-fw" ></i>Edit</a>

                        <a href="{{route('admin.posts.index')}}" class="btn btn-danger"><i  class="fas fa-times fa-fw" ></i>Back</a>
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
