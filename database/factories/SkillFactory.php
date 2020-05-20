<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Consulting\Skill;
use App\Models\Consulting\SkillCategory;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'category_id' => factory(SkillCategory::class)
    ];
});
