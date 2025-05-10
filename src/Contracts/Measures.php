<?php

declare(strict_types=1);

namespace Grnspc\Measures\Contracts;

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

interface Measures
{
    public function length(string $expression): Length|MeasureCollection;

    public function weight(string $expression): Weight;

    public function volume(string $expression): Volume;

    public function temperature(string $expression): Temperature;

    public function area(string $expression): Area;

    public function speed(string $expression): Speed;

    public function time(string $expression): Time;

    public function pressure(string $expression): Pressure;

    public function energy(string $expression): Energy;

    public function power(string $expression): Power;

    public function angle(string $expression): Angle;

    public function data(string $expression): Data;

    public function from(string $expression): ?Measure;
}
