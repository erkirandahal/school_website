@extends('layouts.admin.app')

@section('title', 'Settings')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Settings</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">विद्यालयको विवरण</li>
        </ol>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="row-auto">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">प्रणालीको विवरण</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <label class="col-md-4">हालको आ. ब.</label>
                            <div class="col-md-8">{{ $setting->academicYear->year }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">विद्यालयको नाम</label>
                            <div class="col-md-8">{{ $setting->office }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">ठेगाना</label>
                            <div class="col-md-8">{{ $setting->office_address }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">स्थानीय तह</label>
                            <div class="col-md-8">{{ $setting->municipality }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">प्रदेश</label>
                            <div class="col-md-8">{{ $setting->province_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">जिल्ला</label>
                            <div class="col-md-8">{{ $setting->district_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">सम्पर्क नं.</label>
                            <div class="col-md-8">{{ $setting->phone }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">इमेल</label>
                            <div class="col-md-8">{{ $setting->email }}</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-primary btn-sm" href="{{ route('settings.edit', $setting->id) }}"> <i
                                class="fa fa-edit"></i> सम्पादन</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">प्रणालीको लोगो</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <label class="col-md-4">लोगो</label>
                            <div class="col-md-8">
                                <img class="image img-responsive" src="{{ asset('uploads/setting/' . $setting->logo) }}"
                                    height="100" width="100" alt="LOGO" style="border: 1px solid green;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">प्रणालीको लागि लोगो</label>
                            <div class="col-md-8">
                                <img class="image img-responsive"
                                    src="{{ asset('uploads/setting/' . $setting->local_logo) }}" height="100"
                                    width="100" alt="LOCAL LOGO" style="border: 1px solid green;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">Favicon</label>
                            <div class="col-md-8">
                                <img class="image img-responsive" src="{{ asset('uploads/setting/' . $setting->favicon) }}"
                                    height="100" width="100" alt="Favicon" style="border: 1px solid green;">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-4">प्रणालीको नाम</label>
                            <div class="col-md-8">{{ $setting->system_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">प्रणालीको छोटो नाम</label>
                            <div class="col-md-8">{{ $setting->system_short_name }}</div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4">नारा</label>
                            <div class="col-md-8">{{ $setting->tag_line }}</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-primary btn-sm" href="{{ route('settings.edit', $setting->id) }}"> <i
                                class="fa fa-edit"></i> सम्पादन</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
