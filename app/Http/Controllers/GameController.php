<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;

class GameController extends Controller
{
    public function addGame(Request $request){

        $title = $request->input('title');
        $thumbnail_url = $request->input('thumbnail_url');
        $url_game = $request->input('url_game');
        $description = $request->input('description');

        try{

            return Game::create([
                'title' => $title,
                'thumbnail_url' => $thumbnail_url,
                'url_game' => $url_game,
                'description' => $description,
            ]);

        }catch (QueryException $error) {

            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    'error' => "El juego ya existe"
                ]);
            }

        }
    }

        public function allGames (){
            try{
                return Game::all();
            }catch(QueryException $error){
                return $error;
            }
        }


        public function searchGameById (Request $request, $id){
            try{
                return Game::all()->where('id', '=', $id);

            } catch(QueryException $error) {
                return $error;
            }
        }

        public function updateGame(Request $request, $id){


            $title = $request->input('title');
            $thumbnail_url = $request->input('thumbnail_url');
            $url_game = $request->input('url_game');
            $description = $request->input('description');


            try{
                return Game::where('id', '=', $id)->update([
                    'title' => $title,
                    'thumbnail_url' => $thumbnail_url,
                    'url_game' => $url_game,
                    'description' => $description
                ]);
            } catch(QueryException $error) {
                return $error;
            }
        }


        public function deleteGameById(Request $request, $id){
            try {
                return Game::where ('id', '=', $id)
                ->delete();
            } catch(QueryException $error){
                return $error;
            }
        }
}
