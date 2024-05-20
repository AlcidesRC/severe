<?php

declare(strict_types=1);

namespace Fonil\Severe;

use Fonil\Severe\Enums\Currency;

final class TypeMoney
{
    public function __construct(
        private readonly TypeFloat $amount,
        private readonly Currency $currency
    ) {
    }

    public static function set(TypeFloat|float $amount, Currency|string $currency): self
    {
        $currency = $currency instanceof Currency
            ? $currency
            : Currency::from(mb_strtoupper(trim($currency)));

        $amount = $amount instanceof TypeFloat
            ? $amount()
            : $amount;

        return new self(
            amount: TypeFloat::set((float) number_format($amount, $currency->decimals())),
            currency: $currency,
        );
    }

    public function isEqualTo(TypeMoney $other): bool
    {
        [$amount, $currency] = $other();

        $isSameAmount   = ($this->amount)() === $amount();
        $isSameCurrency = $this->currency === $currency;

        return $isSameAmount && $isSameCurrency;
    }

    /**
     * @return array{0: TypeFloat, 1: Currency}
     */
    public function __invoke(): array
    {
        return [$this->amount, $this->currency];
    }

    public function toJson(): string|false
    {
        return json_encode([
            ($this->amount)(),
            $this->currency->value
        ]);
    }
}
