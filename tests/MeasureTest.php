<?php

use Grnspc\Measures\Unit\Length\UnitsOfLength;
use Grnspc\Measures\Unit\Measure;
use Grnspc\Measures\Unit\Units;
use Grnspc\Measures\Unit\Weight\Weight;

it('throws an exception for a bad method call', function () {
    $measure = new Measure(2.0, UnitsOfLength::CENTIMETER);
    $measure->notExistingMethod();
})->throws(BadMethodCallException::class, 'Method notExistingMethod does not exist.');

it('can return the name of the unit class', function () {
    $measure = new Measure(2.0, UnitsOfLength::CENTIMETER);
    expect($measure->unitClass())->toBe(Units::class);
});

it('throws an exception if a unit is not detected', function () {
    Measure::from('100');
})->throws(BadMethodCallException::class, 'Invalid unit.');

it('throws an exception if a destination unit is not detected', function () {
    Weight::from('100g')->to('');
})->throws(BadMethodCallException::class, 'Invalid unit.');
