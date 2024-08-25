<?php

declare(strict_types=1);

namespace Severe\Tests\Unit\Enums;

use DateTime;
use Severe\Enums\Currency;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SlopeIt\ClockMock\ClockMock;

#[CoversClass(\Severe\Enums\Currency::class)]
final class CurrencyTest extends TestCase
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
    #[DataProvider('dataProviderForSymbols')]
    public function checkSymbols(Currency $currency, string $expected): void
    {
        self::assertEquals($expected, $currency->value);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForSymbols(): array
    {
        return [
            'EUR' => [Currency::EUR, 'EUR'],
            'USD' => [Currency::USD, 'USD'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForCodes')]
    public function checkCodes(Currency $currency, string $expected): void
    {
        self::assertEquals($expected, $currency->code());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForCodes(): array
    {
        return [
            'EUR' => [Currency::EUR, '978'],
            'USD' => [Currency::USD, '840'],
        ];
    }

    // ---------------------------------------------------------------------------------------------------------------

    #[Test]
    #[DataProvider('dataProviderForNames')]
    public function checkNames(Currency $currency, string $expected): void
    {
        self::assertEquals($expected, $currency->name());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function dataProviderForNames(): array
    {
        return [
            'EUR' => [Currency::EUR, 'Euro'],
            'USD' => [Currency::USD, 'US Dollar'],
        ];
    }
}
