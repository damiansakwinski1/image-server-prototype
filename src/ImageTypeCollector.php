<?php

declare(strict_types=1);

namespace App;

use App\Upload\ImageType;
use ReflectionClass;

final class ImageTypeCollector implements ImageTypeCollectorInterface
{
    public function __construct(private FQCNDirectoryReader $FQCNDirectoryReader)
    {
    }

    /**
     * @return ImageType[]
     */
    public function collect(string $location): array
    {
        $FQCNs = $this->FQCNDirectoryReader->read($location);
        $result = [];

        foreach ($FQCNs as $FQCN) {
            $reflection = new ReflectionClass($FQCN);
            $attributes = $reflection->getAttributes(ImageType::class);

            foreach ($attributes as $attribute) {
                $result[] = $attribute->newInstance();
            }
        }

        return $result;
    }
}
