@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Withdraw Fund(Wallet)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Fund(Wallet)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="page-body"><br />	<div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5>Withdraw balance In User Wallet</h5>
                          </div>
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
                                <form class="theme-form mega-form" id="balanceAddFrm" name="balanceAddFrm" method="post" action="{{ route('withdrabyadmin') }}" >
                                    @csrf
                                    <div class="form-group" >
                                        <label class="col-form-label">User List</label>
                                        <select id="user" name="user" class="js-example-basic-single show_parent" >
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->phone }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Amount</label>
                                        <input class="form-control" required type="Number" min=0 name="point" id="point" placeholder="Enter Amount">
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
    <script>
        setTimeout(function() {
            document.getElementById('error').style.display = 'none';
        }, 4000); // 5000 milliseconds = 5 seconds
    </script>

    @endsection
