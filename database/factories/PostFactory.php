<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Posts::class, function (Faker $faker) {

    $users = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($users),
        'text' => $faker->sentence,
        // 'media' => 'storage/img/Al.jpg',
        'parameter_1' => 'Man U',
        'parameter_2' => 'Arsenal',
        'parameter_3' => 'Barcelona',
        'parameter_4' => 'Chelsea',
        'parameter_5' => 'Denmark',
    ];
});
