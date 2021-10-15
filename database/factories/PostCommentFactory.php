<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostComments;
use Faker\Generator as Faker;

$factory->define(PostComments::class, function (Faker $faker) {

    $posts = App\Posts::pluck('id')->toArray();

    $users = App\User::pluck('id')->toArray();

    return [
        'post_id' => $faker->randomElement($posts),
        'user_id' => $faker->randomElement($users),
        'text' => $faker->sentence,
    ];
});
