@extends('layouts.admin.app')

@section('title', 'Galleries')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Galleries</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Galleries</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Gallery List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('galleries.create') }}"> <i class="fa fa-plus"></i> नयाँ थप</a>
                </div>
            </div>
            <div class="box-body no-padding py-15">
                <div class="row mx-0">
                    <div class="col-md-3">
                        {{ html()->label('शिर्षक')->for('title') }}
                        <div class="form-group">
                            {{ html()->text('title')->id('title')->class('form-control')->placeholder('title') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ html()->label('बर्ष')->for('academic_year_id') }}
                        <div class="form-group">
                            {{ html()->select('academic_year_id', $data['year_options'])->id('academic_year_id')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ html()->label('प्रकार')->for('type') }}
                        <div class="form-group">
                            {{ html()->select('type', $data['type_options'])->id('type')->class('form-control') }}
                        </div>
                    </div>


                    <div class="col-md-3">
                        @include('include.search-and-clear-buttons')
                    </div>
                </div>
                <div id="table-wrapper" class="mx-15">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>क्र.स.</th>
                            <th>प्रकार</th>
                            <th>शिर्षक</th>
                            <th>काजजात</th>
                            <th>मिति</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = ($galleries->currentPage()==1) ? 1 : ($galleries->currentPage()-1)*$galleries->perPage()+1 ; @endphp
                            @forelse($galleries as $gallery)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $gallery->type }}</td>
                                    <td>
                                        {{ $gallery ? $gallery->title : 'Title' }}
                                    </td>
                                    <td>
                                        @if ($gallery->type == 'image')
                                            @if (count($gallery->images) > 0)
                                                <img src="{{ asset('uploads/galleries/' . $gallery->images[0]->image) }}"
                                                    width="80px" alt="No image">
                                            @else
                                                NO IMAGE
                                            @endif
                                        @else
                                            <a class="btn btn-sm btn-primary" href="#"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                    <td>{{ $gallery->date }}</td>
                                    <td>
                                        @if ($gallery->status == 1)
                                            <label class="label label-success">Published</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('galleries.show', [$gallery->id]) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('galleries.edit', [$gallery->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $gallery->id }}"
                                                data-route="{{ route('galleries.destroy', $gallery->id) }}"> <i
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
                            {{ $galleries->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            function getFilters() {
                return {
                    title: $('#title').val(),
                    academic_year_id: $('#academic_year_id').val(),
                    type: $('#type').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "{{ url('admin/galleries') }}",
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
                if (!filters.title && !filters.academic_year_id && !filters.type) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title || filters.academic_year_id || filters.type) {
                    $('#title').val('');
                    $('#academic_year_id').val('');
                    $('#type').val('');
                    filterData({
                        title: null,
                        academic_year_id: null,
                        type: null
                    });
                }
            });
        });
    </script>
@endsection
