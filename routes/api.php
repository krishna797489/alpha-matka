<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CustomerApiController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Registration route
Route::post('register',[ApiController::class,'register']);
// Route::get('getragister','RegisterController@getragister',);

//otp send varify
Route::post('/send-otp', [ApiController::class,'sendOtp']);
Route::post('/verify-otp',[ApiController::class,'verifyOtp']);



// Login route
Route::post('/login',[ApiController::class,'login']);
Route::post('/logout', [ApiController::class, 'logout']);
Route::post('update/{id}', [ApiController::class, 'updateprofile']);
Route::post('updateprofile',[ApiController::class,'updateprofile']);

Route::post('/varify-mobile', [ApiController::class, 'verifyMobile']);
Route::get('profile/{id}', [ApiController::class, 'myprofile']);
Route::post('change-password',[ApiController::class,'changePassword']); //old pass throw change password 



//games Api
Route::post('gamestore', [ApiController::class,'gamestore']);
Route::post('gamesupdate/{id}', [ApiController::class,'gamesupdate']);
Route::get('/getgames', [ApiController::class, 'getAllGames']);

//Route::put('update/{id}',[ApiController::class,'update']);
Route::delete('/deletegames/{id}', 'ApiController@destroy');
Route::get('/showgames/{id}', 'ApiController@showgames');
Route::get('/list', [ApiController::class, 'index']);


//customer Api
Route::post('custstore', [CustomerApiController::class,'custstore']);
Route::put('custupdate/{id}', [CustomerApiController::class,'custupdate']);
Route::delete('/deletecustomer/{id}','CustomerApiController@destroy');
Route::get('/showcust/{id}', 'CustomerApiController@showcust');
Route::get('/listcust', [CustomerApiController::class, 'index']);







