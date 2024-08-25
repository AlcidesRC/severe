<?php

declare(strict_types=1);

namespace Severe;

final class TypeFloat
{
    public function __construct(
        private readonly float $value
    ) {
    }

    public static function set(float $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeFloat $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): float
    {
        return $this->value;
    }
}
