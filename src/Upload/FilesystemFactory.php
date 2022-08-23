<?php

declare(strict_types=1);

namespace App\Upload;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\Local\LocalFilesystemAdapter;

final class FilesystemFactory implements FilesystemFactoryInterface
{
    public function create(string $location): FilesystemOperator
    {
        $adapter = new LocalFilesystemAdapter($location);

        return new Filesystem($adapter);
    }
}
