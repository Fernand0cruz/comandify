<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class PagesController extends Controller
{
    public function Welcome()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function OrderSlip()
    {
        return Inertia::render('OrderSlip');
    }

    public function Product()
    {
        return Inertia::render('Product/Product');
    }
}