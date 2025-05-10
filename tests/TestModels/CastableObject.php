<?php

namespace Grnspc\Measures\Tests\TestModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grnspc\Measures\Cast\Measure;

class CastableObject extends Model
{
    use hasFactory;

    protected $table = 'castables';

    protected $casts = [
        'measure' => Measure::class,
    ];
}
