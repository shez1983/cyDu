<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Repositories\CompaniesRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CompaniesController extends Controller
{
    protected $repository;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct(CompaniesRepository $repository)
    {
        $this->middleware('auth');

        $this->repository = $repository;
    }

    /**
     * Companies index page
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = $this->repository->paginated();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show a company
     *
     * @param int $companyId
     * @return Factory|\Illuminate\View\View
     */
    public function show(int $companyId)
    {
        $company = $this->repository->find($companyId);

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
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(CompanyStoreRequest $request)
    {
        $this->repository->create($request);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was updated successfully');
    }

    /**
     * Edit selected company
     *
     * @param int $companyId
     * @return Factory|\Illuminate\View\View
     */
    public function edit(int $companyId)
    {
        $company = $this->repository->find($companyId);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update selected company
     *
     * @param CompanyUpdateRequest $request
     * @param int $companyId
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(CompanyUpdateRequest $request, int $companyId)
    {
        $company = $this->repository->find($companyId);

        $this->repository->update($request, $company);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was updated successfully');
    }

    /**
     * Delete selected company
     *
     * @param int $companyId
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $companyId)
    {
        $company = $this->repository->find($companyId);

        $this->repository->destroy($company);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company was deleted successfully');
    }
}
