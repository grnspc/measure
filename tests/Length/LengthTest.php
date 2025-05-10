<?php

use Grnspc\Measures\Unit\Length\Length;
use Grnspc\Measures\Unit\Length\UnitsOfLength;

it('can convert a length', function () {
    $length = Length::from('2cm');

    expect($length->to(UnitsOfLength::METER))
        ->toBeInstanceOf(Length::class)
        ->and($length->to(UnitsOfLength::METER)->value)
        ->toBe(0.02);
});

it('can concatenate conversions', function () {
    $length = Length::from('2cm');

    expect($length->toM()->toCm())
        ->and($length->toM()->toCM()->value)
        ->toBe(2.0);
});

it('can accept a string with many spaces', function () {
    $length = Length::from('2  cm');

    expect($length->toM())
        ->and($length->toM()->value)
        ->toBe(0.02);
});

it('cannot have a null unit', function () {
    $length = Length::from('2 .');
    expect($length->unit)->toBeNull();
})->expectException(InvalidArgumentException::class, 'Invalid unit name');

it('can correct units to a correct notation', function () {
    $cases = UnitsOfLength::cases();
    foreach ($cases as $case) {
        if ($case === UnitsOfLength::KILOMETER) {
            expect($case->toStringNotation())->toBe('Km');
        } else {
            expect($case->toStringNotation())->toBe($case->value);
        }
    }
});

it('can convert from mm to m', function () {
    $length = Length::from('2mm');
    expect($length->toM()->value)->toBe(0.002);
});

it('can convert from m to cm', function () {
    $length = Length::from('2m');
    expect($length->toCM()->value)->toBe(200.0);
});

it('can convert from m to km', function () {
    $length = Length::from('2m');
    expect($length->toKM()->value)->toBe(0.002);
});

it('can convert from m to miles', function () {
    $length = Length::from('2m');

    expect($length->toMi()->value)->toBe(0.0012);
});

it('can convert from m to nautical miles', function () {
    $length = Length::from('2m');

    expect($length->toNmi()->value)->toBe(0.0011);
});

it('can convert from m to feet', function () {
    $length = Length::from('2m');
    expect($length->toFt()->value)->toBe(6.5617);
});

it('can convert from m to inches', function () {
    $length = Length::from('2m');
    expect($length->toIn()->value)->toBe(78.7402);
});

it('can convert from m to yards', function () {
    $length = Length::from('2m');
    expect($length->toYd()->value)->toBe(2.1872);
});

it('can convert from miles to m', function () {
    $length = Length::from('2mi');
    expect($length->toMM()->value)->toBe(3218688.0);
});

it('can convert from miles to cm', function () {
    $length = Length::from('2mi');
    expect($length->toCM()->value)->toBe(321868.8);
});

it('can convert from miles to km', function () {
    $length = Length::from('2mi');
    expect($length->toKM()->value)->toBe(3.2187);
});

it('can convert from miles to nautical miles', function () {
    $length = Length::from('2mi');

    expect($length->toNmi()->value)->toBe(1.738);
});

it('can convert from miles to feet', function () {
    $length = Length::from('2mi');
    $rounded = round($length->toFt()->value, 8);
    expect($rounded)->toBe(10560.0);
});

it('can convert from miles to inches', function () {
    $length = Length::from('2mi');
    $rounded = round($length->toIn()->value, 8);
    expect($rounded)->toBe(126720.0);
});

it('can convert from miles to yards', function () {
    $length = Length::from('2mi');
    $rounded = round($length->toYd()->value, 8);
    expect($rounded)->toBe(3520.0);
});
