<?php

declare(strict_types=1);

namespace App\Upload;

use App\Predicate\ClassExistsPredicate;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;

class FQCNPathReader
{
    public function __construct(
        private FilesystemOperator $filesystem,
        private FQCNCodeReader $FQCNCodeReader,
        private ClassExistsPredicate $classExistsPredicate,
    ) {
    }

    /**
     * @return class-string|string
     */
    public function read(string $path): string
    {
        try {
            $stream = $this->filesystem->readStream($path);

            do {
                $buffer = (string) fread($stream, length: 256);
                $FQCNResult = $this->FQCNCodeReader->read($buffer);
            } while ('' !== $buffer && !$FQCNResult->hasNamespaceAndClass());

            $FQCN = "{$FQCNResult->getNamespace()}\\{$FQCNResult->getClass()}";

            return $this->classExistsPredicate->test($FQCN) ? $FQCN : '';
        } catch (FilesystemException) {
            return '';
        }
    }
}
