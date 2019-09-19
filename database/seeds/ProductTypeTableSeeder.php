<?php

use App\Product;
use App\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductType::class, 10)->create()->each(function ($productType) {
            $product = new Product();
            $product->productType()->associate($productType);
            $product->save();
        });;
    }
}
