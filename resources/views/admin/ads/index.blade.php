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
        <h6 class=" font-weight-bold text-primary">Ads Manage</h6>
        <div class="card-action float-right">
          <a class="btn btn-success btn-sm" href="{{ route('admin.ads.create')}}"><i class="fas fa-plus fa-fw"></i> Create</a>
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
                <th>Title</th>
                <th>Added By</th>
                <th>Category</th>
                <th>Purchase type</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ads as $ad)
                <tr>
                  <td>{{ $ad->id }}</td>
                  <td>{{ $ad->title }}</td>
                  <td>{{ $ad->user !== null ? $ad->user->first_name .' '. $ad->user->last_name .' (Admin)': $ad->member->first_name .' '. $ad->member->last_name }}</td>
                  <td> {{ $ad->category->name }} </td>
                  <td>{{ ucfirst($ad->purchase_type )}}</td>
                  <td class=""><span class="btn btn-{{ $ad->status == 'published' ? 'success': 'danger'  }} btn-sm">{{ $ad->status == 'published' ? 'Public': 'Pending' }}</span></td>
                  <td>{{ $ad->created_at->format('Y/m/d') }}</td>
                  <td class="text-center">
                    <a class="btn btn-danger btn-sm" href=""
                     onclick="event.preventDefault(); document.getElementById('delete_form{{$ad->id}}').submit();">
                     <i class="fas fa-trash fa-fw" ></i></a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.ads.edit' , $ad->id) }}"><i class="fas fa-edit fa-fw"></i></a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.ads.show' , $ad->id) }}"><i class="fas fa-eye fa-fw"></i></a>

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.ads.approve' , $ad->id) }}"><i class="fas fa-check fa-fw"></i></a>

                    <form id="delete_form{{$ad->id}}" action="{{ route('admin.ads.destroy' , $ad->id) }}" method="post">
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
