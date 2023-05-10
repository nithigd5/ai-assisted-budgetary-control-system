<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected  $fillable = [
        'product_id','user_id','price','mode','type', 'feedback', 'sentiment'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
