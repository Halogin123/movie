<?php

use App\Http\Controllers\EnglishController;
use Ducnm\app\Controllers\Admin\AssetCategoriesController;
use Ducnm\app\Controllers\Admin\AssetController;
use Ducnm\app\Controllers\Admin\DashboardController;
use Ducnm\app\Controllers\Admin\FundCertificatesController;
use Ducnm\app\Controllers\Admin\GroupPermissionController;
use Ducnm\app\Controllers\Admin\LogIpController;
use Ducnm\app\Controllers\Admin\PermissionController;
use Ducnm\app\Controllers\Admin\StockController;
use Ducnm\app\Controllers\Admin\StockTransactionController;
use Ducnm\app\Controllers\Admin\TransactionsController;
use Ducnm\app\Controllers\Admin\UserController;
use Ducnm\app\Controllers\Api\GenerateQrController;
use Ducnm\app\Controllers\GoogleController;
use Ducnm\app\Controllers\LoginController;
use Ducnm\app\Controllers\MyLoveController;
use Ducnm\app\Controllers\ProfileController;
use Ducnm\app\Controllers\ReportController;
use Ducnm\app\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::domain(env('DUCNM'))->group(function () {
    Route::get('/',[ProfileController::class,'index'])->name('ducnm');
});
//
//Route::domain(env('NHUNGNVH'))->group(function () {
//    Route::get('/',[ProfileController::class,'nhungNVH'])->name('nhungnvh');
//});
//
//Route::domain(env('MYLOVE'))->group(function () {
//    Route::get('/',[MyLoveController::class,'index']);
//});

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login-submit');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::middleware(['auth'])->prefix("/admin")->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/list', [MyLoveController::class,'listUser'])->name('list-member');
    Route::get('/member/{id}', [MyLoveController::class,'getMember'])->name('get-member');
    Route::post('/member/{id}', [MyLoveController::class,'editMember'])->name('edit-member');
    Route::resource('/logip',LogIpController::class);
    Route::resource('stocks', StockController::class);
    Route::get('dashboard-stock', [StockController::class, 'dashboard'])->name('dashboard-stock');
    Route::get('stocks/craw/{code}', [StockController::class, 'crowInfo'])->name('craw-info');
    Route::resource('stock-transactions', StockTransactionController::class);
    Route::resource('fund-certificates', FundCertificatesController::class);

    Route::prefix("/asset")->group(function () {
        Route::resource('asset-categories', AssetCategoriesController::class);
        Route::resource('asset', AssetController::class);

        Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions.index')->middleware('checkPermission:view-transactions');
        Route::get('transactions/create', [TransactionsController::class, 'create'])->name('transactions.create')->middleware('checkPermission:create-transactions');
        Route::post('transactions', [TransactionsController::class, 'store'])->name('transactions.store')->middleware('checkPermission:create-transactions');
        Route::get('count-transactions', [TransactionsController::class, 'countTransactions'])->name('count-transactions');
    });

    Route::prefix("/system")->group(function () {
        Route::resource('group-permission', GroupPermissionController::class);
        Route::resource('permission', PermissionController::class);
    });

    Route::prefix("/user")->group(function () {
        Route::get('/{id}', [UserController::class,'show'])->name('user.show');
        Route::post('/', [UserController::class,'update'])->name('user.update');
    });
});

Route::get('generate-qr', [GenerateQrController::class, 'index']);
Route::get('ngoc-chinh-mart', [GenerateQrController::class, 'mart']);

Route::get('/test', [TestController::class,'index']);
Route::post('/report', [ReportController::class,'sendReport'])->name('sendReport');

Route::fallback(function () {
    return view('admin.pages.not-found.404');
});
