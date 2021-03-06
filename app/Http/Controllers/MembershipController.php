<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Lobby;
use App\Models\Membership;

class MembershipController extends Controller
{
    //
    public function getLobbyUsers(Request $request, $id)
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
                ->join('games', 'games.id', 'lobbies.game_id')->get();
            $ownership = $user -> lobbies() -> join('games', 'games.id', 'lobbies.game_id')->get();
            return [...$membership,...$ownership];
        }catch(QueryException $error){
            return $error;
        }
    }

    public function getUsersInLobby(Request $request, $id)
    {
        try {
            $bymembership = Membership::where('lobby_id',$id)
                ->join('users', 'users.id', '=', 'memberships.owner_id')
                ->select(['userName'])->get();
            $byownership = Lobby::find($id)->user()->select(['userName'])->get();
            return [...$bymembership,...$byownership];
        } catch(QueryException $error) {
            return $error;
        }
    }

    public function newMembership(Request $request, $userName_id, $lobby_id)
    {
        $user = $request->user();
        if ($user['id'] != $userName_id) {
            return response()->json([
                'error' => "No autorizado."
            ]);
        }
        try {
            return response()->json(
                Membership::create([
                    "userName_id" => $userName_id,
                    "lobby_id" => $lobby_id,
                ])
            );
        } catch(QueryException $error) {
            return $error;
        }
    }

    public function delete(Request $request, $owner_id, $lobby_id)
    {
        $user = $request->user();
        if ($user['id'] != $owner_id) {
            return response()->json([
                'error' => "No autorizado."
            ]);
        }
        try {
            return Membership::where('owner_id',$owner_id)
                ->where('lobby_id',$lobby_id)
                ->delete();
        } catch(QueryException $error) {
            return $error;
        }
    }

}