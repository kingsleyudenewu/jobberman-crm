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
    public function testFetchAllCompanyWithoutPagination()
    {
        $this->withoutExceptionHandling();
        $this->json('GET', route('company.all'), $this->headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'statusCode' => 200,
                'message' => 'success'
            ]);
    }
}
