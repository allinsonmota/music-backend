<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Artist;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
