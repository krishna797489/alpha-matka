@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('customer.index')}}">customer</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">              
              <!-- /.card-header -->
              <!-- form start -->            
                <div class="card-body">
                    <form action="{{route('customer.create')}}" method="post" enctype="multipart/form-data">         
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="name">Name <span class="input-mandatory">*</span></label>
                                  <input type="text" name="name"  class="form-control" id="exampleInputEmail1" placeholder="name">
                                  @if ($errors->has('name'))
                                  <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="name">Email <span class="input-mandatory">*</span></label>
                                  <input type="text" name="email"  class="form-control" id="exampleInputEmail1" placeholder="name">
                                  @if ($errors->has('email'))
                                  <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                                </div>
                              </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password <span class="input-mandatory">*</span></label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                  @endif
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactno">Contactno <span class="input-mandatory">*</span></label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1" placeholder="contactno">
                                        @if ($errors->has('phone'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                      @endif
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Image <span class="input-mandatory">*</span></label>
                                        <input type="file" name="image"  class="form-control" id="exampleInputPassword1" placeholder="Enter contactno">
                                        @if ($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                      @endif
                                      </div>
                                    </div>
                            
                                    </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('customer.index')}}" class="btn btn-secondary">Cancel</a>
                                </form>
                                </div>
                                <!-- /.card-body -->

                                
                                </div>
                            
    @endsection