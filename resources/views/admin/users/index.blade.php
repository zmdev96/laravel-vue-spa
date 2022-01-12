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
              <h6 class=" font-weight-bold text-primary">Users Manage</h6>
              <div class="card-action float-right">
                <a class="btn btn-success btn-sm" href="{{ route('admin.users.create')}}"><i class="fas fa-user-plus fa-fw"></i> Create</a>
              </div>
            </div>
            <div class="card-body">
              @if (session()->has('message'))
                <div class="status-message alert alert-{{session()->get('status')}}">{{session()->get('message')}}</div>
              @endif

              <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Email</th>
                      <th>Group</th>
                      <th>Created at</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->group->name }}</td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        <td class="text-center">
                          <a class="btn btn-danger btn-sm" href=""
                           onclick="event.preventDefault(); document.getElementById('delete_form{{$user->id}}').submit();">
                           <i class="fas fa-trash fa-fw" ></i>
                         </a>
                         <a class="btn btn-info btn-sm" href="{{ route('admin.users.show' , $user->id) }}"><i class="fas fa-eye fa-fw"></i></a>
                          <a class="btn btn-success btn-sm" href="{{ route('admin.users.edit' , $user->id) }}"><i class="fas fa-edit fa-fw"></i></a>
                          <form id="delete_form{{$user->id}}" action="{{ route('admin.users.destroy' , $user->id) }}" method="post">
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
