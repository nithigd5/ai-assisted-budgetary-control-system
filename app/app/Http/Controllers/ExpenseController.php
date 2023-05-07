<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product' => 'required',
            'price' => 'required',
            'mode' => 'required',
            'type' => 'required',
            'feedback' => 'required'
        ]);

        Expense::create([
            'product_id' => $request->input('product'),
            'user_id' => auth()->id(),
            'price' => $request->input('price'),
            'mode' => $request->input('mode'),
            'type' => $request->input('type'),
            'feedback' => $request->input('feedback')
        ]);

        return redirect('/home')->with('success','Expense Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
