<?php

declare(strict_types=1);

namespace Fonil\Severe\Tests\Unit;

use DateTime;
use Fonil\Severe\Tests\Stubs\Foo;
use Fonil\Severe\TypeInteger;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Fonil\Severe\TypeInteger::class)]
final class TypeIntegerTest extends TestCase
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
    public function checkSet(int $value): void
    {
        $obj = TypeInteger::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        $random = mt_rand(-10, 10);

        return [
            'Random' => [$random],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeInteger::set($value);
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
            'Floats' => [-1.2345],
            //'Integers' => [12345],
            'Nulls' => [null],
            'Objects' => [new stdClass()],
            'Strings' => ['abcde'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsEqualTo')]
    public function checkIsEqualTo(TypeInteger $a, TypeInteger $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        return [
            'Zero'     => [TypeInteger::set(0), TypeInteger::set(0)],
            'Positive' => [TypeInteger::set(1), TypeInteger::set(1)],
            'Negative' => [TypeInteger::set(-1), TypeInteger::set(-1)],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeInteger $a, TypeInteger $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        return [
            'Zero'     => [TypeInteger::set(0), TypeInteger::set(12345)],
            'Positive' => [TypeInteger::set(1), TypeInteger::set(2)],
            'Negative' => [TypeInteger::set(-1), TypeInteger::set(-2)],
        ];
    }
}
