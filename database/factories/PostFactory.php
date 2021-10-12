<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Posts;
use Faker\Generator as Faker;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        // 'user_id' => $faker->randomDigit,
        'text' => $faker->sentence,
        'media' => 'storage/img/Al.jpg',
        // 'parameter_1' => $faker->name,
        // 'parameter_2' => $faker->name,
        // 'parameter_3' => $faker->name,
        // 'parameter_4' => $faker->name,
        // 'parameter_5' => $faker->name,
    ];
});
