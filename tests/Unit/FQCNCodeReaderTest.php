<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Upload\FQCNCodeReader;
use App\Upload\FQCNResult;
use PHPUnit\Framework\TestCase;

class FQCNCodeReaderTest extends TestCase
{
    /**
     * @dataProvider namespaceAndClassCodeProvider
     */
    public function testResolvingFromNamespaceAndClass(FQCNResult $expected, string $code): void
    {
        $FQCNReader = new FQCNCodeReader();
        $result = $FQCNReader->read($code);
        $actualClass = $result->getClass();
        $actualNamespace = $result->getNamespace();
        $this->assertSame($expected->getClass(), $actualClass);
        $this->assertSame($expected->getNamespace(), $actualNamespace);
    }

    public function namespaceAndClassCodeProvider(): array
    {
        return [
            [
                'expected' => new FQCNResult('TestClass', 'Test\Testo'),
                'code' => '<?php

            namespace Test\Testo; 
            class TestClass {}',
            ],
            [
                'expected' => new FQCNResult('TestClass', 'Test\Testo'),
                'code' => '<?php namespace Test\Testo class TestClass {}',
            ],
        ];
    }

    /**
     * @dataProvider incompleteCodeProvider
     */
    public function testResolvingFromIncompleteCode(FQCNResult $expected, string $code): void
    {
        $FQCNReader = new FQCNCodeReader();
        $actual = $FQCNReader->read($code);
        $this->assertSame($expected->getClass(), $actual->getClass());
        $this->assertSame($expected->getNamespace(), $actual->getNamespace());
    }

    public function incompleteCodeProvider(): array
    {
        return [
            [
                'expected' => new FQCNResult(),
                'code' => '',
            ],
            [
                'expected' => new FQCNResult(),
                'code' => '<?php ?>',
            ],
            [
                'expected' => new FQCNResult(),
                'code' => '<?php class',
            ],
            [
                'expected' => new FQCNResult(),
                'code' => '<?php class {} ?>',
            ],
        ];
    }

    /**
     * @dataProvider classCodeProvider
     */
    public function testResolvingClass(FQCNResult $expected, string $code): void
    {
        $FQCNReader = new FQCNCodeReader();
        $actual = $FQCNReader->read($code);
        $this->assertSame($expected->getClass(), $actual->getClass());
    }

    public function classCodeProvider(): array
    {
        return [
            [
                'expected' => new FQCNResult('Test'),
                'code' => '<?php class Test {} ?>',
            ],
            [
                'expected' => new FQCNResult('Test'),
                'code' => '<?php class Test;',
            ],
        ];
    }
}
