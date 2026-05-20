@extends('layouts.admin.app')

@section('title', 'Gallery > Edit')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Gallery</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('galleries.index') }}"> Gallery</a></li>
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
                {{ html()->modelForm($gallery, 'PATCH', route('galleries.update', $gallery->id))->id('gallery-form')->attribute('enctype', 'multipart/form-data')->open() }}
                @include('site_modules.galleries.partial.edit_form')
                <div class="form-inline">
                    <div class="pull pull-right">
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">पेश</button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger pull-right" href="{{ route('galleries.index') }}">रद्द</a>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function() {

            $('#published_date').datepicker({
                "format": 'yyyy-mm-dd'
            }).datepicker("setDate", $('#published_date').val());;

        });

        $(document).ready(function() {
            $('#gallery_type').change(function() {
                if ($('#gallery_type').val() === 'video') {
                    $(document).find('.image-container').css("visibility", "hidden");
                    $(document).find('.video-container').css("visibility", "visible");
                }
                if ($('#gallery_type').val() === 'image') {
                    $(document).find('.image-container').css("visibility", "visible");
                    $(document).find('.video-container').css("visibility", "hidden");
                }
            })
        });
    </script>
@endsection
