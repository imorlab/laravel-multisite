<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Site;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            // Noticia 1
            News::create([
                'site_id' => $site->id,
                'title' => json_encode([
                    'es' => 'Primera Noticia',
                    'en' => 'First News'
                ]),
                'content' => json_encode([
                    'es' => '<p>Contenido de la primera noticia...</p>',
                    'en' => '<p>Content of the first news...</p>'
                ]),
                'excerpt' => json_encode([
                    'es' => 'Extracto de la primera noticia...',
                    'en' => 'Excerpt of the first news...'
                ]),
                'slug' => 'first-news',
                'is_active' => true
            ]);

            // Noticia 2
            News::create([
                'site_id' => $site->id,
                'title' => json_encode([
                    'es' => 'Segunda Noticia',
                    'en' => 'Second News'
                ]),
                'content' => json_encode([
                    'es' => '<p>Contenido de la segunda noticia...</p>',
                    'en' => '<p>Content of the second news...</p>'
                ]),
                'excerpt' => json_encode([
                    'es' => 'Extracto de la segunda noticia...',
                    'en' => 'Excerpt of the second news...'
                ]),
                'slug' => 'second-news',
                'is_active' => true
            ]);
        }
    }
}
