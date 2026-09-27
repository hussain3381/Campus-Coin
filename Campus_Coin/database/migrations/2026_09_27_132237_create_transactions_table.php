<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Har transaction ka owner student hoga
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Transaction ek category se linked hogi
            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('type', ['income', 'expense']);
            $table->decimal('amount', 10, 2);
            $table->date('transaction_date');
            $table->string('description', 180);
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_frequency')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->index(['user_id', 'transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};