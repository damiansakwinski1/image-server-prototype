<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Predicate\ClassExistsPredicate;
use PHPStan\Testing\TestCase;

class ClassExistsTest extends TestCase
{
    public function testReturningFalseOnNonExistingClass()
    {
        $classExists = new ClassExistsPredicate();

        $this->assertSame(false, $classExists->test('AClassThatDoesNotExistForSure'));
    }

    public function testReturningTrueOnExistingClass()
    {
        $classExists = new ClassExistsPredicate();

        $this->assertSame(true, $classExists->test(self::class));
    }
}
