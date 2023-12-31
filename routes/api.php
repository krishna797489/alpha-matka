<?php

use App\Http\Controllers\AlphaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CustomerApiController;
use App\Http\Controllers\GamesController;

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
Route::post('updateprofile/{id}', [ApiController::class,'updateprofile']);
// Route::post('updateprofile',[ApiController::class,'updateprofile']);

Route::post('/varify-mobile', [ApiController::class, 'verifyMobile']);
Route::get('profile/{id}', [ApiController::class, 'myprofile']);
Route::post('changePassword/{id}',[ApiController::class,'changePassword']); //old pass throw change password

Route::post('generate-otp', [ApiController::class,'generate']);
Route::post('generate-otp', [ApiController::class,'generateOtp']);

//Participate
Route::post('/participate/{id}', [ApiController::class,'participate']);

//wallet se related
Route::post('/addpoint/{id}', [ApiController::class,'addpoint']);
Route::get('getPointSum/{user_id}', [ApiController::class, 'getPointSum']);
Route::get('addPointshistory/{user_id}', [ApiController::class, 'addPointsForhistory']);
//Route::get('withdrawPointsForhistory/{user_id}', [ApiController::class, 'withdrawPointsForhistory']);
Route::get('pointwithdraw/{user_id}', [ApiController::class, 'pointwithdraw']);

//games Api
Route::get('howtoplaypostget', [GamesController::class,'howtoplaypostget']);
Route::post('gamestore', [ApiController::class,'gamestore']);
Route::post('gamesupdate/{id}', [ApiController::class,'gamesupdate']);
Route::get('/getgames', [ApiController::class, 'getAllGames']);

//types games api
Route::post('/singledigit', [ApiController::class, 'singledigit']);
Route::post('/singlepanna', [ApiController::class, 'singlepanna']);

//Route::put('update/{id}',[ApiController::class,'update']);
Route::delete('/deletegames/{id}', 'ApiController@destroy');
Route::get('/showgames/{id}', 'ApiController@showgames');
Route::get('/list', [ApiController::class, 'index']);


//customer Api
Route::post('custstore', [CustomerApiController::class,'custstore']);
Route::post('custupdate/{id}', [CustomerApiController::class,'custupdate']);
Route::delete('/deletecustomer/{id}','CustomerApiController@destroy');
Route::get('/showcust/{id}', 'CustomerApiController@showcust');
Route::get('/listcust', [CustomerApiController::class, 'index']);


Route::get('/history/{id}', [ApiController::class, 'history']);
Route::get('/bidhistory/{id}', [ApiController::class, 'bidHistory']);
//contact get api
Route::get('/getContact', [ApiController::class, 'getContact']);

Route::get('/user/{id}/history', [ApiController::class, 'getHistory']);

//result se related
Route::get('/getresulthistory', [ApiController::class, 'getresulthistory']);

//notificationget related
Route::get('/notificationget', [ApiController::class, 'notificationget']);

