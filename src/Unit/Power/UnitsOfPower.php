<?php

namespace Grnspc\Measures\Unit\Power;

use Grnspc\Measures\Unit\Traits\Values;
use InvalidArgumentException;
use Grnspc\Measures\Unit\Traits\ConversionFactor;
use Grnspc\Measures\Unit\Units;

enum UnitsOfPower: string implements Units
{
    use ConversionFactor;
    use Values;

    case WATT = 'w';
    case KILOWATT = 'kw';
    case MEGAWATT = 'mw';
    case GIGAWATT = 'gw';

    case HORSEPOWER = 'hp';

    public function conversionFactor(): float
    {
        return match ($this) {
            self::WATT => 1,
            self::KILOWATT => 1000,
            self::MEGAWATT => 1000000,
            self::GIGAWATT => 1000000000,
            self::HORSEPOWER => 745.699872,
        };
    }

    public function toStringNotation(): string
    {
        return match ($this) {
            self::WATT => 'W',
            self::KILOWATT => 'kW',
            self::MEGAWATT => 'MW',
            self::GIGAWATT => 'GW',
            self::HORSEPOWER => 'hp',
        };
    }

    public static function extendedValues(string $unitName): Units
    {
        return match ($unitName) {
            'watts', 'watt' => self::WATT,
            'kilowatts', 'kilowatt' => self::KILOWATT,
            'megawatts', 'megawatt' => self::MEGAWATT,
            'gigawatts', 'gigawatt' => self::GIGAWATT,
            'horsepower' => self::HORSEPOWER,
            default => throw new InvalidArgumentException('Invalid unit name'),
        };
    }
}
