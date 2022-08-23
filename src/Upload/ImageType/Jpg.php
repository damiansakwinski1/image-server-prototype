<?php

declare(strict_types=1);

namespace App\Upload\ImageType;

use App\Upload\ImageType;

#[ImageType(
    allowedExtensions: ['jpg', 'jpeg'],
    allowedMimeTypes: ['image/jpg', 'image/jpeg'],
)]
class Jpg extends ImageType
{
}
