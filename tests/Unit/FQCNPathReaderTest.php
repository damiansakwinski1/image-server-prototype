<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Predicate\ClassExistsPredicate;
use App\Upload\FQCNCodeReader;
use App\Upload\FQCNPathReader;
use App\Upload\FQCNResult;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\UnableToReadFile;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FQCNPathReaderTest extends TestCase
{
    private ClassExistsPredicate|MockObject $classExistsPredicate;
    private FilesystemOperator|MockObject $filesystem;
    private FQCNCodeReader|MockObject $FQCNCodeReader;

    public function setUp(): void
    {
        $this->classExistsPredicate = $this->createMock(ClassExistsPredicate::class);
        $this->filesystem = $this->createMock(FilesystemOperator::class);
        $this->FQCNCodeReader = $this->createMock(FQCNCodeReader::class);
    }

    public function testReturningEmptyFQCNWhenPathCannotBeRead(): void
    {
        $FQCNPathReader = new FQCNPathReader($this->filesystem, $this->FQCNCodeReader, $this->classExistsPredicate);

        $this->givenFilesystemException()
        ->and()
        ->givenFoundClassDoesNotExist()
        ->assertSame(expected: '', actual: $FQCNPathReader->read('test'));
    }

    private function givenFoundClassDoesNotExist(): self
    {
        $this->classExistsPredicate->method('test')->willReturn(true);

        return $this;
    }

    private function and(): self
    {
        return $this;
    }

    private function givenFilesystemException(): self
    {
        $fileSystemException = new UnableToReadFile();
        $this->filesystem->expects($this->once())->method('readStream')->willThrowException($fileSystemException);

        return $this;
    }

    public function testReturningFQCN(): void
    {
        $FQCNPathReader = new FQCNPathReader($this->filesystem, $this->FQCNCodeReader, $this->classExistsPredicate);

        $this
        ->givenDirectoryWasReadSuccessfully()
        ->givenFoundClassDoesExist()
        ->and()
        ->givenFoundClassIs(new FQCNResult('Test', 'App\Tests\Unit'))
        ->assertSame(expected: 'App\Tests\Unit\Test', actual: $FQCNPathReader->read('test'));
    }

    private function givenFoundClassIs(FQCNResult $FQCNResult): self
    {
        $this->FQCNCodeReader->expects($this->once())
            ->method('read')
            ->willReturn($FQCNResult);

        return $this;
    }

    private function givenFoundClassDoesExist(): self
    {
        $this->classExistsPredicate->method('test')->willReturn(true);

        return $this;
    }

    private function givenDirectoryWasReadSuccessfully(): self
    {
        $this->filesystem->expects($this->once())->method('readStream')->willReturn($this->makeDummyResource());

        return $this;
    }

    /**
     * @return resource|false
     */
    private function makeDummyResource(string $content = '')
    {
        $testResource = fopen('php://memory', 'r+');

        if (!$testResource) {
            return false;
        }

        fputs($testResource, $content);
        rewind($testResource);

        return $testResource;
    }
}
