<?php

use Illuminate\Database\Seeder;

class BagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Bag::class, 20)->create();
    }
}
