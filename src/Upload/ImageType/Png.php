<?php

declare(strict_types=1);

namespace App\Upload\ImageType;

use App\Upload\ImageType;

#[ImageType(
    allowedExtensions: ['png'],
    allowedMimeTypes: ['image/png'],
)]
class Png extends ImageType
{
}
