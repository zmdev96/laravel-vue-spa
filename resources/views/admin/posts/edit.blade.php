@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Post Edit</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-content">
                    <form class="" action="{{route('admin.posts.update' , $post->id)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title">Title:</label>
                          <input type="text" name="title" class="form-control" id="title" value="{{old('title', $post->title)}}">
                          @if ($errors->has('title'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('title') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('cat_id') ? ' has-error' : '' }}">
                          <label for="name">Category:</label>
                          <select class="form-control" name="cat_id" id="cat_id">
                            <option value="" selected>Choose Category</option>
                            @foreach ($categories as $cat)
                              <option value="{{$cat->id}}"  {{ $cat->id == $parent->id ? 'selected' : '' }} >{{$cat->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('cat_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('cat_id') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('sub_id') ? ' has-error' : '' }}">
                          <label for="name">Sub Category:</label>
                          <select class="form-control" name="sub_id" id="sub_cat">
                            <option value="" selected>Choose Sub Category</option>

                          </select>
                          @if ($errors->has('sub_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('sub_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-9 {{ $errors->has('desc') ? ' has-error' : '' }}">
                          <label for="Desc">Description:</label>
                          <input type="text" name="desc" class="form-control" id="Desc" value="{{old('desc', $post->description)}}">
                          @if ($errors->has('desc'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('desc') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 ">
                          <label for="PostedBy">Posted By:</label>
                          <input type="text" class="form-control" id="PostedBy" value="{{ $post->user()->first() !== null ? $post->user()->first()->first_name .' '. $post->user()->first()->last_name .' (Admin)': $post->member()->first()->first_name .' '. $post->member()->first()->last_name }}" disabled>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3 {{ $errors->has('status') ? ' has-error' : '' }}">
                          <label for="Status">Status:</label>
                          <select class="form-control" name="status" id="Status">
                            <option value="published" {{ $post->status == 'published' ? 'selected' : ''}}>Published</option>
                            <option value="pending" {{ $post->status == 'pending' ? 'selected' : ''}}>Pending</option>
                          </select>
                          @if ($errors->has('status'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('status') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Image">image:</label>
                          <div class="image-content">
                            <img src="{{\Storage::url($post->image)}}" alt="" id="Image" class="img-responsive " width="300">
                            <label for="new_image" class="upload-new"><span class="icon"><i class="fas fa-upload"></i> Upload New</span> <span class="image_name"></span></label>
                            <input type="file" name="image" class="" id="new_image" value="{{old('image')}}">
                          </div>
                          @if ($errors->has('image'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('image') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('content') ? ' has-error' : '' }}">
                          <label for="Desc">Content:</label>
                          <textarea name="content" rows="8" cols="80" class="form-control" id="blog_content">{{$post->content}}</textarea>
                          @if ($errors->has('content'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                      <a href="{{route('admin.posts.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
  <!-- End Page Content -->
  @section('content_js')
    <script src="/assets/admin/vendor/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
        // Ckeditor init
        CKEDITOR.replace('blog_content', {
          width: '100%',
          height: 500,
          filebrowserUploadUrl: "{{route('admin.filemanager.upload', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form',
          filebrowserImageBrowseUrl: '/file-manager/ckeditor'
        });
        CKEDITOR.on('dialogDefinition', function (e){
          dialogName = e.data.name;
          dialogDefinition = e.data.definition;
          if (dialogName == 'image') {
            dialogDefinition.removeContents('Link');
            dialogDefinition.removeContents('advanced');

          }
        });

        // get the image name form input type file
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.image-content .image_name').css('display', 'inline-block');

            $('.image-content .image_name').html(fileName);
        });

        // Get the cuurent sub catrgories depinded on the category
        var cat_id = $('#cat_id').val()
        $.ajax({
          url: "{{route('admin.posts.edit', $post->id)}}",
          type:"get",
          data:{cat_id:cat_id},
          success:function(data)
          {
            if (data.status === true) {
              $('#sub_cat').empty();
              $('#sub_cat').append('<option value="" >Choose Sub Category</option>');
              $('#sub_cat').removeAttr('disabled');
              $(data.sub_cat).each(function(index , value){
                if (value.id == data.current) {
                  var select = 'selected';
                }else {
                  var select = '';
                }
                $('#sub_cat').append('<option value="'+ value.id +'" '+ select +'>'+ value.name +'</option>');
              });
            }
          }
        });

        // Categories and Sub Categories
        $('#cat_id').on('change', function (){
          var cat_id = $(this).val();
          var token = $('meta[name="csrf-token"]').attr('content');
          if (cat_id > 0) {
            $.ajax({
              url: "{{route('admin.posts.create')}}",
              type:"get",
              data:{cat_id:cat_id},
              success:function(data)
              {
                if (data.status === true) {
                  $('#sub_cat').empty();
                  $('#sub_cat').append('<option value="" selected>Choose Sub Category</option>');
                  $('#sub_cat').removeAttr('disabled');
                  $(data.sub_cat).each(function(index , value){
                    $('#sub_cat').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                  })
                }
              }
            });
          }else {
            $('#sub_cat').empty();
            $('#sub_cat').append('<option value="" selected>Choose Sub Category</option>');
            $('#sub_cat').attr('disabled', 'disabled');
          }
        })
      });
    </script>
  @endsection
@endsection
