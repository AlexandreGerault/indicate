<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ContactMessage;
use Faker\Generator as Faker;

$factory->define(ContactMessage::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'message' => $faker->text
    ];
});
