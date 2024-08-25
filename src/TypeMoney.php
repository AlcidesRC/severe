<?php

declare(strict_types=1);

namespace Severe;

use Exception;
use Severe\Enums\Currency;
use InvalidArgumentException;
use Swaggest\JsonSchema\Exception\ArrayException;
use Swaggest\JsonSchema\Exception\StringException;
use Swaggest\JsonSchema\Exception\TypeException;
use Swaggest\JsonSchema\Schema;
use ValueError;

final class TypeMoney
{
    private const JSON_SCHEMA = <<<'JSON'
        {
            "$schema": "https://json-schema.org/draft/2020-12/schema",
            "$id": "schema.money.json",
            "title": "Money JSON Schema",
            "type": "array",
            "minItems": 2,
            "maxItems": 2,
            "items": [
                {
                    "type": "number"
                },
                {
                    "type": "string",
                    "pattern": "^[A-Z]{3}$"
                }
            ],
            "additionalItems": false
        }
        JSON;

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

    /**
     * @throws InvalidArgumentException
     */
    public static function fromJson(string $json): self
    {
        try {
            $schema = Schema::import(json_decode(self::JSON_SCHEMA));

            $response = $schema->in(
                json_decode(
                    $json,
                    true,
                    512,
                    JSON_THROW_ON_ERROR|JSON_OBJECT_AS_ARRAY|JSON_BIGINT_AS_STRING
                )
            );

            if (!is_array($response) || count($response) !== 2) {
                throw new Exception('Wrong JSON schema validation');
            }

            return self::set($response[0], $response[1]);
        } catch (ValueError|Exception $e) {
            throw new InvalidArgumentException('[Invalid JSON] - ' . $e->getMessage());
        }
    }
}
