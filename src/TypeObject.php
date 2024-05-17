<?php

declare(strict_types=1);

namespace Fonil\Severe;

final class TypeObject
{
    public function __construct(
        private readonly object $value
    ) {
    }

    public static function set(object $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeObject $other): bool
    {
        return $this->value == $other();
    }

    public function __invoke(): object
    {
        return $this->value;
    }
}
