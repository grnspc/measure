<?php

declare(strict_types=1);

namespace Grnspc\Measures\Facades;

use Grnspc\Measures\Contracts\Measures as MeasuresInterface;
use Illuminate\Support\Facades\Facade;

class Measures extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MeasuresInterface::class;
    }
}
