<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\User;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $tickets = auth()->user()->tickets()->paginate(5);

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


        if($userId = \request('assigned_to'))
        {
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
