<?php

declare(strict_types=1);

namespace Fonil\Severe;

use Closure;

final class TypeClosure
{
    public function __construct(
        private readonly Closure $value
    ) {
    }

    public static function set(Closure $value): self
    {
        return new self($value);
    }

    public function isEqualTo(TypeClosure $other): bool
    {
        return $this->value === $other();
    }

    public function __invoke(): Closure
    {
        return $this->value;
    }
}
