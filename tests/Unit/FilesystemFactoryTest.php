<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Upload\FilesystemFactory;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemFactoryTest extends TestCase
{
    public function testCreatingFilesystemInstance(): void
    {
        $filesystemFactory = new FilesystemFactory();

        $this->assertInstanceOf(Filesystem::class, $filesystemFactory->create('test'));
    }
}
