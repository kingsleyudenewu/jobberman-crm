<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin Admin',
            'email' => 'test@test.com',
            'password' => 'password',
            'email_verified_at' => now()
        ]);

        Company::factory()->count(20)->create();
        Employee::factory()->count(60)->create();
    }
}
