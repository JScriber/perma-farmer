<?php

namespace App\Http\Controllers;

use App\Basket;
use App\BasketProduct;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use function GuzzleHttp\Promise\exception_for;

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

        $products = Product::all();
        return view('panier.index', [
            'products' => $products,
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

        try {
            $this->validate($request, [
                'products.*.id' => 'required',
                'products.*.quantity' => 'required',
            ]);

            // Create the basket.
            $basket = new Basket();

            $basket->status = 'wait_validation';
            $basket->order_date = Carbon::now();
            $basket->userSubscription()->associate($request->user()->userSubscriptions[0]);

            // Pre-persist.
            $basket->save();

            // Process the basket.
            foreach ($request['products'] as $productDto) {

                // Find the product.
                $product = Product::all()->find(intval($productDto['id']));
                $quantity = intval($productDto['quantity']);

                if ($product == null) {
                    return redirect()->back()->withInput();
                }

                // Check if the product can be selected.
                if ($product->quantity - ($product->reserved_quantity + $quantity) >= 0) {

                    if ($product->quantity > 0) {
                        $basketProduct = new BasketProduct();
                        $basketProduct->quantity = $quantity;
                        $basketProduct->product()->associate($product);
                        $basketProduct->basket()->associate($basket);
                        $basketProduct->save();
                    }
                }
            }

            return redirect()->route('home');
        } catch (\Exception $exception) {
            return redirect()->back()->withInput();
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
