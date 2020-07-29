<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class EmployeesController extends Controller
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
     * Employees index page
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::with('company')
            ->latest()
            ->paginate();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show an Employee
     *
     * @param Employee $employee
     * @return Factory|\Illuminate\View\View
     */
    public function show(Employee $employee)
    {
        $employee->load('company');

        return view('employees.show', compact('employee'));
    }

    /**
     * Create a Employee
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        $companies = Company::all('id', 'name');

        return view('employees.create', compact('companies'));
    }

    /**
     * Store a new employee into DB
     *
     * @param EmployeeStoreRequest $request
     */
    public function store(EmployeeStoreRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->all());
        $employee->save();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee was created successfully');
    }

    /**
     * Edit selected Employee
     *
     * @param Employee $employee
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Employee $employee)
    {
        $employee->load('company');

        $companies = Company::all('id', 'name');

        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update selected Employee
     *
     * @param EmployeeUpdateRequest $request
     * @param Employee $employee
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->fill($request->all());
        $employee->save();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee was updated successfully');
    }

    /**
     * Delete selected Employee
     *
     * @param Employee $employee
     * @return Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee was deleted successfully');
    }
}
