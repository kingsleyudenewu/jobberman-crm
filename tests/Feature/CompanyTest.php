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
//        $this->withoutMiddleware();
        $this->json('GET', 'api/v1/companies')->assertStatus(200);
    }
}
