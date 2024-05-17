<?php

declare(strict_types=1);

namespace Fonil\Severe\Tests\Unit;

use DateTime;
use Fonil\Severe\Tests\Stubs\Foo;
use Fonil\Severe\TypeFloat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Fonil\Severe\TypeFloat::class)]
final class TypeFloatTest extends TestCase
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
    public function checkSet(float $value): void
    {
        $obj = TypeFloat::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        return [
            'Zero'     => [0],
            'Positive' => [1.2345],
            'Negative' => [-1.2345],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeFloat::set($value);
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
            'Closures' => [$closure],
            //'Floats' => [-1.2345],
            //'Integers' => [12345],
            'Nulls' => [null],
            'Objects' => [new stdClass()],
            'Strings' => ['abcde'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsEqualTo')]
    public function checkIsEqualTo(TypeFloat $a, TypeFloat $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        return [
            'Zero'     => [TypeFloat::set(0), TypeFloat::set(0)],
            'Positive' => [TypeFloat::set(1.2345), TypeFloat::set(1.2345)],
            'Negative' => [TypeFloat::set(-1.2345), TypeFloat::set(-1.2345)],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeFloat $a, TypeFloat $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        return [
            'Zero'     => [TypeFloat::set(0), TypeFloat::set(12345)],
            'Positive' => [TypeFloat::set(1.2345), TypeFloat::set(0.1234)],
            'Negative' => [TypeFloat::set(-1.2345), TypeFloat::set(-0.1234)],
        ];
    }
}
