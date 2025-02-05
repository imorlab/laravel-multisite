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
            if ($site->is_main) {
                // Página principal para Beon Entertainment
                Page::create([
                    'site_id' => $site->id,
                    'title' => json_encode([
                        'es' => 'Bienvenidos a Beon Entertainment',
                        'en' => 'Welcome to Beon Entertainment'
                    ]),
                    'slug' => 'home',
                    'content' => json_encode([
                        'es' => '<h2 class="text-4xl font-bold mb-8">beon. Entertainment<br><span class="text-2xl font-light">la productora de las grandes estrellas</span></h2>

                                <p class="text-xl mb-12">Una vez nos preguntamos que si el cielo era el límite, ¿cómo podían existir las estrellas?</p>

                                <p class="text-lg mb-8">Desde ese momento nuestra misión en el mundo del espectáculo es clara: elegir las mejores historias y hacerlas brillar.</p>

                                <p class="text-lg italic">Y es que cuando algo se produce con pasión y ambición, el resultado son obras que perduran en la memoria.</p>',
                        'en' => '<h2 class="text-4xl font-bold mb-8">beon. Entertainment<br><span class="text-2xl font-light">the producer of great stars</span></h2>

                                <p class="text-xl mb-12">Once we asked ourselves if the sky was the limit, how could stars exist?</p>

                                <p class="text-lg mb-8">From that moment on, our mission in the world of entertainment became clear: to choose the best stories and make them shine.</p>

                                <p class="text-lg italic">Because when something is produced with passion and ambition, the result is works that endure in memory.</p>'
                    ]),
                    'meta_description' => json_encode([
                        'es' => 'Beon Entertainment - Productora líder de espectáculos teatrales en España',
                        'en' => 'Beon Entertainment - Leading theatrical show production company in Spain'
                    ]),
                    'is_published' => true,
                    'order' => 1
                ]);
            } else {
                // Determinar el contenido específico para cada show
                $showContent = $this->getShowContent($site->domain);
                
                Page::create([
                    'site_id' => $site->id,
                    'title' => json_encode([
                        'es' => $showContent['title']['es'],
                        'en' => $showContent['title']['en']
                    ]),
                    'slug' => 'home',
                    'content' => json_encode([
                        'es' => $showContent['content']['es'],
                        'en' => $showContent['content']['en']
                    ]),
                    'meta_description' => json_encode([
                        'es' => $showContent['meta']['es'],
                        'en' => $showContent['meta']['en']
                    ]),
                    'is_published' => true,
                    'order' => 1
                ]);
            }
        }
    }

    private function getShowContent(string $domain): array
    {
        $contents = [
            'lospilaresdelatierramusical.com' => [
                'title' => [
                    'es' => 'Los Pilares de la Tierra - El Musical',
                    'en' => 'The Pillars of the Earth - The Musical'
                ],
                'content' => [
                    'es' => 'Basada en la aclamada novela de Ken Follett, Los Pilares de la Tierra te transporta a la Inglaterra medieval en una épica historia de ambición, amor y perseverancia. Una producción musical sin precedentes que combina una narrativa cautivadora con música original envolvente.',
                    'en' => 'Based on Ken Follett\'s acclaimed novel, The Pillars of the Earth transports you to medieval England in an epic tale of ambition, love, and perseverance. An unprecedented musical production that combines captivating storytelling with immersive original music.'
                ],
                'meta' => [
                    'es' => 'Los Pilares de la Tierra - Un espectacular musical basado en la obra maestra de Ken Follett',
                    'en' => 'The Pillars of the Earth - A spectacular musical based on Ken Follett\'s masterpiece'
                ]
            ],
            'elmedicomusical.com' => [
                'title' => [
                    'es' => 'El Médico - El Musical',
                    'en' => 'The Physician - The Musical'
                ],
                'content' => [
                    'es' => 'Basado en el best-seller internacional de Noah Gordon, El Médico narra el extraordinario viaje de Rob Cole desde Inglaterra hasta Persia en busca del conocimiento médico. Una producción espectacular que combina drama, aventura y romance con una banda sonora inolvidable.',
                    'en' => 'Based on Noah Gordon\'s international bestseller, The Physician tells the extraordinary journey of Rob Cole from England to Persia in search of medical knowledge. A spectacular production that combines drama, adventure, and romance with an unforgettable soundtrack.'
                ],
                'meta' => [
                    'es' => 'El Médico - Una aventura musical épica basada en la novela de Noah Gordon',
                    'en' => 'The Physician - An epic musical adventure based on Noah Gordon\'s novel'
                ]
            ],
            'lahistoriainterminablemusical.com' => [
                'title' => [
                    'es' => 'La Historia Interminable - El Musical',
                    'en' => 'The Neverending Story - The Musical'
                ],
                'content' => [
                    'es' => 'Sumérgete en el mágico mundo de Fantasía con La Historia Interminable, una adaptación musical del clásico de Michael Ende. Una aventura extraordinaria donde la imaginación cobra vida, con efectos visuales espectaculares y melodías que te transportarán a un mundo de fantasía.',
                    'en' => 'Immerse yourself in the magical world of Fantasia with The Neverending Story, a musical adaptation of Michael Ende\'s classic. An extraordinary adventure where imagination comes to life, featuring spectacular visual effects and melodies that will transport you to a world of fantasy.'
                ],
                'meta' => [
                    'es' => 'La Historia Interminable - Un espectacular musical basado en la obra maestra de Michael Ende',
                    'en' => 'The Neverending Story - A spectacular musical based on Michael Ende\'s masterpiece'
                ]
            ]
        ];

        return $contents[$domain] ?? throw new \Exception("Contenido no encontrado para el dominio: {$domain}");
    }
}
