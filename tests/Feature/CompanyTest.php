<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchAllCompany()
    {
        $this->withoutExceptionHandling();
        $token = $this->company->createToken('TestToken', ['company'])->accessToken;
        $this->headers['Authorization'] = 'Bearer '.$token;
        $this->json('GET', route('company.index'), $this->headers)->assertStatus(200);
    }

    public function testGetASingleCompany()
    {
        $this->withoutExceptionHandling();
        $token = $this->company->createToken('TestToken', ['company'])->accessToken;
        $this->headers['Authorization'] = 'Bearer '.$token;
        $company = $this->company->id;
        $this->json('GET', route('company.show', $company), $this->headers)->assertStatus(200);
    }

    public function testGetAllEmployees()
    {
        $this->withoutExceptionHandling();
        $token = $this->company->createToken('TestToken', ['company'])->accessToken;
        $this->headers['Authorization'] = 'Bearer '.$token;
        $company = $this->company->id;
        $this->json('GET', route('company.employees', $company), $this->headers)->assertStatus(200);
    }
}
