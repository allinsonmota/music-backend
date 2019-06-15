<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(13),
        'description' => $faker->text(20),
        'release_date' => $faker->dateTime(),
        'year' => $faker->numberBetween(2000, 2019),
    ];
});
