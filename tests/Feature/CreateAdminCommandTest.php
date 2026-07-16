<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateAdminCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_securely_creates_a_production_admin(): void
    {
        $this->artisan('app:create-admin', [
            '--name' => 'Site Administrator',
            '--email' => 'admin@samfut.com',
        ])
            ->expectsQuestion('Password (minimum 12 characters)', 'correct-horse-battery-staple')
            ->expectsQuestion('Confirm password', 'correct-horse-battery-staple')
            ->expectsOutput('Admin created.')
            ->assertSuccessful();

        $admin = Admin::where('email', 'admin@samfut.com')->firstOrFail();

        $this->assertSame('Site Administrator', $admin->name);
        $this->assertTrue(Hash::check('correct-horse-battery-staple', $admin->password));
    }
}
