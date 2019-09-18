<?php

use Illuminate\Database\Seeder;

class CrateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Crate::class, 20)->create();
    }
}
