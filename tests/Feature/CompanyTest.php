<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * @group all_company
     */
    public function testFetchAllCompany()
    {
        $this->withoutExceptionHandling();
        $this->json('GET', route('company.index'), $this->headers)->assertStatus(200);
    }

    /**
     * @group company_test
     */
    public function testGetASingleCompany()
    {
        $this->withoutExceptionHandling();
        $company = $this->company->id;
        $this->json('GET', route('company.show', $company), $this->headers)->assertStatus(200);
    }

    /**
     * @group company_test
     */
    public function testGetAllEmployees()
    {
        $this->withoutExceptionHandling();
        $company = $this->company->id;
        $this->json('GET', route('company.employees', $company), $this->headers)->assertStatus(200);
    }
}
