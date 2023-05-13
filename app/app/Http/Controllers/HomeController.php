<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\ExpensesBudget;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthExpenses = Expense::query()->where('user_id' , auth()->id())
            ->selectRaw('sum(price) as price, CAST(created_at as date) as created_at')
            ->whereBetween('created_at' , [now()->startOfMonth() , now()])
            ->groupBy(DB::raw('2'))
            ->latest()->get();

        $expenses = Expense::with('product')->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->subMonth() , now()])
            ->latest()->get()->take(5);

        $totalExpenses = Expense::with('product')->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->sum('price');

        $budget = Budget::query()->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->first();

        $expenseBudgetDataSet = ExpensesBudget::query()->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()])
            ->orderBy('created_at')
            ->get();

        $expenseBudgetDataSet = $expenseBudgetDataSet->map(function ($data) {
            $data->savings = round($data->actual_budget - $data->expense , 2);
            $data->expense = round($data->expense , 2);
            $data->predicted_expense = round($data->predicted_expense , 2);
            $data->predicted_expense = max($data->predicted_expense , 0);
            $data->actual_budget = round($data->actual_budget , 2);
            return $data;
        });

        $forecastedExpenses = ExpensesBudget::query()->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now() , now()->addMonth()])
            ->orderBy('created_at')
            ->get();

        $forecastedExpenses = $forecastedExpenses->map(function ($data) {
            $data->predicted_expense = max($data->predicted_expense , 0);
            return $data;
        });


//        dd($forecastedExpenses->toArray());

        return view('home' , ['expenses' => $expenses ,
            'totalExpenses' => $totalExpenses , 'budget' => $budget , 'expense' , 'monthExpenses' => $monthExpenses ,
            'expenseBudgetDataSet' => $expenseBudgetDataSet , 'forecastedExpenses' => $forecastedExpenses]);
    }
}
