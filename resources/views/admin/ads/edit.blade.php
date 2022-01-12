@extends('admin.layouts.app')
@section('content')

  <!-- Begin Page Content -->
  <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header">
              <h6 class=" font-weight-bold text-primary">Ads Edit</h6>
              <div class="card-action float-right">
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-content">
                    <form class="" action="{{route('admin.ads.update', $ad->id)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{method_field('PUT')}}

                      <div class="form-row">
                        <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="title">Title:</label>
                          <input type="text" name="title" class="form-control" id="title" value="{{old('title', $ad->title)}}">
                          @if ($errors->has('title'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('title') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="address">Address:</label>
                          <input type="text" name="address" class="form-control" id="address" value="{{old('address', $ad->address)}}">
                          @if ($errors->has('address'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('address') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('cat_id') ? ' has-error' : '' }}">
                          <label for="cat_id">Category:</label>
                          <select class="form-control" name="cat_id" id="cat_id">
                            <option value="" selected>Choose Ads Category</option>
                            @foreach ($ads_categories as $cat)
                              <option value="{{$cat->id}}" {{ $cat->id == $ad->ads_category_id ? 'selected' : '' }}>{{$cat->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('cat_id'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('cat_id') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 {{ $errors->has('desc') ? ' has-error' : '' }}">
                          <label for="Desc">Description:</label>
                          <input type="text" name="desc" class="form-control" id="Desc" value="{{old('desc', $ad->description)}}">
                          @if ($errors->has('desc'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('desc') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3 {{ $errors->has('purchase_type') ? ' has-error' : '' }}">
                          <label for="purchase_type">Purchase type:</label>
                          <select  name="purchase_type" class="form-control" id="purchase_type">
                            <option value="" selected >Choose Type</option>
                            <option value="free" {{ $ad->purchase_type == 'free' ? 'selected' : '' }}>Free</option>
                            <option value="paid" {{ $ad->purchase_type == 'paid' ? 'selected' : '' }}>Paid</option>
                          </select>
                          @if ($errors->has('purchase_type'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('purchase_type') }}</strong>
                              </span>
                          @endif
                        </div>
                          <div class="form-group col-md-3 ads-price-edit {{ $errors->has('price') ? ' has-error' : '' }} {{ $ad->purchase_type == 'free' ? 'ads-price' : '' }}">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" id="price" value="{{old('price', $ad->price)}}">
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Image">image:</label>
                          <div class="image-content">
                            <img src="{{\Storage::url($ad->image)}}" alt="" id="Image" class="img-responsive " width="300" height="200">
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
                          <label for="ads_content">Content:</label>
                          <textarea name="content" rows="8" cols="80" class="form-control" id="ads_content">{{old('content', $ad->content)}}</textarea>
                          @if ($errors->has('content'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success"><i style="margin-left:-10px;" class="fas fa-check fa-fw" ></i>Update</button>
                      <a href="{{route('admin.ads.index')}}" class="btn btn-danger"><i style="margin-left:-10px;" class="fas fa-times fa-fw" ></i>Cancel</a>

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
        CKEDITOR.replace('ads_content', {
          width: '100%',
          height: 500,
          filebrowserUploadUrl: "{{route('admin.filemanager.ads_upload', ['_token' => csrf_token() ])}}",
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

        // purchase_type
        $('#purchase_type').on('change', function (){
          var type = $(this).val();
          if (type == 'paid') {
            $('.ads-price-edit').css('display', 'block');
          }else {
            $('.ads-price-edit').css('display', 'none');
          }
        });

        // get the image name form input type file
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.image-content .image_name').css('display', 'inline-block');

            $('.image-content .image_name').html(fileName);
        });


      });
    </script>
  @endsection
@endsection
