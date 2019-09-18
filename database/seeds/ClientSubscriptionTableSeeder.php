<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscription = App\Subscription::all()->first();

        $client = App\Client::all()->where('firstname', '=', 'Jean')->first();

        $bag = App\Bag::all()->first();

        $id = DB::table('client_subscriptions')->insertGetId([
            'subscription_id' => $subscription->id,
            'client_id' => $client->id,
            'bag_id' => $bag->id
        ]);

        $bag->client_subscription_id = $id;

        $bag->save();
    }
}
