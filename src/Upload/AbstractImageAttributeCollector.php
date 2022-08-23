<?php

declare(strict_types=1);

namespace App\Upload;

use App\ImageTypeCollector;

abstract class AbstractImageAttributeCollector
{
    public function __construct(private ImageTypeCollector $imageTypeCollector, private string $imageDir)
    {
    }

    /**
     * @return ImageType[]
     */
    final protected function collectImageTypes(): array
    {
        return $this->imageTypeCollector->collect($this->imageDir);
    }

    abstract public function collect(): mixed;
}
