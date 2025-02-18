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
            $newsContent = $this->getNewsContent($site);
            
            foreach ($newsContent as $index => $news) {
                News::create([
                    'site_id' => $site->id,
                    'title' => json_encode($news['title']),
                    'content' => json_encode($news['content']),
                    'excerpt' => json_encode($news['excerpt']),
                    'slug' => json_encode($news['slug']),
                    'is_published' => true,
                    'published_at' => now()->subDays($index * 2) // Cada noticia publicada con 2 días de diferencia
                ]);
            }
        }
    }

    private function getNewsContent(Site $site): array
    {
        if ($site->is_main) {
            return [
                [
                    'title' => [
                        'es' => 'Beon Entertainment anuncia nueva temporada teatral',
                        'en' => 'Beon Entertainment announces new theatrical season'
                    ],
                    'content' => [
                        'es' => '<p>Beon Entertainment se enorgullece en anunciar su nueva temporada teatral 2025-2026, que incluye tres espectaculares producciones: Los Pilares de la Tierra, El Médico y La Historia Interminable. Esta temporada promete ser la más ambiciosa hasta la fecha, con producciones que establecerán nuevos estándares en el teatro musical español.</p>',
                        'en' => '<p>Beon Entertainment is proud to announce its new 2025-2026 theatrical season, featuring three spectacular productions: The Pillars of the Earth, The Physician, and The Neverending Story. This season promises to be the most ambitious to date, with productions that will set new standards in Spanish musical theater.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Descubre los emocionantes musicales que llegarán esta temporada',
                        'en' => 'Discover the exciting musicals coming this season'
                    ],
                    'slug' => [
                        'es' => 'nueva-temporada-teatral-2025',
                        'en' => 'new-theatrical-season-2025'
                    ]
                ],
                [
                    'title' => [
                        'es' => 'Éxito de ventas anticipadas para todos nuestros shows',
                        'en' => 'Pre-sale success for all our shows'
                    ],
                    'content' => [
                        'es' => '<p>Las ventas anticipadas para nuestros tres espectáculos han superado todas las expectativas. La respuesta del público ha sido abrumadora, con más de 100,000 entradas vendidas en la primera semana. Este éxito demuestra la gran anticipación por ver estas adaptaciones de obras literarias mundialmente aclamadas.</p>',
                        'en' => '<p>Pre-sales for our three shows have exceeded all expectations. The public response has been overwhelming, with over 100,000 tickets sold in the first week. This success demonstrates the great anticipation to see these adaptations of world-acclaimed literary works.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Record de ventas anticipadas para la nueva temporada',
                        'en' => 'Record pre-sales for the new season'
                    ],
                    'slug' => [
                        'es' => 'exito-ventas-anticipadas',
                        'en' => 'record-pre-sales'
                    ]
                ],
                [
                    'title' => [
                        'es' => 'Beon Entertainment expande su presencia internacional',
                        'en' => 'Beon Entertainment expands international presence'
                    ],
                    'content' => [
                        'es' => '<p>Como parte de nuestra estrategia de crecimiento global, Beon Entertainment ha establecido nuevas alianzas con productoras teatrales en Londres, Nueva York y Berlín. Estas colaboraciones nos permitirán llevar nuestras producciones a nuevos mercados y compartir el talento español con audiencias internacionales.</p>',
                        'en' => '<p>As part of our global growth strategy, Beon Entertainment has established new partnerships with theater producers in London, New York, and Berlin. These collaborations will allow us to bring our productions to new markets and share Spanish talent with international audiences.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Nuevas alianzas internacionales para expandir nuestro alcance',
                        'en' => 'New international partnerships to expand our reach'
                    ],
                    'slug' => [
                        'es' => 'expansion-internacional',
                        'en' => 'international-expansion'
                    ]
                ]
            ];
        }

        // Contenido específico para cada show basado en el dominio
        $showNews = [
            'lospilaresdelatierramusical.com' => [
                [
                    'title' => [
                        'es' => 'Ken Follett visitará el estreno en Madrid',
                        'en' => 'Ken Follett to attend Madrid premiere'
                    ],
                    'content' => [
                        'es' => '<p>El aclamado autor Ken Follett ha confirmado su asistencia al estreno de la adaptación musical de Los Pilares de la Tierra en Madrid. El escritor participará en varios eventos especiales durante la semana del estreno.</p>',
                        'en' => '<p>Acclaimed author Ken Follett has confirmed his attendance at the Madrid premiere of The Pillars of the Earth musical adaptation. The writer will participate in several special events during premiere week.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'El autor de la novela original estará presente en el estreno',
                        'en' => 'The original novel\'s author will attend the premiere'
                    ],
                    'slug' => 'ken-follett-visitara-estreno'
                ],
                [
                    'title' => [
                        'es' => 'Revelado el elenco principal del musical',
                        'en' => 'Main cast of the musical revealed'
                    ],
                    'content' => [
                        'es' => '<p>Después de un extenso proceso de audiciones, nos complace anunciar el elenco principal que dará vida a los icónicos personajes de Los Pilares de la Tierra. Un grupo de talentosos artistas que combina experiencia y nuevos talentos.</p>',
                        'en' => '<p>After an extensive audition process, we are pleased to announce the main cast that will bring to life the iconic characters of The Pillars of the Earth. A group of talented artists combining experience and new talents.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Conoce a los actores que darán vida a esta historia épica',
                        'en' => 'Meet the actors who will bring this epic story to life'
                    ],
                    'slug' => 'elenco-principal-revelado'
                ],
                [
                    'title' => [
                        'es' => 'La música original cautiva en preview exclusivo',
                        'en' => 'Original music captivates in exclusive preview'
                    ],
                    'content' => [
                        'es' => '<p>En un evento exclusivo, se presentaron las primeras canciones del musical Los Pilares de la Tierra. La banda sonora original, que mezcla música medieval con sonidos contemporáneos, ha recibido elogios unánimes de los asistentes.</p>',
                        'en' => '<p>In an exclusive event, the first songs from The Pillars of the Earth musical were presented. The original soundtrack, which blends medieval music with contemporary sounds, has received unanimous praise from attendees.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Las primeras canciones del musical impresionan al público',
                        'en' => 'First musical songs impress audiences'
                    ],
                    'slug' => 'preview-musica-original'
                ]
            ],
            'elmedicomusical.com' => [
                [
                    'title' => [
                        'es' => 'El Médico revela su espectacular escenografía',
                        'en' => 'The Physician reveals spectacular set design'
                    ],
                    'content' => [
                        'es' => '<p>La producción ha revelado los primeros bocetos y maquetas de la impresionante escenografía que transportará al público desde la Inglaterra medieval hasta la exótica Persia. Un diseño que promete ser una obra maestra visual.</p>',
                        'en' => '<p>The production has revealed the first sketches and models of the impressive set design that will transport audiences from medieval England to exotic Persia. A design that promises to be a visual masterpiece.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Un vistazo a la impresionante puesta en escena',
                        'en' => 'A look at the impressive staging'
                    ],
                    'slug' => 'revelacion-escenografia'
                ],
                [
                    'title' => [
                        'es' => 'Compositores internacionales se unen al proyecto',
                        'en' => 'International composers join the project'
                    ],
                    'content' => [
                        'es' => '<p>Un equipo de reconocidos compositores de Broadway y West End se ha unido para crear la banda sonora original de El Médico, fusionando música medieval europea con auténticos sonidos persas.</p>',
                        'en' => '<p>A team of renowned Broadway and West End composers has joined forces to create The Physician\'s original soundtrack, fusing medieval European music with authentic Persian sounds.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'La música fusionará sonidos de Oriente y Occidente',
                        'en' => 'The music will fuse Eastern and Western sounds'
                    ],
                    'slug' => 'compositores-internacionales'
                ],
                [
                    'title' => [
                        'es' => 'Noah Gordon elogia la adaptación musical',
                        'en' => 'Noah Gordon praises musical adaptation'
                    ],
                    'content' => [
                        'es' => '<p>El autor de la novela original, Noah Gordon, ha expresado su entusiasmo por la adaptación musical después de presenciar un ensayo privado. "Han capturado perfectamente la esencia de la historia", declaró.</p>',
                        'en' => '<p>The original novel\'s author, Noah Gordon, has expressed his enthusiasm for the musical adaptation after witnessing a private rehearsal. "They have perfectly captured the essence of the story," he stated.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'El autor original da su bendición al proyecto',
                        'en' => 'Original author gives his blessing to the project'
                    ],
                    'slug' => 'noah-gordon-elogia-adaptacion'
                ]
            ],
            'lahistoriainterminablemusical.com' => [
                [
                    'title' => [
                        'es' => 'Tecnología pionera para dar vida a Fantasía',
                        'en' => 'Pioneering technology brings Fantasia to life'
                    ],
                    'content' => [
                        'es' => '<p>La Historia Interminable utilizará tecnología de proyección mapping y efectos especiales de última generación para crear el mundo mágico de Fantasía. Una combinación única de efectos visuales y artesanía teatral tradicional.</p>',
                        'en' => '<p>The Neverending Story will use state-of-the-art mapping projection technology and special effects to create the magical world of Fantasia. A unique combination of visual effects and traditional theatrical craftsmanship.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Innovadora tecnología para crear mundos mágicos',
                        'en' => 'Innovative technology to create magical worlds'
                    ],
                    'slug' => 'tecnologia-pionera-fantasia'
                ],
                [
                    'title' => [
                        'es' => 'Falkor cobra vida en el escenario',
                        'en' => 'Falkor comes to life on stage'
                    ],
                    'content' => [
                        'es' => '<p>El equipo de diseño ha revelado cómo el dragón de la suerte, Falkor, cobrará vida en el escenario mediante una combinación de marionetas a gran escala y efectos digitales, prometiendo una experiencia mágica e inolvidable.</p>',
                        'en' => '<p>The design team has revealed how the luck dragon, Falkor, will come to life on stage through a combination of large-scale puppetry and digital effects, promising a magical and unforgettable experience.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'El dragón de la suerte sorprenderá al público',
                        'en' => 'The luck dragon will amaze audiences'
                    ],
                    'slug' => 'falkor-cobra-vida'
                ],
                [
                    'title' => [
                        'es' => 'Estreno mundial de nuevas canciones',
                        'en' => 'World premiere of new songs'
                    ],
                    'content' => [
                        'es' => '<p>En un evento especial, se presentaron cinco nuevas canciones del musical, incluyendo el tema principal "Fantasía Vive en Ti". La banda sonora promete capturar la magia y la aventura de la historia original.</p>',
                        'en' => '<p>In a special event, five new songs from the musical were presented, including the main theme "Fantasia Lives in You". The soundtrack promises to capture the magic and adventure of the original story.</p>'
                    ],
                    'excerpt' => [
                        'es' => 'Las nuevas canciones prometen emocionar al público',
                        'en' => 'New songs promise to thrill audiences'
                    ],
                    'slug' => 'estreno-nuevas-canciones'
                ]
            ]
        ];

        return $showNews[$site->domain] ?? throw new \Exception("Contenido de noticias no encontrado para el dominio: {$site->domain}");
    }
}
