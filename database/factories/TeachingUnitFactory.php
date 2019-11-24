<?php

use Faker\Generator as Faker;

$factory->define(Étula\TeachingUnit::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
