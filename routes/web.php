<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\ApprovalController;

Route::get('/',  [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware(['role:superadmin,admin'])
        ->prefix('permit')
        ->group(function () {
            
        Route::get('/', [PermitController::class, 'index'])
            ->name('permit.index');
         Route::get('/create', [PermitController::class, 'create'])
            ->name('permit.create');
        Route::post('/store', [PermitController::class, 'store'])
            ->name('permit.store');
        Route::get('/{permit}', [PermitController::class, 'show'])
            ->name('permit.show');
        Route::get('/{permit}/edit', [PermitController::class, 'edit'])
            ->name('permit.edit');
        Route::put('/{permit}/update', [PermitController::class, 'update'])
            ->name('permit.update');
        Route::delete('/{permit}/destroy', [PermitController::class, 'destroy'])
            ->name('permit.destroy');
        Route::post('/{permit}/submit', [PermitController::class, 'submit'])
            ->name('permit.submit');
    });

    Route::middleware(['role:superadmin,admin'])
        ->prefix('approval')
        ->group(function () {
        
        Route::get('/', [ApprovalController::class, 'index'])
            ->name('approval.index');
        Route::get('/{approval}', [ApprovalController::class, 'show'])
            ->name('approval.show');
        Route::post('/{approval}/approve', [ApprovalController::class, 'approve'])
            ->name('approval.approve');
        Route::post('/{approval}/reject', [ApprovalController::class, 'reject'])
            ->name('approval.reject');
        Route::post('/{approval}/confirm-return', [ApprovalController::class, 'confirmReturn'])
            ->name('approval.confirm-return');
    });
});