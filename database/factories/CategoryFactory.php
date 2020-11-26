<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CategoryModel;
use Faker\Generator as Faker;

$factory->define(CategoryModel::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(),
        'slug'=>$faker->slug(),
    ];
});
