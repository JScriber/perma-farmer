<?php

use App\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    return [
        'owner' => $faker->userName,
        'card_number' => $faker->creditCardNumber,
        'crypto' => $faker->randomDigit,
        'type' => $faker->creditCardType,
        'expiration_date' => $faker->creditCardExpirationDate
    ];
});
