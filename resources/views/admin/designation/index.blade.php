@extends('layouts.admin.app')

@section('title', 'Designation')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Designations</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Designations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">पदको विवरण</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('designations.create') }}">
                        <i class="fa fa-plus"></i>
                        नयाँ थप</a>
                </div>
            </div>
            <div class="box-body">
                <div id="replaceTable ">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                            <th>क्र.स.</th>
                            <th>पद (English)</th>
                            <th>पद (नेपाली)</th>
                            <th>क्रम</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = 1*$designations->currentPage(); @endphp
                            @forelse($designations as $designation)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $designation->name }}</td>
                                    <td>{{ $designation->name_np }}</td>
                                    <td>{{ $designation->order }}</td>

                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('designations.edit', $designation->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $designation->id }}"
                                                data-route="{{ route('designations.destroy', $designation->id) }}"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Data not found!!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $designations->links('vendor.pagination.default') }}
                </ul>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function paginate(page) {
            loadPaginatedData(page);
        }

        function loadPaginatedData(page = 1, perPage = 1) {
            $.ajax({
                url: '{{ url('admin/designations') }}',
                method: 'GET',
                data: {
                    'page': page,
                    'perPage': perPage
                },
            }).done(function(response) {
                $('#replaceTable').replaceWith(response);
            }).fail(function() {
                alert('Something went wrong, Try again later!!!')
            })
        }
    </script>
@endsection
