@extends('layouts.admin.app')

@section('title', 'Embedding List')

@section('content')
    <!-- Content Header (Embedding header) -->
    <section class="content-header">
        <h1> Embeddings</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Embedding</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Embedding List</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-success" href="{{ route('embeddings.create') }}"> <i class="fa fa-plus"></i>
                        नयाँ थप
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div id="table-wrapper" class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>क्र.स.</th>
                            <th>प्रकार</th>
                            <th>शिर्षक</th>
                            <th>विवरण (Display)</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
                        </thead>
                        <tbody>
                            @php $sno = ($embeddings->currentPage()==1) ? 1 : ($embeddings->currentPage()-1)*$embeddings->perPage()+1 ; @endphp
                            @forelse($embeddings as $embedding)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>
                                        {{ embeddingType($embedding->type) }}
                                    </td>
                                    <td>{{ $embedding->title ? $embedding->title : '-' }}</td>
                                    <td>
                                        <div class="iframe-container">
                                            {!! $embedding->iframe !!}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($embedding->status == 1)
                                            <label class="label label-success">Publish</label>
                                        @else
                                            <label class="label label-default">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-button-list">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('embeddings.edit', [$embedding->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $embedding->id }}"
                                                data-route="{{ route('embeddings.destroy', $embedding->id) }}"> <i
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
                            {{ $embeddings->links('vendor.pagination.default') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
