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
        Schema::create('subscribeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('companion_id')->constrained()->onDelete('cascade');
            $table->string('order_code')->nullable();
            $table->enum('status', ['paid', 'pending', 'expired', 'active', 'failed'])->default('pending');
            $table->timestamp('last_pagarme_webhook_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribeds');
    }
};
