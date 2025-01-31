<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RenderSettingsController;
use App\Http\Controllers\DeleteAllOrderSlips;
use App\Http\Controllers\OrderSlipController;
use App\Http\Controllers\Web\PagesController;
use App\Http\Controllers\RenderReportsController;
use App\Http\Controllers\ChangeNameCompanyController;
use App\Http\Controllers\RenderInvoicesController;

Route::get('/', [PagesController::class, 'Welcome'])->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::resource('order-slips', OrderSlipController::class);
    
    Route::resource('products', ProductController::class);
    
    Route::get('/invoices', RenderInvoicesController::class)->name('invoices');
    Route::get('/reports', RenderReportsController::class)->name('reports');
    
    Route::get('/settings', RenderSettingsController::class)->name('settings');
    Route::post('/settings/change-company-name', ChangeNameCompanyController::class)->name('change-company-name');
    Route::delete('/settings/delete-all-order-slips', DeleteAllOrderSlips::class)->name('delete-all-order-slips');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
