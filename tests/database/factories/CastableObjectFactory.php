<?php

namespace Grnspc\Measures\Tests\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Grnspc\Measures\Tests\TestModels\CastableObject;

class CastableObjectFactory extends Factory
{
    protected $model = CastableObject::class;

    public function definition(): array
    {
        return [
        ];
    }
}
