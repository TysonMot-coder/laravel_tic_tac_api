<?php

use App\Http\Controllers\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Routes player data

Route::apiResource('Scores', ScoreController::class);
Route::get('/player-scores',[ScoreController::class, 'show']);
Route::get('/player-scores/{id}',[ScoreController::class, 'showById']);
Route::post('/create-scores',[ScoreController::class, 'store']);
Route::patch('/update-scores/{id}',[ScoreController::class, 'update']);
Route::delete('/delete-score/{id}',[ScoreController::class, 'destroy']);
