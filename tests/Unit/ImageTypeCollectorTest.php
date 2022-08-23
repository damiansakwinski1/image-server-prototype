<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\FQCNDirectoryReader;
use App\ImageTypeCollector;
use PHPUnit\Framework\TestCase;

class ImageTypeCollectorTest extends TestCase
{
    public function testCollectingImageTypes()
    {
        $fqcnDirectoryReader = $this->createMock(FQCNDirectoryReader::class);
        $fqcnDirectoryReader
            ->expects($this->once())
            ->method('read')
            ->willReturn([
            ]);
        $imageTypeCollector = new ImageTypeCollector($fqcnDirectoryReader);
        $imageTypeCollector->collect('');
    }
}
