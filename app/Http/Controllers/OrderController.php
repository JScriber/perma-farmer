<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;
use App\User;
use App\Role;

class OrderController extends Controller
{

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::adminRole());

        $tab = Array();
        $products = Array();

        $orders = Basket::all()->where("validated","=","0");

        foreach($orders as $order){


            foreach($order->basketProducts as $product){
                array_push($products,Array("num" => $product->quantity, "label" => $product->product->name));
            }

            array_push($tab,Array(
                "id" => $order->id,
                "firstname" => $order->userSubscription->user->firstname,
                "lastname" => $order->userSubscription->user->lastname,
                "basket" => $order->userSubscription->subscription->name,
                "products" => $products
            ));
        }

        // var_dump($tab);
        // user App\Basket::All()->first()->userSubscription->user;
        // panier App\Basket::All()->first()->userSubscription->subscription
        // produits App\Basket::All()->first()->basketProducts
        // produit App\Basket::All()->first()->basketProducts->first()->product

        return view('order.index')->with("orders",$tab);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        return view("order.send");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valid(Request $request)
    {
        

        Basket::find($request->id)->update(Array("validated" => "1"));
        return redirect()->route("order");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
