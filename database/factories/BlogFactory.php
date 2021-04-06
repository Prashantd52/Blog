<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'category_id'=>App\Category::all()->random()->id,
        'content'=>$faker->paragraph,
    ];
});
