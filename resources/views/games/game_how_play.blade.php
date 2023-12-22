

@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">How To Play</li>
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
              <!-- /.card-header -->
              <div class="card">
                <div class="card-header">
                  <h5>How To Play</h5>
                </div>
                  <div class="card-body">
                      <form action="{{route('howtoplaypost')}}" class="theme-form mega-form" id="howToPlayFrm" method="post">
                        @if(isset($success) && $success)
                        <div class="alert alert-success">
                            Data created successfully.
                        </div>
                    @elseif(isset($error) && $error)
                        <div class="alert alert-danger">
                            Failed to create data.
                        </div>
                    @endif
                        @csrf
                          <div class="form-group">
                              <label>How To Play Content</label>
                              <textarea class="form-control textarea1" name="description"    rows="10" >
                                @if ($errors->has('description'))
                                  <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                                </textarea>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Video Link</label>
                              <input type="text" required name="video_link" id="video_link" class="form-control" placeholder="Enter Video Link"/>
                              @if ($errors->has('video_link'))
                                  <div class="text-danger">{{ $errors->first('video_link') }}</div>
                                @endif
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn">Submit</button>
                          </div>
                          <div class="form-group">
                              <div id="error"></div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
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



  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
      $(document).ready(function () {
          // Check if the success message exists, and if so, hide it after 3000 milliseconds (3 seconds)
          if ($('.alert-success').length > 0) {
              setTimeout(function () {
                  $('.alert-success').fadeOut('fast');
              }, 3000);
          }
      });
  </script>






@endsection












