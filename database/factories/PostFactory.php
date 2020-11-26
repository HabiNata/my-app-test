<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostModel;
// use Str;
use Faker\Generator as Faker;

$factory->define(PostModel::class, function (Faker $faker) {
    return [
        'category_id'=>rand(1, 5),
        'title' => $faker->sentence(),
        'slug' => $faker->slug(),
        'body' => $faker->paragraph(5),
        // 'tag' => rand(1, 5),
    ];
});
