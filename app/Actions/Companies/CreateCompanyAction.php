<?php

namespace App\Actions\Companies;

use App\Company;

class CreateCompanyAction
{
    public function handle($request)
    {
        $company = new Company();
        $company->fill($request->except('logo'));
        $company->logo = $request->logo->store('companies', 'public');
        $company->save();
    }
}