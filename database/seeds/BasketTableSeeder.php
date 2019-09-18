<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userSubscription = App\UserSubscription::all()->first();

        $id = DB::table('baskets')->insertGetId([
            'status' => 'wait_validation',
            'order_date' => Carbon::now(),
            'user_subscription_id' => $userSubscription->id
        ]);

        $basket = App\Basket::all()->find($id);
        $basket->products()->sync([1, 2, 3]);

        $basket->save();
    }
}
