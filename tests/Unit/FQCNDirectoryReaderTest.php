<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\FQCNDirectoryReader;
use App\Upload\FilesystemFactoryInterface;
use App\Upload\FQCNPathReader;
use League\Flysystem\DirectoryListing;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\StorageAttributes;
use PHPUnit\Framework\TestCase;

class FQCNDirectoryReaderTest extends TestCase
{
    private FilesystemFactoryInterface $filesystemFactory;
    private FQCNPathReader $FQCNPathReader;
    private FilesystemOperator $filesystem;
    private DirectoryListing $directoryListing;

    public function setUp(): void
    {
        $this->FQCNPathReader = $this->createMock(FQCNPathReader::class);
        $this->directoryListing = $this->createMock(DirectoryListing::class);
        $this->filesystemFactory = $this->createMock(FilesystemFactoryInterface::class);
        $this->filesystem = $this->createMock(FilesystemOperator::class);
        $this->filesystemFactory->method('create')->willReturn($this->filesystem);
    }

    public function testCollectsImageTypes()
    {
        $this->givenDirectoryContains([new FileAttributes('TestClass.php')])
                ->and()->givenFQCNsAre(['App\Tests\Unit\FQCNDirectoryReaderTest']);

        $FQCNDirectoryReader = new FQCNDirectoryReader($this->filesystemFactory, $this->FQCNPathReader);
        $this->assertSame(['App\Tests\Unit\FQCNDirectoryReaderTest'], $FQCNDirectoryReader->read('test'));
    }

    /**
     * @param string[] $FQCNS
     */
    private function givenFQCNsAre(array $FQCNS): static
    {
        $this->FQCNPathReader
            ->method('read')
            ->willReturnOnConsecutiveCalls(...$FQCNS);

        return $this;
    }

    private function and(): static
    {
        return $this;
    }

    /**
     * @param StorageAttributes[]
     */
    private function givenDirectoryContains(array $contents): static
    {
        $this->directoryListing
            ->expects($this->once())
            ->method('toArray')
            ->willReturn($contents);
        $this->filesystem
            ->expects($this->once())
            ->method('listContents')
            ->willReturn($this->directoryListing);

        return $this;
    }
}
