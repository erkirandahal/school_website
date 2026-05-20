@extends('layouts.admin.app')

@section('title', 'Posts')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Posts</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Posts</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">पोष्टको विवरण</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('posts.create') }}"> <i class="fa fa-plus"></i> नयाँ थप</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row filteration">
                    <div class="col-md-2">
                        {{ html()->label('Title')->for('title') }}
                        <div class="form-group">
                            {{ html()->text('title')->id('title')->class('form-control')->placeholder('title') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Year')->for('academic_year_id') }}
                        <div class="form-group">
                            {{ html()->select('academic_year_id', $yearOptions, $setting->academic_year_id)->id('academic_year_id')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Post Category')->for('post_category_id') }}
                        <div class="form-group">
                            {{ html()->select('post_category_id', $postCategoryOptions)->id('post_category_id')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Status')->for('status') }}
                        <div class="form-group">
                            {{ html()->select('status', $statusOptions, $setting->status)->id('status')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Show on popup')->for('show_on_modal') }}
                        <div class="form-group">
                            {{ html()->select('show_on_modal', [null => '--select--', 1 => 'YES', 0 => 'NO'], $setting->show_on_modal)->id('show_on_modal')->class('form-control') }}
                        </div>
                    </div>

                    <div class="col-md-2">
                        {{ html()->label('Filter') }}
                        <div class="form-group">
                            <button id="search-button" class="btn btn-sm btn-success" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            <button id="clear-button" class="btn btn-sm btn-danger" type="button">
                                <i class="fa fa-eraser"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="table-wrapper" class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>क्र.स.</th>
                            <th>पोष्टको प्रकार</th>
                            <th>पोष्टको शिर्षक</th>
                            <th>फोटोहरू</th>
                            <th>प्रकाशन मिति</th>
                            <th>स्थिति</th>
                            <th>पपअप</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = ($posts->currentPage()==1) ? 1 : ($posts->currentPage()-1)*$posts->perPage()+1 ; @endphp
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $post->postCategory->title }}</td>
                                    <td>
                                        {{ Str::limit($post->title, 50) }}
                                    </td>
                                    <td>
                                        @if ($post->image)
                                            <div class="img-wrapper">
                                                <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="No image">
                                            </div>
                                        @else
                                            <span class="text-danger">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->date }}</td>
                                    <td>
                                        @if ($post->status == 1)
                                            <label class="label label-success">Published</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->show_on_modal == 1)
                                            <label class="label label-success">Yes</label>
                                        @else
                                            <label class="label label-default">No</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('posts.show', [$post->id]) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('posts.edit', [$post->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $post->id }}"
                                                data-route="{{ route('posts.destroy', $post->id) }}"> <i
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
                            {{ $posts->links('vendor.pagination.default') }}
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
                    post_category_id: $('#post_category_id').val(),
                    status: $('#status').val(),
                    show_on_modal: $('#show_on_modal').val()
                };
            }

            function filterData(filters) {
                $('#custom-loader').modal('show');
                $.ajax({
                    url: "<?php echo url('admin/posts'); ?>",
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
                if (!filters.title && !filters.academic_year_id && !filters.post_category_id && !filters
                    .status && !filters.show_on_modal) {
                    toastr.warning("Please select at least one filter criteria!");
                    return;
                }
                filterData(filters);
            });

            $('#clear-button').click(function() {
                var filters = getFilters();
                if (filters.title || filters.academic_year_id || filters.post_category_id || filters
                    .status || filters.show_on_modal) {
                    $('#title').val('');
                    $('#academic_year_id').val('');
                    $('#post_category_id').val('');
                    $('#status').val('');
                    $('#show_on_modal').val('');
                    filterData({
                        title: null,
                        academic_year_id: null,
                        post_category_id: null,
                        status: null,
                        show_on_modal: null
                    });
                }
            });
        });
    </script>
@endsection
