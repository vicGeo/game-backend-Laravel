<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'lobby_id',
        'user_id',
    ];

    public function user () {
        return $this -> hasMany('App\Models\User', 'user_id');
    }
    public function party () {
        return $this -> belongsTo('App\Models\Lobby', 'lobby_id');
    }
}
