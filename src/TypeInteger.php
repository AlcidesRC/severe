<?php

declare(strict_types=1);

namespace Fonil\Severe;

final class TypeInteger
{
    public function __construct(
        private readonly int $value
    ) {
    }

    public static function set(int $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeInteger $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): int
    {
        return $this->value;
    }
}
