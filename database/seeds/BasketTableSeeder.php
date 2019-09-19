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

        $this->attachProduct($basket, 1);
        $this->attachProduct($basket, 2);
    }

    /**
     * Attaches a product to the basket.
     * @param $basket
     * @param $product_id
     */
    private function attachProduct($basket, $product_id)
    {
        $product = Product::all()->find($product_id);
        $product->basket()->associate($basket);
        $product->save();
    }
}
