<?php

declare(strict_types=1);

namespace App;

interface PredicateInterface
{
    public function test(): bool;
}
