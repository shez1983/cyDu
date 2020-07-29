<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all('id')
            ->each(function ($company) {
                factory(Employee::class, 20)
                    ->create([
                        'company_id' => $company->id,
                    ]);
            });
    }
}
