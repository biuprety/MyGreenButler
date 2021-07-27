<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DayWeekFinderController;
use App\Http\Controllers\Api\UserController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::middleware('auth:api')->group(function(){
    Route::get('/day-week-finder',[DayWeekFinderController::class,'dayWeekFinder']);
});

Route::middleware('api')->group(function(){
    Route::post('/login',[UserController::class,'login']);
    //Route::get('/day-week-finder',[DayWeekFinderController::class,'dayWeekFinder']);
    //Route::post('/day-week-finder',[DayWeekFinderController::class,'dayWeekFinder']);
});

