
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
        <a href="{{route('addfunduser')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>
            Add fund</a>
            <a href="{{route('withdrawadmin')}}" class="btn btn-primary" ><i class="fa fa-minus-circle"></i>
                Withdraw Fund</a>


    {{-- model open --}}







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
                          <td><?php echo ($item->mpin !== null) ? $item->mpin : 'Mobile Not Created'; ?></td>

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
                            <td><?php echo ($item->mpin !== null) ? $item->mpin : 'No MPIN created'; ?></td>


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

                            <td>Creation Date</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Last Seen</td>
                            <td>{{$item->updated_at}}</td>

                                                            </tr>






                    </tbody>

                  </table>
                {{-- </div> --}}
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




@endsection
