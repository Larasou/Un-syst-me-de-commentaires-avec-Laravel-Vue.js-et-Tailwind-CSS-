<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $avatar = [
        '/images/persons/png/boy.png',
        '/images/persons/png/boy-1.png',
        '/images/persons/png/boy-2.png',
        '/images/persons/png/boy-3.png',
        '/images/persons/png/girl.png',
        '/images/persons/png/girl-1.png',
        '/images/persons/png/girl-2.png',
        '/images/persons/png/girl-3.png',
        '/images/persons/png/man.png',
        '/images/persons/png/man-1.png',
    ];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'avatar' => array_random($avatar),
    ];
});
