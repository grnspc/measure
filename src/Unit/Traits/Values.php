<?php

namespace Grnspc\Measures\Unit\Traits;

use Grnspc\Measures\Unit\Units;

trait Values
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
