<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class ProducerController extends Controller
{
    public function index()
    {
        $site = Site::first();
        
        // Lista de staff con datos directos
        $staff = collect([
            [
                'name' => 'Mercedes Rus',
                'role' => 'CFO',
                'photo' => '/img/staff/mercedes-rus.jpg'
            ],
            [
                'name' => 'Genu Domínguez',
                'role' => 'Communication Consultant',
                'photo' => '/img/staff/genu-dominguez.jpg'
            ],
            [
                'name' => 'Daniel Barberá',
                'role' => 'Creative Director',
                'photo' => '/img/staff/daniel-barbera.jpg'
            ],
            [
                'name' => 'Ángeles Rodríguez',
                'role' => 'Project Manager',
                'photo' => '/img/staff/angeles-rodriguez.jpg'
            ],
            [
                'name' => 'Gonzalo Guillén',
                'role' => 'Digital Marketing Manager',
                'photo' => '/img/staff/gonzalo-guillen.jpg'
            ],
            [
                'name' => 'Paz Peño',
                'role' => 'Digital Communication Consultant',
                'photo' => '/img/staff/paz-peno.jpg'
            ],
            [
                'name' => 'Raquel Gago',
                'role' => 'Sales and Business development',
                'photo' => '/img/staff/raquel-gago.jpg'
            ],
            [
                'name' => 'Ana Montes',
                'role' => 'Entertainment Booking Manager',
                'photo' => '/img/staff/ana-montes.jpg'
            ],
            [
                'name' => 'Fran Gómez',
                'role' => 'Web Developer',
                'photo' => '/img/staff/fran-gomez.jpg'
            ],
            [
                'name' => 'Jesús Ortega',
                'role' => 'SEO/SEM Executive',
                'photo' => '/img/staff/jesus-ortega.jpg'
            ],
            [
                'name' => 'Ana M. Porro',
                'role' => 'Creative Producer',
                'photo' => '/img/staff/ana-porro.jpg'
            ],
            [
                'name' => 'María Reyes del Junco',
                'role' => 'Junior Marketing Digital',
                'photo' => '/img/staff/maria-reyes.jpg'
            ],
            [
                'name' => 'Paula Bosch',
                'role' => 'Digital Communication Consultant',
                'photo' => '/img/staff/paula-bosch.jpg'
            ]
        ]);
        
        // Establecer el idioma actual
        $locale = session('locale', config('app.locale', 'es'));
        App::setLocale($locale);
        
        return view('pages.la-productora', compact('site', 'staff'));
    }
}
