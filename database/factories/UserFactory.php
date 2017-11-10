<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'username' => $faker->username,
        'password' => Hash::make('manhcuong'),
        'email' => $faker->email,
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'gender' => $faker->title($gender = 'Men'|'Women'),
        'address' => $faker->address,
        'first_login' => true,
        'is_reset_password' => false,
        'is_admin' => false,
        'created_at' => $faker->dateTimeThisMonth(),
        'updated_at' => $faker->dateTimeThisMonth(),
        'remember_token' => str_random(10),
    ];
});
