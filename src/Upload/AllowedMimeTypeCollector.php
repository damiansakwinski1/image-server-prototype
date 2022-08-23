<?php

declare(strict_types=1);

namespace App\Upload;

class AllowedMimeTypeCollector extends AbstractImageAttributeCollector
{
    /**
     * @return array<literal-string>
     */
    public function collect(): array
    {
        $result = [];
        foreach ($this->collectImageTypes() as $imageType) {
            array_push($result, ...$imageType->getAllowedMimeTypes());
        }

        return $result;
    }
}
