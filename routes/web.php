<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthloginController; 
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LendingStaffController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('landing.landing');
})->name('landing');

Route::get('/login', [AuthloginController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthloginController::class, 'login'])->name('login.submit'); 
Route::post('/logout', [AuthloginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoriesController::class);
    });

    Route::middleware(['role:staff'])->group(function () {
        Route::get('/lendings/export', [LendingStaffController::class, 'export'])->name('lendings.export');
        Route::resource('lendings', LendingStaffController::class)->except(['show']);
        Route::patch('lendings/{lending}/return', [LendingStaffController::class, 'updateStatus'])->name('lendings.return');
    });

    Route::get('/items/export', [ItemsController::class, 'export'])->name('items.export');
    Route::resource('items', ItemsController::class);

    Route::get('/staff/export', [StaffController::class, 'export'])->name('staff.export');
    Route::get('/staff/admin', [StaffController::class, 'adminIndex'])->name('staff.admin');
    Route::get('/staff/operator', [StaffController::class, 'operatorIndex'])->name('staff.operator');
    Route::resource('staff', StaffController::class);

});