@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin Settings Managment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings Managment
            </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header text-end">

                <!-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-games-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> -->

                <a href="{{route('customer.add')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
              </div> --}}
              <!-- /.card-header --> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-games-modal"><i class="fa fa-plus-circle"></i>
                    Create New Admin</button>
              <div class="card-body p-3">

                <table class="table table-striped" id="Admis-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Mpin</th>
                      <th>User</th>
                      <th>Created_at</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <div class="modal fade" id="add-games-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
              <h4 class="modal-title">Add Admin</h4>
              @if(session('success'))
       <div class="alert alert-success">
        {{ session('success') }}
        </div>
        @endif
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-add-games">
                    <input type="hidden" id="add-games-id" name="id" value="">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Name <span class="input-mandatory">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                <span class="text-danger error-msg name">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Mobile <span class="input-mandatory">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="Mobile">
                                <span class="text-danger error-msg phone">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Email <span class="input-mandatory">*</span></label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                <span class="text-danger error-msg email">{{ $errors->first('email') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Password <span class="input-mandatory">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="text-danger error-msg password">{{ $errors->first('password') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Mpin <span class="input-mandatory">*</span></label>
                                <input type="text" name="mpin" class="form-control" placeholder="Mpin">
                                <span class="text-danger error-msg mpin">{{ $errors->first('mpin') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="addgame()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
        </div>
    </div>
  </div>


  <script>
    $(document).ready(function () {
      var table = $('#Admis-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('user.type0.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'name', name: 'name'},
      { data: 'email', name: 'email'},
      { data: 'phone', name: 'phone'},
      { data: 'mpin', name: 'mpin'},
      { data: 'usertype', name: 'usertype'},
      { data: 'created_at', name: 'created_at'},
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>
<script>
    function addgame(){
        // $.loader.on()
       var fdata = $('#form-add-games').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("admin.store")}}',
         data: fdata,
         success: function (data) {
            if (data.error == 1) {
               if (data.vderror == 1) {
                printErrorMsg(data.errors,"#add-games-modal");
               }else{
                  $("#add-games-modal").modal('hide');
                  appct.clearErrors("#add-games-modal");
                  toastr.error(data.msg,'danger');

                  $('#form-add-games')[0].reset();
               }
            }else{
               $("#add-games-modal").modal('hide');
               appct.clearErrors("#add-games-modal");
               toastr.success(data.msg,'success');

               $('#form-add-games')[0].reset();
               $('#games-details-list').DataTable().draw();
            }
            // $.loader.off()
         },
      });
   }
</script>



@endsection
