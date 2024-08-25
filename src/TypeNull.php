<?php

declare(strict_types=1);

namespace Severe;

final class TypeNull
{
    public function __construct(
        private readonly null $value
    ) {
    }

    public static function set(null $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeNull $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): null
    {
        return $this->value;
    }
}
