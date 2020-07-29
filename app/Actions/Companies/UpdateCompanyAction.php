<?php

namespace App\Actions\Companies;

use App\Company;

class UpdateCompanyAction
{
    public function handle($request, $company)
    {
        $company->fill($request->except('logo'));

        if($request->hasFile('logo')) {
            $company->logo = $request->logo->store('companies', 'public');
        }

        $company->save();
    }
}