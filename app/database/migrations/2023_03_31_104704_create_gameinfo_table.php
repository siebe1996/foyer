<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameinfo', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained();
            $table->foreignId('game_id')->constrained();
            $table->unsignedBigInteger('goals')->default(0);
            $table->timestamps();
            $table->primary(['game_id', 'team_id']);
            $table->unique(['game_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gameinfo');
    }
};
