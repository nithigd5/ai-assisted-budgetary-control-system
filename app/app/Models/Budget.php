<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['food', 'education', 'debts', 'clothing', 'mobile', 'other', 'user_id'];

    public function total()
    {
        return $this->food + $this->mobile + $this->other + $this->education + $this->debts + $this->mobile;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
