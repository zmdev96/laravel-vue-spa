@extends('admin.layouts.app')
@section('content')
  @section('content_css')
    <!-- Custom styles for this page -->
<link href="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  @endsection
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header">
        <h6 class=" font-weight-bold text-primary">Sub Categories Manage</h6>
        <div class="card-action float-right">
          <a class="btn btn-success btn-sm" href="{{ route('admin.sub-categories.create')}}"><i class="fas fa-plus fa-fw"></i> Create</a>
        </div>
      </div>
      <div class="card-body">
        @if (session()->has('message'))
          <div class="status-message alert alert-{{session()->get('status')}}">{{session()->get('message')}}</div>
        @endif
        <div class="status-message-ajax alert alert-success"></div>


        <div class="table-responsive">
          <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sub_categories as $sub)
                <tr>
                  <td>{{ $sub->id }}</td>
                  <td>{{ $sub->name }}</td>
                  <td>{{$sub->parent->name}}</td>
                  <td class=""><span class="btn btn-{{ $sub->status == 'enabled' ? 'success': 'danger'  }} btn-sm">{{ ucfirst($sub->status) }}</span></td>
                  <td class="text-center">
                    <a class="btn btn-danger btn-sm" href=""
                     onclick="event.preventDefault(); document.getElementById('delete_form{{$sub->id}}').submit();">
                     <i class="fas fa-trash fa-fw" ></i></a>

                    <a class="btn btn-success btn-sm" href="{{ route('admin.sub-categories.edit' , $sub->id) }}"><i class="fas fa-edit fa-fw"></i></a>
                    <form id="delete_form{{$sub->id}}" action="{{ route('admin.sub-categories.destroy' , $sub->id) }}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


  <!-- End Page Content -->
@section('content_js')
  <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
@endsection
@endsection
