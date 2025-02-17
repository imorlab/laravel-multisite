<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SuperAdminSeeder extends Seeder
{
    /**
     * Credenciales del superadmin por defecto.
     * Estos valores pueden ser sobrescritos usando variables de entorno:
     * - SUPER_ADMIN_NAME
     * - SUPER_ADMIN_EMAIL
     * - SUPER_ADMIN_PASSWORD
     */
    protected array $defaultCredentials = [
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => 'password',
    ];

    /**
     * Crea o actualiza el usuario superadmin.
     * 
     * Este seeder:
     * 1. Crea un usuario superadmin si no existe
     * 2. Actualiza las credenciales si el usuario ya existe
     * 3. Asegura que el usuario tenga los permisos de superadmin
     */
    public function run(): void
    {
        try {
            $credentials = $this->getCredentials();
            
            if (!$this->validateCredentials($credentials)) {
                return;
            }

            $user = User::updateOrCreate(
                ['email' => $credentials['email']],
                [
                    'name' => $credentials['name'],
                    'password' => Hash::make($credentials['password']),
                    'is_superadmin' => true,
                    'email_verified_at' => now(),
                ]
            );

            Log::info('SuperAdmin user processed successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'action' => $user->wasRecentlyCreated ? 'created' : 'updated'
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing SuperAdmin user', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtiene las credenciales del superadmin desde las variables de entorno
     * o usa los valores por defecto.
     */
    protected function getCredentials(): array
    {
        return [
            'name' => env('SUPER_ADMIN_NAME', $this->defaultCredentials['name']),
            'email' => env('SUPER_ADMIN_EMAIL', $this->defaultCredentials['email']),
            'password' => env('SUPER_ADMIN_PASSWORD', $this->defaultCredentials['password']),
        ];
    }

    /**
     * Valida las credenciales del superadmin.
     */
    protected function validateCredentials(array $credentials): bool
    {
        $validator = Validator::make($credentials, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::defaults()],
        ]);

        if ($validator->fails()) {
            Log::error('Invalid SuperAdmin credentials', [
                'errors' => $validator->errors()->toArray()
            ]);
            return false;
        }

        return true;
    }
}
