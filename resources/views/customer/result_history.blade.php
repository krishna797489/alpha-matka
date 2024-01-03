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
                      <td>

                          @foreach ($result->games as $game)
                              {{ $game->name }}
                              @if (!$loop->last)
                                  ,
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
            </div>
          </div>
        </div>

      </div>
    </section>


  </div>

  @section('scripts')
<script>
  $(document).ready(function() {
    $('#customer-details-list').DataTable();
  });
</script>
@endsection
@yield('scripts')

  @endsection
