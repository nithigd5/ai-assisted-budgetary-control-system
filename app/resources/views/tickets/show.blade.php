@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Raise New Tickets</h1>
        <p class="mb-4">For more information about Tickets Queries, please contact us.
        </p>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($ticket->isOpen())
                            <span class="badge bg-primary"><i class="bi bi-bell-fill me-1"></i>Open</span>
                        @elseif($ticket->isClosed())
                            <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Closed</span>
                        @else
                            <span
                                class="badge bg-secondary">{{ strtoupper($ticket->status) }}</span>
                        @endif
                        Ticket Raised By <span class="fw-bold text-black">{{ $ticket->user->name }}</span>
                        on <i class="text-black">{{ $ticket->created_at->toFormattedDateString() }}</i></div>
                    <div>
                        @if($ticket->priority == 'high')
                            <span class="badge bg-danger"><i
                                    class="bi bi-exclamation-octagon me-1"></i> High Priority</span>
                        @elseif($ticket->priority == 'normal')
                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Normal Priority</span>
                        @elseif($ticket->priority == 'low')
                            <span class="badge bg-info text-dark"><i
                                    class="bi bi-info-circle me-1"></i> Low Priority</span>
                        @endif


                        @if($ticket->isResolved())
                            <span class="badge badge-pill bg-success"><i
                                    class="bi bi-check-square me-1"></i> Resolved</span>
                        @elseif($ticket->isUnresolved())
                            <span class="badge badge-pill bg-warning"><i class="bi bi-exclamation-diamond me-1"></i>Un Resolved</span>
                        @else
                            <span
                                class="badge badge-pill bg-secondary">{{ strtoupper($ticket->status) }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-title d-flex justify-content-between">
                    {{ $ticket->title }}
                    @foreach($ticket->categories->pluck('name') as $category)
                        <div class="d-flex align-items-center badge px-3 bg-info">
                            <div class="fs-6 fw-normal">{{ $category }}</div>
                        </div>
                    @endforeach
                </div>
                <div>
                    <p>{{ $ticket->message }}</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>Assigned To {{ $ticket->assignedToUser?->name ?? 'No One'}}.</div>
                    <div>
                        @if(!$ticket->isResolved())
                            <a href="{{ route('tickets.update', ['ticket' => $ticket, 'resolve' => true]) }}"
                               class="btn btn-success"><i class="bi bi-check-all me-1"></i>Mark As Resolved</a>
                        @endif

                        @if($ticket->isOpen())
                            <a href="{{ route('tickets.update', ['ticket' => $ticket, 'close' => true]) }}"
                               class="btn btn-secondary"><i
                                    class="bi bi-door-closed me-1"></i> Close the Ticket</a>
                        @else
                            <a href="{{ route('tickets.update', ['ticket' => $ticket, 'reopen' => true]) }}"
                               class="btn btn-secondary"><i
                                    class="bi bi-door-closed me-1"></i>Reopen As UnResolved</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer px-2 d-flex justify-content-between">
                <div class="d-flex gap-2 ">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Change Priority
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a href="{{ route('tickets.update', ['ticket' => $ticket, 'priority' => 'high']) }}"
                                   class="dropdown-item text-danger"><i
                                        class="bi bi-bell me-1"></i>High</a></li>
                            <li><a href="{{ route('tickets.update', ['ticket' => $ticket, 'priority' => 'normal']) }}"
                                   class="dropdown-item text-info"><i
                                        class="bi bi-exclamation me-1"></i>Normal</a></li>
                            <li><a href="{{ route('tickets.update', ['ticket' => $ticket, 'priority' => 'low']) }}"
                                   class="dropdown-item text-secondary"><i
                                        class="bi bi-info me-1"></i>Low</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Assign To
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach($users as $user)
                                <li>
                                    <a href="{{ route('tickets.update', ['ticket' => $ticket, 'assigned_to' => $user->id]) }}"
                                       class="dropdown-item"><i
                                            class="bi bi-p1"></i>{{ $user->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    @foreach($ticket->labels->pluck('name') as $label)
                        <div class="d-flex align-items-center px-3 badge bg-primary">
                            <div class="fs-6 fw-normal">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($ticket->messages as $message)
                    <div class="card col-12">
                        <div class="card-header">
                            <div class="card-title py-0">
                                Replied by {{ $message->user->name }}
                            </div>

                        </div>
                        <div class="card-body">
                            <p class="pt-2">{{ $message->message }}</p>
                        </div>
                        <div class="card-footer"> Replied On {{ $message->created_at->toFormattedDateString() }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Reply to the Ticket
            </div>
            <div class="card-body py-4">
                <form class="row g-3" action="{{ route('tickets.reply', $ticket) }}" method="POST" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="col-12 position-relative">
                        <textarea rows="4" class="form-control" id="message"
                                  name="message"></textarea>
                        <div class="invalid-tooltip">
                            @error('message') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Reply</button>
                    </div>
                </form><!-- End Custom Styled Validation with Tooltips -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
