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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

<script>
    $(document).ready(function () {
      var table = $('#customer-details-list').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,

      ajax: "{{ route('resulthistory') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'games', name: 'games'},
      { data: 'result_date', name: 'result_date'},
      { data: 'Odigit', name: 'Odigit'},
      { data: 'Cdigit', name: 'Cdigit'},
      { data: 'created_at', name: 'created_at'},

      ],
      order: [[4, 'desc']],
      });
    });

</script>
@endsection
