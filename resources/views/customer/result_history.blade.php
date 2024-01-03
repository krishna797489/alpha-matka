@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Result History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Result History
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
                <table class="table table-striped" id="customer-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Game Name</th>
                      <th>Result Date</th>
                      <th>Open Number</th>
                      <th>Close Number</th>
                      <th>Declare Date</th>

                    </tr>
                  </thead>
               @foreach ($history as $result)
                  <tbody>
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    {{-- <td>{{ $result->user_id }}</td> --}}
                    <td>
                        {{-- Retrieve and display the names of games associated with the user_id --}}
                        @foreach ($result->games as $game)
                            {{ $game->name }}
                            @if (!$loop->last)
                                , {{-- Add a comma if it's not the last game --}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$result->result_date}}</td>
                    <td>{{$result->Odigit}}</td>
                    <td>{{$result->Cdigit}}</td>
                    <td>{{$result->created_at}}</td>
                </tr>
                  </tbody>
            @endforeach
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
  {{-- <script>
    $(document).ready(function () {
      var table = $('#customer-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('resulthistory') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'name', name: 'name'},
      { data: 'result_date', name: 'result_date'},
      { data: 'Odigit', name: 'Odigit'},
      { data: 'Cdigit', name: 'Cdigit'},

      ],
    //   order: [[1, 'desc']]
      });
    });
</script> --}}
  @endsection
