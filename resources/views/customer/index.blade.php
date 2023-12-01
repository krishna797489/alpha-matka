@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <table class="table table-striped" id="customer-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>phone</th>
                      <th>Mpin</th>
                      <th>created_at</th>
                      <th>Action</th>
                      <th>View</th>

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


  <script>
    $(document).ready(function () {
      var table = $('#customer-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('customer.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'name', name: 'name'},
      { data: 'email', name: 'email'},
      { data: 'phone', name: 'phone'},
      { data: 'mpin', name: 'mpin'},
      { data: 'created_at', name: 'created_at'},
      { data: 'status', name: 'status'},
      {data: 'action', name: 'action', orderable: false},
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
                    url: '{{ route("customer.status") }}',
                    data: {
                        id: bid,
                        // Include the CSRF token in the request data
                        _token: csrfToken
                    },
                    success: function (data) {
                        if (data.error == 1) {
                        } else {
                             $('#customer-details-list').DataTable().draw();
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




@endsection
