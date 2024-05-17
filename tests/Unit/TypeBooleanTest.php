<?php

declare(strict_types=1);

namespace Fonil\Severe\Tests\Unit;

use DateTime;
use Fonil\Severe\Tests\Stubs\Foo;
use Fonil\Severe\TypeBoolean;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Fonil\Severe\TypeBoolean::class)]
final class TypeBooleanTest extends TestCase
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
    public function checkSet(bool $value): void
    {
        $obj = TypeBoolean::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        return [
            'Booleans' => [false],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeBoolean::set($value);
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
            //'Booleans' => [false],
            'Callables' => [[Foo::class, 'foo']],
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
    public function checkIsEqualTo(TypeBoolean $a, TypeBoolean $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        return [
            'Booleans' => [TypeBoolean::set(false), TypeBoolean::set(false)],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeBoolean $a, TypeBoolean $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        return [
            'Booleans' => [TypeBoolean::set(false), TypeBoolean::set(true)],
        ];
    }
}
