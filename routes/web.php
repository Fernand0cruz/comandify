<?php

use App\Http\Controllers\OrderSlipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\ProductController;


Route::get('/', [PagesController::class, 'Welcome'])->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::resource('order-slips', OrderSlipController::class);

    Route::delete('/delete-all-order-slips', [OrderSlipController::class, 'deleteAll'])->name('all-order-slips.delete');

    Route::resource('products', ProductController::class);

    Route::get('/invoices', [PagesController::class, 'invoices'])->name('invoices');
    Route::get('/reports', [PagesController::class, 'reports'])->name('reports');
    Route::get('/settings', [PagesController::class, 'settings'])->name('settings');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
