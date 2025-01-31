<?php

namespace App\Http\Controllers;

use Inertia\Inertia;


class RenderInvoicesController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Invoices');
    }
}
