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
        Schema::create('companions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('gender', ['masculino', 'feminino', 'trans'])->default('feminino');
            $table->string('mention')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('go_out_with')->nullable(); 
            $table->integer('age')->nullable(); 
            $table->string('type')->nullable(); 
            $table->string('body_type')->nullable(); 
            $table->string('height')->nullable(); 
            $table->integer('weight')->nullable(); 
            $table->string('shoe_size')->nullable();
            $table->string('eye_color')->nullable(); 
            $table->string('availability')->nullable(); 
            $table->string('meeting_places')->nullable(); 
            $table->string('rate')->nullable(); 
            $table->string('path_file_profile',)->nullable(); 
            $table->string('path_file_horizontal_cover',)->nullable(); 
            $table->string('path_file_vertical_cover',)->nullable(); 
            $table->string('payment_methods')->nullable(); 
            $table->boolean('available_for_travel')->default(0);
            $table->boolean('active')->default(0);
            $table->boolean('top_love')->default(0);
            $table->integer('sorting')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companions');
    }
};
