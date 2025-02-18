<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsController as NewsControllerOriginal;
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

    // Panel de SuperAdmin
    Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
        Route::resource('sites', SiteController::class);
        Route::resource('users', UserController::class);
        
        // Gestión de contenido global
        Route::prefix('content')->group(function () {
            Route::resource('pages', PageController::class)->except('show');
            Route::resource('news', NewsControllerOriginal::class)->except('show');
            Route::resource('people', PersonController::class)->except('show');
        });
    });

    // Panel de administración
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('pages', PageController::class)->except('show');
        Route::resource('news', NewsController::class)->except('show');
        Route::post('news/translate', [NewsController::class, 'translate'])->name('news.translate');
        Route::resource('people', PersonController::class)->except('show');
    });

    // Página principal
    Route::get('/', [WelcomeController::class, 'index'])->name('site.home');

    // Noticias
    Route::get('/actualidad', [NewsControllerOriginal::class, 'index'])
        ->name('site.actualidad');

    Route::get('/actualidad/{slug}', [NewsControllerOriginal::class, 'show'])
        ->name('site.actualidad.show')
        ->where('slug', '[a-z0-9-]+');
        
    Route::get('/news', [NewsControllerOriginal::class, 'index'])
        ->name('site.news');

    Route::get('/news/{slug}', [NewsControllerOriginal::class, 'show'])
        ->name('site.news.show')
        ->where('slug', '[a-z0-9-]+');

    // Páginas
    Route::get('/pages/{slug}', [PageController::class, 'show'])
        ->name('site.page');

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
        Route::get('/news', [NewsControllerOriginal::class, 'index'])->name('site.domain.news');
        Route::get('/news/{slug}', [NewsControllerOriginal::class, 'show'])->name('site.domain.news.show');

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
