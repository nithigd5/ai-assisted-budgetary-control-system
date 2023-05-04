@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Raise New Tickets</h1>
        <p class="mb-4">For more information about Tickets Queries, please contact the <a target="_blank"
                                                                                          href="#">hr@mallow-tech.com</a>.
        </p>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create a New Tickets</h5>
                            <!-- Custom Styled Validation with Tooltips -->
                            <form class="row g-3" action="{{ route('tickets.store') }}" method="POST" novalidate="">
                                @csrf
                                <div class="col-12 position-relative">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                                           value="{{ old('title') }}">

                                    <div class="invalid-tooltip">
                                        @error('title') {{ $message }} @enderror
                                    </div>
                                </div>
                                <div class="col-12 position-relative">
                                    <label for="message" class="form-label @error('message') is-invalid @enderror">Description</label>
                                    <textarea rows="4" class="form-control" id="message" name="message">{{ old('description') }}</textarea>
                                    <div class="invalid-tooltip">
                                        @error('message') {{ $message }} @enderror
                                    </div>
                                </div>
                                <div class="col-12 position-relative">
                                    <label for="validationTooltipUsername" class="form-label">Assign To</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                        <select class="form-control @error('assigned_to') is-invalid @enderror" name="assigned_to" id="assigned_to" aria-describedby="Assigned To"
                                                required="">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-tooltip">
                                            @error('assigned_to') {{ $message }} @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 position-relative">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select type="text" class="form-control @error('priority') is-invalid @enderror" name="priority" id="priority" required="">
                                        <option value="low">Low</option>
                                        <option value="normal">Normal</option>
                                        <option value="high">High</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        @error('priority') {{ $message }} @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </form><!-- End Custom Styled Validation with Tooltips -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->
@endsection
