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
        $siteFolder = strtoupper($this->abbreviation);
        
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

    /**
     * Check if a site image exists
     * @param string $imageName The name of the image file (e.g., 'background.jpg')
     * @return bool Whether the image exists
     */
    public function hasImage(string $imageName): bool
    {
        $siteFolder = strtoupper($this->abbreviation);
        $imagePath = public_path("sites\\{$siteFolder}\\{$imageName}");
        return file_exists($imagePath);
    }
}
