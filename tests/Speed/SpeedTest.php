<?php

use Grnspc\Measures\Unit\Speed\Speed;

it('can convert from m/s to km/h', function () {
    $speed = Speed::from('1m_s');
    expect(round($speed->to('km_h')->value, 1))->toBe(3.6);

    $speed = Speed::from('1 m/s');
    expect(round($speed->to('km/h')->value, 1))->toBe(3.6)
        ->and((string) $speed->to('km/h'))->toBe('3.6 Km/h');

    $speed = Speed::from('1 meters per second');
    expect(round($speed->to('kilometers per hour')->value, 1))->toBe(3.6);
});

it('can convert from m/s to mi/h', function () {
    $speed = Speed::from('1m_s');
    expect($speed->to('mi_h')->value)->toBe(2.2369);

    $speed = Speed::from('1 m/s');
    expect($speed->to('mi/h')->value)->toBe(2.2369);

    $speed = Speed::from('1 meters per second');
    expect($speed->to('miles per hour')->value)->toBe(2.2369);
});

it('can convert from m/s to kn', function () {
    $speed = Speed::from('1m_s');
    expect($speed->to('kn')->value)->toBe(1.9438);

    $speed = Speed::from('1 m/s');
    expect($speed->to('kn')->value)->toBe(1.9438);

    $speed = Speed::from('1 meters per second');
    expect($speed->to('kn')->value)->toBe(1.9438);
});

it('can convert from m/s to ft/s', function () {
    $speed = Speed::from('1m_s');
    expect($speed->to('ft_s')->value)->toBe(0.3048);

    $speed = Speed::from('1 m/s');
    expect($speed->to('ft/s')->value)->toBe(0.3048);

    $speed = Speed::from('1 meters per second');
    expect($speed->to('feet per second')->value)->toBe(0.3048);
});

it('can convert from m/s to mach', function () {
    $speed = Speed::from('1m_s');
    expect($speed->to('mach')->value)->toBe(340.29);

    $speed = Speed::from('1 m/s');
    expect($speed->to('mach')->value)->toBe(340.29);

    $speed = Speed::from('1 meters per second');
    expect($speed->to('mach')->value)->toBe(340.29);
});
