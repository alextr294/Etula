<?php

use Faker\Generator as Faker;

$factory->define(\Étula\Admin::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(Étula\User::class)->create(["type" => "admin"])->id;
        }
    ];
});
