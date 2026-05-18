@extends('layouts.admin.app')

@section('title', 'Document Type > Create')

@section('content')
    <!-- Content Header (Document Type header) -->
    <section class="content-header">
        <h1> Document Types</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('document-types.index') }}"> Document Types</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create</h3>
                <div class="box-tools pull-right">
                    <p style="color:red;">Fileds with (*) are compulsory.</p>
                </div>
            </div>
            <div class="box-body">
                {!! html()->form('POST', route('document-types.store'))->attribute('enctype', 'multipart/form-data')->attribute('id', 'page-form')->open() !!}
                @include('site_modules.document_types.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">पेश</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ route('document-types.index') }}">रद्द</a>
                        </div>
                    </div>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>

@endsection
