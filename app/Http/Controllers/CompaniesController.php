<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Companies index page
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::latest()->paginate();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show a company
     *
     * @param Company $company
     * @return Factory|\Illuminate\View\View
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Create a company
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a new company into DB
     *
     * @param CompanyStoreRequest $request
     */
    public function store(CompanyStoreRequest $request)
    {
        $company = new Company();
        $company->fill($request->except('logo'));
        $company->logo = $request->logo->store('companies', 'public');
        $company->save();
    }

    /**
     * Edit selected company
     *
     * @param Company $company
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update selected company
     *
     * @param CompanyUpdateRequest $request
     * @param Company $company
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->fill($request->except('logo'));

        if($request->hasFile('logo')) {
            $company->logo = $request->logo->store('companies', 'public');
        }

        $company->save();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was updated successfully');
    }

    /**
     * Delete selected company
     *
     * @param Company $company
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was deleted successfully');
    }
}
