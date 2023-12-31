@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    </section>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row" id="dashboard">


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">

                <h3 class="m-b-0" id="customers">-</h3>
                <p>Total No. of Customers</p>
              </div>
              <div class="icon">
              <!-- <i class="ion ion-bag"></i> -->
              </div>
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="games">-</h3>

                <p>Total No. of Games</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-stats-bars"></i> --}}
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="enablegames">-</h3>

                <p>Total No. of Enabled Games</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-person-add"></i> --}}
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="todaybid">-</h3>

                <p>Today BID Amount</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-pie-graph"></i> --}}
              </div>

            </div>
          </div>

          <!-- ./col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <script>
function get(){
 var id = $("#dashboard").val();
 $.ajax({
  method: "Post",
  url: '{{route("dashboard.get")}}',
  data: {id:id},
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
  success: function (data) {
    $("#customers").text(data.customers);
    $("#games").text(data.games);
    $("#enablegames").text(data.enablegames);
    $("#todaybid").text(data.todaybid);

  },
 });
}
  </script>
  <script>
    $(document).ready(function () {
       get();
    });
 </script>
@endsection
