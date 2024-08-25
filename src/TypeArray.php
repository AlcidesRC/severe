<?php

declare(strict_types=1);

namespace Severe;

final class TypeArray
{
    /**
     * @param array<mixed> $value
     */
    public function __construct(
        private readonly array $value
    ) {
    }

    /**
     * @param array<mixed> $value
     */
    public static function set(array $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeArray $other): bool
    {
        return $this->value === $other();
    }

    /**
     * @return array<mixed> $value
     */
    public function __invoke(): array
    {
        return $this->value;
    }
}
