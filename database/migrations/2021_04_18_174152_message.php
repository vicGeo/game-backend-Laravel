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
            $table->id();
            $table->text('message');
            $table->timestamp('date');
            $table->boolean('edited')->default(false);
            $table->boolean('deleted')->default(false);
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id', 'fk_messages_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');
            $table->unsignedBigInteger('lobby_id');
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
