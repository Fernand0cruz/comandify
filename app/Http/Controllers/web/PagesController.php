<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\OrderSlip;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function welcome()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function invoices()
    {
        return Inertia::render('Invoices');
    }
}