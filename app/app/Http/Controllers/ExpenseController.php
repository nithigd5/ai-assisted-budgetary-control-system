<?php

namespace App\Http\Controllers;

use App\DataTables\ExpensesDataTable;
use App\Models\Expense;
use App\Models\ExpensesBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ExpensesDataTable $dataTable)
    {
        return $dataTable->render('expense');
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
            'product' => 'required' ,
            'price' => 'required' ,
            'mode' => 'required' ,
            'feedback' => 'required'
        ]);

        $sentiment = '';

        try {
            $response = Http::timeout(3)->post(
                config('app.api_host') . '/purchases/analyze-sentiment' ,
                ['text' => $request->feedback]
            );
            $sentiment = $response->json()['TextBlob_Analysis'];

        } catch (\Exception $exception) {

        }

        Expense::create([
            'product_id' => $request->input('product') ,
            'user_id' => auth()->id() ,
            'price' => $request->input('price') ,
            'mode' => $request->input('mode') ,
            'feedback' => $request->input('feedback') ,
            'sentiment' => $sentiment
        ]);

        $expensesBudget = ExpensesBudget::query()->where('user_id' , auth()->id())
            ->whereRaw('CAST(created_at as date) = ?' , now()->toDateString())->first();


        if ($expensesBudget) {
            $expensesBudget->expense = $expensesBudget->expense ?? 0;
            $expensesBudget->expense = $expensesBudget->expense + $request->input('price');
            $expensesBudget->save();
        }

        $response = Http::timeout(5)->get(config('app.api_host').'/purchases/train_expenses' , ['user_id' => auth()->id()]);


        return redirect('/home')->with('success' , 'Expense Created Successfully');
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
    public function update(Request $request , Expense $expense)
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
