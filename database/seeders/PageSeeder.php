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
                        'es' => 'Bienvenidos a <br> beon. Entertainment',
                        'en' => 'Welcome to <br> beon. Entertainment'
                    ]),
                    'slug' => 'home',
                    'content' => json_encode([
                        'es' => [
                            'title' => 'beon. Entertainment',
                            'subtitle' => 'la productora de las grandes estrellas',
                            'intro' => 'Una vez nos preguntamos que si el cielo era el límite, ¿cómo podían existir las estrellas?',
                            'mission' => 'Desde ese momento nuestra misión en el mundo del espectáculo es clara: elegir las mejores historias y hacerlas brillar.',
                            'closing' => 'Y es que cuando algo se produce con pasión y ambición, el resultado son obras que perduran en la memoria.'
                        ],
                        'en' => [
                            'title' => 'beon. Entertainment',
                            'subtitle' => 'the producer of great stars',
                            'intro' => 'Once we asked ourselves if the sky was the limit, how could stars exist?',
                            'mission' => 'From that moment on, our mission in the world of entertainment became clear: to choose the best stories and make them shine.',
                            'closing' => 'Because when something is produced with passion and ambition, the result is works that endure in memory.'
                        ]
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
                        'es' => [
                            'title' => $showContent['content']['es']['title'],
                            'subtitle' => $showContent['content']['es']['subtitle'],
                            'intro' => $showContent['content']['es']['intro'],
                            'mission' => $showContent['content']['es']['mission'],
                            'closing' => $showContent['content']['es']['closing']
                        ],
                        'en' => [
                            'title' => $showContent['content']['en']['title'],
                            'subtitle' => $showContent['content']['en']['subtitle'],
                            'intro' => $showContent['content']['en']['intro'],
                            'mission' => $showContent['content']['en']['mission'],
                            'closing' => $showContent['content']['en']['closing']
                        ]
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
                    'es' => [
                        'title' => 'Los Pilares de la Tierra',
                        'subtitle' => 'El Musical',
                        'intro' => 'Basada en la aclamada novela de Ken Follett, Los Pilares de la Tierra te transporta a la Inglaterra medieval en una épica historia de ambición, amor y perseverancia.',
                        'mission' => 'Una producción musical sin precedentes que combina una narrativa cautivadora con música original envolvente.',
                        'closing' => 'Una experiencia inolvidable que te dejará sin aliento.'
                    ],
                    'en' => [
                        'title' => 'The Pillars of the Earth',
                        'subtitle' => 'The Musical',
                        'intro' => 'Based on Ken Follett\'s acclaimed novel, The Pillars of the Earth transports you to medieval England in an epic tale of ambition, love, and perseverance.',
                        'mission' => 'An unprecedented musical production that combines captivating storytelling with immersive original music.',
                        'closing' => 'An unforgettable experience that will leave you breathless.'
                    ]
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
                    'es' => [
                        'title' => 'El Médico',
                        'subtitle' => 'El Musical',
                        'intro' => 'Basado en el best-seller internacional de Noah Gordon, El Médico narra el extraordinario viaje de Rob Cole desde Inglaterra hasta Persia en busca del conocimiento médico.',
                        'mission' => 'Una producción espectacular que combina drama, aventura y romance con una banda sonora inolvidable.',
                        'closing' => 'Una experiencia emocionante que te llevará a un mundo de pasión y descubrimiento.'
                    ],
                    'en' => [
                        'title' => 'The Physician',
                        'subtitle' => 'The Musical',
                        'intro' => 'Based on Noah Gordon\'s international bestseller, The Physician tells the extraordinary journey of Rob Cole from England to Persia in search of medical knowledge.',
                        'mission' => 'A spectacular production that combines drama, adventure, and romance with an unforgettable soundtrack.',
                        'closing' => 'An exciting experience that will take you to a world of passion and discovery.'
                    ]
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
                    'es' => [
                        'title' => 'La Historia Interminable',
                        'subtitle' => 'El Musical',
                        'intro' => 'Sumérgete en el mágico mundo de Fantasía con La Historia Interminable, una adaptación musical del clásico de Michael Ende.',
                        'mission' => 'Una aventura extraordinaria donde la imaginación cobra vida, con efectos visuales espectaculares y melodías que te transportarán a un mundo de fantasía.',
                        'closing' => 'Una experiencia mágica que te dejará sin aliento.'
                    ],
                    'en' => [
                        'title' => 'The Neverending Story',
                        'subtitle' => 'The Musical',
                        'intro' => 'Immerse yourself in the magical world of Fantasia with The Neverending Story, a musical adaptation of Michael Ende\'s classic.',
                        'mission' => 'An extraordinary adventure where imagination comes to life, featuring spectacular visual effects and melodies that will transport you to a world of fantasy.',
                        'closing' => 'A magical experience that will leave you breathless.'
                    ]
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
