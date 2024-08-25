<?php

declare(strict_types=1);

namespace Severe;

final class TypeString
{
    public function __construct(
        private readonly string $value
    ) {
    }

    public static function set(string $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeString $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): string
    {
        return $this->value;
    }
}
