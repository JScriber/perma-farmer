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
        $product = Array();

        $orders = Basket::all()->where("status","wait_validation");

        


        foreach($orders as $order){

            // foreach($order->products->groupBy("product_type_id") as $products ){
            //     foreach($products as $k => $v){
            //         array_push($product,Array( $products[$k][0]=> $products[$k]->count()));
            //     }
            // }



            array_push($tab,Array(

                "client" => $order->userSubscription->user,
                "type" => $order->userSubscription->subscription,
                "products" => $product

            ));
        }


        var_dump($tab[0]["products"]->id);

        // $client;
        // $content;
        // $basketType;


        // return view('order.index',[
        //     "orders"=>$orders
        // ]);
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
