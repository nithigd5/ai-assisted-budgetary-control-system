<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses_budgets_dataset', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('day');
            $table->string('day_name');
            $table->integer('user_id');
            $table->float('expense');
            $table->float('predicted_expense')->nullable();
            $table->float('actual_budget');
            $table->float('estimated_budget')->nullable();
            $table->integer('age');
            $table->boolean('is_employed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses_budgets_dataset');
    }
};
