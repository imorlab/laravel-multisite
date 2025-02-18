<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create a super admin user';

    public function handle()
    {
        $this->info('Creating super admin user...');

        try {
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_superadmin' => true,
                'email_verified_at' => now(),
            ]);

            $this->info('Super admin created successfully!');
            $this->table(
                ['Name', 'Email', 'Is Super Admin'],
                [[$user->name, $user->email, $user->is_superadmin ? 'Yes' : 'No']]
            );
        } catch (\Exception $e) {
            $this->error('Error creating super admin: ' . $e->getMessage());
        }
    }
}
