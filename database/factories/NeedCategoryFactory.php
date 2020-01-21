<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NeedCategory;
use Faker\Generator as Faker;

$factory->define(NeedCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1)
    ];
});
