<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompaniesTest extends TestCase
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
    public function test_i_cannot_see_all_companies_if_not_logged()
    {
        $companies = factory(Company::class, 5)
            ->create();

        $this->get('companies')
            ->assertRedirect('login');
    }

    /**
     *
     * @return void
     */
    public function test_i_can_see_all_companies()
    {
        $companies = factory(Company::class, 5)
            ->create();

        $this->actingAs($this->loggedUser)
            ->get('companies')
            ->assertSee($companies->first()->name)
            ->assertSee($companies->first()->email)
            ->assertSee($companies->first()->logo)
            ->assertSee($companies->first()->website);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_see_one_company()
    {
        $company = factory(Company::class)
            ->create();

        $this->actingAs($this->loggedUser)
            ->get('companies/' . $company->id)
            ->assertSee($company->name)
            ->assertSee($company->email)
            ->assertSee($company->logo)
            ->assertSee($company->website);
    }

    /**
     *
     * @return void
     */
    public function test_i_cannot_create_company_if_not_logged()
    {
        Storage::fake('public');

        $data = factory(Company::class)
            ->make()
            ->toArray();

        $file = UploadedFile::fake()
            ->image('image.jpg', 100, 100)
            ->size(1024);

        $this->post('companies', array_merge(
                $data,
                ['logo' => $file]
            ));

        Storage::disk('public')
            ->assertMissing('companies/' . $file->hashName());

        $this->assertDatabaseMissing('companies', $data);
    }

    /**
     *
     * @return void
     */
    public function test_i_can_create_a_company()
    {
        Storage::fake('public');

        $data = factory(Company::class)
            ->make()
            ->toArray();

        $file = UploadedFile::fake()
            ->image('image.jpg', 100, 100)
            ->size(1024);

        $this->actingAs($this->loggedUser)
            ->post('companies', array_merge(
                $data,
                ['logo' => $file]
            ));

        Storage::disk('public')
            ->assertExists('companies/' . $file->hashName());

        $this->assertDatabaseHas('companies', array_merge(
            $data,
            ['logo' => 'companies/' . $file->hashName()]
        ));
    }

    /**
     *
     * @return void
     */
    public function test_i_can_update_a_company()
    {
        $currentCompany = factory(Company::class)->create();

        Storage::fake('public');

        $data = factory(Company::class)
            ->make()
            ->toArray();

        $file = UploadedFile::fake()
            ->image('image.jpg', 100, 100)
            ->size(1024);

        $this->actingAs($this->loggedUser)
            ->put('companies/' . $currentCompany->id, array_merge(
                $data,
                ['logo' => $file]
            ));

        Storage::disk('public')
            ->assertExists('companies/' . $file->hashName());

        $this->assertDatabaseHas('companies', array_merge(
            $data,
            ['logo' => 'companies/' . $file->hashName()]
        ));
    }

    /**
     *
     * @return void
     */
    public function test_i_can_delete_a_company()
    {
        $currentCompany = factory(Company::class)->create();

        $this->actingAs($this->loggedUser)
            ->delete('companies/' . $currentCompany->id);

        $this->assertDatabaseMissing('companies',
            ['id' => $currentCompany->id]
        );
    }
}

