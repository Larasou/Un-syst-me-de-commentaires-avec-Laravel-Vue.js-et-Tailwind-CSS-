<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(5),
        'ip' => $faker->ipv4,
    ];
});
