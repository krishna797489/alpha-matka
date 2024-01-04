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
            </div>
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
                                    <form action="{{route('selectgame')}}" method="POST">
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
                                        <div class="form-group bord col-md-7" id="open_div_msg">
                                            <label class="col-form-label">Open Digit</label>
                                            <input style="width: 100%;" class="form-control" type="number" name="Odigit"
                                                placeholder="Enter open digit result">
                                        </div>
                                        <div class="form-group bord col-md-7" id="open_div_msg">
                                            <label class="col-form-label">Close Digit</label>
                                            <input style="width: 100%;" class="form-control" type="number" name="Cdigit"
                                                placeholder="Enter close digit result">
                                        </div>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>

        flatpickr("#result_date", {
            dateFormat: "Y-m-d",
            enableTime: false,
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
