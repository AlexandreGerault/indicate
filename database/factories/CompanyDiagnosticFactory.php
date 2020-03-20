<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(\App\Models\Company\Diagnostic::class, function (Faker $faker) {
    return [
        'step' => random_int(1,5),
        'user_id' => factory(User::class)
    ];
});
