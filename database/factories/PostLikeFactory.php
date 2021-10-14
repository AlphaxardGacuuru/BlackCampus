<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostLikes;
use Faker\Generator as Faker;

$factory->define(PostLikes::class, function (Faker $faker) {

$users = App\User::pluck('id')->toArray();
$posts = App\Posts::pluck('id')->toArray();

    return [
        "user_id" => $faker->randomElement($users),
        "post_id" => $faker->randomElement($posts),
    ];
});
