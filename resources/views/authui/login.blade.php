@extends('layouts.app')
@section('content')

    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Dev Matka App</b></a>
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
                <input type="password" name="password" class="form-control" id="password-field" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span toggle="#password-field" class="fas fa-eye-slash toggle-password"></span>
                  </div>
                </div>
              </div>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
             @endif
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-outline-primary" style="margin: -7px;">Sign In</button>
              </div>

              <!-- /.col -->
            </form>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
        const passwordField = document.querySelector("#password-field");
        const togglePassword = document.querySelector(".toggle-password");

        togglePassword.addEventListener("click", function () {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle the eye icon
            if (type === "password") {
                togglePassword.classList.add("fa-eye-slash");
                togglePassword.classList.remove("fa-eye");
            } else {
                togglePassword.classList.add("fa-eye");
                togglePassword.classList.remove("fa-eye-slash");
            }
        });
    </script>
    @endsection
