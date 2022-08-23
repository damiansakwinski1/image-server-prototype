<?php

declare(strict_types=1);

namespace App\Upload;

use League\Flysystem\FilesystemOperator;

interface FilesystemFactoryInterface
{
    public function create(string $location): FilesystemOperator;
}
