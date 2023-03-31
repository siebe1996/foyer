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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('speler1')->references('id')->on('users');
            $table->unique('speler1');
            $table->foreignId('speler2')->nullable()->references('id')->on('users');
            $table->unique('speler2');
            $table->unsignedBigInteger('total_wins')->default(0);
            $table->unsignedBigInteger('games_played')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
