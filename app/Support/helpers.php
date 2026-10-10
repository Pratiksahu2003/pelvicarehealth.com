<?php

use App\Support\MediaUrl;

if (! function_exists('media_url')) {
    /**
     * Public URL for an uploaded or static public file path.
     */
    function media_url(?string $path): ?string
    {
        return MediaUrl::url($path);
    }
}
