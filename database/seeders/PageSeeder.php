<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            // Página de inicio
            Page::create([
                'site_id' => $site->id,
                'title' => json_encode([
                    'es' => 'Inicio',
                    'en' => 'Home'
                ]),
                'content' => json_encode([
                    'es' => '<h1>Bienvenido a nuestro sitio</h1><p>Este es el contenido de prueba...</p>',
                    'en' => '<h1>Welcome to our site</h1><p>This is test content...</p>'
                ]),
                'slug' => 'home',
                'is_active' => true
            ]);

            // Página Sobre Nosotros
            Page::create([
                'site_id' => $site->id,
                'title' => json_encode([
                    'es' => 'Sobre Nosotros',
                    'en' => 'About Us'
                ]),
                'content' => json_encode([
                    'es' => '<h1>Sobre Nosotros</h1><p>Conoce más sobre nuestro equipo...</p>',
                    'en' => '<h1>About Us</h1><p>Learn more about our team...</p>'
                ]),
                'slug' => 'about',
                'is_active' => true
            ]);
        }
    }
}
