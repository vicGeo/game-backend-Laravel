<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('user/', [UserController::class, 'registerUser']);
Route::post('user/login',[UserController::class, 'loginUser']);

Route::post('game/', [GameController::class, 'addGame']);

Route::get('user/', [UserController::class, 'allUsers']);
Route::get('user/{id}', [UserController::class, 'findUserById']);

Route::middleware('auth:api')->group(function(){
    
    Route::post('user/logout', [UserController::class, 'logoutUser']);
    Route::put('user/{id}',[UserController::class, 'updateUser']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
    
    Route::get('game/', [GameController::class, 'allGames']);
    Route::get('game/{id}', [GameController::class, 'searchGameById']);
    Route::put('game/{id}', [GameController::class, 'updateGame']);
    Route::delete('game/{id}', [GameController::class, 'deleteGameById']);
    
    Route::post('game/{id}/lobby', [LobbyController::class, 'createLobby']);
    Route::post('lobby/login', [LobbyController::class, 'login' ]);
    Route::get('game/lobby/{id}', [LobbyController::class, 'LobbiesByGameId']);
    Route::delete('lobby/logout/{id}', [LobbyController::class, 'logout']);
    Route::delete('lobby/{id}', [LobbyController::class, 'destroy']);
    
    Route::get('user/{id}/lobby', [MembershipController::class, 'getLobbyUsers']);
    Route::get('lobbies/{id}/users', [MembershipController::class, 'getUsersInLobby']);
    Route::delete('user/{owner_id}/lobbies/{lobby_id}', [MembershipController::class, 'delete']);
    Route::put('user/{userName_id}/lobbies/{lobby_id}', [MembershipController::class, 'newMembership']);
    
    Route::post('user/{id}/message/{lobby_id}', [MessageController::class, 'createMessage']);
    Route::get('message/{id}', [MessageController::class, 'allMessagesByUserId']);
    Route::delete('message/{id}', [MessageController::class, 'deleteMessage']);
    
});