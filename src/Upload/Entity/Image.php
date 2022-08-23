<?php

declare(strict_types=1);

namespace App\Upload\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Image
{
    private File $image;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint(
            property: 'image',
            constraint: new Assert\Image(mimeTypes: ['image/png'], mimeTypesMessage: 'Supplied image is of invalid mime type.')
        );
    }

    public function setImage(File $image): void
    {
        $this->image = $image;
    }

    public function getImage(): File
    {
        return $this->image;
    }
}
