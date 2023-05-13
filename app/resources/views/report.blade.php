@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <!-- Page Heading -->
            <h1 class="my-2">{{ __('Get Your Report') }}</h1>

            <div class="card">
                <div class="card-header mb-3">Manage Reports</div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection
