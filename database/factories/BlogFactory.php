<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->paragraph,
        'userc_id' => 1,
        'category_id'=> 1
    ];
});
