<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyNeedCategory;
use Faker\Generator as Faker;

$factory->define(App\Models\Company\NeedCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1)
    ];
});
