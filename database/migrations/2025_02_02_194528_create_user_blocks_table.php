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
        Schema::create('user_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blocker_id'); // Quem bloqueou
            $table->enum('blocker_type', ['cliente', 'acompanhante']); // Tipo de quem bloqueou
            $table->unsignedBigInteger('blocked_id'); // Quem foi bloqueado
            $table->enum('blocked_type', ['cliente', 'acompanhante']); // Tipo de quem foi bloqueado
            $table->timestamps();

            // Índices para otimizar buscas
            $table->index(
                ['blocker_id', 'blocker_type', 'blocked_id', 'blocked_type'],
                'user_blocks_block_idx'
            );
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_blocks');
    }
};
