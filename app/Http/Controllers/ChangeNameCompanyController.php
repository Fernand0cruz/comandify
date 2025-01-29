<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeNameCompanyRequest;
use App\Models\Company;

class ChangeNameCompanyController extends Controller
{
    public function __invoke(ChangeNameCompanyRequest $request)
    {
        $validatedData = $request->validated();

        $company = Company::firstOrFail();

        $company->name = $validatedData['company_name'];

        $company->save();

        return to_route('order-slips.index')->with('success', 'Nome da empresa alterado com sucesso');
    }
}
