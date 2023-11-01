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
              <li class="breadcrumb-item active"><a href="{{route('customer.index')}}">customer </a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data"> 
               @csrf
               <input type="hidden" name="id" value="{{$cust->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="name" name="name" value="{{old('name',$cust->name)}}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                  @if ($errors->has('name'))
                                  <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                </div>
                              </div>
                          
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" value="{{old('email',$cust->email)}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                  @endif
                                </div>
                                </div>

                             
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactno">Contactno</label>
                                        <input type="text" name="phone" value="{{old('phone',$cust->phone)}}" class="form-control" id="exampleInputPassword1" placeholder="Enter contactno">
                                        @if ($errors->has('phone'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                      @endif
                                    </div>
                                    </div>

                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactno">Image</label>
                                        <!-- <input type="file" name="image" class="form-control" placeholder="image"> -->
                                         <img src="/upload/image{{ $cust->image }}" width="300px">
                                        <input type="file" name="image" value="{{old('image',$cust->image)}}" class="form-control" id="exampleInputPassword1" placeholder="Enter contactno">
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
                            
                            </div>
        </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection