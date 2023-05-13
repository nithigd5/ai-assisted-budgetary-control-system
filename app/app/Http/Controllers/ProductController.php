<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Expense;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function recommended()
    {
        $expenses = Expense::query()->where('user_id' , auth()->id())
            ->whereNull('sentiment')->orWhere('sentiment' , '<>' , 'Positive');
    }

    public function get()
    {
        $search = request('term');

        $products = Product::query()->where('name' , 'ilike' , '%' . $search . '%')
            ->orWhere('type' , 'ilike' , '%' . $search . '%')
            ->orWhere('category' , 'ilike' , '%' . $search . '%')
            ->orWhere('description' , 'ilike' , '%' . $search . '%')
            ->orWhere('brand' , 'ilike' , '%' . $search . '%')
            ->select('id' , 'name as text');

        return $products->paginate();
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
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect('/home')->with('success' , 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request , Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
