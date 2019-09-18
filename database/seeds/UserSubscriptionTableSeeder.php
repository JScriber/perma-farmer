<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscription = App\Subscription::all()->first();

        $client = App\User::all()->where('firstname', '=', 'Jean')->first();

        $bag = App\Bag::all()->first();

        $id = DB::table('user_subscriptions')->insertGetId([
            'subscription_id' => $subscription->id,
            'user_id' => $client->id,
            'bag_id' => $bag->id
        ]);

        $bag->user_subscription_id = $id;

        $bag->save();
    }
}
