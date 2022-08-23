<?php

declare(strict_types=1);

namespace App\Predicate;

class ClassExistsPredicate
{
    public function test(string $FQCN): bool
    {
        return class_exists($FQCN);
    }
}
