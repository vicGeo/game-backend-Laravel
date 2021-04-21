<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LobbyController;

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
Route::post('user/logout', [UserController::class, 'logoutUser']);
Route::get('user/', [UserController::class, 'allUsers']);
Route::get('user/{id}', [UserController::class, 'findUserById']);
Route::put('user/{id}',[UserController::class, 'updateUser']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::post('game/', [GameController::class, 'addGame']);
Route::get('game/', [GameController::class, 'allGames']);
Route::get('game/{id}', [GameController::class, 'searchGameById']);
Route::put('game/{id}', [GameController::class, 'updateGame']);
Route::delete('game/{id}', [GameController::class, 'deleteGameById']);

Route::post('game/{id}/lobby', [LobbyController::class, 'createLobby']);
Route::get('game/lobby/{id}', [LobbyController::class, 'LobbiesByGameId']);
Route::post('/lobby/login', [LobbyController::class, 'login' ]);
Route::delete('/lobby/logout/{id}', [LobbyController::class, 'logout' ]);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
