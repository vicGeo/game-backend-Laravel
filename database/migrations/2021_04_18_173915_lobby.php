<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lobby extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lobbies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30);
            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id', 'fk_lobbies_games')
            ->on('games')
            ->references('id')
            ->onDelete('set null');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id', 'fk_lobbies_owners')
            ->on('users')
            ->references('id')
            ->onDelete('set null');
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
        Schema::dropIfExists('lobbies');
    }
}
