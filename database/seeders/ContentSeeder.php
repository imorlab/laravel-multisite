<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Page;
use App\Models\Person;
use App\Models\Show;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Sitio principal (Beon Entertainment)
        $mainSite = Site::create([
            'name' => json_encode([
                'es' => 'Beon Entertainment',
                'en' => 'Beon Entertainment'
            ]),
            'domain' => '', // Dominio vacío para el sitio principal
            'abbreviation' => 'BEON',
            'is_main' => true,
            'is_active' => true
        ]);

        // Sitio secundario (Los Pilares de la Tierra)
        $showSite = Site::create([
            'name' => json_encode([
                'es' => 'Los Pilares de la Tierra',
                'en' => 'The Pillars of the Earth',
            ]),
            'domain' => 'lospilaresdelatierramusical.com',
            'abbreviation' => 'LPDLT',
            'is_active' => true
        ]);

        // Sitio secundario (El Medico)
        $showSite2 = Site::create([
            'name' => json_encode([
                'es' => 'El Medico',
                'en' => 'The Doctor',
            ]),
            'domain' => 'elmedicomusical.com',
            'abbreviation' => 'EM',
            'is_active' => true
        ]);

        // Sitio secundario (La Historia Interminable)
        $showSite3 = Site::create([
            'name' => json_encode([
                'es' => 'La Historia Interminable',
                'en' => 'The Interminable History',
            ]),
            'domain' => 'lahistoriainterminablemusical.com',
            'abbreviation' => 'LHI',
            'is_active' => true
        ]);

        $this->createMainSiteContent($mainSite);
        $this->createShowSiteContent($showSite);
        $this->createShowSiteContent($showSite2);
        $this->createShowSiteContent($showSite3);
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
            'slug' => 'home',
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
            'slug' => 'nueva-temporada-2025',
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
        Person::create([
            'site_id' => $site->id,
            'type' => 'staff',
            'name' => json_encode([
                'es' => 'María González',
                'en' => 'Maria Gonzalez'
            ]),
            'slug' => 'maria-gonzalez',
            'role' => json_encode([
                'es' => 'Directora General',
                'en' => 'General Director'
            ]),
            'bio' => json_encode([
                'es' => 'María González es una profesional con más de 20 años de experiencia en el sector del entretenimiento...',
                'en' => 'Maria Gonzalez is a professional with over 20 years of experience in the entertainment industry...'
            ]),
            'is_active' => true,
            'order' => 1
        ]);

        Person::create([
            'site_id' => $site->id,
            'type' => 'staff',
            'name' => json_encode([
                'es' => 'Juan Pérez',
                'en' => 'Juan Perez'
            ]),
            'slug' => 'juan-perez',
            'role' => json_encode([
                'es' => 'Director de Producción',
                'en' => 'Production Director'
            ]),
            'bio' => json_encode([
                'es' => 'Juan Pérez ha supervisado más de 50 producciones teatrales en los últimos 15 años...',
                'en' => 'Juan Perez has overseen more than 50 theatrical productions in the last 15 years...'
            ]),
            'is_active' => true,
            'order' => 2
        ]);
    }

    private function createShowSiteContent(Site $site): void
    {
        // Página de inicio del show
        $showPage = Page::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'Los Pilares de la Tierra',
                'en' => 'The Pillars of the Earth'
            ]),
            'slug' => 'home',
            'content' => json_encode([
                'es' => 'El musical más exitoso de todos los tiempos llega a España...',
                'en' => 'The most successful musical of all time arrives in Spain...'
            ]),
            'meta_description' => json_encode([
                'es' => 'Los Pilares de la Tierra - El musical más exitoso de todos los tiempos',
                'en' => 'The Pillars of the Earth - The most successful musical of all time'
            ]),
            'is_published' => true,
            'order' => 1
        ]);

        // Noticias del show
        News::create([
            'site_id' => $site->id,
            'title' => json_encode([
                'es' => 'Próximo estreno en Madrid',
                'en' => 'Coming soon to Madrid'
            ]),
            'slug' => 'estreno-en-madrid-2025',
            'content' => json_encode([
                'es' => 'Los Pilares de la Tierra se estrenará en el Teatro Real de Madrid...',
                'en' => 'The Pillars of the Earth will premiere at the Royal Theater in Madrid...'
            ]),
            'excerpt' => json_encode([
                'es' => 'El musical más exitoso llega a Madrid',
                'en' => 'The most successful musical comes to Madrid'
            ]),
            'is_published' => true,
            'published_at' => now()
        ]);

        // Elenco principal
        Person::create([
            'site_id' => $site->id,
            'page_id' => $showPage->id,
            'type' => 'cast',
            'name' => json_encode([
                'es' => 'Carlos Martín',
                'en' => 'Carlos Martin'
            ]),
            'slug' => 'carlos-martin',
            'character_name' => json_encode([
                'es' => 'El Fantasma',
                'en' => 'The Phantom'
            ]),
            'bio' => json_encode([
                'es' => 'Carlos Martín ha protagonizado numerosos musicales de éxito...',
                'en' => 'Carlos Martin has starred in numerous successful musicals...'
            ]),
            'is_active' => true,
            'order' => 1
        ]);

        Person::create([
            'site_id' => $site->id,
            'page_id' => $showPage->id,
            'type' => 'cast',
            'name' => json_encode([
                'es' => 'Ana López',
                'en' => 'Ana Lopez'
            ]),
            'slug' => 'ana-lopez',
            'character_name' => json_encode([
                'es' => 'Christine Daaé',
                'en' => 'Christine Daaé'
            ]),
            'bio' => json_encode([
                'es' => 'Ana López es una de las voces más destacadas del teatro musical español...',
                'en' => 'Ana Lopez is one of the most prominent voices in Spanish musical theater...'
            ]),
            'is_active' => true,
            'order' => 2
        ]);

        // Equipo creativo
        Person::create([
            'site_id' => $site->id,
            'page_id' => $showPage->id,
            'type' => 'creative',
            'name' => json_encode([
                'es' => 'Laura Sánchez',
                'en' => 'Laura Sanchez'
            ]),
            'slug' => 'laura-sanchez',
            'role' => json_encode([
                'es' => 'Directora Musical',
                'en' => 'Musical Director'
            ]),
            'bio' => json_encode([
                'es' => 'Laura Sánchez ha dirigido musicalmente más de 20 producciones internacionales...',
                'en' => 'Laura Sanchez has musically directed more than 20 international productions...'
            ]),
            'is_active' => true,
            'order' => 1
        ]);

        Person::create([
            'site_id' => $site->id,
            'page_id' => $showPage->id,
            'type' => 'creative',
            'name' => json_encode([
                'es' => 'Roberto García',
                'en' => 'Roberto Garcia'
            ]),
            'slug' => 'roberto-garcia',
            'role' => json_encode([
                'es' => 'Director de Escena',
                'en' => 'Stage Director'
            ]),
            'bio' => json_encode([
                'es' => 'Roberto García es reconocido por su innovadora visión en la dirección escénica...',
                'en' => 'Roberto Garcia is recognized for his innovative vision in stage direction...'
            ]),
            'is_active' => true,
            'order' => 2
        ]);
    }
}
