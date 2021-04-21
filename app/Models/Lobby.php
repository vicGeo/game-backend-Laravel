<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lobby extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_id',
        'owner_id',
        'message_id'
    ];

    public function user(){

        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    public function game(){

        return $this->belongsTo('App\Models\Game', 'game_id', 'id');
    }

    public function message(){

        return $this->hasMany('App\Models\Message', 'message_id', 'id');
    }
}
