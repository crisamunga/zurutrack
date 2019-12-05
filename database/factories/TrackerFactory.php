<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tracker;
use Faker\Generator as Faker;

$factory->define(Tracker::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'serial' => $faker->bankAccountNumber,
        'model' => $faker->word,
        'expires_on' => $faker->dateTimeThisYear
    ];
});
