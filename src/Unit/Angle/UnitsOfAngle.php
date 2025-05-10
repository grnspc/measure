<?php

namespace Grnspc\Measures\Unit\Angle;

use Grnspc\Measures\Unit\Traits\Values;
use InvalidArgumentException;
use Grnspc\Measures\Unit\Traits\ConversionFactor;
use Grnspc\Measures\Unit\Units;

enum UnitsOfAngle: string implements Units
{
    use ConversionFactor;
    use Values;

    case RADIAN = 'rad';
    case DEGREE = 'deg';

    public function conversionFactor(): float
    {
        return match ($this) {
            self::RADIAN => 1,
            self::DEGREE => 0.017453292519943,
        };
    }

    public function toStringNotation(): string
    {
        return match ($this) {
            self::RADIAN => 'rad',
            self::DEGREE => 'º',
        };
    }

    public static function extendedValues(string $unitName): Units
    {
        return match ($unitName) {
            'radian','radians' => self::RADIAN,
            'degree', 'degrees' => self::DEGREE,
            default => throw new InvalidArgumentException('Invalid unit name'),
        };
    }
}
