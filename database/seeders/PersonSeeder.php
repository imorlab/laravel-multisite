<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            if ($site->is_main) {
                // Para el sitio principal, crear solo staff
                $this->createStaffForMainSite($site);
            } else {
                // Para los sitios de shows, crear cast y creative
                $this->createCastForShow($site);
                $this->createCreativeForShow($site);
            }
        }
    }

    private function createStaffForMainSite(Site $site): void
    {
        $staff = [
            [
                'name' => [
                    'es' => 'Carlos Rodríguez',
                    'en' => 'Carlos Rodriguez'
                ],
                'role' => [
                    'es' => 'Director General',
                    'en' => 'General Director'
                ],
                'bio' => [
                    'es' => 'Con más de 20 años de experiencia en la industria del entretenimiento, Carlos ha liderado algunas de las producciones teatrales más exitosas de España. Su visión innovadora y compromiso con la excelencia artística han sido fundamentales en el crecimiento de Beon Entertainment.',
                    'en' => 'With over 20 years of experience in the entertainment industry, Carlos has led some of Spain\'s most successful theatrical productions. His innovative vision and commitment to artistic excellence have been instrumental in Beon Entertainment\'s growth.'
                ]
            ],
            [
                'name' => [
                    'es' => 'Laura Sánchez',
                    'en' => 'Laura Sanchez'
                ],
                'role' => [
                    'es' => 'Directora de Producción',
                    'en' => 'Production Director'
                ],
                'bio' => [
                    'es' => 'Laura aporta su extensa experiencia en gestión de grandes producciones teatrales internacionales. Su capacidad para coordinar equipos multidisciplinares y su atención al detalle garantizan la excelencia en cada producción.',
                    'en' => 'Laura brings her extensive experience in managing large international theatrical productions. Her ability to coordinate multidisciplinary teams and attention to detail ensure excellence in every production.'
                ]
            ],
            [
                'name' => [
                    'es' => 'Miguel Ángel Torres',
                    'en' => 'Miguel Angel Torres'
                ],
                'role' => [
                    'es' => 'Director Artístico',
                    'en' => 'Artistic Director'
                ],
                'bio' => [
                    'es' => 'Reconocido por su creatividad y visión artística única, Miguel Ángel ha sido fundamental en la selección y desarrollo del repertorio de Beon Entertainment. Su profundo conocimiento del teatro musical contemporáneo ha ayudado a definir la identidad artística de la compañía.',
                    'en' => 'Recognized for his creativity and unique artistic vision, Miguel Angel has been instrumental in selecting and developing Beon Entertainment\'s repertoire. His deep knowledge of contemporary musical theater has helped define the company\'s artistic identity.'
                ]
            ]
        ];

        foreach ($staff as $index => $person) {
            Person::create([
                'site_id' => $site->id,
                'type' => 'staff',
                'name' => json_encode($person['name']),
                'role' => json_encode($person['role']),
                'bio' => json_encode($person['bio']),
                'slug' => Str::slug($person['name']['es']),
                'order' => $index + 1,
                'is_active' => true
            ]);
        }
    }

    private function createCastForShow(Site $site): void
    {
        $castContent = $this->getCastContent($site->domain);
        
        foreach ($castContent as $index => $person) {
            Person::create([
                'site_id' => $site->id,
                'type' => 'cast',
                'name' => json_encode($person['name']),
                'role' => json_encode($person['role']),
                'bio' => json_encode($person['bio']),
                'slug' => Str::slug($person['name']['es']),
                'order' => $index + 1,
                'is_active' => true
            ]);
        }
    }

    private function createCreativeForShow(Site $site): void
    {
        $creativeContent = $this->getCreativeContent($site->domain);
        
        foreach ($creativeContent as $index => $person) {
            Person::create([
                'site_id' => $site->id,
                'type' => 'creative',
                'name' => json_encode($person['name']),
                'role' => json_encode($person['role']),
                'bio' => json_encode($person['bio']),
                'slug' => Str::slug($person['name']['es']),
                'order' => $index + 1,
                'is_active' => true
            ]);
        }
    }

    private function getCastContent(string $domain): array
    {
        $cast = [
            'lospilaresdelatierramusical.com' => [
                [
                    'name' => [
                        'es' => 'Daniel Muriel',
                        'en' => 'Daniel Muriel'
                    ],
                    'role' => [
                        'es' => 'Tom Builder',
                        'en' => 'Tom Builder'
                    ],
                    'bio' => [
                        'es' => 'Con una sólida trayectoria en teatro musical, Daniel da vida al complejo personaje de Tom Builder. Su interpretación combina la fuerza dramática con la vulnerabilidad que caracteriza a este icónico personaje.',
                        'en' => 'With a solid background in musical theater, Daniel brings to life the complex character of Tom Builder. His performance combines dramatic strength with the vulnerability that characterizes this iconic character.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Julia García',
                        'en' => 'Julia Garcia'
                    ],
                    'role' => [
                        'es' => 'Ellen',
                        'en' => 'Ellen'
                    ],
                    'bio' => [
                        'es' => 'Julia aporta una intensidad única al personaje de Ellen. Su poderosa voz y presencia escénica capturan perfectamente la fuerza y el misterio del personaje.',
                        'en' => 'Julia brings a unique intensity to the character of Ellen. Her powerful voice and stage presence perfectly capture the strength and mystery of the character.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Javier Navares',
                        'en' => 'Javier Navares'
                    ],
                    'role' => [
                        'es' => 'Philip',
                        'en' => 'Philip'
                    ],
                    'bio' => [
                        'es' => 'Javier brilla en el papel del Prior Philip, aportando profundidad y humanidad a este personaje central de la historia. Su interpretación equilibra perfectamente la devoción religiosa con las luchas internas del personaje.',
                        'en' => 'Javier shines in the role of Prior Philip, bringing depth and humanity to this central character in the story. His performance perfectly balances religious devotion with the character\'s internal struggles.'
                    ]
                ]
            ],
            'elmedicomusical.com' => [
                [
                    'name' => [
                        'es' => 'Adrián Salzedo',
                        'en' => 'Adrian Salzedo'
                    ],
                    'role' => [
                        'es' => 'Rob Cole',
                        'en' => 'Rob Cole'
                    ],
                    'bio' => [
                        'es' => 'Adrián encarna perfectamente la determinación y curiosidad de Rob Cole. Su interpretación captura la evolución del personaje desde un joven aprendiz hasta un médico consumado.',
                        'en' => 'Adrian perfectly embodies Rob Cole\'s determination and curiosity. His performance captures the character\'s evolution from a young apprentice to an accomplished physician.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Sofia Escobar',
                        'en' => 'Sofia Escobar'
                    ],
                    'role' => [
                        'es' => 'Mary Cullen',
                        'en' => 'Mary Cullen'
                    ],
                    'bio' => [
                        'es' => 'Sofia aporta calidez y fuerza al personaje de Mary. Su química en escena y su potente voz añaden una dimensión emotiva crucial a la historia.',
                        'en' => 'Sofia brings warmth and strength to the character of Mary. Her on-stage chemistry and powerful voice add a crucial emotional dimension to the story.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Ricardo Gómez',
                        'en' => 'Ricardo Gomez'
                    ],
                    'role' => [
                        'es' => 'Ibn Sina',
                        'en' => 'Ibn Sina'
                    ],
                    'bio' => [
                        'es' => 'Ricardo da vida al sabio Ibn Sina con una mezcla perfecta de autoridad y humanidad. Su interpretación transmite la sabiduría y el carisma del legendario médico persa.',
                        'en' => 'Ricardo brings the wise Ibn Sina to life with a perfect blend of authority and humanity. His performance conveys the wisdom and charisma of the legendary Persian physician.'
                    ]
                ]
            ],
            'lahistoriainterminablemusical.com' => [
                [
                    'name' => [
                        'es' => 'Pablo Puyol',
                        'en' => 'Pablo Puyol'
                    ],
                    'role' => [
                        'es' => 'Bastian',
                        'en' => 'Bastian'
                    ],
                    'bio' => [
                        'es' => 'Pablo captura perfectamente la inocencia y el crecimiento personal de Bastian. Su interpretación nos hace creer en la magia de Fantasía a través de los ojos de su personaje.',
                        'en' => 'Pablo perfectly captures Bastian\'s innocence and personal growth. His performance makes us believe in the magic of Fantasia through his character\'s eyes.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Diana Roig',
                        'en' => 'Diana Roig'
                    ],
                    'role' => [
                        'es' => 'Emperatriz Infantil',
                        'en' => 'Childlike Empress'
                    ],
                    'bio' => [
                        'es' => 'Diana aporta una presencia etérea y misteriosa a la Emperatriz Infantil. Su interpretación combina la sabiduría ancestral con una juventud eterna.',
                        'en' => 'Diana brings an ethereal and mysterious presence to the Childlike Empress. Her performance combines ancient wisdom with eternal youth.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Carlos Rivera',
                        'en' => 'Carlos Rivera'
                    ],
                    'role' => [
                        'es' => 'Atreyu',
                        'en' => 'Atreyu'
                    ],
                    'bio' => [
                        'es' => 'Carlos da vida al valiente Atreyu con una energía y determinación contagiosas. Su actuación física y emotiva captura perfectamente el espíritu aventurero del personaje.',
                        'en' => 'Carlos brings the brave Atreyu to life with contagious energy and determination. His physical and emotional performance perfectly captures the character\'s adventurous spirit.'
                    ]
                ]
            ]
        ];

        return $cast[$domain] ?? throw new \Exception("Contenido de cast no encontrado para el dominio: {$domain}");
    }

    private function getCreativeContent(string $domain): array
    {
        $creative = [
            'lospilaresdelatierramusical.com' => [
                [
                    'name' => [
                        'es' => 'Federico García',
                        'en' => 'Federico Garcia'
                    ],
                    'role' => [
                        'es' => 'Director',
                        'en' => 'Director'
                    ],
                    'bio' => [
                        'es' => 'Con una visión única para adaptar obras literarias al teatro musical, Federico ha creado una puesta en escena que captura la épica escala de la novela de Follett mientras mantiene la intimidad de las historias personales.',
                        'en' => 'With a unique vision for adapting literary works to musical theater, Federico has created a staging that captures the epic scale of Follett\'s novel while maintaining the intimacy of personal stories.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Carmen Ruiz',
                        'en' => 'Carmen Ruiz'
                    ],
                    'role' => [
                        'es' => 'Diseñadora de Vestuario',
                        'en' => 'Costume Designer'
                    ],
                    'bio' => [
                        'es' => 'El diseño de vestuario de Carmen transporta al público a la Inglaterra medieval con una autenticidad impresionante, combinando investigación histórica con necesidades prácticas del teatro musical.',
                        'en' => 'Carmen\'s costume design transports the audience to medieval England with impressive authenticity, combining historical research with practical musical theater needs.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Alberto Sánchez',
                        'en' => 'Alberto Sanchez'
                    ],
                    'role' => [
                        'es' => 'Compositor',
                        'en' => 'Composer'
                    ],
                    'bio' => [
                        'es' => 'Alberto ha creado una partitura original que mezcla música medieval con sensibilidades contemporáneas, creando un paisaje sonoro único que realza la narrativa.',
                        'en' => 'Alberto has created an original score that blends medieval music with contemporary sensibilities, creating a unique soundscape that enhances the narrative.'
                    ]
                ]
            ],
            'elmedicomusical.com' => [
                [
                    'name' => [
                        'es' => 'Marina López',
                        'en' => 'Marina Lopez'
                    ],
                    'role' => [
                        'es' => 'Directora',
                        'en' => 'Director'
                    ],
                    'bio' => [
                        'es' => 'La visión de Marina fusiona las tradiciones teatrales de Oriente y Occidente, creando un espectáculo que honra ambas culturas mientras cuenta una historia universal.',
                        'en' => 'Marina\'s vision fuses Eastern and Western theatrical traditions, creating a show that honors both cultures while telling a universal story.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Roberto Díaz',
                        'en' => 'Roberto Diaz'
                    ],
                    'role' => [
                        'es' => 'Escenógrafo',
                        'en' => 'Set Designer'
                    ],
                    'bio' => [
                        'es' => 'El diseño escenográfico de Roberto transporta al público desde la Inglaterra medieval hasta la exótica Persia con creatividad y precisión histórica.',
                        'en' => 'Roberto\'s scenic design transports the audience from medieval England to exotic Persia with creativity and historical accuracy.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Isabel Vega',
                        'en' => 'Isabel Vega'
                    ],
                    'role' => [
                        'es' => 'Coreógrafa',
                        'en' => 'Choreographer'
                    ],
                    'bio' => [
                        'es' => 'Isabel ha creado coreografías que integran danzas tradicionales persas con movimientos contemporáneos, añadiendo una dimensión visual única al espectáculo.',
                        'en' => 'Isabel has created choreographies that integrate traditional Persian dances with contemporary movements, adding a unique visual dimension to the show.'
                    ]
                ]
            ],
            'lahistoriainterminablemusical.com' => [
                [
                    'name' => [
                        'es' => 'David Martín',
                        'en' => 'David Martin'
                    ],
                    'role' => [
                        'es' => 'Director',
                        'en' => 'Director'
                    ],
                    'bio' => [
                        'es' => 'La innovadora dirección de David combina tecnología de vanguardia con narración tradicional para dar vida al mundo mágico de Fantasía.',
                        'en' => 'David\'s innovative direction combines cutting-edge technology with traditional storytelling to bring the magical world of Fantasia to life.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Lucía Fernández',
                        'en' => 'Lucia Fernandez'
                    ],
                    'role' => [
                        'es' => 'Diseñadora de Efectos Visuales',
                        'en' => 'Visual Effects Designer'
                    ],
                    'bio' => [
                        'es' => 'Lucía ha creado un mundo visual deslumbrante utilizando proyecciones mapping y efectos especiales para dar vida a las criaturas y paisajes de Fantasía.',
                        'en' => 'Lucia has created a stunning visual world using mapping projections and special effects to bring Fantasia\'s creatures and landscapes to life.'
                    ]
                ],
                [
                    'name' => [
                        'es' => 'Javier Moreno',
                        'en' => 'Javier Moreno'
                    ],
                    'role' => [
                        'es' => 'Diseñador de Títeres',
                        'en' => 'Puppet Designer'
                    ],
                    'bio' => [
                        'es' => 'Las creaciones de Javier, especialmente Falkor y otras criaturas fantásticas, combinan artesanía tradicional con mecanismos innovadores.',
                        'en' => 'Javier\'s creations, especially Falkor and other fantastic creatures, combine traditional craftsmanship with innovative mechanisms.'
                    ]
                ]
            ]
        ];

        return $creative[$domain] ?? throw new \Exception("Contenido de creative no encontrado para el dominio: {$domain}");
    }
}
