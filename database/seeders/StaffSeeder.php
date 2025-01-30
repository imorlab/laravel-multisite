<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $sites = Site::where('is_main', false)->get();

        foreach ($sites as $site) {
            // Director
            Staff::create([
                'site_id' => $site->id,
                'name' => json_encode([
                    'es' => 'María González',
                    'en' => 'Maria Gonzalez'
                ]),
                'role' => json_encode([
                    'es' => 'Directora',
                    'en' => 'Director'
                ]),
                'bio' => json_encode([
                    'es' => 'Con más de 15 años de experiencia en teatro musical...',
                    'en' => 'With over 15 years of experience in musical theater...'
                ]),
                'slug' => 'maria-gonzalez',
                'order' => 1,
                'is_active' => true
            ]);

            // Coreógrafo
            Staff::create([
                'site_id' => $site->id,
                'name' => json_encode([
                    'es' => 'Juan Martínez',
                    'en' => 'John Martinez'
                ]),
                'role' => json_encode([
                    'es' => 'Coreógrafo Principal',
                    'en' => 'Lead Choreographer'
                ]),
                'bio' => json_encode([
                    'es' => 'Especializado en danza contemporánea y clásica...',
                    'en' => 'Specialized in contemporary and classical dance...'
                ]),
                'slug' => 'juan-martinez',
                'order' => 2,
                'is_active' => true
            ]);

            // Director Musical
            Staff::create([
                'site_id' => $site->id,
                'name' => json_encode([
                    'es' => 'Ana Pérez',
                    'en' => 'Ana Perez'
                ]),
                'role' => json_encode([
                    'es' => 'Directora Musical',
                    'en' => 'Musical Director'
                ]),
                'bio' => json_encode([
                    'es' => 'Graduada del Conservatorio Real de Madrid...',
                    'en' => 'Graduate from the Royal Conservatory of Madrid...'
                ]),
                'slug' => 'ana-perez',
                'order' => 3,
                'is_active' => true
            ]);
        }
    }
}
