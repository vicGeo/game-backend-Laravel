<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Lobby;

class LobbyController extends Controller
{
    public function createLobby(Request $request, $game_id){

        $name = $request -> input('name');
        // $game_id = $request -> input('game_id');
        $owner_id = $request -> input('owner_id');

        try {

            return Lobby::create([
                'name' => $name,
                'game_id' => $game_id,
                'owner_id' => $owner_id
            ]);

        } catch (QueryException $error) {
            return $error;
        }
    }
}
