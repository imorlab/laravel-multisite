<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\CreativeTeamController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Todas las rutas dentro del middleware web
Route::middleware('web')->group(function () {
    // Language switch
    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
        ->name('language.switch')
        ->where('locale', 'en|es');

    // Authentication Routes
    require __DIR__.'/auth.php';

    // Ruta principal (sitio principal)
    Route::get('/', [WelcomeController::class, 'index'])->name('home');

    // Rutas del sitio principal
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

    // Rutas para sitios específicos
    Route::prefix('{domain}')->group(function () {
        Route::get('/', [WelcomeController::class, 'index'])->name('site.home');
        
        // Rutas públicas
        Route::get('/news', [NewsController::class, 'index'])->name('site.news');
        Route::get('/news/{slug}', [NewsController::class, 'show'])->name('site.news.show');
        Route::get('/cast', [CastController::class, 'index'])->name('site.cast');
        Route::get('/creative-team', [CreativeTeamController::class, 'index'])->name('site.creative-team');
        Route::get('/staff', [StaffController::class, 'index'])->name('site.staff');
        Route::get('/staff/{slug}', [StaffController::class, 'show'])
            ->name('site.staff.show')
            ->where('slug', '[a-z0-9\-]+');
        Route::get('/pages/{slug}', [PageController::class, 'show'])->name('site.page');

        // Rutas de administración
        Route::middleware(['auth'])->prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::resource('pages', PageController::class)->except('show');
            Route::resource('news', NewsController::class)->except('show');
            Route::resource('cast', CastController::class)->except('show');
            Route::resource('creative-team', CreativeTeamController::class)->except('show');
            Route::resource('staff', StaffController::class)->except('show');
        });
    });
});
