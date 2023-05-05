<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\User;
use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TicketingController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tickets = auth()->user()->tickets()->paginate(5);

        return view('tickets.index', compact('tickets'));
    }

    public function overall(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        // All Tickets
        $latestTickets = Ticket::latest()->limit(5);

        $totalTickets = Ticket::query()->count();

        $user = auth()->user();

        $totalAssigned = $user->tickets()->count();

        $open = Ticket::query()->where('status', 'open')->count();

        $closed = Ticket::query()->where('status', 'closed')->count();

        $resolved = Ticket::query()->where('is_resolved', true)->count();

        $unresolved = Ticket::query()->where('is_resolved', false)->count();

        $highPriority = Ticket::query()->where('priority', 'high')->count();


        // Tickets Assigned To me

        $assignedToMe = Ticket::query()->where('assigned_to', auth()->id());

        $openForMe = $assignedToMe->where('status', 'open')->count();

        $closedForMe = $assignedToMe->where('status', 'closed')->count();

        $resolvedByMe = $assignedToMe->where('is_resolved', true)->count();

        $unresolvedByMe = $assignedToMe->where('is_resolved', false)->count();


        // Tickets Created By Me

        $openMy = $user->tickets()->where('status', 'status')->count();

        $closedMy = $user->tickets()->where('status', 'closed')->count();

        $resolvedMy = $user->tickets()->where('is_resolved', true)->count();

        $unresolvedMy = $user->tickets()->where('is_resolved', false)->count();

        return view('tickets.overall', compact('totalTickets', 'latestTickets',
            'totalAssigned', 'open', 'closed', 'resolved', 'unresolved', 'openForMe', 'closedForMe',
            'resolvedByMe', 'unresolvedByMe', 'highPriority', 'openMy', 'closedMy', 'resolvedMy', 'unresolvedMy'));
    }

    public function assigned(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tickets = Ticket::query()->where('assigned_to', auth()->id())->paginate(5);

        return view('tickets.index', compact('tickets'));
    }


    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();

        return view('tickets.create', compact('users'));
    }

    public function store(TicketStoreRequest $request): RedirectResponse
    {
        $ticket = auth()->user()->tickets()->create($request->validated());

        if ($request->has('category')) {
            $category = Category::query()->updateOrCreate(['name' => Str::lower($request->get('category')), 'slug' => Str::slug($request->get('category'))]);
            $ticket->syncCategories($category);
        }

        if ($request->has('label')) {
            $label = Label::query()->updateOrCreate(['name' => Str::lower($request->get('label')), 'slug' => Str::slug($request->get('label'))]);
            $ticket->syncLabels($label);
        }


        return to_route('tickets.show', $ticket);
    }

    public function update(Ticket $ticket)
    {
        if (\request('resolve')) {
            $ticket->markAsResolved();
        }

        if (\request('close')) {
            $ticket->close();
        }

        if (\request('reopen')) {
            $ticket->reopenAsUnresolved();
        }

        match (\request('priority')) {
            'high' => $ticket->makePriorityAsHigh(),
            'normal' => $ticket->makePriorityAsNormal(),
            'low' => $ticket->makePriorityAsLow(),
            default => ''
        };


        if ($userId = \request('assigned_to')) {
            $ticket->assignTo($userId);
        }

        return back();
    }

    public function show(Ticket $ticket): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ticket->assigned_user = User::query()->find($ticket->assigned_to);

        $users = User::all();

        return view('tickets.show', compact('ticket', 'users'));
    }

    public function reply(Ticket $ticket)
    {
        $ticket->message(\request('message'));

        return back();
    }
}
