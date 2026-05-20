@extends('layouts.admin.app')

@section('title', 'Post > Create')

@section('content')
    <!-- Content Header (Post header) -->
    <section class="content-header">
        <h1> Posts</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('posts.index') }}"> Posts </a></li>
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
                {{ html()->form('POST', route('posts.store'))->attribute('enctype', 'multipart/form-data')->id('post-form')->open() }}
                @include('site_modules.posts.partial.form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">पेश</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ route('posts.index') }}">रद्द</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('plugins/ckeditor5/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            }, {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>

    <script>
        $(document).ready(function() {
            $('#published_date').datepicker({
                "format": 'yyyy-mm-dd'
            }).datepicker("setDate", 'now');;

        });
    </script>
@endsection
