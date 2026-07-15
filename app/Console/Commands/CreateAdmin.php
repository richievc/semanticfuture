<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin {--name=} {--email=}';

    protected $description = 'Create or update an administrator using a securely prompted password';

    public function handle(): int
    {
        $name = (string) ($this->option('name') ?: $this->ask('Admin name'));
        $email = (string) ($this->option('email') ?: $this->ask('Admin email'));

        $identity = Validator::make(compact('name', 'email'), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($identity->fails()) {
            foreach ($identity->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $existingAdmin = Admin::where('email', $email)->first();

        if ($existingAdmin && ! $this->confirm('This admin already exists. Update its name and password?')) {
            $this->info('No changes made.');

            return self::SUCCESS;
        }

        $password = (string) $this->secret('Password (minimum 12 characters)');
        $confirmation = (string) $this->secret('Confirm password');

        $credentials = Validator::make([
            'password' => $password,
            'password_confirmation' => $confirmation,
        ], [
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        if ($credentials->fails()) {
            foreach ($credentials->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        Admin::updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => $password],
        );

        $this->info($existingAdmin ? 'Admin updated.' : 'Admin created.');

        return self::SUCCESS;
    }
}
