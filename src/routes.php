<?php

Route::get('/{dir}/{width}x{height}x{crop}/{filename}', '\Iankov\Thumbnails\ThumbnailController@get')
    ->where([
        //'dir' => 'article\/images\/[0-9a-zA-Z\-\_\.]+',
        'dir' => '[A-Za-z0-9_\-\.\s\/]+',
        'width' => '[0-9]+',
        'height' => '[0-9]+',
        'crop' => '[0,1]',
        'filename' => '.+\.((?i)jpg|jpeg|png|gif)'
    ]);