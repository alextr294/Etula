<?php

use Faker\Generator as Faker;

$factory->define(Étula\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
