<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Lobby;

class MembershipController extends Controller
{
    //
    public function getLobbyPlayers(Request $request, $id)
    {
        $user = $request->user();

        if($user['id'] != $id){
            return response()->json([
                'error' => "No puedes ver el dato de otros usuarios"
            ]);
        }
        try {
            $membership = Membership::where('owner_id', $id)
                ->join('lobbies', 'lobbies.id', 'memberships.lobby_id')
                ->join('games', 'games.id', 'parties.game_id')->get();
            $ownership = $user->parties()->join('games', 'games.id', 'lobbies.game_id')->get();
            return [...$membership,...$ownership];
        }catch(QueryException $error){
            return $error;
        }
    }


}