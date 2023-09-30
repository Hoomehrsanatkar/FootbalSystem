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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('team_1_id');
            $table->integer('team_2_id');
            $table->string('start');
            $table->string('end');
            $table->string('date');
            $table->string('team_1');
            $table->string('team_2');
            $table->string('team_1_score');
            $table->string('team_2_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
