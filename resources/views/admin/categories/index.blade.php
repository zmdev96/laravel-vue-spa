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
        <h6 class=" font-weight-bold text-primary">Categories Manage</h6>
        <div class="card-action float-right">
          <a class="btn btn-success btn-sm" href="{{ route('admin.categories.create')}}"><i class="fas fa-plus fa-fw"></i> Create</a>
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
                <th>Child</th>
                <th>status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                      @if ($category->child->count() > 0)
                        @foreach ($category->child as $sub)
                          <span>{{$sub->name}},</span>
                        @endforeach
                      @else
                        <span>No Child</span>
                      @endif
                  </td>
                  <td class=""><span class="btn btn-{{ $category->status == 'enabled' ? 'success': 'danger'  }} btn-sm">{{ ucfirst($category->status) }}</span></td>
                  <td class="text-center">
                    <!--<a class="btn btn-danger btn-sm delete_ajax" href="" id="{{$category->id}}">
                     <i class="fas fa-trash fa-fw" ></i>
                    </a>-->
                    <a class="btn btn-danger btn-sm" href=""
                     onclick="event.preventDefault(); document.getElementById('delete_form{{$category->id}}').submit();">
                     <i class="fas fa-trash fa-fw" ></i></a>

                    <a class="btn btn-success btn-sm" href="{{ route('admin.categories.edit' , $category->id) }}"><i class="fas fa-edit fa-fw"></i></a>
                    <form id="delete_form{{$category->id}}" action="{{ route('admin.categories.destroy' , $category->id) }}" method="post">
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
  <script src="/assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      // Delete category
      $('.card .delete_ajax').click(function (e){
        e.preventDefault();
        var id = $(this).attr('id');
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: "/app-admin/categories/"+id+"",
          type:"post",
          data:{id:id, _method: 'DELETE', _token:token, type:'get_data'},
          success:function(data)
          {
            if (data.status === true) {
              if ($.trim(data.message.child)) {
                  $('#delete_modal').modal('show');
              }else {
              /*  deleteDate(id);
                $(this).parent().parent().fadeOut();*/
                console.log($(this));
                $('.card .delete_ajax').each( function(i , j){
                  console.log(j);
                  if ($(j).attr('id') == id) {
                    $(j).parent().parent().fadeOut();
                  }
                });
              }
            }
          }

        });
      });

      // Delete Function
      function deleteDate(id){
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: "/app-admin/categories/"+id+"",
          type:"post",
          data:{id:id, _method: 'DELETE', _token:token, type:'delete_data'},
          success:function(data)
          {
            if (data.status === true) {
              $('.status-message-ajax').css('display', 'block');
              $('.status-message-ajax').html(data.message);
            }
          }

        });
      }
    });
  </script>
@endsection
@endsection
