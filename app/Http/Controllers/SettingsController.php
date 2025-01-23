<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('Settings', [
            'Company' => Company::first(),
        ]);
    }
}
