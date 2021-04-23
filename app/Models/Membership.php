<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'lobby_id',
        'owner_id',
    ];

    public function user() {
        return $this -> hasMany('App\Models\User', 'owner_id', 'id');
    }
    public function lobby() {
        return $this -> belongsTo('App\Models\Lobby', 'lobby_id', 'id');
    }
}
