<?php

declare(strict_types=1);

namespace Grnspc\Measures\Unit;

interface Units
{
    public function convertFromBase(float $value): float;

    public function convertToBase(float $value): float;

    public function to(float $value, Units $destination): float;

    public function convert(float $value, Units $destination): float;

    public function toStringNotation(): string;

    public static function extendedValues(string $unitName): self;

    // /** @return List<string> */
    // public static function values(): array;
}
