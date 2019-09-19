<?php

use App\Basket;
use App\BasketProduct;
use App\Product;
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
        $basket = new Basket();

        $basket->status = 'wait_validation';
        $basket->order_date = Carbon::now();
        $basket->userSubscription()->associate(App\UserSubscription::all()->first());
        $basket->save();

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
