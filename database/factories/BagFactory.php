<?php

use App\Bag;
use Faker\Generator as Faker;

$factory->define(Bag::class, function (Faker $faker) {
    return [
        'reference' => $faker->unique()->text(50)
    ];
});
