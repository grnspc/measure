<?php

namespace Grnspc\Measures\Unit\Angle;

use Grnspc\Measures\Unit\Measure;

/**
 * @method Angle toDegrees() Convert to degrees
 * @method Angle toRadians() Convert to radians
 * @method Angle toDeg() Convert to degrees
 * @method Angle toRad() Convert to radians
 */
class Angle extends Measure
{
    public static string $unitClass = UnitsOfAngle::class;
}
