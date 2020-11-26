<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TagModel;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(TagModel::class, function (Faker $faker) {
    return [
        'name'=>$faker->lastName(),
        'slug'=>Str::slug($faker->lastName()),
    ];
});
