<?php

declare(strict_types=1);

namespace Grnspc\Measures\Utilities;

use Illuminate\Support\Str;

trait SquishesStrings
{
    public static function squish(string $string): string
    {
        return Str::of($string)->squish()->value();
    }
}
