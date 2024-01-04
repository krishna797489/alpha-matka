@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Notification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Send Notification
            </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <div class="row">
        <div class="col-sm-12 col-xl-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body" >
                            @if(session('error'))
                                <div id="error" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>

                            @endif
                            @if(session('success'))
                                <div id="success" class="alert alert-success">
                                    {{ session('success') }}
                                </div>

                            @endif
                            <form class="theme-form mega-form" id="balanceAddFrm" name="balanceAddFrm" method="post" action="{{route('notificationstore')}}" >
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Notification Title</label>
                                    <input class="form-control"  name="tittle"  id="title" placeholder="Enter Title">
                                    <span class="text-danger error-msg mpin">{{ $errors->first('tittle') }}</span>

                                </div>

                                <div class="form-group">
                                    <label>Notification Content</label>
                                    <textarea class="form-control" name="content" placeholder="Enter Notification Content" rows="5" id="notification_content"></textarea>
                                    <span class="text-danger error-msg mpin">{{ $errors->first('content') }}</span>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    $(document).ready(function () {
        $('#balanceAddFrm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route("notificationstore") }}',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if (data.error == 1) {
                        if (data.vderror == 1) {
                            // Handle validation errors if needed
                            printErrorMsg(data.errors, "#balanceAddFrm");
                        } else {
                            // Show a toastr error message
                            toastr.error(data.msg, 'danger');
                        }
                    } else {
                        // Show a toastr success message
                        toastr.success(data.msg, 'success');

                        // Redirect to the desired page after 2 seconds
                        setTimeout(function() {
                            window.location.href = '{{ route("notification") }}';
                        }, 2000);
                    }
                },
                error: function (xhr, status, error,success) {
                    // Handle other errors if needed
                    toastr.error('Error occurred while saving notification.', 'Error');
                }
            });
        });
    });

</script> --}}

    @endsection
