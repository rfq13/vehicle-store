<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;
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

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::group([ 'middleware' => 'jwt.auth' ], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');

    });
});

Route::group([ 'middleware' => 'jwt.auth' ], function ($router) {
    Route::group([ 'prefix' => 'vehicle' ], function ($router) {
        Route::get('/stock', [VehicleController::class, 'getStock']); // lihat stock kendaraan
    });

    Route::group([ 'prefix' => 'transaction' ], function ($router) {
        Route::get('/', [TransactionController::class, 'index']); // laporan penjualan & laporan penjualan per kendaraan
        Route::get('/{id}', [TransactionController::class, 'show']);
        Route::post('/', [TransactionController::class, 'store']);
    });
});

