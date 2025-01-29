<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Inertia\Inertia;

class RenderSettingsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Settings', [
            'Company' => Company::first(),
        ]);
    }
}
