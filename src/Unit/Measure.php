<?php

declare(strict_types=1);

namespace Grnspc\Measures\Unit;

use BadMethodCallException;
use Grnspc\Measures\Utilities\SquishesStrings;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Measure
{
    use SquishesStrings;

    public static string $unitClass = Units::class;


    final public function __construct(
        public float $value,
        public Units $unit,
        private ?float $realValue = null
    )
    {
        $this->realValue = $realValue ?? $value;
    }

    public static function from(string $expression): static|MeasureCollection
    {
        $expression = static::squish($expression);

        if (count($measurements = static::parseExpression($expression)) > 1) {
            $smallestUnit = static::detectSmallestUnit($measurements);

            $value = $measurements->reduce(function (float $carry, $measurement) use ($smallestUnit) {
                return $carry + $measurement->to($smallestUnit)->value;
            }, 0);

            return new static((float)$value, $smallestUnit);
        }

        [$value, $unit] = static::getValueAndUnit($expression);

        return new static($value, $unit);
    }

    public static function parseExpression(string $expression): Collection
    {
        // $pattern = "/(?:^(?:(\d+(?:[ft|']+)))?(?:[-| ]*)(?:(\d*(?: ?\d*(?:[\/|.]*)\d+(?:[in|\"]*))?))?$)/mi";
        if (!method_exists(static::$unitClass, 'values')) {
            return collect([]);
        }

        $values = implode("|", (static::$unitClass)::values() ?? []);
        $pattern = "/^(\d+[{$values}]+)?[-| ]*(\d*(?: ?\d*[\/|.]*\d+[{$values}]*)?)?$/mi";

        preg_match($pattern, $expression, $matches);

        return collect($matches)
            ->skip(1)
            ->filter()
            ->unique()
            ->map(function ($expression) {
                return static::fromExpression($expression);
            });
    }

    public static function fromExpression(string $expression): static|MeasureCollection
    {
        $expression = static::squish($expression);

        [$value, $unit] = static::getValueAndUnit($expression);

        return new static($value, $unit);
    }

    /**
     * @return array{float, Units}
     */
    public static function getValueAndUnit(string $expression): array
    {
        $value = static::extractValue($expression);
        $expression = Str::remove((string)$value, $expression);

        $unit = static::detectUnit($expression);

        if ($unit === null) {
            throw new BadMethodCallException('Invalid unit.');
        }

        return [(float)$value, $unit];
    }

    public static function extractValue(string $expression): ?string
    {
        $results = Str::of($expression)->trim()->explode(' ')->first();
        /* @phpstan-ignore-next-line */
        if (Str::of($results)->length() === Str::of($expression)->length()) {
            return Str::of($expression)->match('/[\d.+]+/')->value();
        }

        return $results;
    }

    public static function detectUnit(string $expression): ?Units
    {
        $unit = null;
        if (!empty($expression)) {
            $expression = Str::of($expression)->trim()->lower()->squish()->value();
            $unit = (static::$unitClass)::tryFrom($expression);

            if (!$unit) {
                $unit = (static::$unitClass)::extendedValues($expression);
            }
        }

        return $unit;
    }

    public static function detectSmallestUnit(Collection|string $expression): ?Units
    {
        $measurements = is_string($expression) ? static::parseExpression($expression) : $expression;

        return $measurements->reduce(function (?Units $carry, self $measurement) {
            return !$carry || $measurement->unit->conversionFactor() < $carry->conversionFactor() ? $measurement->unit : $carry;
        });

    }

    public function to(string|Units $destination, ?int $precision = null): static
    {
        if (is_string($destination)) {
            $destination = static::detectUnit($destination);
        }

        if (empty($destination)) {
            throw new BadMethodCallException('Invalid unit.');
        }

        $convertedValue = $this->unit->to($this->value, $destination);

        // $this->realValue = $convertedValue;
        /* @phpstan-ignore-next-line */
        // $this->value = round($convertedValue, $precision ?? config('measures.default_precision', 4));
        // $this->unit = $destination;

        return new static(
            /* @phpstan-ignore-next-line */
            round($convertedValue, $precision ?? config('measures.default_precision', 4)),
            $destination,
            $convertedValue
        );

        // return $this;
    }

    protected function toString(): float
    {
        return $this->value;
    }

    public function realValue(): float
    {
        return $this->realValue;
    }

    public function __toString(): string
    {
        return $this->value . ' ' . $this->unit->toStringNotation();
    }

    public function unitClass(): string
    {
        return static::$unitClass;
    }

    /**
     * @param array<mixed,mixed> $arguments
     *
     * @return Measure
     */
    public function __call(string $name, array $arguments)
    {
        if (Str::startsWith($name, 'to')) {
            $unit = Str::of($name)->after('to')->lower()->value();

            return $this->to($unit);
        }

        throw new BadMethodCallException("Method $name does not exist.");
    }
}
