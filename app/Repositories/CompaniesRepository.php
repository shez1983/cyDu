<?php

namespace App\Repositories;

use App\Company;

class CompaniesRepository
{
    public function paginated()
    {
        return Company::latest()->paginate();
    }

    public function find($id)
    {
        return Company::find($id);
    }

    public function create($request)
    {
        $company = new Company();
        $company->fill($request->except('logo'));
        $company->logo = $request->logo->store('companies', 'public');
        $company->save();
    }

    public function update($request, $company)
    {
        $company->fill($request->except('logo'));

        if($request->hasFile('logo')) {
            $company->logo = $request->logo->store('companies', 'public');
        }

        $company->save();
    }

    public function destroy($company)
    {
        $company->delete();
    }
}