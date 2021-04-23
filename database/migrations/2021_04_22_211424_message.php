<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Message extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->text('message');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'fk_messages_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');
            $table->unsignedBigInteger('lobby_id')->nullable();
            $table->foreign('lobby_id', 'fk_messages_lobbies')
            ->on('lobbies')
            ->references('id')
            ->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
}    

