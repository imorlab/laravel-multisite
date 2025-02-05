<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
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
    }
}
