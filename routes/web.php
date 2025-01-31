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

    // Rutas de administración
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('pages', PageController::class)->except('show');
        Route::resource('news', NewsController::class)->except('show');
        Route::resource('staff', StaffController::class)->except('show');
        Route::resource('cast', CastController::class);
        Route::resource('creative-team', CreativeTeamController::class);
    });

    // Rutas públicas
    // Primero las rutas con secciones específicas
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('site.news.show');
    Route::get('/news', [NewsController::class, 'index'])->name('site.news');
    Route::get('/staff/{slug}', [StaffController::class, 'show'])->name('site.staff.show');
    Route::get('/staff', [StaffController::class, 'index'])->name('site.staff');
    Route::get('/pages/{slug}', [PageController::class, 'show'])->name('site.page');
    Route::get('/cast', [CastController::class, 'index'])->name('site.cast');
    Route::get('/creative-team', [CreativeTeamController::class, 'index'])->name('site.creative-team');
    
    // Rutas con dominio
    Route::get('/{domain}/news/{slug}', [NewsController::class, 'show'])
        ->name('site.domain.news.show')
        ->where('domain', '^(?!news|staff|pages|cast|creative-team).*$');
    Route::get('/{domain}/news', [NewsController::class, 'index'])
        ->name('site.domain.news');
    Route::get('/{domain}/staff/{slug}', [StaffController::class, 'show'])
        ->name('site.domain.staff.show');
    Route::get('/{domain}/staff', [StaffController::class, 'index'])
        ->name('site.domain.staff');
    Route::get('/{domain}/pages/{slug}', [PageController::class, 'show'])
        ->name('site.domain.page');
    Route::get('/{domain}/cast', [CastController::class, 'index'])
        ->name('site.domain.cast');
    Route::get('/{domain}/creative-team', [CreativeTeamController::class, 'index'])
        ->name('site.domain.creative-team');
    
    // La ruta más genérica va al final
    Route::get('/', [WelcomeController::class, 'index'])->name('site.home');
    Route::get('/{domain}', [WelcomeController::class, 'index'])
        ->name('site.domain.home')
        ->where('domain', '^(?!news|staff|pages|cast|creative-team).*$');
});
