
@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bid History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Bid History</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Wallet Transaction History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>S.no</th>
                                        <th>Game Name</th>
                                        <th>Game Type</th>
                                        <th>Session</th>
                                        <th>Digit</th>
                                        <th>Close Digit</th>
                                        <th>Points</th>
                                        <th>Date</th>
                                        <!-- Add more table headers as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items  as $historyRecord)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$historyRecord->game_name}}</td>

                                            <td>
                                                @if ($historyRecord->game_id == 1)
                                                    Single Digit
                                                @elseif ($historyRecord->game_id == 2)
                                                    Jodi Digit
                                                    @elseif ($historyRecord->game_id == 3)
                                                    Single Panna
                                                    @elseif ($historyRecord->game_id == 4)
                                                    Double Panna
                                                    @elseif ($historyRecord->game_id == 5)
                                                    Tripple Panna
                                                    @elseif ($historyRecord->game_id == 6)
                                                    Half Sangam
                                                    @elseif ($historyRecord->game_id == 7)
                                                    Full Sangam
                                                @else
                                                    No Any Game Type
                                                @endif
                                            </td>
                                             <td>
                                                @if($historyRecord->session_type==0)
                                                Open
                                                @else
                                                Close
                                                @endif
                                            <td>{{ $historyRecord->digit }}</td>
                                            <td>{{ $historyRecord->close_digit }}</td>
                                            <td>{{ $historyRecord->point }}</td>
                                            <td>{{ $historyRecord->created_at }}</td>
                                            <!-- Add more table cells as needed -->
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No history records found for this user.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



    @endsection
