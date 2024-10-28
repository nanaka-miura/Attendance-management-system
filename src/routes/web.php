<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
    Route::get('/attendance/{id}', [UserController::class, 'detail']);
    Route::post('/attendance/{id}', [UserController::class, 'amendmentApplication']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/attendance/list', [AdminController::class, 'list']);
    Route::get('/admin/staff/list', [AdminController::class, 'staffList']);
    Route::get('/admin/attendance/staff/{id}', [AdminController::class, 'staffDetailList'])->name('userApplicationList');
    Route::post('/admin/logout', [AdminController::class, 'adminLogout']);
});

Route::middleware(['admin'])->group(function () {
    Route::get('/stamp_correction_request/list', [AdminController::class, 'applicationList'])->name('adminApplicationList');
    Route::get('/stamp_correction_request/list', [UserController::class, 'applicationList'])->name('userApplicationList');
});

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'doLogin']);