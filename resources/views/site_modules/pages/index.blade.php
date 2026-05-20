@extends('layouts.admin.app')

@section('title', 'Page List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Pages</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pages</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">पेजहरूको विवरण</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('pages.create') }}"> <i class="fa fa-plus"></i> नयाँ पेज थप
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row filteration">
                    <div class="col-md-3">
                        <label for="first_name"> पेजको विवरण </label>
                        <div class="form-group">
                            <input id="title" name="title" class="form-control" placeholder="title">
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{ html()->label('स्थिति')->for('status') }}
                        <div class="form-group">
                            {{ html()->select('status', $statusOptions, $setting->status)->id('status')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dob"> Filter</label>
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button"> <i
                                    class="fa fa-search"></i> search</button>
                            <button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i
                                    class="fa fa-eraser"></i> clear</button>
                        </div>
                    </div>
                </div>
                <div id="table-wrapper" class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>क्र.स.</th>
                            <th>पेजको शिर्षक</th>
                            <th>फोटो</th>
                            <th>क्रम</th>
                            <th>सारंश</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = ($pages->currentPage()==1) ? 1 : ($pages->currentPage()-1)*$pages->perPage()+1 ; @endphp
                            @forelse($pages as $page)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>
                                        {{ $page->title }}
                                    </td>
                                    <td>
                                        @if ($page->image)
                                            <div class="img-wrapper">
                                                <img src="{{ asset('uploads/pages/' . $page->image) }}" alt="No Image">
                                            </div>
                                        @else
                                            <strong>No image</strong>
                                        @endif
                                    </td>
                                    <td>{{ $page->order }}</td>
                                    <td>{!! substr($page->summary, 0, 100) !!}</td>

                                    <td>
                                        @if ($page->status == 1)
                                            <label class="label label-success">Published</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('pages.show', [$page->id]) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('pages.edit', [$page->id]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $page->id }}"
                                                data-route="{{ route('pages.destroy', $page->id) }}"> <i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8"> Not found!!!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>


                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{ $pages->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <script>
        $(document).ready(function() {
            $('#dob').nepaliDatePicker();
        });
    </script>

    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    title: $('#title').val(),
                    status: $('#status').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "<?php echo url('admin/pages'); ?>",
                    data: filters,
                    success: function(response) {
                        $('#table-wrapper').html(response);
                        $('#custom-loader').modal('hide');
                    },
                    error: function() {
                        $('#custom-loader').modal('hide');
                        toastr.error("Oops something went wrong. Try again later!");
                    }
                });
            }

            $('#search-button').click(function() {
                var filters = getFilters();
                if (!filters.title && !filters.status) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title || filters.status) {
                    $('#title').val('');
                    $('#status').val('');
                    filterData({
                        title: null,
                        status: null
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dob').nepaliDatePicker();
        });
    </script>
@endsection
