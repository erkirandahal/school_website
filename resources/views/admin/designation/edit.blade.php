@extends('layouts.admin.app')

@section('title', 'Designation > Edit')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Designation</h1>
        <ol class="breadcrumb">
            <li> <a href="{{ route('dashboard') }}"> <i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li> <a href="{{ url('admin/designations') }}">Designation</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
                <div class="box-tools pull-right">
                    <p style="color:red;">Fileds with (*) are compulsory.</p>
                </div>
            </div>
            <div class="box-body">
                {{ html()->modelForm($designation, 'PATCH', route('designations.update', $designation->id))->attribute('enctype', 'multipart/form-data')->id('designation-form')->open() }}
                @include('admin.designation.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">पेश</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ url('admin/designations') }}">रद्द</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endsection
