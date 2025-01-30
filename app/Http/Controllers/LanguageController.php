<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['es', 'en'])) {
            return back();
        }

        Log::info('Switching language', [
            'from' => session('locale'),
            'to' => $locale
        ]);

        session(['locale' => $locale]);
        App::setLocale($locale);

        return back();
    }
}
