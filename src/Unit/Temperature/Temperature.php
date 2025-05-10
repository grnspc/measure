<?php

namespace Grnspc\Measures\Unit\Temperature;

use Grnspc\Measures\Unit\Measure;

/**
 * @method Temperature toCelsius()
 * @method Temperature toFahrenheit()
 * @method Temperature toKelvin()
 * @method Temperature toCdeg()
 * @method Temperature toFdeg()
 * @method Temperature toKdeg()
 */
class Temperature extends Measure
{
    public static string $unitClass = UnitsOfTemperature::class;
}
