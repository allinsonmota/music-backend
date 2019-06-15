<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Song;
use Faker\Generator as Faker;
use App\Artist;
use App\Album;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
    ];
});
