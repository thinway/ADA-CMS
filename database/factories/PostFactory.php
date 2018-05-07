<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = rtrim($faker->realText(random_int(25,50)), '.');
    $slug = str_slug($title);

    return [
        'title' => $title,
        'slug' => $slug,
        'excerpt' => $faker->realText(random_int(50, 150)),
        'content' => $faker->realText(random_int(150, 1000))
    ];
});
