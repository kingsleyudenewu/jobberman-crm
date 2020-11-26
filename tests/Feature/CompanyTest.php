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
        $this->json('GET', route('company.index'), $this->headers)->assertStatus(200);
    }

    public function testGetASingleCompany()
    {
        $this->withoutExceptionHandling();
        $company = $this->company->id;
        $this->json('GET', route('company.show', $company), $this->headers)->assertStatus(200);
    }
}
