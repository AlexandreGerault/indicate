<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Consulting;
use Faker\Generator as Faker;

$factory->define(Consulting::class, function (Faker $faker) {
    return [
        'name'=> $faker->company,
        'responsible' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail
    ];
});
