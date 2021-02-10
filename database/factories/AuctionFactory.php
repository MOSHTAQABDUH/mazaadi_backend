<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auction;
use Faker\Generator as Faker;

$factory->define(Auction::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'phone' => $faker->word,
        'lat' => $faker->word,
        'lng' => $faker->word,
        'location_name' => $faker->word,
        'owner_name' => $faker->word,
        'status' => $faker->randomElement(['']),
        'details' => $faker->word,
        'start_price' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'user_id' => $faker->word,
        'primary_image' => $faker->word
    ];
});
