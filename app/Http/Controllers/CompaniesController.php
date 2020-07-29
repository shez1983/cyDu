<?php

namespace App\Http\Controllers;

use App\Actions\Companies\CreateCompanyAction;
use App\Actions\Companies\UpdateCompanyAction;
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
        (new CreateCompanyAction())
            ->handle($request);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was updated successfully');
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
        (new UpdateCompanyAction())
            ->handle($request, $company);

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
