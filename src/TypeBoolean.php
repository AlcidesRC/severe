<?php

declare(strict_types=1);

namespace Severe;

final class TypeBoolean
{
    public function __construct(
        private readonly bool $value
    ) {
    }

    public static function set(bool $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeBoolean $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): bool
    {
        return $this->value;
    }
}
