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
        <h6 class=" font-weight-bold text-primary">Posts Manage</h6>
        <div class="card-action float-right">
          <a class="btn btn-success btn-sm" href="{{ route('admin.posts.create')}}"><i class="fas fa-plus fa-fw"></i> Create</a>
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
                <th>Posted By</th>
                <th>Sub Category</th>
                <th>Views</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ substr($post->title, 0, 15) }}..</td>
                  <td>{{ $post->user !== null ? $post->user->first_name .' '. $post->user->last_name .' (Admin)': $post->member->first_name .' '. $post->member->last_name }}</td>
                  <td> {{ $post->sub->name }} </td>
                  <td>{{ $post->views }}</td>
                  <td class=""><span class="btn btn-{{ $post->status == 'published' ? 'success': 'danger'  }} btn-sm">{{ ucfirst($post->status) }}</span></td>
                  <td>{{ $post->created_at->format('Y/m/d') }}</td>
                  <td class="text-center">
                    <a class="btn btn-danger btn-sm" href=""
                     onclick="event.preventDefault(); document.getElementById('delete_form{{$post->id}}').submit();">
                     <i class="fas fa-trash fa-fw" ></i></a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.posts.edit' , $post->id) }}"><i class="fas fa-edit fa-fw"></i></a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.posts.show' , $post->id) }}"><i class="fas fa-eye fa-fw"></i></a>

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.approve' , $post->id) }}"><i class="fas fa-check fa-fw"></i></a>

                    <form id="delete_form{{$post->id}}" action="{{ route('admin.posts.destroy' , $post->id) }}" method="post">
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
