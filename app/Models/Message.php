<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'lobby_id',
        'owner_id'
    ];

    public function users(){

        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    public function lobbies(){

        return $this->belongsTo('App\Models\Lobby', 'lobby_id');
    }
}
