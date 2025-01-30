<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\CreativeTeam;
use App\Models\News;
use App\Models\Page;
use App\Models\Site;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Crear el sitio principal si no existe
        $mainSite = Site::firstOrCreate(
            ['domain' => 'laravel-multisite.test'],
            [
                'name' => json_encode([
                    'es' => 'Beon Entertainment',
                    'en' => 'Beon Entertainment'
                ]),
                'is_active' => true,
                'is_main' => true
            ]
        );

        // Si el sitio ya existía, asegurarse de que sea el principal
        if (!$mainSite->is_main) {
            $mainSite->update(['is_main' => true]);
        }

        // Asegurarse de que ningún otro sitio sea principal
        Site::where('id', '!=', $mainSite->id)->update(['is_main' => false]);

        // Crear un sitio secundario de ejemplo
        $showSite = Site::firstOrCreate(
            ['domain' => 'phantom.laravel-multisite.test'],
            [
                'name' => json_encode([
                    'es' => 'El Fantasma de la Ópera',
                    'en' => 'The Phantom of the Opera'
                ]),
                'is_active' => true,
                'is_main' => false
            ]
        );

        // Contenido para el sitio principal
        $this->createMainSiteContent($mainSite);

        // Contenido para el sitio del show
        $this->createShowSiteContent($showSite);
    }

    private function createMainSiteContent(Site $site): void
    {
        // Página de inicio
        Page::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'Bienvenidos a Beon Entertainment',
                'en' => 'Welcome to Beon Entertainment'
            ]),
            'slug' => 'home-' . $site->id,
            'content' => json_encode([
                'es' => 'Beon Entertainment es una productora líder en el sector del entretenimiento, especializada en la creación y producción de espectáculos teatrales de primer nivel.',
                'en' => 'Beon Entertainment is a leading entertainment production company, specialized in creating and producing top-tier theatrical shows.'
            ]),
            'meta_description' => json_encode([
                'es' => 'Beon Entertainment - Productora líder de espectáculos teatrales',
                'en' => 'Beon Entertainment - Leading theatrical show production company'
            ]),
            'is_published' => true,
            'order' => 1
        ]);

        // Noticias corporativas
        News::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'Nueva temporada de espectáculos anunciada',
                'en' => 'New season of shows announced'
            ]),
            'slug' => 'nueva-temporada-2025-' . $site->id,
            'content' => json_encode([
                'es' => 'Nos complace anunciar nuestra nueva temporada de espectáculos para 2025, incluyendo nuevas producciones y el regreso de favoritos del público.',
                'en' => 'We are pleased to announce our new 2025 season of shows, including new productions and the return of audience favorites.'
            ]),
            'excerpt' => json_encode([
                'es' => 'Descubre los nuevos espectáculos que llegarán en 2025',
                'en' => 'Discover the new shows coming in 2025'
            ]),
            'is_published' => true,
            'published_at' => now()
        ]);

        // Staff corporativo
        Staff::create([
            'site_id' => $site->id,
            'name' => json_encode([
                'es' => 'María González',
                'en' => 'Maria Gonzalez'
            ]),
            'role' => json_encode([
                'es' => 'Directora General',
                'en' => 'General Director'
            ]),
            'bio' => json_encode([
                'es' => 'Con más de 20 años de experiencia en la industria del entretenimiento...',
                'en' => 'With over 20 years of experience in the entertainment industry...'
            ]),
            'slug' => 'maria-gonzalez',
            'is_active' => true,
            'order' => 1
        ]);
    }

    private function createShowSiteContent(Site $site): void
    {
        // Página de inicio del show
        Page::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'El Fantasma de la Ópera',
                'en' => 'The Phantom of the Opera'
            ]),
            'slug' => 'home-' . $site->id,
            'content' => json_encode([
                'es' => 'El musical más exitoso de todos los tiempos llega a España...',
                'en' => 'The most successful musical of all time comes to Spain...'
            ]),
            'meta_description' => json_encode([
                'es' => 'El Fantasma de la Ópera - El musical en Madrid',
                'en' => 'The Phantom of the Opera - The musical in Madrid'
            ]),
            'is_published' => true,
            'order' => 1
        ]);

        // Noticias del show
        News::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'Anuncio del elenco principal',
                'en' => 'Main cast announcement'
            ]),
            'slug' => 'anuncio-elenco-principal-' . $site->id,
            'content' => json_encode([
                'es' => 'Nos complace anunciar el elenco principal de El Fantasma de la Ópera...',
                'en' => 'We are pleased to announce the main cast of The Phantom of the Opera...'
            ]),
            'excerpt' => json_encode([
                'es' => 'Conoce a las estrellas que darán vida a esta historia legendaria',
                'en' => 'Meet the stars who will bring this legendary story to life'
            ]),
            'is_published' => true,
            'published_at' => now()
        ]);

        // Elenco principal
        Cast::create([
            'site_id' => $site->id,
            'name' => 'Carlos Martín',
            'character_name' => json_encode([
                'es' => 'El Fantasma',
                'en' => 'The Phantom'
            ]),
            'bio' => json_encode([
                'es' => 'Carlos Martín ha protagonizado numerosos musicales de éxito...',
                'en' => 'Carlos Martín has starred in numerous successful musicals...'
            ]),
            'is_active' => true,
            'order' => 1
        ]);

        // Equipo creativo
        CreativeTeam::create([
            'site_id' => $site->id,
            'name' => 'Laura Sánchez',
            'role' => json_encode([
                'es' => 'Directora Musical',
                'en' => 'Musical Director'
            ]),
            'bio' => json_encode([
                'es' => 'Con una extensa carrera en la dirección musical...',
                'en' => 'With an extensive career in musical direction...'
            ]),
            'is_active' => true,
            'order' => 1
        ]);
    }
}
