@extends('admin.layouts.app')
@section('content')
  @section('content_css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/file-manager/css/file-manager.css') }}">
  @endsection
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header">
        <h6 class=" font-weight-bold text-primary">File Manager</h6>
      </div>
      <div class="card-body">
        <div style="height: 600px;">
            <div id="fm"></div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>

  <!-- End Page Content -->
@section('content_js')
  <script src="{{ asset('assets/admin/vendor/file-manager/js/file-manager.js') }}"></script>

@endsection
@endsection
