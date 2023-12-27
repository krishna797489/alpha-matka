@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Declare Result</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Declare Result</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xl-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Select Game</h5>
                                </div>
                                <div class="card-body">
                                    @if (session('error'))
                                        <div id="error" class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div id="success" class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form action="#" method="">
                                        @csrf

                                        <div class="form-group">
                                            <label class="col-form-label">User List</label>
                                            <select required id="user" name="user"
                                                class="js-example-basic-single show_parent">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                        ({{ \Carbon\Carbon::parse($user->start_time)->format('h:i A') }} -
                                                        {{ \Carbon\Carbon::parse($user->end_time)->format('h:i A') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Add other form fields as needed -->
                                        <div class="form-group">
                                            <label class="col-form-label">Result Date</label>
                                            <div class="input-group" style="width: 33%;">
                                                <input class="form-control" id="result_date" name="result_date"
                                                    type="date" placeholder="Select Date" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add other form fields as needed -->

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary waves-light m-t-10" id="submitBtn"
                                                onclick="toggleComponents()">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <form action="#" method="post" id="resultform" class="display_none">
            <div class="row display_none" id="result_div">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="row">
                        <!-- Close Result Box -->
                        <div class="col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group bord col-md-5">
                                            <h5 class="tit_h">Open</h5>
                                        </div>
                                        <div class="form-group bord col-md-4">
                                            <label class="col-form-label">Panna:</label>
                                            <input style="width: 150%" class="form-control" type="number"
                                                name="open_number" required id="open_number" value=""
                                                placeholder="Enter 3 Digit Value">

                                            <label class="col-form-label">Result:</label>
                                            <input style="width: 150%" class="form-control" type="number"
                                                name="open_result" id="open_result" value="" placeholder="Result">
                                        </div>
                                        <div class="form-group bord col-md-4" id="open_div_msg">
                                            <button type="button" class="btn btn-primary waves-light m-t-10"
                                                id="openSaveBtn" name="openSaveBtn" onclick="OpenSaveData();">Save</button>
                                            <button type="button" class="btn btn-primary waves-light m-t-10 display_none"
                                                id="openDecBtn" name="openDecBtn"
                                                onclick="decleareOpenResult();">Declare</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Open Result Box -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group bord col-md-5">
                                        <h5 class="tit_h">Close</h5>
                                    </div>
                                    <div class="form-group bord col-md-4">
                                        <label class="col-form-label">Panna:</label>
                                        <input style="width: 150%" class="form-control" type="number" name="open_number"
                                            required id="open_number" value="" placeholder="Enter 3 Digit Value">

                                        <label class="col-form-label">Result:</label>
                                        <input style="width: 150%" class="form-control" type="number"
                                            name="open_result" id="open_result" value="" placeholder="Result">
                                    </div>
                                    <div class="form-group bord col-md-7" id="open_div_msg">
                                        <button type="button" class="btn btn-primary waves-light m-t-10"
                                            id="openSaveBtn" name="openSaveBtn" onclick="OpenSaveData();">Save</button>
                                        <button type="button" class="btn btn-primary waves-light m-t-5 display_none"
                                            id="openDecBtn" name="openDecBtn"
                                            onclick="decleareOpenResult();">Declare</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="error2"></div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Add any additional form elements or buttons here -->
    <!-- For example, a submit button -->
    </form>



    <!-- Include flatpickr library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Initialize flatpickr on the input field
        flatpickr("#result_date", {
            dateFormat: "Y-m-d", // Customize the date format if needed
            enableTime: false, // Disable time selection
            // Add more options or customize as needed
        });
    </script>

    <script>
        function toggleComponents() {
            var resultForm = document.getElementById("resultform");

            if (resultForm.style.display === "none") {
                resultForm.style.display = "block";
            } else {
                resultForm.style.display = "none";
            }
        }
    </script>
@endsection
