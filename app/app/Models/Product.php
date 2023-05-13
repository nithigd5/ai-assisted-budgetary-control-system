<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'description' , 'category' , 'type' , 'min_price' , 'max_price' , 'brand'
    ];

    protected $casts = ['extra' => 'json'];


    public static function recommended($user)
    {
        $expenses = Expense::query()->where('user_id' , auth()->id())
            ->limit(5)
            ->where('user_id' , $user->id)
            ->latest()
            ->whereNull('sentiment')->orWhere('sentiment' , '<>' , 'Positive')->get();



        $allProducts = collect();

        foreach ($expenses as $expense){
            $product = $expense->first()->product;

            $products = Product::query()
                ->where('type' , $product->type)
                ->where('category', $product->category)
                ->orderByRaw('ratings DESC NULLS LAST')
                ->orderByRaw('no_of_ratings DESC NULLS LAST')
                ->orWhereRaw('name like \'%?%\'' , $product->names)
                ->limit(5)
                ->get();
            $allProducts = $allProducts->union($products);
        }

        return $allProducts;
    }
}
