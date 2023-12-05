
@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Detail</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">View User
                </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <!-- Main content -->
    <section class="content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-fund-modal"><i class="fa fa-plus-circle"></i>
            Add fund</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-withdraw-modal"><i class="fa fa-plus-circle"></i>
                Withdraw Fund</button>


    {{-- model open --}}
    <div class="modal fade" id="add-fund-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title">Add Fund</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('customer.addpoint')}}" method="post" id="form-add-games">
                        <input type="hidden" id="add-games-id" name="id" value="">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Amount <span class="input-mandatory">*</span></label>
                                <input type="number" name="" class="form-control" placeholder="Enter Amount">
                                <span class="text-danger error-msg name"></span>
                            </div>
                        </div>
                       </div>
                   </div>
                <div class="modal-footer">
                    <button type="button"   class="btn btn-primary">Save</button>
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
      </div>


      <div class="modal fade" id="add-withdraw-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title">Withdraw Fund</h4>
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
                                <label class="form-control-label">Amount <span class="input-mandatory">*</span></label>
                                <input type="number" name="" class="form-control" placeholder="Enter Amount">
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
      {{-- model close --}}

        <div class="container-fluid">
          <div class="row">
            <div class="col-8">
              <div class="card">
                {{-- <div class="card-header text-end">

                  <!-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-games-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> -->

                  <a href="{{route('customer.add')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
                </div> --}}
                <!-- /.card-header -->
                {{-- <div class="card-body"> --}}
                  <table class="table table-bordered table-striped" id="customer-details-list">


                    <thead>

                        <tr>
                            <th class="w-20">Name</th>
                            <th>Details</th>
                            <th class="w-20">Name</th>
                            <th>Details</th>
                        </tr>
                    </thead>


                    <tbody>

                        <tr>
                            <td>User Name</td>
                            <td>{{$item->name}}</td>
                            <td>Email</td>
                            <td>{{$item->email}}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{$item->phone}}</td>
                            <td>Password</td>
                            <td>
                                @if(isset($item->password))
                                    Password is Hidden
                                @else
                                    {{ $item->password }}
                                    No any password create
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Security Pin</td>
                            <td><span id="security_pin_text">{{$item->mpin}}</span> <button class="btn btn-primary btn-sm" id="changePin">Change</button></td>
                            <td>User Status</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge badge-primary">Active</span>
                                @elseif($item->status == 0)
                                    <span class="badge badge-danger">Closed</span>
                                @else
                                    <!-- Handle other cases if needed -->
                                    <span class="badge badge-secondary">Unknown Status</span>
                                @endif
                            </td>
                         </tr>
                        <tr>
                            <td>Flat/Plot No.</td>
                            <td>N/A</td>
                            <td>Address Lane 1</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>Address Lane 2</td>
                            <td>N/A</td>
                            <td>Area</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td>N/A</td>
                            <td>State Name</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>District Name</td>
                            <td>N/A</td>
                            <td>Creation Date</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Last Seen</td>
                            <td>{{$item->updated_at}}</td>
                                                                    <td>Betting Status</td>
                                <td><badge class="badge badge-primary">Allowed For Betting</badge></td>
                                                            </tr>


                        <tr>
                            <td>Transfer Point Permission</td>
                            <td>
                                <span id="tp_stats"><badge class="badge badge-danger">Deactivated</badge></span>
                                &nbsp;&nbsp;&nbsp;

                                <a class="danger transferPointStatus" href="" id="1-96-tb_user-user_id-transfer_point_status"><button class="btn btn-outline-success btn-xs m-l-5" type="button">Change</button></a>
                                 </td>
                        </tr>



                    </tbody>

                  </table>
                {{-- </div> --}}
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="">
                        <h4 class="card-title">Payment Detail</h4>
                        <div class="table-responsive m-t-20">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="w-45">Name</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody class="table_font">
                                    <tr>
                                        <td>Bank Name</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Branch Address</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>A/c Holder Name</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>A/c Number</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>IFSC Code</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Paytm No.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Google Pay No.</td>
                                        <td>7738912081</td>
                                    </tr>
                                    <tr>
                                        <td>PhonePe No.</td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>

        </div><!-- /.container-fluid -->



	</div>
</div>

      </section>
    <!-- /.content -->
  </div>
  {{-- <script>
    $(document).ready(function () {
      var table = $('#customer-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('customer.list') }}",
      columns: [
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
</script> --}}

<script>
    function editgame(){
    var fdata = $('#add-fund-modal').serialize();
    $.ajax({
        method : "post",
        url :'{{route("games.edit")}}',
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

@endsection
