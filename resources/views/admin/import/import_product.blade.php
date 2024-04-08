@extends('layout.admin')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 mx-auto card shadow mb-4">
                    <div class="card-body">
                       @if (! $errors->isEmpty() )
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">X</button>
                                        <ul>@foreach ( $errors->all() as $error )
                                            <li><strong>Warning !</strong> {{ $error }}</li>
                                        @endforeach </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{!! $message !!}</strong>
                                </div>
                            </div>
                        </div>
                        @endif
                        <form action="{{ route('productImportStore') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                         <a download href="{{ asset('asset/admin/import/ProductImportExcelFormat.xlsx')}}" class="btn btn-secondary btn-sm float-right my-1">Excel Format</a>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Upload an excel file to import product data <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('import') is-invalid @enderror " type="file" name="import" id="import"
                                        value="">
                                        <span class="text-danger">  @error('import')<i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }} @enderror</span>
                                </div>


                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-fw fa-lg fa-check-circle"></i>Import Product</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-secondary" href="{{ route('adminDashboard') }}"><i
                                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
