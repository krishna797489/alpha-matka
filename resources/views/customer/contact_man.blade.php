@extends('layouts.main')
@section('content')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Contact Settings Management
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
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="games-details-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contact Number</th>
                            <th>Whatsapp Number</th>
                            <th>Email Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
    <div class="modal fade" id="edit-games-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title">Edit Contact</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="post" id="form-edit-games">

                        <input type="hidden" id="edit-games-id" name="id" value="">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Mobile <span class="input-mandatory">*</span></label>
                                <input type="text" name="mobile" id="edit-games" class="form-control" placeholder="Contact No">
                                <span class="text-danger error-msg name"></span>
                            </div>
                        </div>
                      </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">WhatsApp No <span class="input-mandatory">*</span></label>
                                <input type="text" name="whatsApp" id="edit-games" class="form-control" placeholder="WhatsApp No">
                                <span class="text-danger error-msg name"></span>
                            </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Email Id <span class="input-mandatory">*</span></label>
                                <input type="text" name="email" id="edit-games" class="form-control" placeholder="Email Id">
                                <span class="text-danger error-msg name"></span>
                            </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  onclick="editgame()"class="btn btn-primary" >Save</button>
                    <button type="button"  class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
            </form>
            </div>
        </div>
      </div>



  </div>

  <script>
    $(document).ready(function () {
        var table = $('#games-details-list').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            ajax: "{{ route('contact.list') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'id' },
                { data: 'mobile', name: 'mobile' },
                { data: 'whatsApp', name: 'whatsApp' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false },
            ],
            order: [[1, 'asc']]
        });
    });
</script>

<script>

function edit(cid) {
    $.ajax({
        method: "get",
        url: '{{ route("contact.edit") }}',
        data: { id: cid },
        success: function (data) {
            $('#edit-games-id').val(data.id);
            $('#edit-games').val(data.mobile);
            $('#edit-whatsApp').val(data.whatsApp);
            $('#edit-email').val(data.email);
            $("#edit-games-modal").modal('show');
        }
    });
}


  </script>

<script>

function editgame() {
    var fdata = $('#form-edit-games').serialize();
    $.ajax({
        method: "post",
        url: '{{ route("contact.edit") }}',
        data: fdata,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.error == 1) {
                if (data.vderror == 1) {
                    printErrorMsg(data.errors, "#edit-games-modal");
                } else {
                    $("#edit-games-modal").modal('hide');
                    toastr.error(data.msg, 'danger');
                    $('#form-edit-games')[0].reset();
                }
            } else {
                $("#edit-games-modal").modal('hide');
                toastr.success(data.msg, 'success');
                $('#form-edit-games')[0].reset();
                $('#games-details-list').DataTable().draw();
            }
        }
    });
}

    </script>

@endsection
