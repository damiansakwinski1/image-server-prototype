<?php

declare(strict_types=1);

namespace App\Upload;

final class AllowedExtensionCollector extends AbstractImageAttributeCollector
{
    /**
     * @return array<literal-string>
     */
    public function collect(): array
    {
        $result = [];
        foreach ($this->collectImageTypes() as $imageType) {
            array_push($result, ...$imageType->getAllowedExtensions());
        }

        return $result;
    }
}
