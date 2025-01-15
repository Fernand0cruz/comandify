<?php

use App\Http\Controllers\OrderSlipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\ProductController;


Route::get('/', [PagesController::class, 'Welcome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('order-slip', OrderSlipController::class);
    Route::resource('product', ProductController::class);

    Route::get('/reports', [PagesController::class, 'Reports'])->name('reports');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
