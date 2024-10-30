<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MiddlewareController;
use App\Http\Middleware\AdminStatusMiddleware;



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

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [UserController::class, 'index']);
    Route::post('/attendance', [UserController::class, 'attendance']);
    Route::get('/attendance/list', [UserController::class, 'list']);

    Route::get('/stamp_correction_request/list', [UserController::class, 'applicationList'])->name('userApplicationList')->middleware(AdminStatusMiddleware::class);
    Route::get('/attendance/{id}', [UserController::class, 'detail']);
    Route::post('/attendance/{id}', [UserController::class, 'amendmentApplication']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/attendance/list', [AdminController::class, 'list']);
    Route::get('/admin/staff/list', [AdminController::class, 'staffList']);
    Route::get('/admin/attendance/staff/{id}', [AdminController::class, 'staffDetailList']);
    Route::post('/admin/logout', [AuthController::class, 'adminLogout']);
    Route::get('/stamp_correction_request/approve/{id}', [AdminController::class, 'approvalShow']);
    Route::post('/stamp_correction_request/approve/{id}', [AdminController::class, 'approval']);

    Route::get('/stamp_correction_request/list', [AdminController::class, 'applicationList'])->name('adminApplicationList')->middleware(AdminStatusMiddleware::class);
    Route::get('/attendance/{id}', [AdminController::class, 'detail']);
    Route::post('/attendance/{id}/', [AdminController::class, 'amendmentApplication']);
});

Route::get('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/login', [AuthController::class, 'doLogin']);