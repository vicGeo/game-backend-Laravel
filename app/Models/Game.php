<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_url',
        'url_game',
        'description'
    ];

    public function lobbies()
    {
        return $this->hasMany('App\Models\Lobby','game_id');   
    }
}
