<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class RouteHelper
{
    public static function localizedRoute($name, $parameters = [], $absolute = true)
    {
        $locale = App::getLocale();
        
        // Añadir el locale a los parámetros si no está presente
        if (!isset($parameters['locale'])) {
            $parameters['locale'] = $locale;
        }

        return route($name, $parameters, $absolute);
    }
}
