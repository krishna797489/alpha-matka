@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Game Rates</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Game Rates</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              {{-- <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div> --}}
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                    <h4 style="font-family: system-ui;font-size: larger;">Add Games Rate</h4>
                    <form action="{{route('types.Gamesratedpost')}}"  method="post">

                        @csrf
                        <div class="row"><br>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="name">Single Digit Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="single_digit1" required class="form-control" value="{{old('single_digit1')}}" id="exampleInputEmail1" placeholder="Single Digit Value 1">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Single Digit Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="single_digit2" required class="form-control" id="exampleInputEmail1" placeholder="Single Digit Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Jodi Digit Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Jodi_Digit1" required class="form-control" id="exampleInputEmail1" placeholder="Jodi Digit Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Jodi Digit Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Jodi_Digit1" required class="form-control" id="exampleInputEmail1" placeholder="Jodi Digit Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Single Pana Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Single_Pana1" required class="form-control" id="exampleInputEmail1" placeholder="Single Pana Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Single Pana Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Single_Pana2" required class="form-control" id="exampleInputEmail1" placeholder="Single Pana Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Double Pana Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Double_Pana1" required class="form-control" id="exampleInputEmail1" placeholder="Double Pana Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Double Pana Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Double_Pana2" required class="form-control" id="exampleInputEmail1" placeholder="Double Pana Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Tripple Pana Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Tripple_Pana1" required class="form-control" id="exampleInputEmail1" placeholder="Tripple Pana Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Tripple Pana Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Tripple_Pana2" required class="form-control" id="exampleInputEmail1" placeholder="Tripple Pana Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Half Sangam Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Half_Sangam1" required class="form-control" id="exampleInputEmail1" placeholder="Half Sangam Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Half Sangam Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Half_Sangam2" required class="form-control" id="exampleInputEmail1" placeholder="Half Sangam Value 2">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Full Sangam Value 1<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Full_Sangam1" required class="form-control" id="exampleInputEmail1" placeholder="Full Sangam Value 1">

                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">Full Sangam Value 2<span class="input-mandatory">*</span></label>
                                  <input type="number" name="Full_Sangam2" required class="form-control" id="exampleInputEmail1" placeholder="Full Sangam Value 2">

                                </div>
                              </div>
                                <div class="card-footer" style="background-color: unset;">
                                    <button type="submit" class="btn btn-primary" style="margin: -11px;">Submit</button>


                                </form>
                                </div>
                                <!-- /.card-body -->


                                </div>

                            </div>
            <!-- /.card -->

            <!-- general form elements -->

            <!-- /.card -->

            <!-- Input addon -->

            <!-- /.card -->
            <!-- Horizontal Form -->

            <!-- /.card -->

          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>

    function edit(cid){
      $.ajax({
          method : "get",
          url : '{{route("games.get")}}',
          data : {id:cid},
          success: function(data){
              $('#edit-games-id').val(data.id);
              $('#edit-games').val(data.name);
              $('#edit-start-time').val(data.start_time);
              $('#edit-end-time').val(data.end_time);
              $('#edit-code').val(data.code);

              $("#edit-games-modal").modal('show');
          }
      })
    }

  </script>

@endsection
