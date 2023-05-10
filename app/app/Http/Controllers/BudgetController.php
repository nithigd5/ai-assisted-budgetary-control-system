<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStoreRequest;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(BudgetStoreRequest $request)
    {
        $validated = $request->validated();

        $budget = Budget::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->first();

        if($budget){
            Budget::query()->update($validated);
        }else{
            Budget::query()->create(array_merge($validated, ['user_id' => auth()->id()]));
        }


        return back();
    }
}
