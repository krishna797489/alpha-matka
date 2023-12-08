<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// phpinfo(); die();
Route::get('/', function () {
    return view('authui.login');
});
//login route
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('verify', [AuthController::class, 'login'])->name('login.verify');
Route::get('/login/forgot', [AuthController::class, 'forgot'])->name('login.forgot');
Route::post('/login/sendforgetlink', [AuthController::class, 'sendforgetlink'])->name('login.sendforgetlink');
Route::get('/login/showResetPasswordForm/{token}', [AuthController::class, 'showResetPasswordForm'])->name('login.showResetPasswordForm');
Route::post('/login/submitResetPasswordForm', [AuthController::class, 'submitResetPasswordForm'])->name('login.submitResetPasswordForm');

//dashboard route
Route::group(['middleware' => ['auth']], function () {
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('dashboard/get', [DashboardController::class, 'get'])->name('dashboard.get');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//games route
Route::get('/games', [GamesController::class, 'index'])->name('games.index');
//types games
Route::get('/games/typegame', [GamesController::class, 'typegames'])->name('types.games');
Route::get('/games/JodiDigit', [GamesController::class, 'JodiDigit'])->name('types.JodiDigit');
Route::get('/games/SinglePana', [GamesController::class, 'SinglePana'])->name('types.SinglePana');
Route::get('/games/DoublePana', [GamesController::class, 'DoublePana'])->name('types.DoublePana');
Route::get('/games/TripplePana', [GamesController::class, 'TripplePana'])->name('types.TripplePana');
Route::get('/games/HalfSangamNumbers',[GamesController::class, 'HalfSangamNumbers'])->name('types.HalfSangamNumbers');
Route::get('/games/FullSangam',[GamesController::class, 'FullSangam'])->name('types.FullSangam');
//games how to play
Route::get('/games/howtoplay',[GamesController::class, 'howtoplay'])->name('howtoplay');
Route::post('/games/howtoplaypost',[GamesController::class, 'howtoplaypost'])->name('howtoplaypost');

//games rates
Route::get('/games/Gamesrated',[GamesController::class, 'Gamesrated'])->name('types.Gamesrated');
Route::post('/games/Gamesratedupdate',[GamesController::class, 'Gamesratedpost'])->name('types.Gamesratedpost');
Route::get('/games/showGamesrated',[GamesController::class, 'showGamesrated'])->name('types.showGamesrated');

//games relate delete update status
Route::get('/games/list', [GamesController::class, 'list'])->name('games.list');
Route::get('/games/get', [GamesController::class, 'get'])->name('games.get');
Route::post('/games/add', [GamesController::class, 'store'])->name('games.store');
Route::post('/games/edit', [GamesController::class, 'edit'])->name('games.edit');
Route::post('/games/delete', [GamesController::class, 'delete'])->name('games.delete');
Route::post('/games/status', [GamesController::class, 'status'])->name('games.status');

//customer route
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

//view detail
Route::get('employees/{id}', [CustomerController::class, 'viewdetail'])->name('viewdetail');
Route::get('History/{id}', [CustomerController::class, 'History'])->name('History');
Route::get('bidhistory/{id}', [CustomerController::class, 'bidhistory'])->name('bidhistory');


Route::get('/customer/add', [CustomerController::class, 'add'])->name('customer.add');
Route::post('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/customer/list', [CustomerController::class, 'list'])->name('customer.list');
Route::get('/customer/get/{id}', [CustomerController::class, 'get'])->name('customer.get');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/customer/status', [CustomerController::class, 'status'])->name('customer.status');
Route::post('/customer/delete', [CustomerController::class, 'delete'])->name('customer.delete');

Route::post('/customer/point', [CustomerController::class, 'addpoint'])->name('customer.addpoint');

Route::get('/withdraw/list', [CustomerController::class, 'withdraw'])->name('withdraw.list');

Route::get('/Addfund', [CustomerController::class, 'showUserInfo'])->name('addfunduser');

Route::post('/balance/store', [CustomerController::class, 'store'])->name('balance.store');
});
