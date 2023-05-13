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

        $month = CarbonPeriod::create(now()->startOfMonth() , now()->addMonth());

        $dailyBasisBudget = $budget->total();

        $days = now()->startOfMonth()->diffInDays(now()->addMonth());

        $dailyBasisBudget = $dailyBasisBudget / $days;

        $monthExpenses = Expense::query()->where('user_id' , auth()->id())
            ->selectRaw('sum(price) as price, CAST(created_at as date) as created_at')
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->addMonth()])
            ->groupBy(DB::raw('2'))
            ->latest()->get();


        foreach ($month as $date) {

            $expense = ExpensesBudget::query()->whereRaw('CAST(created_at as date) = ?' , $date->toDateString())->first();

            $data = [
                'user_id' => auth()->id() ,
                'created_at' => $date ,
                'day' => $date->day ,
                'day_name' => $date->getTranslatedDayName() ,
                'expense' => round($monthExpenses->where('created_at' , '=' , $date)->first()?->price ?? 0 , 2),
                'actual_budget' => round($dailyBasisBudget , 2),
                'estimated_budget' => null,
                'age' => now()->diffInYears(auth()->user()->date_of_birth) ,
                'is_employed' => auth()->user()->is_employed ?? false ,
            ];

            if (!$expense) {
                ExpensesBudget::query()->create($data);
            } else {
                $expense->update($data);
            }

        }

        $response = Http::timeout(5)->get(config('app.api_host').'/purchases/train_expenses' , ['user_id' => auth()->id()]);

        return back();
    }
}
