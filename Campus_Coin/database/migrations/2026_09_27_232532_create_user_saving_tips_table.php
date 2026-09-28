<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_saving_tips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('tip_id')
                ->constrained('saving_tips')
                ->cascadeOnDelete();

            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_dismissed')->default(false);

            $table->timestamps();

            $table->unique(['user_id', 'tip_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_saving_tips');
    }
};