<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->insert([
            'name' => 'Petit panier',
            'max_weight' => 2500,
            'price' => 12.5
        ]);

        DB::table('subscriptions')->insert([
            'name' => 'Gros panier',
            'max_weight' => 7000,
            'price' => 24.9
        ]);
    }
}
