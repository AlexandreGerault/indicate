<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'responsible' => $faker->name,
        'founded_at' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'mail' => $faker->companyEmail,
        'status' => $faker->text
    ];
});
