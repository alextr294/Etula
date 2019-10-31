<?php

use Faker\Generator as Faker;

$factory->define(\App\Teacher::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create(["type" => "teacher"])->id;
        }
    ];
});
