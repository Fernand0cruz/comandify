<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ChangeNameCompanyController extends Controller
{
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|min:3|max:255',
        ]);

        $company = Company::firstOrFail();

        $company->name = $validatedData['company_name'];

        $company->save();

        return to_route('order-slips.index')->with('success', 'Nome da empresa alterado com sucesso');
    }
}
