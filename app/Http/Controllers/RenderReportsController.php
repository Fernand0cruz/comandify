<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\OrderSlip;

class RenderReportsController extends Controller
{
    public function __invoke()
    {
        $orderSlips = OrderSlip::withTrashed()->with('products')->get();
        return Inertia::render('Reports', [
            'orderSlips' => $orderSlips,
        ]);
    }
}
