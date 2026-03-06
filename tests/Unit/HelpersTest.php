<?php
use \Illuminate\Support\Number;
it('returns default currency ', function () {
    $currency = Number::defaultCurrency();
    expect($currency)->toBe('USD');
});

it('returns sum of two numbers', function () {
   $sum = sum(1,4);
   expect($sum)->toBe(5);
});
