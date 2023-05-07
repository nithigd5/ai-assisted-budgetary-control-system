<?php

namespace App\Http\Controllers;

use App\Features\TicketingSystem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Pennant\Feature;

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
        return view('home',['products' => $products]);
    }
}
