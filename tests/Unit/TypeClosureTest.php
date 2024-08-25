<?php

declare(strict_types=1);

namespace Severe\Tests\Unit;

use Closure;
use DateTime;
use Severe\Tests\Stubs\Foo;
use Severe\TypeClosure;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Severe\TypeClosure::class)]
final class TypeClosureTest extends TestCase
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

    #[Test]
    #[DataProvider('dataProviderForSet')]
    public function checkSet(Closure $value): void
    {
        $obj = TypeClosure::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        $closure = function (): void {
        };

        return [
            'Closures' => [$closure],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeClosure::set($value);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSetWithError(): array
    {
        $closure = function (): void {
        };

        return [
            'Arrays' => [[1, 2, 3]],
            'Booleans' => [false],
            'Callables' => [[Foo::class, 'foo']],
            //'Closures' => [$closure],
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
    public function checkIsEqualTo(TypeClosure $a, TypeClosure $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        $closure = function (): void {
        };

        return [
            'Closures' => [TypeClosure::set($closure), TypeClosure::set($closure)],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeClosure $a, TypeClosure $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        $closure1 = function (): void {
        };

        $closure2 = function (): void {
        };

        return [
            'Closures' => [TypeClosure::set($closure1), TypeClosure::set($closure2)],
        ];
    }
}
