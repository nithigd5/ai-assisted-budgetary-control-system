<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesBudget extends Model
{
    use HasFactory;

    protected $table = 'expenses_budgets_dataset';

    protected $fillable = [
        'user_id' ,
        'created_at' ,
        'day' ,
        'day_name' ,
        'expense' ,
        'actual_budget' ,
        'estimated_budget' ,
        'age' ,
        'is_employed' ,
    ];
}
