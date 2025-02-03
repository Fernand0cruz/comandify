<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;
use Inertia\Inertia;


class RenderInvoicesController extends Controller
{
    public function __invoke()
    {
        $invoices = OrderSlip::withoutTrashed()
            ->with('products')
            ->get();
        return Inertia::render('Invoices', ['invoices' => $invoices]);
    }
}
