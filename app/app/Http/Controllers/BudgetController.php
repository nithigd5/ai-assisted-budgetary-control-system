<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStoreRequest;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\ExpensesBudget;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BudgetController extends Controller
{
    public function store(BudgetStoreRequest $request)
    {
        $validated = $request->validated();

        $budget = Budget::query()->where('user_id' , auth()->id())->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->first();

        if ($budget) {
            $budget->update($validated);
        } else {
            $budget = Budget::query()->create(array_merge($validated , ['user_id' => auth()->id()]));
        }

        ExpensesBudget::generate($budget);

        $response = Http::timeout(5)->get(config('app.api_host').'/purchases/train_expenses' , ['user_id' => auth()->id()]);

        return back();
    }
}
