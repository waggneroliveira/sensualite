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
        Schema::table('companions', function (Blueprint $table) {
            $table->string('city')->nullable()->after('id');  
            $table->string('state')->nullable()->after('city');
            $table->boolean('is_courtesy')->default(0);
            $table->enum('companion_status_verification', ['approved', 'pending', 'rejected'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companions', function (Blueprint $table) {
            $table->dropColumn(['city', 'state']);
        });
    }
};
