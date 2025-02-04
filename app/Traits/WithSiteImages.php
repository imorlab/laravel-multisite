<?php

namespace App\Traits;

trait WithSiteImages
{
    /**
     * Get the site's image path
     * @param string $imageName The name of the image file (e.g., 'background.jpg')
     * @return string The full asset path to the image
     */
    public function getSiteImage(string $imageName): string
    {
        // Get site identifier from abbreviation
        $siteFolder = $this->abbreviation;
        
        return asset("sites/{$siteFolder}/{$imageName}");
    }

    /**
     * Get all required site images
     * @return array Array of image paths
     */
    public function getSiteImages(): array
    {
        return [
            'background' => $this->getSiteImage('background.jpg'),
            'logo' => $this->getSiteImage('logo.png'),
            'vidriera' => $this->getSiteImage('vidriera.png'),
            'boton' => $this->getSiteImage('boton.png'),
        ];
    }
}
