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
        Schema::create('feedback_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companion_id')->constrained('companions')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('surname')->nullable();
            $table->text('message')->nullable();
            $table->text('response')->nullable();
            $table->enum('rating', ['1', '2', '3', '4','5']);
            $table->string('city')->nullable();
            $table->date('service_date')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('like')->default(0);
            $table->integer('sorting')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_clients');
    }
};
