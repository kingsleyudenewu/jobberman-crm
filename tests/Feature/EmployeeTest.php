<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * Feature test to fetch all employees
     *
     * @group employee_test
     */
    public function testFetchAllEmployees()
    {
        $this->withoutExceptionHandling();
        $this->json('GET', route('employee.index'), $this->headers)
            ->assertStatus(200)
            ->assertJsonFragment([
                'statusCode' => 200,
                'message' => 'success'
            ]);
    }
}
