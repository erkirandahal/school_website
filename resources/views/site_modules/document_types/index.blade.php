@extends('layouts.admin.app')

@section('title', 'Document Type List')

@section('content')
    <!-- Content Header (Document Type header) -->
    <section class="content-header">
        <h1> कागजातको प्रकारहरू</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Document Types</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">कागजातको विवरण</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('document-types.create') }}"> <i
                            class="fa fa-plus"></i>
                        नयाँ थप
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row filteration">
                    <div class="col-md-3">
                        <label for="first_name"> शिर्षक </label>
                        <div class="form-group">
                            <input id="title" name="title" class="form-control" placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="dob"> Filter</label>
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button"> <i
                                    class="fa fa-search"></i> खोज्नुहोस</button>
                            <button id="clear-button" class="btn btn-sm btn-danger" type="button"> <i
                                    class="fa fa-eraser"></i> हटाउने</button>
                        </div>
                    </div>
                </div>
                <div id="table-wrapper" class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>क्र.सं.</th>
                            <th>शीर्षक</th>
                            <th>तस्बिर</th>
                            <th>क्रम</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = ($document_types->currentPage()==1) ? 1 : ($document_types->currentPage()-1)*$document_types->perPage()+1 ; @endphp
                            @forelse($document_types as $document_type)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>
                                        {{ $document_type->title }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('uploads/document_types/' . $document_type->image) }}"
                                            width="80px">
                                    </td>
                                    <td>{{ $document_type->order }}</td>

                                    <td>
                                        @if ($document_type->status == 1)
                                            <label class="label label-success">Publish</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('document-types.edit', [$document_type->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $document_type->id }}"
                                                data-route="{{ route('document-types.destroy', $document_type->id) }}"> <i
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
                            {{ $document_types->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>

    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    title: $('#title').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "<?php echo url('admin/document-types'); ?>",
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
                if (!filters.title) {
                    toastr.warning("Please enter a title to search!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title) {
                    $('#title').val('');
                    filterData({
                        title: null
                    });
                }
            });
        });
    </script>
@endsection
