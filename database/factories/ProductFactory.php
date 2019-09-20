<?php

use App\Product;
use App\ProductType;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name(),
        'weight' => $faker->randomDigit,
        'quantity' => $faker->randomDigit
    ];
});
