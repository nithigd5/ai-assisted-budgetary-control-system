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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('category')->nullable();
            $table->text('type')->nullable();
            $table->string('min_price')->nullable();
            $table->string('max_price')->nullable();
            $table->string('ratings')->nullable();
            $table->string('no_of_ratings')->nullable();
            $table->text('brand')->nullable();
            $table->json('extra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
