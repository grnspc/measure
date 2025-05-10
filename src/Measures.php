<?php

declare(strict_types=1);

namespace Grnspc\Measures;

use Exception;
use Grnspc\Measures\Contracts\Measures as MeasuresInterface;
use Grnspc\Measures\Unit\Angle\Angle;
use Grnspc\Measures\Unit\Area\Area;
use Grnspc\Measures\Unit\Data\Data;
use Grnspc\Measures\Unit\Energy\Energy;
use Grnspc\Measures\Unit\Length\Length;
use Grnspc\Measures\Unit\Measure;
use Grnspc\Measures\Unit\MeasureCollection;
use Grnspc\Measures\Unit\Power\Power;
use Grnspc\Measures\Unit\Pressure\Pressure;
use Grnspc\Measures\Unit\Speed\Speed;
use Grnspc\Measures\Unit\Temperature\Temperature;
use Grnspc\Measures\Unit\Time\Time;
use Grnspc\Measures\Unit\Volume\Volume;
use Grnspc\Measures\Unit\Weight\Weight;

class Measures implements MeasuresInterface
{
    public function length(string $expression): Length|MeasureCollection
    {
        return Length::from($expression);
    }

    public function weight(string $expression): Weight
    {
        return Weight::from($expression);
    }

    public function volume(string $expression): Volume
    {
        return Volume::from($expression);
    }

    public function temperature(string $expression): Temperature
    {
        return Temperature::from($expression);
    }

    public function area(string $expression): Area
    {
        return Area::from($expression);
    }

    public function speed(string $expression): Speed
    {
        return Speed::from($expression);
    }

    public function time(string $expression): Time
    {
        return Time::from($expression);
    }

    public function pressure(string $expression): Pressure
    {
        return Pressure::from($expression);
    }

    public function energy(string $expression): Energy
    {
        return Energy::from($expression);
    }

    public function power(string $expression): Power
    {
        return Power::from($expression);
    }

    public function angle(string $expression): Angle
    {
        return Angle::from($expression);
    }

    public function data(string $expression): Data
    {
        return Data::from($expression);
    }

    public function from(string $expression): ?Measure
    {
        $measures = [
            Length::class,
            Weight::class,
            Volume::class,
            Temperature::class,
            Area::class,
            Speed::class,
            Time::class,
            Pressure::class,
            Energy::class,
            Power::class,
            Angle::class,
            Data::class,
        ];

        $results = null;
        foreach ($measures as $measure) {
            try {
                /**
                 * @var Measure $results
                 * @var Measure $measure
                 */
                $results = $measure::from($expression);
                //add a break here to stop after the first match
            } catch (Exception) {
                continue;
            }
        }

        return $results;
    }
}
