<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\WelcomeController;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])->group(function () {
    // Cambio de idioma
    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
        ->name('language.switch')
        ->where('locale', 'en|es');

    // Rutas de autenticación
    require __DIR__.'/auth.php';

    // Panel de administración
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('pages', PageController::class)->except('show');
        Route::resource('news', NewsController::class)->except('show');
        Route::resource('people', PersonController::class)->except('show');
    });

    // Página principal
    Route::get('/', [WelcomeController::class, 'index'])->name('site.home');

    // Noticias
    Route::get('/actualidad', [NewsController::class, 'index'])
        ->name('site.actualidad');
        
    Route::get('/news', [NewsController::class, 'index'])
        ->name('site.news');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('site.news.show');

    // Páginas
    Route::get('/pages/{slug}', [PageController::class, 'show'])->name('site.page');

    // La Productora
    Route::get('/la-productora', [ProducerController::class, 'index'])
        ->name('site.la-productora');
        
    Route::get('/the-producer', [ProducerController::class, 'index'])
        ->name('site.the-producer');

    // Personas (staff)
    Route::get('/staff', [PersonController::class, 'index'])
        ->name('site.staff');
    Route::get('/staff/{slug}', [PersonController::class, 'show'])
        ->name('site.staff.show');

    // Personas (people)
    Route::get('/people', [PeopleController::class, 'index'])
        ->name('site.people');

    /*
    |--------------------------------------------------------------------------
    | Rutas para sitios con dominio
    |--------------------------------------------------------------------------
    */
    
    Route::get('/{domain}', [WelcomeController::class, 'index'])->name('site.domain.home');
    
    Route::prefix('{domain}')->group(function () {
        // Noticias
        Route::get('/news', [NewsController::class, 'index'])->name('site.domain.news');
        Route::get('/news/{slug}', [NewsController::class, 'show'])->name('site.domain.news.show');

        // Páginas
        Route::get('/pages/{slug}', [PageController::class, 'show'])->name('site.domain.page');

        // Personas (cast)
        Route::get('/cast', [PersonController::class, 'index'])
            ->name('site.domain.cast');
        Route::get('/cast/{slug}', [PersonController::class, 'show'])
            ->name('site.domain.cast.show');

        // Personas (creative)
        Route::get('/creative-team', [PersonController::class, 'index'])
            ->name('site.domain.creative');
        Route::get('/creative-team/{slug}', [PersonController::class, 'show'])
            ->name('site.domain.creative.show');

        // Personas (staff)
        Route::get('/staff', [PersonController::class, 'index'])
            ->name('site.domain.staff');
        Route::get('/staff/{slug}', [PersonController::class, 'show'])
            ->name('site.domain.staff.show');
    });
   
});
