<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParticipanController;
use App\Http\Controllers\RoleuserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperadminController;
use App\Http\Middleware\UserAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Register Users
Route::get('admin/registerusers', [RegisterController::class, 'index'])->middleware('auth');
Route::post('admin/registerusers', [RegisterController::class, 'store']);


// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::middleware([UserAccess::class . ':superadmin'])->group(function () {

        Route::get('admin/', [SuperadminController::class, 'index'])->middleware('auth');
        Route::get('admin/userall', [SuperadminController::class, 'userAll'])->middleware('auth');
        Route::get('admin/recap', [SuperadminController::class, 'recapAll'])->middleware('auth');
        Route::get('admin/recap/{user_id}/preview', [SuperadminController::class, 'previewData'])->middleware('auth');
    });

    Route::middleware([UserAccess::class . ':peserta'])->group(function () {
        Route::get('dashboard', [ParticipanController::class, 'index'])->middleware('auth');
        Route::get('dashboard/show', [ParticipanController::class, 'show']);
        Route::get('dashboard/create', [ParticipanController::class, 'create']);
        Route::get('dashboard/editprofile', [ParticipanController::class, 'editprofile']);
        Route::get('dashboard/show/{user_id}/preview', [ParticipanController::class, 'previewData']);
        Route::post('dashboard/store', [ParticipanController::class, 'store']);
        // routes/web.php
        Route::post('/dashboard/uploadSickLetter', [ParticipanController::class, 'uploadSickLetter']);
        Route::post('/dashboard/{id}/editprofile', [ParticipanController::class, 'updateprofile']);
    });

    Route::get('/registeruser', [RegisterController::class, 'index'])->middleware('auth');
    Route::post('/registeruser', [RegisterController::class, 'store']);
});
