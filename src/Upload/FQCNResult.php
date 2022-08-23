<?php

declare(strict_types=1);

namespace App\Upload;

final class FQCNResult
{
    public function __construct(private string $class = '', private string $namespace = '')
    {
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function hasNamespaceAndClass(): bool
    {
        return '' !== $this->namespace && '' !== $this->class;
    }
}
