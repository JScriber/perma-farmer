<?php

use App\Crate;
use Faker\Generator as Faker;

$factory->define(Crate::class, function (Faker $faker) {
    return [
        'reference' => $faker->unique()->text(50)
    ];
});
