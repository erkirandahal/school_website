@extends('layouts.admin.app')

@section('title', 'Departments > 1')

@section('content')

    <!-- Content Header (Departments header) -->
    <section class="content-header">
        <h1> विवरण</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> ड्यासबोर्ड</a></li>
            <li><a href="{{ route('departments.index') }}"> शाखा</a></li>
            <li class="active">सम्पादन</li>
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
                {{ html()->modelForm($department, 'PATCH', route('departments.update', $department->id))->attribute('enctype', 'multipart/form-data')->open() }}
                @include('site_modules.departments.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">सम्पादन</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ route('departments.index') }}">रद्द</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endsection
