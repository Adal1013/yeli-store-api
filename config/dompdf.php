<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paper Size
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default paper size for the PDF output.
    | Supported sizes are 'letter', 'legal', 'A4', etc.
    |
    */

    'paper' => 'letter',

    /*
    |--------------------------------------------------------------------------
    | Font Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default font directory path for the PDF output.
    |
    */

    'font_path' => base_path('resources/fonts/'),

    /*
    |--------------------------------------------------------------------------
    | Font Cache Path
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default font cache directory path for the PDF
    | output.
    |
    */

    'font_cache' => storage_path('fonts/'),

    /*
    |--------------------------------------------------------------------------
    | DPI
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default DPI (dots per inch) for the PDF output.
    |
    */

    'dpi' => 150,
    'chroot' => base_path(),
];
