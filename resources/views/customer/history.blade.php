
@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">History</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Wallet Transaction History</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>S.no</th>
                                        <th>Amount</th>
                                        <th>Payment Type</th>
                                        <th>Credit/Debit</th>
                                        <th>Date</th>
                                        <!-- Add more table headers as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item as $historyRecord)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $historyRecord->point !== null ? $historyRecord->point : 'No amount' }}
                                            </td>

                                            <td>
                                                @if ($historyRecord->payment_type == 1)
                                                    Google Pay
                                                @elseif ($historyRecord->payment_type == 2)
                                                    Paytm
                                                    @elseif ($historyRecord->payment_type == 3)
                                                    PhonePe
                                                @else
                                                    Admin
                                                @endif
                                            </td>
                                             <td>
                                                @if($historyRecord->status==1)
                                                Credit
                                                @else
                                                Debit
                                                @endif
                                            <td>{{ $historyRecord->time }}</td>
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

    <!-- /.content -->
  </div>

  @endsection
