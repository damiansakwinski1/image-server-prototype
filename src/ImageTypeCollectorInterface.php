<?php

declare(strict_types=1);

namespace App;

use App\Upload\ImageType;

interface ImageTypeCollectorInterface
{
    /**
     * @return ImageType[]
     */
    public function collect(string $location): array;
}
