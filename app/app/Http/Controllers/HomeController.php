<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;

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
        $expenses = Expense::with('product')->where('user_id' , auth()->id())->latest()->limit(5)->get();
        $totalExpenses = Expense::with('product')->where('user_id' , auth()->id())
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->endOfMonth()])->sum('price');

        return view('home' , ['products' => $products , 'expenses' => $expenses, 'totalExpenses' => $totalExpenses]);
    }
}
