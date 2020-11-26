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
    public function testLogin()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'email' => $this->user->email,
            'password' => 'password',
        ];
        $this->json('POST','/api/v1/auth/login', $payload, $this->headers)->assertStatus(200);
        $this->assertAuthenticated();
    }
}
