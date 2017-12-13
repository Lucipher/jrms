<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {
  return [
    'bnumber' => $faker->ean8,
    'itemname' => $faker->firstNameMale,
    'openstock' => $faker->randomDigit,
    'minstock' => $faker->randomDigit,
    // 'isactive' = $faker->boolean,
    // 'notforsale' = $faker->boolean,
    // 'ispurchased' = $faker->boolean,
    // 'online' = $faker->boolean,
    'disc1' => 'rupees',
    'disc2' => 'null',
    'featured_image' => 'Error',
    'categoryname' => 'Tamil',
    'subcategoryname' => 'CDs',
    'desc' => $faker->sentence(10),
    'mrp' => $faker->numberBetween(100,9000),
    'discvalue' => $faker->numberBetween(5,100),
    'finalprice' => $faker->numberBetween(100,9000),
    'createdby' => 'Sam Daniel',
    'modifiedby' => 'Sam Daniel',
  ];
});
