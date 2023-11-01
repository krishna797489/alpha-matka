@extends('layouts.app')

@section('content')

    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
    
          <form action="{{route('login.sendforgetlink')}}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="email" class="form-control" placeholder="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>  
              </div>
             
            </div>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
             @endif
            {{-- <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
             
            </div> --}}
            {{-- @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
             @endif --}}
              <!-- /.col -->
              <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
              </div>
            </div>
              <!-- /.col -->
            </form> 
            <p class="mt-3 mb-1">
                <a href="{{route('login')}}">Login</a>
              </p>
            </div>
         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
    
    
    @endsection