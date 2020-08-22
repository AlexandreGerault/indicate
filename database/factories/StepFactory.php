<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Step;
use Faker\Generator as Faker;

$factory->define(Step::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'explanations' => $faker->text,
        'priority' => $faker->numberBetween(1, 255)
    ];
});
