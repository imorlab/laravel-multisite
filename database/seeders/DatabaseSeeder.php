<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            SiteSeeder::class,      // Primero creamos los sitios
            PageSeeder::class,      // Luego las páginas principales de cada sitio
            NewsSeeder::class,      // Después las noticias para cada sitio
            PersonSeeder::class,    // Finalmente las personas (staff, cast, creative) según el tipo de sitio
        ]);
    }
}
