<?php

use App\Basket;
use App\BasketProduct;
use App\Product;
use App\UserSubscription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BasketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscription = UserSubscription::all()->first();

        $basket = new Basket();

        $basket->validated = false;
        $basket->order_date = Carbon::now();
        $basket->user_subscription_id = $subscription->id;
        $basket->save();

        $subscription->basket_id = $basket->id;
        $subscription->save();

        $product1 = new BasketProduct();
        $product1->quantity = 1;
        $product1->product()->associate(Product::all()->find(1));
        $product1->basket()->associate($basket);
        $product1->save();

        $product2 = new BasketProduct();
        $product2->quantity = 4;
        $product2->product()->associate(Product::all()->find(2));
        $product2->basket()->associate($basket);
        $product2->save();
    }
}
