<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\ExpensesBudget;
use App\Models\Product;
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
        $products = Product::all();

        $monthExpenses = Expense::query()->where('user_id' , auth()->id())
            ->selectRaw('sum(price) as price, CAST(created_at as date) as created_at')
            ->whereBetween('created_at' , [now()->startOfMonth() , now()])
            ->groupBy(DB::raw('2'))
            ->latest()->get();

        $expenses = Expense::with('product')->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()])
            ->latest()->get()->take(5);

        $totalExpenses = Expense::with('product')->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->sum('price');

        $budget = Budget::query()->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->first();

        $expenseBudgetDataSet = ExpensesBudget::query()->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])
            ->get();

        return view('home' , ['products' => $products , 'expenses' => $expenses ,
            'totalExpenses' => $totalExpenses , 'budget' => $budget , 'expense' , 'monthExpenses' => $monthExpenses, 'expenseBudgetDataSet' => $expenseBudgetDataSet]);
    }
}
