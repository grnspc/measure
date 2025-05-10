<?php

use Grnspc\Measures\Facades\Measures as MeasuresFacade;
use Grnspc\Measures\Tests\TestModels\CastableObject;
use Grnspc\Measures\Unit\Length\Length;

it('can have a null attribute', function () {
    $a = CastableObject::factory()->create();
    expect($a->measure)->toBeNull();
});

it('can save a measure in a model', function () {
    $a = CastableObject::factory()->create([
        'measure' => MeasuresFacade::from('1m'),
    ]);
    expect($a->measure)->toBeInstanceOf(Length::class);
});

it('can retrieve an attribute', function () {
    $a = CastableObject::factory()->create();
    $a->measure = MeasuresFacade::from('1m');
    $a->save();

    $b = CastableObject::find($a->id);

    expect($b->measure)->toBeInstanceOf(Length::class)
        ->and($b->measure->value)->toBe(1.0);
});

it('can retrieve an empty attribute', function () {
    $a = CastableObject::factory()->create();
    $a->measure = null;
    $a->save();

    $b = CastableObject::find($a->id);

    expect($b->measure)->toBeNull();
});

it('saves measure as string in db', function () {
    $a = CastableObject::factory()->create([
        'measure' => MeasuresFacade::from('1m'),
    ]);
    $original = $a->getRawOriginal('measure');
    expect($original)->toBe('1 m');
});

it('throws an exception if the value is not a measure', function () {
    CastableObject::factory()->create([
        'measure' => 'wrong-value',
    ]);
})->throws(InvalidArgumentException::class, 'The value must be an instance of Grnspc\Measures\Unit\Measure');
