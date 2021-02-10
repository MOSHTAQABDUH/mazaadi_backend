<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Favorite;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'auction_id' => $faker->word
    ];
});