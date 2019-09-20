<?php

namespace App\Http\Controllers;

use App\Basket;
use App\BasketProduct;
use App\Role;
use App\UserSubscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Http\Response;

class BasketController extends Controller
{

     /**
      * Create a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::clientRole());

        $productsAvailable = Product::all()->all();

        $oldSelection = array();

        if ($request->user()->userSubscriptions[0]->basket_id != null)
        {
            $oldBasketProducts = $request->user()->userSubscriptions[0]->basket->basketProducts;

            foreach ($oldBasketProducts as $product)
            {
                array_push($oldSelection, [
                    'id' => $product->product_id,
                    'quantity' => $product->quantity
                ]);
            }
        }

        return view('panier.index', [
            'products_available' => json_encode($productsAvailable),
            'old_selection' => json_encode($oldSelection),
            'max_weight' => $request->user()->userSubscriptions[0]->subscription->max_weight
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return redirect()->route('panier.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRole(Role::clientRole());

        $editMode = $request->user()->userSubscriptions[0]->basket_id != null;

        try {
            $this->validate($request, [
                'products.*.id' => 'required',
                'products.*.quantity' => 'required',
            ]);

            if ($editMode)
            {
                if (!$request->user()->userSubscriptions[0]->basket->validated)
                {
                    $basket = $request->user()->userSubscriptions[0]->basket;
                    $basket->order_date = Carbon::now();

                    // Detach all.
                    $basketProducts = $basket->basketProducts;

                    foreach ($basketProducts as $basketProduct)
                    {
                        $basketProduct->product->quantity += $basketProduct->quantity;
                        $basketProduct->product->save();

                        $basketProduct->delete();
                    }

                    // Attach the products.
                    $this->attachProducts($request['products'], $basket);

                    $basket->save();
                } else {
                    return redirect()->back()->withInput();
                }
            } else
            {
                // Create the basket.
                $basket = new Basket();

                $basket->validated = false;
                $basket->order_date = Carbon::now();
                $basket->user_subscription_id = $request->user()->userSubscriptions[0]->id;

                // Pre-persist.
                $basket->save();

                // Attach the products.
                $this->attachProducts($request['products'], $basket);

                $basket->save();

                // Attach the basket to the user.
                $subscription = UserSubscription::all()->find($request->user()->userSubscriptions[0]->id);

                $subscription->basket_id = $basket->id;
                $subscription->save();
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Attach the products to the basket.
     * @param $productsDto
     * @param $basket
     */
    private function attachProducts($productsDto, $basket)
    {
        // Process the basket.
        foreach ($productsDto as $productDto) {

            // Find the product.
            $product = Product::all()->find(intval($productDto['id']));
            $quantity = intval($productDto['quantity']);

            if ($product != null) {
                // Check if the product can be selected.
                if ($product->quantity > 0 && ($product->quantity - $quantity) >= 0) {

                    $basketProduct = new BasketProduct();
                    $basketProduct->quantity = $quantity;
                    $basketProduct->product()->associate($product);
                    $basketProduct->basket()->associate($basket);
                    $basketProduct->save();

                    $product->quantity -= $quantity;
                    $product->save();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
