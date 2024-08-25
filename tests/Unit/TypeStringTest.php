<?php

declare(strict_types=1);

namespace Severe\Tests\Unit;

use DateTime;
use Severe\Tests\Stubs\Foo;
use Severe\TypeString;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use stdClass;
use TypeError;

#[CoversClass(\Severe\TypeString::class)]
final class TypeStringTest extends TestCase
{
    private const CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    protected function setUp(): void
    {
        ClockMock::freeze(new DateTime('2024-01-01 00:00:00'));
    }

    protected function tearDown(): void
    {
        ClockMock::reset();
    }

    // ---------------------------------------------------------------------------------------------------------------

    private static function generateRandomString(?int $length = 5): string
    {
        return substr(str_shuffle(self::CHARACTERS), 0, $length);
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSet')]
    public function checkSet(string $value): void
    {
        $obj = TypeString::set($value);
        self::assertEquals($value, $obj());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        $random = self::generateRandomString(10);

        return [
            'Empty'      => [''],
            'Whitespace' => [' '],
            'Numeric'    => ['01234'],
            'Random'     => [$random],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForSetWithError')]
    public function checkSetWithError(mixed $value): void
    {
        $this->expectException(TypeError::class);
        // @phpstan-ignore-next-line
        TypeString::set($value);
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
            'Integers' => [12345],
            'Nulls' => [null],
            'Objects' => [new stdClass()],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsEqualTo')]
    public function checkIsEqualTo(TypeString $a, TypeString $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        $random = self::generateRandomString(10);

        return [
            'Empty'       => [TypeString::set(''), TypeString::set('')],
            'Whitespaces' => [TypeString::set(' '), TypeString::set(' ')],
            'Numeric'     => [TypeString::set('01234'), TypeString::set('01234')],
            'Random'      => [TypeString::set($random), TypeString::set($random)],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeString $a, TypeString $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        $random1 = self::generateRandomString(10);
        $random2 = self::generateRandomString(10);

        return [
            'Empty'       => [TypeString::set(''), TypeString::set('xxx')],
            'Whitespaces' => [TypeString::set(' '), TypeString::set('xxx')],
            'Numeric'     => [TypeString::set('01234'), TypeString::set('xxx')],
            'Random'      => [TypeString::set($random1), TypeString::set($random2)],
        ];
    }
}
