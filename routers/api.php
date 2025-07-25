<?php

use MovieChill\app\Controllers\Api\DashBoardController;
use MovieChill\app\Controllers\Api\GenerateQrController;
use MovieChill\app\Controllers\Api\TransactionsController;
use MovieChill\app\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('generate-qr',[GenerateQrController::class,'generateQr'])->name('generate-qr');
Route::post('generate-qr-mart',[GenerateQrController::class,'generateQrMart'])->name('generateQrMart');

Route::prefix("/hooks")->group(function () {
    Route::post('/sepay-payment', [TransactionsController::class, 'hookSepay']);
    Route::post('/transaction-app', [TransactionsController::class, 'hookTransactionApp']);
});

Route::post('/list-transaction', [TransactionsController::class, 'listTransaction']);
Route::get('/dashboard', [DashBoardController::class, 'index']);
Route::post('/login-user', [UserController::class, 'login']);
