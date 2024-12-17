<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PagesController;

Route::get('/', [PagesController::class, 'Welcome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/order-slip', [PagesController::class, 'OrderSlip'])->name('order-slip');
    Route::get('/product', [PagesController::class, 'Product'])->name('product');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
