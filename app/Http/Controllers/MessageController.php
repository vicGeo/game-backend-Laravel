<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Database\QueryException;

class MessageController extends Controller
{
    public function createMessage(Request $request, $owner_id, $lobby_id){
        $message = $request->input('message');
    
        try {
    
          return Message::create([
              'message' => $message,
              'owner_id' => $owner_id,
              'lobby_id' => $lobby_id
          ]);
    
      } catch (QueryException $error) {
          
          $eCode = $error->errorInfo[1];
    
          if($eCode == 1062) {
              return response()->json([
                  'error' => "El mensaje no ha podido ser enviado"
              ]);
          }
    
      }
    
    }

    public function allMessagesByLobbyId($id){
        try{
            return Message::all()->where('owner_id', '=', $id);
        }catch(QueryException $error){
            return $error;
        }
    }
}
