<?php

use Faker\Generator as Faker;

$factory->define(App\TeachingUnit::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
