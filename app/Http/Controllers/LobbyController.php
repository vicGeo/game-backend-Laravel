<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Lobby;
use App\Models\Membership;

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

    public function LobbiesByGameId($id){
        try{
            return Lobby::all()->where('game_id', '=', $id);

        }catch(QueryException $error){
            return $error;
        }
    }

    public function login(Request $request){

        $userName_id = $request -> input('userName_id');
        $lobby_id = $request -> input('lobby_id');

        try{
            return Membership::create([
                'userName_id' => $userName_id,
                'lobby_id' => $lobby_id
            ]);

        }catch(QueryException $error){
            return $error;
        }
    }

    public function logout(Request $request, $id){

        $member = Membership::find($id);

        try{

            return $member->delete();

        }catch(QueryException $error){
            return $error;
        }
    }
}
