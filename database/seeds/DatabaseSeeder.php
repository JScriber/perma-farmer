<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminTableSeeder::class,

            SubscriptionsTableSeeder::class,
            BagTableSeeder::class,
            CrateTableSeeder::class,
            ProductTableSeeder::class,
            CreditCardTableSeeder::class,

            ClientTableSeeder::class,
            ClientSubscriptionTableSeeder::class,
            BasketTableSeeder::class
        ]);
    }
}
