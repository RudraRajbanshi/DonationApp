<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Position;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'position_name' => $faker->word,
        'rank' => $faker->word,
        'userc_id'=>1
    ];
});
