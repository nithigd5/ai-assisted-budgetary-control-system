<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','category','type','min_price','max_price','brand'
    ];


    public function recommended($user)
    {
        $expenses = Expense::query()->where('user_id' , auth()->id())
            ->limit(5)
            ->where('user_id', $user->id)
            ->whereNull('sentiment')->orWhere('sentiment' , '<>' , 'Positive');

        
    }
}
