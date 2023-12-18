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

        <div class="card-body">
            <div class="row">
                <!-- Open -->
                <div class="form-group bord col-md-2">
                    <h5 class="tit_h">Open</h5>
                </div>

                <div class="form-group bord col-md-2">
                    <label class="col-form-label">Panna:</label>
                    <input class="form-control" type="number" name="open_number" required id="open_number" value=""
                        placeholder="Enter 3 Digit Value">

                    <label class="col-form-label">Result:</label>
                    <input class="form-control" type="number" name="open_result" id="open_result" value=""
                        placeholder="Result">
                </div>


            </div>
            <div class="form-group bord col-md-3" id="open_div_msg">
                <button type="button" class="btn btn-primary waves-light m-t-10 p-10" id="openSaveBtn" name="openSaveBtn"
                    onclick="OpenSaveData();">Save</button>

                <button type="button" class="btn btn-primary waves-light m-t-10 display_none" id="openDecBtn"
                    name="openDecBtn" onclick="decleareOpenResult();">Declare</button>
            </div>
            <div class="row">
                <!-- Close -->
                <div class="form-group bord col-md-2">
                    <h5 class="tit_h">Close</h5>
                </div>


                <div class="form-group bord col-md-2">
                    <label class="col-form-label">Panna:</label>
                    <input class="form-control" type="number" name="open_number" required id="open_number" value=""
                        placeholder="Enter 3 Digit Value">

                    <label class="col-form-label">Result:</label>
                    <input class="form-control" type="number" name="open_result" id="open_result" value=""
                        placeholder="Result">
                </div>

            </div>
            <div class="form-group bord col-md-3" id="close_div_msg">
                <button type="button" class="btn btn-primary waves-light m-t-10" id="closeSaveBtn" name="closeSaveBtn"
                    onclick="closeSaveData();">Save</button>

                <button type="button" class="btn btn-primary waves-light m-t-10 display_none" id="closeDecBtn"
                    name="closeDecBtn" onclick="decleareCloseResult();">Declare</button>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header text-end">
                                <a href="{{ route('customer.add') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</a>
                            </div> --}}
                                <!-- /.card-header -->

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
    @endsection
