@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Games</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Games</li>
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
               
                <a href="{{route('customer.add')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="customer-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>phone</th>
                      <th>Action</th>
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
      { data: 'image', name: 'image'},  
      { data: 'name', name: 'name'},
      { data: 'email', name: 'email'},  
      { data: 'phone', name: 'phone'},   
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>


<script>
   function customerdeleted(bid) {
 Swal.fire({
    title: 'Are you sure you want to delete this?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Okay',
 }).then((result) => {
    if (result.isConfirmed) {
       $.ajax({
          method: "post",
          url: '{{route("customer.delete")}}',
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
                $('#customer-details-list').DataTable().draw();
             }          
          },
       });
    } else if (result.isDenied) {
     
    }
 });
}
</script>

@endsection
