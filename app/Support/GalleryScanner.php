<?php

namespace App\Support;

class GalleryScanner
{
    /**
     * Scan a gallery subfolder under public/assets/client/images and
     * return web-usable paths to its image files, naturally sorted.
     *
     * @param  string|null  $folder  e.g. 'atelier', 'ramen', 'deuren', 'trap'.
     *                                Defaults to 'gallerij' when null.
     * @return array<int, string>
     */
    public static function scan(?string $folder = null): array
    {
        $folder  = $folder ?? 'gallerij';
        $dir     = public_path('assets/client/images/' . $folder);
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
        $images  = [];

        if (!is_dir($dir)) {
            return $images;
        }

        $files = array_values(array_filter(scandir($dir), function ($file) use ($dir, $allowed) {
            return is_file($dir . DIRECTORY_SEPARATOR . $file)
                && in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $allowed, true);
        }));

        natsort($files);

        foreach ($files as $file) {
            $images[] = 'assets/client/images/' . $folder . '/' . $file;
        }

        return $images;
    }
}
