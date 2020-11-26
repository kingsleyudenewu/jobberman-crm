<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => $this->user->email,
            'password' => 'password',
        ];
        $this->json('POST',route('admin.login'), $payload, $this->headers)->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function testCompanyLogin()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => $this->company->email,
            'password' => 'password',
        ];
        $this->json('POST',route('company.login'), $payload, $this->headers)->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function testEmployeeLogin()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => $this->employee->email,
            'password' => 'password',
        ];
        $this->json('POST',route('employee.login'), $payload, $this->headers)->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function testMustEnterEmail()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => '',
            'password' => 'password',
        ];
        $this->json('POST',route('admin.login'), $payload, $this->headers)
            ->assertStatus(422)
            ->assertJsonFragment([
                'statusCode' => 422,
                'message' => 'Whoops. Validation failed.'
            ]);
    }
}
