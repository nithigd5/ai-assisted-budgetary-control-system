<?php

namespace App\Features;

use App\Models\User;
use Illuminate\Support\Lottery;

class TicketingSystem
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): mixed
    {
        return false;
    }
}
