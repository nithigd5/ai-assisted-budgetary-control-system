@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Track Tickets</h1>
        <p class="mb-4">For more information about Tickets Queries, please contact us.
        </p>
        <section class="section dashboard">
            <div class="row">
                <h4 class="h4 text-gray-800">Overall</h4>
                <x-dashboard.count icon="<i class='bi bi-ticket-detailed-fill'></i>" :count="$totalTickets"
                                   title="Total Tickets"></x-dashboard.count>
                <x-dashboard.count icon='<i class="text-info bi bi-info-circle-fill"></i>' :count="$open"
                                   title="Total Open"></x-dashboard.count>
                <x-dashboard.count icon='<i class="text-success bi bi-check2-circle"></i>' :count="$closed"
                                   title="Total Closed"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-success bi-check-circle-fill"></i>' :count="$resolved"
                                   title="Total Resolved"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-warning bi-x-circle-fill"></i>' :count="$unresolved"
                                   title="Total Un-Resolved"></x-dashboard.count>

                <x-dashboard.count icon='<i class="bi text-danger bi-exclamation-circle-fill"></i>' :count="$highPriority"
                                   title="High Priority"></x-dashboard.count>
            </div>

            <div class="row">
                <h4 class="h4 text-gray-800">Tickets Assigned To Me</h4>
                <x-dashboard.count :count="$totalAssigned" title="Total"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-info bi-person-exclamation"></i>' :count="$openForMe"
                                   title=" Open"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-success bi-person-check-fill"></i>' :count="$closedForMe"
                                   title=" Closed"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-success bi-person-fill-check"></i>' :count="$resolvedByMe"
                                   title=" Resolved"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-warning bi-person-fill-x"></i>' :count="$unresolvedByMe"
                                   title=" UnResolved"></x-dashboard.count>
            </div>

            <div class="row">
                <h4 class="h4 text-gray-800">My Tickets</h4>
                <x-dashboard.count :count="$totalAssigned" title="Total"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-info bi-person-exclamation"></i>' :count="$openMy"
                                   title=" Open"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-success bi-person-check-fill"></i>' :count="$closedMy"
                                   title=" Closed"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-success bi-person-fill-check"></i>' :count="$resolvedMy"
                                   title=" Resolved"></x-dashboard.count>
                <x-dashboard.count icon='<i class="bi text-warning bi-person-fill-x"></i>' :count="$unresolvedMy"
                                   title=" UnResolved"></x-dashboard.count>
            </div>
        </section>

    </div>
    <!-- /.container-fluid -->
@endsection
