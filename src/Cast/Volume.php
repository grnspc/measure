<?php

declare(strict_types=1);

namespace Grnspc\Measures\Cast;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

/* @phpstan-ignore-next-line */
class Volume implements CastsAttributes
{
    /**
     * @return \Grnspc\Measures\Unit\Measure|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        /* @phpstan-ignore-next-line */
        return \Grnspc\Measures\Unit\Volume\Volume::from($value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }
        if (! $value instanceof \Grnspc\Measures\Unit\Volume\Volume) {
            throw new InvalidArgumentException("The value must be an instance of Grnspc\Measures\Unit\Volume\Volume");
        }

        return (string) $value;
    }
}
