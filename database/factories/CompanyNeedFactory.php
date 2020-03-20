<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CompanyNeedCategory;
use Faker\Generator as Faker;

$factory->define(\App\Models\Company\Need::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'category_id' => factory(App\Models\Company\NeedCategory::class)
    ];
});
