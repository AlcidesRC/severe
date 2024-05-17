<?php

declare(strict_types=1);

namespace Fonil\Severe\Tests\Unit;

use DateTime;
use Fonil\Severe\Tests\Stubs\Foo;
use Fonil\Severe\TypeArray;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Fonil\Severe\TypeArray::class)]
final class TypeArrayTest extends TestCase
{
    protected function setUp(): void
    {
        ClockMock::freeze(new DateTime('2024-01-01 00:00:00'));
    }

    protected function tearDown(): void
    {
        ClockMock::reset();
    }

    // ---------------------------------------------------------------------------------------------------------------

    /**
     * @param array<int|string, mixed> $value
     */
    #[Test]
    #[DataProvider('dataProviderForSet')]
    public function checkSet(array $value): void
    {
        $obj = TypeArray::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        return [
            'Arrays' => [[1, 2, 3]],
            'Callables' => [[Foo::class, 'foo']],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeArray::set($value);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSetWithError(): array
    {
        $closure = function (): void {
        };

        return [
            //'Arrays' => [[1, 2, 3]],
            'Booleans' => [false],
            //'Callables' => [[Foo::class, 'foo']],
            'Closures' => [$closure],
            'Floats' => [-1.2345],
            'Integers' => [12345],
            'Nulls' => [null],
            'Objects' => [new stdClass()],
            'Strings' => ['abcde'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsEqualTo')]
    public function checkIsEqualTo(TypeArray $a, TypeArray $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        return [
            'Arrays'    => [TypeArray::set([1, 2, 3]), TypeArray::set([1, 2, 3])],
            'Callables' => [TypeArray::set([Foo::class, 'foo']), TypeArray::set([Foo::class, 'foo'])],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeArray $a, TypeArray $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        return [
            'Arrays'    => [TypeArray::set([1, 2, 3]), TypeArray::set([3, 2, 1])],
            'Callables' => [TypeArray::set([Foo::class, 'foo']), TypeArray::set([Foo::class, 'bar'])],
        ];
    }
}
