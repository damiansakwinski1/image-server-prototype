<?php

declare(strict_types=1);

namespace App\Upload\ImageType;

use App\Upload\ImageType;

#[ImageType(
    allowedExtensions: ['webp'],
    allowedMimeTypes: ['image/webp']
)]
class Webp extends ImageType
{
}
