<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostLikes;
use Faker\Generator as Faker;

$factory->define(PostLikes::class, function (Faker $faker) {
    return [
        "user_id" => $faker->numberBetween($min = 28, $max = 32),
        "post_id" => $faker->numberBetween($min = 29, $max = 378),
    ];
});
