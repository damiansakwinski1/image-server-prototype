<?php

declare(strict_types=1);

namespace App;

use App\Upload\FilesystemFactoryInterface;
use App\Upload\FQCNPathReader;
use League\Flysystem\StorageAttributes;

class FQCNDirectoryReader
{
    public function __construct(
        private FilesystemFactoryInterface $filesystemFactory,
        private FQCNPathReader $FQCNPathReader
    ) {
    }

    /**
     * @return array<class-string>
     */
    public function read(string $directory): array
    {
        $filesystem = $this->filesystemFactory->create($directory);
        $directoryListing = $filesystem->listContents('/');
        /** @var StorageAttributes[] $directoryContents */
        $directoryContents = $directoryListing->toArray();

        return $this->collectFQCNsFromDirectory($directory, $directoryContents);
    }

    /**
     * @param StorageAttributes[] $directoryContents
     *
     * @return array<class-string>
     */
    private function collectFQCNsFromDirectory(string $directory, array $directoryContents): array
    {
        $result = [];
        foreach ($directoryContents as $directoryContent) {
            if ($directoryContent->isDir()) {
                continue;
            }

            $path = "{$directory}/{$directoryContent->path()}";
            $FQCN = $this->FQCNPathReader->read($path);
            if ('' !== $FQCN && class_exists($FQCN)) {
                $result[] = $FQCN;
            }
        }

        return $result;
    }
}
