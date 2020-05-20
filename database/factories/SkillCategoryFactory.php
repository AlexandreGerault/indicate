<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Consulting\SkillCategory;
use Faker\Generator as Faker;

$factory->define(SkillCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord
    ];
});
