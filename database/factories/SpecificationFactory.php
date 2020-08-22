<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Consulting\Specification;
use Faker\Generator as Faker;

$factory->define(Specification::class, function (Faker $faker) {
    return [
        'content' => $faker->text
    ];
});
