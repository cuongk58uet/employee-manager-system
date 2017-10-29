<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'created_at' => $faker->dateTimeThisMonth(),
        'updated_at' => $faker->dateTimeThisMonth()
    ];
});
