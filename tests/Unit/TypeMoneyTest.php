<?php

declare(strict_types=1);

namespace Fonil\Severe\Tests\Unit;

use DateTime;
use Fonil\Severe\Enums\Currency;
use Fonil\Severe\TypeFloat;
use Fonil\Severe\TypeMoney;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;
use TypeError;

#[CoversClass(\Fonil\Severe\TypeMoney::class)]
#[CoversClass(\Fonil\Severe\TypeFloat::class)]
#[CoversClass(\Fonil\Severe\Enums\Currency::class)]
final class TypeMoneyTest extends TestCase
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
    public function checkSet(TypeFloat|float $value, Currency|string $currency): void
    {
        $obj = TypeMoney::set($value, $currency);

        self::assertInstanceOf(TypeFloat::class, $obj()[0]);
        self::assertInstanceOf(Currency::class, $obj()[1]);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSet(): array
    {
        return [
            'Float + String'       => [123.45, 'EUR'],
            'Float + Currency'     => [123.45, Currency::EUR],
            'TypeFloat + String'   => [TypeFloat::set(-123.45), 'EUR'],
            'TypeFloat + Currency' => [TypeFloat::set(-123.45), Currency::EUR],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsEqualTo')]
    public function checkIsEqualTo(TypeMoney $a, TypeMoney $b): void
    {
        self::assertTrue($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsEqualTo(): array
    {
        return [
            'Float + String' => [
                TypeMoney::set(123.45, 'EUR'),
                TypeMoney::set(123.45, 'EUR')
            ],

            'Float + Currency' => [
                TypeMoney::set(123.45, Currency::EUR),
                TypeMoney::set(123.45, Currency::EUR)
            ],

            'TypeFloat + String' => [
                TypeMoney::set(TypeFloat::set(123.45), 'EUR'),
                TypeMoney::set(TypeFloat::set(123.45), 'EUR')
            ],

            'TypeFloat + Currency' => [
                TypeMoney::set(TypeFloat::set(123.45), Currency::EUR),
                TypeMoney::set(TypeFloat::set(123.45), Currency::EUR)
            ],

            'Currency with 0 decimals' => [
                TypeMoney::set(TypeFloat::set(123.45), Currency::BIF),
                TypeMoney::set(TypeFloat::set(123), Currency::BIF)
            ],

            'Currency with 4 decimals' => [
                TypeMoney::set(TypeFloat::set(123.456789), Currency::CLF),
                TypeMoney::set(TypeFloat::set(123.4568), Currency::CLF)
            ],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForIsNotEqualTo')]
    public function checkIsNotEqualTo(TypeMoney $a, TypeMoney $b): void
    {
        self::assertFalse($a->isEqualTo($b));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForIsNotEqualTo(): array
    {
        return [
            'Float + String' => [
                TypeMoney::set(123.45, 'EUR'),
                TypeMoney::set(-123.45, 'EUR')
            ],

            'Float + Currency' => [
                TypeMoney::set(123.45, Currency::EUR),
                TypeMoney::set(-123.45, Currency::EUR)
            ],

            'TypeFloat + String' => [
                TypeMoney::set(TypeFloat::set(123.45), 'EUR'),
                TypeMoney::set(TypeFloat::set(-123.45), 'EUR')
            ],

            'TypeFloat + Currency' => [
                TypeMoney::set(TypeFloat::set(123.45), Currency::EUR),
                TypeMoney::set(TypeFloat::set(-123.45), Currency::EUR)
            ],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForToJson')]
    public function checkToJson(TypeMoney $a, string $expected): void
    {
        self::assertEquals($expected, $a->toJson());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForToJson(): array
    {
        return [
            'Positive' => [TypeMoney::set(123.45, 'EUR'), '[123.45,"EUR"]'],
            'Negative' => [TypeMoney::set(-123.45, 'USD'), '[-123.45,"USD"]'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForFromJson')]
    public function checkFromJson(string $data, TypeMoney $expected): void
    {
        $aux = TypeMoney::fromJson($data);

        self::assertTrue($aux->isEqualTo($expected));
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForFromJson(): array
    {
        return [
            'Positive' => ['[123.45,"EUR"]', TypeMoney::set(123.45, 'EUR')],
            'Negative' => ['[-123.45,"USD"]', TypeMoney::set(-123.45, 'USD')],
        ];
    }
}
