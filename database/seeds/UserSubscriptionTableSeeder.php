<?php

use App\UserSubscription;
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
        // Subscription of the user.
        $subscription = App\Subscription::all()->first();

        // Concrete user.
        $user = App\User::all()->where('firstname', '=', 'Jean')->first();

        // Inital bag linked.
        $bag = App\Bag::all()->first();


        $userSubscription = new UserSubscription();

        $userSubscription->subscription()->associate($subscription);
        $userSubscription->user()->associate($user);
        $userSubscription->save();

        $bag->userSubscription()->associate($userSubscription);
        $bag->save();
    }
}
