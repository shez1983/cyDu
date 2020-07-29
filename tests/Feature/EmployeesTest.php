<?php

namespace Tests\Feature;

use App\Company;
use App\Employee;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use DatabaseMigrations;

    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->loggedUser = factory(User::class)->create();
    }

    /**
     *
     * @return void
     */
    public function test_i_cannot_see_all_employees_if_not_logged()
    {
        $employees = factory(Employee::class, 5)
            ->create();

        $companies = Company::all();

        $companyName = $companies
            ->where('id', $employees->first()->company_id)
            ->first()
            ->name;

        $this->get('employees')
            ->assertRedirect('login');
    }

    /**
     *
     * @return void
     */
    public function test_i_can_see_all_employees()
    {
        $employees = factory(Employee::class, 5)
            ->create();

        $companies = Company::all();

        $companyName = $companies
            ->where('id', $employees->first()->company_id)
            ->first()
            ->name;

        $this->actingAs($this->loggedUser)
            ->get('employees')
            ->assertSee($employees->first()->first_name)
            ->assertSee($employees->first()->last_name)
            ->assertSee($employees->first()->email)
            ->assertSee($employees->first()->phone)
            ->assertSee($companyName);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_see_one_employee()
    {
        $employee = factory(Employee::class)
            ->create();

        $companyName = Company::find($employee->company_id)
            ->name;

        $this->actingAs($this->loggedUser)
            ->get('employees/' . $employee->id)
            ->assertSee($employee->first_name)
            ->assertSee($employee->last_name)
            ->assertSee($employee->email)
            ->assertSee($employee->phone)
            ->assertSee($companyName);
    }

    /**
     *
     * @return void
     */
    public function test_i_cannot_create_employee_if_not_logged()
    {
        $data = factory(Employee::class)
            ->make()
            ->toArray();

        $this->post('employees', $data);

        $this->assertDatabaseMissing('employees', $data);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_create_an_employee()
    {
        $data = factory(Employee::class)
            ->make()
            ->toArray();

        $this->actingAs($this->loggedUser)
            ->post('employees', $data);

        $this->assertDatabaseHas('employees', $data);
    }

    /**
     *
     * @return void
     */
    public function test_i_cant_create_an_employee_with_invalid_company()
    {
        $data = factory(Employee::class)
            ->make()
            ->toArray();

        $data['company_id'] = 999;

        $this->actingAs($this->loggedUser)
            ->post('employees', $data);

        $this->assertDatabaseMissing('employees', $data);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_update_an_employee()
    {
        $currentEmployee = factory(Employee::class)->create();

        $data = factory(Employee::class)
            ->make()
            ->toArray();

        $this->actingAs($this->loggedUser)
            ->put('employees/' . $currentEmployee->id, $data);

        $data['id'] = $currentEmployee->id;

        $this->assertDatabaseHas('employees', $data);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_delete_an_employee()
    {
        $currentEmployee = factory(Employee::class)->create();

        $this->actingAs($this->loggedUser)
            ->delete('employees/' . $currentEmployee->id);

        $this->assertDatabaseMissing('employees',
            ['id' => $currentEmployee->id]
        );
    }
}

