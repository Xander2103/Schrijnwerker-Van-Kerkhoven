<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

/**
 * Intrinsic width/height for images under public/.
 *
 * The curated gallery is a column layout: photos keep their natural aspect
 * ratio, so CSS cannot reserve their height up front. Emitting the real
 * width/height lets the browser reserve the right box and removes the layout
 * shift while the photos load.
 *
 * Reading the file header is cheap but not free, so results are cached
 * permanently — the files are static assets.
 */
class ImageDimensions
{
    /**
     * @return array{width: int, height: int}|null
     */
    public static function for(?string $publicPath): ?array
    {
        if ($publicPath === null || $publicPath === '') {
            return null;
        }

        $relative = ltrim(parse_url($publicPath, PHP_URL_PATH) ?? '', '/');

        return Cache::rememberForever('imgdim:' . $relative, static function () use ($relative): ?array {
            $file = public_path($relative);

            if (!is_file($file)) {
                return null;
            }

            $size = @getimagesize($file);

            if ($size === false || empty($size[0]) || empty($size[1])) {
                return null;
            }

            return ['width' => (int) $size[0], 'height' => (int) $size[1]];
        });
    }

    /**
     * Ready-to-print ` width="..." height="..."`, or an empty string when the
     * dimensions cannot be determined.
     */
    public static function attributes(?string $publicPath): string
    {
        $size = self::for($publicPath);

        return $size === null
            ? ''
            : ' width="' . $size['width'] . '" height="' . $size['height'] . '"';
    }
}
