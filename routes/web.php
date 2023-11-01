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
Route::get('/games/list', [GamesController::class, 'list'])->name('games.list');
Route::get('/games/get', [GamesController::class, 'get'])->name('games.get');
Route::post('/games/add', [GamesController::class, 'store'])->name('games.store');
Route::post('/games/edit', [GamesController::class, 'edit'])->name('games.edit');
Route::post('/games/delete', [GamesController::class, 'delete'])->name('games.delete');

//customer route
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/add', [CustomerController::class, 'add'])->name('customer.add');
Route::post('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/customer/list', [CustomerController::class, 'list'])->name('customer.list');
Route::get('/customer/get/{id}', [CustomerController::class, 'get'])->name('customer.get');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/customer/status', [CustomerController::class, 'status'])->name('customer.status');
Route::post('/customer/delete', [CustomerController::class, 'delete'])->name('customer.delete');

});