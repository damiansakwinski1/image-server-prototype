<?php

declare(strict_types=1);

namespace App\Upload;

use Attribute;

#[Attribute]
class ImageType
{
    /**
     * @param array<literal-string> $allowedExtensions
     * @param array<literal-string> $allowedMimeTypes
     */
    public function __construct(
        private array $allowedExtensions,
        private array $allowedMimeTypes,
    ) {
    }

    /**
     * @return array<literal-string>
     */
    public function getAllowedExtensions(): array
    {
        return $this->allowedExtensions;
    }

    /**
     * @return array<literal-string>
     */
    public function getAllowedMimeTypes(): array
    {
        return $this->allowedMimeTypes;
    }
}
