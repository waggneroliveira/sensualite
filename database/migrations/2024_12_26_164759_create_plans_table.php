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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->text('description', 255)->nullable();
            $table->decimal('price', 7, 2)->nullable();
            $table->string('duration', 45)->nullable();
            $table->text('features', 255)->nullable();
            $table->boolean('status')->default(0);
            $table->string('cancellation_policy', 191)->nullable();
            $table->decimal('discount', 7, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
