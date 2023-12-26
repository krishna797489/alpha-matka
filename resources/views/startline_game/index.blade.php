
@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Game Name</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Game Name</li>
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
              <div class="card-header text-end">

                <!-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-games-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-games-modal"><i class="fa fa-plus-circle"></i>
                Create New</button>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="games-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                     <th>Name</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Game Code</th>
                      <th>Action</th>
                      <th>Status</th>
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
              <h4 class="modal-title">Add game</h4>
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
                            <span class="text-danger error-msg name"></span>
                        </div>
                    </div>

                 <div class="col-md-12">
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                  <label class="form-control-label">Start time <span class="input-mandatory">*</span></label>
                    <div class="input-group date timepicker1" id="start_time" data-target-input="nearest">

                    <input type="text" placeholder="11:00:00" class="form-control datetimepicker-input datetimepicker" data-target="#start_time" name="start_time"/>
                      <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                      <span class="text-danger error-msg start_time"></span>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                 </div>
                 <div class="col-md-12">
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                  <label class="form-control-label">End time <span class="input-mandatory">*</span></label>
                    <div class="input-group date timepicker1" id="end_time" data-target-input="nearest">
                    <input type="text" placeholder="12:00:00" class="form-control datetimepicker-input datetimepicker" data-target="#end_time" name="end_time"/>
                      <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                      <span class="text-danger error-msg end_time"></span>
                  </div>

                </div>
                 </div>
                 <div class="col-md-12">
                  <div class="form-group">
                      <label class="form-control-label">Game Code <span class="input-mandatory">*</span></label>
                      <input type="text" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" name="code" class="form-control" placeholder="code Ex 1234-1234-1234">
                      <span class="text-danger error-msg name"></span>
                  </div>
              </div>
                   </div>
               </div>
            <div class="modal-footer">
                <button type="button"  onclick="addgame()" class="btn btn-primary">Save</button>
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
  </div>


      <div class="modal fade" id="edit-games-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
              <h4 class="modal-title">Edit game</h4>
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
                            <label class="form-control-label">Name <span class="input-mandatory">*</span></label>
                            <input type="text" name="name" id="edit-games" class="form-control" placeholder="Name">
                            <span class="text-danger error-msg name"></span>
                        </div>
                    </div>


                <div class="col-md-12">
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                  <label class="form-control-label">Start time <span class="input-mandatory">*</span></label>
                    <div class="input-group date timepicker1" id="start_time_edit" data-target-input="nearest">
                    <input type="text" placeholder="11:00:00" id="edit-start-time" class="form-control datetimepicker-input datetimepicker" data-target="#start_time_edit" name="start_time"/>

                      <div class="input-group-append" data-target="#start_time_edit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                      <span class="text-danger error-msg start_time"></span>
                  </div>
                </div>
                 </div>

                 <div class="col-md-12">
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                  <label class="form-control-label">End time <span class="input-mandatory">*</span></label>
                    <div class="input-group date timepicker1" id="end_time_edit" data-target-input="nearest">
                    <input type="text" placeholder="12:00:00" id="edit-end-time" class="form-control datetimepicker-input datetimepicker" data-target="#end_time_edit" name="end_time"/>
                      <div class="input-group-append" data-target="#end_time_edit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                    <span class="text-danger error-msg end_time"></span>
                  </div>
                  <!-- /.form group -->
                </div>
                 </div>
                 <div class="col-md-12">
                  <div class="form-group">
                      <label class="form-control-label">Game Code <span class="input-mandatory">*</span></label>
                      <input type="text" id="edit-code" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" name="code" class="form-control" placeholder="code Ex 1234-1234-1234">
                      <span class="text-danger error-msg name"></span>
                  </div>
              </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button"  onclick="editgame()"class="btn btn-primary">Save</button>
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      var table = $('#games-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('starlinegames.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'name', name: 'name'},
      { data: 'start_time', name: 'start_time'},
      { data: 'end_time', name: 'end_time'},
      { data: 'code', name: 'code'},
      { data: 'action', name: 'action', orderable: false},
      { data: 'status', name: 'status', orderable: false},
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>

 <script>
    function changestatus(bid) {
        Swal.fire({
            title: 'Are you sure you want to change the status?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Okay',
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the CSRF token from the meta tag
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "POST",
                    url: '{{ route("starlinegames.status") }}',
                    data: {
                        id: bid,
                        // Include the CSRF token in the request data
                        _token: csrfToken
                    },
                    success: function (data) {
                        if (data.error == 1) {
                        } else {
                             $('#games-details-list').DataTable().draw();
                            //location.reload();
                        }
                    },
                });
            } else if (result.isDenied) {
                // Handle denied action
            }
        });
    }
  </script>


 <script>
function get(cid){
    $.ajax({
        method : "get",
        url : '{{route("starlinegames.get")}}',
        data : {id:cid},

        success: function(data){
            $('#add-games-id').val(data.id);
            $('#add-games').val(data.name);
            $('#add-start-time').val(data.start_time);
            $('#add-end-time').val(data.end_time);
            $("#add-games-modal").modal('show');
        }
    })
  }

</script>
<script>
    function addgame(){
        // $.loader.on()
       var fdata = $('#form-add-games').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("starlinegames.store")}}',
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


 <script>

  function edit(cid){
    $.ajax({
        method : "get",
        url : '{{route("starlinegames.get")}}',
        data : {id:cid},
        success: function(data){
            $('#edit-games-id').val(data.id);
            $('#edit-games').val(data.name);
            $('#edit-start-time').val(data.start_time);
            $('#edit-end-time').val(data.end_time);
            $('#edit-code').val(data.code);

            $("#edit-games-modal").modal('show');
        }
    })
  }

</script>

<script>

function editgame(){
    var fdata = $('#form-edit-games').serialize();
    $.ajax({
        method : "post",
        url :'{{route("starlinegames.edit")}}',
        data :fdata,
        headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
        success: function(data){
            if(data.error == 1){
                if (data.vderror == 1) {
                    printErrorMsg(data.errors,"#edit-games-modal");
                }else{
                      $("#edit-games-modal").modal('hide');
                      toastr.error(data.msg,'danger');
                      $('#form-edit-games')[0].reset();
                   }
            }else{
                    $("#edit-games-modal").modal('hide');
                    toastr.success(data.msg,'success');

                   $('#form-edit-games')[0].reset();
                   $('#games-details-list').DataTable().draw();
            }
        }
    })
}
</script>


<script>
   function gamedeleted(bid) {
 Swal.fire({
    title: 'Are you sure you want to delete this?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Okay',
 }).then((result) => {
    if (result.isConfirmed) {
       $.ajax({
          method: "post",
          url: '{{route("starlinegames.delete")}}',
          data: {id:bid},
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
          success: function (data) {
             if (data.error == 1) {
              toastr.error(data.msg,'danger');

             }else{
              toastr.success(data.msg,'success');
             console.log(toastr.success);
                $('#games-details-list').DataTable().draw();
             }
          },
       });
    } else if (result.isDenied) {

    }
 });
}
</script> -->
@endsection
