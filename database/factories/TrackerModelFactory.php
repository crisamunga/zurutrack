<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TrackerModel;
use Faker\Generator as Faker;

$factory->define(TrackerModel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'protocol' => $faker->word,
        'configuration_instructions' => $faker->text,
    ];
});
