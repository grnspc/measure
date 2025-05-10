<?php

namespace Grnspc\Measures\Unit;

use BadMethodCallException;
use Grnspc\Measures\Facades\Measures;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MeasureCollection
{
    public function __construct(
        protected ?Collection $measurements = null
    )
    {
    }

    public function __call(string $name, array $arguments)
    {
        if (Str::startsWith($name, 'to')) {
            $unit = Str::of($name)->after('to')->lower()->value();

            return $this->to($unit);
        }

        throw new BadMethodCallException("Method $name does not exist.");
    }

    public function to(string|Units $destination)
    {
        $convertedMeasurements = $this->measurements->map(
            fn($measurement) => $measurement->to($destination)
        )
            ->sum('value');

        // return Measures::from();
    }

    public function __toString(): string
    {
        return $this->measurements->map(fn($measurement) => (string)$measurement)->join(' ');
    }

}
