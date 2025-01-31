<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        // Sitio principal
        Site::create([
            'name' => json_encode([
                'es' => 'Sitio Principal',
                'en' => 'Main Site'
            ]),
            'domain' => '',
            'description' => json_encode([
                'es' => 'Sitio principal de la plataforma',
                'en' => 'Main platform site'
            ]),
            'is_main' => true,
            'is_active' => true
        ]);

        // Sitio de prueba
        Site::create([
            'name' => json_encode([
                'es' => 'Show de Prueba',
                'en' => 'Test Show'
            ]),
            'domain' => 'show',
            'description' => json_encode([
                'es' => 'Show de prueba para desarrollo',
                'en' => 'Test show for development'
            ]),
            'is_main' => false,
            'is_active' => true
        ]);
    }
}
