<?php

namespace App\Models;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function generate()
    {
        $month = CarbonPeriod::create(now()->startOfMonth() , now()->addMonth());

        $dailyBasisBudget = $this->total();

        $days = now()->startOfMonth()->diffInDays(now()->addMonth());

        $dailyBasisBudget = $dailyBasisBudget / $days;

        $monthExpenses = Expense::query()->where('user_id' , auth()->id())
            ->selectRaw('sum(price) as price, CAST(created_at as date) as created_at')
            ->whereBetween('created_at' , [now()->startOfMonth() , now()->addMonth()])
            ->groupBy(DB::raw('2'))
            ->latest()->get();


        foreach ($month as $date) {

            $expense = ExpensesBudget::query()->whereRaw('CAST(created_at as date) = ?' , $date->toDateString())->first();

            $data = [
                'user_id' => auth()->id() ,
                'created_at' => $date ,
                'day' => $date->day ,
                'day_name' => $date->getTranslatedDayName() ,
                'expense' => round($monthExpenses->where('created_at' , '=' , $date)->first()?->price ?? 0 , 2),
                'actual_budget' => round($dailyBasisBudget , 2),
                'estimated_budget' => null,
                'age' => now()->diffInYears(auth()->user()->date_of_birth) ,
                'is_employed' => auth()->user()->is_employed ?? false ,
            ];

            if (!$expense) {
                ExpensesBudget::query()->create($data);
            } else {
                $expense->update($data);
            }

        }
    }
}
