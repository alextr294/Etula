<?php

use Faker\Generator as Faker;

$factory->define(\Étula\Teacher::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(Étula\User::class)->create(["type" => "teacher"])->id;
        }
    ];
});
