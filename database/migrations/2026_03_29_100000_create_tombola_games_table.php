<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tombola_games', function (Blueprint $table) {
            $table->id();
            $table->binary('board_state')->nullable();
            $table->unsignedTinyInteger('last_drawn_number')->nullable();
            $table->string('current_objective', 50)->default('AMBO');
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('drawn_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tombola_games');
    }
};
