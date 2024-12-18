<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class OrderSlipController extends Controller
{
    public function index()
    {
        return Inertia::render('OrderSlip');
    }
}
