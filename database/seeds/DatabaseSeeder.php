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
            RoleTableSeeder::class,

            SubscriptionsTableSeeder::class,
            BagTableSeeder::class,
            CrateTableSeeder::class,
            ProductTableSeeder::class,
            CreditCardTableSeeder::class,

            UserTableSeeder::class,
            UserSubscriptionTableSeeder::class,
            BasketTableSeeder::class
        ]);
    }
}
