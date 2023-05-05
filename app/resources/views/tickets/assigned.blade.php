@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Track Tickets</h1>
        <p class="mb-4">For more information about Tickets Queries, please contact us.
        </p>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Track All Your Tickets Here.</h5>
                            <p>Your tickets are assigned to Network Team. They Will get back to you soon.</p>

                            <!-- Table with stripped rows -->
                            <div
                                class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top">
                                    <div class="datatable-search">
                                        <input class="datatable-input" placeholder="Search..." type="search"
                                               title="Search within table">
                                    </div>
                                </div>
                                <div class="datatable-container">
                                    <table class="table datatable datatable-table">
                                        <thead>
                                        <tr>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Title</a></th>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Created By</a></th>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Created At</a></th>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Updated At</a></th>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Assigned To</a></th>
                                            <th data-sortable="true"><a href="#" class="datatable-sorter">Status</a></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tickets as $ticket)
                                            <tr data-index="{{ $loop->index }}">
                                                <td><a href="{{ route('tickets.show', $ticket) }}" class="link-primary text-decoration-underline"> {{ $ticket->title }}</a></td>
                                                <td>{{ $ticket->user->name }}</td>
                                                <td>{{ $ticket->created_at->toFormattedDateString() }}</td>
                                                <td>{{ $ticket->updated_at->toFormattedDateString() }}</td>
                                                <td>{{ \App\Models\User::query()->find($ticket->assigned_to)?->name }}</td>
                                                <td>@if($ticket->isOpen())
                                                        <span class="badge bg-primary">Open</span>
                                                    @elseif($ticket->isClosed())
                                                        <span class="badge bg-success">Closed</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ strtoupper($ticket->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="datatable-bottom">
                                    <!-- <div class="datatable-info">Showing 1 to 5 of 5 entries</div> --->
                                    <nav class="datatable-pagination">
                                        <ul class="datatable-pagination-list">{{ $tickets->links() }}</ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->
@endsection
