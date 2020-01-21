<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NeedCategory;
use Faker\Generator as Faker;

$factory->define(\App\Need::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'category_id' => factory(NeedCategory::class)
    ];
});
