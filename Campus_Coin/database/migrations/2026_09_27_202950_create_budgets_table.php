<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\HasMany;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            // Har budget month ke pehle din ko store karega
            $table->date('month');
            $table->decimal('budget_limit', 10, 2);

            $table->timestamps();

            $table->unique(
                ['user_id', 'category_id', 'month'],
                'budgets_user_category_month_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};