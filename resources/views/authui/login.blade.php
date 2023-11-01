@extends('layouts.app')
@section('content')

    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Alpha Mataka</b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
    
          <form action="{{route('login.verify')}}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>  
              </div>             
            </div>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
             @endif
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>            
            </div>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
             @endif
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <p class="mb-1">
                <a href="{{route('login.forgot')}}">I forgot my password</a>
              </p>
              <!-- /.col -->
            </form> 
            </div>        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->  
    @endsection